<?php

class RncController extends MainController
{
	
    public function index() {
		// Título da página
        $this->title = "RNC's";
        
        // Verifica se o usuário está logado
        /* if (!$this->logged_in) {
            $this->logout(true);
            return;
        }

        // Verifica se o usuário tem permissão
        if (!$this->check_permissions('rnc', 'visualizar', $this->userdata['user_permissions'])) {
            require_once ABSPATH . '/includes/403.php';
            return;
        } */
		
		/** Carrega os arquivos do view **/
        require ABSPATH . '/views/_includes/header.php';
        require ABSPATH . '/views/rnc/rnc-view.php';
        require ABSPATH . '/views/_includes/footer.php';
    } // index


    public function page() {
        $modelo = $this->load_model('rnc/rnc-model');
        echo $modelo->paginacao();
    }


    public function inserir() {
		// Título da página
		$this->title = "Gerar RNC's";
        
        // Verifica se o usuário está logado
        /* if (!$this->logged_in) {
            $this->logout(true);
            return;
        }

        // Verifica se o usuário tem permissão
        if (!$this->check_permissions('rnc', 'inserir', $this->userdata['user_permissions'])) {
            require_once ABSPATH . '/includes/403.php';
            return;
        } */

        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();
        $modelo = $this->load_model('rnc/rnc-model');

        $usuarios = $modelo->listarUsuarios();
        $retorno = $modelo->inserirRNC();

        if ($retorno == 'success') {
			$this->modal_notification = MainModel::openNotification('Sucesso', 'RNC gerada com sucesso.', 'success');
		} elseif (!empty($retorno)) {
			$this->modal_notification = MainModel::openNotification('Erro', $retorno, 'error');
        }
        
		/** Carrega os arquivos do view **/
        require ABSPATH . '/views/_includes/header.php';
        require ABSPATH . '/views/rnc/inserir-rnc.php';
        require ABSPATH . '/views/_includes/footer.php';
    } // inserir


    public function editar($id)
	{
		$this->title = 'Editar RNC';

		// Verifica se o usuário está logado
		/* if (!$this->logged_in) {
			$this->logout(true);
			return;
		}

		// Verifica se o usuário tem permissão
		if (!$this->check_permissions('rnc', 'editar', $this->userdata['user_permissions'])) {
			require_once ABSPATH . '/includes/403.php';
			return;
		} */

		$modelo = $this->load_model('rnc/rnc-model');
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();
		
		// Carrega o método para editar uma RNC
		$retorno = $modelo->editarRNC($id);

		
		if ($retorno == 'success') {
			$this->modal_notification=MainModel::openNotification('Sucesso', 'RNC atualizada com sucesso.', 'success');
		} elseif (!empty($retorno)) {
			$this->modal_notification=MainModel::openNotification('Erro', $retorno, 'error');
		}

		require ABSPATH . '/views/_includes/header.php';
		require ABSPATH . '/views/rnc/editar-usuario-view.php';
		require ABSPATH . '/views/_includes/footer.php';
	}


    public function deletar($id)
	{
		$this->title = 'Deletar RNC';

		// Verifica se o usuário está logado
		/* if (!$this->logged_in) {
			$this->logout(true);
			return;
		}

		// Verifica se o usuário tem permissão
		if (!$this->check_permissions('rnc', 'excluir', $this->userdata['user_permissions'])) {
			require_once ABSPATH . '/includes/403.php';
			return;
		} */
		
		$this->modal_message = MainModel::modalMessage('Excluir RNC', 'Tem certeza que deseja apagar esta RNC?', '<button type="submit" onclick="window.location=\''.$_SERVER['REQUEST_URI']. 'confirma/'.'\'" class="btn btn-success">Excluir</button>');
	
		$modelo = $this->load_model('rnc/rnc-model');
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$modelo->form_confirma = $modelo->deletarRNC();
		
		require ABSPATH . '/views/_includes/header.php';
		//require ABSPATH . '/views/rnc/rnc-view.php';
		require ABSPATH . '/views/_includes/footer.php';
	}
	
}
