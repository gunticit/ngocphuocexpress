<?php
class ControllerSettingSettingpost extends Controller {
	public $settingpost;
	public function __construct($settingpost) {
	parent::__construct($settingpost);
		$this->load->model('setting/settingpost');
		$this->settingpost=$this->model_setting_settingpost->getSettingPosts(); 
	}
	private $error = array();
	
	public function index() {	
		$this->load->language('setting/settingpost');
		$this->document->setTitle($this->language->get('heading_title'));
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit']                    = $this->language->get('text_edit');
		$data['text_review']                    = $this->language->get('text_review');
		$data['text_success']                    = $this->language->get('text_success');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
		$data['text_post_relate']                    = $this->language->get('text_post_relate');
		$data['text_thread']                    = $this->language->get('text_thread');
		
		$data['text_thread_post_count']                    = $this->language->get('text_thread_post_count');
		$data['text_item_module_post']                    = $this->language->get('text_item_module_post');
		$data['text_item_perpage_catalog']                    = $this->language->get('text_item_perpage_catalog');
		$data['text_item_perpage_thread']                    = $this->language->get('text_item_perpage_thread');

		$data['text_description_limit']                    = $this->language->get('text_description_limit');
		$data['text_item_perpage_admin']                    = $this->language->get('text_item_perpage_admin');
		$data['text_image_thread']                    = $this->language->get('text_image_thread');
		$data['text_image_banner']                    = $this->language->get('text_image_banner');
		$data['text_image_gallery']                    = $this->language->get('text_image_gallery');
		$data['text_image_popup']                    = $this->language->get('text_image_popup');
		$data['text_image_thumb']                    = $this->language->get('text_image_thumb');
		
		// Reviews
		$data['text_allow_reviews']                    = $this->language->get('text_allow_reviews');
		$data['text_allow_guest_reviews']                    = $this->language->get('text_allow_guest_reviews');
		$data['text_view_instantly']                    = $this->language->get('text_view_instantly');
		
		// Related
		$data['text_view_relate']                    = $this->language->get('text_view_relate');
		$data['text_item_view_relate']                    = $this->language->get('text_item_view_relate');
		
		$data['explain_thread_post_count']                    = $this->language->get('explain_thread_post_count');
		$data['explain_item_module_post']                    = $this->language->get('explain_item_module_post');
		$data['explain_item_perpage_catalog']                    = $this->language->get('explain_item_perpage_catalog');

		$data['explain_description_limit']                    = $this->language->get('explain_description_limit');
		$data['explain_item_perpage_admin']                    = $this->language->get('explain_item_perpage_admin');
		$data['explain_image_thum']                    = $this->language->get('explain_image_thum');
		
		// Reviews
		$data['explain_allow_reviews']                    = $this->language->get('explain_allow_reviews');
		$data['explain_allow_guest_reviews']                    = $this->language->get('explain_allow_guest_reviews');
		$data['explain_view_instantly']                    = $this->language->get('explain_view_instantly');
		
		// Related
		$data['explain_view_relate']                    = $this->language->get('explain_view_relate');
		$data['explain_item_view_relate']                    = $this->language->get('explain_item_view_relate');
		$data['text_explain_post'] = $this->language->get('text_explain_post');
		$data['explain_post'] = $this->language->get('explain_post');

		// Thread
		$data['explain_item_perpage_thread']                    = $this->language->get('explain_item_perpage_thread');
		
		// orter
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		//------------------ nếu nhấn nút lưu + xác nhận dữ liệu Ok => Save
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_settingpost->editSettingPost($this->request->post);

			if ($this->config->get('config_currency_auto')) {
				$this->load->model('localisation/currency');

				$this->model_localisation_currency->refresh();
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('setting/settingpost', 'token=' . $this->session->data['token'], 'SSL'));
		}	
		//----------------- Xác định các lỗi lúc nhập, từ việc kiểm tra hàm: $this->validate()
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		if (isset($this->error['item_module_post'])) {
			$data['error_item_module_post'] = $this->error['item_module_post'];
		} else {
			$data['error_item_module_post'] = '';
		}
		if (isset($this->error['thread_post_count'])) {
			$data['error_thread_post_count'] = $this->error['thread_post_count'];
		} else {
			$data['error_thread_post_count'] = '';
		}
		if (isset($this->error['item_module_post'])) {
			$data['error_item_module_post'] = $this->error['item_module_post'];
		} else {
			$data['error_item_module_post'] = '';
		}
		if (isset($this->error['item_perpage_catalog'])) {
			$data['error_item_perpage_catalog'] = $this->error['item_perpage_catalog'];
		} else {
			$data['error_item_perpage_catalog'] = '';
		}
		if (isset($this->error['description_limit'])) {
			$data['error_description_limit'] = $this->error['description_limit'];
		} else {
			$data['error_description_limit'] = '';
		}
		if (isset($this->error['item_perpage_admin'])) {
			$data['error_item_perpage_admin'] = $this->error['item_perpage_admin'];
		} else {
			$data['error_item_perpage_admin'] = '';
		}
		if (isset($this->error['image_thumb'])) {
			$data['error_image_thumb'] = $this->error['image_thumb'];
		} else {
			$data['error_image_thumb'] = '';
		}
		if (isset($this->error['image_thread'])) {
			$data['error_image_thread'] = $this->error['image_thread'];
		} else {
			$data['error_image_thread'] = '';
		}
		if (isset($this->error['image_banner'])) {
			$data['error_image_banner'] = $this->error['image_banner'];
		} else {
			$data['error_image_banner'] = '';
		}
		if (isset($this->error['image_gallery'])) {
			$data['error_image_gallery'] = $this->error['image_gallery'];
		} else {
			$data['error_image_gallery'] = '';
		}
		if (isset($this->error['image_popup'])) {
			$data['error_image_popup'] = $this->error['image_popup'];
		} else {
			$data['error_image_popup'] = '';
		}
		if (isset($this->error['allow_reviews'])) {
			$data['error_allow_reviews'] = $this->error['allow_reviews'];
		} else {
			$data['error_allow_reviews'] = '';
		}
		if (isset($this->error['allow_guest_reviews'])) {
			$data['error_allow_guest_reviews'] = $this->error['allow_guest_reviews'];
		} else {
			$data['error_allow_guest_reviews'] = '';
		}
		if (isset($this->error['view_instantly'])) {
			$data['error_view_instantly'] = $this->error['view_instantly'];
		} else {
			$data['error_view_instantly'] = '';
		}
		if (isset($this->error['view_relate'])) {
			$data['error_view_relate'] = $this->error['view_relate'];
		} else {
			$data['error_view_relate'] = '';
		}
		if (isset($this->error['item_view_relate'])) {
			$data['error_item_view_relate'] = $this->error['item_view_relate'];
		} else {
			$data['error_item_view_relate'] = '';
		}
		if (isset($this->error['item_perpage_thread'])) {
			$data['error_item_perpage_thread'] = $this->error['item_perpage_thread'];
		} else {
			$data['error_item_perpage_thread'] = '';
		}
		
		//----------------- Thanh xác định đường dẫn địa chỉ
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_stores'),
			'href' => $this->url->link('setting/store', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('setting/settingpost', 'token=' . $this->session->data['token'], 'SSL')
		);

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
		//----------------- Các nút chức năng
		$data['action'] = $this->url->link('setting/settingpost', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('setting/settingpost', 'token=' . $this->session->data['token'], 'SSL');

		$data['token'] = $this->session->data['token'];		
		//---------------- Cập nhật lại các biến để xuất ra template
		
		if (isset($this->request->post['thread_post_count'])) {
			$data['thread_post_count'] = $this->request->post['thread_post_count'];
		} else {
			$data['thread_post_count'] = $this->settingpost['thread_post_count'];
		}
		if (isset($this->request->post['item_module_post'])) {
			$data['item_module_post'] = $this->request->post['item_module_post'];
		} else {
			$data['item_module_post'] = $this->settingpost['item_module_post'];
		}
		
		if (isset($this->request->post['description_limit'])) {
			$data['description_limit'] = $this->request->post['description_limit'];
		} else {
			$data['description_limit'] = $this->settingpost['description_limit'];
		}
		if (isset($this->request->post['item_perpage_admin'])) {
			$data['item_perpage_admin'] = $this->request->post['item_perpage_admin'];
		} else {
			$data['item_perpage_admin'] = $this->settingpost['item_perpage_admin'];
		}
		if (isset($this->request->post['item_perpage_admin'])) {
			$data['item_perpage_admin'] = $this->request->post['item_perpage_admin'];
		} else {
			$data['item_perpage_admin'] = $this->settingpost['item_perpage_admin'];
		}
		
		if (isset($this->request->post['image_thumb_width'])) {
			$data['image_thumb_width'] = $this->request->post['image_thumb_width'];
		} else {
			$data['image_thumb_width'] = $this->settingpost['image_thumb_width'];
		}

		if (isset($this->request->post['image_thumb_height'])) {
			$data['image_thumb_height'] = $this->request->post['image_thumb_height'];
		} else {
			$data['image_thumb_height'] = $this->settingpost['image_thumb_height'];
		}
		
		if (isset($this->request->post['image_thread_width'])) {
			$data['image_thread_width'] = $this->request->post['image_thread_width'];
		} else {
			$data['image_thread_width'] = $this->settingpost['image_thread_width'];
		}

		if (isset($this->request->post['image_thread_height'])) {
			$data['image_thread_height'] = $this->request->post['image_thread_height'];
		} else {
			$data['image_thread_height'] = $this->settingpost['image_thread_height'];
		}
		
		if (isset($this->request->post['image_banner_width'])) {
			$data['image_banner_width'] = $this->request->post['image_banner_width'];
		} else {
			$data['image_banner_width'] = $this->settingpost['image_banner_width'];
		}

		if (isset($this->request->post['image_banner_height'])) {
			$data['image_banner_height'] = $this->request->post['image_banner_height'];
		} else {
			$data['image_banner_height'] = $this->settingpost['image_banner_height'];
		}
		
		if (isset($this->request->post['image_gallery_width'])) {
			$data['image_gallery_width'] = $this->request->post['image_gallery_width'];
		} else {
			$data['image_gallery_width'] = $this->settingpost['image_gallery_width'];
		}
		
		if (isset($this->request->post['image_gallery_height'])) {
			$data['image_gallery_height'] = $this->request->post['image_gallery_height'];
		} else {
			$data['image_gallery_height'] = $this->settingpost['image_gallery_height'];
		}
		
		if (isset($this->request->post['image_popup_width'])) {
			$data['image_popup_width'] = $this->request->post['image_popup_width'];
		} else {
			$data['image_popup_width'] = $this->settingpost['image_popup_width'];
		}

		if (isset($this->request->post['image_popup_height'])) {
			$data['image_popup_height'] = $this->request->post['image_popup_height'];
		} else {
			$data['image_popup_height'] = $this->settingpost['image_popup_height'];
		}
		if (isset($this->request->post['allow_reviews'])) {
			$data['allow_reviews'] = $this->request->post['allow_reviews'];
		} else {
			$data['allow_reviews'] = $this->settingpost['allow_reviews'];
		}
		if (isset($this->request->post['allow_guest_reviews'])) {
			$data['allow_guest_reviews'] = $this->request->post['allow_guest_reviews'];
		} else {
			$data['allow_guest_reviews'] = $this->settingpost['allow_guest_reviews'];
		}
		if (isset($this->request->post['view_instantly'])) {
			$data['view_instantly'] = $this->request->post['view_instantly'];
		} else {
			$data['view_instantly'] = $this->settingpost['view_instantly'];
		}
		if (isset($this->request->post['view_relate'])) {
			$data['view_relate'] = $this->request->post['view_relate'];
		} else {
			$data['view_relate'] = $this->settingpost['view_relate'];
		}
		if (isset($this->request->post['item_view_relate'])) {
			$data['item_view_relate'] = $this->request->post['item_view_relate'];
		} else {
			$data['item_view_relate'] = $this->settingpost['item_view_relate'];
		}
		if (isset($this->request->post['item_perpage_thread'])) {
			$data['item_perpage_thread'] = $this->request->post['head_thread'];
		} else {
			$data['item_perpage_thread'] = $this->settingpost['item_perpage_thread'];
		}
		
		// Find which protocol to use to pass the full image link back
		if ($this->request->server['HTTPS']) {
			$server = HTTPS_CATALOG;
		} else {
			$server = HTTP_CATALOG;
		}
		$this->load->model('tool/image');
		
		//------------------------------ xuât ra template
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('setting/settingpost.tpl', $data));
	}
	
	//----------------------------
	protected function validate() {

		return !$this->error;
	}

	public function template() {
		if ($this->request->server['HTTPS']) {
			$server = HTTPS_CATALOG;
		} else {
			$server = HTTP_CATALOG;
		}

		if (is_file(DIR_IMAGE . 'templates/' . basename($this->request->get['template']) . '.png')) {
			$this->response->setOutput($server . 'image/templates/' . basename($this->request->get['template']) . '.png');
		} else {
			$this->response->setOutput($server . 'image/no_image.png');
		}
	}
}
