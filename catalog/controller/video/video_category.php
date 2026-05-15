<?php
class Controllervideovideo extends Controller {
	public function index() {
		
		$this->load->language('video/video');

		$this->load->model('catalog/video');
		$this->load->model('tool/image');

		if (isset($this->request->get['filter'])) {
			$filter = $this->request->get['filter'];
		} else {
			$filter = '';
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
			$limit = 8;
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);


		$this->document->setTitle($this->language->get('heading_title'));
			$this->document->setDescription($this->language->get('meta_description'));
			$this->document->setKeywords($this->language->get('meta_keyword'));

			$this->document->addScript('catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js');
			$this->document->addStyle('catalog/view/javascript/jquery/magnific/magnific-popup.css');

			$data['heading_title'] = $this->language->get('heading_title');

			$data['text_refine'] = $this->language->get('text_refine');
			$data['text_empty'] = $this->language->get('text_empty');
			
			$data['text_sort'] = $this->language->get('text_sort');
			$data['text_limit'] = $this->language->get('text_limit');


			// Set the last video breadcrumb
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('video/video')
			);

			
	

			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
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

			$data['video'] = array();


			$filter_data = array(
				'start'              => ($page - 1) * $limit,
				'limit'              => $limit
			);

			$video_total = $this->model_catalog_video->getTotalvideos();

			$results = $this->model_catalog_video->getvideoss($filter_data);

			foreach ($results as $result) {

				if ($result['image']) {
					$thumb = $this->model_tool_image->resize($result['image'], 545, 369);
					
				} else {
					$thumb = $this->model_tool_image->resize('placeholder.png', 545, 369);
				}
				$images = array();

				$results1 = $this->model_catalog_video->getvideoImages($result['video_id']);

				foreach ($results1 as $result1) {
					$images[] = array(
						'thumb' => $this->model_tool_image->resize($result1['image'],  700, 474)
					);
				}

				$data['videos'][] = array(
					'video_id'  => $result['video_id'],
					'name'        => $result['name'],
					'thumb'        => $thumb,
					'images'        => $images,				
				);
			}

			

			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['sorts'] = array();

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_default'),
				'value' => 'p.sort_order-ASC',
				'href'  => $this->url->link('video/video', '&sort=p.sort_order&order=ASC' . $url)
			);

		

			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			$data['limits'] = array();

			$limits = array_unique(array(8, 25, 50, 75, 100));

			sort($limits);

			foreach($limits as $value) {
				$data['limits'][] = array(
					'text'  => $value,
					'value' => $value,
					'href'  => $this->url->link('video/video','&limit=' . $value)
				);
			}

			$url = '';

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
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
			$pagination->total = $video_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->url = $this->url->link('video/video', $url . '&page={page}');

			$data['pagination'] = $pagination->render();

			$data['results'] = sprintf($this->language->get('text_pagination'), ($video_total) ? (($page - 1) * 8) + 1 : 0, ((($page - 1) * 8) > ($video_total - 8)) ? $video_total : ((($page - 1) * 8) + 8), $video_total, ceil($video_total / 8));


			$data['sort'] = $sort;
			$data['order'] = $order;
			$data['limit'] = $limit;

			$data['continue'] = $this->url->link('common/home');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/video/video.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/video/video.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/video/video.tpl', $data));
			}
	
		
	}
}
