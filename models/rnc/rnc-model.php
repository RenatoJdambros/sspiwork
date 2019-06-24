<?php
class RncModel extends MainModel
{

	public function __construct($db = false, $controller = null) 
	{
		// Configura o DB (PDO)
		$this->db = $db;
		
		// Configura o controlador
		$this->controller = $controller;

		// Configura os parâmetros
		$this->parametros = $this->controller->parametros;

		// Configura os dados do usuário
		$this->userdata = $this->controller->userdata;
    }
    

	public function paginacao()
    {
		if ($this->userdata['tipo_usuario'] == 3) {
			$sql = 'SELECT * FROM rnc';
			$where = $this->userdata['id'] . " IN (id_origem, id_destino)";

			$columns = $this->formatar_colunas();
			$page = DataTable::complex($_POST, $this->db->pdo, 'rnc', 'id', $columns, $sql, null, $where);
		} else {
			$columns = $this->formatar_colunas();
			$page = DataTable::simple($_POST, $this->db->pdo, 'rnc', 'id', $columns);
		}
        return json_encode($page);
    }


    private function formatar_colunas()
    {
        return array(
            ['dt' => 0, 'db' => 'id'],
            ['dt' => 1, 'db' => 'id_origem', 'formatter' => function($d) 
            {
                $query = $this->db->query('SELECT nome, setor FROM usuarios WHERE id = ?', [$d]);
				$result = $query->fetch();
				
				if (empty($result)) {
					return "Não encontrado";	
				}

				$query = $this->db->query('SELECT nome FROM setores WHERE id = ?', [$result['setor']]);
				$setor = $query->fetch();

                return $setor['nome'] . " - " . $result['nome'];
            }],
            ['dt' => 2, 'db' => 'id_destino', 'formatter' => function($d) 
            {
                $query = $this->db->query('SELECT nome, setor FROM usuarios WHERE id = ?', [$d]);
				$result = $query->fetch();

				if (empty($result)) {
					return "Não encontrado";	
				}

                $query = $this->db->query('SELECT nome FROM setores WHERE id = ?', [$result['setor']]);
				$setor = $query->fetch();

                return $setor['nome'] . " - " . $result['nome'];
            }],
            ['dt' => 3, 'db' => 'status', 'formatter' => function($d) 
            {
                if ($d == 1) {
					return "<span class='label label-primary'>Novo</span>";
				} elseif ($d == 2) {
					return "<span class='label label-warning'>Em progresso</span>";
				} elseif ($d == 3) {
					return "<span class='label label-success'>Finalizado</span>";
				} elseif ($d == 4) {
					return "<span class='label label-default'>Expirado</span>";
				}
            }],
			['dt' => 4, 'db' => 'numero_op'],
			['dt' => 5, 'db' => 'sacp'],
			['dt' => 6, 'db' => 'data_gerada', 'formatter' => function($d) 
            {
				if ($d !== null) {
					$data = new DateTime($d);
					return $data->format('d/m/Y H:i:s');
				}
				return "";
            }],
			['dt' => 7, 'db' => 'data_finalizada', 'formatter' => function($d) 
            {
				if ($d !== null) {
					$data = new DateTime($d);
					return $data->format('d/m/Y H:i:s');
				}
				return "";
            }],
            ['dt' => 8, 'db' => 'id', 'formatter' => function($d) 
            {
                ob_start(); ?>
                    <div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Mais <span class="caret"></span> </button>
                        <ul class="dropdown-menu dropdown-menu-right">
							<?php if ($this->controller->check_permissions('sacp', 'inserir', $this->userdata['user_permissions'])) { ?>
                                <li>
                                    <a href="<?= HOME_URI ?>/sacp/gerarSACPdeRNC/<?= $d ?>"><i class="fa fa-copy"></i> Gerar SACP</a>
                                </li>
                            <?php } ?>
                            <?php if ($this->controller->check_permissions('rnc', 'editar', $this->userdata['user_permissions'])) { ?>
                                <li>
                                    <a href="<?= HOME_URI ?>/rnc/editar/<?= $d ?>"><i class="fa fa-edit"></i> Editar</a>
                                </li>
                            <?php } ?>
							<?php if ($this->controller->check_permissions('rnc', 'editar', $this->userdata['user_permissions'])) { 
								$query = $this->db->query('SELECT * FROM rnc WHERE id = ?', [$d]);
								$rnc = $query->fetch(PDO::FETCH_ASSOC);
								
								$query = $this->db->query('SELECT * FROM usuarios WHERE id = ?', [$rnc['id_destino']]);
								$userDestino = $query->fetch(PDO::FETCH_ASSOC);
								
								if ($this->userdata['id'] == $userDestino['id'] 
								 || $this->userdata['tipo_usuario'] == 1
								 || $this->userdata['tipo_usuario'] == 2) { ?>
									<li>
										<a href="<?= HOME_URI ?>/rnc/finalizar/<?= $d ?>"><i class="fa fa-check"></i> Finalizar</a>
									</li>
                            <?php } } ?>
                            <?php if ($this->controller->check_permissions('rnc', 'excluir', $this->userdata['user_permissions'])) { ?>
                                <li>
                                    <a href="<?= HOME_URI ?>/rnc/excluir/<?= $d ?>/"><i class="fa fa-remove"></i> Excluir</a>
                                    <div style="display:none">
                                        <button type="button" class="btn btn-primary" id="btn_modal" data-toggle="modal" data-target=".bs-example-modal-sm">Small modal</button>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php
                $data = ob_get_contents();
                ob_end_clean();
                return $data;
            }]
        );
	} // end formatar colunas


	public function buscaSetor($id)
	{
		// Busca o nome do setor do usuário logado
		$query = $this->db->query('SELECT nome FROM setores WHERE id = ?', [$id]);
		$setor = $query->fetch(PDO::FETCH_ASSOC);
		return $setor['nome'];
	}


    public function listarUsuarios() 
	{
		// Busca os usuários fora o usuário logado e atribui os nomes dos setores as suas arrays
		$query = $this->db->query('SELECT * FROM usuarios WHERE id != ? AND tipo_usuario != 1', [$this->userdata['id']]);
		$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

		foreach ($usuarios as $key => $usuario) {
			$query = $this->db->query('SELECT * FROM setores WHERE id = ?', [$usuario['setor']]);
			$result = $query->fetch(PDO::FETCH_ASSOC);
			$usuarios[$key]['nomeSetor'] = $result['nome'];
		}
		
		// Sorteia a array ordem crescente por setor
		usort($usuarios, function($a, $b) {
		return $b['nomeSetor'] <= $a['nomeSetor'];
		});

		return $usuarios;
    }
	
	
	public function consultaRNC($id) 
	{
		$query = $this->db->query('SELECT * FROM rnc WHERE id = ?', [$id]);
		$rnc = $query->fetch(PDO::FETCH_ASSOC);

		$query = $this->db->query('SELECT * FROM usuarios WHERE id = ?', [$rnc['id_origem']]);
		$userOrigem = $query->fetch(PDO::FETCH_ASSOC);

		$query = $this->db->query('SELECT * FROM usuarios WHERE id = ?', [$rnc['id_destino']]);
		$userDestino = $query->fetch(PDO::FETCH_ASSOC);

		return array('rnc' => $rnc, 'userOrigem' => $userOrigem, 'userDestino' => $userDestino);
	}

    
    public function inserirRNC() 
	{
		/* Verifica se algo foi postado e se está vindo do form que tem o campo
		insere_noticia. */
		if ('POST' != $_SERVER['REQUEST_METHOD'] || empty($_POST['inserirRNC'])) {
			return;
		}
		
		/* Para evitar conflitos apenas inserimos valores se o parâmetro edit
		não estiver configurado. */
		if (chk_array($this->parametros, 0) == 'edit') {
			return;
		}
		
		/* Só pra garantir que não estamos atualizando nada */
		if (is_numeric(chk_array($this->parametros, 1))) {
			return;
		}

		/* Remove o campo inserirRNC para não gerar problema com o PDO */
		unset($_POST['inserirRNC']);

		// Checa se o campo numero_op está vazio, caso esteja, seta pra null
		if (empty($_POST['numero_op'])) {
			$_POST['numero_op'] = null;
		}

		// Cria a data atual para ser gravada no banco de dados
		$dataGerada = new DateTime('now');
		$dataGerada = $dataGerada->format('Y-m-d H:i:s');

		// Salva na $_POST e deleta a variavel desnecessária
		$_POST['data_gerada'] = $dataGerada;
		unset($dataGerada);

		/* query */
		$query = $this->db->insert('rnc', $_POST);
		
		/* Verifica a consulta */
		if ($query) {
			return 'success';
		}
		return 'Erro ao inserir RNC no banco de dados';
	} // insert

	
	public function editarRNC($id) 
	{
		/* Verifica se algo foi postado e se está vindo do form que tem o campo
		editar_usuario. */
		if ('POST' != $_SERVER['REQUEST_METHOD'] || empty($_POST['editarRNC'])) {
			return;
		}

		/* Remove o campo insere_usuario para não gerar problema com o PDO */
		unset($_POST['editarRNC']);

		// Checa se o campo numero_op está vazio, caso esteja, seta pra null
		if (empty($_POST['numero_op'])) {
			$_POST['numero_op'] = null;
		}

		/* Atualiza os dados */
		$query = $this->db->update('rnc', 'id', $id, $_POST);
		
		/* Verifica a consulta */
		if ($query) {
			return 'success';
		}
		return 'Falha ao atualizar o cadastro do usuário';
	} // update


	public function excluirRNC() 
	{
		// O segundo parâmetro deverá ser um ID numérico
		if (! is_numeric(chk_array($this->parametros, 0))) {
			return;
		}

		// Para excluir, o terceiro parâmetro deverá ser "confirma"
		if (chk_array($this->parametros, 1) != 'confirma') {
			return;	
		}

		// Configura o ID do Usuário
		$user_id = (int)chk_array($this->parametros, 0);

		// Executa a consulta
        $query = $this->db->delete('rnc', 'id', $user_id);
        
        if ($query) {
            echo '<meta http-equiv="Refresh" content="0; url=' . HOME_URI . '/rnc/">';
		    echo '<script type="text/javascript">window.location.href = "' . HOME_URI . '/rnc/";</script>';
        }
		return 'Falha ao excluir a RNC';
	} // delete


	public function finalizarRNC($id) 
	{
		/* Verifica se algo foi postado e se está vindo do form que tem o campo
		editar_usuario. */
		if ('POST' != $_SERVER['REQUEST_METHOD'] || empty($_POST['finalizarRNC'])) {
			return;
		}

		/* Remove o campo insere_usuario para não gerar problema com o PDO */
		unset($_POST['finalizarRNC']);

		// Cria a data atual para ser gravada no banco de dados
		$dataFinalizada = new DateTime('now');
		$dataFinalizada = $dataFinalizada->format('Y-m-d H:i:s');

		// Salva na $_POST e deleta a variavel desnecessária
		$_POST['data_finalizada'] = $dataFinalizada;
		unset($dataFinalizada);

		/* Atualiza os dados */
		$query = $this->db->update('rnc', 'id', $id, $_POST);
		
		/* Verifica a consulta */
		if ($query) {
            // require ABSPATH . '/PHPMailer/PHPMailer.php';
            // require ABSPATH . '/PHPMailer/SMTP.php';
            
            // $mail = new PHPMailer;
            // $mail->isSMTP();
            // //$mail->SMTPSecure = 'ssl';
            // //$mail->SMTPAuth = true;
            // $mail->Host = 'nac.edelbra.com.br';
            // $mail->Port = 587;
            // $mail->Username = 'manutencao@edelbra.com.br';
            // $mail->Password = 'man@2015!';
            // $mail->setFrom('manutencao@edelbra.com.br');
            // $mail->addAddress('renato.dambros@edelbra.com.br');
            // $mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)
            // $mail->Subject = 'Finalizar RNC';
            // $msg = "<html dir='ltr'>
            //     <head>
            //         <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
            //         <style>
            //             @font-face {
            //                 font-family: Cambria Math;
            //             }

            //             @font-face {
            //                 font-family: Calibri;
            //             }

            //             @font-face {
            //                 font-family: Tahoma;
            //             }

            //             @font-face {
            //                 font-family: Verdana;
            //             }

            //             @page WordSection1 {
            //                 margin: 70.85pt 3.0cm 70.85pt 3.0cm;
            //             }

            //             P.MsoNormal {
            //                 FONT-SIZE: 11pt;
            //                 FONT-FAMILY: 'Calibri', 'sans-serif';
            //                 MARGIN: 0cm 0cm 0pt
            //             }

            //             LI.MsoNormal {
            //                 FONT-SIZE: 11pt;
            //                 FONT-FAMILY: 'Calibri', 'sans-serif';
            //                 MARGIN: 0cm 0cm 0pt
            //             }

            //             DIV.MsoNormal {
            //                 FONT-SIZE: 11pt;
            //                 FONT-FAMILY: 'Calibri', 'sans-serif';
            //                 MARGIN: 0cm 0cm 0pt
            //             }

            //             H1 {
            //                 FONT-SIZE: 24pt;
            //                 FONT-FAMILY: 'Times New Roman', 'serif';
            //                 FONT-WEIGHT: bold;
            //                 MARGIN-LEFT: 0cm;
            //                 MARGIN-RIGHT: 0cm
            //             }

            //             A:link {
            //                 TEXT-DECORATION: underline;
            //                 COLOR: blue
            //             }

            //             SPAN.MsoHyperlink {
            //                 TEXT-DECORATION: underline;
            //                 COLOR: blue
            //             }

            //             A:visited {
            //                 TEXT-DECORATION: underline;
            //                 COLOR: purple
            //             }

            //             SPAN.MsoHyperlinkFollowed {
            //                 TEXT-DECORATION: underline;
            //                 COLOR: purple
            //             }

            //             P.MsoAcetate {
            //                 FONT-SIZE: 8pt;
            //                 FONT-FAMILY: 'Tahoma', 'sans-serif';
            //                 MARGIN: 0cm 0cm 0pt
            //             }

            //             LI.MsoAcetate {
            //                 FONT-SIZE: 8pt;
            //                 FONT-FAMILY: 'Tahoma', 'sans-serif';
            //                 MARGIN: 0cm 0cm 0pt
            //             }

            //             DIV.MsoAcetate {
            //                 FONT-SIZE: 8pt;
            //                 FONT-FAMILY: 'Tahoma', 'sans-serif';
            //                 MARGIN: 0cm 0cm 0pt
            //             }

            //             SPAN.Ttulo1Char {
            //                 FONT-FAMILY: 'Cambria', 'serif';
            //                 FONT-WEIGHT: bold;
            //                 COLOR: #365f91
            //             }

            //             SPAN.TextodebaloChar {
            //                 FONT-FAMILY: 'Tahoma', 'sans-serif'
            //             }

            //             SPAN.estilodeemail17 {
            //                 FONT-FAMILY: 'Calibri', 'sans-serif';
            //                 COLOR: windowtext
            //             }

            //             SPAN.textodebalochar0 {
            //                 FONT-FAMILY: 'Tahoma', 'sans-serif'
            //             }

            //             SPAN.ttulo1char0 {
            //                 FONT-FAMILY: 'Times New Roman', 'serif';
            //                 FONT-WEIGHT: bold
            //             }

            //             SPAN.EstiloDeEmail24 {
            //                 FONT-FAMILY: 'Calibri', 'sans-serif';
            //                 COLOR: #1f497d
            //             }

            //             .MsoChpDefault {
            //                 FONT-SIZE: 10pt
            //             }

            //         </style>
            //         <style id='owaParaStyle'>
            //             P {
            //                 MARGIN-BOTTOM: 0px;
            //                 MARGIN-TOP: 0px
            //             }

            //         </style>
            //     </head>

            //     <body style='width:100%;font-family:' open sans', 'helvetica neue' , helvetica, arial,
            //     sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0;'>
            //     <div class='es-wrapper-color' style='background-color:#EEEEEE;'>
            //         <!--[if gte mso 9]>
            //                 <v:background xmlns:v='urn:schemas-microsoft-com:vml' fill='t'>
            //                     <v:fill type='tile' color='#eeeeee'></v:fill>
            //                 </v:background>
            //             <![endif]-->
            //         <table width='100%' cellspacing='0' cellpadding='0'
            //         style=border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;'>
            //         <tr style='border-collapse:collapse;'>
            //             <td valign='top' style='padding:0;Margin:0;'>
            //             <table cellspacing='0' cellpadding='0' align='center'
            //                 style=border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;'>
            //                 <tr style='border-collapse:collapse;'>
            //                 </tr>
            //                 <tr style='border-collapse:collapse;'>
            //                 <td align='center' style='padding:0;Margin:0;'>
            //                     <table 
            //                     style=border-collapse:collapse;border-spacing:0px;background-color:transparent;'
            //                     width='600' cellspacing='0' cellpadding='0' align='center'>
            //                     <tr style='border-collapse:collapse;'>
            //                         <td align='left'
            //                         style='Margin:0;padding-left:10px;padding-right:10px;padding-top:15px;padding-bottom:15px;'>
            //                         <!--[if mso]><table width='580' cellpadding='0' cellspacing='0'><tr><td width='282' valign='top'><![endif]-->
            //                         <table class='es-left' cellspacing='0' cellpadding='0' align='left'
            //                             style=border-collapse:collapse;border-spacing:0px;float:left;'>
            //                             <tr style='border-collapse:collapse;'>
            //                             <td width='282' align='left' style='padding:0;Margin:0;'>
            //                                 <table width='100%' cellspacing='0' cellpadding='0'
            //                                 style=border-collapse:collapse;border-spacing:0px;'>
            //                                 <tr style='border-collapse:collapse;'>
            //                                     <td class='es-infoblock es-m-txt-c' align='left'
            //                                     style='padding:0;Margin:0;line-height:14px;font-size:12px;color:rgb(134, 134, 134);'>
            //                                     <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:12px;font-family:arial, '
            //                                         helvetica neue', helvetica, sans-serif;line-height:14px;color:#CCCCCC;'>Sistema de Solicitações e Práticas ISO's<br></p>
            //                                     </td>
            //                                 </tr>
            //                                 </table>
            //                             </td>
            //                             </tr>
            //                         </table>
            //                         <!--[if mso]></td><td width='20'></td><td width='278' valign='top'><![endif]-->
            //                         <table class='es-right' cellspacing='0' cellpadding='0' align='right'
            //                             style=border-collapse:collapse;border-spacing:0px;float:right;'>
            //                             <tr style='border-collapse:collapse;'>
            //                             <td width='278' align='left' style='padding:0;Margin:0;'>
            //                                 <table width='100%' cellspacing='0' cellpadding='0'
            //                                 style=border-collapse:collapse;border-spacing:0px;'>
            //                                 <tr style='border-collapse:collapse;'>
            //                                     <td class='es-infoblock es-m-txt-c' align='right'
            //                                     style='padding:0;Margin:0;line-height:14px;font-size:12px;color:#CCCCCC;'>
            //                                     <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:12px;font-family:'
            //                                         open sans', 'helvetica neue' , helvetica, arial,
            //                                         sans-serif;line-height:14px;color:#CCCCCC;'><a href='http://#' target='_blank'
            //                                         style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, '
            //                                         helvetica neue', helvetica,
            //                                         sans-serif;font-size:12px;text-decoration:none;color:#CCCCCC;'>View in
            //                                         browser</a><br></p>
            //                                     </td>
            //                                 </tr>
            //                                 </table>
            //                             </td>
            //                             </tr>
            //                         </table>
            //                         <!--[if mso]></td></tr></table><![endif]-->
            //                         </td>
            //                     </tr>
            //                     </table>
            //                 </td>
            //                 </tr>
            //             </table>
            //             <table class='es-content' cellspacing='0' cellpadding='0' align='center'
            //                 style=border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;'>
            //                 <tr style='border-collapse:collapse;'>
            //                 </tr>
            //                 <tr style='border-collapse:collapse;'>
            //                 <td align='center' style='padding:0;Margin:0;'>
            //                     <table class='es-header-body'
            //                     style=border-collapse:collapse;border-spacing:0px;background-color:#044767;'
            //                     width='600' cellspacing='0' cellpadding='0' bgcolor='#044767' align='center'>
            //                     <tr style='border-collapse:collapse;'>
            //                         <td align='left'
            //                         style='Margin:0;padding-top:15px;padding-left:15px;padding-right:15px;padding-bottom:40px;'>
            //                         <table width='100%' cellspacing='0' cellpadding='0'
            //                             style=border-collapse:collapse;border-spacing:0px;'>
            //                             <tr style='border-collapse:collapse;'>
            //                             <td width='530' valign='top' align='center' style='padding:0;Margin:0;'>
            //                                 <table width='100%' cellspacing='0' cellpadding='0'
            //                                 style=border-collapse:collapse;border-spacing:0px;'>
            //                                 <tr style='border-collapse:collapse;'>
            //                                     <td class='es-m-txt-c' align='center' style='padding:0;Margin:0;'>
            //                                     <h1 style='Margin:0;line-height:36px;mso-line-height-rule:exactly;font-family:' open
            //                                         sans', 'helvetica neue' , helvetica, arial,
            //                                         sans-serif;font-size:36px;font-style:normal;font-weight:bold;color:#FFFFFF;'>Beretun
            //                                     </h1>
            //                                     </td>
            //                                 </tr>
            //                                 </table>
            //                             </td>
            //                             </tr>
            //                         </table>
            //                         </td>
            //                     </tr>
            //                     </table>
            //                 </td>
            //                 </tr>
            //             </table>
            //             <table class='es-content' cellspacing='0' cellpadding='0' align='center'
            //                 style=border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;'>
            //                 <tr style='border-collapse:collapse;'>
            //                 <td align='center' style='padding:0;Margin:0;'>
            //                     <table class='es-content-body' width='600' cellspacing='0' cellpadding='0' bgcolor='#ffffff'
            //                     align='center'
            //                     style=border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;'>
            //                     <tr style='border-collapse:collapse;'>
            //                         <td align='left'
            //                         style='Margin:0;padding-bottom:25px;padding-top:35px;padding-left:35px;padding-right:35px;'>
            //                         <table width='100%' cellspacing='0' cellpadding='0'
            //                             style=border-collapse:collapse;border-spacing:0px;'>
            //                             <tr style='border-collapse:collapse;'>
            //                             <td width='530' valign='top' align='center' style='padding:0;Margin:0;'>
            //                                 <table width='100%' cellspacing='0' cellpadding='0'
            //                                 style=border-collapse:collapse;border-spacing:0px;'>
            //                                 <tr style='border-collapse:collapse;'>
            //                                     <td align='left' style='padding:0;Margin:0;padding-bottom:5px;padding-top:20px;'>
            //                                     <h3 style='Margin:0;line-height:22px;mso-line-height-rule:exactly;font-family:' open
            //                                         sans', 'helvetica neue' , helvetica, arial,
            //                                         sans-serif;font-size:18px;font-style:normal;font-weight:bold;color:#333333;'>Hello
            //                                         there,<br></h3>
            //                                     </td>
            //                                 </tr>
            //                                 <tr style='border-collapse:collapse;'>
            //                                     <td align='left' style='padding:0;Margin:0;padding-bottom:10px;padding-top:15px;'>
            //                                     <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:'
            //                                         open sans', 'helvetica neue' , helvetica, arial,
            //                                         sans-serif;line-height:24px;color:#777777;'>Lorem ipsum dolor sit amet, consectetur
            //                                         adipisicing elit. Excepturi incidunt ducimus, assumenda. Vitae, dolorum
            //                                         perspiciatis.</p>
            //                                     </td>
            //                                 </tr>
            //                                 <tr style='border-collapse:collapse;'>
            //                                     <td align='left' style='padding:0;Margin:0;padding-top:5px;padding-bottom:10px;'>
            //                                     <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:'
            //                                         open sans', 'helvetica neue' , helvetica, arial,
            //                                         sans-serif;line-height:24px;color:#777777;'>Lorem ipsum dolor sit amet, consectetur
            //                                         adipisicing elit. Itaque, voluptatibus necessitatibus, facilis voluptatum nobis
            //                                         tempora eum. Saepe praesentium non quaerat, deleniti, voluptatum aperiam fugit.
            //                                         Impedit ullam, itaque fuga, expedita, quam rem, magni voluptate vitae nulla vero
            //                                         sunt exercitationem quaerat nesciunt!</p>
            //                                     </td>
            //                                 </tr>
            //                                 <tr style='border-collapse:collapse;'>
            //                                     <td align='left' style='padding:0;Margin:0;padding-top:5px;'>
            //                                     <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:'
            //                                         open sans', 'helvetica neue' , helvetica, arial,
            //                                         sans-serif;line-height:24px;color:#777777;'>Lorem ipsum dolor sit amet, consectetur
            //                                         adipisicing elit. Quaerat deleniti, sunt reprehenderit, quod temporibus voluptas
            //                                         corporis magni aperiam fugiat, doloremque consectetur provident ipsam! Aliquam,
            //                                         soluta.</p>
            //                                     </td>
            //                                 </tr>
            //                                 <tr style='border-collapse:collapse;'>
            //                                     <td align='left' style='padding:0;Margin:0;padding-top:40px;'>
            //                                     <h3 style='Margin:0;line-height:22px;mso-line-height-rule:exactly;font-family:' open
            //                                         sans', 'helvetica neue' , helvetica, arial,
            //                                         sans-serif;font-size:18px;font-style:normal;font-weight:bold;color:#333333;'>Clinton
            //                                         Wilmott</h3>
            //                                     </td>
            //                                 </tr>
            //                                 <tr style='border-collapse:collapse;'>
            //                                     <td align='left' style='padding:0;Margin:0;'>
            //                                     <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:'
            //                                         open sans', 'helvetica neue' , helvetica, arial,
            //                                         sans-serif;line-height:24px;color:#777777;'>CEO, Beretun</p>
            //                                     </td>
            //                                 </tr>
            //                                 </table>
            //                             </td>
            //                             </tr>
            //                         </table>
            //                         </td>
            //                     </tr>
            //                     </table>
            //                 </td>
            //                 </tr>
            //             </table>
            //             <table class='es-content' cellspacing='0' cellpadding='0' align='center'
            //                 style=border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;'>
            //                 <tr style='border-collapse:collapse;'>
            //                 <td align='center' style='padding:0;Margin:0;'>
            //                     <table class='es-content-body' width='600' cellspacing='0' cellpadding='0' bgcolor='#ffffff'
            //                     align='center'
            //                     style=border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;'>
            //                     <tr style='border-collapse:collapse;'>
            //                         <td align='left' style='padding:0;Margin:0;padding-top:15px;padding-left:35px;padding-right:35px;'>
            //                         <table width='100%' cellspacing='0' cellpadding='0'
            //                             style=border-collapse:collapse;border-spacing:0px;'>
            //                             <tr style='border-collapse:collapse;'>
            //                             <td width='530' valign='top' align='center' style='padding:0;Margin:0;'>
            //                                 <table width='100%' cellspacing='0' cellpadding='0'
            //                                 style=border-collapse:collapse;border-spacing:0px;'>
            //                                 <tr style='border-collapse:collapse;'>
            //                                     <td align='center' style='padding:0;Margin:0;'> <img
            //                                         src='https://znwvz.stripocdn.email/content/guids/CABINET_75694a6fc3c4633b3ee8e3c750851c02/images/18501522065897895.png'
            //                                         alt
            //                                         style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;'
            //                                         width='46' height='22'></td>
            //                                 </tr>
            //                                 </table>
            //                             </td>
            //                             </tr>
            //                         </table>
            //                         </td>
            //                     </tr>
            //                     </table>
            //                 </td>
            //                 </tr>
            //             </table>
            //             <table class='es-content' cellspacing='0' cellpadding='0' align='center'
            //                 style=border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;'>
            //                 <tr style='border-collapse:collapse;'>
            //                 <td align='center' style='padding:0;Margin:0;'>
            //                     <table class='es-content-body'
            //                     style=border-collapse:collapse;border-spacing:0px;background-color:#1B9BA3;border-bottom:10px solid #48AFB5;'
            //                     width='600' cellspacing='0' cellpadding='0' bgcolor='#1b9ba3' align='center'>
            //                     <tr style='border-collapse:collapse;'>
            //                         <td align='left' style='padding:0;Margin:0;'>
            //                         <table width='100%' cellspacing='0' cellpadding='0'
            //                             style=border-collapse:collapse;border-spacing:0px;'>
            //                             <tr style='border-collapse:collapse;'>
            //                             <td width='600' valign='top' align='center' style='padding:0;Margin:0;'>
            //                                 <table width='100%' cellspacing='0' cellpadding='0'
            //                                 style=border-collapse:collapse;border-spacing:0px;'>
            //                                 <tr style='border-collapse:collapse;'>
            //                                     <td style='padding:0;Margin:0;'>
            //                                     <table class='es-menu' width='40%' cellspacing='0' cellpadding='0' align='center'
            //                                         style=border-collapse:collapse;border-spacing:0px;'>
            //                                         <tr class='images' style='border-collapse:collapse;'>
            //                                         <td
            //                                             style='Margin:0;padding-left:5px;padding-right:5px;padding-top:35px;padding-bottom:30px;border:0;'
            //                                             id='esd-menu-id-2' width='100.00%' valign='top' bgcolor='transparent'
            //                                             align='center'> <a target='_blank'
            //                                             style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:'
            //                                             open sans', 'helvetica neue' , helvetica, arial,
            //                                             sans-serif;font-size:20px;text-decoration:none;display:block;color:#FFFFFF;'
            //                                             href='https://viewstripo.email/'><img
            //                                                 src='https://znwvz.stripocdn.email/content/guids/cab_pub_7cbbc409ec990f19c78c75bd1e06f215/images/Messaging_More_Ellipsis.png'
            //                                                 alt='re' title='re' height='27' width='27'
            //                                                 style='display:inline !important;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;'></a>
            //                                         </td>
            //                                         </tr>
            //                                     </table>
            //                                     </td>
            //                                 </tr>
            //                                 </table>
            //                             </td>
            //                             </tr>
            //                         </table>
            //                         </td>
            //                     </tr>
            //                     </table>
            //                 </td>
            //                 </tr>
            //             </table>
            //             <table class='es-footer' cellspacing='0' cellpadding='0' align='center'
            //                 style=border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;'>
            //                 <tr style='border-collapse:collapse;'>
            //                 <td align='center' style='padding:0;Margin:0;'>
            //                     <table class='es-footer-body'
            //                     style=border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;border-top:10px solid #48AFB5;'
            //                     width='600' cellspacing='0' cellpadding='0' align='center'>
            //                     <tr style='border-collapse:collapse;'>
            //                         <td align='left'
            //                         style='Margin:0;padding-top:35px;padding-left:35px;padding-right:35px;padding-bottom:40px;'>
            //                         <table width='100%' cellspacing='0' cellpadding='0'
            //                             style=border-collapse:collapse;border-spacing:0px;'>
            //                             <tr style='border-collapse:collapse;'>
            //                             <td width='530' valign='top' align='center' style='padding:0;Margin:0;'>
            //                                 <table width='100%' cellspacing='0' cellpadding='0'
            //                                 style=border-collapse:collapse;border-spacing:0px;'>
            //                                 <tr style='border-collapse:collapse;'>
            //                                     <td align='center' style='padding:0;Margin:0;padding-bottom:15px;'> <img
            //                                         src='https://znwvz.stripocdn.email/content/guids/CABINET_75694a6fc3c4633b3ee8e3c750851c02/images/12331522050090454.png'
            //                                         alt='Beretun logo'
            //                                         style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;'
            //                                         title='Beretun logo' width='37' height='37'></td>
            //                                 </tr>
            //                                 <tr style='border-collapse:collapse;'>
            //                                     <td align='center' style='padding:0;Margin:0;padding-bottom:35px;'>
            //                                     <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:'
            //                                         open sans', 'helvetica neue' , helvetica, arial,
            //                                         sans-serif;line-height:21px;color:#333333;'><strong>675 Massachusetts Avenue
            //                                         </strong></p>
            //                                     <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:'
            //                                         open sans', 'helvetica neue' , helvetica, arial,
            //                                         sans-serif;line-height:21px;color:#333333;'><strong>Cambridge, MA 02139</strong></p>
            //                                     </td>
            //                                 </tr>
            //                                 <tr style='border-collapse:collapse;'>
            //                                     <td class='es-m-txt-c' esdev-links-color='#777777' align='left'
            //                                     style='padding:0;Margin:0;padding-bottom:5px;'>
            //                                     <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:'
            //                                         open sans', 'helvetica neue' , helvetica, arial,
            //                                         sans-serif;line-height:21px;color:#777777;'>If you didn't create an account using
            //                                         this email address, please ignore this email or&nbsp;<u><a target='_blank'
            //                                             style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:'
            //                                             open sans', 'helvetica neue' , helvetica, arial,
            //                                             sans-serif;font-size:14px;text-decoration:none;color:#777777;'
            //                                             href>unsubscribe</a></u>.</p>
            //                                     </td>
            //                                 </tr>
            //                                 </table>
            //                             </td>
            //                             </tr>
            //                         </table>
            //                         </td>
            //                     </tr>
            //                     </table>
            //                 </td>
            //                 </tr>
            //             </table>
            //             <table class='es-content' cellspacing='0' cellpadding='0' align='center'
            //                 style=border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;'>
            //                 <tr style='border-collapse:collapse;'>
            //                 <td align='center' style='padding:0;Margin:0;'>
            //                     <table class='es-content-body'
            //                     style=border-collapse:collapse;border-spacing:0px;background-color:transparent;'
            //                     width='600' cellspacing='0' cellpadding='0' align='center'>
            //                     <tr style='border-collapse:collapse;'>
            //                         <td align='left'
            //                         style='Margin:0;padding-left:20px;padding-right:20px;padding-top:30px;padding-bottom:30px;'>
            //                         <table width='100%' cellspacing='0' cellpadding='0'
            //                             style=border-collapse:collapse;border-spacing:0px;'>
            //                             <tr style='border-collapse:collapse;'>
            //                             <td width='560' valign='top' align='center' style='padding:0;Margin:0;'>
            //                                 <table width='100%' cellspacing='0' cellpadding='0'
            //                                 style=border-collapse:collapse;border-spacing:0px;'>
            //                                 <tr style='border-collapse:collapse;'>
            //                                     <td class='es-infoblock' align='center'
            //                                     style='padding:0;Margin:0;line-height:14px;font-size:12px;color:#CCCCCC;'> <a
            //                                         target='_blank'
            //                                         href='http://viewstripo.email/?utm_source=templates&utm_medium=email&utm_campaign=accessory&utm_content=trigger_newsletter4'
            //                                         style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:'
            //                                         open sans', 'helvetica neue' , helvetica, arial,
            //                                         sans-serif;font-size:12px;text-decoration:none;color:#CCCCCC;'> <img
            //                                         src='https://znwvz.stripocdn.email/content/guids/CABINET_9df86e5b6c53dd0319931e2447ed854b/images/64951510234941531.png'
            //                                         alt width='125' height='56'
            //                                         style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;'>
            //                                     </a> </td>
            //                                 </tr>
            //                                 </table>
            //                             </td>
            //                             </tr>
            //                         </table>
            //                         </td>
            //                     </tr>
            //                     </table>
            //                 </td>
            //                 </tr>
            //             </table>
            //             </td>
            //         </tr>
            //         </table>
            //     </div>
            //     </body>

            //     </html>";

            // $mail->Body = $msg;
            // $mail->IsHTML(true); //enviar em HTML

            // //send the message, check for errors
            // if (!$mail->send()) {
            //     echo "ERROR: " . $mail->ErrorInfo;
            // }
      
            return 'success';
		} 
        return 'Falha ao finalizar a RNC';
	}

} // model