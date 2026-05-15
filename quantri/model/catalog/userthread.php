<?php
class ModelCatalogUserthread extends Model {
	
	public function getthread_user($user_id) {
		$query = $this->db->query("SELECT DISTINCT * from " . DB_PREFIX . "user WHERE user_id = '" . (int)$user_id . "'");

		return $query->row;
	}
	
	public function getpostthreadspost_user($thread_id) {
		$user_thread_data = array();
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user_to_thread WHERE thread_id = '" . (int)$thread_id . "'");
		
		
		foreach ($query->rows as $result) {
			$user_thread_data[] = $result['user_id'];
		}

		return $user_thread_data;
	}
	
	public function getthreads_user($data = array()) {
		$sql = "SELECT * FROM `" . DB_PREFIX . "user`";
		
		if (!empty($data['filter_name'])) {
			$sql .= " where status=1 and username LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}
		else  $sql.=" where status=1 ";
			
		$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];

		$query = $this->db->query($sql);

		return $query->rows;
		
	}
}