<?php
class ControllerModulethread extends Controller {
	public $settingpost;
	public function __construct($settingpost) {
	parent::__construct($settingpost);
		$this->load->model('setting/settingpost');
		$this->setting=$this->model_setting_settingpost->getSettingPosts(); 
	}
	public function index() {
		$this->load->language('module/thread');

		$data['heading_title'] =$this->setting['head_thread'];
		$data['heading_title_link'] = $this->url->link('route=information/post');
		$data['href_thread']= $this->url->link('information/post');

		if (isset($this->request->get['thread_id'])) {
			$data['thread_id'] = $this->request->get['thread_id'];
		} else {
			$data['thread_id'] = 0;
		}

		$this->load->model('catalog/thread');

		$this->load->model('catalog/post');

		$data['threads'] = array();

		$threads = $this->model_catalog_thread->getthreads(0);

		foreach ($threads as $thread) {
			$children_data = array();

			if ($thread['thread_id'] == $data['thread_id']) {
				$children = $this->model_catalog_thread->getthreads($thread['thread_id']);

				foreach($children as $child) {
					$filter_data = array('filter_thread_id' => $child['thread_id'], 
					'thread_id'=>$child['thread_id'], 
					'filter_sub_thread' => true);

					$children_data[] = array(
						'thread_id' => $child['thread_id'],
						'name' => $child['name'] . ($this->setting['thread_post_count']? ' (' . $this->model_catalog_post->getTotalPostByThreadId($filter_data) . ')' : ''),
						
						'href' => $this->url->link('information/thread', 'thread_id=' . $thread['thread_id'] . '_' . $child['thread_id'])
					);
				}
			}

			$filter_data = array(
				'filter_thread_id'  => $thread['thread_id'],
				'thread_id'=>$thread['thread_id'],
				'filter_sub_thread' => true
			);

			$data['threads'][] = array(
				'thread_id' => $thread['thread_id'],
				'name'        => $thread['name'] . ($this->setting['thread_post_count'] ? ' (' . $this->model_catalog_post->getTotalPostByThreadId($filter_data) . ')' : ''),
				'children'    => $children_data,
				'href'        => $this->url->link('information/thread', 'thread_id=' . $thread['thread_id'])
			
			);
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/thread.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/thread.tpl', $data);
		} else {
			return $this->load->view('default/template/module/thread.tpl', $data);
		}
	}
}