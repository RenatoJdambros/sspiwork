<?php 
class SetoresModel extends MainModel
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


	public function paginacao()
    {
        $columns = $this->formatar_colunas();
        $page = DataTable::simple($_POST, $this->db->pdo, 'setores', 'id', $columns);

        return json_encode($page);
    }


    private function formatar_colunas()
    {
        return array(
            ['dt' => 0, 'db' => 'id'],
            ['dt' => 1, 'db' => 'nome'],
            ['dt' => 2, 'db' => 'id', 'formatter' => function($d) 
            {
                ob_start(); ?>
                    <div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Mais <span class="caret"></span> </button>
                        <ul class="dropdown-menu">
                            <?php if ($this->controller->check_permissions('setores', 'editar', $this->userdata['user_permissions'])) { ?>
                                <li>
                                    <a href="<?= HOME_URI ?>/setores/editar/<?= $d ?>"><i class="fa fa-edit"></i> Editar</a>
                                </li>
                            <?php } ?>
                            <?php if ($this->controller->check_permissions('setores', 'excluir', $this->userdata['user_permissions'])) { ?>
                                <li>
                                    <a href="<?= HOME_URI ?>/setores/excluir/<?= $d ?>/"><i class="fa fa-remove"></i> Excluir</a>
                                    <div style="display:none">
                                        <button type="button" class="btn btn-primary" id="btn_modal" data-toggle="modal" data-target=".bs-example-modal-sm">Small modal</button>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php
                $data = ob_get_contents();
                ob_end_clean();
                return $data;
            }]
        );
	} // end formatar colunas


	public function inserirSetor() 
	{
		/* 
		Verifica se algo foi postado e se está vindo do form que tem o campo
		inserirSetor.
		*/
		if ('POST' != $_SERVER['REQUEST_METHOD'] || empty($_POST['inserirSetor'])) {
			return;
		}

		// Remove o campo inserirSetor para não gerar problema com o PDO
		unset($_POST['inserirSetor']);
		
		$query = $this->db->insert('setores', $_POST);
		
		// Verifica a consulta
		if ($query) {
			return 'success';		
		} 
		
		return 'Erro ao inserir setor no banco de dados';

	} // inserirUsuario
	
	
	public function editarSetor($id) 
	{
		/* 
		Verifica se algo foi postado e se está vindo do form que tem o campo
		editarSetor.
		*/
		if ('POST' != $_SERVER['REQUEST_METHOD'] || empty($_POST['editarSetor'])) {
			return;
		}

		// Remove o campo editarSetor para não gerar problema com o PDO
		unset($_POST['editarSetor']);

		// Atualiza os dados
		$query = $this->db->update('setores', 'id', $id[0], $_POST);
		
		// Verifica a consulta
		if ($query) {
			return 'success';
		}
		return 'Falha ao editar no banco de dados';
	} 
	
	
	public function excluirSetor() 
	{
		// O segundo parâmetro deverá ser um ID numérico
		if (! is_numeric(chk_array($this->parametros, 0))) {
			return;
		}

		// Para excluir, o terceiro parâmetro deverá ser "confirma"
		if (chk_array($this->parametros, 1) != 'confirma') {
			return;	
		}

		// Configura o ID do Usuário
		$idSetor = (int)chk_array($this->parametros, 0);;
		
		// Executa a consulta
		$query = $this->db->delete('setores', 'id', $idSetor);
		
		// Redireciona para a página de usuários
		echo '<meta http-equiv="Refresh" content="0; url=' . HOME_URI . '/setores/">';
		echo '<script type="text/javascript">window.location.href = "' . HOME_URI . '/setores/";</script>';
		
	}


	public function consultaSetor($id)
	{
		// Faz a consulta para obter o valor
		$query = $this->db->query('SELECT * FROM setores WHERE id = ? LIMIT 1', $id);
		$result = $query->fetch(PDO::FETCH_ASSOC);

		// Se os dados estiverem nulos, não faz nada
		if (empty($result)) {
			return;
		}
	 	return $result;
	}
	
} // SetoresModel
