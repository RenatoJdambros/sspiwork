<?php 
/**
 * Modelo para gerenciar notícias
 *
 * @package TutsupMVC
 * @since 0.1
 */
class UsuariosModel extends MainModel
{
	/**
	 * $posts_per_page
	 *
	 * Receberá o número de posts por página para configurar a listagem de 
	 * notícias. Também utilizada na paginação. 
	 *
	 * @access public
	 */
	public $posts_por_pagina = 5;
	
	public $modal_message = array();
	
	/**
	 * Construtor para essa classe
	 *
	 * Configura o DB, o controlador, os parâmetros e dados do usuário.
	 *
	 * @since 0.1
	 * @access public
	 * @param object $db Objeto da nossa conexão PDO
	 * @param object $controller Objeto do controlador
	 */
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
        $page = DataTable::simple($_POST, $this->db->pdo, 'usuarios', 'id', $columns);

        return json_encode($page);
    }


    private function formatar_colunas()
    {
        return array(
            ['dt' => 0, 'db' => 'id'],
            ['dt' => 1, 'db' => 'nome'],
            ['dt' => 2, 'db' => 'setor', 'formatter' => function($d) 
            {
                $query = $this->db->query('SELECT * FROM setores WHERE id = ?', [$d]);
				$result = $query->fetch();
				if (empty($result)) {
					return "Não encontrado";	
				}
                return $result['nome'];
            }],
            ['dt' => 3, 'db' => 'email'],
			['dt' => 4, 'db' => 'tipo_usuario', 'formatter' => function($d) 
            {
                $query = $this->db->query('SELECT * FROM tipos_usuario WHERE id = ?', [$d]);
				$result = $query->fetch();
				if (empty($result)) {
					return "Não encontrado";	
				}
                return ucfirst($result['nome']);
            }],
            ['dt' => 5, 'db' => 'id', 'formatter' => function($d) 
            {
                ob_start(); ?>
                    <div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Mais <span class="caret"></span> </button>
                        <ul class="dropdown-menu">
                            <?php if ($this->controller->check_permissions('usuarios', 'editar', $this->userdata['user_permissions'])) { ?>
                                <li>
                                    <a href="<?= HOME_URI ?>/usuarios/editar/<?= $d ?>"><i class="fa fa-edit"></i> Editar</a>
                                </li>
                            <?php } ?>
                            <?php if ($this->controller->check_permissions('usuarios', 'excluir', $this->userdata['user_permissions'])) { ?>
                                <li>
                                    <a href="<?= HOME_URI ?>/usuarios/deletar/<?= $d ?>/"><i class="fa fa-remove"></i> Excluir</a>
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



	public function inserirUsuario() 
	{
		/* 
		Verifica se algo foi postado e se está vindo do form que tem o campo
		insere_noticia.
		*/
		if ('POST' != $_SERVER['REQUEST_METHOD'] || empty($_POST['inserirUsuario'])) {
			return;
		}
		
		/*
		Para evitar conflitos apenas inserimos valores se o parâmetro edit
		não estiver configurado.
		*/
		if (chk_array($this->parametros, 0) == 'edit') {
			return;
		}
		
		// Só pra garantir que não estamos atualizando nada
		if (is_numeric(chk_array($this->parametros, 1))) {
			return;
		}

		/* Checa se o usuario existe no banco de dados */
		$query = $this->db->query('SELECT * FROM usuarios WHERE usuario = ?', [$_POST['usuario']]);
		$result = $query->fetch();
		if (!empty($result)) {
			return 'Usuário já cadastrado';
		}

		// Configura a senha
		$_POST['senha'] = $this->controller->phpass->HashPassword($_POST['senha']);

		// Remove o campo insere_usuario para não gerar problema com o PDO
		unset($_POST['inserirUsuario']);
		
		$query = $this->db->insert('usuarios', $_POST);
		
		// Verifica a consulta
		if ($query) {
			return 'success';		
		} 
		
		return 'Erro ao inserir usuário no banco de dados';

	} // insere_noticia
	
	
	public function editarUsuario($id) 
	{
		/* 
		Verifica se algo foi postado e se está vindo do form que tem o campo
		editarUsuario.
		*/
		if ('POST' != $_SERVER['REQUEST_METHOD'] || empty($_POST['editarUsuario'])) {
			return;
		}

		/* Checa se o usuario existe no banco de dados */
		$query = $this->db->query('SELECT * FROM usuarios WHERE usuario = ?', [$_POST['usuario']]);
		$checkUsuario = $query->fetch();

		if (!empty($checkUsuario)) {
			$usuario = $this->consultaUsuario($id);
			
			if ($usuario['usuario'] != $checkUsuario['usuario']) {
				return 'Usuário já cadastrado';
			}
		}

		// Remove o campo insere_usuario para não gerar problema com o PDO
		unset($_POST['editarUsuario']);

		// Se a senha tiver sido preenchida, gera uma nova hash, caso não, 
		// limpa a váriavel para evitar que seja substituida no banco de dados
		if (isset($_POST['senha']) && !empty($_POST['senha'])) {
			$_POST['senha'] = $this->controller->phpass->HashPassword($_POST['senha']);
		} else {
			unset($_POST['senha']);
		}

		// Atualiza os dados
		$query = $this->db->update('usuarios', 'id', $id[0], $_POST);
		
		// Verifica a consulta
		if ($query) {
			return 'success';
		}
		return 'Falha ao editar no banco de dados';
	} 
	
	
	public function deletarUsuario() 
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
		$query = $this->db->delete('usuarios', 'id', $user_id);
		
		// Redireciona para a página de administração de notícias
		echo '<meta http-equiv="Refresh" content="0; url=' . HOME_URI . '/usuarios/">';
		echo '<script type="text/javascript">window.location.href = "' . HOME_URI . '/usuarios/";</script>';
		
	}


	public function listarSetores() 
	{
		// Faz a consulta para obter o valor
		$query = $this->db->query('SELECT * FROM setores ORDER BY nome ASC');
		
		// Obtém os dados
		$result = $query->fetchAll();

		// Se os dados estiverem nulos, não faz nada
		if (empty($result)) {
			return 'Nenhum setor encontrado';
		}
	 	return $result;
	}


	public function consultaUsuario($id)
	{
		// Faz a consulta para obter o valor
		$query = $this->db->query('SELECT * FROM usuarios WHERE id = ? LIMIT 1', [$id[0]]);
		
		// Obtém os dados
		$result = $query->fetch();

		// Se os dados estiverem nulos, não faz nada
		if (empty($result)) {
			return;
		}	
	 	return $result;
	}
	// usuario


	public function consultaTiposUsuario() 
	{
		$query = $this->db->query('SELECT * FROM tipos_usuario ORDER BY `id` ASC');
		
		if ($query) {
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			if (!empty($result)) {
				return $result;
			} else {
				return 'Nenhum resultado encontrado';
			}
		} else {
			return 'Erro ao realizar consulta';
		}
	}
	
} // UsuariosModel
