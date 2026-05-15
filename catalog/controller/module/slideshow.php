<?php

class ControllerModuleSlideshow extends Controller {
	public function bookingSQL($data){
		$sql = "INSERT INTO " . DB_PREFIX . "booking SET id_pro = '".$this->db->escape($data['id_pro'])."', seat_booking = '" . $this->db->escape($data['tickets']) . "',price_booking = '" . $this->db->escape($data['total_price']) . "',name_booking = '" . $this->db->escape($data['your_user']) . "',phone_booking = '" . $this->db->escape($data['phone_user']) . "',email_booking = '" . $this->db->escape($data['email_user']) . "',address_booking = '" . $this->db->escape($data['address_user']) . "',note_booking = '" . $this->db->escape($data['note_user']) . "',date_booking = '" . $this->db->escape($data['date_user']) . "',date_created = NOW()";
		$query = $this->db->query($sql);
		$booking_id = $this->db->getLastId();
		return $booking_id;
	}
	public function index($setting) {

		static $module = 0;



		$this->load->model('design/banner');

		$this->load->model('tool/image');

		

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/slideshow.tpl')) {

			$data['path'] = 'catalog/view/theme/' . $this->config->get('config_template') . '/template/module/slideshow/';

		}else{

			$data['path'] = 'catalog/view/theme/default/template/module/slideshow/';

		}

		if ($this->request->server['HTTPS']) {

			$server = $this->config->get('config_ssl');

		} else {

			$server = $this->config->get('config_url');

		}
		
		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {

			$data['logo'] = $server . 'image/' . $this->config->get('config_logo');

		} else {

			$data['logo'] = '';

		}

		if (isset($this->session->data['booking_success'])) {
			$data['booking_success'] = $this->session->data['booking_success'];
		} else {
			$data['booking_success'] = null;
		}
		$this->session->data['booking_success'] = null;

		$this->document->addStyle('catalog/view/theme/default/stylesheet/owl.carousel.css');

		$this->document->addScript('catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js');

		$this->document->addStyle($data['path'].'css/camera.css');

		$this->document->addScript($data['path'].'scripts/jquery.mobile.customized.min.js');

		$this->document->addScript($data['path'].'scripts/jquery.easing.1.3.js');

		$this->document->addScript($data['path'].'scripts/camera.js');

		

		

		$data['width'] = $setting['width'];

		$data['mode'] = $setting['mode'];

		$data['height'] = $setting['height'];

		$data['effect'] = $setting['effect'];

		$data['thumbnail'] = $setting['thumbnail'];

		$data['loader'] = $setting['loader'];

		$data['bar_position'] = $setting['bar_position'];

		$data['hover'] = $setting['hover'];

		$data['time'] = $setting['time'];

		$data['navigation_hover'] = $setting['navigation_hover'];

		$data['pagination'] = $setting['pagination'];

		$data['skin'] = $setting['skin'];
		$data['countries_di'] = $this->getCountryFrom();
		$data['countries_den'] = $this->getCountryTo();


		$data['banners'] = array();

		foreach ($setting['banners'] as $banner) {

			if (is_file(DIR_IMAGE . $banner['image'])) {

				$data['banners'][] = array(

					'image' => 'image/'.$banner['image'],

					// $this->model_tool_image->resize($banner['image'], $setting['width'], $setting['height']),

					'thumb' => $this->model_tool_image->resize($banner['image'], 200, 100),

					'video' => $this->getEmbedVideo($banner['video']),

					'link'  => $banner['link'],

					'html'  => html_entity_decode($banner['html'][$this->config->get('config_language_id')]),

					'html_effect'  => $banner['html_effect']

				);

			}

		}

		

		$data['module'] = $module++;



		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/slideshow.tpl')) {

			return $this->load->view($this->config->get('config_template') . '/template/module/slideshow.tpl', $data);

		} else {

			return $this->load->view('default/template/module/slideshow.tpl', $data);

		}

	}

	public function getProductDateHour(){
		$this->load->model('catalog/product');
		$this->load->model('localisation/zone');
		$products = $this->model_catalog_product->getProductByFilter($this->request->post);
		$zone = $this->model_localisation_zone->getZones();
		$data = array();
		if(!empty($products)){
			foreach($products as $product){
				$data[] = array(
					'hour_product' => !empty($product['hour_product'])?date('H:i',strtotime($product['hour_product'])):'--:--',
					'date_product' => !empty($product['date_product'])?$product['date_product']:'',
					'price' => !empty($product['price'])?VndDot($product['price']).' VNĐ':0,
					'price_val' => !empty($product['price'])?$product['price']:0,
					'type_car' => $product['type_car'],
					'product_id' => $product['product_id'],
					'seat' => $product['seat'],
					'diem_di' => $zone[$product['sku']],
					'diem_den' => $zone[$product['upc']],
				);
			}
		}else{
			$data['err'] = 1;
		}
		if (isset($this->request->server['HTTP_ORIGIN'])) {
			$this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);
			$this->response->addHeader('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
			$this->response->addHeader('Access-Control-Max-Age: 1000');
			$this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($data));
	}

	private function getEmbedVideo($link){

		if($link){

			if(strpos($link, 'youtube.com') !== false || strpos($link, 'youtu.be') !== false){

				preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $link, $matches);

				

				$html = '<iframe src="https://www.youtube.com/embed/'.$matches[1].'" width="100%" height="100%" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';

				

				return $html;

			}

		}else{

			return '';

		}

	}

	public function getCountryFrom(){
		$sql = "SELECT * FROM `".DB_PREFIX."country` WHERE status = 1";
		$countries = $this->db->query($sql)->rows;
		$country_arr  = array();
		foreach($countries as $country){
			$zones = $this->getZoneFrom($country['country_id']);
			$country_arr[] = array(
				'country_id' => $country['country_id'],
				'name' => $country['name'],
				'zones' => $zones
			);
		}
		return $country_arr;
	}
	public function getCountryTo(){
		$sql = "SELECT * FROM `".DB_PREFIX."country` WHERE status = 1";
		$countries = $this->db->query($sql)->rows;
		$country_arr  = array();
		foreach($countries as $country){
			$zones = $this->getZoneTo($country['country_id']);
			$country_arr[] = array(
				'country_id' => $country['country_id'],
				'name' => $country['name'],
				'zones' => $zones
			);
		}
		return $country_arr;
	}
	public function getZoneFrom($country_id){
		$sql = "SELECT * FROM `".DB_PREFIX."zone` WHERE status = 1 AND country_id='".$country_id."'";
		$zones = $this->db->query($sql)->rows;
		$sql2 = "SELECT `sku` FROM `".DB_PREFIX."product` WHERE status = 1 GROUP BY sku";
		$skus = $this->db->query($sql2)->rows;
		$country_arr  = array();
		foreach($zones as $zone){
			foreach($skus as $sku){
				if($zone['zone_id'] == $sku['sku']){
					$country_arr[] = array(
						'zone_id' => $zone['zone_id'],
						'name' => $zone['name'],
						'address' => '',
					);
				}
			}
		}
		return $country_arr;
	}
	public function getZoneTo($country_id){
		$sql = "SELECT * FROM `".DB_PREFIX."zone` WHERE status = 1 AND country_id='".$country_id."'";
		$zones = $this->db->query($sql)->rows;
		$sql2 = "SELECT `upc` FROM `".DB_PREFIX."product` WHERE status = 1 GROUP BY upc";
		$upcs = $this->db->query($sql2)->rows;	
		$country_arr  = array();
		foreach($zones as $zone){
			foreach($upcs as $upc){
				if($zone['zone_id'] == $upc['upc']){
					$country_arr[] = array(
						'zone_id' => $zone['zone_id'],
						'name' => $zone['name'],
						'address' => '',
					);
				}
			}
		}
		return $country_arr;
	}
	public function addBooking(){
		$data_post = $this->request->post;
		$check_booking = $this->bookingSQL($data_post);
		if($check_booking){
			$this->load->model('catalog/product');
			$product_info = $this->model_catalog_product->getProduct($data_post['id_pro']);
			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
			$html = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">';
			$html .= '<html>';
			$html .= '<head>';
			$html .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
			$html .= '<title><?php echo $title; ?></title>';
			$html .= '</head>';
			$html .= '<body>';
			$html .= '<div>';
			$html .='<p><b>THÔNG TIN KHÁCH HÀNG</b></p>';
			$html .= '</div>';
			$html .= '<div>';
			$html .= '<label>Chuyến đi: </label>' . $product_info['name'];
			$html .= '</div>';
			$html .= '<div>';
			$html .= '<label>Tên khách hàng: </label>' . $data_post['your_user'];
			$html .= '</div>';
			$html .= '<div>';
			$html .= '<label>Số điện thoại: </label>' . $data_post['phone_user'];
			$html .= '</div>';
			$html .= '<div>';
			$html .= '<label>Ngày đi: </label>' . $data_post['phone_user'];
			$html .= '</div>';
			$html .= '<div>';
			$html .= '<label>Ghế ngồi: </label>' . $data_post['tickets'];
			$html .= '</div>';
			$html .= '<div>';
			$html .= '<label>Tổng tiền: </label>' . $data_post['total_price'];
			$html .= '</div>';
			$html .= '<div>';
			$html .= '<label>Link chi tiết: </label>'.'<a href="https://ngocphuocexpress.com/quantri/index.php?route=catalog/booking/edit&id_booking='.$check_booking.'" >Xem ngay</a>';
			$html .= '</div>';
			$html .= '</body>';
			$html .= '</html>';
			$text = 'Thông tin đặt vé xe của khách hàng';

			$mail->setTo($this->config->get('config_email'));

			$mail->setFrom($this->config->get('config_email'));

			$mail->setSender(html_entity_decode('THÔNG TIN ĐẶT VÉ XE CỦA KHÁCH HÀNG', ENT_QUOTES, 'UTF-8'));

			$mail->setSubject(html_entity_decode('THÔNG TIN ĐẶT VÉ XE CỦA KHÁCH HÀNG', ENT_QUOTES, 'UTF-8'));

			$mail->setHtml($html);

			$mail->setText($text);

			$mail->send();
		}
		$json = array();
		$this->session->data['booking_success'] = 1;
		
		$json['status'] = 1;
		if (isset($this->request->server['HTTP_ORIGIN'])) {
			$this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);
			$this->response->addHeader('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
			$this->response->addHeader('Access-Control-Max-Age: 1000');
			$this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}

