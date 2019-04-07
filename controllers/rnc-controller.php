<?php
/**
 * home - Controller de exemplo
 *
 * @package TutsupMVC
 * @since 0.1
 */
class Rnc extends MainController
{

	/**
	 * Carrega a página "/views/home/index.php"
	 */
    public function index() {
		// Título da página
		$this->title = 'rnc-gerar';
		
			
		/** Carrega os arquivos do view **/
        require ABSPATH . '/views/_includes/header.php';
        require ABSPATH . '/views/rnc/gerar-rnc.php';
        require ABSPATH . '/views/_includes/footer.php';
		
    } // index
	
} // class HomeController