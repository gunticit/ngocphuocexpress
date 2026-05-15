<?php
class Controllerdocumentdocument extends Controller {
	public function index() {
		
		$this->load->language('document/document');

		$this->load->model('catalog/document');
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


		if (isset($this->request->get['document_id'])) {
			$document_id = (int)$this->request->get['document_id'];
		} else {
			$document_id = 0;
		}

		$document_info = $this->model_catalog_document->getdocument($document_id);
		if($document_info){

			$this->document->setTitle($document_info['name']);
			

			$this->document->addScript('catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js');
			$this->document->addStyle('catalog/view/javascript/jquery/magnific/magnific-popup.css');

			$data['heading_title'] = $document_info['name'];

			$data['image'] = 'image/' . $document_info['image'];

			$data['text_refine'] = $this->language->get('text_refine');
			$data['text_empty'] = $this->language->get('text_empty');
			
			$data['text_sort'] = $this->language->get('text_sort');
			$data['text_limit'] = $this->language->get('text_limit');


			// Set the last document breadcrumb
			$data['breadcrumbs'][] = array(
				'text' =>  $document_info['name'],
				'href' => $this->url->link('document/document')
			);

			
		
			$data['document'] = array();


		


			$results = $this->model_catalog_document->getdocumentImages($document_id);

			foreach ($results as $result) {

				if ($result['image']) {
					$thumb = $this->model_tool_image->resize($result['image'], 240, 160);
					$popup = $this->model_tool_image->resize($result['image'], 400, 600);
				} else {
					$thumb = $this->model_tool_image->resize('placeholder.png', 240, 160);
					$popup = $this->model_tool_image->resize('placeholder.png', 400, 600);
				}
			
				$filename2 = substr(strrchr($result['image'], '/'), 1); 
				$ext2 = substr(strrchr($filename2, '.'), 1);

				if($ext2 == 'doc' || $ext2 == 'docx') 
				{ 
				$file_name2 = $result['image']; 
				}
				else if ($ext2 == 'xls' || $ext2 == 'xlsx') 
				{
				$file_name2 = $result['image'];
				}
				else if ($ext2 == 'ppt' || $ext2 == 'pptx') 
				{
				$file_name2 = $result['image'];
				}
				else if ($ext2 == 'pdf') 
				{
				$file_name2 = $result['image'];
				}
				else if (empty($file_name1))
				{ 
				$file_name2 = $this->model_tool_image->resize('placeholder.png', 100, 100);
				}
				else 
				{
				$file_name2 = $this->model_tool_image->resize($result['image'], 100, 100);
				}
				$image = $file_name2;

				$data['documents'][] = array(
					'document_id'  => $result['document_id'],
					'tendocument'	=> $result['tendocument'],
					'image'	       => 'image/'.$image,
					'thumb'        => $thumb,
					'popup'        => $popup
				);
			}

			

			$data['continue'] = $this->url->link('common/home');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/document/document.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/document/document.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/document/document.tpl', $data));
			}
			

		}

		
	}
}
