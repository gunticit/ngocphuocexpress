<?php
class ControllerModuleBannerGrid extends Controller {
	public function index($setting) {
		static $module = 0;

		$this->load->model('design/banner');
		$this->load->model('tool/image');
		$this->load->model('catalog/manufacturer');
		
		//$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.carousel.css');
		//$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.transitions.css');
		//$this->document->addScript('catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js');
		
		$data['perrow_id'] = $setting['perrow_id'];
		$data['status'] = $setting['status'];		
		$data['heading_title'] = $setting['name'];		
		$data['shortdess'] = html_entity_decode($setting['shortdess']);		
		$data['banners'] = array();
		$data['banners1'] = array();
		$data['banners2'] = array();
		$data['banners3'] = array();

		$results = $this->model_design_banner->getBanner($setting['banner_id']);

		foreach ($results as $result) {
			$data['banners'][] = array(
				'title' => $result['title'],
				'link'  => $result['link'],
				'description' => $result['description'],
				'anhgoc' => $result['image'],
				'image' => 'image/'.$result['image'],
					// $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height'])
			);
		}
		foreach ($results as $key => $result) {
			if($key <= 2){ 
				$data['banners1'][] = array(
					'title' => $result['title'],
					'link'  => $result['link'],
					'description' => $result['description'],
					'anhgoc' => $result['image'],
					'image' => 'image/'.$result['image'],
					// $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height'])
				);
			}
		}
		foreach ($results as $key => $result) {
			if($key > 2 && $key <= 4){
			$data['banners2'][] = array(
				'title' => $result['title'],
				'link'  => $result['link'],
				'description' => $result['description'],
				'anhgoc' => $result['image'],
				'image' => 'image/'.$result['image'],
					// $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height'])
			);
			}
		}
		foreach ($results as $key => $result) {
			if($key > 4 && $key <= 7){
			$data['banners3'][] = array(
				'title' => $result['title'],
				'link'  => $result['link'],
				'description' => $result['description'],
				'anhgoc' => $result['image'],
				'image' => 'image/'.$result['image'],
					// $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height'])
			);
			}
		}

		$manufacturer = $this->model_catalog_manufacturer->getManufacturers();
		$data['manufacturers'] = array();

		foreach ($manufacturer as $result) {
			if (is_numeric(utf8_substr($result['name'], 0, 1))) {
				$key = '0 - 9';
			} else {
				$key = utf8_substr(utf8_strtoupper($result['name']), 0, 1);
			}

			if (!isset($data['categories'][$key])) {
				$data['categories'][$key]['name'] = $key;
			}

			$data['manufacturers'][] = array(
				'name' => $result['name'],
				'href' => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $result['manufacturer_id'])
			);
		}

		$data['module'] = $module++;

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/banner_grid.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/banner_grid.tpl', $data);
		} else {
			return $this->load->view('default/template/module/banner_grid.tpl', $data);
		}
	}
}