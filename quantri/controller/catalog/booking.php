<?php
class ControllerCatalogBooking extends Controller {
	public function index() {
		$this->language->load('catalog/booking');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/booking');

		$this->getList();
	}

	protected function getList() {
		$data['breadcrumbs'] = array();
		$url = '';
		if (isset($this->request->get['filter_date'])) {
			$filter_date = $this->request->get['filter_date'];
		} else {
			$filter_date = null;
		}
		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('Booking'),
			'href' => $this->url->link('catalog/booking', 'token=' . $this->session->data['token'], 'SSL')
		);

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'date_booking';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['bookings'] = array();

		$filter_data = array(
			'filter_date'   => $filter_date,
			'filter_status'   => $filter_status,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'           => $this->config->get('config_limit_admin')
		);

		$this->load->model('tool/image');

		$booking_total = $this->model_catalog_booking->getTotalBookings($filter_data);

		$results = $this->model_catalog_booking->getBookings($filter_data);
		
		foreach ($results as $result) {
			$data['bookings'][] = array(
				'id_booking' => $result['id_booking'],
				'id_pro' => $result['id_pro'],
				'link_pro' => $this->url->link('catalog/product/edit', 'token=' . $this->session->data['token'] . '&product_id=' . $result['id_pro'] . $url, 'SSL'),
				'date_booking' => $result['date_booking'],
				'name_booking' => $result['name_booking'],
				'phone_booking' => $result['phone_booking'],
				'seat_booking' => $result['seat_booking'],
				'price_booking' => $result['price_booking'],
				'address_booking' => $result['address_booking'],

				'status'     => $result['status'],
				'edit'       => $this->url->link('catalog/booking/edit', 'token=' . $this->session->data['token'] . '&id_booking=' . $result['id_booking'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('Booking');

		$data['text_list'] = $this->language->get('Danh sách đặt vé');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_image'] = $this->language->get('column_image');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_model'] = $this->language->get('column_model');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_action'] = $this->language->get('column_action');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_model'] = $this->language->get('entry_model');
		$data['entry_price'] = $this->language->get('entry_price');
		$data['entry_quantity'] = $this->language->get('entry_quantity');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_copy'] = $this->language->get('button_copy');
		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');

		$data['token'] = $this->session->data['token'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if (isset($this->request->get['filter_date'])) {
			$url .= '&filter_date=' . $this->request->get['filter_date'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_date'] = $this->url->link('catalog/booking', 'token=' . $this->session->data['token'] . '&sort=date_booking' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('catalog/booking', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');
		$data['sort_order'] = $this->url->link('catalog/booking', 'token=' . $this->session->data['token'] . '&sort=p.sort_order' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_date'])) {
			$url .= '&filter_date=' . $this->request->get['filter_date'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$data['column_action'] = 'Chi chú';
		$pagination = new Pagination();
		$pagination->total = $booking_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('catalog/booking', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($booking_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($booking_total - $this->config->get('config_limit_admin'))) ? $booking_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $booking_total, ceil($booking_total / $this->config->get('config_limit_admin')));

		$data['filter_date'] = $filter_date;
		$data['filter_status'] = $filter_status;

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/booking_list.tpl', $data));
	}
	public function edit() {
		$this->language->load('catalog/booking');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/booking');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_booking->editBooking($this->request->get['id_booking'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}

			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/booking', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}
	protected function getForm() {

		$data['heading_title'] = $this->language->get('Booking');

		$data['help_keyword'] = $this->language->get('help_keyword');
		$data['help_sku'] = $this->language->get('help_sku');
		$data['help_upc'] = $this->language->get('help_upc');
		$data['help_ean'] = $this->language->get('help_ean');
		$data['help_jan'] = $this->language->get('help_jan');
		$data['help_isbn'] = $this->language->get('help_isbn');
		$data['help_mpn'] = $this->language->get('help_mpn');
		$data['help_minimum'] = $this->language->get('help_minimum');
		$data['help_manufacturer'] = $this->language->get('help_manufacturer');
		$data['help_stock_status'] = $this->language->get('help_stock_status');
		$data['help_points'] = $this->language->get('help_points');
		$data['help_category'] = $this->language->get('help_category');
		$data['help_filter'] = $this->language->get('help_filter');
		$data['help_download'] = $this->language->get('help_download');
		$data['help_related'] = $this->language->get('help_related');
		$data['help_tag'] = $this->language->get('help_tag');
		$data['tab_general'] = 'Thông tin chung';

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_attribute_add'] = $this->language->get('button_attribute_add');
		$data['button_option_add'] = $this->language->get('button_option_add');
		$data['button_option_value_add'] = $this->language->get('button_option_value_add');
		$data['button_discount_add'] = $this->language->get('button_discount_add');
		$data['button_special_add'] = $this->language->get('button_special_add');
		$data['button_image_add'] = $this->language->get('button_image_add');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_recurring_add'] = $this->language->get('button_recurring_add');
		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}

		if (isset($this->error['meta_title'])) {
			$data['error_meta_title'] = $this->error['meta_title'];
		} else {
			$data['error_meta_title'] = array();
		}

		if (isset($this->error['model'])) {
			$data['error_model'] = $this->error['model'];
		} else {
			$data['error_model'] = '';
		}

		if (isset($this->error['keyword'])) {
			$data['error_keyword'] = $this->error['keyword'];
		} else {
			$data['error_keyword'] = '';
		}

		$url = '';

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/booking', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['id_booking'])) {
			$data['action'] = $this->url->link('catalog/booking/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('catalog/booking/edit', 'token=' . $this->session->data['token'] . '&id_booking=' . $this->request->get['id_booking'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('catalog/booking', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->load->model('catalog/booking');
		if (isset($this->request->get['id_booking']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$data['booking_info'] = $booking_info = $this->model_catalog_booking->getBooking($this->request->get['id_booking']);
			$this->load->model('catalog/product');
			$data['pro_info'] = $this->model_catalog_product->getProduct($booking_info['id_pro']);
		}

		$data['token'] = $this->session->data['token'];
		$data['text_form'] = 'Form Xử lý';


		$this->load->model('design/layout');

		$data['layouts'] = $this->model_design_layout->getLayouts();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/booking_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/booking')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/booking')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_date']) || isset($this->request->get['filter_model'])) {
			$this->load->model('catalog/booking');
			$this->load->model('catalog/option');

			if (isset($this->request->get['filter_date'])) {
				$filter_date = $this->request->get['filter_date'];
			} else {
				$filter_date = '';
			}

			if (isset($this->request->get['filter_status'])) {
				$filter_status = $this->request->get['filter_status'];
			} else {
				$filter_status = '';
			}

			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];
			} else {
				$limit = 5;
			}

			$filter_data = array(
				'filter_date'  => $filter_date,
				'filter_model' => $filter_model,
				'sort'            => $sort,
				'order'           => $order,
				'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
				'limit'           => $this->config->get('config_limit_admin')
			);

			$results = $this->model_catalog_booking->getBookings($filter_data);

			foreach ($results as $result) {
				$option_data = array();

				$booking_options = $this->model_catalog_booking->getBookingOptions($result['id_booking']);

				foreach ($booking_options as $booking_option) {
					$option_info = $this->model_catalog_option->getOption($booking_option['option_id']);

					if ($option_info) {
						$booking_option_value_data = array();

						foreach ($booking_option['booking_option_value'] as $booking_option_value) {
							$option_value_info = $this->model_catalog_option->getOptionValue($booking_option_value['option_value_id']);

							if ($option_value_info) {
								$booking_option_value_data[] = array(
									'booking_option_value_id' => $booking_option_value['booking_option_value_id'],
									'option_value_id'         => $booking_option_value['option_value_id'],
									'name'                    => $option_value_info['name'],
									'price'                   => (float)$booking_option_value['price'] ? $this->currency->format($booking_option_value['price'], $this->config->get('config_currency')) : false,
									'price_prefix'            => $booking_option_value['price_prefix']
								);
							}
						}

						$option_data[] = array(
							'booking_option_id'    => $booking_option['booking_option_id'],
							'booking_option_value' => $booking_option_value_data,
							'option_id'            => $booking_option['option_id'],
							'name'                 => $option_info['name'],
							'type'                 => $option_info['type'],
							'value'                => $booking_option['value'],
							'required'             => $booking_option['required']
						);
					}
				}

				$json[] = array(
					'id_booking' => $result['id_booking'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
					'model'      => $result['model'],
					'option'     => $option_data,
					'price'      => $result['price']
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	public function getCountry(){
		$sql = "SELECT * FROM `".DB_PREFIX."country` WHERE status = 1";
		$countries = $this->db->query($sql)->rows;
		$country_arr  = array();
		foreach($countries as $country){
			$zones = $this->getZone($country['country_id']);
			$country_arr[] = array(
				'country_id' => $country['country_id'],
				'name' => $country['name'],
				'zones' => $zones
			);
		}
		return $country_arr;
	}
	public function getZone($country_id){
		$sql = "SELECT * FROM `".DB_PREFIX."zone` WHERE status = 1 AND country_id='".$country_id."'";
		$zones = $this->db->query($sql)->rows;
		$country_arr  = array();
		foreach($zones as $zone){
			$country_arr[] = array(
				'zone_id' => $zone['zone_id'],
				'name' => $zone['name'],
				'address' => '',
			);
		}
		return $country_arr;
	}
}
