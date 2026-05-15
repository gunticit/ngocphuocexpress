<?php
class ControllerCommonHome extends Controller {
	public function index() {
		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));

		if (isset($this->request->get['route'])) {
			$this->document->addLink(HTTP_SERVER, 'canonical');
		}
		
		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}
		
		if (is_file(DIR_IMAGE.$this->config->get('config_logo'))) {
			$this->document->setImage($server . 'image/' . $this->config->get('config_logo'));
		}
		
		$this->load->model('design/page');
		
		$pages = $this->model_design_page->getPageHome();
		
		$data['page_content'] = '';
		
		foreach ($pages as $page) {
			$data['page_content'] .= $this->shortcodes->doShortCode($page['content']);
		}
		
		if (!$pages) {
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
		}

		$data['name'] = $this->config->get('config_name');
		$data['address'] = $this->config->get('config_address');
		$data['telephone'] = $this->config->get('config_telephone');
		$data['oclock'] = $this->config->get('config_open');
		$data['logo_ft_home'] = 'image/'.$this->config->get('config_logo');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
        
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/home.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/home.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/common/home.tpl', $data));
		}
		
	}
}