<?php

class RncController extends MainController
{
	
    public function index() {
		// Título da página
		$this->title = "RNC's";
		
			
		/** Carrega os arquivos do view **/
        require ABSPATH . '/views/_includes/header.php';
        require ABSPATH . '/views/rnc/rnc-view.php';
        require ABSPATH . '/views/_includes/footer.php';
		
    } // index

    public function inserir() {
		// Título da página
		$this->title = "Gerar RNC's";
		
			
		/** Carrega os arquivos do view **/
        require ABSPATH . '/views/_includes/header.php';
        require ABSPATH . '/views/rnc/inserir-rnc.php';
        require ABSPATH . '/views/_includes/footer.php';
		
    } // index
	
} // class HomeController