<?php
class ControllerModuleInformation extends Controller {
	public function index() {
		$this->load->language('module/information');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_contact'] = $this->language->get('text_contact');
		$data['text_sitemap'] = $this->language->get('text_sitemap');

		$this->load->model('catalog/information');

		$data['informations'] = array();

		foreach ($this->model_catalog_information->getInformations() as $result) {
			$data['informations'][] = array(
				'title' => $result['title'],
				'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
			);
		}
		$this->load->model('catalog/category');
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

		$data['contact'] = $this->url->link('information/contact');
		$data['sitemap'] = $this->url->link('information/sitemap');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/information.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/information.tpl', $data);
		} else {
			return $this->load->view('default/template/module/information.tpl', $data);
		}
	}
}