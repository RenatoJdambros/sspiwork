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
		if (!$this->check_permissions('home', 'visualizar', $this->userdata['user_permissions'])) {
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
		if (!$this->check_permissions('home', 'visualizar', $this->userdata['user_permissions'])) {
			require_once ABSPATH . '/includes/403.php';
			return;
		}
		
			
		/** Carrega os arquivos do view **/
        require ABSPATH . '/views/_includes/header.php';
        require ABSPATH . '/views/sacp/inserir-sacp.php';
        require ABSPATH . '/views/_includes/footer.php';
		
    } // index
	
} // class HomeController