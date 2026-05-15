<?php
class ControllerDesignMegaMenu extends Controller {
	private $error = array();
	public function index() {
		$this->load->model('design/megamenu');
		$this->load->language('design/megamenu');
		
		$this->document->addScript('view/javascript/megamenu/jquery.nestable.js');;
		$this->document->addStyle('view/stylesheet/megamenu/megamenu.css');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$data['menu_data'] = $this->model_design_megamenu->getlist();

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->save();
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('design/megamenu', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_page'] = $this->language->get('text_page');
		$data['text_category'] = $this->language->get('text_category');
		$data['text_thread'] = $this->language->get('text_thread');
		$data['text_information'] = $this->language->get('text_information');
		$data['text_manufacturer'] = $this->language->get('text_manufacturer');
		$data['text_custom'] = $this->language->get('text_custom');
		
		$data['text_explane'] = $this->language->get('text_explane');
		$data['text_collapse'] = $this->language->get('text_collapse');
		$data['text_remove'] = $this->language->get('text_remove');
		$data['text_active_mega'] = $this->language->get('text_active_mega');
		$data['text_deactivate_mega'] = $this->language->get('text_deactivate_mega');
		
		$data['entry_type'] = $this->language->get('entry_type');
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_url'] = $this->language->get('entry_url');
		$data['entry_column'] = $this->language->get('entry_column');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_content'] = $this->language->get('entry_content');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_add_menu'] = $this->language->get('button_add_menu');
		$data['button_add_option'] = $this->language->get('button_add_option');
		$data['button_remove_option'] = $this->language->get('button_remove_option');

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
			'href'      => $this->url->link('design/megamenu', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

		$data['action'] = $this->url->link('design/megamenu/index', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL');

		$data['token'] 	= $this->session->data['token'];
		
		$this->load->model('design/page');
		$data['pages'] = $this->model_design_page->getPages();

		$this->load->model('catalog/category');
		$data['categories'] = $this->model_catalog_category->getCategories(0);
		
		$this->load->model('catalog/thread');
		$data['threads'] = $this->model_catalog_thread->getThreads();

		$this->load->model('catalog/manufacturer');
		$data['manufacturers'] = $this->model_catalog_manufacturer->getManufacturers();

		$this->load->model('catalog/information');
		$data['informations'] = $this->model_catalog_information->getInformations();
		
		/* Multi Language */
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		$data['model'] = $this->model_design_megamenu;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('design/megamenu.tpl', $data));
	}
	protected function save() {
		$this->load->model('design/megamenu');
		$this->model_design_megamenu->empty_data();
		if(isset($this->request->post['title'])){
			$data['title'] = $this->request->post['title'];
			$data['type'] = $this->request->post['type'];
			$data['parent_id'] = $this->request->post['parent_id'];
			$data['type_id'] = $this->request->post['type_id'];
			$data['url'] = $this->request->post['url'];
			$data['columns'] = $this->request->post['columns'];
			$data['widths'] = $this->request->post['widths'];
			$data['content_submenu'] = $this->request->post['content_submenu'];
			$data['activemega'] = $this->request->post['activemega'];
			$this->model_design_megamenu->insert($data);
		}

	}
	private function validate() {
		if (!$this->user->hasPermission('modify', 'design/megamenu')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
}