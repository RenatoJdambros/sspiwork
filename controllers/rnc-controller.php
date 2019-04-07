<?php

class RncController extends MainController
{

	/**
	 * Carrega a página "/views/home/index.php"
	 */
    public function index() {
		// Título da página
		$this->title = 'Gerar RNC';
		
			
		/** Carrega os arquivos do view **/
        require ABSPATH . '/views/_includes/header.php';
        require ABSPATH . '/views/rnc/gerar-rnc.php';
        require ABSPATH . '/views/_includes/footer.php';
		
    } // index
	
} // class HomeController