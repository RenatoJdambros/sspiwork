<?php
// class ConfiguracoesController extends MainController
// {
// 	public function index() 
// 	{
// 		// Título da página
// 		$this->title = 'Configurações';
		
// 		// Verifica se o usuário está logado
// 		if (! $this->logged_in) {
// 			$this->logout(true);
// 			return;
// 		}

// 		// Verifica se o usuário tem permissão
// 		if (!$this->check_permissions('configuracoes', 'visualizar', $this->userdata['user_permissions'])) {
// 			require_once ABSPATH . '/includes/403.php';
// 			return;
// 		}

// 		$modelo = $this->load_model('configuracoes/configuracoes-model');
		
// 		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();
		
// 		$this->lista = $modelo->listar_configuracoes(); 
		
// 		require ABSPATH . '/views/_includes/header.php';
// 		require ABSPATH . '/views/configuracoes/configuracoes-view.php';
// 		require ABSPATH . '/views/_includes/footer.php';
// 	}


// 	public function editar($id)
// 	{
// 		$this->title = 'Editar Configuração';

// 		// Verifica se o usuário está logado
// 		if (!$this->logged_in) {
// 			$this->logout(true);
// 			return;
// 		}

// 		// Verifica se o usuário tem permissão
// 		if (!$this->check_permissions('configuracoes', 'editar', $this->userdata['user_permissions'])) {
// 			require_once ABSPATH . '/includes/403.php';
// 			return;
// 		}
		
// 		$modelo = $this->load_model('configuracoes/configuracoes-model');
// 		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();
		
// 		// Carrega o método para editar um usuario
// 		$this->update=$modelo->update_configuracoes($id);
// 		$this->config=$modelo->consult_configuracoes($id);
		
// 		if ($retorno == 'success') {
// 			$this->modal_notification = MainModel::openNotification('Sucesso', 'Configuração editada com sucesso.', 'success');
// 		} elseif (!empty($retorno)) {
// 			$this->modal_notification = MainModel::openNotification('Erro', $retorno, 'error');
//         }
		
// 		require ABSPATH . '/views/_includes/header.php';
// 		require ABSPATH . '/views/configuracoes/editar-configuracoes-view.php';
// 		require ABSPATH . '/views/_includes/footer.php';
// 	}
	
// }
