<?php

class ControllerModulePlgselectthread extends Controller {

	public $settingpost;

	public function __construct($settingpost) {

		parent::__construct($settingpost);

		$this->load->model('setting/settingpost');

		$this->setting=$this->model_setting_settingpost->getSettingPosts(); 

	}

	public function index($setting) {
		$this->load->language('module/plgselectthread');

		$data['children_data']=array();

		if (isset($setting['module_description'][$this->config->get('config_language_id')])) {

			$data['heading_title'] = html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['title'], ENT_QUOTES, 'UTF-8');

			$data['plgselectthread'] = html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['description'], ENT_QUOTES, 'UTF-8');

			$data['thread_id']=$setting['parent_id'];

			$data['width']=$setting['width'];

			$data['height']=$setting['height'];

			$data['showsubthread']=$setting['showsubthread'];

			$data['text_see_more'] = $this->language->get('text_see_more');

			

			//------------------------------------------------ subthread post

			if($setting['showsubthread']){

				$this->load->model('catalog/thread');

				$this->load->model('catalog/post');

				$this->load->model('tool/image');

				$children_data = array();

				

				$children = $this->model_catalog_thread->getThreads($setting);

				

				foreach($children as $child) {

					$posts= array();

					//echo '-----'.$setting['limit'];

					$filter_data=array('thread_id'=>$child['thread_id'],'limit'=>$setting['limit'],'start'=>0);

					$posts = $this->model_catalog_post->getPostByThreadId($filter_data);

					$datapost= array();

					

					foreach ($posts as $post) {

						if (is_file(DIR_IMAGE . $post['image'])) {

							$image = $this->model_tool_image->resize($post['image'], $data['width'],$data['height']);

						} else {

							$image = $this->model_tool_image->resize('no_image.png',$data['width'],$data['height']);

						}

						

						$datapost[] = array (

							'title' 		=> html_entity_decode($post['title'], ENT_QUOTES),

							'image'    		=> $image,

							'short_description' 	=> (strlen(strip_tags(html_entity_decode($post['short_description'], ENT_QUOTES))) > $this->setting['description_limit'] ? substr(strip_tags(html_entity_decode($post['short_description'], ENT_QUOTES)), 0,$this->setting['description_limit']) . '...' : strip_tags(html_entity_decode($post['short_description'], ENT_QUOTES))),

							'href' 			=> $this->url->link('information/post', 'post_id=' . $post['post_id']),

							'date_added' 	=> date($this->language->get('date_format_short'), strtotime($post['date_added']))

						);

					}

					//--------------

					$filter_data = array('filter_thread_id' => $child['thread_id'], 

						'thread_id'=>$child['thread_id'], 

						'filter_sub_thread' => true);

					$data['children_data'][$child['thread_id']] = array(

						'thread_id' => $child['thread_id'],

						'name' => $child['name'] . ($this->setting['thread_post_count']? ' (' . $this->model_catalog_post->getTotalpostBythreadid($filter_data) . ')' : ''),

						'datapost'=> $datapost,

						'href' => $this->url->link('product/thread', 'path=' . $data['thread_id']  . '_' . $child['thread_id'])



					);

				}

			}

			//------------------------------------------------

			$this->load->model('catalog/thread');

			$this->load->model('catalog/post');

			$this->load->model('tool/image');

			$filter_data=array('thread_id'=>$data['thread_id'],'limit'=>$setting['limit'],'start'=>0);

			$posts= array();

			if($data['thread_id']>0)

				$posts = $this->model_catalog_post->getPostByThreadId($filter_data);

			$datapost = array();

			foreach ($posts as $post) {

				if (is_file(DIR_IMAGE . $post['image'])) {

					$image = 'image/'.$post['image'];
					// $this->model_tool_image->resize($post['image'], $data['width'],$data['height']);

				} else {

					$image = $this->model_tool_image->resize('no_image.png',$data['width'],$data['height']);

				}

			$getCommentPost = $this->model_catalog_post->getCommentPost($post['post_id']);
				

				$datapost[] = array (

					'post_id'       => $post['post_id'],

					'title' 		=> html_entity_decode($post['title'], ENT_QUOTES),

					'image'    		=> $image,

					'short_description' 	=> (strlen(strip_tags(html_entity_decode($post['short_description'], ENT_QUOTES))) > $this->setting['description_limit'] ? substr(strip_tags(html_entity_decode($post['short_description'], ENT_QUOTES)), 0,$this->setting['description_limit']) . '...' : strip_tags(html_entity_decode($post['short_description'], ENT_QUOTES))),

					'view' 			=> $this->url->link('information/post', 'post_id=' . $post['post_id']),

					'href' 			=> $this->url->link('information/post', 'post_id=' . $post['post_id']),

					'date_added' 	=> date($this->language->get('j/n'), strtotime($post['date_added'])),

					'comment' => $getCommentPost,

					'date_available' => $post['date_available']

				);

			}

			$data['datapost']=$datapost;

			//------------------------------------------------

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/plgselectthread.tpl')) {

				return $this->load->view($this->config->get('config_template') . '/template/module/plgselectthread.tpl', $data);

			} else {

				return $this->load->view('default/template/module/plgselectthread.tpl', $data);

			}

		}

	}

}