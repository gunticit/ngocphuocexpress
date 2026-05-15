<?php
class ControllerCommonCSS extends Controller {
	public function index() {
		header("Content-type: text/css; charset: UTF-8");
		$this->load->model('design/page_css');
		
		$css = '';
		
		$styles_default = array(
			'catalog/view/javascript/bootstrap/css/bootstrap.min.css' => 'catalog/view/javascript/bootstrap/css/bootstrap.min.css',
			'catalog/view/javascript/font-awesome/css/font-awesome.min.css' => 'catalog/view/javascript/font-awesome/css/font-awesome.min.css',
			'catalog/view/font/fonts.css' => 'catalog/view/font/fonts.css',
			'catalog/view/stylesheet/canvas.css' => 'catalog/view/stylesheet/canvas.css'
		);
		
		foreach ($styles_default as $style) {
				$css .= $this->processCompress($style);
		}
		
		$styles = array();
		
		if(isset($this->request->get['css'])) {
			foreach (explode('|', gzinflate(base64_decode(strtr($this->request->get['css'], '-_', '+/')))) as $path) {
				$styles[$path] = $path;
			}
		}
		
		$styles['catalog/view/stylesheet/stylesheet.css'] = 'catalog/view/stylesheet/stylesheet.css';
		
		foreach ($styles as $style) {
			if($style){
				$css .= 'file-start-' . strtr(base32_encode(str_replace('catalog/view/', '', $style)), '+/', '-_') . '{}' . $this->processCompress($style) . 'file-end-' . strtr(base32_encode(str_replace('catalog/view/', '', $style)), '+/', '-_') . '{}';
			}
		}
		
		$css .= $this->model_design_page_css->getCSS();
		
		echo ($this->config->get('config_compression')) ? $this->gZip($css) : $css;
	}
	
	private function processCompress( $url ){
		global $cssURL;
		$cssURL = $url;
		
		$load_data = false;
		$save = false;
		
		if(strpos($url, 'http') === false) {
			if(!file_exists($url . '.minify') || (filemtime($url) > filectime($url . '.minify'))) {
				$load_data = true;
				$save = true;
			} else {
				$content = file_get_contents($url . '.minify');
			}
		} else {
			$load_data = true;
		}
		
		if($load_data) {
			$content = file_get_contents($url);
			if (substr_count($content, "\n") > 1) {
				$content = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $content);
				$content = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), ' ', $content);
				$content = preg_replace('/[ ]+([{};,:])/', '\1', $content);
				$content = preg_replace('/([{};,:])[ ]+/', '\1', $content);
				$content = preg_replace('/(\}([^\}]*\{\})+)/', '}', $content);
				$content = preg_replace('/<\?(.*?)\?>/mix', '', $content);
				$content = preg_replace_callback('/url\(([^\)]*)\)/', array('ControllerCommonCSS', 'callbackReplaceURL'), $content);
			} else {
				$save = false;
			}
		}
		
		if($save) file_put_contents($url . '.minify', $content);
		
		return $content;
	}
	
	private function callbackReplaceURL( $matches) {
        $url = str_replace(array('"', '\''), '', $matches[1]);
        global $cssURL;
        $url = self::converturl( $url, $cssURL );
        return "url('$url')";
    }
	
	public static function converturl($url, $cssurl) {
        $base = dirname($cssurl);
        if (preg_match('/^(\/|http)/', $url))
            return $url;
        /*absolute or root*/
        while (preg_match('/^\.\.\//', $url)) {
            $base = dirname($base);
            $url = substr($url, 3);
        }

        $url = $base . '/' . $url;
        return $url;
    }
	
	private function gZip($content = '') {
		$compress = true;
		$level = (int)$this->config->get('config_compression');
		
		if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) && (strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== false)) {
			$encoding = 'gzip';
		}

		if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) && (strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'x-gzip') !== false)) {
			$encoding = 'x-gzip';
		}

		if (!isset($encoding) || ($level < -1 || $level > 9)) {
			$compress = false;
		}

		if (!extension_loaded('zlib') || ini_get('zlib.output_compression')) {
			$compress = false;
		}

		if (headers_sent()) {
			$compress = false;
		}

		if (connection_status()) {
			$compress = false;
		}
		
		if($compress) {
			header('Content-Encoding: ' . $encoding);
	
			return gzencode($content, (int)$level);
		} else {
			return $content;
		}
	}
}
