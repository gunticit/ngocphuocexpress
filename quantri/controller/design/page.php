<?php
class ControllerDesignPage extends Controller {
	private $error = array();

	public function index() {
		$this->language->load('design/page');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->getList();
	}
	
	public function add() {
		$this->language->load('design/page');

		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->load->model('design/page');
			
			$this->model_design_page->addPage($this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('design/page', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}
	
	public function edit() {
		$this->language->load('design/page');

		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->load->model('design/page');
			
			$this->model_design_page->editPage($this->request->get['page_id'], $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('design/page', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}
	
	public function delete() {
		$this->language->load('design/page');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('design/page');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $page_id) {
				$this->model_design_page->deletePage($page_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('design/page', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}
	
	public function recovery(){
		$this->language->load('design/page');

		$this->document->setTitle($this->language->get('heading_title'));

		if ($this->validateRecovery()) {
			$this->load->model('design/page');
			
			$this->model_design_page->recoveryPage($this->request->get['page_id']);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('design/page', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}
	
	public function getList(){
		$data = array();
		
		$this->load->model('design/page');
		$this->language->load('design/page');
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('design/page', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('design/page/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('design/page/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['pages'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$page_total = $this->model_design_page->getTotalPages();

		$results = $this->model_design_page->getPages($filter_data);

		foreach ($results as $result) {
			$data['pages'][] = array(
				'page_id'     => $result['page_id'],
				'name'        => $result['name'],
				'home'        => $result['home'],
				'edit'        => $this->url->link('design/page/edit', 'token=' . $this->session->data['token'] . '&page_id=' . $result['page_id'] . $url, 'SSL'),
				'delete'      => $this->url->link('design/page/delete', 'token=' . $this->session->data['token'] . '&page_id=' . $result['page_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		$data['text_home'] = $this->language->get('text_home');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_page_id'] = $this->language->get('column_page_id');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_rebuild'] = $this->language->get('button_rebuild');
		$data['button_page_config'] = $this->language->get('button_page_config');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('design/page', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$data['sort_page_id'] = $this->url->link('design/page', 'token=' . $this->session->data['token'] . '&sort=page_id' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $page_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('design/page', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($page_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($page_total - $this->config->get('config_limit_admin'))) ? $page_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $page_total, ceil($page_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;
		
		$data['page_config'] = $this->url->link('design/page_config', 'token=' . $this->session->data['token'], 'SSL');

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('design/page_list.tpl', $data));
	}
	
	public function getForm(){
		$data = array();
		
		$this->document->addStyle('view/javascript/bootstrap/css/bootstrap-switch.min.css');
		$this->document->addStyle('view/javascript/jquery/jquery-ui.min.css');
		$this->document->addStyle('view/stylesheet/page.css');
		
		$this->document->addScript('view/javascript/jquery/jquery-ui.min.js');
		$this->document->addScript('view/javascript/bootstrap/js/bootstrap-switch.min.js');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_full_width'] = $this->language->get('text_full_width');
		$data['text_1170_px'] = $this->language->get('text_1170_px');
		$data['text_module'] = $this->language->get('text_module');
		$data['text_product'] = $this->language->get('text_product');
		$data['text_insert'] = $this->language->get('text_insert');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_image'] = $this->language->get('text_image');
		$data['text_title'] = $this->language->get('text_title');
		$data['text_html'] = $this->language->get('text_html');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_top'] = $this->language->get('text_top');
		$data['text_bottom'] = $this->language->get('text_bottom');
		$data['text_block'] = $this->language->get('text_block');
		$data['text_frame'] = $this->language->get('text_frame');
		$data['text_inserting_frame'] = $this->language->get('text_inserting_frame');
		$data['text_navigation'] = $this->language->get('text_navigation');
		$data['text_header'] = $this->language->get('text_header');
		$data['text_category'] = $this->language->get('text_category');
		$data['text_product'] = $this->language->get('text_product');
		$data['text_footer'] = $this->language->get('text_footer');
		$data['text_extra_info'] = $this->language->get('text_extra_info');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_download'] = $this->language->get('text_download');
		$data['text_create'] = $this->language->get('text_create');
		$data['text_content'] = $this->language->get('text_content');
		$data['text_select_all'] = $this->language->get('text_select_all');
		$data['text_unselect_all'] = $this->language->get('text_unselect_all');
		$data['text_close'] = $this->language->get('text_close');
		$data['text_add_new'] = $this->language->get('text_add_new');
		
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_meta_title'] = $this->language->get('entry_meta_title');
		$data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_col_sm'] = $this->language->get('entry_col_sm');
		$data['entry_col_xs'] = $this->language->get('entry_col_xs');
		$data['entry_class'] = $this->language->get('entry_class');
		$data['entry_product_name'] = $this->language->get('entry_product_name');
		$data['entry_background_image'] = $this->language->get('entry_background_image');
		$data['entry_background_color'] = $this->language->get('entry_background_color');
		$data['entry_keyword'] = $this->language->get('entry_keyword');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_link'] = $this->language->get('entry_link');
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_html'] = $this->language->get('entry_html');
		$data['entry_layout'] = $this->language->get('entry_layout');
		$data['entry_caption'] = $this->language->get('entry_caption');
		$data['entry_new_tab'] = $this->language->get('entry_new_tab');
		$data['entry_frame'] = $this->language->get('entry_frame');
		$data['entry_num_cols'] = $this->language->get('entry_num_cols');
		$data['entry_position'] = $this->language->get('entry_position');
		$data['entry_home'] = $this->language->get('entry_home');
		
		$data['help_keyword'] = $this->language->get('help_keyword');
		
		$data['button_add'] = $this->language->get('button_add');
		$data['button_change'] = $this->language->get('button_change');
		$data['button_submit'] = $this->language->get('button_submit');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_recovery'] = $this->language->get('button_recovery');
		$data['button_add_element'] = $this->language->get('button_add_element');
		
		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_design'] = $this->language->get('tab_design');
		
		$data['error_page_insert'] = $this->language->get('error_page_insert');
		$data['error_load'] = $this->language->get('error_load');
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}

		if (isset($this->error['meta_title'])) {
			$data['error_meta_title'] = $this->error['meta_title'];
		} else {
			$data['error_meta_title'] = array();
		}
		
		if (isset($this->error['keyword'])) {
			$data['error_keyword'] = $this->error['keyword'];
		} else {
			$data['error_keyword'] = '';
		}
		
		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('design/page', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);
		
		$this->load->model('design/page');
		
		if (!isset($this->request->get['page_id'])) {
			$data['action'] = $this->url->link('design/page/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
			
			$data['page_id'] = 0;
			
			$data['recovery'] = '';
			
			$page_info = array();
		} else {
			$data['action'] = $this->url->link('design/page/edit', 'token=' . $this->session->data['token'] . '&page_id=' . $this->request->get['page_id'] . $url, 'SSL');
			
			$data['page_id'] = (int)$this->request->get['page_id'];
			
			$data['recovery'] = $this->url->link('design/page/recovery', 'token=' . $this->session->data['token'] . '&page_id=' . $this->request->get['page_id'] . $url, 'SSL');
			
			$page_info = $this->model_design_page->getPage($this->request->get['page_id']);
		}
		
		if (isset($this->request->post['page_description'])) {
			$data['page_description'] = $this->request->post['page_description'];
		} elseif (isset($this->request->get['page_id'])) {
			$data['page_description'] = $this->model_design_page->getPageDescriptions($this->request->get['page_id']);
		} else {
			$data['page_description'] = array();
		}
		
		
		if (isset($this->request->post['content'])) {
			$data['content'] = html_entity_decode($this->request->post['content']);
		} elseif (!empty($page_info)) {
			$data['content'] = html_entity_decode($page_info['content']);
		} else {
			$data['content'] = '';
		}
		
		if (isset($this->request->post['raw'])) {
			$data['raw'] = html_entity_decode($this->request->post['raw']);
		} elseif (!empty($page_info)) {
			$data['raw'] = preg_replace('/token=\w{32}/', 'token=' . $this->request->get['token'], html_entity_decode($page_info['raw']));
		} else {
			$data['raw'] = '';
		}
		
		if (isset($this->request->post['keyword'])) {
			$data['keyword'] = $this->request->post['keyword'];
		} elseif (!empty($page_info)) {
			$data['keyword'] = $page_info['keyword'];
		} else {
			$data['keyword'] = '';
		}
		
		if (isset($this->request->post['home'])) {
			$data['home'] = $this->request->post['home'];
		} elseif (!empty($page_info)) {
			$data['home'] = $page_info['home'];
		} else {
			$data['home'] = 0;
		}
		
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($page_info)) {
			$data['status'] = $page_info['status'];
		} else {
			$data['status'] = true;
		}
		
		$this->load->model('extension/extension');
		$this->load->model('extension/module');
		
		$extensions = $this->model_extension_extension->getInstalled('module');
		
		$data['extensions'] = array();
		
		foreach ($extensions as $key => $value) {
			if (!file_exists(DIR_APPLICATION . 'controller/module/' . $value . '.php')) {
				
				$this->model_extension_extension->uninstall('module', $value);

				unset($extensions[$key]);

				$this->model_extension_module->deleteModulesByCode($value);
			}else{
				$this->load->language('module/' . $value);
				$modules = $this->model_extension_module->getModulesByCode($value);
				
				$module_data = array();
				
				foreach ($modules as $module) {
					$module_data[] = array(
						'module_id' => $module['module_id'],
						'name'      => $this->language->get('heading_title') . ' &gt; ' . $module['name'],
						'shortcode' => '[module id='.$module['module_id'].' name='.$value.' /]',
						'edit'      => str_replace(array(HTTPS_SERVER, HTTP_SERVER), '' , $this->url->link('module/' . $value, 'token=' . $this->session->data['token'] . '&module_id=' . $module['module_id'], 'SSL'))
					);
				}
				
				$data['extensions'][] = array(
					'extension_id' => $value,
					'name'      => $this->language->get('heading_title'),
					'module'    => $module_data,
					'shortcode' => $module_data ? '' : '[module id=0 name='.$value.' /]',
					'edit'      => str_replace(array(HTTPS_SERVER, HTTP_SERVER), '' , $this->url->link('module/' . $value, 'token=' . $this->session->data['token'], 'SSL'))
				);
			}
		}
		
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		$data['pre_action'] = html_entity_decode($this->url->link('design/page/preAction', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		$data['download'] = html_entity_decode($this->url->link('design/page/download', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		$data['create'] = html_entity_decode($this->url->link('design/page/create', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		
		$data['shortcode_api'] = $this->url->catalogLink('api/shortcodes/doShortCodes');
		
		$data['token'] = $this->session->data['token'];
		
		$data['cancel'] = $this->url->link('design/page', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
		$this->load->model('catalog/extra_info');
		
		$filter_var = array(
			'start' => 0,
			'limit' => 9999
		);
		
		$data['extra_infos'] = $this->model_catalog_extra_info->getExtraInfos($filter_var);
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('design/page_form.tpl', $data));
	}
	
	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'design/page')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		foreach ($this->request->post['page_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 2) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}

			if ((utf8_strlen($value['meta_title']) < 3) || (utf8_strlen($value['meta_title']) > 255)) {
				$this->error['meta_title'][$language_id] = $this->language->get('error_meta_title');
			}
		}
		
		if (utf8_strlen($this->request->post['keyword']) > 0) {
			$this->load->model('catalog/url_alias');

			$url_alias_info = $this->model_catalog_url_alias->getUrlAlias($this->request->post['keyword']);

			if ($url_alias_info && isset($this->request->get['page_id']) && $url_alias_info['query'] != 'page_id=' . $this->request->get['page_id']) {
				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));
			}

			if ($url_alias_info && !isset($this->request->get['page_id'])) {
				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));
			}

			if ($this->error && !isset($this->error['warning'])) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
		}
		
		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'design/page')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
	
	protected function validateRecovery() {
		if (!$this->user->hasPermission('modify', 'design/page')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
	
	public function preAction(){
		$this->load->model('design/block');
		
		if($this->request->server['REQUEST_METHOD'] == 'POST'){
			$pattern = $this->shortcodes->getShortCodeRegex();
			
			preg_match_all('/'.$pattern.'/s', $this->request->post['shortcode'], $match, PREG_PATTERN_ORDER);
			
			$attr = $this->shortcodes->ShortCodeParseAtts($this->request->post['shortcode']);
			if (isset($attr['style']) && !$this->model_design_block->checkBlock($attr['style'])) {
				echo json_encode(array('result' => 'success', 'action' => 'download', 'code' => $attr['style']));
			} else if ($match[2][0] == 'extrainfo' && !isset($attr['id'])) {
				echo json_encode(array('result' => 'success', 'action' => 'create', 'code' => 'extra-info'));
			}else {
				echo json_encode(array('result' => 'success', 'action' => 'nothing'));
			}
		}else{
			echo json_encode(array('result' => 'error', 'message' => $this->language->get('error_unknown_method')));
		}
	}
	
	public function create() {
		if($this->request->server['REQUEST_METHOD'] == 'POST'){
			echo json_encode(array('result' => 'success'));
		} else {
			echo json_encode(array('result' => 'error', 'message' => $this->language->get('error_unknown_method')));
		}
	}
	
	public function download(){
		$this->load->model('design/block');
		             
		if($this->request->server['REQUEST_METHOD'] == 'POST'){
			$postfield = array(
				'action' => 'getblock',
				'domain'=> $_SERVER['SERVER_NAME'],
				'code' => isset($this->request->post['code']) ? $this->request->post['code'] : ''
			);
			
			$data = $this->api->request($postfield);
			
			if(isset($data['result']) && $data['result'] == 'success'){
				$dirs['image_path'] = 'image/block/'.$data['response']['code'];
				$dirs['script_lib_path'] = 'catalog/view/javascript/block';
				$dirs['css_lib_path'] = 'catalog/view/stylesheet/block';
				
				foreach ($dirs as $dir){
					$path = '';
					$directories = explode('/', $dir);
	
					foreach ($directories as $directory) {
						$path = $path . '/' . $directory;
		
						if (!is_dir(DIR_HOME . $path)) {
							@mkdir(DIR_HOME . $path, 0777);
						}
					}
				}
				
				foreach ($data['response']['image'] as $image){
					if($image['image']){
						$basename = basename($image['image']);
						file_put_contents(DIR_HOME.$dirs['image_path'].'/'.$basename, file_get_contents($image['direct']));
					}
				}
				
				$script_lib = array();
				
				foreach ($data['response']['script_lib'] as $script){
					if($script['script']){
						$basename = $script_lib[] =  basename($script['script']);
						file_put_contents(DIR_HOME.$dirs['script_lib_path'].'/'.$basename, file_get_contents($script['direct']));
						
					}
				}
				
				$css_lib = array();
				
				foreach ($data['response']['css_lib'] as $css){
					if($css['css']){
						$basename = $css_lib[] =  basename($css['css']);
						file_put_contents(DIR_HOME.$dirs['css_lib_path'].'/'.$basename, file_get_contents($css['direct']));
						
					}
				}
				
				$data = array(
					'code' => $data['response']['code'],
					'html' => $data['response']['html'],
					'css' => $data['response']['css'],
					'script_lib' => $script_lib,
					'css_lib' => $css_lib
				);
				
				$this->model_design_block->updateBlock($data);
				
				echo json_encode(array('result' => 'success'));
			}else{
				echo json_encode($data);
			}
		}else{
			echo json_encode(array('result' => 'error', 'message' => $this->language->get('error_unknown_method')));
		}
	}
}