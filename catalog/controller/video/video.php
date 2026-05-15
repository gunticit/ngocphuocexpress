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


		if (isset($this->request->get['video_id'])) {
			$video_id = (int)$this->request->get['video_id'];
		} else {
			$video_id = 0;
		}

		$video_info = $this->model_catalog_video->getvideo($video_id);
		if($video_info){

			$this->document->setTitle($video_info['name']);
			

			$this->document->addScript('catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js');
			$this->document->addStyle('catalog/view/javascript/jquery/magnific/magnific-popup.css');

			$data['heading_title'] = $video_info['name'];

			$data['text_refine'] = $this->language->get('text_refine');
			$data['text_empty'] = $this->language->get('text_empty');
			
			$data['text_sort'] = $this->language->get('text_sort');
			$data['text_limit'] = $this->language->get('text_limit');


			// Set the last video breadcrumb
			$data['breadcrumbs'][] = array(
				'text' =>  $video_info['name'],
				'href' => $this->url->link('video/video')
			);

			$data['duongdan'] = $video_info['image'];
			
		
			$data['video'] = array();


		


			$results = $this->model_catalog_video->getvideoImages($video_id);

			foreach ($results as $result) {

				if ($result['image']) {
					$thumb = $this->model_tool_image->resize($result['image'], 545, 369);
					$popup = $this->model_tool_image->resize($result['image'], 545, 369);
				} else {
					$thumb = $this->model_tool_image->resize('placeholder.png', 545, 369);
					$popup = $this->model_tool_image->resize('placeholder.png', 545, 369);
				}
		

				$data['videos'][] = array(
					'video_id'  => $result['video_id'],
					'tenvideo'	=> $result['tenvideo'],
					'thumb'        => $result['image'],
					'popup'        => $result['image']	
				);
			}

			

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
}
