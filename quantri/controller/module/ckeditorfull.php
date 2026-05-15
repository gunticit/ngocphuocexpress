<?php
class ControllerModuleCkeditorfull extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/ckeditorfull');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('ckeditorfull', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], true));
		}

		// Skins directory.
		$data['ck_skins_dir'] = HTTPS_SERVER . "view" . DIRECTORY_SEPARATOR . "javascript" . DIRECTORY_SEPARATOR . "ckeditor" . DIRECTORY_SEPARATOR . "skins" . DIRECTORY_SEPARATOR ;

		// Local literals
		$data['ck_skins'] = array("bootstrapck","flat","icy_orange","kama","minimalist","moono","moono-lisa","moono_blue","moonocolor","moono-dark","office2013");
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['entry_skin'] = $this->language->get('entry_skin');
		$data['entry_skin_preview'] = $this->language->get('entry_skin_preview');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_apikey'] = $this->language->get('entry_apikey');
		$data['entry_acf'] = $this->language->get('entry_acf');
		$data['help_apikey'] = $this->language->get('help_apikey');

		// Global literals.
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['height'])) {
			$data['error_height'] = $this->error['height'];
		} else {
			$data['error_height'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true),
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], true),
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/ckeditorfull', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('module/ckeditorfull', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], true);


		if (isset($this->request->post['ckeditorfull_skin'])) {
			$data['ckeditorfull_skin'] = $this->request->post['ckeditorfull_skin'];
		} else {
			$data['ckeditorfull_skin'] = $this->config->get('ckeditorfull_skin')?$this->config->get('ckeditorfull_skin'):"moono-lisa";
		}

		if (isset($this->request->post['ckeditorfull_height'])) {
			$data['ckeditorfull_height'] = $this->request->post['ckeditorfull_height'];
		} elseif ($this->config->has('ckeditorfull_height')) {
			$data['ckeditorfull_height'] = $this->config->get('ckeditorfull_height');
		} else {
			$data['ckeditorfull_height'] = '';
		}

		if (isset($this->request->post['ckeditorfull_apikey'])) {
			$data['ckeditorfull_apikey'] = $this->request->post['ckeditorfull_apikey'];
		} elseif ($this->config->has('ckeditorfull_apikey')) {
			$data['ckeditorfull_apikey'] = $this->config->get('ckeditorfull_apikey');
		} else {
			$data['ckeditorfull_apikey'] = '';
		}

		if (isset($this->request->post['ckeditorfull_acf'])) {
			$data['ckeditorfull_acf'] = $this->request->post['ckeditorfull_acf'];
		} elseif ($this->config->has('ckeditorfull_acf')) {
			$data['ckeditorfull_acf'] = $this->config->get('ckeditorfull_acf');
		} else {
			$data['ckeditorfull_acf'] = 'true';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/ckeditorfull.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/ckeditorfull')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!ctype_digit($this->request->post['ckeditorfull_height']) and $this->request->post['ckeditorfull_height'] !== '') {
			$this->error['height'] = $this->language->get('error_height');
		}

		return !$this->error;
	}
}


