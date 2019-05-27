<?php

class SacpController extends MainController
{
    public function index() {
		// Título da página
		$this->title = "SACP's";
        
        // Verifica se o usuário está logado
		if (! $this->logged_in) {
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
	

    public function inserir() {
		// Título da página
        $this->title = "Gerar SACP's";
        
        // Verifica se o usuário está logado
		if (! $this->logged_in) {
			$this->logout(true);
			return;
		}

		// Verifica se o usuário tem permissão
		if (!$this->check_permissions('sacp', 'inserir', $this->userdata['user_permissions'])) {
			require_once ABSPATH . '/includes/403.php';
			return;
		}
		
			
		/** Carrega os arquivos do view **/
        require ABSPATH . '/views/_includes/header.php';
        require ABSPATH . '/views/sacp/inserir-sacp.php';
        require ABSPATH . '/views/_includes/footer.php';
		
	} // index

	
	public function gerarSACPdeRNC($id) {
		// Título da página
		$this->title = "Gerar SACP(RNC)";
        
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
	
} // class HomeController