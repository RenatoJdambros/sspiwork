<?php 
/**
 * Modelo para gerenciar produtos
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
		if ('POST' == $_SERVER['REQUEST_METHOD'] && ! empty($_POST['insere_configuracoes'])) {
			
			unset($_POST['insere_configuracoes']);
			
			$query = $this->db->update('ut_configuracoes', 'id',$user_id[0],$_POST);
			
			if ($query) {
				return 'success';
			}
			return 'error';
		}
	} 

	
	public function consult_configuracoes($user_id)
	{
		$query = $this->db->query('SELECT * FROM ut_configuracoes WHERE id = ? LIMIT 1', $user_id);
		$fetch_data = $query->fetch();

		if (empty($fetch_data)) {
			return;
		}
	 	return $fetch_data;
	}
	
} // 
