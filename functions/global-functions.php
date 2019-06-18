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

// Printr formatado
function info($var, $name = null)
{
  echo '<div style="display: inline-block;"><pre style=font-size:14;>';
  if (!empty($name)) {
    echo "<b>$name</b>:";
    echo '<br><br>';
  }
  print_r($var);
  echo '</pre></div>';
  echo '<br><br>';
}


// Printr formatado e mata o script
function infodie($var, $name = null)
{
  echo '<div style="display: inline-block;"><pre style=font-size:14;>';
  if (!empty($name)) {
    echo "<b>$name</b>:";
    echo '<br><br>';
  }
  print_r($var);
  die();
}


// Vardump formatado
function infoh($var, $name = null)
{
  echo '<div style="display: inline-block;"><pre style=font-size:14;>';
  if (!empty($name)) {
    echo "<b>$name</b>:";
    echo '<br><br>';
  }
  var_dump($var);
  echo '</pre>';
  echo '<br><br>';
}


// Vardump formatado e mata o script
function infohdie($var, $name = null)
{
  echo '<div style="display: inline-block;"><pre style=font-size:14;>';
  if (!empty($name)) {
    echo "<b>$name</b>:";
    echo '<br><br>';
  }
  var_dump($var);
  die();
}


function dataBR($data, $time = null)
{
  $date = new DateTime($data);
  if ($time === true) {
    return $date->format('d/m/Y H:i:s');
  }
  return $date->format('d/m/Y');
}