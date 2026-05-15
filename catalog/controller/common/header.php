<?php

class ControllerCommonHeader extends Controller {

	public function index() {

		

		$this->load->language('common/header');

		$this->load->model('design/block');

		$this->load->model('design/layout');

		

		if (isset($this->request->get['route'])) {

			$route = (string)$this->request->get['route'];

		} else {

			$route = 'common/home';

		}

 

		$data['layout_id'] = 0;



		if ($route == 'product/category' && isset($this->request->get['path'])) {

			$this->load->model('catalog/category');



			$path = explode('_', (string)$this->request->get['path']);



			$data['layout_id'] = $this->model_catalog_category->getCategoryLayoutId(end($path));

		} else if ($route == 'product/product' && isset($this->request->get['product_id'])) {

			$this->load->model('catalog/product');



			$data['layout_id'] = $this->model_catalog_product->getProductLayoutId($this->request->get['product_id']);

		} else if ($route == 'information/information' && isset($this->request->get['information_id'])) {

			$this->load->model('catalog/information');



			$data['layout_id'] = $this->model_catalog_information->getInformationLayoutId($this->request->get['information_id']);

		}



		if (!$data['layout_id']) {

			$data['layout_id'] = $this->model_design_layout->getLayout($route);

		}



		if (!$data['layout_id']) {

			$data['layout_id'] = $this->config->get('config_layout_id');

		}

		

		// Analytics

		$this->load->model('extension/extension');



		$data['analytics'] = array();



		$analytics = $this->model_extension_extension->getExtensions('analytics');



		foreach ($analytics as $analytic) {

			if ($this->config->get($analytic['code'] . '_status')) {

				$data['analytics'][] = $this->load->controller('analytics/' . $analytic['code']);

			}

		}



		if ($this->request->server['HTTPS']) {

			$server = $this->config->get('config_ssl');

		} else {

			$server = $this->config->get('config_url');

		}



		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {

			$this->document->addLink($server . 'image/' . $this->config->get('config_icon'), 'icon');

		}

		

		$data['header_top'] = $this->load->controller('common/header_top');

		$data['header_bottom'] = $this->load->controller('common/header_bottom');

		

		// Navigation

		$language_id = (int)$this->config->get('config_language_id');

		

		$this->load->model('design/navigation');

		

		$navigations = $this->model_design_navigation->getNavigations();

		

		$data['navigations'] = array();

		

		foreach ($navigations as $navigation){

			$children_data = array();

			

			$childrens = $this->model_design_navigation->getNavigations((int)$navigation['id']);

			

			foreach($childrens as $children){

				$children_data[] = array(

				  'navigation_id' => $children['id'],

				  'title' => isset($children['title'][$language_id]) ? html_entity_decode($children['title'][$language_id]) : '',

				  'url' => $children['url'],

				  'icon' => $children['icon']

				);

			}

			

			$data['navigations'][] = array(

			  'navigation_id' => $navigation['id'],

			  'title' => isset($navigation['title'][$language_id]) ? html_entity_decode($navigation['title'][$language_id]) : '',

			  'url' => $navigation['url'],

			  'icon' => $navigation['icon'],

			  'children' => $children_data

			);

		}

		 $categories = $this->model_catalog_category->getCategories(0);

		 $data['categories'] = array();



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

							'icon' => 'image/'.$child_lv1['icon'],

					'top'        => $child_lv1['top'],

							'href' => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'] . '_' . $child_lv1['category_id'])

						);

					}

					

					$filter_data = array('filter_category_id' => $child['category_id'], 'filter_sub_category' => true);

	

					$children_data[] = array(

						'category_id' => $child['category_id'],

						'name' => $child['name'],

					'top'        => $child['top'],

					'icon'        => 'image/'.$child['icon'],

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

					'top'        => $category['top'],

					'icon'        => 'image/'.$category['icon'],

					'name'        => $category['name'],

					'children'    => $children_data,

					'href'        => $this->url->link('product/category', 'path=' . $category['category_id'])

				);

			}

		}



		// Menu

		$data['megamenu'] = $this->load->controller('common/megamenu');
		$data['megamenumobile'] = $this->load->controller('common/megamenumobile');


		if (!isset($this->request->get['route']) || isset($this->request->get['route']) && $this->request->get['route'] == 'common/home') {
			$data['title'] = $this->config->get('config_name');
		} else{
			$data['title'] = $this->document->getTitle();
		}
		



		$data['base'] = $server;

		$data['uri'] = html_entity_decode($server . $this->request->server['REQUEST_URI']);

		$data['description'] = $this->document->getDescription();

		$data['keywords'] = $this->document->getKeywords();

		$data['image'] = $this->document->getImage();

		$data['links'] = $this->document->getLinks();

		$data['styles'] = $this->document->getStyles();

		$data['scripts'] = $this->document->getScripts();

		$data['lang'] = $this->language->get('code');

		$data['direction'] = $this->language->get('direction');
		$data['text_mnbtn'] = $this->language->get('text_mnbtn');



		$data['name'] = $this->config->get('config_name');

		$data['address'] = $this->config->get('config_address');

		$data['telephone'] = $this->config->get('config_telephone');

		$data['email'] = $this->config->get('config_email');

		$data['oclock'] = $this->config->get('config_open');

		$data['name_store'] = $this->config->get('config_owner');

		$data['slogan'] = html_entity_decode($this->config->get('config_welcome'));



		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {

			$data['logo'] = $server . 'image/' . $this->config->get('config_logo');

		} else {

			$data['logo'] = '';

		}




 
		$data['text_home'] = $this->language->get('text_home');



		// Wishlist

		if ($this->customer->isLogged()) {

			$this->load->model('account/wishlist');



			$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), $this->model_account_wishlist->getTotalWishlist());

		} else {

			$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));

		}



		$data['text_shopping_cart'] = $this->language->get('text_shopping_cart');

		$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', 'SSL'), $this->customer->getFirstName(), $this->url->link('account/logout', '', 'SSL'));



		$data['text_account'] = $this->language->get('text_account');

		$data['text_register'] = $this->language->get('text_register');

		$data['text_login'] = $this->language->get('text_login');

		$data['hotline'] = $this->config->get('config_hotline')[1];
		$data['text_order'] = $this->language->get('text_order');

		$data['text_transaction'] = $this->language->get('text_transaction');

		$data['text_download'] = $this->language->get('text_download');

		$data['text_logout'] = $this->language->get('text_logout');
		$data['text_search'] = $this->language->get('text_search');

		$data['text_checkout'] = $this->language->get('text_checkout');

		$data['text_category'] = $this->language->get('text_category');

		$data['text_all'] = $this->language->get('text_all');



		$data['home'] = $this->url->link('common/home');

		$data['wishlist'] = $this->url->link('account/wishlist', '', 'SSL');

		$data['logged'] = $this->customer->isLogged();

		$data['account'] = $this->url->link('account/account', '', 'SSL');

		$data['register'] = $this->url->link('account/register', '', 'SSL');

		$data['login'] = $this->url->link('account/login', '', 'SSL');

		$data['order'] = $this->url->link('account/order', '', 'SSL');

		$data['transaction'] = $this->url->link('account/transaction', '', 'SSL');

		$data['download'] = $this->url->link('account/download', '', 'SSL');

		$data['logout'] = $this->url->link('account/logout', '', 'SSL');

		$data['shopping_cart'] = $this->url->link('checkout/cart');

		$data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');

		$data['contact'] = $this->url->link('information/contact');

		$data['telephone'] = $this->config->get('config_telephone');

		$data['tumblr'] = $this->config->get('config_community_tumblr');

		$data['facebook'] = $this->config->get('config_community_facebook');

		$data['google'] = $this->config->get('config_community_google');

		$data['youtube'] = $this->config->get('config_community_youtube');

		$data['twitter'] = $this->config->get('config_community_twitter');

		$data['pinterest'] = $this->config->get('config_community_pinterest');

		$data['instagram'] = $this->config->get('config_community_instagram');



		$status = true;



		if (isset($this->request->server['HTTP_USER_AGENT'])) {

			$robots = explode("\n", str_replace(array("\r\n", "\r"), "\n", trim($this->config->get('config_robots'))));



			foreach ($robots as $robot) {

				if ($robot && strpos($this->request->server['HTTP_USER_AGENT'], trim($robot)) !== false) {

					$status = false;



					break;

				}

			}

		}



		$data['language'] = $this->load->controller('common/language');

		$data['currency'] = $this->load->controller('common/currency');

		$data['search'] = $this->load->controller('common/search');

		$data['cart'] = $this->load->controller('common/cart');



		// For page specific css

		if (isset($this->request->get['route'])) {

			if (isset($this->request->get['product_id'])) {

				$class = '-' . $this->request->get['product_id'];

			} elseif (isset($this->request->get['path'])) {

				$class = '-' . $this->request->get['path'];

			} elseif (isset($this->request->get['manufacturer_id'])) {

				$class = '-' . $this->request->get['manufacturer_id'];

			} else {

				$class = '';

			}



			$data['class'] = str_replace('/', '-', $this->request->get['route']) . $class;

		} else {

			$data['class'] = 'common-home';

		}

		

		$data['welcome'] = $this->config->get('config_welcome');



		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/header.tpl')) {

			return $this->load->view($this->config->get('config_template') . '/template/common/header.tpl', $data);

		} else {

			return $this->load->view('default/template/common/header.tpl', $data);

		}

	}

}

