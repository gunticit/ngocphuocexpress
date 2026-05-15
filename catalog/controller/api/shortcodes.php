<?php
class ControllerApiShortCodes extends Controller {
	public function doShortCodes(){
		if(isset($this->request->request['shortcode'])){
			$content = $this->request->request['shortcode'];
			
			$pattern = $this->shortcodes->getShortCodeRegex();
			
			preg_match_all('/'.$pattern.'/s', $content, $match, PREG_PATTERN_ORDER);
			
			if ($match) {
				if ($this->shortcodes->ShortCodeExists($match[2][0])) {
					if (isset($this->request->get['page_preview'])) {
						$this->document->addStyle('catalog/view/javascript/bootstrap/css/bootstrap.min.css');
						$this->document->addStyle('catalog/view/javascript/font-awesome/css/font-awesome.min.css');
						$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/stylesheet.css');
						
						$this->document->addScript('catalog/view/javascript/jquery/jquery-2.1.1.min.js');
						$this->document->addScript('catalog/view/javascript/bootstrap/js/bootstrap.min.js');
					}
					
					$extension = $this->shortcodes->getShortCode($match[2][0]);
					$info = $extension->info();
					
					if (isset($info['return_html']) && $info['return_html'] == true) {
						$content = $this->shortcodes->doShortCode($content);
				
						$stylesheets = '';
						
						foreach ($this->document->getStyles() as $style) {
							if ($this->request->server['HTTPS']) {
								$stylesheets .= '<link href="' . $this->config->get('config_ssl') . $style['href'] . '" type="text/css" rel="' . $style['rel'] . '" media="' . $style['media'] . '" />' . PHP_EOL;
							} else {
								$stylesheets .= '<link href="' . $this->config->get('config_url') . $style['href'] . '" type="text/css" rel="' . $style['rel'] . '" media="' . $style['media'] . '" />' . PHP_EOL;
							}
						}
						
						$javascripts = '';
						
						$scripts = $this->document->getScripts();
						
						foreach ($scripts as $script) {
							if ($this->request->server['HTTPS']) {
								$javascripts .= '<script src="' . $this->config->get('config_ssl') . $script . '" type="text/javascript"></script>' . PHP_EOL;
							} else {
								$javascripts .= '<script src="' . $this->config->get('config_url') . $script . '" type="text/javascript"></script>' . PHP_EOL;
							}
						}
							
						echo  html_entity_decode($javascripts . $stylesheets . $content);
					}
				}
			}
		}
	}
}
