<?php
class ControllerModuleCategory extends Controller {
	public function index() {
		$this->load->language('module/category');
		$this->load->model('catalog/product');
		$this->load->model('tool/image');

		$data['heading_title'] = $this->language->get('heading_title');

		if (isset($this->request->get['path'])) {
			$parts = explode('_', (string)$this->request->get['path']);
		} else {
			$parts = array();
		}

		if (isset($parts[0])) {
			$data['category_id'] = $parts[0];
		} else {
			$data['category_id'] = 0;
		}

		if (isset($parts[1])) {
			$data['child_id'] = $parts[1];
		} else {
			$data['child_id'] = 0;
		}

		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$data['categories'] = array();
		$data['telephone'] = $this->config->get('config_telephone');
		$data['email'] = $this->config->get('config_email');
		
		$categories = array();
		// if (is_array($this->config->get('category_category'))) {
		// 	foreach ($this->config->get('category_category') as $category_id) {
		// 		$categories[] = $this->model_catalog_category->getCategory($category_id);
		// 	}
		// }else{
		$categories = $this->model_catalog_category->getCategories(0);
		// }
		
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
							'href' => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'] . '_' . $child_lv1['category_id'])
						);
					}
					
					$filter_data = array('filter_category_id' => $child['category_id'], 'filter_sub_category' => true);

					$children_data[] = array(
						'category_id' => $child['category_id'],
						'name' => $child['name'],
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
					'children'    => $children_data,
					'href'        => $this->url->link('product/category', 'path=' . $category['category_id'])
				);
			}
		}

		if (!isset($this->request->get['route']) || isset($this->request->get['route']) && $this->request->get['route'] == 'common/home') {
			$data['homepage'] = true;
			$data['categorie_homes'] = array();
			$categorie_homes = $this->model_catalog_category->getCategories(0);
			$child_cates = array();
			foreach ($categorie_homes as $category) {
				
				$child_cate = $this->model_catalog_category->getCategories($category['category_id']);
				if(isset($child_cate) && $child_cate != null && $child_cate != ''){
					foreach($child_cate as $children){
						$filter_data = array(
							'filter_category_id'  => $children['category_id'],
							'filter_sub_category' => true
						);
						$filter_prod = array(
							'filter_category_id' => $children['category_id'],
							'filter_sub_category' => true,
							'start'              => 0,
							'limit'              => 8
						);
						$product_cates = array();
						$result_pros = $this->model_catalog_product->getProducts($filter_prod);
						$product_total = $this->model_catalog_product->getTotalProducts($filter_data);
						if($product_total > 8){
							$data['show_more_pro'] = true;
						}
						foreach ($result_pros as $result) { 
							if($result){
								if ($result['image']) {
									$image = 'image/'.$result['image'];
								} else {
									$image = $this->model_tool_image->resize('placeholder.png', 330, 250);
								}

								if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
									$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
								} else {
									$price = false;
								}

								if ((float)$result['special']) {
									$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
								} else {
									$special = false;
								}

								if ($this->config->get('config_tax')) {
									$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price'], $this->session->data['currency']);
								} else {
									$tax = false;
								}

								if ($this->config->get('config_review_status')) {
									$rating = (int)$result['rating'];
								} else {
									$rating = false;
								}

								$product_cates[] = array(
									'product_id'  => $result['product_id'],
									'thumb'       => $image,
									'name'        => $result['name'],
									'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
									'price'       => $price,
									'special'     => $special,
									'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
									'tax'         => $tax,
									'rating'      => $rating,
									'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'])
								);
							}
						}
						$data['child_cate_true'] = true;
						$data['categorie_homes'][] = array(
							'category_id' => $children['category_id'],
							'name'        => $children['name'],
							'children_cates'        => true,
							'products'        => $product_cates,
							'href'        => $this->url->link('product/category', 'path=' . $children['category_id'])
						);
					}
				}else{
					$filter_data = array(
						'filter_category_id'  => $category['category_id'],
						'filter_sub_category' => true
					);
					$filter_prod = array(
						'filter_category_id' => $category['category_id'],
						'filter_sub_category' => true,
						'start'              => 0,
						'limit'              => 8
					);
					$product_cates = array();
					$result_pros = $this->model_catalog_product->getProducts($filter_prod);
					$product_total = $this->model_catalog_product->getTotalProducts($filter_data);
					if($product_total > 8){
						$data['show_more_pro'] = true;
					}
					foreach ($result_pros as $result) {
						if($result){
							if ($result['image']) {
								$image = 'image/'.$result['image'];
							} else {
								$image = $this->model_tool_image->resize('placeholder.png', 330, 250);
							}

							if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
								$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
							} else {
								$price = false;
							}

							if ((float)$result['special']) {
								$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
							} else {
								$special = false;
							}

							if ($this->config->get('config_tax')) {
								$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price'], $this->session->data['currency']);
							} else {
								$tax = false;
							}

							if ($this->config->get('config_review_status')) {
								$rating = (int)$result['rating'];
							} else {
								$rating = false;
							}

							$product_cates[] = array(
								'product_id'  => $result['product_id'],
								'thumb'       => $image,
								'name'        => $result['name'],
								'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
								'price'       => $price,
								'special'     => $special,
								'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
								'tax'         => $tax,
								'rating'      => $rating,
								'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'])
							);
						}
					}
					$data['child_cate_true'] = false;
					$data['categorie_homes'][] = array(
						'category_id' => $category['category_id'],
						'name'        => $category['name'],
						'products'        => $product_cates,
						'href'        => $this->url->link('product/category', 'path=' . $category['category_id'])
					);
				}
			}
		}
		
		$data['column'] = (int)$this->config->get('category_column');
		$data['class'] = 'col-sm-' . (12/$data['column']);

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/product_item.tpl')) {
			$data['product_item'] = DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/product_item.tpl';
		} else {
			$data['product_item'] = DIR_TEMPLATE . 'default/template/product/product_item.tpl';
		}
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/category.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/category.tpl', $data);
		} else {
			return $this->load->view('default/template/module/category.tpl', $data);
		}
	}
}