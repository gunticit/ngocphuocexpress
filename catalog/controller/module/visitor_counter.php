<?php
class ControllerModuleVisitorCounter extends Controller {
	public function index() {
		
        $this->language->load('module/visitor_counter');

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_today_visitor'] = $this->language->get('text_today_visitor');
		$data['text_total_visitor'] = $this->language->get('text_total_visitor');
		$data['text_today_hit'] = $this->language->get('text_today_hit');
		$data['text_total_hit'] = $this->language->get('text_total_hit');
		$data['text_online'] = $this->language->get('text_online');
		
		$this->load->model('module/visitor_counter');

		$results = $this->model_module_visitor_counter->addVisitor();
		foreach ($results as $key => $value) {
			$data[$key] = $results[$key];
		}

		$num_visitors = $results["total_visitor"];
		$num_visits = $results["total_hits"];

		$filler_text = "00000000";
		if (strlen("$num_visitors") < 8) {
			$num_visitors = substr($filler_text, 0, (8-strlen("$num_visitors"))) . "$num_visitors";
		}
		if (strlen("$num_visits") < 8) {
			$num_visits = substr($filler_text, 0, (8-strlen("$num_visits"))) . "$num_visits";
		}

		if ($this->config->get('visitor_counter_main_counter') == 1) {
			$data['visitor_counter_num'] = "$num_visitors";
		}
		else {
			$data['visitor_counter_num'] = "$num_visits";
		}

        $path = "image/counter/";
        $ext = ".png";
        $str = $data['visitor_counter_num'];
        for ( $i = 0; $i <= 9; $i++ ){
	       $str = str_replace($i, "<img src='$path$i$ext' alt='$i'>", $str);
        }
		$data['visitor_counter_num'] = $str;


		$this->id = 'visitor_counter';
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/visitor_counter.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/visitor_counter.tpl', $data);
		} else {
			return $this->load->view('default/template/module/visitor_counter.tpl', $data);
		}
	}
}
?>
