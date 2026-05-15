<?php
class ControllerModuleSlideshow extends Controller {
	private $error = array();
	
	public function index() {
		$this->load->language('extension/module');
		$this->load->language('module/slideshow');
		$this->load->model('extension/module');
		
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_list'] = $this->language->get('text_list');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_action'] = $this->language->get('column_action');
		
		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_install'] = $this->language->get('button_install');
		$data['button_uninstall'] = $this->language->get('button_uninstall');

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);
		
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/slideshow', 'token=' . $this->session->data['token'], 'SSL')
		);
		
		$modules = $this->model_extension_module->getModulesByCode('slideshow');
		
		$data['modules'] = array();
		
		foreach ($modules as $module) {
			$data['modules'][] = array(
				'module_id' => $module['module_id'],
				'name'      => $this->language->get('heading_title') . ' &gt; ' . $module['name'],
				'edit'      => $this->url->link('module/slideshow/edit', 'token=' . $this->session->data['token'] . '&module_id=' . $module['module_id'], 'SSL'),
				'delete'    => $this->url->link('extension/module/delete', 'token=' . $this->session->data['token'] . '&module_id=' . $module['module_id'], 'SSL')
			);
		}
		
		$data['edit'] = $this->url->link('module/slideshow/edit', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
	
		$this->response->setOutput($this->load->view('module/slideshow_list.tpl', $data));
	}
	
	public function edit() {
		$this->load->language('module/slideshow');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/module');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_extension_module->addModule('slideshow', $this->request->post);
				
				$this->session->data['success'] = $this->language->get('text_success');
				
				$this->response->redirect($this->url->link('module/slideshow', 'token=' . $this->session->data['token'], 'SSL'));
			} else {
				$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
				
				$this->session->data['success'] = $this->language->get('text_success');

				$this->response->redirect($this->url->link('module/slideshow', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL'));
			}
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_fixed'] = $this->language->get('text_fixed');
		$data['text_cover'] = $this->language->get('text_cover');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_banner'] = $this->language->get('entry_banner');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_mode'] = $this->language->get('entry_mode');
		$data['entry_effect'] = $this->language->get('entry_effect');
		$data['entry_thumbnail'] = $this->language->get('entry_thumbnail');
		$data['entry_loader'] = $this->language->get('entry_loader');
		$data['entry_bar_position'] = $this->language->get('entry_bar_position');
		$data['entry_hover'] = $this->language->get('entry_hover');
		$data['entry_time'] = $this->language->get('entry_time');
		$data['entry_navigation_hover'] = $this->language->get('entry_navigation_hover');
		$data['entry_pagination'] = $this->language->get('entry_pagination');
		$data['entry_skin'] = $this->language->get('entry_skin');
		
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_link'] = $this->language->get('entry_link');
		$data['entry_video'] = $this->language->get('entry_video');
		$data['entry_html_effect'] = $this->language->get('entry_html_effect');
		$data['entry_status'] = $this->language->get('entry_status');
		
		$data['button_add'] = $this->language->get('button_add');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_banner'] = $this->language->get('tab_banner');

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

		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/slideshow/edit', 'token=' . $this->session->data['token'], 'SSL')
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/slideshow/edit', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL')
			);
		}

		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('module/slideshow/edit', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('module/slideshow/edit', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
		}

		$data['cancel'] = $this->url->link('module/slideshow', 'token=' . $this->session->data['token'], 'SSL');

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
		
		$this->load->model('tool/image');
		
		if (isset($this->request->post['banners'])) {
			$data['banners'] = $this->request->post['banners'];
		} elseif (!empty($module_info)) {
			$data['banners'] = $module_info['banners'];
		} else {
			$data['banners'] = array();
		}
		
		foreach($data['banners'] as $key => $value){
			if($data['banners'][$key]['image'] && file_exists(DIR_IMAGE.$data['banners'][$key]['image'])){
				$data['banners'][$key]['thumb'] = $this->model_tool_image->resize($data['banners'][$key]['image'], 100, 100);
			}else{
				$data['banners'][$key]['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
			}
		}
		
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

		if (isset($this->request->post['width'])) {
			$data['width'] = $this->request->post['width'];
		} elseif (!empty($module_info)) {
			$data['width'] = $module_info['width'];
		} else {
			$data['width'] = '';
		}
		
		if (isset($this->request->post['mode'])) {
			$data['mode'] = $this->request->post['mode'];
		} elseif (!empty($module_info)) {
			$data['mode'] = $module_info['mode'];
		} else {
			$data['mode'] = '';
		}

		if (isset($this->request->post['height'])) {
			$data['height'] = $this->request->post['height'];
		} elseif (!empty($module_info)) {
			$data['height'] = $module_info['height'];
		} else {
			$data['height'] = '';
		}
		
		if (isset($this->request->post['effect'])) {
			$data['effect'] = $this->request->post['effect'];
		} elseif (!empty($module_info)) {
			$data['effect'] = $module_info['effect'];
		} else {
			$data['effect'] = '';
		}
		
		if (isset($this->request->post['thumbnail'])) {
			$data['thumbnail'] = $this->request->post['thumbnail'];
		} elseif (!empty($module_info)) {
			$data['thumbnail'] = $module_info['thumbnail'];
		} else {
			$data['thumbnail'] = '';
		}
		
		if (isset($this->request->post['loader'])) {
			$data['loader'] = $this->request->post['loader'];
		} elseif (!empty($module_info)) {
			$data['loader'] = $module_info['loader'];
		} else {
			$data['loader'] = '';
		}
		
		if (isset($this->request->post['bar_position'])) {
			$data['bar_position'] = $this->request->post['bar_position'];
		} elseif (!empty($module_info)) {
			$data['bar_position'] = $module_info['bar_position'];
		} else {
			$data['bar_position'] = '';
		}
		
		if (isset($this->request->post['hover'])) {
			$data['hover'] = $this->request->post['hover'];
		} elseif (!empty($module_info)) {
			$data['hover'] = $module_info['hover'];
		} else {
			$data['hover'] = '';
		}
		
		if (isset($this->request->post['time'])) {
			$data['time'] = $this->request->post['time'];
		} elseif (!empty($module_info)) {
			$data['time'] = $module_info['time'];
		} else {
			$data['time'] = '';
		}
		
		if (isset($this->request->post['navigation_hover'])) {
			$data['navigation_hover'] = $this->request->post['navigation_hover'];
		} elseif (!empty($module_info)) {
			$data['navigation_hover'] = $module_info['navigation_hover'];
		} else {
			$data['navigation_hover'] = '';
		}
		
		if (isset($this->request->post['navigation_hover'])) {
			$data['navigation_hover'] = $this->request->post['navigation_hover'];
		} elseif (!empty($module_info)) {
			$data['navigation_hover'] = $module_info['navigation_hover'];
		} else {
			$data['navigation_hover'] = '';
		}
		
		if (isset($this->request->post['pagination'])) {
			$data['pagination'] = $this->request->post['pagination'];
		} elseif (!empty($module_info)) {
			$data['pagination'] = $module_info['pagination'];
		} else {
			$data['pagination'] = '';
		}
		
		if (isset($this->request->post['skin'])) {
			$data['skin'] = $this->request->post['skin'];
		} elseif (!empty($module_info)) {
			$data['skin'] = $module_info['skin'];
		} else {
			$data['skin'] = '';
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}
		
		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/slideshow_form.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/slideshow')) {
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