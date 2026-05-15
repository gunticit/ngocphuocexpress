<?php
class ControllerCatalogdocument extends Controller {
	private $error = array();

	public function index() {
		$this->language->load('catalog/document');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/document');

		$this->getList();
	}

	public function add() {
		$this->language->load('catalog/document');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/document');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_document->adddocument($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			

			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/document', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->language->load('catalog/document');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/document');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_document->editdocument($this->request->get['document_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/document', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->language->load('catalog/document');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/document');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $document_id) {
				$this->model_catalog_document->deletedocument($document_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';


			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/document', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	public function repair() {
		$this->language->load('catalog/document');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/document');

		if ($this->validateRepair()) {
			$this->model_catalog_document->repairdocument();

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('catalog/document', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
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
			'href' => $this->url->link('catalog/document', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('catalog/document/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('catalog/document/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['repair'] = $this->url->link('catalog/document/repair', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['documents'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);
		$this->load->model('tool/image');

		$document_total = $this->model_catalog_document->getTotaldocument();

		$results = $this->model_catalog_document->getdocuments($filter_data);
		
		foreach ($results as $result) {

			// if (is_file(DIR_IMAGE . $result['image'])) {
			// 	$image = $this->model_tool_image->resize($result['image'], 40, 40);
			// } else {
			// 	$image = $this->model_tool_image->resize('no_image.png', 40, 40);
			// }
			$imglogo = strstr($result['image'],'.');
				$data['imglogo'] = $imglogo;
				if($imglogo == '.docx' || $imglogo == '.doc'){
					$imgl = HTTP_CATALOG.'image/format/doc.png';
				}else if($imglogo == '.pdf'){
					$imgl = HTTP_CATALOG.'image/format/pdf.png';
				} else if($imglogo == '.xlsx' || $imglogo == '.xls'){
					$imgl = HTTP_CATALOG.'image/format/excel.png';
				} else if($imglogo == '.ppt' || $imglogo == '.pptx'){
					$imgl = HTTP_CATALOG.'image/format/powerpoint.png';
				} else if($imglogo == '.jpg' || $imglogo == '.png'){
					$imgl = $this->model_tool_image->resize($result['image'], 80, 80);
				} else {
					$imgl = $this->model_tool_image->resize('placeholder.png', 80, 80);
				}

			$data['documents'][] = array(
				'document_id'     => $result['document_id'],
				'image'      => $imgl,
				'name'        => $result['name'],
				'status'     => ($result['status']) ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
				'edit'        => $this->url->link('catalog/document/edit', 'token=' . $this->session->data['token'] . '&document_id=' . $result['document_id'] . $url, 'SSL'),
				'delete'      => $this->url->link('catalog/document/delete', 'token=' . $this->session->data['token'] . '&document_id=' . $result['document_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_image'] = $this->language->get('column_image');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_link'] = $this->language->get('column_link');
		$data['column_status'] = $this->language->get('column_status');
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

		$data['sort_name'] = $this->url->link('catalog/document', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$data['sort_sort_order'] = $this->url->link('catalog/document', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $document_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('catalog/document', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($document_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($document_total - $this->config->get('config_limit_admin'))) ? $document_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $document_total, ceil($document_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/document_list.tpl', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['document_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_meta_title'] = $this->language->get('entry_meta_title');
		$data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$data['entry_keyword'] = $this->language->get('entry_keyword');
		$data['entry_parent'] = $this->language->get('entry_parent');
		$data['entry_filter'] = $this->language->get('entry_filter');
		$data['entry_store'] = $this->language->get('entry_store');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_top'] = $this->language->get('entry_top');
		$data['entry_column'] = $this->language->get('entry_column');
		$data['entry_link'] = $this->language->get('entry_link');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_layout'] = $this->language->get('entry_layout');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['help_filter'] = $this->language->get('help_filter');
		$data['help_keyword'] = $this->language->get('help_keyword');
		$data['help_top'] = $this->language->get('help_top');
		$data['help_column'] = $this->language->get('help_column');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
		$data['button_image_add'] = $this->language->get('button_image_add');
		$data['button_remove'] = $this->language->get('button_remove');

		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_data'] = $this->language->get('tab_data');
		$data['tab_design'] = $this->language->get('tab_design');
		$data['tab_image'] = $this->language->get('tab_image');

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
			'href' => $this->url->link('catalog/document', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['document_id'])) {
			$data['action'] = $this->url->link('catalog/document/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('catalog/document/edit', 'token=' . $this->session->data['token'] . '&document_id=' . $this->request->get['document_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('catalog/document', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['document_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$document_info = $this->model_catalog_document->getdocument($this->request->get['document_id']);
		}

		$data['token'] = $this->session->data['token'];

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['document_description'])) {
			$data['document_description'] = $this->request->post['document_description'];
		} elseif (isset($this->request->get['document_id'])) {
			$data['document_description'] = $this->model_catalog_document->getdocumentDescriptions($this->request->get['document_id']);
		} else {
			$data['document_description'] = array();
		}


		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($document_info)) {
			$data['status'] = $document_info['status'];
		} else {
			$data['status'] = true;
		}

		if (isset($this->request->post['image'])) {
			$data['image'] = $this->request->post['image'];
		} elseif (!empty($document_info)) {
			$data['image'] = $document_info['image'];
		} else {
			$data['image'] = '';
		}

		if (isset($this->request->post['mota'])) {
			$data['mota'] = $this->request->post['mota'];
		} elseif (!empty($document_info)) {
			$data['mota'] = $document_info['mota'];
		} else {
			$data['mota'] = '';
		}
		
		if (isset($this->request->post['sort'])) {
			$data['sort'] = $this->request->post['sort'];
		} elseif (!empty($document_info)) {
			$data['sort'] = $document_info['sort'];
		} else {
			$data['sort'] = 0;
		}

		if (isset($this->request->post['keyword'])) {
			$data['keyword'] = $this->request->post['keyword'];
		} elseif (!empty($document_info)) {
			$data['keyword'] = $document_info['keyword'];
		} else {
			$data['keyword'] = '';
		}
		
		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($document_info) && is_file(DIR_IMAGE . $document_info['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($document_info['image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$filename1 = substr(strrchr($data['image'], '/'), 1); 
		$ext1 = substr(strrchr($filename1, '.'), 1);
		
		if($ext1 == 'doc' || $ext1 == 'docx') 
		{ 
		$file_name1 = $data['image']; 
		}
		else if ($ext1 == 'xls' || $ext1 == 'xlsx') 
		{
		$file_name1 = $data['image'];
		}
		else if ($ext1 == 'ppt' || $ext1 == 'pptx') 
		{
		$file_name1 = $data['image'];
		}
		else if ($ext1 == 'pdf') 
		{
		$file_name1 = $data['image'];
		}
		else if (empty($file_name1))
		{ 
			$file_name1 = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		else 
		{
		$file_name1 = $this->model_tool_image->resize($data['image'], 100, 100);
		}
		


		$data['thumb'] = $file_name1;

		// Images
		if (isset($this->request->post['document_image'])) {
			$document_images = $this->request->post['document_image'];
		} elseif (isset($this->request->get['document_id'])) {
			$document_images = $this->model_catalog_document->getdocumentImages($this->request->get['document_id']);
		} else {
			$document_images = array();
		}

		$data['document_images'] = array();

		foreach ($document_images as $document_image) {
			if (is_file(DIR_IMAGE . $document_image['image'])) {
				$image = $document_image['image'];
				$thumb = $document_image['image'];
			} else {
				$image = '';
				$thumb = 'no_image.png';
			}

			$filename2 = substr(strrchr($document_image['image'], '/'), 1); 
			$ext2 = substr(strrchr($filename2, '.'), 1);

			if($ext2 == 'doc' || $ext2 == 'docx') 
			{ 
			$file_name2 = $document_image['image']; 
			}
			else if ($ext2 == 'xls' || $ext2 == 'xlsx') 
			{
			$file_name2 = $document_image['image'];
			}
			else if ($ext2 == 'ppt' || $ext2 == 'pptx') 
			{
			$file_name2 = $document_image['image'];
			}
			else if ($ext2 == 'pdf') 
			{
			$file_name2 = $document_image['image'];
			}
			else if (empty($file_name1))
			{ 
				$file_name2 = $this->model_tool_image->resize('no_image.png', 100, 100);
			}
			else 
			{
			$file_name2 = $this->model_tool_image->resize($document_image['image'], 100, 100);
			}
			$image = $file_name2;
			
			$data['document_images'][] = array(
				'tendocument'   => $document_image['tendocument'],
				'image'      => $image,
				'thumb'      => $this->model_tool_image->resize($thumb, 100, 100),
				'sort_order' => $document_image['sort_order']
			);
		}


		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/document_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/document')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['document_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 2) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}

			
		}

		if (utf8_strlen($this->request->post['keyword']) > 0) {
			$this->load->model('catalog/url_alias');

			$url_alias_info = $this->model_catalog_url_alias->getUrlAlias($this->request->post['keyword']);

			if ($url_alias_info && isset($this->request->get['document_id']) && $url_alias_info['query'] != 'document_id=' . $this->request->get['document_id']) {
				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));
			}

			if ($url_alias_info && !isset($this->request->get['document_id'])) {
				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));
			}
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/document')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	protected function validateRepair() {
		if (!$this->user->hasPermission('modify', 'catalog/document')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/document');

			$filter_data = array(
				'filter_name' => $this->request->get['filter_name'],
				'sort'        => 'name',
				'order'       => 'ASC',
				'start'       => 0,
				'limit'       => 5
			);

			$results = $this->model_catalog_document->getdocuments($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'document_id' => $result['document_id'],
					'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}