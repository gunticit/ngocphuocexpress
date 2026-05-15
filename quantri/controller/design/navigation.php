<?php
class ControllerDesignNavigation extends Controller {
	private $error = array();
	public function index() {
		$this->load->model('design/navigation');
		$data['menu_data'] = $this->model_design_navigation->getlist();
		$this->load->language('design/navigation');

		$this->document->setTitle($this->language->get('meta_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->save();
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('design/navigation', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('meta_title');
		$data['text_edit'] = $this->language->get('text_edit');
		
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_link'] = $this->language->get('entry_link');
		$data['entry_icon'] = $this->language->get('entry_icon');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_add_menu'] = $this->language->get('button_add_menu');
		

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		}
		$data['breadcrumbs'] = array();
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('design/navigation', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

		$data['action'] = $this->url->link('design/navigation/index', 'token=' . $this->session->data['token'], 'SSL');
		$data['option_action'] = $this->url->link('design/navigation/getOption');

		$data['cancel'] = $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL');

		$data['token'] 	= $this->session->data['token'];
		
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		$data['model'] = $this->model_design_navigation;
		
		$this->document->addScript('view/javascript/navigation/jquery.nestable.js');
		$this->document->addScript('view/javascript/navigation/navigation.js');
		$this->document->addScript('view/javascript/fontawesome-iconpicker.min.js');
		
		$this->document->addStyle('view/stylesheet/navigation/navigation.css');
		$this->document->addStyle('view/stylesheet/fontawesome-iconpicker.min.css');
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('design/navigation.tpl', $data));
	}
	
	protected function save() {
		$this->load->model('design/navigation');
		$this->model_design_navigation->empty_data();
		if(isset($this->request->post['title'])){
			$data['title'] = $this->request->post['title'];
			$data['parent_id'] = $this->request->post['parent_id'];
			$data['url'] = $this->request->post['url'];
			$data['icon'] = $this->request->post['icon'];
			$this->model_design_navigation->insert($data);
		}

	}
	private function validate() {
		if (!$this->user->hasPermission('modify', 'design/navigation')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
}