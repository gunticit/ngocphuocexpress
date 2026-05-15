<?php
class ModelDesignBlock extends Model {
	public function addBlock($data) {
		$this->db->query("INSERT INTO `" . DB_PREFIX . "block` SET `type` = 'custom', `key` = '" . $this->db->escape($data['key']) . "', `avatar` = '" . $this->db->escape($data['avatar']) . "', `html`='" . $this->db->escape(html_entity_decode($data['html'])) . "', `css`='" . $this->db->escape(html_entity_decode($data['css'])) . "', `css_lib` = '" . $this->db->escape((isset($data['css_lib'])) ? json_encode($data['css_lib']) : json_encode(array())) . "', `script_lib` = '" . $this->db->escape((isset($data['script_lib'])) ? json_encode($data['script_lib']) : json_encode(array())) . "', `date_added`=NOW(), `date_modified`=NOW()");
		
		$block_id = $this->db->getLastId();
		
		$code = $data['key'] . '-' . $block_id;
		
		$css_publish = str_replace('.' . $data['key'], '.' . $code, html_entity_decode($data['css']));
		
		$html_publish = str_replace('class="' . $data['key'] . '"', 'class="' . $code . '"', html_entity_decode($data['html']));
		$html_publish = str_replace('.' . $data['key'], '.' . $code, html_entity_decode($html_publish));
		
		$this->db->query("UPDATE `" . DB_PREFIX . "block` SET `code` = '" . $this->db->escape($code) . "', html_publish='".$this->db->escape($html_publish)."', css_publish='".$this->db->escape($css_publish)."' WHERE `block_id`='" . (int)$block_id . "'");
		
		$path = '';
		
		$directories = explode('/', 'catalog/block/' . $code);

		foreach ($directories as $directory) {
			$path = $path . '/' . $directory;
			
			if (!is_dir(DIR_IMAGE . $path)) {
				@mkdir(DIR_IMAGE . $path, 0777);
			}
		}
	}
	
	public function editBlock($block_id, $data){
		$code = $data['key'] . '-' . $block_id;
		
		$css_publish = str_replace('.' . $data['key'], '.' . $code, html_entity_decode($data['css']));
		
		$html_publish = str_replace('class="' . $data['key'] . '"', 'class="' . $code . '"', html_entity_decode($data['html']));
		$html_publish = str_replace('.' . $data['key'], '.' . $code, html_entity_decode($html_publish));
		
		$this->db->query("UPDATE `" . DB_PREFIX . "block` SET `code` = '" . $this->db->escape($code) . "', `key` = '" . $this->db->escape($data['key']) . "', `avatar` = '" . $this->db->escape($data['avatar']) . "', `html`='" . $this->db->escape(html_entity_decode($data['html'])) . "', `css`='" . $this->db->escape(html_entity_decode($data['css'])) . "', html_publish='".$this->db->escape($html_publish)."', css_publish='".$this->db->escape($css_publish)."', `css_lib` = '" . $this->db->escape((isset($data['css_lib'])) ? json_encode($data['css_lib']) : json_encode(array())) . "', `script_lib` = '" . $this->db->escape((isset($data['script_lib'])) ? json_encode($data['script_lib']) : json_encode(array())) . "', `date_modified`=NOW() WHERE `block_id`='" . (int)$block_id . "'");
		
		$path = '';
		
		$directories = explode('/', 'catalog/block/' . $code);
		
		foreach ($directories as $directory) {
			$path = $path . '/' . $directory;
			
			if (!is_dir(DIR_IMAGE . $path)) {
				@mkdir(DIR_IMAGE . $path, 0777);
			}
		}
	}
	
	public function getBlock($block_id = 0){
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "block`  WHERE `block_id`='" . (int)$block_id . "'");
		
		return $query->row;
	}
	
	public function getBlockByCode($code = ''){
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "block`  WHERE `code`='" . $this->db->escape($code) . "'");
		
		return $query->row;
	}
	
	public function getBlocks($data = array()){
		$sql = "SELECT * FROM `" . DB_PREFIX . "block` WHERE 1";
		
		if (!empty($data['filter_code'])) {
			$sql .= " AND `code` LIKE '" . $this->db->escape($data['filter_code']) . "%'";
		}
		
		if (!empty($data['filter_key'])) {
			$sql .= " AND `key` = '" . $this->db->escape($data['filter_key']) . "'";
		}

		$sort_data = array(
			'code',
			'block_id'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY block_id";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
		
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
	
	public function getTotalblocks($data = array()){
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "block`");

		return $query->row['total'];
	}
	
	public function checkBlock($code = ''){
		if(!empty($code)){
			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "block` WHERE `code`='" . $this->db->escape(strtolower($code)) . "'");
			
			return $query->num_rows;
		}else{
			return true;
		}
	}
	
	public function updateBlock($data = array()){
		$block_exists = $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "block` WHERE `code`='" . $this->db->escape(strtolower($data['code'])) . "'")->num_rows;
		
		$code = strtolower($data['code']);
		
		$html = html_entity_decode($data['html']);
		$html = preg_replace_callback('~<img[^>]*?src="(.*?(gif|jpeg|jpg|png|GIF|JPEG|JPG|PNG))".*?>~', 'ModelDesignBlock::replaceImage', $html);
		$html = preg_replace_callback('~url\([^>]*?(.*?(gif|jpeg|jpg|png|GIF|JPEG|JPG|PNG)).*?\)~', 'ModelDesignBlock::replaceImage', $html);
		
		$css = html_entity_decode($data['css']);
		$css = preg_replace_callback('~url\([^>]*?(.*?(gif|jpeg|jpg|png|GIF|JPEG|JPG|PNG)).*?\)~', 'ModelDesignBlock::replaceImage', $css);
		
		$css_publish = str_replace('.' . $data['type'], '.' . $code, html_entity_decode($css));
		
		$html_publish = str_replace('class="' . $data['type'] . '"', 'class="' . $code . '"', html_entity_decode($html));
		$html_publish = str_replace('.' . $data['type'], '.' . $code, html_entity_decode($html_publish));
		
		if(!$block_exists){
			$this->db->query("INSERT INTO `" . DB_PREFIX . "block` SET `type` = 'library', `key` = '" . $this->db->escape(strtolower($data['type'])) . "', `code`='" . $this->db->escape($code) . "', `html`='" . $this->db->escape($html) . "', `html_publish`='" . $this->db->escape($html_publish) . "', `css`='" . $this->db->escape($css) . "', `css_publish`='" . $this->db->escape($css_publish) . "', `script_lib`='" . $this->db->escape(json_encode($data['script_lib'])) . "', `css_lib`='" . $this->db->escape(json_encode($data['css_lib'])) . "', `date_added`=NOW(), `date_modified`=NOW()");
		}else{
			$this->db->query("UPDATE `" . DB_PREFIX . "block` SET `type` = 'library', `key` = '" . $this->db->escape(strtolower($data['type'])) . "', `code`='" . $this->db->escape($code) . "', `html`='" . $this->db->escape($html) . "', `html_publish`='" . $this->db->escape($html_publish) . "', `css`='" . $this->db->escape($css) . "', `css_publish`='" . $this->db->escape($css_publish) . "', `script_lib`='" . $this->db->escape(json_encode($data['script_lib'])) . "', `css_lib`='" . $this->db->escape(json_encode($data['css_lib'])) . "', `date_modified`=NOW() WHERE `code`='" . $this->db->escape(strtolower($data['code'])) . "'");
		}
		
		$this->load->model('design/page');
		$this->model_design_page->rendTpl();
	}
	
	public function replaceImage($match){
		$match[1] = str_replace(array('"','\''), '', $match[1]);
		
		$image = basename($match[1]);
		
		$image_link = str_replace(array('https://', 'http://'), '//', HTTPS_CATALOG) . 'image/block/' . $code . '/' . $image;
		
		return str_replace($match[1], $image_link, $match[0]);
	}
}