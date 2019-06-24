<?php
class SacpController extends MainController
{
	public function index() 
	{
		// Título da página
        $this->title = "SACP's";
        
        // Verifica se o usuário está logado
        if (!$this->logged_in) {
            $this->logout(true);
            return;
        }

        // Verifica se o usuário tem permissão
        if (!$this->check_permissions('sacp', 'visualizar', $this->userdata['user_permissions'])) {
            require_once ABSPATH . '/includes/403.php';
            return;
		}
			
		/** Carrega os arquivos do view **/
        require ABSPATH . '/views/_includes/header.php';
        require ABSPATH . '/views/sacp/sacp-view.php';
        require ABSPATH . '/views/_includes/footer.php';
    } // index


	public function page() 
	{
        $modelo = $this->load_model('sacp/sacp-model');
        echo $modelo->paginacao();
    }


	public function inserir() 
	{
		// Título da página
		$this->title = "Gerar SACP";
        
        // Verifica se o usuário está logado
        if (!$this->logged_in) {
            $this->logout(true);
            return;
        }

        // Verifica se o usuário tem permissão
        if (!$this->check_permissions('sacp', 'inserir', $this->userdata['user_permissions'])) {
            require_once ABSPATH . '/includes/403.php';
            return;
        }

        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();
        $modelo = $this->load_model('sacp/sacp-model');

		$setores = $modelo->listaSetores();
		//$setorSolicitante = $modelo->buscarSetor();
		$participantes = $modelo->listarUsuarios();
        $retorno = $modelo->inserirSACP();

        if ($retorno == 'success') {
			$this->modal_notification = MainModel::openNotification('Sucesso', 'SACP gerada com sucesso.', 'success');
		} elseif (!empty($retorno)) {
			$this->modal_notification = MainModel::openNotification('Erro', $retorno, 'error');
        }
        
		/** Carrega os arquivos do view **/
        require ABSPATH . '/views/_includes/header.php';
        require ABSPATH . '/views/sacp/inserir-sacp.php';
        require ABSPATH . '/views/_includes/footer.php';
    } // inserir


    public function editar()
	{
		$this->title = 'Editar SACP';

		// Verifica se o usuário está logado
		if (!$this->logged_in) {
			$this->logout(true);
			return;
		}

		// Verifica se o usuário tem permissão
		// if (!$this->check_permissions('sacp', 'editar', $this->userdata['user_permissions'])) {
		// 	require_once ABSPATH . '/includes/403.php';
		// 	return;
		// }

		$modelo = $this->load_model('sacp/sacp-model');
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		// Carrega o método para editar uma SACP
		$retorno = $modelo->editarSACP($parametros);
		
		$sacpPresente = $modelo->listarSacpsPresentes();
		$setores = $modelo->listaSetores();
		$participantes = $modelo->listarUsuarios();
		$dados = $modelo->consultaSACP($parametros);

		if (empty($dados)) {
			require_once ABSPATH . '/includes/404.php';
			return;
		}

		if ($this->userdata['tipo_usuario'] == 3 && $dados['status'] == 3) {
			require_once ABSPATH . '/includes/finalizada.php';
			return;
		}
		
		if ($retorno == 'success') {
			$this->modal_notification = MainModel::openNotification('Sucesso', 'SACP atualizada com sucesso.', 'success');
		} elseif (!empty($retorno)) {
			$this->modal_notification = MainModel::openNotification('Erro', $retorno, 'error');
		}

		require ABSPATH . '/views/_includes/header.php';
		require ABSPATH . '/views/sacp/editar-sacp.php';
		require ABSPATH . '/views/_includes/footer.php';
	}


    public function excluir($id)
	{
		$this->title = 'Excluir SACP';

		// Verifica se o usuário está logado
		if (!$this->logged_in) {
			$this->logout(true);
			return;
		}

		// Verifica se o usuário tem permissão
		if (!$this->check_permissions('sacp', 'excluir', $this->userdata['user_permissions'])) {
			require_once ABSPATH . '/includes/403.php';
			return;
		}
		
		$this->modal_message = MainModel::modalMessage('Excluir SACP', 'Tem certeza que deseja apagar esta SACP?', '<button type="submit" onclick="window.location=\''.$_SERVER['REQUEST_URI']. 'confirma/'.'\'" class="btn btn-success">Excluir</button>');
	
		$modelo = $this->load_model('sacp/sacp-model');
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$modelo->form_confirma = $modelo->excluirSACP();
		
		require ABSPATH . '/views/_includes/header.php';
		//require ABSPATH . '/views/sacp/sacp-view.php';
		require ABSPATH . '/views/_includes/footer.php';
	}


	public function finalizar()
	{
		$this->title = 'Finalizar SACP';

		// Verifica se o usuário está logado
		if (!$this->logged_in) {
			$this->logout(true);
			return;
		}

		// Verifica se o usuário tem permissão
		if (!$this->check_permissions('sacp', 'editar', $this->userdata['user_permissions'])) {
			require_once ABSPATH . '/includes/403.php';
			return;
		}

		$modelo = $this->load_model('sacp/sacp-model');
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$dados = $modelo->consultaSACP($parametros);

		if (empty($dados)) {
			require_once ABSPATH . '/includes/404.php';
			return;
		}

		$setores = $modelo->listaSetores();
		$participantes = $modelo->listarUsuarios();

		// Carrega o método para finalizar uma SACP
		$retorno = $modelo->finalizarSACP($parametros[0]);
		
		if ($retorno == 'success') {
			$this->modal_notification = MainModel::openNotification('Sucesso', 'SACP finalizada com sucesso.', 'success');
		} elseif (!empty($retorno)) {
			$this->modal_notification = MainModel::openNotification('Erro', $retorno, 'error');
		}

		require ABSPATH . '/views/_includes/header.php';
		require ABSPATH . '/views/sacp/finalizar-sacp.php';
		require ABSPATH . '/views/_includes/footer.php';
	}


	public function gerarSACPdeRNC()
	{
		$this->title = 'Editar SACP';

		// Verifica se o usuário está logado
		if (!$this->logged_in) {
			$this->logout(true);
			return;
		}

		// Verifica se o usuário tem permissão
		if (!$this->check_permissions('sacp', 'editar', $this->userdata['user_permissions'])) {
			require_once ABSPATH . '/includes/403.php';
			return;
		}

		$modelo = $this->load_model('sacp/sacp-model');
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		// Carrega o método para editar uma SACP
		$retorno = $modelo->gerarSACPdeRNC($parametros[0]);
		
		$dados = $modelo->consultaRNC($parametros);

		$setores = $modelo->listaSetores();
		$participantes = $modelo->listarUsuarios();

		if (empty($dados)) {
			require_once ABSPATH . '/includes/404.php';
			return;
		}
		
		if ($retorno == 'success') {
			$this->modal_notification = MainModel::openNotification('Sucesso', 'SACP atualizada com sucesso.', 'success');
		} elseif (!empty($retorno)) {
			$this->modal_notification = MainModel::openNotification('Erro', $retorno, 'error');
		}

		require ABSPATH . '/views/_includes/header.php';
		require ABSPATH . '/views/sacp/editar-sacp.php';
		require ABSPATH . '/views/_includes/footer.php';
	}


	public function inserirPlano()
	{
		$this->title = 'Inserir Plano de Ação';

		// Verifica se o usuário está logado
		if (!$this->logged_in) {
			$this->logout(true);
			return;
		}

		// Verifica se o usuário tem permissão
		if (!$this->check_permissions('sacp', 'editar', $this->userdata['user_permissions'])) {
			require_once ABSPATH . '/includes/403.php';
			return;
		}

		$modelo = $this->load_model('sacp/sacp-model');
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$dados = $modelo->consultaSACP(array($parametros[0]));

		$participantes = $modelo->consultaParticipantes($dados['participantes']);
		$setor = $modelo->consultaSetor($dados['setor_destino']);

		// Carrega o método para editar uma SACP
		$retorno = $modelo->inserirPlano($parametros);

		if ($retorno == 'success') {
			$this->modal_notification = MainModel::openNotification('Sucesso', 'Plano inserido com sucesso.', 'success');
		} elseif (!empty($retorno)) {
			$this->modal_notification = MainModel::openNotification('Erro', $retorno, 'error');
		}

		require ABSPATH . '/views/_includes/header.php';
		require ABSPATH . '/views/sacp/inserir-plano.php';
		require ABSPATH . '/views/_includes/footer.php';
	}


	public function editarPlano()
	{
		$this->title = 'Editar Plano de Ação';

		// Verifica se o usuário está logado
		if (!$this->logged_in) {
			$this->logout(true);
			return;
		}

		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		// Verifica se o usuário tem permissão
		if (!$this->check_permissions('sacp', 'editar', $this->userdata['user_permissions'])
		  && $this->userdata['id'] != $parametros[3]) {
			require_once ABSPATH . '/includes/403.php';
			return;
		}

		$modelo = $this->load_model('sacp/sacp-model');

		$dados = $modelo->consultaSACP(array($parametros[0]));

		$participantes = $modelo->consultaParticipantes($dados['participantes']);
		$setor = $modelo->consultaSetor($dados['setor_destino']);

		// Carrega o método para editar uma SACP
		$retorno = $modelo->editarPlano($parametros[2]);

		$dadosPlano = $modelo->consultarPlano($parametros[2]);

		if ($this->userdata['tipo_usuario'] == 3 && $dadosPlano['status'] == 3) {
			require_once ABSPATH . '/includes/finalizada.php';
			return;
		}

		if ($retorno == 'success') {
			$this->modal_notification = MainModel::openNotification('Sucesso', 'Plano atualizado com sucesso.', 'success');
		} elseif (!empty($retorno)) {
			$this->modal_notification = MainModel::openNotification('Erro', $retorno, 'error');
		}

		require ABSPATH . '/views/_includes/header.php';
		require ABSPATH . '/views/sacp/editar-plano.php';
		require ABSPATH . '/views/_includes/footer.php';
	}


	public function excluirPlano($id)
	{
		$this->title = 'Excluir Plano de Ação';

		// Verifica se o usuário está logado
		if (!$this->logged_in) {
			$this->logout(true);
			return;
		}

		// Verifica se o usuário tem permissão
		if (!$this->check_permissions('sacp', 'excluir', $this->userdata['user_permissions'])) {
			require_once ABSPATH . '/includes/403.php';
			return;
		}
		
		$this->modal_message = MainModel::modalMessage('Excluir Plano de Ação', 'Tem certeza que deseja apagar este plano?', '<button type="submit" onclick="window.location=\''.$_SERVER['REQUEST_URI']. 'confirma/'.'\'" class="btn btn-success">Excluir</button>');
	
		$modelo = $this->load_model('sacp/sacp-model');
		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		$modelo->form_confirma = $modelo->excluirPlano();
		
		require ABSPATH . '/views/_includes/header.php';
		//require ABSPATH . '/views/sacp/sacp-view.php';
		require ABSPATH . '/views/_includes/footer.php';
	}


	public function finalizarPlano()
	{
		$this->title = 'Finalizar Plano de Ação';

		// Verifica se o usuário está logado
		if (!$this->logged_in) {
			$this->logout(true);
			return;
		}

		$parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();

		// Verifica se o usuário tem permissão
		if (!$this->check_permissions('sacp', 'editar', $this->userdata['user_permissions'])
		  && $this->userdata['id'] != $parametros[3]) {
			require_once ABSPATH . '/includes/403.php';
			return;
		}

		$modelo = $this->load_model('sacp/sacp-model');

		$dados = $modelo->consultaSACP(array($parametros[0]));

		$participantes = $modelo->consultaParticipantes($dados['participantes']);
		$setor = $modelo->consultaSetor($dados['setor_destino']);

		// Carrega o método para finalizar uma SACP
		$retorno = $modelo->finalizarPlano($parametros[2]);

		$dadosPlano = $modelo->consultarPlano($parametros[2]);

		if ($this->userdata['tipo_usuario'] == 3 && $dadosPlano['status'] == 3) {
			require_once ABSPATH . '/includes/finalizada.php';
			return;
		}

		if ($retorno == 'success') {
			$this->modal_notification = MainModel::openNotification('Sucesso', 'Plano finalizado com sucesso.', 'success');
		} elseif (!empty($retorno)) {
			$this->modal_notification = MainModel::openNotification('Erro', $retorno, 'error');
		}

		require ABSPATH . '/views/_includes/header.php';
		require ABSPATH . '/views/sacp/finalizar-plano.php';
		require ABSPATH . '/views/_includes/footer.php';
	}
	
} // class SacpController
