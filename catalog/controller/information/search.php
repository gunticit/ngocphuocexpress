<?php
class ControllerInformationSearch extends Controller {
	public function index() {
		$this->load->language('information/search');

		$this->load->model('catalog/post');

		$this->load->model('tool/image');
		
		$this->load->model('setting/settingpost');
		
		$setting = $this->model_setting_settingpost->getSettingPosts($this->config->get('config_store_id'));
		
		if (isset($this->request->get['search'])) {
			$search = $this->request->get['search'];
		} else {
			$search = '';
		}

		if (isset($this->request->get['tag'])) {
			$tag = $this->request->get['tag'];
		} elseif (isset($this->request->get['search'])) {
			$tag = $this->request->get['search'];
		} else {
			$tag = '';
		}

		if (isset($this->request->get['description'])) {
			$description = $this->request->get['description'];
		} else {
			$description = '';
		}

		if (isset($this->request->get['thread_id'])) {
			$thread_id = $this->request->get['thread_id'];
		} else {
			$thread_id = 0;
		}

		if (isset($this->request->get['sub_thread'])) {
			$sub_thread = $this->request->get['sub_thread'];
		} else {
			$sub_thread = '';
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.sort_order';
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

		if (isset($this->request->get['limit'])) {
			$limit = (int)$this->request->get['limit'];
		} else {
			$limit = $setting['item_perpage_thread'];
		}

		if (isset($this->request->get['search'])) {
			$this->document->setTitle($this->language->get('heading_title') .  ' - ' . $this->request->get['search']);
		} elseif (isset($this->request->get['tag'])) {
			$this->document->setTitle($this->language->get('heading_title') .  ' - ' . $this->language->get('heading_tag') . $this->request->get['tag']);
		} else {
			$this->document->setTitle($this->language->get('heading_title'));
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$url = '';

		if (isset($this->request->get['search'])) {
			$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['tag'])) {
			$url .= '&tag=' . urlencode(html_entity_decode($this->request->get['tag'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['description'])) {
			$url .= '&description=' . $this->request->get['description'];
		}

		if (isset($this->request->get['thread_id'])) {
			$url .= '&thread_id=' . $this->request->get['thread_id'];
		}

		if (isset($this->request->get['sub_thread'])) {
			$url .= '&sub_thread=' . $this->request->get['sub_thread'];
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
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('information/search', $url)
		);

		if (isset($this->request->get['search'])) {
			$data['heading_title'] = $this->language->get('heading_title') .  ' - ' . $this->request->get['search'];
		} else {
			$data['heading_title'] = $this->language->get('heading_title');
		}

		$data['text_empty'] = $this->language->get('text_empty');
		$data['text_search'] = $this->language->get('text_search');
		$data['text_keyword'] = $this->language->get('text_keyword');
		$data['text_thread'] = $this->language->get('text_thread');
		$data['text_sub_thread'] = $this->language->get('text_sub_thread');
		$data['text_quantity'] = $this->language->get('text_quantity');
		$data['text_manufacturer'] = $this->language->get('text_manufacturer');
		$data['text_model'] = $this->language->get('text_model');
		$data['text_price'] = $this->language->get('text_price');
		$data['text_tax'] = $this->language->get('text_tax');
		$data['text_points'] = $this->language->get('text_points');
		$data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
		$data['text_sort'] = $this->language->get('text_sort');
		$data['text_limit'] = $this->language->get('text_limit');

		$data['entry_search'] = $this->language->get('entry_search');
		$data['entry_description'] = $this->language->get('entry_description');

		$data['button_search'] = $this->language->get('button_search');
		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');
		$data['button_list'] = $this->language->get('button_list');
		$data['button_grid'] = $this->language->get('button_grid');
		
		$this->load->model('catalog/thread');

		// 3 Level thread Search
		$data['threads'] = array();

		$threads_1 = $this->model_catalog_thread->getthreadspost(0);

		foreach ($threads_1 as $thread_1) {
			$level_2_data = array();

			$threads_2 = $this->model_catalog_thread->getthreadspost($thread_1['thread_id']);

			foreach ($threads_2 as $thread_2) {
				$level_3_data = array();

				$threads_3 = $this->model_catalog_thread->getthreadspost($thread_2['thread_id']);

				foreach ($threads_3 as $thread_3) {
					$level_3_data[] = array(
						'thread_id' => $thread_3['thread_id'],
						'name'        => $thread_3['name'],
					);
				}

				$level_2_data[] = array(
					'thread_id' => $thread_2['thread_id'],
					'name'        => $thread_2['name'],
					'children'    => $level_3_data
				);
			}

			$data['threads'][] = array(
				'thread_id' => $thread_1['thread_id'],
				'name'        => $thread_1['name'],
				'children'    => $level_2_data
			);
		}

		$data['posts'] = array();

		if (isset($this->request->get['search']) || isset($this->request->get['tag'])) {
			$filter_data = array(
				'filter_name'         => $search,
				'filter_tag'          => $tag,
				'filter_description'  => $description,
				'filter_thread_id'  => $thread_id,
				'filter_sub_thread' => $sub_thread,
				'sort'                => $sort,
				'order'               => $order,
				'start'               => ($page - 1) * $limit,
				'limit'               => $limit
			);
		
			$post_total = $this->model_catalog_post->getTotalpost($filter_data);
			
			$results = $this->model_catalog_post->getposts($filter_data);

			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $setting['image_thread_width'], $setting['image_thread_height']);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $setting['image_thread_width'], $setting['image_thread_height']);
				}

				$data['posts'][] = array(
					'post_id'  => $result['post_id'],
					'thumb'       => $image,
					'name'        => $result['title'],
					'description' => html_entity_decode($result['short_description']),
					'href'        => $this->url->link('information/post/post', 'post_id=' . $result['post_id'] . $url)
				);
			}

			$url = '';

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . urlencode(html_entity_decode($this->request->get['tag'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}

			if (isset($this->request->get['thread_id'])) {
				$url .= '&thread_id=' . $this->request->get['thread_id'];
			}
			
			if (isset($this->request->get['sub_thread'])) {
				$url .= '&sub_thread=' . $this->request->get['sub_thread'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['sorts'] = array();

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_default'),
				'value' => 'p.sort_order-ASC',
				'href'  => $this->url->link('information/search', 'sort=p.sort_order&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_name_asc'),
				'value' => 'pd.name-ASC',
				'href'  => $this->url->link('information/search', 'sort=pd.name&order=ASC' . $url)
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_name_desc'),
				'value' => 'pd.name-DESC',
				'href'  => $this->url->link('information/search', 'sort=pd.name&order=DESC' . $url)
			);

			$url = '';

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . urlencode(html_entity_decode($this->request->get['tag'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}

			if (isset($this->request->get['thread_id'])) {
				$url .= '&thread_id=' . $this->request->get['thread_id'];
			}

			if (isset($this->request->get['sub_thread'])) {
				$url .= '&sub_thread=' . $this->request->get['sub_thread'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			$data['limits'] = array();

			$limits = array_unique(array($this->config->get('config_product_limit'), 25, 50, 75, 100));

			sort($limits);

			foreach($limits as $value) {
				$data['limits'][] = array(
					'text'  => $value,
					'value' => $value,
					'href'  => $this->url->link('information/search', $url . '&limit=' . $value)
				);
			}

			$url = '';

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . urlencode(html_entity_decode($this->request->get['tag'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}

			if (isset($this->request->get['thread_id'])) {
				$url .= '&thread_id=' . $this->request->get['thread_id'];
			}

			if (isset($this->request->get['sub_thread'])) {
				$url .= '&sub_thread=' . $this->request->get['sub_thread'];
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

			$pagination = new Pagination();
			$pagination->total = $post_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->url = $this->url->link('information/search', $url . '&page={page}');

			$data['pagination'] = $pagination->render();

			$data['results'] = sprintf($this->language->get('text_pagination'), ($post_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($post_total - $limit)) ? $post_total : ((($page - 1) * $limit) + $limit), $post_total, ceil($post_total / $limit));

			// http://googlewebmastercentral.blogspot.com/2011/09/pagination-with-relnext-and-relprev.html
			if ($page == 1) {
			    $this->document->addLink($this->url->link('information/search', '', 'SSL'), 'canonical');
			} elseif ($page == 2) {
			    $this->document->addLink($this->url->link('information/search', '', 'SSL'), 'prev');
			} else {
			    $this->document->addLink($this->url->link('information/search', $url . '&page='. ($page - 1), 'SSL'), 'prev');
			}

			if ($limit && ceil($post_total / $limit) > $page) {
			    $this->document->addLink($this->url->link('information/search', $url . '&page='. ($page + 1), 'SSL'), 'next');
			}
		}

		$data['search'] = $search;
		$data['description'] = $description;
		$data['thread_id'] = $thread_id;
		$data['sub_thread'] = $sub_thread;

		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['limit'] = $limit;

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/search.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/information/search.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/information/search.tpl', $data));
		}
	}
}
