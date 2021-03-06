<?php
class LoginController extends MainController
{
    public function index() 
    {
        // Título da página
        $this->title = 'Login SSPI';
        
        // Parametros da função
        $parametros = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();

        // Login não tem Model
        
        /** Carrega os arquivos do view **/
        require ABSPATH . '/views/login/login-view.php';
    }
	

	public function sair()
	{
		$this->logout(true);
	}
	
} // class LoginController