<?php 
/**
 * Modelo para gerenciar configurações
 *
 * @package TutsupMVC
 * @since 0.1
 */
class ConfiguracoesModel extends MainModel
{
	public function __construct($db = false, $controller = null) 
	{
		// Configura o DB (PDO)
		$this->db = $db;
		
		// Configura o controlador
		$this->controller = $controller;

		// Configura os parâmetros
		$this->parametros = $this->controller->parametros;

		// Configura os dados do usuário
		$this->userdata = $this->controller->userdata;
	}

	
	public function listar_configuracoes($id=null) 
	{
		$query = $this->db->query('SELECT * FROM configuracoes ORDER BY id DESC');
		return $query->fetchAll();
	}
	
	
	public function update_configuracoes($user_id) 
	{
		if ('POST' == $_SERVER['REQUEST_METHOD'] && ! empty($_POST['inserirConfiguracoes'])) {
			
			unset($_POST['inserirConfiguracoes']);
			
			$query = $this->db->update('configuracoes', 'id',$user_id[0],$_POST);
			
			if ($query) {
				return 'success';
			}
			return 'error';
		}
	} 

	
	public function consult_configuracoes($user_id)
	{
		$query = $this->db->query('SELECT * FROM configuracoes WHERE id = ? LIMIT 1', $user_id);
		$resultado = $query->fetch();

		if (empty($resultado)) {
			return;
		}
	 	return $resultado;
	}
	
} // 
