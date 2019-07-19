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
            // $filter = ""; $_POST['checkbox'];
            // $filter = " AND status != 3";
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
                $query = $this->db->query('SELECT nome FROM usuarios WHERE id = ?', [$d]);
				$result = $query->fetch(PDO::FETCH_COLUMN, 0);

                return $result;
            }],
            ['dt' => 2, 'db' => 'id_destino', 'formatter' => function($d) 
            {
                $query = $this->db->query('SELECT nome FROM usuarios WHERE id = ?', [$d]);
				$result = $query->fetch(PDO::FETCH_COLUMN, 0);

                return $result;
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
                $query = $this->db->query('SELECT status FROM rnc WHERE id = ?', array($d));
                $status = $query->fetch(PDO::FETCH_COLUMN, 0);
                
                ob_start(); ?>
                    <div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Mais <span class="caret"></span> </button>
                        <ul class="dropdown-menu dropdown-menu-right">
							<?php if ($this->controller->check_permissions('sacp', 'inserir', $this->userdata['user_permissions'])) { ?>
                                <li>
                                    <a href="<?= HOME_URI ?>/sacp/gerarSACPdeRNC/<?= $d ?>"><i class="fa fa-copy"></i> Gerar SACP</a>
                                </li>
                            <?php } ?>
                            <?php if ($this->userdata['tipo_usuario'] == 3) { if ($status != 3) { ?>
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
                            <?php } else { ?>
                                <li>
                                    <a href="<?= HOME_URI ?>/rnc/visualizar/<?= $d ?>"><i class="fa fa-eye"></i> Visualizar</a>
                                </li>
                            <?php } } else { ?>
                                <li>
                                    <a href="<?= HOME_URI ?>/rnc/visualizar/<?= $d ?>"><i class="fa fa-eye"></i> Visualizar</a>
                                </li>
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
                            <?php } ?>
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

	public function importarAJAX()
	{	

		/* Verifica se algo foi postado e se está vindo do form que tem o campo
		inserirRNC. */
		if ('POST' != $_SERVER['REQUEST_METHOD'] || empty($_POST['inserirRNC'])) {
			return;
		}

		$arquivo 	= $_FILES["file"]["tmp_name"];
        $nome 		= $_FILES["file"]["name"];
        $tamanho 	= $_FILES["file"]["size"];

        $fp = fopen($arquivo,"rb");//Abro o arquivo que está no $temp   
    	$documento = fread($fp, $tamanho);//Leio o binario do arquivo
    	fclose($fp);//fecho o arquivo

		$dados = bin2hex($documento);

		$dataGerada = new DateTime('now');
		$dataGerada = $dataGerada->format('Y-m-d H:i:s');

		$_POST = array(
			'nome' 		=> $nome,
			'tamanho'	=> $tamanho,
			'conteúdo'	=> $dados,
			'data'		=> $dataGerada,
		);

		print_r($arquivo);

		$query = $this->db->insert('arquivos', $_POST);

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
		return $b['nome'] <= $a['nome'];
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
		inserirRNC. */
		if ('POST' != $_SERVER['REQUEST_METHOD'] || empty($_POST['inserirRNC'])) {
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
	
		/* query */
        $query = $this->db->insert('rnc', $_POST);
        $id = $this->db->last_id;
		
		/* Verifica a consulta */
		if ($query) {

			//chama a classe para enviar e-mail
			require ABSPATH . '/PHPMailer/PHPMailer.php';
			require ABSPATH . '/PHPMailer/SMTP.php';
			$url= HOME_URI;

			//traz os dados para o e-mail
			$query = $this->db->query('SELECT * FROM rnc WHERE id = ?', [$id]);
			while ($valor = $query->fetch(PDO::FETCH_ASSOC)) {
				$descricao		= $valor['descricao'];
				$gerada 		= date('d/m/Y - H:i', strtotime($valor['data_gerada']));
				$numeroOp		= $valor['numero_op'];
			}

			//traz os dados do usuário origem para o e-mail
			$query = $this->db->query('SELECT nome, email FROM usuarios WHERE id = ?', [$_POST['id_origem']]);
			while ($valor = $query->fetch(PDO::FETCH_ASSOC)) {
				$userOrigem		= $valor['nome'];
				$emailOrigem	= $valor['email'];
			}

			//traz os dados do usuário destino para o e-mail
			$query = $this->db->query('SELECT nome, email FROM usuarios WHERE id = ?', [$_POST['id_destino']]);
			while ($valor = $query->fetch(PDO::FETCH_ASSOC)) {
				$userDestino		= $valor['nome'];
				$emailDestino		= $valor['email'];
			}

			$mail = new PHPMailer;
			$mail->isSMTP();
			//$mail->SMTPSecure = 'ssl';
			//$mail->SMTPAuth = true;
			$mail->Host = 'nac.edelbra.com.br';
			$mail->Port = 587;
			$mail->Username = 'manutencao@edelbra.com.br';
			$mail->Password = 'man@2015!';
			$mail->setFrom('manutencao@edelbra.com.br');
			$mail->addAddress('renato.dambros@edelbra.com.br'); //email teste DEV
			//$mail->addAddress('e-mail para administradores'); 
			//$mail->addAddress('e-mail para Qualidade');
			$mail->addAddress($emailOrigem);
			$mail->addAddress($emailDestino);
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\logofull.png', 'logo', 'logofull.png');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\relat1.png', 'relat1', 'relat1.png');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\acessar.png', 'acessar', 'acessar.png');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\linha.png', 'linha', 'linha.png');
			$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)
			$mail->Subject = 'RNC Novo';
			$msg =
				"<html dir='ltr'>
					<head>
					<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
						<style>                   
							#customers {
							font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif;
							border-collapse: collapse;
							width: 100%;
							}
							#customers td, #customers th {
							border: 1px solid #C0C0C0;
							border-radius: 5px; 5px; 0px; 0px;
							padding: 8px;
							background-color: #E8E8E8;
							}
							#customers tr:nth-child(even){background-color: #E8E8E8;}
							#customers th {
							padding: 8px;
							text-align: center;
							background-color: #DAA520;
							color: white;
							display: inline-block;
							}
							body {background-color: gray;
							}
						</style>
					</head>

				<body align-self: center;>
				<hr>
				<br>
					<table id='customers'>
							<tr>
								<th style='background-color: white; padding: 20px;' colspan='3'>
									<img src='cid:logofull.png' align=center width='350' height='130'></<img></th>
								<th style='background-color: white; colspan='1' >
									<img src='cid:relat1.png' align=center width='90' height='130'></p></th>
							</tr>
							<tr>
								<th colspan='3' >Relatório de Não-Conformidade</th>
								<th colspan='1' >ID $id </th>						
							</tr>
							<tr>
								<td colspan='4' style='background-color: white; color: blue;'><p align=center><b> ----> NOVO <---- </b></p></td>
							</tr>
							<tr>
								<td colspan='4'><b>Origem:</b> $userOrigem </td>
							</tr>
							<tr>
								<td colspan='4' style='background-color: white;'><b>Destino:</b> $userDestino </td>
							</tr>
							<tr>
								<td colspan='4'><b>Número O.P:</b> $numeroOp </td>
							</tr>
							<tr>
								<td colspan='4' style='background-color: white;'><b>Data Gerada:</b> $gerada </td>
							</tr>
							<tr rowspan='4'>
								<td colspan='4'><b>Descrição:</b> $descricao </td>
							</tr>
							<tr rowspan='4'>
								<td colspan='4' style='background-color: white; color: white;'><b>Justificativa:</b>  </td>
							</tr>
							<br>
							<br>
							<br>
							<br>
								<p align=center> <a href='$url/rnc/editar/$id'> 
								<img src='cid:acessar.png' width='170' height='50'></a>
								</p>
								<p align=center> 
								<img src='cid:linha.png' width='600' height='4'>
								</p>
					</table>
				<br>			
				<hr>
				<br>
				</body>
			</html>";
			$mail->Body = $msg;
            $mail->IsHTML(true); //enviar em HTML

            //send the message, check for errors
            $mail->send();
				
			return 'success';
		}
		return 'Erro ao inserir RNC no banco de dados';
	} // insert

	
	public function editarRNC($id) 
	{
		/* Verifica se algo foi postado e se está vindo do form que tem o campo
		editarRNC. */
		if ('POST' != $_SERVER['REQUEST_METHOD'] || empty($_POST['editarRNC'])) {
			return;
		}

		/* Remove o campo editarRNC para não gerar problema com o PDO */
		unset($_POST['editarRNC']);

        // Checa se o campo numero_op está vazio, caso esteja, seta pra null
        if (isset($_POST['numero_op']) 
            && empty($_POST['numero_op'])) {
                $_POST['numero_op'] = null;
        }

		// if (empty($_POST['numero_op'])) {
		// 	$_POST['numero_op'] = null;
		// }

		/* Atualiza os dados */
		$query = $this->db->update('rnc', 'id', $id, $_POST);
		
		/* Verifica a consulta */
		if ($query) { 
			//chama a classe para enviar e-mail
			require ABSPATH . '/PHPMailer/PHPMailer.php';
			require ABSPATH . '/PHPMailer/SMTP.php';
			$url= HOME_URI;

			//traz os dados para o e-mail
			$query = $this->db->query('SELECT * FROM rnc WHERE id = ?', [$id]);
			while ($valor = $query->fetch(PDO::FETCH_ASSOC)) {
				$descricao		= $valor['descricao'];
				$justificativa 	= $valor['justificativa'];
				$correcao		= $valor['correcao'];
				$gerada 		= date('d/m/Y H:i', strtotime($valor['data_gerada']));
				$numeroOp		= $valor['numero_op'];
			}

			//traz os dados do usuário origem para o e-mail
			$query = $this->db->query('SELECT * FROM rnc WHERE id = ?', [$id]);
			$rnc = $query->fetch(PDO::FETCH_ASSOC);	

			$query = $this->db->query('SELECT nome, email FROM usuarios WHERE id = ?', [$rnc['id_origem']]);
			while ($valor = $query->fetch(PDO::FETCH_ASSOC)) {
				$userOrigem		= $valor['nome'];
				$emailOrigem	= $valor['email'];
			}
			
			//traz os dados do usuário destino para o e-mail
			$query = $this->db->query('SELECT nome, email FROM usuarios WHERE id = ?', [$rnc['id_destino']]);
			while ($valor = $query->fetch(PDO::FETCH_ASSOC)) {
				$userDestino		= $valor['nome'];
				$emailDestino		= $valor['email'];
			}

			$mail = new PHPMailer;
			$mail->isSMTP();
			//$mail->SMTPSecure = 'ssl';
			//$mail->SMTPAuth = true;
			$mail->Host = 'nac.edelbra.com.br';
			$mail->Port = 587;
			$mail->Username = 'manutencao@edelbra.com.br';
			$mail->Password = 'man@2015!';
			$mail->setFrom('manutencao@edelbra.com.br');
			$mail->addAddress('renato.dambros@edelbra.com.br'); //email teste DEV
			//$mail->addAddress('e-mail para administradores'); 
			//$mail->addAddress('e-mail para Qualidade');
			$mail->addAddress($emailOrigem);
			$mail->addAddress($emailDestino);
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\logofull.png', 'logo', 'logofull.png');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\relat1.png', 'relat1', 'relat1.png');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\acessar.png', 'acessar', 'acessar.png');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\linha.png', 'linha', 'linha.png');
			$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)
			$mail->Subject = 'RNC Editado';
			$msg =
				"<html dir='ltr'>
					<head>
					<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
						<style>                   
							#customers {
							font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif;
							border-collapse: collapse;
							width: 100%;
							}
							#customers td, #customers th {
							border: 1px solid #C0C0C0;
							border-radius: 5px; 5px; 0px; 0px;
							padding: 8px;
							background-color: #E8E8E8;
							}
							#customers tr:nth-child(even){background-color: #E8E8E8;}
							#customers th {
							padding: 8px;
							text-align: center;
							background-color: #DAA520;
							color: white;
							display: inline-block;
							}
							body {background-color: gray;
							}
						</style>
					</head>

				<body align-self: center;>
				<hr>
				<br>
					<table id='customers'>
							<tr>
								<th style='background-color: white; padding: 20px;' colspan='3'>
									<img src='cid:logofull.png' align=center width='350' height='130'></<img></th>
								<th style='background-color: white; colspan='1' >
									<img src='cid:relat1.png' align=center width='90' height='130'></p></th>
							</tr>
							<tr>
								<th colspan='3' >Relatório de Não-Conformidade</th>
								<th colspan='1' >ID $id </th>						
							</tr>
							<tr>
								<td colspan='4' style='background-color: white; color: #DAA520;'><p align=center><b> ----> ALTERADO <---- </b></p></td>
							</tr>
							<tr>
								<td colspan='4'><b>Origem:</b> $userOrigem </td>
							</tr>
							<tr>
								<td colspan='4' style='background-color: white;'><b>Destino:</b> $userDestino </td>
							</tr>
							<tr>
								<td colspan='4'><b>Número O.P:</b> $numeroOp </td>
							</tr>
							<tr>
								<td colspan='4' style='background-color: white;'><b>Data Gerada:</b> $gerada </td>
							</tr>
							<tr rowspan='4'>
								<td colspan='4'><b>Descrição:</b> $descricao </td>
							</tr>
							<tr rowspan='4'>
								<td colspan='4' style='background-color: white;' ><b>Justificativa:</b> $justificativa </td>
							</tr>
							<tr rowspan='4'>
								<td colspan='4'><b>Correção:</b> $correcao </td>								
							</tr>
							<br>
							<br>
							<br>
							<br>
								<p align=center> <a href='$url/rnc/inserir/'> 
								<img src='cid:acessar.png' width='170' height='50'></a>
								</p>
								<p align=center> 
								<img src='cid:linha.png' width='600' height='4'>
								</p>
					</table>
				<br>
				<hr>
				<br>
				</body>
			</html>";

			$mail->Body = $msg;
            $mail->IsHTML(true); //enviar em HTML

            //send the message, check for errors
			$mail->send();
			
      		return 'success';
		}
		return 'Falha ao atualizar RNC';
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

		// Configura o ID RNC
		$user_id = (int)chk_array($this->parametros, 0);

		// Executa a consulta
        $query = $this->db->delete('rnc', 'id', $user_id);
        $id = $this->db->last_id;
        
         if ($query) {
            require ABSPATH . '/PHPMailer/PHPMailer.php';
			require ABSPATH . '/PHPMailer/SMTP.php';
			$url= HOME_URI;
			
			$mail = new PHPMailer;
            $mail->isSMTP();
            //$mail->SMTPSecure = 'ssl';
            //$mail->SMTPAuth = true;
            $mail->Host = 'nac.edelbra.com.br';
            $mail->Port = 587;
            $mail->Username = 'manutencao@edelbra.com.br';
            $mail->Password = 'man@2015!';
            $mail->setFrom('manutencao@edelbra.com.br');
			$mail->addAddress('renato.dambros@edelbra.com.br'); //email teste DEV
			//$mail->addAddress('e-mail para administradores'); 
			//$mail->addAddress('e-mail para Qualidade');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\logofull.png', 'logo', 'logofull.png');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\relat1.png', 'relat1', 'relat1.png');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\acessar.png', 'acessar', 'acessar.png');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\linha.png', 'linha', 'linha.png');
            $mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)
            $mail->Subject = 'RNC Excluída';
			$msg = "<html dir='ltr'>
				<head>
					<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
						<style>                   
							#customers {
							font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif;
							border-collapse: collapse;
							width: 100%;
							}
							#customers td, #customers th {
							border: 1px solid #C0C0C0;
							border-radius: 5px; 5px; 0px; 0px;
							padding: 8px;
							background-color: #E8E8E8;
							}
							#customers tr:nth-child(even){background-color: #E8E8E8;}
							#customers th {
							padding: 8px;
							text-align: center;
							background-color: #DAA520;
							color: white;
							display: inline-block;
							}
							body {background-color: gray;
							}
						</style>
				</head>

				<body align-self: center;>
				<hr>
				<br>
					<table id='customers'>
							<tr>
								<th style='background-color: white; padding: 20px;' colspan='3'>
									<img src='cid:logofull.png' align=center width='350' height='130'></<img></th>
								<th style='background-color: white; colspan='1' >
									<img src='cid:relat1.png' align=center width='90' height='130'></p></th>
							</tr>
							<tr>
								<th colspan='3' >Relatório de Não-Conformidade</th>
								<th colspan='1' >ID $user_id </th>						
							</tr>
							<tr>
								<td colspan='4' style='background-color: white; color: red;'><p align=center><b>----> EXCUÍDO <---- </b></p></td>
							</tr>
							<tr rowspan='4'>
								<td colspan='4' style='color: #E8E8E8;'><b>Justificativa:</b>  </td>
							<br>
							<br>
							<br>
							<br>
								<p align=center> <a href='$url/rnc/'> 
								<img src='cid:acessar.png' width='170' height='50'></a>
								</p>
								<p align=center> 
								<img src='cid:linha.png' width='600' height='4'>
								</p>
					</table>
				<br>
				<hr>
				<br>
				</body>
			</html>";

			$mail->Body = $msg;
			$mail->IsHTML(true); //enviar em HTML
			
			//send the message, check for errors
			$mail->send();
						
			//retorna para o painel de visualização
			echo '<meta http-equiv="Refresh" content="0; url=' . HOME_URI . '/rnc/">';
			echo '<script type="text/javascript">window.location.href = "' . HOME_URI . '/rnc/";</script>';
		}		
		return 'Falha ao excluir a RNC';
	} // delete


	public function finalizarRNC($id) 
	{
		/* Verifica se algo foi postado e se está vindo do form que tem o campo
		finalizarRNC. */
		if ('POST' != $_SERVER['REQUEST_METHOD'] || empty($_POST['finalizarRNC'])) {
			return;
		}

		/* Remove o campo finalizarRNC para não gerar problema com o PDO */
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
            require ABSPATH . '/PHPMailer/PHPMailer.php';
			require ABSPATH . '/PHPMailer/SMTP.php';
			$url= HOME_URI;

		//traz os dados para o e-mail
		$query = $this->db->query('SELECT * FROM rnc WHERE id = ?', [$id]);
			while ($valor = ($rnc = $query->fetch(PDO::FETCH_ASSOC))) {
				$descricao		= $valor['descricao'];
				$justificativa 	= $valor['justificativa'];
				$correcao		= $valor['correcao'];
				$gerada 		= date('d/m/Y - H:i', strtotime($valor['data_gerada']));
				$finalizada		= date('d/m/Y - H:i', strtotime($valor['data_finalizada']));
				$numeroOp		= $valor['numero_op'];
			}

		$query = $this->db->query('SELECT * FROM rnc WHERE id = ?', [$id]);
		$rnc = $query->fetch(PDO::FETCH_ASSOC);

		//traz os dados do usuário origem para o e-mail
			$query = $this->db->query('SELECT * FROM rnc WHERE id = ?', [$id]);
			$rnc = $query->fetch(PDO::FETCH_ASSOC);	

			$query = $this->db->query('SELECT nome, email FROM usuarios WHERE id = ?', [$rnc['id_origem']]);
			while ($valor = $query->fetch(PDO::FETCH_ASSOC)) {
				$userOrigem		= $valor['nome'];
				$emailOrigem	= $valor['email'];
			}
			
			//traz os dados do usuário destino para o e-mail
			$query = $this->db->query('SELECT nome, email FROM usuarios WHERE id = ?', [$rnc['id_destino']]);
			while ($valor = $query->fetch(PDO::FETCH_ASSOC)) {
				$userDestino		= $valor['nome'];
				$emailDestino		= $valor['email'];
			}

			$mail = new PHPMailer;
            $mail->isSMTP();
            //$mail->SMTPSecure = 'ssl';
            //$mail->SMTPAuth = true;
            $mail->Host = 'nac.edelbra.com.br';
            $mail->Port = 587;
            $mail->Username = 'manutencao@edelbra.com.br';
            $mail->Password = 'man@2015!';
            $mail->setFrom('manutencao@edelbra.com.br');
			$mail->addAddress('renato.dambros@edelbra.com.br'); //email teste DEV
			//$mail->addAddress('e-mail para administradores'); 
			//$mail->addAddress('e-mail para Qualidade');
			$mail->addAddress($emailOrigem);
			$mail->addAddress($emailDestino);
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\logofull.png', 'logo', 'logofull.png');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\relat1.png', 'relat1', 'relat1.png');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\acessar.png', 'acessar', 'acessar.png');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\linha.png', 'linha', 'linha.png');
            $mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)
            $mail->Subject = 'RNC Finalizada';
			$msg =
			"<html dir='ltr'>
				<head>
					<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
						<style>                   
							#customers {
							font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif;
							border-collapse: collapse;
							width: 100%;
							}
							#customers td, #customers th {
							border: 1px solid #C0C0C0;
							border-radius: 5px; 5px; 0px; 0px;
							padding: 8px;
							background-color: #E8E8E8;
							}
							#customers tr:nth-child(even){background-color: #E8E8E8;}
							#customers th {
							padding: 8px;
							text-align: center;
							background-color: #DAA520;
							color: white;
							display: inline-block;
							}
							body {background-color: gray;
							}
						</style>
				</head>

				<body align-self: center;>
				<hr>
				<br>
					<table id='customers'>
							<tr>
								<th style='background-color: white; padding: 20px;' colspan='3'>
									<img src='cid:logofull.png' align=center width='350' height='130'></<img></th>
								<th style='background-color: white; colspan='1' >
									<img src='cid:relat1.png' align=center width='90' height='130'></p></th>
							</tr>
							<tr>
								<th colspan='3' >Relatório de Não-Conformidade</th>
								<th colspan='1' >ID $id </th>						
							</tr>
							<tr>
								<td colspan='4' style='background-color: white; color: green;'><p align=center><b> ----> FINALIZADO <---- </b></p></td>
							</tr>
							<tr>
								<td colspan='4'><b>Origem:</b> $userOrigem </td>
							</tr>
							<tr>
								<td colspan='4' style='background-color: white;'><b>Destino:</b>  $userDestino </td>
							</tr>
							<tr>
								<td colspan='4'><b>Número O.P:</b> $numeroOp </td>
							</tr>
							<tr>
								<td colspan='4' style='background-color: white;'><b>Data Gerada:</b> $gerada </td>
							</tr>
							<tr>
								<td colspan='4'><b>Data Finalizada:</b> $finalizada </td>
							</tr>
							<tr rowspan='4'>
								<td colspan='4' style='background-color: white;'><b>Descrição:</b> $descricao </td>
							</tr>
							<tr rowspan='4'>
								<td colspan='4'><b>Justificativa:</b> $justificativa </td>
							</tr>
							<tr rowspan='4'>
								<td colspan='4' style='background-color: white;'><b>Correção:</b> $correcao </td>								
							</tr>
							<br>
							<br>
							<br>
							<br>
								<p align=center> <a href='$url/rnc/inserir/'> 
								<img src='cid:acessar.png' width='170' height='50'></a>
								</p>
								<p align=center> 
								<img src='cid:linha.png' width='600' height='4'>
								</p>
					</table>
				<br>
				<hr>
				<br>
				</body>
			</html>";

			$mail->Body = $msg;
            $mail->IsHTML(true); //enviar em HTML

            //send the message, check for errors
			$mail->send();
			
            return 'success';
		} 
        return 'Falha ao finalizar a RNC';
	}

} // model