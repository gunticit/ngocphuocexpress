<?php
class ModelDesignPage extends Model {
	public function getPage($page_id){
		$query = $this->db->query("SELECT DISTINCT *, (SELECT DISTINCT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'page_id=" . (int)$page_id . "') AS keyword FROM `" . DB_PREFIX . "page`  WHERE `page_id`='" . (int)$page_id . "' AND `status`='1'");
		
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
	
	public function getPageHome() {
		$query = $this->db->query("SELECT DISTINCT * FROM `" . DB_PREFIX . "page`  WHERE `home`= '1' AND `status`='1'");
		
		return $query->rows;
	}
	
	public function getPagesByLayout($layout_id, $position = 'content'){
		$query = $this->db->query("SELECT DISTINCT * FROM `" . DB_PREFIX . "page` p LEFT JOIN `" . DB_PREFIX . "page_to_layout` ptl ON (`p`.`page_id` = `ptl`.`page_id`) WHERE `p`.`position`='".$position."' AND  `ptl`.`layout_id`='".(int)$layout_id."'");
		
		return $query->rows;
	}
	
	public function getPageDescriptions($page_id){
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "page_description` WHERE `page_id` = '" . (int)$page_id . "' AND `language_id` = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}
}
