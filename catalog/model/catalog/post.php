<?php
class ModelCatalogpost extends Model {	
	public function updateViewed($post_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "post SET viewed = (viewed + 1) WHERE post_id = '" . (int)$post_id . "'");
	}
	public function getPost($post_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "post n LEFT JOIN " . DB_PREFIX . "post_description nd ON n.post_id = nd.post_id WHERE n.post_id = '" . (int)$post_id . "' AND nd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
		return $query->row;
	}
	
	public function getPostImages($post_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "post_image pi LEFT JOIN " . DB_PREFIX . "post_image_description pid ON (pi.post_image_id = pid.post_image_id) WHERE pi.post_id = '" . (int)$post_id . "' AND pid.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY pi.sort_order ASC");
		
		return $query->rows;
	}
	
	public function getPostByThreadId($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "post n LEFT JOIN " . DB_PREFIX . "post_description nd ON n.post_id = nd.post_id left join " . DB_PREFIX . "post_to_thread n2c on n.post_id=n2c.post_id WHERE n2c.thread_id=".$data['thread_id']." and nd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND n.status = '1' ORDER BY date_added DESC";
	
		if (isset($data['start']) && isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}
			
			if ($data['limit'] < 1) {
				$data['limit'] = 10;
			}	
		
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);
		
		return $query->rows;

		
	}
	
	public function getTotalPostByThreadId($thread_id = 0) {
		$query = $this->db->query("SELECT count(*) as totalpost FROM " . DB_PREFIX . "post n LEFT JOIN " . DB_PREFIX . "post_description nd ON n.post_id = nd.post_id left join " . DB_PREFIX . "post_to_thread n2c on n.post_id=n2c.post_id WHERE n2c.thread_id=".$thread_id." and nd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND n.status = '1' ORDER BY date_added DESC");
		
		return $query->row['totalpost'];
	}
 
	public function getPosts($data = array()) {
		$sql = "SELECT DISTINCT * FROM " . DB_PREFIX . "post n LEFT JOIN " . DB_PREFIX . "post_description nd ON (n.post_id = nd.post_id)";
		
		if(isset($data['filter_thread_id']) && $data['filter_thread_id']){
			$sql .= " LEFT JOIN " . DB_PREFIX . "post_to_thread ntc ON (n.post_id = ntc.post_id) LEFT JOIN " . DB_PREFIX . "thread_path cp ON (ntc.thread_id = cp.thread_id)";
		}
		
		$sql .= " WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND n.status = '1'";
		
		if(isset($data['filter_thread_id']) && $data['filter_thread_id']){
			$sql.=" AND (ntc.thread_id = '".(int)$data['filter_thread_id']."'";
			
			if (!empty($data['filter_sub_thread'])) {
				$sql .= " OR cp.path_id = '" . (int)$data['filter_thread_id'] . "')";
			}else{
				$sql .= ")";
			}
		}
		
		if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "nd.title LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (!empty($data['filter_description'])) {
					$sql .= " OR nd.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
				}
			}

			if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
				$sql .= " OR ";
			}

			if (!empty($data['filter_tag'])) {
				$sql .= "nd.tag LIKE '%" . $this->db->escape($data['filter_tag']) . "%'";
			}

			$sql .= ")";
		}
		
		if(isset($data['filter_thread_id']) && $data['filter_thread_id']){
			$sql .= " GROUP BY n.post_id";
		}
		
		$sort_data = array(
			'nd.title',
			'n.date_added'
		);
		
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY n.viewed";
		}
		
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(nd.title) DESC";
		} else {
			$sql .= " ASC, LCASE(nd.title) ASC";
		}
		
		if (isset($data['start']) && isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}
			
			if ($data['limit'] < 1) {
				$data['limit'] = 10;
			}	
		
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}	
		
		$query = $this->db->query($sql);
		
		
		return $query->rows;
	}
	
	public function getTotalPost($data = array()) {
		$sql = "SELECT n.post_id FROM " . DB_PREFIX . "post n LEFT JOIN " . DB_PREFIX . "post_description nd ON (n.post_id = nd.post_id) LEFT JOIN " . DB_PREFIX . "post_to_thread ntc ON (n.post_id = ntc.post_id) LEFT JOIN " . DB_PREFIX . "thread_path cp ON (ntc.thread_id = cp.thread_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND n.status = '1' ";
		
		if(isset($data['thread_id']) && $data['thread_id']){
			 $sql.=" AND ntc.thread_id = '".(int)$data['thread_id']."'";
		}
		
		if(isset($data['filter_thread_id']) && $data['filter_thread_id']){
			$sql.=" AND (ntc.thread_id = '".(int)$data['filter_thread_id']."'";
			
			if (!empty($data['filter_sub_thread'])) {
				$sql .= " OR cp.path_id = '" . (int)$data['filter_thread_id'] . "')";
			}else{
				$sql .= ")";
			}
		}
		
		if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "nd.title LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (!empty($data['filter_description'])) {
					$sql .= " OR nd.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
				}
			}

			if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
				$sql .= " OR ";
			}

			if (!empty($data['filter_tag'])) {
				$sql .= "nd.tag LIKE '%" . $this->db->escape($data['filter_tag']) . "%'";
			}

			$sql .= ")";
		}
		
		$sql .= " GROUP BY n.post_id";
		
		$sort_data = array(
			'nd.title',
			'n.date_added'
		);
		
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY n.viewed";
		}
		
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(nd.title) DESC";
		} else {
			$sql .= " ASC, LCASE(nd.title) ASC";
		}
		
		$query = $this->db->query($sql);
		
		return $query->num_rows;
	}
	
	public function getPostRelated($post_id, $limit=10) {
		$post_related_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "post_related WHERE post_id = '" . (int)$post_id . "' limit 0,".$limit."");

		foreach ($query->rows as $result) {
			$post_related_data[] = $result['related_id'];
		}

		return $post_related_data;
	}

	public function getCommentPost($post_id){
		$query = $this->db->query("SELECT count(*) as totalpost from " . DB_PREFIX . "reviewpost WHERE post_id = '" . (int)$post_id . "'");
		return $query->row['totalpost'];
	}
	
	public function getPostAttributes($post_id) {
		$query = $this->db->query("SELECT a.attribute_id, ad.name, na.text FROM " . DB_PREFIX . "post_attribute na LEFT JOIN " . DB_PREFIX . "attribute a ON (na.attribute_id = a.attribute_id) LEFT JOIN " . DB_PREFIX . "attribute_description ad ON (a.attribute_id = ad.attribute_id) WHERE na.post_id = '" . (int)$post_id . "' AND ad.language_id = '" . (int)$this->config->get('config_language_id') . "' AND na.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY a.sort_order, ad.name");
		
		
		return $query->rows;
	}
}