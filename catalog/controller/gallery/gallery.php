<?php
class Controllergallerygallery extends Controller {
	public function index() {
		
		$this->load->language('gallery/gallery');

		$this->load->model('catalog/gallery');
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


		if (isset($this->request->get['gallery_id'])) {
			$gallery_id = (int)$this->request->get['gallery_id'];
		} else {
			$gallery_id = 0;
		}

		$gallery_info = $this->model_catalog_gallery->getgallery($gallery_id);
		if($gallery_info){

			$this->document->setTitle($gallery_info['name']);
			

			$this->document->addScript('catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js');
			$this->document->addStyle('catalog/view/javascript/jquery/magnific/magnific-popup.css');

			$data['heading_title'] = $gallery_info['name'];

			$data['text_refine'] = $this->language->get('text_refine');
			$data['text_empty'] = $this->language->get('text_empty');
			
			$data['text_sort'] = $this->language->get('text_sort');
			$data['text_limit'] = $this->language->get('text_limit');


			// Set the last gallery breadcrumb
			$data['breadcrumbs'][] = array(
				'text' =>  $gallery_info['name'],
				'href' => $this->url->link('gallery/gallery')
			);

			
		
			$data['gallery'] = array();


		


			$results = $this->model_catalog_gallery->getgalleryImages($gallery_id);

			foreach ($results as $result) {

				if ($result['image']) {
					$thumb = 'image/'.$result['image'];
					// $this->model_tool_image->resize($result['image'], 240, 160);
					$popup = $this->model_tool_image->resize($result['image'], 400, 600);
				} else {
					$thumb = 'image/'.$result['image'];
					// $this->model_tool_image->resize('placeholder.png', 240, 160);
					$popup = $this->model_tool_image->resize('placeholder.png', 400, 600);
				}
		

				$data['gallerys'][] = array( 
					'gallery_id'  => $result['gallery_id'],
					'thumb'        => $thumb,
					'popup'        => 'image/' . $result['image']
				);
			}

			

			$data['continue'] = $this->url->link('common/home');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/gallery/gallery.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/gallery/gallery.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/gallery/gallery.tpl', $data));
			}
			

		}

		
	}
}
