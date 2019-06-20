<?php
/**
 * Verifica chaves de arrays
 *
 * Verifica se a chave existe no array e se ela tem algum valor.
 * Obs.: Essa função está no escopo global, pois, vamos precisar muito da mesma.
 *
 * @param array  $array O array
 * @param string $key   A chave do array
 * @return string|null  O valor da chave do array ou nulo
 */
function chk_array($array, $key) {
	// Verifica se a chave existe no array
	if (isset($array[$key]) && !empty($array[$key])) {
		// Retorna o valor da chave
		return $array[$key];
	}

	// Retorna nulo por padrão
	return null;
} // chk_array

/**
 * Função para carregar automaticamente todas as classes padrão
 * Ver: http://php.net/manual/pt_BR/function.autoload.php.
 * Nossas classes estão na pasta classes/.
 * O nome do arquivo deverá ser class-NomeDaClasse.php.
 * Por exemplo: para a classe TutsupMVC, o arquivo vai chamar class-TutsupMVC.php
 */
spl_autoload_register(function ($class_name) {
	$file = ABSPATH . '/classes/class-' . $class_name . '.php';
	
	if (!file_exists($file)) {
	  return;
	}
	
	// Inclui o arquivo da classe
	require_once $file;
});

/**
 * Função para debugar variáveis.
 *
 * @author Luiz Comiran
 *
 * @param $var variável a ser debugada
 * @param $type opcional, especifica como deve ser debugada e se deve matar o script ou não
 * @param $name opcional, "título" para a variável debugada
 *
 * @return var variável debugada
 */
function info($var, $type = null, $name = null)
{
    echo '<div style="display:inline-block;"><pre style="font-size:14;">';

    if (!empty($name)) {
        echo "<b>$name</b>:<br><br>";
    }

    switch ($type) {
        case 'h':
            var_dump($var);
            break;

        case 'die':
            print_r($var);
            die();
        
        case 'hdie':
            var_dump($var);
            die();
        
        default:
            print_r($var);
            break;
    }

    echo '</pre></div><br><br>';
    return; 
}