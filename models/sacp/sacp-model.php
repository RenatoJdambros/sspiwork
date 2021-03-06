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
                        <ul class="dropdown-menu">
                            <?php if ($this->controller->check_permissions('sacp', 'editar', $this->userdata['user_permissions'])) { ?>
                                <li>
                                    <a href="<?= HOME_URI ?>/sacp/editar/<?= $d ?>"><i class="fa fa-edit"></i> Editar</a>
                                </li>
                            <?php } ?>
							<?php if ($this->controller->check_permissions('sacp', 'editar', $this->userdata['user_permissions'])) { ?>
                                <li>
                                    <a href="<?= HOME_URI ?>/sacp/finalizar/<?= $d ?>"><i class="fa fa-edit"></i> Finalizar</a>
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
		$query = $this->db->query('SELECT * FROM usuarios WHERE id != ?', [$this->userdata['id']]);
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
	
	
	public function consultaSACP($id) 
	{
		$query = $this->db->query('SELECT * FROM sacp WHERE id = ?', [$id]);
		$sacp = $query->fetch(PDO::FETCH_ASSOC);

		$query = $this->db->query('SELECT * FROM usuarios WHERE id = ?', [$sacp['id_origem']]);
		$userOrigem = $query->fetch(PDO::FETCH_ASSOC);

		$query = $this->db->query('SELECT * FROM usuarios WHERE id = ?', [$sacp['id_destino']]);
		$userDestino = $query->fetch(PDO::FETCH_ASSOC);

		return array('sacp' => $sacp, 'userOrigem' => $userOrigem, 'userDestino' => $userDestino);
	}

    
    public function inserirSACP() 
	{
		/* Verifica se algo foi postado e se está vindo do form que tem o campo
		insere_noticia. */
		if ('POST' != $_SERVER['REQUEST_METHOD'] || empty($_POST['inserirSACP'])) {
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

		/* Remove o campo inserirSACP para não gerar problema com o PDO */
		unset($_POST['inserirSACP']);

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
		$query = $this->db->insert('sacp', $_POST);
		
		/* Verifica a consulta */
		if ($query) {
			return 'success';
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

		/* Atualiza os dados */
		$query = $this->db->update('sacp', 'id', $id[0], $_POST);
		
		/* Verifica a consulta */
		if ($query) {
			return 'success';
		}
		return 'Falha ao atualizar o cadastro do usuário';
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

		/* Atualiza os dados */
		$query = $this->db->update('sacp', 'id', $id[0], $_POST);
		
		/* Verifica a consulta */
		if ($query) {
			return 'success';
		}
		return 'Falha ao finalizar a SACP';
	}

} // model