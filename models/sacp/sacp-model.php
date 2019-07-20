<?php
class SacpModel extends MainModel
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
		if (!empty($_POST['dataFilter'])) {
            $dataSelected = $_POST['dataFilter'];
        }

        if (!empty($_POST['dataMin'])) {
            $dataMin = $_POST['dataMin'];
        }

        if (!empty($_POST['dataMax'])) {
            $dataMax = $_POST['dataMax'];
		}

        if ($this->userdata['tipo_usuario'] == 3) {
			// usuario comum
			$query = $this->db->query('SELECT id_sacp FROM sacp_participantes WHERE id_participante = ?', array($this->userdata['id']));
			$sacpPresente = $query->fetchAll(PDO::FETCH_COLUMN, 0);

			$sacpPresente = implode(",", $sacpPresente);

			if (empty($sacpPresente)) {
				$sacpPresente = 0;
			}

			$sql = 'SELECT * FROM sacp_dados_fk';
			$where = "id IN ($sacpPresente)";

			if (!empty($_POST['dataMin']) && !empty($_POST['dataMax'])) {
                $where .= " AND $dataSelected BETWEEN '$dataMin' AND '$dataMax'";
            }

			$columns = $this->formatar_colunas();
			$page = DataTable::complex($_POST, $this->db->pdo, 'sacp_dados_fk', 'id', $columns, $sql, null, $where);
		} else {
			// admin-qualidade
			$sql = 'SELECT * FROM sacp_dados_fk';

			if (!empty($_POST['dataMin']) && !empty($_POST['dataMax'])) {
                $where = "$dataSelected BETWEEN '$dataMin' AND '$dataMax'";
            } else {
                $where = null;
            }

			$columns = $this->formatar_colunas();
			$page = DataTable::complex($_POST, $this->db->pdo, 'sacp_dados_fk', 'id', $columns, $sql, null, $where);
		}

        return json_encode($page);
	}


    private function formatar_colunas()
    {
        return array(
            ['dt' => 0, 'db' => 'id'],
            ['dt' => 1, 'db' => 'setor_origem'],
            ['dt' => 2, 'db' => 'setor_destino'],
            ['dt' => 3, 'db' => 'status', 'formatter' => function($d)
            {
                $return = "<span class='label label-";

                if ($d == 'Novo') {
					$return .= "primary";
				} elseif ($d == 'Em progresso') {
					$return .= "warning";
				} elseif ($d == 'Finalizado') {
					$return .= "success";
				} else {
					$return .= "default";
                }
                $return .= "'>$d</span>";

                return $return;
            }],
			['dt' => 4, 'db' => 'numero_op', 'formatter' => function($d)
            {
				if (!empty($d)) {
					return $d;
				}
				return 'Não';
			}],
			['dt' => 5, 'db' => 'id_rnc', 'formatter' => function($d)
            {
				if (!empty($d)) {
					return $d;
				}
				return 'Não';
			}],
			['dt' => 6, 'db' => 'data_gerada', 'formatter' => function($d)
            {
				if ($d !== null) {
					$data = new DateTime($d);
					return $data->format('d/m/Y');
				}
				return "";
			}],
			['dt' => 7, 'db' => 'data_prazo', 'formatter' => function($d)
            {
				if ($d !== null) {
					$data = new DateTime($d);
					return $data->format('d/m/Y');
				}
				return "";
            }],
			['dt' => 8, 'db' => 'data_finalizada', 'formatter' => function($d)
            {
				if ($d !== null) {
					$data = new DateTime($d);
					return $data->format('d/m/Y');
				}
				return "";
            }],
            ['dt' => 9, 'db' => 'id', 'formatter' => function($d)
            {
				$query = $this->db->query('SELECT status FROM sacp WHERE id = ?', array($d));
				$status = $query->fetch(PDO::FETCH_COLUMN, 0);

                ob_start(); ?>
                    <div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Mais <span class="caret"></span> </button>
                        <ul class="dropdown-menu dropdown-menu-right">
								<?php if ($this->userdata['tipo_usuario'] == 3) { if ($status != 3) { ?>
									<li>
										<a href="<?= HOME_URI ?>/sacp/editar/<?= $d ?>"><i class="fa fa-edit"></i> Editar</a>
									</li>
								<?php } else { ?>
									<li>
										<a href="<?= HOME_URI ?>/sacp/visualizar/<?= $d ?>"><i class="fa fa-eye"></i> Visualizar</a>
									</li>
								<?php } } else { ?>
									<li>
										<a href="<?= HOME_URI ?>/sacp/editar/<?= $d ?>"><i class="fa fa-edit"></i> Editar</a>
									</li>
								<?php } ?>
								<?php if ($this->controller->check_permissions('sacp', 'editar', $this->userdata['user_permissions'])) { ?>
									<li>
										<a href="<?= HOME_URI ?>/sacp/finalizar/<?= $d ?>"><i class="fa fa-check"></i> Finalizar</a>
									</li>
								<?php } ?>
								<?php if ($this->controller->check_permissions('sacp', 'editar', $this->userdata['user_permissions'])) { ?>
									<li>
										<a href="<?= HOME_URI ?>/sacp/avaliar/<?= $d ?>"><i class="fa fa-check"></i> Avaliar</a>
									</li>
								<?php } ?>
								<?php if ($this->controller->check_permissions('sacp', 'excluir', $this->userdata['user_permissions'])) { ?>
									<li>
										<a href="<?= HOME_URI ?>/sacp/excluir/<?= $d ?>/"><i class="fa fa-remove"></i> Excluir</a>
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


	public function listaSetores()
	{
		// Busca os setores
		$query = $this->db->query('SELECT id, nome FROM setores ORDER BY nome ASC');
		$setores = $query->fetchAll(PDO::FETCH_ASSOC);
		return $setores;
	}


	public function consultaSetor($id)
	{
		// Busca o nome do setor individual
		$query = $this->db->query('SELECT id, nome FROM setores WHERE id = ?', array($id));
		$setor = $query->fetch(PDO::FETCH_ASSOC);
		return $setor;
	}


	public function avaliaSACP($id)
	{
		/* Verifica se algo foi postado e se está vindo do form que tem o campo
		inserirSACP. */
		if ('POST' != $_SERVER['REQUEST_METHOD'] || empty($_POST['inserirAvaliacao'])) {
			return;
		}

		/* Remove o campo inserirSACP para não gerar problema com o PDO */
		unset($_POST['inserirAvaliacao']);

		$query = $this->db->update(
			'sacp',
			'id',
			$id[0],
			array('avaliacao' => $_POST['avaliacao'])
		);
		if ($query) {
			return 'success';
		}
		return 'Falha ao inserir avaliação';
	}


	public function retornaAvaliacao($id)
	{
		$query = $this->db->query(
			'SELECT avaliacao FROM sacp WHERE id = ?',
			array($id[0])
		);
		return $query->fetch(PDO::FETCH_COLUMN, 0);
	}


    public function listarUsuarios()
	{
		// Busca os usuários fora o admin
		$query = $this->db->query('SELECT * FROM usuarios WHERE tipo_usuario != 1');
		$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

		foreach ($usuarios as $key => $usuario) {
			$query = $this->db->query('SELECT * FROM setores WHERE id = ?', [$usuario['setor']]);
			$result = $query->fetch(PDO::FETCH_ASSOC);
			$usuarios[$key]['nomeSetor'] = $result['nome'];
		}

		// Sorteia a array ordem crescente por setor
		usort($usuarios, function($a, $b) {
			return $a['nomeSetor'] <=> $b['nomeSetor'];
		});

		return $usuarios;
    }


	public function consultaRNC($id)
	{
		$query = $this->db->query('SELECT * FROM rnc WHERE id = ?', $id);
		$rnc = $query->fetch(PDO::FETCH_ASSOC);

		return $rnc;
	}


	public function consultaParticipantes($id)
	{
		$participantes = implode(",", $id);
		$query = $this->db->query("SELECT id, nome, setor, email FROM usuarios WHERE id IN ($participantes)");
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);

		foreach ($resultado as $key => $usuario) {
			$query = $this->db->query('SELECT nome FROM setores WHERE id = ?', [$usuario['setor']]);
			$result = $query->fetch(PDO::FETCH_ASSOC);
			$resultado[$key]['nomeSetor'] = $result['nome'];
		}

		// Sorteia a array ordem crescente por setor
		usort($resultado, function($a, $b) {
			return $a['nomeSetor'] <=> $b['nomeSetor'];
		});

		return $resultado;
	}


	public function listarSacpsPresentes() {
		$query = $this->db->query('SELECT id_sacp FROM sacp_participantes WHERE id_participante = ?', array($this->userdata['id']));
		$sacpPresente = $query->fetchAll(PDO::FETCH_COLUMN, 0);

		if ($sacpPresente) {
			$sacpPresente = implode(",", $sacpPresente);

			$query = $this->db->query("SELECT id FROM sacp WHERE id IN ($sacpPresente)");
			$resultado = $query->fetchAll(PDO::FETCH_COLUMN, 0);

			return $resultado;
		}
		return array();
	}


	public function consultaSACP($id)
	{
		$query = $this->db->query('SELECT * FROM sacp WHERE id = ?', $id);
		$sacp = $query->fetch(PDO::FETCH_ASSOC);

		$query = $this->db->query('SELECT id_participante FROM sacp_participantes WHERE id_sacp = ?', $id);
		$sacp['participantes'] = $query->fetchAll(PDO::FETCH_COLUMN, 0);

		$query = $this->db->query('SELECT id_tipo_plano_acao, descricao FROM espinha_peixe WHERE id_sacp = ?', $id);
		$sacp['espinhaPeixe'] = $query->fetchAll(PDO::FETCH_ASSOC);

		$query = $this->db->query('SELECT * FROM planos_acao WHERE id_sacp = ? AND id_tipo_plano = ?', array($id[0], 1));
		$sacp['maodeobra'] = $query->fetchAll(PDO::FETCH_ASSOC);

		foreach($sacp['maodeobra'] as $key => $value) {
			$query = $this->db->query("SELECT nome, setor FROM usuarios WHERE id = ?", array($value['quem']));
			$resultado = $query->fetch(PDO::FETCH_ASSOC);
			$sacp['maodeobra'][$key]['nome'] = $resultado['nome'];

			// setor "quem"
			$query = $this->db->query('SELECT nome FROM setores WHERE id = ?', [$resultado['setor']]);
			$result = $query->fetch(PDO::FETCH_ASSOC);

			$sacp['maodeobra'][$key]['nomeSetor'] = $result['nome'];

			// status
			$query = $this->db->query('SELECT nome FROM status WHERE id = ?', array($value['status']));
			$status = $query->fetch(PDO::FETCH_COLUMN, 0);

			$sacp['maodeobra'][$key]['nomeStatus'] = $status;

			// setor "onde"
			$query = $this->db->query('SELECT nome FROM setores WHERE id = ?', array($value['onde']));
			$setor = $query->fetch(PDO::FETCH_COLUMN, 0);

			$sacp['maodeobra'][$key]['nomeOnde'] = $setor;
		}

		$query = $this->db->query('SELECT * FROM planos_acao WHERE id_sacp = ? AND id_tipo_plano = ?', array($id[0], 2));
		$sacp['metodo'] = $query->fetchAll(PDO::FETCH_ASSOC);

		foreach($sacp['metodo'] as $key => $value) {
			$query = $this->db->query("SELECT nome, setor FROM usuarios WHERE id = ?", array($value['quem']));
			$resultado = $query->fetch(PDO::FETCH_ASSOC);
			$sacp['metodo'][$key]['nome'] = $resultado['nome'];

			$query = $this->db->query('SELECT nome FROM setores WHERE id = ?', [$resultado['setor']]);
			$result = $query->fetch(PDO::FETCH_ASSOC);

			$sacp['metodo'][$key]['nomeSetor'] = $result['nome'];

			$query = $this->db->query('SELECT nome FROM status WHERE id = ?', array($value['status']));
			$status = $query->fetch(PDO::FETCH_COLUMN, 0);

			$sacp['metodo'][$key]['nomeStatus'] = $status;

			// setor "onde"
			$query = $this->db->query('SELECT nome FROM setores WHERE id = ?', array($value['onde']));
			$setor = $query->fetch(PDO::FETCH_COLUMN, 0);

			$sacp['metodo'][$key]['nomeOnde'] = $setor;
		}

		$query = $this->db->query('SELECT * FROM planos_acao WHERE id_sacp = ? AND id_tipo_plano = ?', array($id[0], 3));
		$sacp['medida'] = $query->fetchAll(PDO::FETCH_ASSOC);

		foreach($sacp['medida'] as $key => $value) {
			$query = $this->db->query("SELECT nome, setor FROM usuarios WHERE id = ?", array($value['quem']));
			$resultado = $query->fetch(PDO::FETCH_ASSOC);
			$sacp['medida'][$key]['nome'] = $resultado['nome'];

			$query = $this->db->query('SELECT nome FROM setores WHERE id = ?', [$resultado['setor']]);
			$result = $query->fetch(PDO::FETCH_ASSOC);

			$sacp['medida'][$key]['nomeSetor'] = $result['nome'];

			$query = $this->db->query('SELECT nome FROM status WHERE id = ?', array($value['status']));
			$status = $query->fetch(PDO::FETCH_COLUMN, 0);

			$sacp['medida'][$key]['nomeStatus'] = $status;

			// setor "onde"
			$query = $this->db->query('SELECT nome FROM setores WHERE id = ?', array($value['onde']));
			$setor = $query->fetch(PDO::FETCH_COLUMN, 0);

			$sacp['medida'][$key]['nomeOnde'] = $setor;
		}

		$query = $this->db->query('SELECT * FROM planos_acao WHERE id_sacp = ? AND id_tipo_plano = ?', array($id[0], 4));
		$sacp['meioambiente'] = $query->fetchAll(PDO::FETCH_ASSOC);

		foreach($sacp['meioambiente'] as $key => $value) {
			$query = $this->db->query("SELECT nome, setor FROM usuarios WHERE id = ?", array($value['quem']));
			$resultado = $query->fetch(PDO::FETCH_ASSOC);
			$sacp['meioambiente'][$key]['nome'] = $resultado['nome'];

			$query = $this->db->query('SELECT nome FROM setores WHERE id = ?', [$resultado['setor']]);
			$result = $query->fetch(PDO::FETCH_ASSOC);

			$sacp['meioambiente'][$key]['nomeSetor'] = $result['nome'];

			$query = $this->db->query('SELECT nome FROM status WHERE id = ?', array($value['status']));
			$status = $query->fetch(PDO::FETCH_COLUMN, 0);

			$sacp['meioambiente'][$key]['nomeStatus'] = $status;

			// setor "onde"
			$query = $this->db->query('SELECT nome FROM setores WHERE id = ?', array($value['onde']));
			$setor = $query->fetch(PDO::FETCH_COLUMN, 0);

			$sacp['meioambiente'][$key]['nomeOnde'] = $setor;
		}

		$query = $this->db->query('SELECT * FROM planos_acao WHERE id_sacp = ? AND id_tipo_plano = ?', array($id[0], 5));
		$sacp['materiais'] = $query->fetchAll(PDO::FETCH_ASSOC);

		foreach($sacp['materiais'] as $key => $value) {
			$query = $this->db->query("SELECT nome, setor FROM usuarios WHERE id = ?", array($value['quem']));
			$resultado = $query->fetch(PDO::FETCH_ASSOC);
			$sacp['materiais'][$key]['nome'] = $resultado['nome'];

			$query = $this->db->query('SELECT nome FROM setores WHERE id = ?', [$resultado['setor']]);
			$result = $query->fetch(PDO::FETCH_ASSOC);

			$sacp['materiais'][$key]['nomeSetor'] = $result['nome'];

			$query = $this->db->query('SELECT nome FROM status WHERE id = ?', array($value['status']));
			$status = $query->fetch(PDO::FETCH_COLUMN, 0);

			$sacp['materiais'][$key]['nomeStatus'] = $status;

			// setor "onde"
			$query = $this->db->query('SELECT nome FROM setores WHERE id = ?', array($value['onde']));
			$setor = $query->fetch(PDO::FETCH_COLUMN, 0);

			$sacp['materiais'][$key]['nomeOnde'] = $setor;
		}

		$query = $this->db->query('SELECT * FROM planos_acao WHERE id_sacp = ? AND id_tipo_plano = ?', array($id[0], 6));
		$sacp['maquina'] = $query->fetchAll(PDO::FETCH_ASSOC);

		foreach($sacp['maquina'] as $key => $value) {
			$query = $this->db->query("SELECT nome, setor FROM usuarios WHERE id = ?", array($value['quem']));
			$resultado = $query->fetch(PDO::FETCH_ASSOC);
			$sacp['maquina'][$key]['nome'] = $resultado['nome'];

			$query = $this->db->query('SELECT nome FROM setores WHERE id = ?', [$resultado['setor']]);
			$result = $query->fetch(PDO::FETCH_ASSOC);

			$sacp['maquina'][$key]['nomeSetor'] = $result['nome'];

			$query = $this->db->query('SELECT nome FROM status WHERE id = ?', array($value['status']));
			$status = $query->fetch(PDO::FETCH_COLUMN, 0);

			$sacp['maquina'][$key]['nomeStatus'] = $status;

			// setor "onde"
			$query = $this->db->query('SELECT nome FROM setores WHERE id = ?', array($value['onde']));
			$setor = $query->fetch(PDO::FETCH_COLUMN, 0);

			$sacp['maquina'][$key]['nomeOnde'] = $setor;
		}

		return $sacp;
	}


    public function inserirSACP()
	{
		/* Verifica se algo foi postado e se está vindo do form que tem o campo
		inserirSACP. */
		if ('POST' != $_SERVER['REQUEST_METHOD'] || empty($_POST['inserirSACP'])) {
			return;
		}

		/* Remove o campo inserirSACP para não gerar problema com o PDO */
		unset($_POST['inserirSACP']);

		// Checa se o campo numero_op está vazio, caso esteja, seta pra null
		if (empty($_POST['numero_op'])) {
			$_POST['numero_op'] = null;
		}

		// Passa os participantes para um variavel e unseta da post
		$participantes = $_POST['participantes'];
		unset($_POST['participantes']);

		// Cria a data atual para ser gravada no banco de dados
		$dataGerada = new DateTime('now');
		$dataGerada = $dataGerada->format('Y-m-d H:i:s');

		$dataPrazo = new DateTime($dataGerada . '+ 30 days');
		$dataPrazo = $dataPrazo->format('Y-m-d H:i:s');



		// Salva na $dados e deleta a variavel desnecessária
		$dados['data_gerada'] 	= $dataGerada;
		$dados['data_prazo']	= $dataPrazo;
		$dados['setor_origem']  = $_POST['setor_origem'];
		$dados['setor_destino'] = $_POST['setor_destino'];
		$dados['numero_op']     = $_POST['numero_op'];
		$dados['origem']        = $_POST['origem'];
		$dados['descricao']     = $_POST['descricao'];
		$dados['proposito']     = $_POST['proposito'];
		$dados['consequencia']  = $_POST['consequencia'];
		$dados['brainstorming'] = $_POST['brainstorming'];


		/* query */
		$query = $this->db->insert('sacp', $dados);

		/* Verifica a consulta */
		if ($query) {

			// Seta o id da SACP
			$idSacp = $this->db->last_id;

			//traz os dados do usuário origem para o e-mail
			foreach ($participantes as $key => $participante) {
				$query = $this->db->insert('sacp_participantes', ['id_sacp' => $idSacp, 'id_participante' => $participante]);
			}

			// busca o id dos participantes
			foreach ($participantes as $key) {

				//traz os dados do usuário origem para o e-mail
				$query = $this->db->query('SELECT nome, email FROM usuarios WHERE id = ?', [$key]);
				while ($valor = $query->fetch(PDO::FETCH_ASSOC)) {
					$userOrigem		= $valor['nome'];
					$emailOrigem	= $valor['email'];
				}
			$listaUser[] = $userOrigem;
			$listaEmail[] = $emailOrigem;
			}

			//muda os participantes pra uma variável única
			$listaUser = implode($listaUser, ', ');

				//traz os setores para o e-mail
				$query = $this->db->query('SELECT nome FROM setores WHERE id = ?', [$_POST['setor_origem']]);
			while ($valor = $query->fetch(PDO::FETCH_ASSOC)) {
				$setorOrigem	= $valor['nome'];
			}
				//traz os setores para o e-mail
				$query = $this->db->query('SELECT nome FROM setores WHERE id = ?', [$_POST['setor_destino']]);
			while ($valor = $query->fetch(PDO::FETCH_ASSOC)) {
				$setorDestino	= $valor['nome'];
			}

			//traz os dados para o e-mail
			$query = $this->db->query('SELECT * FROM sacp WHERE id = ?', [$idSacp]);
			while ($valor = $query->fetch(PDO::FETCH_ASSOC)) {
				$setor_origem 	= $valor['setor_origem'];
				$setor_destino 	= $valor['setor_destino'];
				$numero_op 		= $valor['numero_op'];
				$origem 		= $valor['origem'];
				$descricao 		= $valor['descricao'];
				$proposito 		= $valor['proposito'];
				$consequencia 	= $valor['consequencia'];
				$brainstorming 	= $valor['brainstorming'];
				$dataGerada		= date('d/m/Y', strtotime($valor['data_gerada']));
				$horaGerada		= date('H:i', strtotime($valor['data_gerada']));
				$horaPrazo		= date('H:i', strtotime($valor['data_prazo']));
				$dataPrazo		= date('d/m/Y', strtotime($valor['data_prazo']));
			}

			// Prepara a variavel _POST para o insert na espinha de peixe
			unset($_POST['setor_origem']);
			unset($_POST['setor_destino']);
			unset($_POST['numero_op']);
			unset($_POST['origem']);
			unset($_POST['descricao']);
			unset($_POST['proposito']);
			unset($_POST['consequencia']);
			unset($_POST['brainstorming']);

			// Insere na espinha de peixe
			foreach ($_POST as $key => $dadoPeixe) {
				if (is_array($dadoPeixe)) {
					$dadoPeixe = array_filter($dadoPeixe);

					foreach ($dadoPeixe as $dado) {

						switch($key) {
							case 'medida':
								$palavra = 'Medida';
								break;
							case 'metodo':
								$palavra = 'Método';
								break;
							case 'maodeobra':
								$palavra = 'Mão de Obra';
								break;
							case 'maquina':
								$palavra = 'Máquina';
								break;
							case 'materiais':
								$palavra = 'Materiais';
								break;
							case 'meioambiente':
								$palavra = 'Meio Ambiente';
								break;
							default:
								break;
						}

						$query = $this->db->query('SELECT id FROM tipo_plano_acao WHERE nome = ?', [$palavra]);
						$plano = $query->fetch(PDO::FETCH_COLUMN, 0);

						$query = $this->db->insert(
							'espinha_peixe',
							[
								'id_sacp' => $idSacp,
								'id_tipo_plano_acao' => $plano,
								'descricao' => $dado
							]
						);
					}
				} else {

					$query = $this->db->query('SELECT id FROM tipo_plano_acao WHERE nome = ?', ['Descrição']);
					$plano = $query->fetch(PDO::FETCH_COLUMN, 0);

					$query = $this->db->insert(
						'espinha_peixe',
						[
							'id_sacp' => $idSacp,
							'id_tipo_plano_acao' => $plano,
							'descricao' => $dadoPeixe
						]
					);
				}
			}
			//chama a classe responsável por construir o e-mail
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
			foreach ($listaEmail as $key) {
				$mail->addAddress($key);
			}
			$mail->addAddress('renato.dambros@edelbra.com.br'); //email teste DEV
			//$mail->addAddress('e-mail para administradores');
			//$mail->addAddress('e-mail para Qualidade');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\logofull.png', 'logo', 'logofull.png');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\relat2.png', 'relat2', 'relat2.png');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\acessar.png', 'acessar', 'acessar.png');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\linha.png', 'linha', 'linha.png');
			$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)
			$mail->Subject = 'SACP Novo';
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
							background-color: #337AB7;
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
									<img src='cid:relat2.png' align=center width='90' height='130'></p></th>
							</tr>
							<tr>
								<th colspan='3' >Solicitação de Ação Corretiva ou Preventiva</th>
								<th colspan='1' >ID $idSacp </th>
							</tr>
							<tr>
								<td colspan='4' style='background-color: white; color: blue;'><p align=center><b> ----> NOVO <---- </b></p></td>
							</tr>
							<tr>
								<td colspan='4'><b> Setor Solicitante:</b> $setorOrigem </td>
							</tr>
							<tr>
								<td colspan='4' style='background-color: white;'><b> Setor Destino:</b> $setorDestino </td>
							</tr>
							<tr>
								<td colspan='4'><b> Participantes:</b> $listaUser </td>
							</tr>
							<tr>
								<td colspan='4' style='background-color: white;'><b> Número O.P:</b> $numero_op </td>
							</tr>
							<tr>
								<td colspan='4'><b> Data Gerada:</b><b style='color:blue;'> $dataGerada</b>  </td>
							</tr>
							<tr>
								<td colspan='4' style='background-color: white;'><b> Data Prazo:</b><b style='color:red;'> $dataPrazo</b>  </td>
							</tr>
							<tr rowspan='4'>
								<td colspan='4'><b> Descrição: </b> $descricao </td>
							</tr>
							<tr rowspan='4'>
								<td colspan='4' style='background-color: white; color: white;'><b>Justificativa:</b>  </td>
							</tr>
							<br>
							<br>
							<br>
							<br>
								<p align=center> <a href='$url/sacp/editar/$idSacp'>
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

			// Redireciona para a página de edit
			echo "<meta http-equiv='Refresh' content='0; url=" . HOME_URI . "/sacp/editar/" . $idSacp . "'>";
			echo "<script type='text/javascript'>window.location.href = '" . HOME_URI . "/sacp/editar/" . $idSacp . "'</script>";

			return 'success';

		}
		return 'Erro ao inserir SACP no banco de dados';
	} // insert


	public function editarSACP($id)
	{
		/* Verifica se algo foi postado e se está vindo do form que tem o campo
		editarSACP. */
		if ('POST' != $_SERVER['REQUEST_METHOD'] || empty($_POST['editarSACP'])) {
			return;
		}

		/* Remove o campo editarSACP para não gerar problema com o PDO */
		unset($_POST['editarSACP']);

		// Checa se o campo numero_op está vazio, caso esteja, seta pra null
		if (empty($_POST['numero_op'])) {
			$_POST['numero_op'] = null;
		}

		// Passa os participantes para um variavel e unseta da post
		$participantes = $_POST['participantes'];
		unset($_POST['participantes']);

		$dados['setor_origem']  = $_POST['setor_origem'];
		$dados['setor_destino'] = $_POST['setor_destino'];
		$dados['numero_op']     = $_POST['numero_op'];
		$dados['origem']        = $_POST['origem'];
		$dados['descricao']     = $_POST['descricao'];
		$dados['proposito']     = $_POST['proposito'];
		$dados['consequencia']  = $_POST['consequencia'];
		$dados['brainstorming'] = $_POST['brainstorming'];
		$dados['data_prazo']	= $_POST['data_prazo'];
		$dados['status'] = 2;

		/* query */
		$query = $this->db->update('sacp', 'id', $id[0], $dados);

		//seta o ID da sacp pro e-mail
		$idSacp = implode($id);

		/* Verifica a consulta */
		if ($query) {

			if (!empty($participantes)) {
				$query = $this->db->delete('sacp_participantes', 'id_sacp', $id[0]);

				foreach ($participantes as $key => $participante) {
					$query = $this->db->insert('sacp_participantes', ['id_sacp' => $id[0], 'id_participante' => $participante]);
				}
			}

			//traz os setores para o e-mail
				$query = $this->db->query('SELECT nome FROM setores WHERE id = ?', [$_POST['setor_origem']]);
			while ($valor = $query->fetch(PDO::FETCH_ASSOC)) {
				$setorOrigem	= $valor['nome'];
			}
				//traz os setores para o e-mail
				$query = $this->db->query('SELECT nome FROM setores WHERE id = ?', [$_POST['setor_destino']]);
			while ($valor = $query->fetch(PDO::FETCH_ASSOC)) {
				$setorDestino	= $valor['nome'];
			}

			// busca o id dos participantes
			foreach ($participantes as $key) {

				//traz os dados do usuário origem para o e-mail
				$query = $this->db->query('SELECT nome, email FROM usuarios WHERE id = ?', [$key]);
				while ($valor = $query->fetch(PDO::FETCH_ASSOC)) {
					$userOrigem		= $valor['nome'];
					$emailOrigem	= $valor['email'];
				}
			$listaUser[] = $userOrigem;
			$listaEmail[] = $emailOrigem;
			}

			//muda os participantes pra uma variável única
			$listaUser = implode($listaUser, ', ');

			//traz os dados para o e-mail
			$query = $this->db->query('SELECT * FROM sacp WHERE id = ?', [$idSacp]);
			while ($valor = $query->fetch(PDO::FETCH_ASSOC)) {
				$setor_origem 	= $valor['setor_origem'];
				$setor_destino 	= $valor['setor_destino'];
				$numero_op 		= $valor['numero_op'];
				$origem 		= $valor['origem'];
				$descricao 		= $valor['descricao'];
				$proposito 		= $valor['proposito'];
				$consequencia 	= $valor['consequencia'];
				$brainstorming 	= $valor['brainstorming'];
				$dataGerada		= date('d/m/Y', strtotime($valor['data_gerada']));
				$horaGerada		= date('H:i', strtotime($valor['data_gerada']));
				$horaPrazo		= date('H:i', strtotime($valor['data_prazo']));
				$dataPrazo		= date('d/m/Y', strtotime($valor['data_prazo']));
			}

			// Prepara a variavel _POST para o insert na espinha de peixe
			unset($_POST['setor_origem']);
			unset($_POST['setor_destino']);
			unset($_POST['numero_op']);
			unset($_POST['origem']);
			unset($_POST['descricao']);
			unset($_POST['proposito']);
			unset($_POST['consequencia']);
			unset($_POST['brainstorming']);

			$query = $this->db->delete('espinha_peixe', 'id_sacp', $id[0]);

			// Insere na espinha de peixe
			foreach ($_POST as $key => $dadoPeixe) {

				if (is_array($dadoPeixe)) {
					$dadoPeixe = array_filter($dadoPeixe);

					foreach ($dadoPeixe as $dado) {

						switch($key) {
							case 'medida':
								$palavra = 'Medida';
								break;
							case 'metodo':
								$palavra = 'Método';
								break;
							case 'maodeobra':
								$palavra = 'Mão de Obra';
								break;
							case 'maquina':
								$palavra = 'Máquina';
								break;
							case 'materiais':
								$palavra = 'Materiais';
								break;
							case 'meioambiente':
								$palavra = 'Meio Ambiente';
								break;
							default:
								break;
						}

						$query = $this->db->query('SELECT id FROM tipo_plano_acao WHERE nome = ?', [$palavra]);
						$plano = $query->fetch(PDO::FETCH_COLUMN, 0);

						$query = $this->db->insert(
							'espinha_peixe',
							[
								'id_sacp' => $id[0],
								'id_tipo_plano_acao' => $plano,
								'descricao' => $dado
							]
						);
					}
				} else {

					$query = $this->db->query('SELECT id FROM tipo_plano_acao WHERE nome = ?', ['Descrição']);
					$plano = $query->fetch(PDO::FETCH_COLUMN, 0);

					$query = $this->db->insert(
						'espinha_peixe',
						[
							'id_sacp' => $id[0],
							'id_tipo_plano_acao' => $plano,
							'descricao' => $dadoPeixe
						]
					);
				}
			}

			// Atualiza "onde" dos planos de ação
			$query = $this->db->update('planos_acao', 'id_sacp', $id[0], array('onde' => $dados['setor_destino']));

			//chama a classe responsável por construir o e-mail
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
				foreach ($listaEmail as $key) {
					$mail->addAddress($key);
				}
			$mail->addAddress('renato.dambros@edelbra.com.br'); //email teste DEV
			//$mail->addAddress('e-mail para administradores');
			//$mail->addAddress('e-mail para Qualidade');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\logofull.png', 'logo', 'logofull.png');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\relat2.png', 'relat2', 'relat2.png');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\acessar.png', 'acessar', 'acessar.png');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\linha.png', 'linha', 'linha.png');
			$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)
			$mail->Subject = 'SACP Alterada';
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
							background-color: #337AB7;
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
									<img src='cid:relat2.png' align=center width='90' height='130'></p></th>
							</tr>
							<tr>
								<th colspan='3' >Solicitação de Ação Corretiva ou Preventiva</th>
								<th colspan='1' >ID $idSacp </th>
							</tr>
							<tr>
								<td colspan='4' style='background-color: white; color: #DAA520;'><p align=center><b> ----> ALTERADA <---- </b></p></td>
							</tr>
							<tr>
								<td colspan='4'><b> Setor Solicitante:</b> $setorOrigem </td>
							</tr>
							<tr>
								<td colspan='4' style='background-color: white;'><b> Setor Destino:</b> $setorDestino </td>
							</tr>
							<tr>
								<td colspan='4'><b> Participantes:</b> $listaUser </td>
							</tr>
							<tr>
								<td colspan='4' style='background-color: white;'><b> Número O.P:</b> $numero_op </td>
							</tr>
							<tr>
								<td colspan='4'><b> Data Gerada:</b><b style='color:blue;'> $dataGerada </b> </td>
							</tr>
							<tr>
								<td colspan='4' style='background-color: white;'><b> Data Prazo:</b><b style='color:red;'> $dataPrazo</b>  </td>
							</tr>
							<tr rowspan='4'>
								<td colspan='4'><b> Descrição: </b> $descricao </td>
							</tr>
							<tr rowspan='4'>
								<td colspan='4' style='background-color: white; color: white;'><b>Justificativa:</b>  </td>
							</tr>
							<br>
							<br>
							<br>
							<br>
								<p align=center> <a href='$url/sacp/editar/$idSacp'>
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
		return 'Erro ao atualizar SACP no banco de dados';
	} // update


	public function excluirSACP()
	{
		// O segundo parâmetro deverá ser um ID numérico
		if (!is_numeric(chk_array($this->parametros, 0))) {
			return;
		}

		// Para excluir, o terceiro parâmetro deverá ser "confirma"
		if (chk_array($this->parametros, 1) != 'confirma') {
			return;
		}

		// Configura o ID SACP
		$user_id = (int)chk_array($this->parametros, 0);

		// Executa a consulta
		$query = $this->db->delete('sacp', 'id', $user_id);

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
							background-color: #337AB7;
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
								<th colspan='3' >Solicitação de Ação Corretiva ou Preventiva</th>
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
								<p align=center> <a href='$url/sacp/'>
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
		}

		// Redireciona para a página Painel de visualização
		echo '<meta http-equiv="Refresh" content="0; url=' . HOME_URI . '/sacp/">';
		echo '<script type="text/javascript">window.location.href = "' . HOME_URI . '/sacp/";</script>';
	} // delete


	public function finalizarSACP($id)
	{
		/* Verifica se algo foi postado e se está vindo do form que tem o campo
		finalizarSACP. */
		if ('POST' != $_SERVER['REQUEST_METHOD'] || empty($_POST['finalizarSACP'])) {
			return;
		}

		// Busca os status de todos os planos de ação da SACP
		$query = $this->db->query('SELECT status FROM planos_acao WHERE id_sacp = ?', array($id));
		$planos = $query->fetchAll(PDO::FETCH_COLUMN, 0);

		// Percorre a array retornada do banco de dados, e caso algum plano não estiver como status 3(finalizado)
		// retorna error
		if (!empty($planos)) {
			foreach ($planos as $plano) {
				if ($plano != 3) {
					return 'Todos os planos de ação devem estar finalizados';
				}
			}
		}

		/* Remove o campo finalizarSACP para não gerar problema com o PDO */
		unset($_POST['finalizarSACP']);

		// Cria a data atual para ser gravada no banco de dados
		$dataFinalizada = new DateTime('now');
		$dataFinalizada = $dataFinalizada->format('Y-m-d H:i:s');

		/* Atualiza os dados */
		$query = $this->db->update('sacp', 'id', $id, array('status' => 3, 'data_finalizada' => $dataFinalizada));

		//traz os dados para o e-mail
		$query = $this->db->query('SELECT * FROM sacp WHERE id = ?', [$id]);
		while ($valor = $query->fetch(PDO::FETCH_ASSOC)) {
			$setor_origem 	= $valor['setor_origem'];
			$setor_destino 	= $valor['setor_destino'];
			$numero_op 		= $valor['numero_op'];
			$origem 		= $valor['origem'];
			$descricao 		= $valor['descricao'];
			$proposito 		= $valor['proposito'];
			$consequencia 	= $valor['consequencia'];
			$brainstorming 	= $valor['brainstorming'];
			$dataGerada		= date('d/m/Y', strtotime($valor['data_gerada']));
			$dataPrazo		= date('d/m/Y', strtotime($valor['data_prazo']));
			$dataFinalizada	= date('d/m/Y', strtotime($valor['data_finalizada']));

		}

		//traz os setores para o e-mail
		$query = $this->db->query('SELECT nome FROM setores WHERE id = ?', [$setor_origem]);
			while ($valor = $query->fetch(PDO::FETCH_ASSOC)) {
			$setorOrigem = $valor['nome'];
		}

		//traz os setores para o e-mail
		$query = $this->db->query('SELECT nome FROM setores WHERE id = ?', [$setor_destino]);
			while ($valor = $query->fetch(PDO::FETCH_ASSOC)) {
			$setorDestino = $valor['nome'];
		}

		//traz os id participantes
		$query = $this->db->query('SELECT id_participante FROM sacp_participantes WHERE id_sacp = ?', [$id]);
		while ($valor = $query->fetch(PDO::FETCH_ASSOC)) {
			$participantes[] = $valor['id_participante'];
		}

		// busca o id dos participantes
		foreach ($participantes as $key) {

			//traz os dados do usuário origem para o e-mail
			$query = $this->db->query('SELECT nome, email FROM usuarios WHERE id = ?', [$key]);
			while ($valor = $query->fetch(PDO::FETCH_ASSOC)) {
				$userOrigem		= $valor['nome'];
				$emailOrigem	= $valor['email'];
			}
		$listaUser[] = $userOrigem;
		$listaEmail[] = $emailOrigem;
		}

		//muda os participantes pra uma variável única
		$listaUser = implode($listaUser, ', ');

		/* Verifica a consulta */
		if ($query) {

		//chama a classe responsável por construir o e-mail
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
				foreach ($listaEmail as $key) {
					$mail->addAddress($key);
				}
			$mail->addAddress('renato.dambros@edelbra.com.br'); //email teste DEV
			//$mail->addAddress('e-mail para administradores');
			//$mail->addAddress('e-mail para Qualidade');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\logofull.png', 'logo', 'logofull.png');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\relat2.png', 'relat2', 'relat2.png');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\acessar.png', 'acessar', 'acessar.png');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\linha.png', 'linha', 'linha.png');
			$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)
			$mail->Subject = 'SACP Finalizada';
			$msg =	"<html dir='ltr'>
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
							background-color: #337AB7;
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
									<img src='cid:relat2.png' align=center width='90' height='130'></p></th>
							</tr>
							<tr>
								<th colspan='3' >Solicitação de Ação Corretiva ou Preventiva</th>
								<th colspan='1' >ID $id </th>
							</tr>
							<tr>
								<td colspan='4' style='background-color: white; color: green;'><p align=center><b> ----> FINALIZADA <---- </b></p></td>
							</tr>
							<tr>
								<td colspan='4'><b> Setor Solicitante:</b> $setorOrigem </td>
							</tr>
							<tr>
								<td colspan='4' style='background-color: white;'><b> Setor Destino:</b> $setorDestino </td>
							</tr>
							<tr>
								<td colspan='4'><b> Participantes:</b> $listaUser </td>
							</tr>
							<tr>
								<td colspan='4' style='background-color: white;'><b> Número O.P:</b> $numero_op </td>
							</tr>
							<tr>
								<td colspan='4'><b> Data Gerada:</b><b style='color:blue;'> $dataGerada </b> </td>
							</tr>
							<tr>
								<td colspan='4' style='background-color: white;'><b> Data Prazo:</b><b style='color:red;'> $dataPrazo</b>  </td>
							</tr>
							<tr>
								<td colspan='4'><b> Data Finalizada:</b><b style='color:green;'> $dataFinalizada </b>  </td>
							</tr>
							<tr rowspan='4'>
								<td colspan='4' style='background-color: white;'><b> Descrição: </b> $descricao </td>
							</tr>
							<tr rowspan='4'>
								<td colspan='4' style='background-color: white; color: white;'><b>Justificativa:</b>  </td>
							</tr>
							<br>
							<br>
							<br>
							<br>
								<p align=center> <a href='$url/sacp/'>
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
		return 'Falha ao finalizar a SACP';
	}


	public function gerarSACPdeRNC($id)
	{
		/* Verifica se algo foi postado e se está vindo do form que tem o campo
		editarSACP. */
		if ('POST' != $_SERVER['REQUEST_METHOD'] || empty($_POST['editarSACP'])) {
			return;
		}

		/* Remove o campo editarSACP para não gerar problema com o PDO */
		unset($_POST['editarSACP']);

		// Checa se o campo numero_op está vazio, caso esteja, seta pra null
		if (empty($_POST['numero_op'])) {
			$_POST['numero_op'] = null;
		}

		// Passa os participantes para um variavel e unseta da post
		$participantes = $_POST['participantes'];
		unset($_POST['participantes']);

		// Cria a data atual para ser gravada no banco de dados
		$dataGerada = new DateTime('now');
		$dataGerada = $dataGerada->format('Y-m-d H:i:s');

		$dataPrazo = new DateTime($dataGerada . '+ 30 days');
		$dataPrazo = $dataPrazo->format('Y-m-d H:i:s');

		// Salva na $dados e deleta a variavel desnecessária
		$dados['data_gerada'] = $dataGerada;
		$dados['data_prazo'] = $dataPrazo;
		unset($dataGerada);
		unset($dataPrazo);

		$dados['setor_origem']  = $_POST['setor_origem'];
		$dados['setor_destino'] = $_POST['setor_destino'];
		$dados['numero_op']     = $_POST['numero_op'];
		$dados['origem']        = $_POST['origem'];
		$dados['descricao']     = $_POST['descricao'];
		$dados['proposito']     = $_POST['proposito'];
		$dados['consequencia']  = $_POST['consequencia'];
		$dados['brainstorming'] = $_POST['brainstorming'];

		$dados['id_rnc'] = $id;

		/* query */
		$query = $this->db->insert('sacp', $dados);

		/* Verifica a consulta */
		if ($query) {
			// Seta o id da SACP
			$idSacp = $this->db->last_id;

			// Insere os participantes
			foreach ($participantes as $key => $participante) {
				$query = $this->db->insert('sacp_participantes', ['id_sacp' => $idSacp, 'id_participante' => $participante]);
			}

			// Prepara a variavel _POST para o insert na espinha de peixe
			unset($_POST['setor_origem']);
			unset($_POST['setor_destino']);
			unset($_POST['numero_op']);
			unset($_POST['origem']);
			unset($_POST['descricao']);
			unset($_POST['proposito']);
			unset($_POST['consequencia']);
			unset($_POST['brainstorming']);

			// Insere na espinha de peixe
			foreach ($_POST as $key => $dadoPeixe) {
				if (is_array($dadoPeixe)) {
					$dadoPeixe = array_filter($dadoPeixe);

					foreach ($dadoPeixe as $dado) {

						switch($key) {
							case 'medida':
								$palavra = 'Medida';
								break;
							case 'metodo':
								$palavra = 'Método';
								break;
							case 'maodeobra':
								$palavra = 'Mão de Obra';
								break;
							case 'maquina':
								$palavra = 'Máquina';
								break;
							case 'materiais':
								$palavra = 'Materiais';
								break;
							case 'meioambiente':
								$palavra = 'Meio Ambiente';
								break;
							default:
								break;
						}

						$query = $this->db->query('SELECT id FROM tipo_plano_acao WHERE nome = ?', [$palavra]);
						$plano = $query->fetch(PDO::FETCH_COLUMN, 0);

						$query = $this->db->insert(
							'espinha_peixe',
							[
								'id_sacp' => $idSacp,
								'id_tipo_plano_acao' => $plano,
								'descricao' => $dado
							]
						);
					}
				} else {

					$query = $this->db->query('SELECT id FROM tipo_plano_acao WHERE nome = ?', ['Descrição']);
					$plano = $query->fetch(PDO::FETCH_COLUMN, 0);

					$query = $this->db->insert(
						'espinha_peixe',
						[
							'id_sacp' => $idSacp,
							'id_tipo_plano_acao' => $plano,
							'descricao' => $dadoPeixe
						]
					);
				}
			}

			// Redireciona para a página de edit
			echo "<meta http-equiv='Refresh' content='0; url=" . HOME_URI . "/sacp/editar/" . $idSacp . "'>";
			echo "<script type='text/javascript'>window.location.href = '" . HOME_URI . "/sacp/editar/" . $idSacp . "'</script>";
		}
		return 'Erro ao inserir SACP no banco de dados';
	} // gerarSACPRNC


	public function consultarplano($id)
	{
		$query = $this->db->query('SELECT o_que, como, quem, quando, onde, status FROM planos_acao WHERE id = ?', array($id));
		$resultado = $query->fetch(PDO::FETCH_ASSOC);

		$data = new DateTime($resultado['quando']);
		$resultado['quando'] = $data->format('Y-m-d');
		return $resultado;
	}


	public function inserirPlano($dados)
	{
		/* Verifica se algo foi postado e se está vindo do form que tem o campo
		inserirPlano. */
		if ('POST' != $_SERVER['REQUEST_METHOD'] || empty($_POST['inserirPlano'])) {
			return;
		}

		unset($_POST['inserirPlano']);

		$_POST['id_sacp'] = $dados[0];
		$_POST['id_tipo_plano'] = $dados[1];

		$query = $this->db->insert('planos_acao', $_POST);
		$idPlano = $this->db->last_id;

		if ($query) {

			$query = $this->db->query('SELECT * FROM planos_acao WHERE id = ?', [$idPlano]);
				while ($valor = $query->fetch(PDO::FETCH_ASSOC)) {
				$o_que 			= $valor['o_que'];
				$como		 	= $valor['como'];
				$quem	 		= $valor['quem'];
				$onde			= $valor['onde'];
				$idSacp			= $valor['id_sacp'];
				$quando			= date('d/m/Y', strtotime($valor['quando']));
				}

			//traz os dados do usuário destino para o e-mail
			$query = $this->db->query('SELECT nome, email FROM usuarios WHERE id = ?', [$quem]);
			while ($valor = $query->fetch(PDO::FETCH_ASSOC)) {
				$quem		= $valor['nome'];
				$quemEmail	= $valor['email'];
			}

			//traz os dados do setor destino para o e-mail
			$query = $this->db->query('SELECT nome FROM setores WHERE id = ?', [$onde]);
			while ($valor = $query->fetch(PDO::FETCH_ASSOC)) {
				$onde		= $valor['nome'];
			}

			$dataGerada = new DateTime('now');
			$dataGerada = $dataGerada->format('d-m-Y');


			//chama a classe responsável por construir o e-mail
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
			$mail->addAddress($quemEmail); //email destino
			$mail->addAddress('renato.dambros@edelbra.com.br'); //email teste DEV
			//$mail->addAddress('e-mail para administradores');
			//$mail->addAddress('e-mail para Qualidade');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\logofull.png', 'logo', 'logofull.png');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\relat2.png', 'relat2', 'relat2.png');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\acessar.png', 'acessar', 'acessar.png');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\linha.png', 'linha', 'linha.png');
			$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)
			$mail->Subject = 'Plano de Ação - Novo';
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
							background-color: #337AB7;
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
									<img src='cid:relat2.png' align=center width='90' height='130'></p></th>
							</tr>
							<tr>
								<th colspan='3' >Plano de Ação - SACP</th>
								<th colspan='1' >ID $idSacp </th>
							</tr>
							<tr>
								<td colspan='4' style='background-color: white; color: blue;'><p align=center><b> ----> NOVO <---- </b></p></td>
							</tr>
							<tr>
								<td colspan='4'><b> O que Fazer:</b> $o_que </td>
							</tr>
							<tr>
								<td colspan='4' style='background-color: white;'><b> Como fazer:</b> $como </td>
							</tr>
							<tr>
								<td colspan='4'><b> Quem:</b> $quem </td>
							</tr>
							<tr>
								<td colspan='4' style='background-color: white;'><b> Onde:</b> $onde </td>
							</tr>
							<tr>
								<td colspan='4'><b> Quando:</b><b style='color:red;'> $quando </b>  </td>
							</tr>
							<tr rowspan='4'>
								<td colspan='4' style='background-color: white; color: white;'><b>Justificativa:</b>  </td>
							</tr>
							<br>
							<br>
							<br>
							<br>
								<p align=center> <a href='$url/sacp/editar/$idSacp'>
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
		return 'Falha ao inserir no banco de dados';
	}


	public function editarPlano($id)
	{
		/* Verifica se algo foi postado e se está vindo do form que tem o campo
		editarPlano. */
		if ('POST' != $_SERVER['REQUEST_METHOD'] || empty($_POST['editarPlano'])) {
			return;
		}

		unset($_POST['editarPlano']);

		$_POST['status'] = 2;

		$query = $this->db->update('planos_acao', 'id', $id, $_POST);

		if ($query) {

			$query = $this->db->query('SELECT * FROM planos_acao WHERE id = ?', [$id]);
				while ($valor = $query->fetch(PDO::FETCH_ASSOC)) {
				$o_que 			= $valor['o_que'];
				$como		 	= $valor['como'];
				$quem	 		= $valor['quem'];
				$onde			= $valor['onde'];
				$idSacp			= $valor['id_sacp'];
				$quando			= date('d/m/Y', strtotime($valor['quando']));
				}

			//traz os dados do usuário destino para o e-mail
			$query = $this->db->query('SELECT nome, email FROM usuarios WHERE id = ?', [$quem]);
			while ($valor = $query->fetch(PDO::FETCH_ASSOC)) {
				$quem		= $valor['nome'];
				$quemEmail	= $valor['email'];
			}

			//traz os dados do setor destino para o e-mail
			$query = $this->db->query('SELECT nome FROM setores WHERE id = ?', [$onde]);
			while ($valor = $query->fetch(PDO::FETCH_ASSOC)) {
				$onde		= $valor['nome'];
			}

			$dataGerada = new DateTime('now');
			$dataGerada = $dataGerada->format('d-m-Y');


			//chama a classe responsável por construir o e-mail
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
			$mail->addAddress($quemEmail); //email destino
			$mail->addAddress('renato.dambros@edelbra.com.br'); //email teste DEV
			//$mail->addAddress('e-mail para administradores');
			//$mail->addAddress('e-mail para Qualidade');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\logofull.png', 'logo', 'logofull.png');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\relat2.png', 'relat2', 'relat2.png');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\acessar.png', 'acessar', 'acessar.png');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\linha.png', 'linha', 'linha.png');
			$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)
			$mail->Subject = 'Plano de Ação - Editado';
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
							background-color: #337AB7;
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
									<img src='cid:relat2.png' align=center width='90' height='130'></p></th>
							</tr>
							<tr>
								<th colspan='3' >Plano de Ação - SACP</th>
								<th colspan='1' >ID $idSacp </th>
							</tr>
							<tr>
								<td colspan='4' style='background-color: white; color: #DAA520;'><p align=center><b> ----> EDITADO <---- </b></p></td>
							</tr>
							<tr>
								<td colspan='4'><b> O que Fazer:</b> $o_que </td>
							</tr>
							<tr>
								<td colspan='4' style='background-color: white;'><b> Como fazer:</b> $como </td>
							</tr>
							<tr>
								<td colspan='4'><b> Quem:</b> $quem </td>
							</tr>
							<tr>
								<td colspan='4' style='background-color: white;'><b> Onde:</b> $onde </td>
							</tr>
							<tr>
								<td colspan='4'><b> Quando:</b><b style='color:red;'> $quando </b>  </td>
							</tr>
							<tr rowspan='4'>
								<td colspan='4' style='background-color: white; color: white;'><b>Justificativa:</b>  </td>
							</tr>
							<br>
							<br>
							<br>
							<br>
								<p align=center> <a href='$url/sacp/editar/$idSacp'>
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
		return 'Falha ao inserir no banco de dados';
	}


	public function excluirPlano()
	{
		// Checa se o parametro reservado para o id_sacp é numérico
		if (!is_numeric(chk_array($this->parametros, 0))) {
			return;
		}

		// Checa se o parametro reservado para o id do plano é numérico
		if (!is_numeric(chk_array($this->parametros, 1))) {
			return;
		}

		// Para excluir, o terceiro parâmetro deverá ser "confirma"
		if (chk_array($this->parametros, 2) != 'confirma') {
			return;
		}

		// Seta o id da sacp
		$idSacp = (int)chk_array($this->parametros, 0);

		// Seta o id do plano
		$idPlano = (int)chk_array($this->parametros, 1);

		// Executa a consulta
		$query = $this->db->delete('planos_acao', 'id', $idPlano);

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
            $mail->Subject = 'Plano de Ação - Excuído';
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
							background-color: #337AB7;
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
								<th colspan='3' >Solicitação de Ação Corretiva ou Preventiva</th>
								<th colspan='1' >ID $idSacp </th>
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
								<p align=center> <a href='$url/sacp/'>
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

			}

		// Redireciona para a página de edit
		echo "<meta http-equiv='Refresh' content='0; url=" . HOME_URI . "/sacp/editar/" . $idSacp . "'>";
		echo "<script type='text/javascript'>window.location.href = '" . HOME_URI . "/sacp/editar/" . $idSacp . "'</script>";
	}


	public function finalizarPlano($id)
	{
		/* Verifica se algo foi postado e se está vindo do form que tem o campo
		finalizarPlano. */
		if ('POST' != $_SERVER['REQUEST_METHOD'] || empty($_POST['finalizarPlano'])) {
			return;
		}

		// Checa se o parametro reservado para o id_sacp é numérico
		if (!is_numeric(chk_array($this->parametros, 0))) {
			return;
		}

		// Seta o id da sacp
		$idSacp = (int)chk_array($this->parametros, 0);

		unset($_POST['finalizarPlano']);

		$query = $this->db->update('planos_acao', 'id', $id, array('status' => 3));

		// Redireciona para a página Painel de visualização
		echo "<meta http-equiv='Refresh' content='0; url=" . HOME_URI . "/sacp/editar/" . $idSacp . "'>";
		echo "<script type='text/javascript'>window.location.href = '" . HOME_URI . "/sacp/editar/" . $idSacp . "'</script>";

	if ($query) {

			$query = $this->db->query('SELECT * FROM planos_acao WHERE id = ?', [$id]);
				while ($valor = $query->fetch(PDO::FETCH_ASSOC)) {
				$o_que 			= $valor['o_que'];
				$como		 	= $valor['como'];
				$quem	 		= $valor['quem'];
				$onde			= $valor['onde'];
				$idSacp			= $valor['id_sacp'];
				$quando			= date('d/m/Y', strtotime($valor['quando']));
				}

			//traz os dados do usuário destino para o e-mail
			$query = $this->db->query('SELECT nome, email FROM usuarios WHERE id = ?', [$quem]);
			while ($valor = $query->fetch(PDO::FETCH_ASSOC)) {
				$quem		= $valor['nome'];
				$quemEmail	= $valor['email'];
			}

			//traz os dados do setor destino para o e-mail
			$query = $this->db->query('SELECT nome FROM setores WHERE id = ?', [$onde]);
			while ($valor = $query->fetch(PDO::FETCH_ASSOC)) {
				$onde		= $valor['nome'];
			}

			$dataGerada = new DateTime('now');
			$dataGerada = $dataGerada->format('d-m-Y');


			//chama a classe responsável por construir o e-mail
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
			$mail->addAddress($quemEmail); //email destino
			$mail->addAddress('renato.dambros@edelbra.com.br'); //email teste DEV
			//$mail->addAddress('e-mail para administradores');
			//$mail->addAddress('e-mail para Qualidade');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\logofull.png', 'logo', 'logofull.png');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\relat2.png', 'relat2', 'relat2.png');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\acessar.png', 'acessar', 'acessar.png');
			$mail->AddEmbeddedImage('C:\wamp64\www\sspiwork\views\_images\linha.png', 'linha', 'linha.png');
			$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)
			$mail->Subject = 'Plano de Ação - Finalizado';
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
							background-color: #337AB7;
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
									<img src='cid:relat2.png' align=center width='90' height='130'></p></th>
							</tr>
							<tr>
								<th colspan='3' >Plano de Ação - SACP</th>
								<th colspan='1' >ID $idSacp </th>
							</tr>
							<tr>
								<td colspan='4' style='background-color: white; color: green;'><p align=center><b> ----> FINALIZADO <---- </b></p></td>
							</tr>
							<tr>
								<td colspan='4'><b> O que Fazer:</b> $o_que </td>
							</tr>
							<tr>
								<td colspan='4' style='background-color: white;'><b> Como fazer:</b> $como </td>
							</tr>
							<tr>
								<td colspan='4'><b> Quem:</b> $quem </td>
							</tr>
							<tr>
								<td colspan='4' style='background-color: white;'><b> Onde:</b> $onde </td>
							</tr>
							<tr>
								<td colspan='4'><b> Quando:</b><b style='color:red;'> $quando </b>  </td>
							</tr>
							<tr rowspan='4'>
								<td colspan='4' style='background-color: white; color: white;'><b>Justificativa:</b>  </td>
							</tr>
							<br>
							<br>
							<br>
							<br>
								<p align=center> <a href='$url/sacp/editar/$idSacp'>
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
		return 'Falha ao Finalizar Plano';
	}

} // model
