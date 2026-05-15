<?php
class ControllerModuleLatest extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/latest');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/module');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_extension_module->addModule('latest', $this->request->post);
			} else {
				$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
			}

			$this->cache->delete('product');

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
		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
		// Additional
		$data['entry_resolution'] = $this->language->get('entry_resolution');
		
		$data['text_banner_left'] = $this->language->get('text_banner_left');
		
		$data['entry_banner_left'] = $this->language->get('entry_banner_left');
		$data['entry_banner_left_width'] = $this->language->get('entry_banner_left_width');
		$data['entry_banner_left_height'] = $this->language->get('entry_banner_left_height');
		$data['entry_banner_left_link'] = $this->language->get('entry_banner_left_link');
		
		$data['text_banner_right'] = $this->language->get('text_banner_right');
		
		$data['entry_banner_right'] = $this->language->get('entry_banner_right');
		$data['entry_banner_right_width'] = $this->language->get('entry_banner_right_width');
		$data['entry_banner_right_height'] = $this->language->get('entry_banner_right_height');
		$data['entry_banner_right_link'] = $this->language->get('entry_banner_right_link');
		
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

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

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

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/latest', 'token=' . $this->session->data['token'], 'SSL')
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/latest', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL')
			);
		}

		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('module/latest', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('module/latest', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
		}

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
		}

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
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
			$data['width'] = 220;
		}

		if (isset($this->request->post['height'])) {
			$data['height'] = $this->request->post['height'];
		} elseif (!empty($module_info)) {
			$data['height'] = $module_info['height'];
		} else {
			$data['height'] = 220;
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
		
		if (isset($this->request->post['banner_left'])) {
			$data['banner_left'] = $this->request->post['banner_left'];
		} elseif (!empty($module_info)) {
			$data['banner_left'] = $module_info['banner_left'];
		} else {
			$data['banner_left'] = array();
		}
		
		if (!isset($data['banner_left']['image'])) {
			$data['banner_left']['image'] = '';
		}
		
		if (!empty($data['banner_left']['image'])) {
			$data['banner_left']['thumb'] = $this->model_tool_image->resize($data['banner_left']['image'], 100, 100);;
		} else {
			$data['banner_left']['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);;
		}
		
		if (!isset($data['banner_left']['width'])) {
			$data['banner_left']['width'] = 270;
		}
		
		if (!isset($data['banner_left']['height'])) {
			$data['banner_left']['height'] = 350;
		}
		
		if (!isset($data['banner_left']['link'])) {
			$data['banner_left']['link'] = '';
		}
		
		if (isset($this->request->post['banner_right'])) {
			$data['banner_right'] = $this->request->post['banner_right'];
		} elseif (!empty($module_info)) {
			$data['banner_right'] = $module_info['banner_right'];
		} else {
			$data['banner_right'] = array();
		}
		
		if (!isset($data['banner_right']['image'])) {
			$data['banner_right']['image'] = '';
		}
		
		if (!empty($data['banner_right']['image'])) {
			$data['banner_right']['thumb'] = $this->model_tool_image->resize($data['banner_right']['image'], 100, 100);;
		} else {
			$data['banner_right']['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);;
		}
		
		if (!isset($data['banner_right']['width'])) {
			$data['banner_right']['width'] = 270;
		}
		
		if (!isset($data['banner_right']['height'])) {
			$data['banner_right']['height'] = 350;
		}
		
		if (!isset($data['banner_right']['link'])) {
			$data['banner_right']['link'] = '';
		}
		
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

		$this->response->setOutput($this->load->view('module/latest.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/latest')) {
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