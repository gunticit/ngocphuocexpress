<?php
class ControllerCatalogpost extends Controller {
	private $error = array();
	
	public function index() {
		$this->load->model('setting/settingpost');
		$data['config_settingpost']=$this->model_setting_settingpost->getSettingPosts(); 
		$this->language->load('catalog/post');
		$this->load->model('catalog/post');
		$this->document->setTitle($this->language->get('heading_title'));
		
		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}
		if (isset($this->request->get['filter_author']) && isset($this->request->get['author'])) {
			$filter_author = $this->request->get['filter_author'];
			$author = $this->request->get['author'];
		} else {
			$filter_author = null;
			$author = null;
		}
		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'n.post_id';
		}
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'desc';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		$url='';
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
		if (isset($this->request->get['filter_author'])) {
			$url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
		}
		if (isset($this->request->get['author'])) {
			$url .= '&author=' . urlencode(html_entity_decode($this->request->get['author'], ENT_QUOTES, 'UTF-8'));
		}
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
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
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL')
		);
		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/post', 'token=' . $this->session->data['token'] . $url, 'SSL')
   		);
		
		$data['add'] = $this->url->link('catalog/post/insert', '&token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('catalog/post/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
		
		$this->load->model('user/mangeuser');
		$this->session->data['userpost']=$this->model_user_mangeuser->getUserpostpermission($this->session->data['user_id']);
		
		$filter_data = array(
			'filter_name'	  => $filter_name,
			'filter_author'	  => $filter_author,
			'author'	  => $author,
			'postpermission' =>$this->session->data['userpost']['postpermission'],
			'filter_status'   => $filter_status,
			'sort'            => $sort,
			'start' => ($page - 1) *  $data['config_settingpost']['item_perpage_admin'],
			'order'           => $order,
			'page' => $page,
			'limit' => $data['config_settingpost']['item_perpage_admin']
		);
		
		$total = $this->model_catalog_post->getTotalpost($filter_data);
		
		$pagination = new Pagination();
		$pagination->total = $total;
		$pagination->page = $page;
		$pagination->limit = $data['config_settingpost']['item_perpage_admin'];
		$pagination->url = $this->url->link('catalog/post', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
		$data['pagination'] = $pagination->render();
		
		$data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($total - $this->config->get('config_limit_admin'))) ? $total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $total, ceil($total / $this->config->get('config_limit_admin')));
		
		$data['posts'] = array();
		$posts = $this->model_catalog_post->getPosts($filter_data);
		
		$this->load->model('tool/image');
		$this->load->model('user/mangeuser');
		
		foreach ($posts as $post) {
			if (is_file(DIR_IMAGE . $post['image'])) {
				$image = $this->model_tool_image->resize($post['image'], 70, 70);
			} else {
				$image = $this->model_tool_image->resize('placeholder.png', 70, 70);
			}
			
			$data['posts'][] = array (
				'post_id' 			=> $post['post_id'],
				'sort_order' 			=> $post['sort_order'],
				'image'    		    => $image,
				'status'    		=> ($post['status']) ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
				'title' 			=> (strlen(strip_tags(html_entity_decode($post['title'], ENT_QUOTES))) > $data['config_settingpost']['description_limit'] ? substr(strip_tags(html_entity_decode($post['title'], ENT_QUOTES)), 0, $data['config_settingpost']['description_limit']) . '...' : strip_tags(html_entity_decode($post['title'], ENT_QUOTES))),
				'meta_keyword' 		=> $post['meta_keyword'],
				'short_description'	=> (strlen(strip_tags(html_entity_decode($post['short_description'], ENT_QUOTES))) > $data['config_settingpost']['description_limit'] ? substr(strip_tags(html_entity_decode($post['short_description'], ENT_QUOTES)), 0, $data['config_settingpost']['description_limit']) . '...' : strip_tags(html_entity_decode($post['short_description'], ENT_QUOTES))),
				'date_added' 		=> date($this->language->get('date_format_short'), strtotime($post['date_added'])),
				'edit' 				=> $this->url->link('catalog/post/edit', 'post_id=' . $post['post_id'] . '&token=' . $this->session->data['token'] . $url, 'SSL')
			);
		}
		
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_title'] = $this->language->get('text_title');
		$data['text_meta_keyword'] = $this->language->get('text_meta_keyword');
		$data['text_sort_order'] = $this->language->get('text_sort_order');
		$data['text_short_description'] = $this->language->get('text_short_description');
		$data['text_date'] = $this->language->get('text_date');
		$data['text_action'] = $this->language->get('text_action');
		$data['text_status'] = $this->language->get('text_status');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		$data['column_image'] = $this->language->get('column_image');
		$data['column_sort_order'] = $this->language->get('column_sort_order');
		$data['column_status'] = $this->language->get('column_status');
		$data['text_author'] = 'Author';
		$data['button_add'] = $this->language->get('button_add');
		
		$data['button_delete'] = $this->language->get('button_delete');
		$data['token'] = $this->session->data['token'];
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		
		if (isset($this->error['warning'])) {
			$data['error'] = $this->error['warning'];
		
			unset($this->error['warning']);
		} else {
			$data['error'] = '';
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else { 
			$page = 1;
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
		
		$url='';
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
		if (isset($this->request->get['filter_author'])) {
			$url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
		}
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$data['sort_title'] = $this->url->link('catalog/post', 'token=' . $this->session->data['token'] . '&sort=nd.title' . $url,'SSL');
		$data['sort_sort_order'] = $this->url->link('catalog/post', 'token=' . $this->session->data['token'] . '&sort=n.sort_order' . $url,'SSL');
		$data['sort_status'] = $this->url->link('catalog/post', 'token=' . $this->session->data['token'] . '&sort=n.status' . $url, 'SSL');
		$data['sort_date'] = $this->url->link('catalog/post', 'token=' . $this->session->data['token'] . '&sort=n.date_added' . $url, 'SSL');
		$data['sort_short_description'] = $this->url->link('catalog/post', 'token=' . $this->session->data['token'] . '&sort=nd.short_description' . $url, 'SSL');
		
		$url = '';
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
		if (isset($this->request->get['filter_author'])) {
			$url .= '&filter_author=' . urlencode(html_entity_decode($this->request->get['filter_author'], ENT_QUOTES, 'UTF-8'));
		}
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		$data['filter_name'] = $filter_name;
		$data['filter_author'] = $filter_author;
		$data['author'] = $author;
		$data['filter_status'] = $filter_status;
		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['button_filter'] = $this->language->get('button_filter');	
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('catalog/post_list.tpl', $data));	
	}
	
	public function edit() {
		$this->language->load('catalog/post');
		
		$this->load->model('catalog/post');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_catalog_post->editpost($this->request->get['post_id'], $this->request->post);		
			
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->response->redirect($this->url->link('catalog/post', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$this->form();
	}
	
	public function insert() {
		$this->language->load('catalog/post');
		
		$this->load->model('catalog/post');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_catalog_post->addpost($this->request->post);		
			
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->response->redirect($this->url->link('catalog/post', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->form();
	}
	
	protected function form() {
		$this->language->load('catalog/post');
		
		$this->load->model('catalog/post');
		
		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/post', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		if (isset($this->request->get['post_id'])) {
			$data['action'] = $this->url->link('catalog/post/edit', '&post_id=' . $this->request->get['post_id'] . '&token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('catalog/post/insert', '&token=' . $this->session->data['token'], 'SSL');
		}
		
		$data['cancel'] = $this->url->link('catalog/post', '&token=' . $this->session->data['token'], 'SSL');
		
		$data['heading_title'] = $this->language->get('heading_title');
		$data['entry_related'] = $this->language->get('entry_related');
		$data['text_title'] = $this->language->get('text_title');
		$data['text_meta_keyword'] = $this->language->get('text_meta_keyword');
		$data['text_description'] = $this->language->get('text_description');
		$data['text_short_description'] = $this->language->get('text_short_description');
		$data['text_status'] = $this->language->get('text_status');
		$data['text_keyword'] = $this->language->get('text_keyword');
		$data['text_sort_order'] = $this->language->get('text_sort_order');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_browse'] = $this->language->get('text_browse');
		$data['text_clear'] = $this->language->get('text_clear');
		$data['text_image_manager'] = $this->language->get('text_image_manager');
		
		$data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$data['entry_date_available'] = $this->language->get('entry_date_available');
		$data['entry_attribute'] = $this->language->get('entry_attribute');
		$data['entry_text'] = $this->language->get('entry_text');
		$data['entry_banner'] = $this->language->get('entry_banner');
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_attribute_add'] = $this->language->get('button_attribute_add');
		$data['button_image_add'] = $this->language->get('button_image_add');
		$data['button_remove'] = $this->language->get('button_remove');
		
		//---- category
		$data['entry_thread'] = $this->language->get('entry_thread');
		
		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_data'] = $this->language->get('tab_data');
		$data['tab_image'] = $this->language->get('tab_image');
		$data['tab_attribute'] = $this->language->get('tab_attribute');
		
		$data['help_thread'] = $this->language->get('help_thread');
		
		$this->load->model('catalog/thread');

		if (isset($this->request->post['post_thread'])) {
			$categoriespost = $this->request->post['post_thread'];
		} elseif (isset($this->request->get['post_id'])) {
			$categoriespost = $this->model_catalog_post->getPostToThreads($this->request->get['post_id']);
		} else {
			$categoriespost = array();
		}

		$data['post_categoriespost'] = array();
		$data['postpermission']= $this->session->data['userpost']['postpermission'];
		foreach ($categoriespost as $thread_id) {
			$thread_info = $this->model_catalog_thread->getthread($thread_id);

			if ($thread_info) {
				$data['post_categoriespost'][] = array(
					'thread_id' => $thread_info['thread_id'],
					'name' => ($thread_info['path']) ? $thread_info['path'] . ' &gt; ' . $thread_info['name'] : $thread_info['name']
				);
			}
		}
		//-------------
		if (isset($this->request->post['post_related'])) {
			$post = $this->request->post['post_related'];
		} elseif (isset($this->request->get['post_id'])) {
			$post = $this->model_catalog_post->getpostRelated($this->request->get['post_id']);
		} else {
			$post = array();
		}

		$data['post_relateds'] = array();

		foreach ($post as $post_id) {
			$related_info = $this->model_catalog_post->getpost($post_id);

			if ($related_info) {
				$data['post_relateds'][] = array(
					'post_id' => $related_info['post_id'],
					'name'       => $related_info['title']
				);
			}
		}
		//-------------
		
		// Attributes
		$this->load->model('catalog/attribute');

		if (isset($this->request->post['post_attribute'])) {
			$post_attributes = $this->request->post['post_attribute'];
		} elseif (isset($this->request->get['post_id'])) {
			$post_attributes = $this->model_catalog_post->getpostAttributes($this->request->get['post_id']);
		} else {
			$post_attributes = array();
		}

		$data['post_attributes'] = array();

		foreach ($post_attributes as $post_attribute) {
			$attribute_info = $this->model_catalog_attribute->getAttribute($post_attribute['attribute_id']);

			if ($attribute_info) {
				$data['post_attributes'][] = array(
					'attribute_id'                  => $post_attribute['attribute_id'],
					'name'                          => $attribute_info['name'],
					'post_attribute_description' => $post_attribute['post_attribute_description']
				);
			}
		}
		
		$data['token'] = $this->session->data['token'];
		
		$this->load->model('localisation/language');
		
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		if (isset($this->error['warning'])) {
			$data['error'] = $this->error['warning'];
		} else {
			$data['error'] = '';
		}
		
		if (isset($this->request->get['post_id'])) {
			$post = $this->model_catalog_post->getpost($this->request->get['post_id']);
		} else {
			$post = array();
		}
		
		if (isset($this->request->post['post'])) {
			$data['post'] = $this->request->post['post'];
		} elseif (!empty($post)) {
			$data['post'] = $this->model_catalog_post->getpostDescription($this->request->get['post_id']);
		} else {
			$data['post'] = '';
		}
		
		
		if (isset($this->request->post['image'])) {
			$data['image'] = $this->request->post['image'];
		} elseif (!empty($post)) {
			$data['image'] = $post['image'];
		} else {
			$data['image'] = '';
		}

		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
			$data['image_thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($post) && is_file(DIR_IMAGE . $post['image'])) {
			$data['image_thumb'] = $this->model_tool_image->resize($post['image'], 100, 100);
		} else {
			$data['image_thumb'] = $this->model_tool_image->resize('placeholder.png', 100, 100);
		}
		
		if (isset($this->request->post['banner'])) {
			$data['banner'] = $this->request->post['banner'];
		} elseif (!empty($post)) {
			$data['banner'] = $post['banner'];
		} else {
			$data['banner'] = '';
		}
		
		if (isset($this->request->post['banner']) && is_file(DIR_IMAGE . $this->request->post['banner'])) {
			$data['banner_thumb'] = $this->model_tool_image->resize($this->request->post['banner'], 100, 100);
		} elseif (!empty($post) && is_file(DIR_IMAGE . $post['banner'])) {
			$data['banner_thumb'] = $this->model_tool_image->resize($post['banner'], 100, 100);
		} else {
			$data['banner_thumb'] = $this->model_tool_image->resize('placeholder.png', 100, 100);
		}
		
		// Images
		if (isset($this->request->post['post_image'])) {
			$post_images = $this->request->post['post_image'];
		} elseif (isset($this->request->get['post_id'])) {
			$post_images = $this->model_catalog_post->getPostImages($this->request->get['post_id']);
		} else {
			$post_images = array();
		}

		$data['post_images'] = array();

		foreach ($post_images as $post_image) {
			if (is_file(DIR_IMAGE . $post_image['image'])) {
				$image = $post_image['image'];
				$thumb = $post_image['image'];
			} else {
				$image = '';
				$thumb = 'placeholder.png';
			}

			$data['post_images'][] = array(
				'post_image_description' => $post_image['post_image_description'],
				'image'      => $image,
				'thumb'      => $this->model_tool_image->resize($thumb, 100, 100),
				'sort_order' => $post_image['sort_order']
			);
		}
		
		$data['placeholder'] = $this->model_tool_image->resize('placeholder.png', 100, 100);
		
		if (isset($this->request->post['keyword'])) {
			$data['keyword'] = $this->request->post['keyword'];
		} elseif (!empty($post)) {
			$data['keyword'] = $post['keyword'];
		} else {
			$data['keyword'] = '';
		}
		
		if (isset($this->request->post['date_available'])) {
			$data['date_available'] = $this->request->post['date_available'];
		} elseif (!empty($post)) {
			$data['date_available'] = ($post['date_available'] != '0000-00-00') ? $post['date_available'] : '';
		} else {
			$data['date_available'] = date('Y-m-d');
		}
		
		if (isset($this->request->post['meta_keyword'])) {
			$data['meta_keyword'] = $this->request->post['meta_keyword'];
		} elseif (!empty($post)) {
			$data['meta_keyword'] = $post['meta_keyword'];
		} else {
			$data['meta_keyword'] = '';
		}
		
		if (isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($post)) {
			$data['sort_order'] = $post['sort_order'];
		} else {
			$data['sort_order'] = 0;
		}
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($post)) {
			$data['status'] = $post['status'];
		} else {
			$data['status'] = 0;
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/post_form.tpl', $data));
	}
	
	public function delete() {
		$this->language->load('catalog/post');
		
		$this->load->model('catalog/post');

		$this->document->setTitle($this->language->get('heading_title'));
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $post_id) {
				$this->model_catalog_post->deletepost($post_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');
		}
		
		$this->response->redirect($this->url->link('catalog/post', 'token=' . $this->session->data['token'], 'SSL'));
	}
	
	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/post')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
 
		if (!$this->error) {
			return true; 
		} else {
			return false;
		}
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'catalog/post')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/post');

			$filter_data = array(
				'filter_name' => $this->request->get['filter_name'],
				'sort'        => 'title',
				'order'       => 'ASC',
				'start'       => 0,
				'limit'       => 5
			);

			$results = $this->model_catalog_post->getposts($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'post_id' => $result['post_id'],
					'name'        => strip_tags(html_entity_decode($result['title'], ENT_QUOTES, 'UTF-8'))
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