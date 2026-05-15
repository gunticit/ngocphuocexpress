<?php
class ControllerModulepostmostviewd extends Controller {
	public $settingpost;
	public function __construct($settingpost) {
	parent::__construct($settingpost);
		$this->load->model('setting/settingpost');
		$this->setting=$this->model_setting_settingpost->getSettingPosts(); 
	}
	public function index() {
		$this->load->language('module/postmostviewd');

		$data['text_contact'] = $this->language->get('text_contact');
		$data['text_sitemap'] = $this->language->get('text_sitemap');
		$data['text_see_more'] = $this->language->get('text_see_more');
		$data['postmostviewd']='Hello postmostviewd';

		$data['contact'] = $this->url->link('postmostviewd/contact');
		$data['sitemap'] = $this->url->link('postmostviewd/sitemap');
		
		$this->load->model('catalog/post');
		
		$filter_data = array(
			'page' => 1,
			'viewed'=>'DESC',
			'limit' => $this->setting['item_module_post'],
			'start' => 0,
		);
		
		$data['heading_title'] = $this->language->get('heading_title');
		$data['heading_title_link'] = '';
		
		$posts = $this->model_catalog_post->getPosts($filter_data);
	 
		$data['posts'] = array();
		
		$this->load->model('tool/image');
		foreach ($posts as $post) {
			if (is_file(DIR_IMAGE . $post['image'])) {
				$image = $this->model_tool_image->resize($post['image'], $this->setting['image_thumb_width'],$this->setting['image_thumb_height']);
			} else {
				$image = $this->model_tool_image->resize('no_image.png',$this->setting['image_thumb_width'],$this->setting['image_thumb_height']);
			}
			//----------------------get thread_id of postid
			$post_thread = array();
			$post_thread_data = $this->db->query("select cd.thread_id,cd.name from " . DB_PREFIX . "post_to_thread n2c, " . DB_PREFIX . "thread_description cd where n2c.post_id=".$post['post_id']." and n2c.thread_id=cd.thread_id");
			foreach ($post_thread_data->rows as $result){
				$post_thread[]= array(
					'thread_id'	=>$result['thread_id'],
					'name'				=>$result['name'],
					'href'        		=> $this->url->link('product/thread', 'path=' . $result['thread_id'])
				);
			}
			//-----------------------------------
			$data['posts'][] = array (
				'title' 		=> html_entity_decode($post['title'], ENT_QUOTES),
				'image'    		=> $image,
				'threadofpost'		=> $post_thread,
				'short_description' 	=> (strlen(strip_tags(html_entity_decode($post['short_description'], ENT_QUOTES))) > $this->setting['description_limit'] ? substr(strip_tags(html_entity_decode($post['short_description'], ENT_QUOTES)), 0,$this->setting['description_limit']) . '...' : strip_tags(html_entity_decode($post['short_description'], ENT_QUOTES))),
				'href' 			=> $this->url->link('information/post', 'post_id=' . $post['post_id']),
				'date_added' 	=> date($this->language->get('date_format_short'), strtotime($post['date_added']))
			);
		}
		//---------------------------------------------------------------
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/postmostviewd.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/postmostviewd.tpl', $data);
		} else {
			return $this->load->view('default/template/module/postmostviewd.tpl', $data);
		}
	}
}