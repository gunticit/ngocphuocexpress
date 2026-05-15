<?php

class ControllerModuleHTML extends Controller {

	public function index($setting) {

		if (isset($setting['module_description'][$this->config->get('config_language_id')])) {

			$data['heading_title'] = html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['title'], ENT_QUOTES, 'UTF-8');

			$data['html'] = html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['description'], ENT_QUOTES, 'UTF-8');

			$data['background'] = 'image/'.$setting['background'];
			$data['background2'] = 'image/'.$setting['background2'];
			$language_id = (int)$this->config->get('config_language_id');
			$data['config_tamnhin'] = !empty($this->config->get('config_tamnhin'))?html_entity_decode($this->config->get('config_tamnhin')[$language_id]):'';
			$data['config_sumenh'] = !empty($this->config->get('config_sumenh'))?html_entity_decode($this->config->get('config_sumenh')[$language_id]):'';
			$data['config_gtcl'] = !empty($this->config->get('config_gtcl'))?html_entity_decode($this->config->get('config_gtcl')[$language_id]):'';

			$data['img_setting'] = 'image/'.$this->config->get('config_image');



			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/html.tpl')) {

				return $this->load->view($this->config->get('config_template') . '/template/module/html.tpl', $data);

			} else {

				return $this->load->view('default/template/module/html.tpl', $data);

			}

		}

	}

}