<?php

class SacpController extends MainController
{
	public function index() 
	{
		// Título da página
        $this->title = "SACP's";
        
        // Verifica se o usuário está logado
        if (!$this->logged_in) {
            $this->logout(true);
            return;
        }

        // Verifica se o usuário tem permissão
        if (!$this->check_permissions('sacp', 'visualizar', $this->userdata['user_permissions'])) {
            require_once ABSPATH . '/includes/403.php';
            return;
		}
			
		/** Carrega os arquivos do view **/
        require ABSPATH . '/views/_includes/header.php';
        require ABSPATH . '/views/sacp/sacp-view.php';
        require ABSPATH . '/views/_includes/footer.php';
    } // index


	public function page() 
	{
        $modelo = $this->load_model('sacp/sacp-model');
        echo $modelo->paginacao();
    }


	public function inserir() 
	{
		// Título da página
		$this->title = "Gerar SACP";
        
        // Verifica se o usuário está logado
        if (!$this->logged_in) {
            $this->logout(true);
            return;
        }

        // Verifica se o usuário tem permissão
        if (!$this->check_permissions('sacp', 'inserir', $this->userdata['user_permissions'])) {
            require_once ABSPATH . '/includes/403.php';
            return;
        }

        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();
        $modelo = $this->load_model('sacp/sacp-model');

		$setores = $modelo->listaSetores();
		//$setorSolicitante = $modelo->buscarSetor();
        $retorno = $modelo->inserirSACP();

        if ($retorno == 'success') {
			$this->modal_notification = MainModel::openNotification('Sucesso', 'SACP gerada com sucesso.', 'success');
		} elseif (!empty($retorno)) {
			$this->modal_notification = MainModel::openNotification('Erro', $retorno, 'error');
        }
        
		/** Carrega os arquivos do view **/
        require ABSPATH . '/views/_includes/header.php';
        require ABSPATH . '/views/sacp/inserir-sacp.php';
        require ABSPATH . '/views/_includes/footer.php';
    } // inserir


    public function editar($id)
	{
		$this->title = 'Editar SACP';

		// Verifica se o usuário está logado
		if (!$this->logged_in) {
			$this->logout(true);
			return;
		}

		// Verifica se o usuário tem permissão
		if (!$this->check_permissions('sacp', 'editar', $this->userdata['user_permissions'])) {
			require_once ABSPATH . '/includes/403.php';
			return;
		}

		$modelo = $this->load_model('sacp/sacp-model');
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		// Carrega o método para editar uma SACP
		$retorno = $modelo->editarSACP($id[0]);
		
		$dadosSACP = $modelo->consultaSACP($id[0]);
		extract($dadosSACP);

		if (empty($sacp)) {
			require_once ABSPATH . '/includes/404.php';
			return;
		}

		$usuarios = $modelo->listarUsuarios();
		$setorOrigem = $modelo->buscaSetor($userOrigem['setor']);
		$setorDestino = $modelo->buscaSetor($userDestino['setor']);
		
		if ($retorno == 'success') {
			$this->modal_notification = MainModel::openNotification('Sucesso', 'SACP atualizada com sucesso.', 'success');
		} elseif (!empty($retorno)) {
			$this->modal_notification = MainModel::openNotification('Erro', $retorno, 'error');
		}

		require ABSPATH . '/views/_includes/header.php';
		require ABSPATH . '/views/sacp/editar-sacp.php';
		require ABSPATH . '/views/_includes/footer.php';
	}


    public function excluir($id)
	{
		$this->title = 'Excluir SACP';

		// Verifica se o usuário está logado
		if (!$this->logged_in) {
			$this->logout(true);
			return;
		}

		// Verifica se o usuário tem permissão
		if (!$this->check_permissions('sacp', 'excluir', $this->userdata['user_permissions'])) {
			require_once ABSPATH . '/includes/403.php';
			return;
		}
		
		$this->modal_message = MainModel::modalMessage('Excluir SACP', 'Tem certeza que deseja apagar esta SACP?', '<button type="submit" onclick="window.location=\''.$_SERVER['REQUEST_URI']. 'confirma/'.'\'" class="btn btn-success">Excluir</button>');
	
		$modelo = $this->load_model('sacp/sacp-model');
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$modelo->form_confirma = $modelo->excluirSACP();
		
		require ABSPATH . '/views/_includes/header.php';
		//require ABSPATH . '/views/sacp/sacp-view.php';
		require ABSPATH . '/views/_includes/footer.php';
	}


	public function finalizar($id)
	{
		$this->title = 'Finalizar SACP';

		// Verifica se o usuário está logado
		if (!$this->logged_in) {
			$this->logout(true);
			return;
		}

		// Verifica se o usuário tem permissão
		if (!$this->check_permissions('sacp', 'editar', $this->userdata['user_permissions'])) {
			require_once ABSPATH . '/includes/403.php';
			return;
		}

		$modelo = $this->load_model('sacp/sacp-model');
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();
		
		$dadosSACP = $modelo->consultaSACP($id[0]);
		extract($dadosSACP);

		if (empty($sacp)) {
			require_once ABSPATH . '/includes/404.php';
			return;
		}

		$setorOrigem = $modelo->buscaSetor($userOrigem['setor']);
		$setorDestino = $modelo->buscaSetor($userDestino['setor']);

		// Carrega o método para finalizar uma SACP
		$retorno = $modelo->finalizarSACP($id[0]);
		
		if ($retorno == 'success') {
			$this->modal_notification = MainModel::openNotification('Sucesso', 'SACP finalizada com sucesso.', 'success');
		} elseif (!empty($retorno)) {
			$this->modal_notification = MainModel::openNotification('Erro', $retorno, 'error');
		}

		require ABSPATH . '/views/_includes/header.php';
		require ABSPATH . '/views/sacp/finalizar-sacp.php';
		require ABSPATH . '/views/_includes/footer.php';
	}
	
} // class SacpController
