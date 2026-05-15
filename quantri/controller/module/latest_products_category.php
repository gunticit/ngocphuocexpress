<?php
class ControllerModuleLatestproductscategory extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->load->language('module/latest_products_category');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('extension/module');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_extension_module->addModule('latest_products_category', $this->request->post);
			} else {
				$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
			}
						
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
				
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_limit'] = $this->language->get('entry_limit');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_height'] = $this->language->get('entry_height');
		
		$data['entry_category'] = $this->language->get('entry_category');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_normal'] = $this->language->get('entry_normal');
		$data['entry_carousel'] = $this->language->get('entry_carousel');
		$data['entry_subcats'] = $this->language->get('entry_subcats');
		$data['entry_snone'] = $this->language->get('entry_snone');
		$data['entry_filtering'] = $this->language->get('entry_filtering');
		$data['entry_ctabs'] = $this->language->get('entry_ctabs');
		$data['entry_pmin'] = $this->language->get('entry_pmin');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
		// Additional
		$data['entry_resolution'] = $this->language->get('entry_resolution');
		
		$data['text_banner_bottom1'] = $this->language->get('text_banner_bottom1');
		
		$data['entry_banner_bottom1'] = $this->language->get('entry_banner_bottom1');
		$data['entry_banner_bottom1_width'] = $this->language->get('entry_banner_bottom1_width');
		$data['entry_banner_bottom1_height'] = $this->language->get('entry_banner_bottom1_height');
		$data['entry_banner_bottom1_link'] = $this->language->get('entry_banner_bottom1_link');
        $data['entry_banner_bottom1_scale'] = $this->language->get('entry_banner_bottom1_scale');
		
		$data['text_banner_bottom2'] = $this->language->get('text_banner_bottom2');
		
		$data['entry_banner_bottom2'] = $this->language->get('entry_banner_bottom2');
		$data['entry_banner_bottom2_width'] = $this->language->get('entry_banner_bottom2_width');
		$data['entry_banner_bottom2_height'] = $this->language->get('entry_banner_bottom2_height');
		$data['entry_banner_bottom2_link'] = $this->language->get('entry_banner_bottom2_link');
        $data['entry_banner_bottom2_scale'] = $this->language->get('entry_banner_bottom2_scale');
		
		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}
		
		if (isset($this->error['width'])) {
			$data['error_width'] = $this->error['width'];
		} else {
			$data['error_width'] = '';
		}
		
		if (isset($this->error['height'])) {
			$data['error_height'] = $this->error['height'];
		} else {
			$data['error_height'] = '';
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
			'href'      => $this->url->link('module/latest_products_category', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('module/latest_products_category', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('module/latest_products_category', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
		}
		
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
		}
		
		$data['token'] = $this->session->data['token'];
		
		
		
		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}
		
		if (isset($this->request->post['category_id'])) {
			$data['category_id'] = $this->request->post['category_id'];
		} elseif (!empty($module_info)) {
			$data['category_id'] = $module_info['category_id'];
		} else {
			$data['category_id'] = '';
		}
		
		$this->load->model('catalog/category');
		
		$data['products'] = array();
		
		$results = $this->model_catalog_category->getCategories(0);
		foreach ($results as $result) {
							
			$data['categories'][] = array(
				'category_id' => $result['category_id'],
				'name'        => $result['name']
			);
		}
		
		if (isset($this->request->post['subcats'])) {
			$data['subcats'] = $this->request->post['subcats'];
		} elseif (!empty($module_info)) {
			$data['subcats'] = $module_info['subcats'];
		} else {
			$data['subcats'] = '';
		}
		
		if (isset($this->request->post['pmin'])) {
			$data['pmin'] = $this->request->post['pmin'];
		} elseif (!empty($module_info)) {
			$data['pmin'] = $module_info['pmin'];
		} else {
			$data['pmin'] = '1';
		}
			
		if (isset($this->request->post['limit'])) {
			$data['limit'] = $this->request->post['limit'];
		} elseif (!empty($module_info)) {
			$data['limit'] = $module_info['limit'];
		} else {
			$data['limit'] = 5;
		}
		
		if (isset($this->request->post['width'])) {
			$data['width'] = $this->request->post['width'];
		} elseif (!empty($module_info)) {
			$data['width'] = $module_info['width'];
		} else {
			$data['width'] = 200;
		}	
			
		if (isset($this->request->post['height'])) {
			$data['height'] = $this->request->post['height'];
		} elseif (!empty($module_info)) {
			$data['height'] = $module_info['height'];
		} else {
			$data['height'] = 200;
		}
		
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}
		
		$this->load->model('tool/image');
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		
		if (isset($this->request->post['banner_bottom1'])) {
			$data['banner_bottom1'] = $this->request->post['banner_bottom1'];
		} elseif (!empty($module_info)) {
			$data['banner_bottom1'] = $module_info['banner_bottom1'];
		} else {
			$data['banner_bottom1'] = array();
		}
		
		if (!isset($data['banner_bottom1']['image'])) {
			$data['banner_bottom1']['image'] = '';
		}
		
		if (!empty($data['banner_bottom1']['image'])) {
			$data['banner_bottom1']['thumb'] = $this->model_tool_image->resize($data['banner_bottom1']['image'], 100, 100);;
		} else {
			$data['banner_bottom1']['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);;
		}
		
		if (!isset($data['banner_bottom1']['width'])) {
			$data['banner_bottom1']['width'] = 1170;
		}
		
		if (!isset($data['banner_bottom1']['height'])) {
			$data['banner_bottom1']['height'] = 150;
		}
		
		if (!isset($data['banner_bottom1']['link'])) {
			$data['banner_bottom1']['link'] = '';
		}
        
		if (!isset($data['banner_bottom1']['scale'])) {
			$data['banner_bottom1']['scale'] = '';
		}
		
		if (isset($this->request->post['banner_bottom2'])) {
			$data['banner_bottom2'] = $this->request->post['banner_bottom2'];
		} elseif (!empty($module_info)) {
			$data['banner_bottom2'] = $module_info['banner_bottom2'];
		} else {
			$data['banner_bottom2'] = array();
		}
		
		if (!isset($data['banner_bottom2']['image'])) {
			$data['banner_bottom2']['image'] = '';
		}
		
		if (!empty($data['banner_bottom2']['image'])) {
			$data['banner_bottom2']['thumb'] = $this->model_tool_image->resize($data['banner_bottom2']['image'], 100, 100);;
		} else {
			$data['banner_bottom2']['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);;
		}
		
		if (!isset($data['banner_bottom2']['width'])) {
			$data['banner_bottom2']['width'] = 1170;
		}
		
		if (!isset($data['banner_bottom2']['height'])) {
			$data['banner_bottom2']['height'] = 150;
		}
		
		if (!isset($data['banner_bottom2']['link'])) {
			$data['banner_bottom2']['link'] = '';
		}
        
		if (!isset($data['banner_bottom2']['scale'])) {
			$data['banner_bottom2']['scale'] = '';
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/latest_products_category.tpl', $data));
		
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/latest_products_category')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}
		
		if (!$this->request->post['width']) {
			$this->error['width'] = $this->language->get('error_width');
		}
		
		if (!$this->request->post['height']) {
			$this->error['height'] = $this->language->get('error_height');
		}
		
		return !$this->error;
		
	}
}
