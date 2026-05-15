<?php
class ControllerCatalogExtraInfo extends Controller {
	private $error = array();

	public function index() {
		$this->language->load('catalog/extra_info');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->getList();
	}
	
	public function add() {
		$this->language->load('catalog/extra_info');

		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->load->model('catalog/extra_info');
			
			$this->model_catalog_extra_info->addExtraInfo($this->request->post);
			
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

			$this->response->redirect($this->url->link('catalog/extra_info', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}
	
	public function edit() {
		$this->language->load('catalog/extra_info');

		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->load->model('catalog/extra_info');
			
			$this->model_catalog_extra_info->editExtraInfo($this->request->get['extra_info_id'], $this->request->post);
			
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

			$this->response->redirect($this->url->link('catalog/extra_info', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}
	
	public function delete() {
		$this->language->load('catalog/extra_info');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/extra_info');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $extra_info_id) {
				$this->model_catalog_extra_info->deleteExtraInfo($extra_info_id);
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

			$this->response->redirect($this->url->link('catalog/extra_info', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}
	
	public function recovery(){
		$this->language->load('catalog/extra_info');

		$this->document->setTitle($this->language->get('heading_title'));

		if ($this->validateRecovery()) {
			$this->load->model('catalog/extra_info');
			
			$this->model_catalog_extra_info->recoveryExtraInfo($this->request->get['extra_info_id']);
			
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

			$this->response->redirect($this->url->link('catalog/extra_info', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}
	
	public function getList(){
		$data = array();
		
		$this->load->model('catalog/extra_info');
		$this->language->load('catalog/extra_info');
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'eid.name';
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
			'href' => $this->url->link('catalog/extra_info', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('catalog/extra_info/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('catalog/extra_info/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['extra_infos'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$extra_info_total = $this->model_catalog_extra_info->getTotalExtraInfos();

		$results = $this->model_catalog_extra_info->getExtraInfos($filter_data);

		foreach ($results as $result) {
			$data['extra_infos'][] = array(
				'extra_info_id' => $result['extra_info_id'],
				'name'        => $result['name'],
				'edit'        => $this->url->link('catalog/extra_info/edit', 'token=' . $this->session->data['token'] . '&extra_info_id=' . $result['extra_info_id'] . $url, 'SSL'),
				'delete'      => $this->url->link('catalog/extra_info/delete', 'token=' . $this->session->data['token'] . '&extra_info_id=' . $result['extra_info_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_extra_info_id'] = $this->language->get('column_extra_info_id');
		$data['column_shortcode'] = $this->language->get('column_shortcode');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_rebuild'] = $this->language->get('button_rebuild');

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

		$data['sort_name'] = $this->url->link('catalog/extra_info', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$data['sort_extra_info_id'] = $this->url->link('catalog/extra_info', 'token=' . $this->session->data['token'] . '&sort=extra_info_id' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $extra_info_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('catalog/extra_info', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($extra_info_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($extra_info_total - $this->config->get('config_limit_admin'))) ? $extra_info_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $extra_info_total, ceil($extra_info_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/extra_info_list.tpl', $data));
	}
	
	public function getForm(){
		$data = array();
		
		$this->document->addStyle('view/javascript/jquery/jquery-ui.min.css');
		$this->document->addStyle('view/javascript/color-picker/jqColor.css');
		$this->document->addStyle('view/stylesheet/extra-info.css');
		$this->document->addStyle('../catalog/view/font/fonts.css');
		
		$this->document->addScript('view/javascript/jquery/jquery-ui.min.js');
		
		$this->document->addScript('view/javascript/tinymce/jquery.tinymce.min.js');
		$this->document->addScript('view/javascript/tinymce/tinymce.min.js');
		$this->document->addScript('view/javascript/tinymce/plugins/table/plugin.min.js');
		$this->document->addScript('view/javascript/tinymce/plugins/paste/plugin.min.js');
		$this->document->addScript('view/javascript/tinymce/plugins/spellchecker/plugin.min.js');
		
		$this->document->addScript('view/javascript/color-picker/color.all.min.js');
		$this->document->addScript('view/javascript/color-picker/jQueryColorPicker.min.js');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_top'] = $this->language->get('text_top');
		$data['text_bottom'] = $this->language->get('text_bottom');
		$data['text_block'] = $this->language->get('text_block');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_download'] = $this->language->get('text_download');
		$data['text_content'] = $this->language->get('text_content');
		$data['text_intro'] = $this->language->get('text_intro');
		$data['text_content'] = $this->language->get('text_content');
		$data['text_step_by_step'] = $this->language->get('text_step_by_step');
		$data['text_text_grid'] = $this->language->get('text_text_grid');
		$data['text_video'] = $this->language->get('text_video');
		$data['text_team'] = $this->language->get('text_team');
		$data['text_price_table'] = $this->language->get('text_price_table');
		$data['text_portfolio'] = $this->language->get('text_portfolio');
		
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_content'] = $this->language->get('entry_content');
		$data['entry_background_image'] = $this->language->get('entry_background_image');
		$data['entry_background_color'] = $this->language->get('entry_background_color');
		$data['entry_css_lib'] = $this->language->get('entry_css_lib');
		$data['entry_script_lib'] = $this->language->get('entry_script_lib');
		$data['entry_status'] = $this->language->get('entry_status');
		
		$data['help_keyword'] = $this->language->get('help_keyword');
		
		$data['button_add'] = $this->language->get('button_add');
		$data['button_change'] = $this->language->get('button_change');
		$data['button_submit'] = $this->language->get('button_submit');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_recovery'] = $this->language->get('button_recovery');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_copy_first_language'] = $this->language->get('button_copy_first_language');
		
		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_data'] = $this->language->get('tab_data');
		
		$data['error_extra_info_insert'] = $this->language->get('error_extra_info_insert');
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
			'href' => $this->url->link('catalog/extra_info', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);
		
		$this->load->model('catalog/extra_info');
		
		if (!isset($this->request->get['extra_info_id'])) {
			$data['action'] = $this->url->link('catalog/extra_info/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
			
			$data['extra_info_id'] = 0;
			
			$data['recovery'] = '';
			
			$extra_info_info = array();
		} else {
			$data['action'] = $this->url->link('catalog/extra_info/edit', 'token=' . $this->session->data['token'] . '&extra_info_id=' . $this->request->get['extra_info_id'] . $url, 'SSL');
			
			$data['extra_info_id'] = (int)$this->request->get['extra_info_id'];
			
			$data['recovery'] = $this->url->link('catalog/extra_info/recovery', 'token=' . $this->session->data['token'] . '&extra_info_id=' . $this->request->get['extra_info_id'] . $url, 'SSL');
			
			$extra_info_info = $this->model_catalog_extra_info->getExtraInfo($this->request->get['extra_info_id']);
		}
		
		if (isset($this->request->post['css_lib'])) {
			$data['css_lib'] = $this->request->post['css_lib'];
		} elseif (!empty($extra_info_info)) {
			$data['css_lib'] = json_decode($extra_info_info['css_lib'], true);
		} else {
			$data['css_lib'] = array();
		}
		
		$stylesheets = $this->glob_recursive(DIR_CATALOG . '*.css');
		
		$data['stylesheets'] = array();
		
		foreach ($stylesheets as $stylesheet) {
			$data['stylesheets'][] = str_replace(DIR_HOME, '', $stylesheet);
		}
		
		if (isset($this->request->post['script_lib'])) {
			$data['script_lib'] = $this->request->post['script_lib'];
		} elseif (!empty($extra_info_info)) {
			$data['script_lib'] = json_decode($extra_info_info['script_lib'], true);
		} else {
			$data['script_lib'] = array();
		}
		
		$javascripts = $this->glob_recursive(DIR_CATALOG . '*.js');
		
		$except_scripts = array(
			'd_quickcheckout'
		);
		
		$data['javascripts'] = array();
		
		foreach ($javascripts as $javascript) {
			if ($this->strposa($javascript, $except_scripts) === false) {
				$data['javascripts'][] = str_replace(DIR_HOME, '', $javascript);
			}
		}
		
		if (isset($this->request->post['extra_info_description'])) {
			$data['extra_info_description'] = $this->request->post['extra_info_description'];
		} elseif (isset($this->request->get['extra_info_id'])) {
			$data['extra_info_description'] = $this->model_catalog_extra_info->getExtraInfoDescriptions($this->request->get['extra_info_id']);
		} else {
			$data['extra_info_description'] = array();
		}
		
		$this->load->model('tool/image');
		
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($extra_info_info)) {
			$data['status'] = $extra_info_info['status'];
		} else {
			$data['status'] = true;
		}
		
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		$data['insert_image'] = $this->url->link('catalog/extra_info/insertImage', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['insert_title'] = $this->url->link('catalog/extra_info/insertTitle', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['insert_html'] = $this->url->link('catalog/extra_info/insertHTML', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['pre_action'] = html_entity_decode($this->url->link('catalog/extra_info/preAction', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		$data['download'] = html_entity_decode($this->url->link('catalog/extra_info/download', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		
		$data['shortcode_api'] = $this->url->catalogLink('api/shortcodes/doShortCodes');
		
		$data['token'] = $this->session->data['token'];
		
		$data['action_update_element'] = $this->url->link('catalog/extra_info/updateElement', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['cancel'] = $this->url->link('catalog/extra_info', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
		$request_blocks = array(
			'extra-intro',
			'extra-content',
			'extra-step-by-step',
			'extra-text-grid',
			'extra-video',
			'extra-team',
			'extra-price-table',
			'extra-portfolio'
		);
		
		$this->load->model('design/block');
		
		$data['blocks'] = array();
		
		foreach ($request_blocks as $key) {
			$filter_var = array(
				'filter_key' => $key
			);
			
			$blocks = $this->model_design_block->getBlocks($filter_var);
			
			foreach ($blocks as $block) {
				if ($block['avatar']) {
					if ($this->request->server['HTTPS']) {
						$avatar = HTTPS_CATALOG . 'image/' . $block['avatar'];
					} else {
						$avatar =  HTTP_CATALOG . 'image/' . $block['avatar'];
					}
				} else {
					$avatar = '';
				}
				
				$data['blocks'][] = array(
					'key' => $block['key'],
					'code' => $block['code'],
					'css_lib' => json_decode($block['css_lib'], true),
					'script_lib' => json_decode($block['script_lib'], true),
					'avatar' => $avatar,
					'thumb' => ($block['avatar']) ? $this->model_tool_image->resize($block['avatar'], 200, 100) : $this->model_tool_image->resize('no_image.png', 200, 100)
				);
			}
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('catalog/extra_info_form.tpl', $data));
	}
	
	protected function glob_recursive($pattern, $flags = 0){
        $files = glob($pattern, $flags);
        
        foreach (glob(dirname($pattern).'/*', GLOB_ONLYDIR|GLOB_NOSORT) as $dir)
        {
            $files = array_merge($files, $this->glob_recursive($dir.'/'.basename($pattern), $flags));
        }
        
        return $files;
    }
	
	protected function strposa($haystack = '', $needle = array()) {
		if(!is_array($needle)) $needle = array($needle);
		
		foreach ($needle as $string) {
			if (($pos = strpos($haystack, $string))!==false) return $pos;
		}
		
		return false;
	}
	
	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/extra_info')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		foreach ($this->request->post['extra_info_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 2) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}
		}
		
		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/extra_info')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
	
	protected function validateRecovery() {
		if (!$this->user->hasPermission('modify', 'catalog/extra_info')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
	
	public function preAction(){
		$this->load->model('design/block');
		
		if($this->request->server['REQUEST_METHOD'] == 'POST'){
			$attr = $this->shortcodes->ShortCodeParseAtts($this->request->post['shortcode']);
			$action = array();
			
			if (isset($attr['code']) && !$this->model_design_block->checkBlock($attr['code'])) {
				$action[] = array(
					'action' => 'download',
					'code' => $attr['code']
				);
			}
			
			if (isset($attr['css_lib'])) {
				$action[] = array(
					'action' => 'add-css-library',
					'library' => explode('|', $attr['css_lib'])
				);
			}
			
			if (isset($attr['script_lib'])) {
				$action[] = array(
					'action' => 'add-script-library',
					'library' => explode('|', $attr['script_lib'])
				);
			}
			
			$action[] = array(
				'action' => 'nothing'
			);
			
			echo json_encode(array('result' => 'success', 'action' => $action)); 
			
		}else{
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
					'css_lib' => $css_lib,
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