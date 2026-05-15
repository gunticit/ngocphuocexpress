<?php
class ControllerCommonFooter extends Controller {
	public function index() {
		$this->load->language('common/footer');
		
		//ShortCodes
		
		$extensions = array_diff(scandir(DIR_SYSTEM."extension/"),array('.','..'));
		
		$data['shortcodes_script'] = '<script type="text/javascript">';
		
		foreach($extensions as $extension){
			include_once(DIR_SYSTEM."extension/".$extension);
			
			$class = str_replace(".php","",$extension);
			${$class} = new $class($this->registry);
			
			$data['shortcodes_script'] .= $this->shortcodes->parseInfo(${$class}->info());
		}
		
		$data['shortcodes_script'] .= '</script>';

		$data['text_footer'] = $this->language->get('text_footer');

		if ($this->user->isLogged() && isset($this->request->get['token']) && ($this->request->get['token'] == $this->session->data['token'])) {
			$data['text_version'] = sprintf($this->language->get('text_version'), VERSION);
		} else {
			$data['text_version'] = '';
		}
		$data['width'] = 800;
		$data['height'] = 600;
		$data['lang'] = 'en';
		if ($this->config->get('pim_status')) {
		$data['width'] = $this->config->get('pim_width');
		$data['height'] = $this->config->get('pim_height');
			if ($this->config->get('pim_language')) {
				$data['lang'] = $this->config->get('pim_language');
			}
		}
        $data['pim_status'] = $this->config->get('pim_status');
		return $this->load->view('common/footer.tpl', $data);
	}
}
