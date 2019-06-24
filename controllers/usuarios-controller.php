<?php
class UsuariosController extends MainController
{
	public function index() 
	{
		// Título da página
		$this->title = 'Usuários';
		
		// Verifica se o usuário está logado
		if (!$this->logged_in) {
			$this->logout(true);
			return;
		}

		// Verifica se o usuário tem permissão
		if (!$this->check_permissions('usuarios', 'visualizar', $this->userdata['user_permissions'])) {
			require_once ABSPATH . '/includes/403.php';
			return;
		}

		$modelo = $this->load_model('usuarios/usuarios-model');
		
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();
		
		require ABSPATH . '/views/_includes/header.php';
		require ABSPATH . '/views/usuarios/usuarios.php';
		require ABSPATH . '/views/_includes/footer.php';
	} // index


	public function page() 
	{
		$modelo = $this->load_model('usuarios/usuarios-model');
		echo $modelo->paginacao();
	}

	
	public function inserir()
	{
		$this->title = 'Inserir novo usuário';

		// Verifica se o usuário está logado
		if (!$this->logged_in) {
			$this->logout(true);
			return;
		}

		// Verifica se o usuário tem permissão
		if (!$this->check_permissions('usuarios', 'inserir', $this->userdata['user_permissions'])) {
			require_once ABSPATH . '/includes/403.php';
			return;
		}

		$modelo = $this->load_model('usuarios/usuarios-model');
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		// Carrega o método para inserir um usuario
		$tiposUsuario = $modelo->consultaTiposUsuario();
		$setores = $modelo->listarSetores();
		$retorno = $modelo->inserirUsuario();
		
		if ($retorno == 'success') {
			$this->modal_notification = MainModel::openNotification('Sucesso', 'Usuário cadastrado com sucesso.', 'success');
		} elseif (!empty($retorno)) {
			$this->modal_notification = MainModel::openNotification('Erro', $retorno, 'error');
        }
		
		require ABSPATH . '/views/_includes/header.php';
		require ABSPATH . '/views/usuarios/inserir-usuario.php';
		require ABSPATH . '/views/_includes/footer.php';
	}
	
	
	public function editar($id)
	{
		$this->title = 'Editar Usuário';

		// Verifica se o usuário está logado
		if (!$this->logged_in) {
			$this->logout(true);
			return;
		}

		// Verifica se o usuário tem permissão
		if (!$this->check_permissions('usuarios', 'editar', $this->userdata['user_permissions'])) {
			require_once ABSPATH . '/includes/403.php';
			return;
		}
		
		$modelo = $this->load_model('usuarios/usuarios-model');
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		// Checa se o usuário existe
		$usuario = $modelo->consultaUsuario($id);
		if (empty($usuario)) {
			require_once ABSPATH . '/includes/404.php';
			return;
		}
		
		// Carrega o método para editar um usuario
		$retorno = $modelo->editarUsuario($id);
		$usuario = $modelo->consultaUsuario($id);
		$tiposUsuario = $modelo->consultaTiposUsuario();
		$setores = $modelo->listarSetores();
		
		if ($retorno == 'success') {
			$this->modal_notification = MainModel::openNotification('Sucesso', 'Cadastro atualizado com sucesso.', 'success');
		} elseif (!empty($retorno)) {
			$this->modal_notification = MainModel::openNotification('Erro', $retorno, 'error');
        }

		require ABSPATH . '/views/_includes/header.php';
		require ABSPATH . '/views/usuarios/editar-usuario.php';
		require ABSPATH . '/views/_includes/footer.php';
	}

		
	public function excluir($id)
	{
		$this->title = 'Excluir usuário';

		// Verifica se o usuário está logado
		if (!$this->logged_in) {
			$this->logout(true);
			return;
		}

		// Verifica se o usuário tem permissão
		if (!$this->check_permissions('usuarios', 'excluir', $this->userdata['user_permissions'])) {
			require_once ABSPATH . '/includes/403.php';
			return;
		}

		$modelo = $this->load_model('usuarios/usuarios-model');
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		// Checa se o usuário existe
		$usuario = $modelo->consultaUsuario($id);
		if (empty($usuario)) {
			require_once ABSPATH . '/includes/404.php';
			return;
		}
		
		$this->modal_message = MainModel::modalMessage('Excluir Usuário', 'Tem certeza que deseja apagar este usuário?', '<button type="submit" onclick="window.location=\''.$_SERVER['REQUEST_URI']. 'confirma/'.'\'" class="btn btn-success">Excluir</button>');
	
		$modelo->form_confirma = $modelo->excluirUsuario();
		
		require ABSPATH . '/views/_includes/header.php';
		//require ABSPATH . '/views/usuarios/usuarios-view.php';
		require ABSPATH . '/views/_includes/footer.php';
	}

} // class UsuariosController
