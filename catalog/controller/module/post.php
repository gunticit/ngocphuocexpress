<?php  

class ControllerModulepost extends Controller {

	public $settingpost;

	public function __construct($settingpost) {

		parent::__construct($settingpost);

		$this->load->model('setting/settingpost');

		$this->setting=$this->model_setting_settingpost->getSettingPosts(); 

	}

	public function index() {

		//---------------- load setting

		$this->language->load('module/post');

		$this->load->model('catalog/post');

		date_default_timezone_set('Asia/Ho_Chi_Minh');

		

		$this->document->addStyle('catalog/view/stylesheet/news.css');

		

		$filter_data = array(
			'page' => 1,
			'limit' => 4,
			'start' => 0,
			'filter_thread_id' => 14
		);



		/*$data['heading_title'] = $this->setting['head_module_post'];*/

		$data['heading_title'] = $this->language->get('heading_title');

		$data['heading_title_link'] =$this->url->link('information/post');

		

		$data['text_see_more'] = $this->language->get('text_see_more');

		$inter_posts = $this->model_catalog_post->getposts($filter_data);


		$filter_data_inter = array(
			'page' => 1,
			'limit' => 4,
			'start' => 0,
			'filter_thread_id' => 15
		);
		$logistics_posts = $this->model_catalog_post->getposts($filter_data_inter);

		$filter_data = array(
			'page' => 1,
			'limit' => 4,
			'start' => 0,
			'filter_thread_id' => 16
		);
		$posts = $this->model_catalog_post->getposts($filter_data);



		if (!isset($this->request->get['route']) || isset($this->request->get['route']) && $this->request->get['route'] == 'common/home') {

			$data['homepage'] = true;

		}else{

			$data['homepage'] = '';

		}


		$data['galleries'] = array();

		$galleries = $this->getGallery(5);

		foreach ($galleries as $key => $gallery) {
			$data['galleries'][] = array(
				'image' => $gallery['image']
			);
		}

		$data['notify_posts'] = array();

		$this->load->model('tool/image');

		$data['notify_posts'] = $this->filterData($posts);

		$data['inter_posts'] = $this->filterData($inter_posts);

		$data['logistics_posts'] = $this->filterData($logistics_posts);

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/post.tpl')) {

			return $this->load->view($this->config->get('config_template') . '/template/module/post.tpl', $data);

		} else {

			return $this->load->view('default/template/module/post.tpl', $data);

		}

	}

	private function filterData(&$posts){
		$data = array();
		foreach ($posts as $post) {

			if (is_file(DIR_IMAGE . $post['image'])) {

				$image = 'image/'.$post['image'];

				// $this->model_tool_image->resize($post['image'], $this->setting['image_thumb_width'],$this->setting['image_thumb_height']);

			} else {

				$image = $this->model_tool_image->resize('no_image.png',$this->setting['image_thumb_width'],$this->setting['image_thumb_height']);

			}



			$getCommentPost = $this->model_catalog_post->getCommentPost($post['post_id']);

			

			$data[] = array (

				'post_id'       => $post['post_id'],

				'title' 		=> html_entity_decode($post['title'], ENT_QUOTES),

				'image'    		=> $image,

				'short_description' 	=> (strlen(strip_tags(html_entity_decode($post['short_description'], ENT_QUOTES))) > $this->setting['description_limit'] ? substr(strip_tags(html_entity_decode($post['short_description'], ENT_QUOTES)), 0,$this->setting['description_limit']) . '...' : strip_tags(html_entity_decode($post['short_description'], ENT_QUOTES))),

				'viewed' 			=> $post['viewed'],

				'href' 			=> $this->url->link('information/post', 'post_id=' . $post['post_id']),

				'date_added' 	=> date($this->language->get('j/n'), strtotime($post['date_added'])),

				'comment' => $getCommentPost,

				'date_available' => $post['date_available']

			);

		}
		return $data;
	}

	function getGallery($gallery_id){
		$sql = "SELECT `image` FROM `".DB_PREFIX."gallery_image` WHERE `gallery_id` ='".$gallery_id."'";
		return $this->db->query($sql)->rows;
	}

}