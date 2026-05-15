<?php
class ControllerCommonMegaMenuMobile extends Controller {
	public function index() {
		$this->load->language('common/megamenu');
		$route = isset($this->request->get['route']) ? $this->request->get['route'] : null;
		
		$this->document->addStyle('catalog/view/theme/default/stylesheet/megamenu.css');
		
		$this->load->model('design/megamenu');
		$root_menus = $this->model_design_megamenu->getlist();
		$options = $this->model_design_megamenu->getOptions();
		
		foreach($options as $val){
			$data[$val['name']] = $val['value'];
		}
		
		if($root_menus){
			foreach($root_menus as $key=>$value){
				if($value['type']=='page'){
					$root_menus[$key]['url'] = $this->url->link('common/page', 'page_id=' . $value['type_id']);
					if($route=='common/page' && isset($this->request->get['page_id']) && $this->request->get['page_id']==$value['type_id'])
					$root_menus[$key]['active'] = 1;
				}
				
				if($value['type']=='category'){
					$root_menus[$key]['url'] = $this->url->link('product/category', 'path=' . $value['type_id']);
					
					if (isset($this->request->get['path'])) {
						$parts = explode('_', (string)$this->request->get['path']);
					} else {
						$parts = array();
					}
					
					if($route=='product/category' && in_array($value['type_id'], $parts))
						$root_menus[$key]['active'] = 1;
				}
				
				if($value['type']=='thread'){
					$root_menus[$key]['url'] = $this->url->link('information/thread', 'thread=' . $value['type_id']);
					
					if (isset($this->request->get['thread'])) {
						$parts = explode('_', (string)$this->request->get['thread']);
					} else {
						$parts = array();
					}
					
					if ($route=='information/thread' && in_array($value['type_id'], $parts)) {
						$root_menus[$key]['active'] = 1;
					}
				}
				
				if($value['type']=='infomation'){
					$root_menus[$key]['url'] = $this->url->link('information/information', 'information_id=' . $value['type_id']);
					if($route=='information/information' && isset($this->request->get['information_id']) && $this->request->get['information_id']==$value['type_id'])
					$root_menus[$key]['active'] = 1;
				}
				
				if($value['type']=='manufacturer'){
					$root_menus[$key]['url'] = $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $value['type_id']);
					if($route=='product/manufacturer/info' && isset($this->request->get['manufacturer_id']) && $this->request->get['manufacturer_id']==$value['type_id'])
					$root_menus[$key]['active'] = 1;
				}
				
				if( (preg_match('/index.php$/i', $value['url']) || preg_match('/common\/home$/i', $value['url']) || preg_match('/\/$/i', $value['url'])) and (!$route or $route=='common/home') ){
					$root_menus[$key]['active'] = 1;
				}
				
			}
		}
		
		$data['menus_root'] = $root_menus;
		$data['responsive_title'] = $this->language->get('responsive_title');
		$data['proMegaMenuModel'] = $this->model_design_megamenu;
		$data['configObject'] = $this->config;

		$data['cart'] = $this->load->controller('common/cart');
			
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/megamenumobile.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/megamenumobile.tpl', $data);
		} else {
			return $this->load->view('default/template/common/megamenumobile.tpl', $data);
		}
	}
}