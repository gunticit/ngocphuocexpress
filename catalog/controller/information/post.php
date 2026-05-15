<?php
class ControllerInformationpost extends Controller {
    public $settingpost;
    public function __construct($settingpost) {
    parent::__construct($settingpost);
		$this->load->model('setting/settingpost');
		$this->setting = $this->model_setting_settingpost->getSettingPosts();
	}

	public function index() {
		$this->load->model('setting/settingpost');
		$data['config_news']=$this->model_setting_settingpost->getSettingPosts();
		
		$this->load->model('catalog/post');
		$this->language->load('information/post');
		
		$this->document->addStyle('catalog/view/stylesheet/news.css');
		
		$this->document->addScript('catalog/view/javascript/jquery/swipebox/lib/ios-orientationchange-fix.js');
		$this->document->addScript('catalog/view/javascript/jquery/swipebox/source/jquery.swipebox.min.js');
		$this->document->addStyle('catalog/view/javascript/jquery/swipebox/source/swipebox.css');
			
	-
		$data['view_instantly']=$this->setting['view_instantly'];
		
		if ($this->setting['allow_guest_reviews'] || $this->customer->isLogged()) {
			$data['allow_guest_reviews'] = true;
		} else {
			$data['allow_guest_reviews'] = false;
		}
		
		$data['text_loading'] = $this->language->get('text_loading');
		$data['text_note'] = $this->language->get('text_note');
		$data['text_login'] = sprintf($this->language->get('text_login'), $this->url->link('account/login', '', 'SSL'), $this->url->link('account/register', '', 'SSL'));
		
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_review'] = $this->language->get('entry_review');
		$data['entry_rating'] = $this->language->get('entry_rating');
		$data['entry_bad'] = $this->language->get('entry_bad');
		$data['entry_good'] = $this->language->get('entry_good');
		
		// Captcha
		if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('review', (array)$this->config->get('config_captcha_page'))) {
			$data['captcha'] = $this->load->controller('captcha/' . $this->config->get('config_captcha'));
		} else {
			$data['captcha'] = '';
		}

		$data['button_continue'] = $this->language->get('button_continue');
		$data['post_id'] = $this->request->get['post_id'];
		

		if (isset($this->request->get['post_id']) && !empty($this->request->get['post_id'])) {
			$post_info_id = $this->request->get['post_id'];
			$this->model_catalog_post->updateViewed($this->request->get['post_id']);
		} else {
			$post_info_id = 0;
		}

		$post_info = $this->model_catalog_post->getPost($post_info_id);

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);
		
		$this->load->model('catalog/thread');

		if (isset($this->request->get['thread'])) {
			$thread = '';

			$parts = explode('_', (string)$this->request->get['thread']);

			$thread_id = (int)array_pop($parts);

			foreach ($parts as $path_id) {
				if (!$thread) {
					$thread = $path_id;
				} else {
					$thread .= '_' . $path_id;
				}

				$thread_info = $this->model_catalog_thread->getthread($path_id);

				if ($thread_info) {
					$data['breadcrumbs'][] = array(
						'text' => $thread_info['name'],
						'href' => $this->url->link('information/thread', 'thread_id=' . $thread)
					);
				}
			}
			
			// Set the last thread breadcrumb
			$thread_info = $this->model_catalog_thread->getthread($thread_id);
			
			if ($thread_info) {
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

				if (isset($this->request->get['limit'])) {
					$url .= '&limit=' . $this->request->get['limit'];
				}

				$data['breadcrumbs'][] = array(
					'text' => $thread_info['name'],
					'href' => $this->url->link('information/thread', 'thread=' . $this->request->get['thread'] . $url)
				);
			}
		}

		
		if ($post_info) {
			$data['breadcrumbs'][] = array(
				'text'      => $post_info['title'],
				'href' 		=> $this->url->link('information/post', 'post_id=' . $post_info_id)
			);
			
			$data['heading_title'] = html_entity_decode($post_info['title'], ENT_QUOTES);
			$data['description'] = html_entity_decode($post_info['description'], ENT_QUOTES);
			$data['short_description'] = html_entity_decode($post_info['short_description'], ENT_QUOTES);
			$data['date_added']= date($this->language->get('date_format_short'), strtotime($post_info['date_added']));

			$this->document->setTitle($post_info['title']);

			$this->load->model('tool/image');

			$data['image'] 		= $this->model_tool_image->resize($post_info['image'],$this->setting['image_thumb_width'], $this->setting['image_thumb_height']);

			$data['banner'] = $this->model_tool_image->resize($post_info['banner'], $this->setting['image_banner_width'], $this->setting['image_banner_height']);
			
			$post_image = $this->model_catalog_post->getPostImages($post_info['post_id']);
			
			$data['post_image'] = array();
			
			foreach ($post_image as $result) {
				$data['post_image'][] = array(
					'title' => $result['title'],
					'image' => $this->model_tool_image->resize($result['image'],$this->setting['image_popup_width'], $this->setting['image_popup_height']),
					'thumb' => $this->model_tool_image->resize($result['image'],$this->setting['image_gallery_width'], $this->setting['image_gallery_height'])
				);
			}
			
			// Load review
			$this->load->model('catalog/reviewpost');
			$results = $this->model_catalog_reviewpost->getReviewsBypostId($this->request->get['post_id']);

			foreach ($results as $result) {
				$data['reviewspost'][] = array(
					'author'     => $result['author'],
					'text'       => nl2br($result['text']),
					'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
				);
			}
			// Load postrelate
			$data['view_relate']=$this->setting['view_relate'];
			if($data['view_relate']){
				$post_inforelate = $this->model_catalog_post->getPostRelated($this->request->get['post_id'],$this->setting['item_view_relate']);
				$data['post_relateds'] = array();
				/*$data['text_post_realate']=$this->setting['post_realate'];*/
				$data['text_post_realate'] = $this->language->get('text_post_realate');
				$data['text_see_more'] = $this->language->get('text_see_more');
				foreach ($post_inforelate as $post_info_id) {
					$related_info = $this->model_catalog_post->getPost($post_info_id);
					if (is_file(DIR_IMAGE . $related_info['image'])) {
						$image1 = $this->model_tool_image->resize($related_info['image'], $this->setting['image_thread_width'], $this->setting['image_thread_height']);
					} else {
						$image1 = $this->model_tool_image->resize('no_image.png', $this->setting['image_thread_width'], $this->setting['image_thread_height']);
					}
					//print_r($related_info);
					if ($related_info) {
						$data['post_relateds'][] = array(
							'post_id' 	=> $related_info['post_id'],
							'title'     => $related_info['title'],
							'image'     => $image1,
							'href' 		=> $this->url->link('information/post', 'post_id=' . $related_info['post_id']),
							'short_description' 	=> (strlen(strip_tags(html_entity_decode($post_info['short_description'], ENT_QUOTES))) > $this->setting['description_limit'] ? substr(strip_tags(html_entity_decode($post_info['short_description'], ENT_QUOTES)), 0,$this->setting['description_limit']) . '...' : strip_tags(html_entity_decode($post_info['short_description'], ENT_QUOTES))),
							'date_added' 	=> date($this->language->get('j/n'), strtotime($post_info['date_added']))
						);
					}
				}
			}

			$data['attributes'] = $this->model_catalog_post->getPostAttributes($this->request->get['post_id']);

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');
			
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/post.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/information/post.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/information/post.tpl', $data));
			}

		} else {
			$data['breadcrumbs'][] = array(
				'text' 		=> $this->language->get('text_error'),
				'href' 		=> $this->url->link('information/post', 'post_id=' . $post_info_id)
			);

			$this->document->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('text_error');
			$data['text_error'] = $this->language->get('text_error');
			$data['button_continue'] = $this->language->get('button_continue');
			$data['continue'] = $this->url->link('common/home');

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

	public function review() {
		$this->load->language('information/post');

		$this->load->model('catalog/reviewpost');

		$data['text_no_reviews'] = $this->language->get('text_no_reviews');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['reviews'] = array();

		$review_total = $this->model_catalog_reviewpost->getTotalReviewsByPostId($this->request->get['post_id']);

		$results = $this->model_catalog_reviewpost->getReviewsByPostId($this->request->get['post_id'], ($page - 1) * 5, 5);

		foreach ($results as $result) {
			$data['reviews'][] = array(
				'author'     => $result['author'],
				'text'       => nl2br($result['text']),
				'rating'     => (int)$result['rating'],
				'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
			);
		}

		$pagination = new Pagination();
		$pagination->total = $review_total;
		$pagination->page = $page;
		$pagination->limit = 5;
		$pagination->url = $this->url->link('information/post/review', 'post_id=' . $this->request->get['post_id'] . '&page={page}');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($review_total) ? (($page - 1) * 5) + 1 : 0, ((($page - 1) * 5) > ($review_total - 5)) ? $review_total : ((($page - 1) * 5) + 5), $review_total, ceil($review_total / 5));

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/review.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/information/review.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/information/review.tpl', $data));
		}
	}

	public function write() {
		$this->language->load('information/post');

		$json = array();

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 25)) {
				$json['error'] = $this->language->get('error_name');
			}

			if ((utf8_strlen($this->request->post['text']) < 25) || (utf8_strlen($this->request->post['text']) > 1000)) {
				$json['error'] = $this->language->get('error_text');
			}

			if (!isset($json['error'])) {
				$this->load->model('catalog/reviewpost');

				$data= array(
					'rating' => $this->request->post['rating'],
					'instantly' => $this->setting['view_instantly'],
					'author' => $this->request->post['name'],
					'text' => $this->request->post['text']
				);

				$this->model_catalog_reviewpost->addReviewPost($this->request->get['post_id'],$data);

				$json['success'] = $this->language->get('text_success');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
