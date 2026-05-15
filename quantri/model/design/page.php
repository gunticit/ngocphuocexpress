<?php
class ModelDesignPage extends Model {
	public function addPage($data) {
		$data['content'] = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', html_entity_decode($data['content']));
		$data['raw'] = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', html_entity_decode($data['raw']));
		$data['backup'] = json_encode($data);
		
		$this->db->query("INSERT INTO `" . DB_PREFIX . "page` SET `content`='".$this->db->escape($data['content'])."', `raw`='".$this->db->escape($data['raw'])."', `backup`='".$this->db->escape($data['backup'])."', `home`='".(int)$data['home']."', `status`='".(int)$data['status']."', `date_added`=NOW(), `date_modified`=NOW()");
		
		$page_id = $this->db->getLastId();
		
		foreach ($data['page_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "page_description` SET `page_id` = '" . (int)$page_id . "', `language_id` = '" . (int)$language_id . "', `name` = '" . $this->db->escape($value['name']) . "', `meta_title` = '" . $this->db->escape($value['meta_title']) . "', `meta_description` = '" . $this->db->escape($value['meta_description']) . "', `meta_keyword` = '" . $this->db->escape($value['meta_keyword']) . "'");
		}
		
		if (!empty($data['keyword'])) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "url_alias` SET `query` = 'page_id=" . (int)$page_id . "', `keyword` = '" . $this->db->escape($data['keyword']). "'");
		}else{
			$language_id = (int)$this->config->get('config_language_id');
			
			$this->db->query("INSERT INTO `" . DB_PREFIX . "url_alias` SET `query` = 'page_id=" . (int)$page_id . "', `keyword` = '" . $this->db->escape(str_alias($data['page_description'][$language_id]['name'])) .'-'.$page_id. "'");
		}
		
		return $page_id;
	}
	
	public function editPage($page_id, $data){
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "page`  WHERE `page_id`='" . (int)$page_id . "'");
		
		unset($query->row['backup']);
		
		$query->row['page_description'] = $this->getPageDescriptions($page_id);
		
		$data['backup'] = json_encode($query->row);
		
		$data['content'] = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', html_entity_decode($data['content']));
		$data['raw'] = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', html_entity_decode($data['raw']));
		
		$content = $query->row['content'];
		
		$this->db->query("UPDATE `" . DB_PREFIX . "page` SET `content`='".$this->db->escape($data['content'])."', `backup`='".$this->db->escape($data['backup'])."', `raw`='".$this->db->escape($data['raw'])."',  `home`='".(int)$data['home']."', `status`='".(int)$data['status']."', `date_modified`=NOW() WHERE page_id = '" . (int)$page_id . "'");
		
		$this->db->query("DELETE FROM `" . DB_PREFIX . "page_description` WHERE `page_id` = '" . (int)$page_id . "'");
		
		foreach ($data['page_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "page_description` SET `page_id` = '" . (int)$page_id . "', `language_id` = '" . (int)$language_id . "', `name` = '" . $this->db->escape($value['name']) . "', `meta_title` = '" . $this->db->escape($value['meta_title']) . "', `meta_description` = '" . $this->db->escape($value['meta_description']) . "', `meta_keyword` = '" . $this->db->escape($value['meta_keyword']) . "'");
		}
		
		$this->db->query("DELETE FROM `" . DB_PREFIX . "url_alias` WHERE `query` = 'page_id=" . (int)$page_id . "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "url_alias` SET `query` = 'page_id=" . (int)$page_id . "', `keyword` = '" . $this->db->escape($data['keyword']) . "'");
		}
	}
	
	public function deletePage($page_id){
		$this->db->query("DELETE FROM `" . DB_PREFIX . "page` WHERE `page_id` = '" . (int)$page_id . "'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "page_description` WHERE `page_id` = '" . (int)$page_id . "'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "url_alias` WHERE `query` = 'page_id=" . (int)$page_id . "'");
	}
	
	public function recoveryPage($page_id){
		$query = $this->db->query("SELECT `backup` FROM `" . DB_PREFIX . "page`  WHERE `page_id`='" . (int)$page_id . "'");
		
		$data = json_decode($query->row['backup'], true);
		
		$this->editPage($page_id, $data);
	}
	
	public function getPage($page_id){
		$query = $this->db->query("SELECT DISTINCT *, (SELECT DISTINCT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'page_id=" . (int)$page_id . "') AS keyword FROM `" . DB_PREFIX . "page`  WHERE `page_id`='" . (int)$page_id . "'");
		
		return $query->row;
	}
	
	public function getPages($data = array()){
		$sql = "SELECT DISTINCT * FROM `" . DB_PREFIX . "page` p LEFT JOIN `" . DB_PREFIX . "page_description` pd ON(`p`.`page_id` = `pd`.`page_id`) WHERE `pd`.`language_id`='" . (int)$this->config->get('config_language_id') . "'";
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND `pd`.`name` LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		$sort_data = array(
			'name',
			'page_id'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY p.page_id";
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
	
	public function getPagesPulish(){
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "page` WHERE `status`='1'");
		
		return $query->rows;
	}
	
	public function getPageDescriptions($page_id){
		$page_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "page_description WHERE page_id = '" . (int)$page_id . "'");

		foreach ($query->rows as $result) {
			$page_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'meta_title'       => $result['meta_title'],
				'meta_keyword'     => $result['meta_keyword'],
				'meta_description' => $result['meta_description']
			);
		}

		return $page_description_data;
	}
	
	public function getTotalPages($data = array()){
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "page`");

		return $query->row['total'];
	}
}