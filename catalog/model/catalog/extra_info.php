<?php
class ModelCatalogExtraInfo extends Model {
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

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "extra_info_description WHERE extra_info_id = '" . (int)$extra_info_id . "' AND `language_id` = '" . (int)$this->config->get('config_language_id'). "'");

		return $query->row;
	}
	
	public function getTotalExtraInfos($data = array()){
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "extra_info`");

		return $query->row['total'];
	}
}
