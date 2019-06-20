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
        $columns = $this->formatar_colunas();
        $page = DataTable::simple($_POST, $this->db->pdo, 'sacp', 'id', $columns);

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
                        <ul class="dropdown-menu">
                            <?php if ($this->controller->check_permissions('sacp', 'editar', $this->userdata['user_permissions'])) { ?>
                                <li>
                                    <a href="<?= HOME_URI ?>/sacp/editar/<?= $d ?>"><i class="fa fa-edit"></i> Editar</a>
                                </li>
                            <?php } ?>
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


	public function consultaSACP($id) 
	{
		$query = $this->db->query('SELECT * FROM sacp WHERE id = ?', $id);
		$sacp = $query->fetch(PDO::FETCH_ASSOC);

		$query = $this->db->query('SELECT id_participante FROM sacp_participantes WHERE id_sacp = ?', $id);
		$sacp['participantes'] = $query->fetchAll(PDO::FETCH_COLUMN, 0);

		$query = $this->db->query('SELECT id_tipo_plano_acao, descricao FROM espinha_peixe WHERE id_sacp = ?', $id);
		$sacp['espinhaPeixe'] = $query->fetchAll(PDO::FETCH_ASSOC);

		// infodie($sacp['espinhaPeixe']);

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

		// Salva na $_POST e deleta a variavel desnecessária
		$dados['data_gerada'] = $dataGerada;
		unset($dataGerada);

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
			unset($_POST['status']);

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

		// Cria a data atual para ser gravada no banco de dados
		$dataGerada = new DateTime('now');
		$dataGerada = $dataGerada->format('Y-m-d H:i:s');

		// Salva na $_POST e deleta a variavel desnecessária
		$_POST['data_gerada'] = $dataGerada;
		unset($dataGerada);

		$_POST['participantes'] = implode(';', $_POST['participantes']);

		$_POST['id_rnc'] = $id;

		/* query */
		$query = $this->db->insert('sacp', $_POST);
		
		/* Verifica a consulta */
		if ($query) {
			$idSacp = $this->db->last_id;
			// Redireciona para a página de edit
			echo "<meta http-equiv='Refresh' content='0; url=" . HOME_URI . "/sacp/editar/" . $idSacp . "'>";
			echo "<script type='text/javascript'>window.location.href = '" . HOME_URI . "/sacp/editar/" . $idSacp . "'</script>";
		
			return 'success';
		}
		return 'Erro ao inserir SACP no banco de dados';
	} // insert

} // model