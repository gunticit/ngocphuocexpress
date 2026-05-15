<?php
class ControllerCommonBreadcrumb extends Controller {
	public function index($breadcrumbs = array()) {
	   
      $data['breadcrumbs'] = $breadcrumbs;
	    
	    if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/breadcrumb.tpl')) {
    			return $this->load->view($this->config->get('config_template') . '/template/common/breadcrumb.tpl',  $data);
    	} else {
    			return $this->load->view('default/template/common/breadcrumb.tpl',  $data);
    	}
	}
}
