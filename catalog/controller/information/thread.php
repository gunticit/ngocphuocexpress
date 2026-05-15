<?php
class ControllerInformationThread extends Controller {
    public $settingpost;
    public function __construct($settingpost) {
    parent::__construct($settingpost);
		$this->load->model('setting/settingpost');
		$this->setting = $this->model_setting_settingpost->getSettingPosts();
	}

	public function index() {
		$this->language->load('information/thread');

		$this->load->model('catalog/post');
		$this->load->model('catalog/thread');

		$this->document->addStyle('catalog/view/stylesheet/news.css');

		$data['breadcrumbs'] = array();
		
		$data['breadcrumbs'][] = array(
			'text' 		=> $this->language->get('text_home'),
			'href' 		=> $this->url->link('common/home')
		);

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		if (isset($this->request->get['thread'])) {
			$url = '';
	
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$thread = '';

			$parts = explode('_', (string)$this->request->get['thread']);
			
			$thread_id = (int)array_pop($parts);

			foreach ($parts as $path_id) {
				if (!$thread) {
					$thread = (int)$path_id;
				} else {
					$thread .= '_' . (int)$path_id;
				}

				$thread_info = $this->model_catalog_thread->getThread($path_id);

				if ($thread_info) {
					$data['breadcrumbs'][] = array(
						'text' => $thread_info['name'],
						'href' => $this->url->link('information/thread', 'thread=' . $thread . $url)
					);
				}
			}
		} else {
			$thread_id = 0;
		}
		
		$thread_info = $this->model_catalog_thread->getThread($thread_id);
		
		if ($thread_info) {
			$data['breadcrumbs'][] = array(
				'text' 		=> $thread_info['name'],
				'href' 		=> $this->url->link('information/thread', 'thread=' . $this->request->get['thread'])
			);
			
			$this->document->setTitle($thread_info['name']);
			
			$this->load->model('tool/image');
			
			$limit=$this->setting['item_perpage_thread'];

			$filter_data = array(
				'filter_thread_id' => $thread_id,
				'page' 	=> $page,
				'limit' => $limit,
				'start' => $limit * ($page - 1),
			);

			$total = $this->model_catalog_post->getTotalPost($filter_data);

			$pagination = new Pagination();
			$pagination->total = $total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->url = $this->url->link('information/thread', 'thread=' . $this->request->get['thread'] . $url . '&page={page}');
			$data['pagination'] = $pagination->render();

			$data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($total - 10)) ? $total : ((($page - 1) * 10) + 10), $total, ceil($total / 10));
			
			$this->document->setTitle($thread_info['meta_title']);
			$this->document->setDescription($thread_info['meta_description']);
			$this->document->setKeywords($thread_info['meta_keyword']);
			
			$data['heading_title'] = $thread_info['meta_title'];
			$data['text_see_more'] = $this->language->get('text_see_more');
			$data['text_title'] = $this->language->get('text_title');
			$data['text_description'] = $this->language->get('text_description');
			$data['text_date'] = $this->language->get('text_date');
			$data['text_view'] = $this->language->get('text_view');
			$data['text_network'] = $this->language->get('text_network');
			
			$data['thread_id'] = $thread_info['thread_id'];
			$data['image'] = $thread_info['image'];
			$data['child'] = $thread_info['child'];
			$data['format'] = $thread_info['format'];
			$data['name'] = $thread_info['name'];
			$data['description'] = html_entity_decode($thread_info['description']);
			
			$this->document->setImage($thread_info['image']);

			$parent_info = $this->model_catalog_thread->getThread($thread_info['parent_id']);
			
			$data['threads'] = array();
			
			if ($parent_info) {
				if ($parent_info['child']) {
					
					$filter_var = array(
						'parent_id' => $parent_info['thread_id']
					);
					
					$threads = $this->model_catalog_thread->getThreads($filter_var);
					
					foreach ($threads as $thread) {
						$data['threads'][] = array(
							'thread_id'   => $thread['thread_id'],
							'name'        => $thread['name'] . ($this->setting['thread_post_count'] ? ' (' . $this->model_catalog_post->getTotalPostByThreadId($thread['thread_id']) . ')' : ''),
							'href'        => $this->url->link('information/thread', 'thread=' . $parent_info['thread_id'] . '_' . $thread['thread_id'])
						
						);
					}
				}
			}
			
			$data['childrens'] = array();
			
			if ($thread_info['child']) {
				
				$filter_var = array(
					'parent_id' => $thread_id
				);
				
				$childrens = $this->model_catalog_thread->getThreads($filter_var);
				
				if ($childrens) {
					$this->response->redirect($this->url->link('information/thread', 'thread=' . $thread_id . '_' . $childrens[0]['thread_id']));
				}
			}
			
			$data['posts'] = array();
			
			if ($thread_info['format'] != 'aside' && $thread_info['format'] != 'extra') {
				$posts = $this->model_catalog_post->getPosts($filter_data);
				
				foreach ($posts as $post) {
					if (is_file(DIR_IMAGE . $post['image'])) {
						$image = 'image/'. $post['image'];
						// $this->model_tool_image->resize($post['image'], $this->setting['image_thread_width'], $this->setting['image_thread_height']);
					} else {
						$image = $this->model_tool_image->resize('no_image.png', $this->setting['image_thread_width'], $this->setting['image_thread_height']);
					}
					$data['posts'][] = array (
						'post_id'       => $post['post_id'],
						'title' 		=> html_entity_decode($post['title'], ENT_QUOTES),
						'image'			=> $image,
						'short_description' 	=> (strlen(strip_tags(html_entity_decode($post['short_description'], ENT_QUOTES))) > $this->setting['description_limit'] ? substr(strip_tags(html_entity_decode($post['short_description'], ENT_QUOTES)), 0,$this->setting['description_limit']) . '...' : strip_tags(html_entity_decode($post['short_description'], ENT_QUOTES))),
						'href' 			=> $this->url->link('information/post', 'thread=' . $this->request->get['thread'] . '&post_id=' . $post['post_id']),
						'date_added' 	=> strtotime($post['date_added'])
					);
				}
			}
			
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');
			$data['config_comment'] = $this->config->get('config_comment');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/thread.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/information/thread.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/information/thread.tpl', $data));
			}
			
		} else {
			$url = '';

			if (isset($this->request->get['thread_id'])) {
				$url .= '&thread_id=' . $this->request->get['thread_id'];
			}

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
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

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('information/thread', $url)
			);

			$data['config_comment'] = $this->config->get('config_comment');
			$this->document->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('text_error');

			$data['text_error'] = $this->language->get('text_error');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('common/home');

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/not_found.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
			}
		}
	}
}
