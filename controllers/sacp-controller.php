<?php

class SacpController extends MainController
{

    public function index() {
		// Título da página
		$this->title = "SACP's";
		
			
		/** Carrega os arquivos do view **/
        require ABSPATH . '/views/_includes/header.php';
        require ABSPATH . '/views/sacp/sacp-view.php';
        require ABSPATH . '/views/_includes/footer.php';
		
    } // index

    public function inserir() {
		// Título da página
		$this->title = "Gerar SACP's";
		
			
		/** Carrega os arquivos do view **/
        require ABSPATH . '/views/_includes/header.php';
        require ABSPATH . '/views/sacp/inserir-sacp.php';
        require ABSPATH . '/views/_includes/footer.php';
		
    } // index
	
} // class HomeController