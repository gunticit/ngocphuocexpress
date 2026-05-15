<?php

class ControllerModuleLatest extends Controller {

	public function index($setting) {

		$this->load->language('module/latest');



		// $this->document->addStyle('catalog/view/theme/default/stylesheet/owl.carousel.css');

		$this->document->addStyle('catalog/view/javascript/slick/slick.css');
		$this->document->addScript('catalog/view/javascript/slick/slick.js');

		

		$data['heading_title'] = $setting['name'];



		$data['text_tax'] = $this->language->get('text_tax');



		$data['button_cart'] = $this->language->get('button_cart');

		$data['button_wishlist'] = $this->language->get('button_wishlist');

		$data['button_compare'] = $this->language->get('button_compare');
		$data['text_price'] = $this->language->get('text_price');
		$data['owner'] = $this->config->get('config_owner');


		$this->load->model('catalog/product');



		$this->load->model('tool/image');

		$data['module'] = $setting;

		if (!isset($this->request->get['route']) || isset($this->request->get['route']) && $this->request->get['route'] == 'common/home') {
			$data['homepage'] = true;
		}else{
			$data['homepage'] = '';
		}
		$data['products'] = array();



		$filter_data = array(

			'sort'  => 'p.date_added',

			'order' => 'DESC',

			'start' => 0,

			'limit' => $setting['limit']

		);







		$results = $this->model_catalog_product->getProducts($filter_data);

		$address_name = $this->getAddressNames();

		if ($results) {

			$data['banner_left'] = $setting['banner_left'];

			$data['banner_right'] = $setting['banner_right'];

			$data['banner_bottom1'] = $setting['banner_bottom1'];

			$data['banner_bottom2'] = $setting['banner_bottom2'];

			

			if (!empty($setting['banner_left']['image'])) {

				$data['banner_left']['thumb'] = $this->model_tool_image->resize($setting['banner_left']['image'], $setting['banner_left']['width'], $setting['banner_left']['height']);

			}

			

			if (!empty($setting['banner_right']['image'])) {

				$data['banner_right']['thumb'] = $this->model_tool_image->resize($setting['banner_right']['image'], $setting['banner_right']['width'], $setting['banner_right']['height']);

			}

			

			if (!empty($setting['banner_bottom1']['image'])) {

				$data['banner_bottom1']['thumb'] = $this->model_tool_image->resize($setting['banner_bottom1']['image'], $setting['banner_bottom1']['width'], $setting['banner_bottom1']['height']);

			}

			

			if (!empty($setting['banner_bottom2']['image'])) {

				$data['banner_bottom2']['thumb'] = $this->model_tool_image->resize($setting['banner_bottom2']['image'], $setting['banner_bottom2']['width'], $setting['banner_bottom2']['height']);

			}

			

			foreach ($results as $result) {

				if ($result['image']) {

					$image = 'image/'.$result['image'];

					// $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height']);

				} else {

					$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);

				}



				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {

					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));

				} else {

					$price = false;

				}



				if ((float)$result['special']) {

					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));

				} else {

					$special = false;

				}



				if ($this->config->get('config_tax')) {

					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);

				} else {

					$tax = false;

				}



				if ($this->config->get('config_review_status')) {

					$rating = $result['rating'];

				} else {

					$rating = false;

				}



				$data['products'][] = array(

					'product_id'  => $result['product_id'],

					'thumb'       => $image,

					'name'        => $result['name'],
					'location'        => $result['location'],
					'sku'        => !empty($address_name[$result['sku']])?$address_name[$result['sku']]:'',
					'mpn'        => $result['mpn'],
					'upc'        => !empty($address_name[$result['upc']])?$address_name[$result['upc']]:'',
					'viewed'        => $result['viewed'],

					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',

					'price'       => $price,

					'special'     => $special,

					'tax'         => $tax,

					'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,

					'rating'      => $rating,

					'href'    	 => $this->url->link('product/product', 'product_id=' . $result['product_id']),

					'saving' => $result['price'] == 0 ? 100 : round((($result['price'] - $result['special'])/$result['price'])*100, 0)

				);

			}



			$this->load->model('catalog/category');

			$data['description_about'] = html_entity_decode($this->config->get('config_about_us'));

			$data['categories'] = array();

			$categories = $this->model_catalog_category->getCategories(0);

			foreach ($categories as $category) {

				if ($category) {

					$children_data = array();

					

					$children = $this->model_catalog_category->getCategories($category['category_id']);

					

					foreach($children as $child) {

						$children_lv1_data = array();

						

						$children_lv1 = $this->model_catalog_category->getCategories($child['category_id']);

						

						foreach ($children_lv1  as $child_lv1) {

							$filter_data = array('filter_category_id' => $child_lv1['category_id'], 'filter_sub_category' => true);

							

							$children_lv1_data[] = array(

								'category_id' => $child_lv1['category_id'],

								'name' => $child_lv1['name'],

								'image' => $child_lv1['image'],

								'meta_description'        => $child_lv1['meta_description'],

								'href' => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'] . '_' . $child_lv1['category_id'])

							);

						}

						

						$filter_data = array('filter_category_id' => $child['category_id'], 'filter_sub_category' => true);

						

						$children_data[] = array(

							'category_id' => $child['category_id'],

							'image' => $child['image'],

							'name' => $child['name'],

							'meta_description'        => $child['meta_description'],

							'children'    => $children_lv1_data,

							'href' => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])

						);

					}

					

					$filter_data = array(

						'filter_category_id'  => $category['category_id'],

						'filter_sub_category' => true

					);

					

					$data['categories'][] = array(

						'category_id' => $category['category_id'],

						'name'        => $category['name'],

						'image'        => $category['image'],

						'meta_description'        => $category['meta_description'],

						'children'    => $children_data,

						'href'        => $this->url->link('product/category', 'path=' . $category['category_id'])

					);

				}

			}

			

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/product_item.tpl')) {

				$data['product_item'] = DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/product_item.tpl';

			} else {

				$data['product_item'] = DIR_TEMPLATE . 'default/template/product/product_item.tpl';

			}



			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/latest.tpl')) {

				return $this->load->view($this->config->get('config_template') . '/template/module/latest.tpl', $data);

			} else {

				return $this->load->view('default/template/module/latest.tpl', $data);

			}

		}

	}

	public function getAddressNames(){
		$sql = "SELECT * FROM `".DB_PREFIX."zone`";
		$query = $this->db->query($sql);
		$data = array();
		foreach($query->rows as $zone){
			$data[$zone['zone_id']] = $zone['name'];
		}
		return $data;
	}

}

