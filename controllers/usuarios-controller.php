<?php
class UsuariosController extends MainController
{
	public function index() 
	{
		// Título da página
		$this->title = 'Usuários';
		
		// Verifica se o usuário está logado
		if (! $this->logged_in) {
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
		//$this->lista = $modelo->listar_usuarios(); 
		//$this->tipos_usuarios = $modelo->consultTipoUsuario();
		
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
		$tiposUsuario = $modelo->consultTiposUsuario();
		$setores = $modelo->listarSetores();
		$retorno = $modelo->inserirUsuario();

		//echo $modelo->json(array('home' => 'visualizar'));
		
		if ($retorno == 'success') {
			$this->modal_notification = MainModel::openNotification('Sucesso', 'RNC gerada com sucesso.', 'success');
		} elseif (!empty($retorno)) {
			$this->modal_notification = MainModel::openNotification('Erro', $retorno, 'error');
        }
		
		require ABSPATH . '/views/_includes/header.php';
		require ABSPATH . '/views/usuarios/inserir-usuario.php';
		require ABSPATH . '/views/_includes/footer.php';
	}
	
	public function editar($id)
	{
		$this->title = 'Editar Dados Usuário';

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
		
		// Carrega o método para editar um usuario
		$this->update=$modelo->update_usuario($id);
		$this->usuario=$modelo->consult_usuario($id);
		$this->tipos_usuarios = $modelo->consultTipoUsuario();
		
		if ($this->update) {
			if ($this->update=='success') {
				$this->modal_notification=MainModel::openNotification('Sucesso','Atualizamos o cadastro do usuário','success');	
			} elseif ($this->update=='error') {
				$this->modal_notification=MainModel::openNotification('Erro','Não conseguimos efetuar sua operação.','error');	
			}
		}

		require ABSPATH . '/views/_includes/header.php';
		require ABSPATH . '/views/usuarios/editar-usuario-view.php';
		require ABSPATH . '/views/_includes/footer.php';
	}
		
	public function delete($id)
	{
		$this->title = 'Gerenciar Usuário';

		// Verifica se o usuário está logado
		if (! $this->logged_in) {
			$this->logout(true);
			return;
		}

		// Verifica se o usuário tem permissão
		if (!$this->check_permissions('usuarios', 'excluir', $this->userdata['user_permissions'])) {
			require_once ABSPATH . '/includes/403.php';
			return;
		}
		
		$this->modal_message=MainModel::modalMessage('Excluir Usuário','Tem certeza que deseja apagar este usuário?','<button type="submit" onclick="window.location=\''.$_SERVER['REQUEST_URI']. 'confirma/'.'\'" class="btn btn-success">Excluir</button>');
	
		$modelo = $this->load_model('usuarios/usuarios-model');
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();
				
		$this->lista = $modelo->listar_usuarios(); 
		$modelo->form_confirma = $modelo->apaga_usuario();
		
		require ABSPATH . '/views/_includes/header.php';
		//require ABSPATH . '/views/usuarios/usuarios-view.php';
		require ABSPATH . '/views/_includes/footer.php';
	}

	public function TesteEmail()
	{
		$send_message = new SendMessage('lucaschiarello@yahoo.com.br', 'no-reply@beasy.mobi', 'Usuário Acesso - Beasy', 'usuario-senha');
		$retorno = $send_message->send();

		echo $retorno;
		die();
	}
} // class UsuariosController
