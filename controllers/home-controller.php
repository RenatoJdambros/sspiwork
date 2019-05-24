<?php
class HomeController extends MainController
{
    public function index() {
		// Título da página
		$this->title = 'Beasy Beacons - Home';
		
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
		
		// Parametros da função
		$parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
	
		
		/** Carrega os arquivos do view **/
        require ABSPATH . '/views/_includes/header.php';
        require ABSPATH . '/views/home/home-view.php';
        require ABSPATH . '/views/_includes/footer.php';
    } // index
	
} // class HomeController