<?php
class ControllerModulepost extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/post');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('post', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		
		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/post', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('module/post', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['post_status'])) {
			$data['post_status'] = $this->request->post['post_status'];
		} else {
			
			$data['post_status'] = $this->config->get('post_status');
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/post.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/post')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
	
	public function install() {
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "downloadpost` (
		  `downloadpost_id` int(11) NOT NULL AUTO_INCREMENT,
		  `filename` varchar(128) NOT NULL,
		  `mask` varchar(128) NOT NULL,
		  `date_added` datetime NOT NULL,
		  `user_id` int(11) NOT NULL,
		  PRIMARY KEY (`downloadpost_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "downloadpost_description` (
		  `downloadpost_id` int(11) NOT NULL,
		  `language_id` int(11) NOT NULL,
		  `name` varchar(64) NOT NULL,
		  PRIMARY KEY (`downloadpost_id`,`language_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
		
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "post` (
		  `post_id` int(11) NOT NULL AUTO_INCREMENT,
		  `image` varchar(255) NOT NULL,
		  `banner` varchar(255) NOT NULL,
		  `date_added` datetime NOT NULL,
		  `date_available` date NOT NULL DEFAULT '0000-00-00',
		  `status` tinyint(1) NOT NULL DEFAULT '0',
		  `sort_order` int(11) NOT NULL DEFAULT '0',
		  `user_id` int(11) NOT NULL DEFAULT '0',
		  `viewed` int(5) NOT NULL DEFAULT '0',
		  PRIMARY KEY (`post_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "post_attribute` (
		  `post_id` int(11) NOT NULL,
		  `attribute_id` int(11) NOT NULL,
		  `language_id` int(11) NOT NULL,
		  `text` text NOT NULL
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "post_description` (
		  `post_description_id` int(11) NOT NULL AUTO_INCREMENT,
		  `post_id` int(11) NOT NULL,
		  `language_id` int(11) NOT NULL,
		  `title` varchar(255) NOT NULL,
		  `meta_keyword` varchar(255) NOT NULL,
		  `description` text NOT NULL,
		  `short_description` text NOT NULL,
		  `tag` varchar(255) NOT NULL,
		  PRIMARY KEY (`post_description_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "post_image` (
		  `post_image_id` int(11) NOT NULL AUTO_INCREMENT,
		  `post_id` int(11) NOT NULL,
		  `image` varchar(255) NOT NULL,
		  `sort_order` int(3) NOT NULL,
		  PRIMARY KEY (`post_image_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
		
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "post_image_description` (
		  `post_image_id` int(11) NOT NULL,
		  `language_id` int(11) NOT NULL,
		  `post_id` int(11) NOT NULL,
		  `title` varchar(255) NOT NULL
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "post_related` (
		  `post_id` int(11) NOT NULL,
		  `related_id` int(11) NOT NULL
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "post_to_thread` (
		  `post_id` int(11) NOT NULL,
		  `thread_id` int(11) NOT NULL
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
		
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "reviewpost` (
		  `reviewpost_id` int(11) NOT NULL AUTO_INCREMENT,
		  `post_id` int(11) NOT NULL,
		  `customer_id` int(11) NOT NULL,
		  `author` varchar(64) NOT NULL,
		  `text` text NOT NULL,
		  `rating` int(1) NOT NULL,
		  `status` tinyint(1) NOT NULL DEFAULT '0',
		  `date_added` datetime NOT NULL,
		  `date_modified` datetime NOT NULL,
		  PRIMARY KEY (`reviewpost_id`),
		  KEY `post_id` (`post_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "settingpost` (
		  `settingpost_id` int(11) NOT NULL AUTO_INCREMENT,
		  `store_id` int(11) NOT NULL DEFAULT '0',
		  `code` varchar(32) NOT NULL,
		  `key` varchar(64) NOT NULL,
		  `value` text NOT NULL,
		  `serialized` tinyint(1) NOT NULL,
		  PRIMARY KEY (`settingpost_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "thread` (
		  `thread_id` int(11) NOT NULL AUTO_INCREMENT,
		  `image` varchar(255) DEFAULT NULL,
		  `parent_id` int(11) NOT NULL DEFAULT '0',
		  `child` tinyint(1) NOT NULL,
		  `format` varchar(16) NOT NULL,
		  `sort_order` int(3) NOT NULL DEFAULT '0',
		  `status` tinyint(1) NOT NULL,
		  `date_added` datetime NOT NULL,
		  `date_modified` datetime NOT NULL,
		  PRIMARY KEY (`thread_id`),
		  KEY `parent_id` (`parent_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "thread_description` (
		  `thread_id` int(11) NOT NULL,
		  `language_id` int(11) NOT NULL,
		  `name` varchar(255) NOT NULL,
		  `description` text NOT NULL,
		  `meta_title` varchar(255) NOT NULL,
		  `meta_description` varchar(255) NOT NULL,
		  `meta_keyword` varchar(255) NOT NULL,
		  PRIMARY KEY (`thread_id`,`language_id`),
		  KEY `name` (`name`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "thread_filter` (
		  `thread_id` int(11) NOT NULL,
		  `filter_id` int(11) NOT NULL,
		  PRIMARY KEY (`thread_id`,`filter_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "thread_path` (
		  `thread_id` int(11) NOT NULL,
		  `path_id` int(11) NOT NULL,
		  `level` int(11) NOT NULL,
		  PRIMARY KEY (`thread_id`,`path_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "thread_to_layout` (
		  `thread_id` int(11) NOT NULL,
		  `store_id` int(11) NOT NULL,
		  `layout_id` int(11) NOT NULL,
		  PRIMARY KEY (`thread_id`,`store_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "thread_to_store` (
		  `thread_id` int(11) NOT NULL,
		  `store_id` int(11) NOT NULL,
		  PRIMARY KEY (`thread_id`,`store_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
		
		$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "user_to_thread` (
		  `user_id` int(11) NOT NULL,
		  `thread_id` int(11) NOT NULL,
		  PRIMARY KEY (`user_id`,`thread_id`),
		  KEY `thread_id` (`thread_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
		

		$this->db->query("ALTER TABLE `" . DB_PREFIX . "user` ADD postpermission int(11) NOT NULL");
		$this->db->query("UPDATE `" . DB_PREFIX . "user` SET `postpermission` ='3' WHERE user_id=1 ");

		$this->db->query("ALTER TABLE `" . DB_PREFIX . "download` ADD user_id int(11) NOT NULL");

		$this->load->model('user/user_group');
		$this->load->model('user/mangeuser');
		$data_usergroup=array(
			'name'			=> 	'Post Group'
		);
		$this->model_user_user_group->addUserGroup($data_usergroup);
		$user_group_id=$this->model_user_mangeuser->getMaxUserGroups();

		$this->model_user_user_group->addPermission($user_group_id, 'access', 'catalog/post');
		$this->model_user_user_group->addPermission($user_group_id, 'modify', 'catalog/post');
		$this->model_user_user_group->addPermission($user_group_id, 'access', 'catalog/downloadpost');
		$this->model_user_user_group->addPermission($user_group_id, 'modify', 'catalog/downloadpost');
		$this->model_user_user_group->addPermission($user_group_id, 'access', 'catalog/thread');
		$this->model_user_user_group->addPermission($user_group_id, 'modify', 'catalog/thread');
		$this->model_user_user_group->addPermission($user_group_id, 'access', 'common/filemanager');
		$this->model_user_user_group->addPermission($user_group_id, 'modify', 'common/filemanager');
		$this->model_user_user_group->addPermission($user_group_id, 'access', 'catalog/reviewpost');
		$this->model_user_user_group->addPermission($user_group_id, 'modify', 'catalog/reviewpost');
		$this->model_user_user_group->addPermission($user_group_id, 'access', 'report/post_viewed');
		$this->model_user_user_group->addPermission($user_group_id, 'modify', 'report/post_viewed');
		$this->model_user_user_group->addPermission($user_group_id, 'access', 'user/mangeuser');
		$this->model_user_user_group->addPermission($user_group_id, 'modify', 'user/mangeuser');
		$this->model_user_user_group->addPermission($user_group_id, 'access', 'setting/settingpost');
		$this->model_user_user_group->addPermission($user_group_id, 'modify', 'setting/settingpost');

		$this->model_user_user_group->addPermission($this->user->getId(), 'access', 'catalog/post');
		$this->model_user_user_group->addPermission($this->user->getId(), 'modify', 'catalog/post');
		$this->model_user_user_group->addPermission($this->user->getId(), 'access', 'catalog/downloadpost');
		$this->model_user_user_group->addPermission($this->user->getId(), 'modify', 'catalog/downloadpost');
		$this->model_user_user_group->addPermission($this->user->getId(), 'access', 'catalog/thread');
		$this->model_user_user_group->addPermission($this->user->getId(), 'modify', 'catalog/thread');
		$this->model_user_user_group->addPermission($this->user->getId(), 'access', 'catalog/reviewpost');
		$this->model_user_user_group->addPermission($this->user->getId(), 'modify', 'catalog/reviewpost');
		$this->model_user_user_group->addPermission($this->user->getId(), 'access', 'report/post_viewed');
		$this->model_user_user_group->addPermission($this->user->getId(), 'modify', 'report/post_viewed');
		$this->model_user_user_group->addPermission($this->user->getId(), 'access', 'user/mangeuser');
		$this->model_user_user_group->addPermission($this->user->getId(), 'modify', 'user/mangeuser');
		$this->model_user_user_group->addPermission($this->user->getId(), 'access', 'setting/settingpost');
		$this->model_user_user_group->addPermission($this->user->getId(), 'modify', 'setting/settingpost');

		$this->db->query("INSERT INTO `" . DB_PREFIX . "settingpost` (`settingpost_id`, `store_id`, `code`, `key`, `value`, `serialized`) VALUES
			(102, 0, 'head_module_post', 'head_module_post', 'Post Latest', 0),
			(103, 0, 'head_post_cool', 'head_post_cool', 'Post Cool', 0),
			(104, 0, 'item_module_post', 'item_module_post', '5', 0),
			(105, 0, 'item_perpage_admin', 'item_perpage_admin', '15', 0),
			(106, 0, 'description_limit', 'description_limit', '200', 0),
			(107, 0, 'image_thumb_width', 'image_thumb_width', '400', 0),
			(108, 0, 'image_thumb_height', 'image_thumb_height', '300', 0),
			(109, 0, 'image_thread_width', 'image_thread_width', '400', 0),
			(110, 0, 'image_thread_height', 'image_thread_height', '300', 0),
			(111, 0, 'image_banner_width', 'image_banner_width', '1600', 0),
			(112, 0, 'image_banner_height', 'image_banner_height', '900', 0),
			(113, 0, 'image_popup_width', 'image_popup_width', '1280', 0),
			(114, 0, 'image_popup_height', 'image_popup_height', '1024', 0),
			(115, 0, 'head_reviews', 'head_reviews', 'Comment', 0),
			(116, 0, 'allow_reviews', 'allow_reviews', '1', 0),
			(117, 0, 'allow_guest_reviews', 'allow_guest_reviews', '1', 0),
			(118, 0, 'view_instantly', 'view_instantly', '1', 0),
			(119, 0, 'post_realate', 'post_realate', 'Post relate', 0),
			(120, 0, 'item_view_relate', 'item_view_relate', '10', 0),
			(121, 0, 'view_relate', 'view_relate', '1', 0),
			(122, 0, 'head_thread', 'head_thread', 'Category Post', 0),
			(123, 0, 'item_perpage_thread', 'item_perpage_thread', '9', 0),
			(124, 0, 'thread_post_count', 'thread_post_count', '0', 0);
		");
		
		$this->load->model('setting/settingpost');
		
		$setting = json_decode('{"item_module_post":"5","item_perpage_admin":"15","description_limit":"200","image_thumb_width":"500","image_thumb_height":"333","image_thread_width":"500","image_thread_height":"333","image_banner_width":"1170","image_banner_height":"780","image_gallery_width":"400","image_gallery_height":"300","image_popup_width":"1280","image_popup_height":"1024","allow_reviews":"1","allow_guest_reviews":"1","view_instantly":"1","item_view_relate":"10","view_relate":"1","item_perpage_thread":"9","thread_post_count":"0"}', true);
		
		$this->model_setting_settingpost->editSettingPost($setting);
	}
	
	public function uninstall() {
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "post`");
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "post_description`");
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "downloadpost`");
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "downloadpost_description`");
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "post_image`");
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "post_related`");
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "post_related`");
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "post_to_thread`");
		
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "thread`");
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "thread_description`");
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "thread_filter`");
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "thread_path`");
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "thread_to_layout`");
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "thread_to_store`");
		$this->db->query("ALTER TABLE `" . DB_PREFIX . "user` DROP COLUMN postpermission");
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "user_to_thread`");
		
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "reviewpost`");
		
		$this->db->query("DELETE FROM `" . DB_PREFIX . "url_alias` WHERE query like 'post_id%'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "url_alias` WHERE query like 'thread_id%'");

		$this->load->model('setting/settingpost');
		$settingpost=$this->model_setting_settingpost->getSettingPosts(); 
		$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "settingpost`");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "user_group` WHERE user_group_id=".$settingpost['user_group_post_id']."");
	}
}