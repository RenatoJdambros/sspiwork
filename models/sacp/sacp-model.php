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
        if ($this->userdata['tipo_usuario'] == 3) {
			$query = $this->db->query('SELECT id_sacp FROM sacp_participantes WHERE id_participante = ?', array($this->userdata['id']));
			$sacpPresente = $query->fetchAll(PDO::FETCH_COLUMN, 0);

			$sacpPresente = implode(",", $sacpPresente);

			if (empty($sacpPresente)) {
				$sacpPresente = 0;
			}

			$sql = 'SELECT * FROM sacp';
			$where = "id IN ($sacpPresente)";

			$columns = $this->formatar_colunas();
			$page = DataTable::complex($_POST, $this->db->pdo, 'sacp', 'id', $columns, $sql, null, $where);
		} else {
			$columns = $this->formatar_colunas();
			$page = DataTable::simple($_POST, $this->db->pdo, 'sacp', 'id', $columns);
		}

        return json_encode($page);
	}


    private function formatar_colunas()
    {
        return array(
            ['dt' => 0, 'db' => 'id'],
            ['dt' => 1, 'db' => 'setor_origem', 'formatter' => function($d) 
            {
                $query = $this->db->query('SELECT nome FROM setores WHERE id = ?', [$d]);
				$result = $query->fetch();
				
				if (empty($result)) {
					return "Não encontrado";	
				}
                return $result['nome'];
            }],
            ['dt' => 2, 'db' => 'setor_destino', 'formatter' => function($d) 
            {
                $query = $this->db->query('SELECT nome FROM setores WHERE id = ?', [$d]);
				$result = $query->fetch();
				
				if (empty($result)) {
					return "Não encontrado";	
				}
                return $result['nome'];
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
                ob_start(); ?>
                    <div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Mais <span class="caret"></span> </button>
                        <ul class="dropdown-menu">
                            <?php // if ($this->controller->check_permissions('sacp', 'editar', $this->userdata['user_permissions'])) { ?>
                                <li>
                                    <a href="<?= HOME_URI ?>/sacp/editar/<?= $d ?>"><i class="fa fa-edit"></i> Editar</a>
                                </li>
                            <?php // } ?>
							<?php if ($this->controller->check_permissions('sacp', 'editar', $this->userdata['user_permissions'])) { ?>
                                <li>
                                    <a href="<?= HOME_URI ?>/sacp/finalizar/<?= $d ?>"><i class="fa fa-check"></i> Finalizar</a>
                                </li>
                            <?php } ?>
                            <?php if ($this->controller->check_permissions('sacp', 'excluir', $this->userdata['user_permissions'])) { ?>
                                <li>
                                    <a href="<?= HOME_URI ?>/sacp/excluir/<?= $d ?>/"><i class="fa fa-remove"></i> Excluir</a>
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
		insere_noticia. */
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

			// email
			
			// Redireciona para a página de edit
			echo "<meta http-equiv='Refresh' content='0; url=" . HOME_URI . "/sacp/editar/" . $idSacp . "'>";
			echo "<script type='text/javascript'>window.location.href = '" . HOME_URI . "/sacp/editar/" . $idSacp . "'</script>";
		}
		return 'Erro ao inserir SACP no banco de dados';
	} // insert

	
	public function editarSACP($id) 
	{
		/* Verifica se algo foi postado e se está vindo do form que tem o campo
		editar_usuario. */
		if ('POST' != $_SERVER['REQUEST_METHOD'] || empty($_POST['editarSACP'])) {
			return;
		}

		/* Remove o campo insere_usuario para não gerar problema com o PDO */
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

		/* query */
		$query = $this->db->update('sacp', 'id', $id[0], $dados);
		
		/* Verifica a consulta */
		if ($query) {
			$query = $this->db->delete('sacp_participantes', 'id_sacp', $id[0]);

			foreach ($participantes as $key => $participante) {
				$query = $this->db->insert('sacp_participantes', ['id_sacp' => $id[0], 'id_participante' => $participante]);
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

			// email
			// $retorno = $this->consultaParticipantes($participantes);
			// foreach ($retorno as $key => $participante) {
			// 	// $mail->addAddress($participante['email']);
			// }

			return 'success';
		}
		return 'Erro ao atualizar SACP no banco de dados';
	} // update


	public function excluirSACP() 
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
		$query = $this->db->delete('sacp', 'id', $user_id);
		
		// Redireciona para a página de administração de notícias
		echo '<meta http-equiv="Refresh" content="0; url=' . HOME_URI . '/sacp/">';
		echo '<script type="text/javascript">window.location.href = "' . HOME_URI . '/sacp/";</script>';
	} // delete


	public function finalizarSACP($id) 
	{
		/* Verifica se algo foi postado e se está vindo do form que tem o campo
		editar_usuario. */
		if ('POST' != $_SERVER['REQUEST_METHOD'] || empty($_POST['finalizarSACP'])) {
			return;
		}

		/* Remove o campo insere_usuario para não gerar problema com o PDO */
		unset($_POST['finalizarSACP']);

		// Cria a data atual para ser gravada no banco de dados
		$dataFinalizada = new DateTime('now');
		$dataFinalizada = $dataFinalizada->format('Y-m-d H:i:s');

		// Salva na $_POST e deleta a variavel desnecessária
		$_POST['data_finalizada'] = $dataFinalizada;
		unset($dataFinalizada);

		/* Atualiza os dados */
		$query = $this->db->update('sacp', 'id', $id[0], $_POST);
		
		/* Verifica a consulta */
		if ($query) {
			return 'success';
		}
		return 'Falha ao finalizar a SACP';
	}


	public function gerarSACPdeRNC($id) 
	{
		/* Verifica se algo foi postado e se está vindo do form que tem o campo
		insere_noticia. */
		if ('POST' != $_SERVER['REQUEST_METHOD'] || empty($_POST['editarSACP'])) {
			return;
		}

		/* Remove o campo inserirSACP para não gerar problema com o PDO */
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
		$query = $this->db->query('SELECT o_que, como, quem, quando, onde FROM planos_acao WHERE id = ?', array($id));
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

		if ($query) {
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

		$query = $this->db->update('planos_acao', 'id', $id, $_POST);

		if ($query) {
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
		
		// Redireciona para a página de administração de notícias
		echo "<meta http-equiv='Refresh' content='0; url=" . HOME_URI . "/sacp/editar/" . $idSacp . "'>";
		echo "<script type='text/javascript'>window.location.href = '" . HOME_URI . "/sacp/editar/" . $idSacp . "'</script>";
	}

} // model