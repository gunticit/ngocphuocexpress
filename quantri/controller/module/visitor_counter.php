<?php

class ControllerModuleVisitorCounter extends Controller {
	
	private $error = array(); 
	
	public function install() {
		$this->load->model('module/visitor_counter');
		$this->model_module_visitor_counter->createVisitorTable();
		
		$this->load->model('setting/setting');
		$whmcsapi['visitor_counter_status'] = 1;
		$this->model_setting_setting->editSetting('visitor_counter',$whmcsapi);
	}
	
	public function uninstall() {
		$this->load->model('module/visitor_counter');
		$this->model_module_visitor_counter->deleteVisitorTable();
	}
	
	public function index() {   
		
        $this->load->language('module/visitor_counter');

        $this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('visitor_counter', $this->request->post);		
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$text_strings = array(
				'heading_title',
				'text_enabled',
				'text_disabled',
				'text_left',
				'text_right',
				'text_module',
				'text_success',
				'text_total_visitors',
				'text_total_hits',
				'text_edit',
				'entry_limit',
				'entry_image',
				'entry_count_type',
				'entry_layout',
				'entry_position',
				'entry_status',
				'entry_sort_order',
				'button_save',
				'button_cancel',
				'button_add_module',
				'button_remove',
				'error_permission',
		);
		
		foreach ($text_strings as $text) {
			$data[$text] = $this->language->get($text);
		}
		
		$config_data = array(
			'visitor_counter_main_counter',
			'visitor_counter_status'
		);
		
		foreach ($config_data as $conf) {
			if (isset($this->request->post[$conf])) {
				$data[$conf] = $this->request->post[$conf];
			} else {
				$data[$conf] = $this->config->get($conf);
			}
		}
	
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/visitor_counter', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$data['action'] = $this->url->link('module/visitor_counter', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

	
		$data['modules'] = array();
		
		if (isset($this->request->post['visitor_counter_module'])) {
			$data['modules'] = $this->request->post['visitor_counter_module'];
		} elseif ($this->config->get('visitor_counter_module')) { 
			$data['modules'] = $this->config->get('visitor_counter_module');
		}		

		$this->load->model('design/layout');
		
		$data['layouts'] = $this->model_design_layout->getLayouts();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/visitor_counter.tpl', $data));
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/visitor_counter')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}


}
?>
