<?php
class ModelCatalogExtraInfo extends Model {
	public function addExtraInfo($data) {
		$data['backup'] = json_encode($data);
		
		$this->db->query("INSERT INTO `" . DB_PREFIX . "extra_info` SET `css_lib` = '" . $this->db->escape((isset($data['css_lib'])) ? json_encode($data['css_lib']) : json_encode(array())) . "', `script_lib` = '" . $this->db->escape((isset($data['script_lib'])) ? json_encode($data['script_lib']) : json_encode(array())) . "', `backup`='".$this->db->escape($data['backup'])."', `status`='".(int)$data['status']."', `date_added`=NOW(), `date_modified`=NOW()");
		
		$extra_info_id = $this->db->getLastId();
		
		foreach ($data['extra_info_description'] as $language_id => $value) {
			$value['content'] = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', html_entity_decode($value['content']));
			$value['raw'] = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $value['raw']);
			
			$this->db->query("INSERT INTO `" . DB_PREFIX . "extra_info_description` SET `extra_info_id` = '" . (int)$extra_info_id . "', `language_id` = '" . (int)$language_id . "', `name` = '" . $this->db->escape($value['name']) . "', `content` = '" . $this->db->escape($value['content']) . "', `raw` = '" . $this->db->escape($value['raw']) . "'");
		}
		
		return $extra_info_id;
	}
	
	public function editExtraInfo($extra_info_id, $data){
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "extra_info`  WHERE `extra_info_id`='" . (int)$extra_info_id . "'");
		
		unset($query->row['backup']);
		
		$query->row['extra_info_description'] = $this->getExtraInfoDescriptions($extra_info_id);
		
		$data['backup'] = json_encode($query->row);
		
		$this->db->query("UPDATE `" . DB_PREFIX . "extra_info` SET `css_lib` = '" . $this->db->escape((isset($data['css_lib'])) ? json_encode($data['css_lib']) : json_encode(array())) . "', `script_lib` = '" . $this->db->escape((isset($data['script_lib'])) ? json_encode($data['script_lib']) : json_encode(array())) . "', `backup`='".$this->db->escape($data['backup'])."', `status`='".(int)$data['status']."', `date_modified`=NOW() WHERE extra_info_id = '" . (int)$extra_info_id . "'");
		
		$this->db->query("DELETE FROM `" . DB_PREFIX . "extra_info_description` WHERE `extra_info_id` = '" . (int)$extra_info_id . "'");
		
		foreach ($data['extra_info_description'] as $language_id => $value) {
			$value['content'] = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', html_entity_decode($value['content']));
			$value['raw'] = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $value['raw']);
			
			$this->db->query("INSERT INTO `" . DB_PREFIX . "extra_info_description` SET `extra_info_id` = '" . (int)$extra_info_id . "', `language_id` = '" . (int)$language_id . "', `name` = '" . $this->db->escape($value['name']) . "', `content` = '" . $this->db->escape($value['content']) . "', `raw` = '" . $this->db->escape($value['raw']) . "'");
		}
	}
	
	public function deleteExtraInfo($extra_info_id){
		$this->db->query("DELETE FROM `" . DB_PREFIX . "extra_info` WHERE `extra_info_id` = '" . (int)$extra_info_id . "'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "extra_info_description` WHERE `extra_info_id` = '" . (int)$extra_info_id . "'");
	}
	
	public function recoveryExtraInfo($extra_info_id){
		$query = $this->db->query("SELECT `backup` FROM `" . DB_PREFIX . "extra_info`  WHERE `extra_info_id`='" . (int)$extra_info_id . "'");
		
		$data = json_decode($query->row['backup'], true);
		
		$this->editExtraInfo($extra_info_id, $data);
	}
	
	public function getExtraInfo($extra_info_id){
		$query = $this->db->query("SELECT DISTINCT * FROM `" . DB_PREFIX . "extra_info`  WHERE `extra_info_id`='" . (int)$extra_info_id . "'");
		
		return $query->row;
	}
	
	public function getExtraInfos($data = array()){
		$sql = "SELECT DISTINCT * FROM `" . DB_PREFIX . "extra_info` ei LEFT JOIN `" . DB_PREFIX . "extra_info_description` eid ON(`ei`.`extra_info_id` = `eid`.`extra_info_id`) WHERE `eid`.`language_id`='" . (int)$this->config->get('config_language_id') . "'";
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND `eid`.`name` LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		$sort_data = array(
			'eid.name',
			'ei.extra_info_id'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY ei.extra_info_id";
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
	
	public function getExtraInfoDescriptions($extra_info_id){
		$extra_info_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "extra_info_description WHERE extra_info_id = '" . (int)$extra_info_id . "'");

		foreach ($query->rows as $result) {
			$extra_info_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'content' => $result['content'],
				'raw' => $result['raw'],
			);
		}

		return $extra_info_description_data;
	}
	
	public function getTotalExtraInfos($data = array()){
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "extra_info`");

		return $query->row['total'];
	}
}
