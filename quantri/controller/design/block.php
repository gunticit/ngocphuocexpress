<?php
class Controllerdesignblock extends Controller {
	private $error = array();

	public function index() {
		$this->language->load('design/block');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->getList();
	}
	
	public function add() {
		$this->language->load('design/block');

		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->load->model('design/block');
			
			$this->model_design_block->addblock($this->request->post);
			
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

			$this->response->redirect($this->url->link('design/block', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}
	
	public function edit() {
		$this->language->load('design/block');

		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->load->model('design/block');
			
			$this->model_design_block->editBlock($this->request->get['block_id'], $this->request->post);
			
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

			$this->response->redirect($this->url->link('design/block', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}
	
	public function delete() {
		$this->language->load('design/block');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('design/block');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $block_id) {
				$this->model_design_block->deleteBlock($block_id);
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

			$this->response->redirect($this->url->link('design/block', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}
	
	public function ajax() {
		$this->language->load('design/block');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->load->model('design/block');
			
			$this->model_design_block->editBlock($this->request->get['block_id'], $this->request->post);

			echo json_encode(array('success' => $this->language->get('text_success')));
		}
	}
	
	public function editByCode(){
		$this->load->model('design/block');
		
		if(isset($this->request->get['code'])){
			$block = $this->model_design_block->getBlockByCode($this->request->get['code']);
			
			$this->response->redirect($this->url->link('design/block/edit', 'token=' . $this->session->data['token'] . '&block_id=' . (int)$block['block_id'], 'SSL'));
		}else{
			$this->response->redirect($this->url->link('design/block', 'token=' . $this->session->data['token'], 'SSL'));
		}
	}
	
	public function getList(){
		$data = array();
		
		$this->load->model('design/block');
		$this->language->load('design/block');
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'code';
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
			'href' => $this->url->link('design/block', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('design/block/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('design/block/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['blocks'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$block_total = $this->model_design_block->getTotalblocks();

		$results = $this->model_design_block->getBlocks($filter_data);

		foreach ($results as $result) {
			$data['blocks'][] = array(
				'block_id' => $result['block_id'],
				'code'        => $result['code'],
				'edit'        => $this->url->link('design/block/edit', 'token=' . $this->session->data['token'] . '&block_id=' . $result['block_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_code'] = $this->language->get('column_code');
		$data['column_block_id'] = $this->language->get('column_block_id');
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

		$data['sort_code'] = $this->url->link('design/block', 'token=' . $this->session->data['token'] . '&sort=code' . $url, 'SSL');
		$data['sort_block_id'] = $this->url->link('design/block', 'token=' . $this->session->data['token'] . '&sort=block_id' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $block_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('design/block', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($block_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($block_total - $this->config->get('config_limit_admin'))) ? $block_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $block_total, ceil($block_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('design/block_list.tpl', $data));
	}
	
	public function getForm(){
		$data = array();
		
		$this->document->addScript('view/javascript/ace/ace.js');
		$this->document->addScript('view/javascript/ace/theme-twilight.js');
		$this->document->addScript('view/javascript/ace/mode-html.js');
		$this->document->addScript('view/javascript/ace/mode-css.js');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_block'] = $this->language->get('text_block');
		$data['text_custom'] = $this->language->get('text_custom');
		$data['text_extra_intro'] = $this->language->get('text_extra_intro');
		$data['text_extra_content'] = $this->language->get('text_extra_content');
		$data['text_extra_step_by_step'] = $this->language->get('text_extra_step_by_step');
		$data['text_extra_text_grid'] = $this->language->get('text_extra_text_grid');
		$data['text_extra_video'] = $this->language->get('text_extra_video');
		$data['text_extra_team'] = $this->language->get('text_extra_team');
		$data['text_extra_price_table'] = $this->language->get('text_extra_price_table');
		$data['text_extra_portfolio'] = $this->language->get('text_extra_portfolio');
		
		$data['entry_html'] = $this->language->get('entry_html');
		$data['entry_css'] = $this->language->get('entry_css');
		$data['entry_avatar'] = $this->language->get('entry_avatar');
		$data['entry_key'] = $this->language->get('entry_key');
		$data['entry_css_lib'] = $this->language->get('entry_css_lib');
		$data['entry_script_lib'] = $this->language->get('entry_script_lib');
		
		$data['button_add'] = $this->language->get('button_add');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_update'] = $this->language->get('button_update');
		$data['button_ajax'] = $this->language->get('button_ajax');
		
		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_data'] = $this->language->get('tab_data');
		
		$data['error_block_insert'] = $this->language->get('error_block_insert');
		$data['error_load'] = $this->language->get('error_load');
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
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
			'href' => $this->url->link('design/block', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);
		
		$this->load->model('design/block');
		
		if (isset($this->request->get['block_id'])) {
			$data['action'] = $this->url->link('design/block/edit', 'token=' . $this->session->data['token'] . '&block_id=' . $this->request->get['block_id'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('design/block/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		}
		
		if (isset($this->request->get['block_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$block_info = $this->model_design_block->getBlock($this->request->get['block_id']);
		}
		
		if (isset($this->request->get['block_id'])) {
			$data['ajax'] = html_entity_decode($this->url->link('design/block/ajax', 'token=' . $this->session->data['token'] . '&block_id=' . $this->request->get['block_id'], 'SSL'));
		}
		
		$data['cancel'] = $this->url->link('design/block', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
		if (isset($this->request->post['key'])) {
			$data['key'] = $this->request->post['key'];
		} elseif (!empty($block_info)) {
			$data['key'] = $block_info['key'];
		} else {
			$data['key'] = '';
		}
		
		if (isset($this->request->post['avatar'])) {
			$data['avatar'] = $this->request->post['avatar'];
		} elseif (!empty($block_info)) {
			$data['avatar'] = $block_info['avatar'];
		} else {
			$data['avatar'] = '';
		}
		
		$this->load->model('tool/image');
		
		if (isset($this->request->post['avatar']) && is_file(DIR_IMAGE . $this->request->post['avatar'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['avatar'], 100, 100);
		} elseif (!empty($block_info) && is_file(DIR_IMAGE . $block_info['avatar'])) {
			$data['thumb'] = $this->model_tool_image->resize($block_info['avatar'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		
		if (isset($this->request->post['html'])) {
			$data['html'] = $this->request->post['html'];
		} elseif (!empty($block_info)) {
			$data['html'] = htmlentities($block_info['html']);
		} else {
			$data['html'] = '';
		}
		
		if (isset($this->request->post['css'])) {
			$data['css'] = $this->request->post['css'];
		} elseif (!empty($block_info)) {
			$data['css'] = htmlentities($block_info['css']);
		} else {
			$data['css'] = '';
		}
		
		if (isset($this->request->post['css_lib'])) {
			$data['css_lib'] = $this->request->post['css_lib'];
		} elseif (!empty($block_info)) {
			$data['css_lib'] = json_decode($block_info['css_lib'], true);
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
		} elseif (!empty($block_info)) {
			$data['script_lib'] = json_decode($block_info['script_lib'], true);
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
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('design/block_form.tpl', $data));
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
		if (!$this->user->hasPermission('modify', 'design/block')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'design/block')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
	
	protected function validateRecovery() {
		if (!$this->user->hasPermission('modify', 'design/block')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}