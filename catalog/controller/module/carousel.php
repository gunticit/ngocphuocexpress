<?php

class ControllerModuleCarousel extends Controller {

	public function index($setting) {

		static $module = 0;



		$this->load->model('design/banner');

		$this->load->model('tool/image');



		$this->document->addStyle('catalog/view/theme/default/stylesheet/owl.carousel.css');

		$this->document->addScript('catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js');



		$data['banners'] = array();



		$this->load->model('localisation/language');

		$data['langh'] = $this->language->get('code');
		$lanbg = $this->model_localisation_language->getLanguageByCode($data['langh']);
		$data['heading_title'] = $setting['titleh'][$lanbg['language_id']];

		$data['languages'] = array();


		$results = $this->model_localisation_language->getLanguages();



		if ($this->request->server['HTTPS']) {

			$server = $this->config->get('config_ssl');

		} else {

			$server = $this->config->get('config_url');

		}


		foreach ($results as $result) {

			if ($result['status']) {

				$data['languages'][] = array(

					'name'  => $result['name'],
					'language_id'  => $result['language_id'],

					'code'  => $result['code'],

					'image' => $server.'image/flags/'.$result['image']

				);

			}

		}


		$results = $this->model_design_banner->getBanner($setting['banner_id']);



		foreach ($results as $result) {

			if (is_file(DIR_IMAGE . $result['image'])) {

				$data['banners'][] = array(

					'title' => $result['title'],

					'link'  => $result['link'],
					'description'  => $result['description'],

					'image' => 'image/'.$result['image'],

					// $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height'])

				);

			}

		}

		$data['text_more'] = $this->language->get('text_more');



		$data['module'] = $module++;



		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/carousel.tpl')) {

			return $this->load->view($this->config->get('config_template') . '/template/module/carousel.tpl', $data);

		} else {

			return $this->load->view('default/template/module/carousel.tpl', $data);

		}

	}

}