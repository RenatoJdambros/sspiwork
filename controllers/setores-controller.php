<?php
class SetoresController extends MainController
{
	public function index()
	{
		// Título da página
		$this->title = 'Setores';

		// Verifica se o usuário está logado
		if (!$this->logged_in) {
			$this->logout(true);
			return;
		}

		// Verifica se o usuário tem permissão
		if (!$this->check_permissions('setores', 'visualizar', $this->userdata['user_permissions'])) {
			require_once ABSPATH . '/includes/403.php';
			return;
		}

		$modelo = $this->load_model('setores/setores-model');

		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		require ABSPATH . '/views/_includes/header.php';
		require ABSPATH . '/views/setores/setores.php';
		require ABSPATH . '/views/_includes/footer.php';
	} // index


	public function page()
	{
		$modelo = $this->load_model('setores/setores-model');
		echo $modelo->paginacao();
	}


	public function inserir()
	{
		$this->title = 'Inserir novo setor';

		// Verifica se o usuário está logado
		if (!$this->logged_in) {
			$this->logout(true);
			return;
		}

		// Verifica se o usuário tem permissão
		if (!$this->check_permissions('setores', 'inserir', $this->userdata['user_permissions'])) {
			require_once ABSPATH . '/includes/403.php';
			return;
		}

		$modelo = $this->load_model('setores/setores-model');
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		// Carrega o método para inserir um setor
		$retorno = $modelo->inserirSetor();

		if ($retorno == 'success') {
			$this->modal_notification = MainModel::openNotification('Sucesso', 'Setor cadastrado com sucesso.', 'success');
		} elseif (!empty($retorno)) {
			$this->modal_notification = MainModel::openNotification('Erro', $retorno, 'error');
        }

		require ABSPATH . '/views/_includes/header.php';
		require ABSPATH . '/views/setores/inserir-setor.php';
		require ABSPATH . '/views/_includes/footer.php';
	}


	public function editar()
	{
		$this->title = 'Editar Setor';

		// Verifica se o usuário está logado
		if (!$this->logged_in) {
			$this->logout(true);
			return;
		}

		// Verifica se o usuário tem permissão
		if (!$this->check_permissions('setores', 'editar', $this->userdata['user_permissions'])) {
			require_once ABSPATH . '/includes/403.php';
			return;
		}

		$modelo = $this->load_model('setores/setores-model');
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		// Carrega o método para editar um usuario
		$retorno = $modelo->editarSetor($parametros);

		// Checa se o setor existe
		$setor = $modelo->consultaSetor($parametros);
		if (empty($setor)) {
			require_once ABSPATH . '/includes/404.php';
			return;
		}

		if ($retorno == 'success') {
			$this->modal_notification = MainModel::openNotification('Sucesso', 'Setor atualizado com sucesso.', 'success');
		} elseif (!empty($retorno)) {
			$this->modal_notification = MainModel::openNotification('Erro', $retorno, 'error');
        }

		require ABSPATH . '/views/_includes/header.php';
		require ABSPATH . '/views/setores/editar-setor.php';
		require ABSPATH . '/views/_includes/footer.php';
	}


	public function excluir()
	{
		$this->title = 'Excluir Setor';

		// Verifica se o usuário está logado
		if (!$this->logged_in) {
			$this->logout(true);
			return;
		}

		// Verifica se o usuário tem permissão
		if (!$this->check_permissions('setores', 'excluir', $this->userdata['user_permissions'])) {
			require_once ABSPATH . '/includes/403.php';
			return;
		}

		$modelo = $this->load_model('setores/setores-model');
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		// Checa se o setor existe
		$setor = $modelo->consultaSetor(array($parametros[0]));
		if (empty($setor)) {
			require_once ABSPATH . '/includes/404.php';
			return;
		}

		$this->modal_message = MainModel::modalMessage('Excluir Setor', 'Tem certeza que deseja apagar este usuário?', '<button type="submit" onclick="window.location=\''.$_SERVER['REQUEST_URI']. 'confirma/'.'\'" class="btn btn-success">Excluir</button>');

		$modelo->form_confirma = $modelo->excluirSetor();

		require ABSPATH . '/views/_includes/header.php';
		//require ABSPATH . '/views/usuarios/usuarios-view.php';
		require ABSPATH . '/views/_includes/footer.php';
	}

} // class UsuariosController
