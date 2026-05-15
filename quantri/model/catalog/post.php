<?php
class ModelCatalogPost extends Model {
	public function addPost($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "post SET image = '" . $this->db->escape($data['image']) . "', banner = '" . $this->db->escape($data['banner']) . "', sort_order = '" . $this->db->escape($data['sort_order']) . "', date_available = '" . $this->db->escape($data['date_available']) . "', user_id = '" . $this->session->data['user_id']. "', date_added = NOW(), status = '" . (int)$data['status'] . "'");
		
		$post_id = $this->db->getLastId();
		
		foreach ($data['post'] as $key => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX ."post_description SET post_id = '" . (int)$post_id . "', language_id = '" . (int)$key . "', title = '" . $this->db->escape($value['title']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', description = '" . $this->db->escape($value['description']) . "', short_description = '" . $this->db->escape($value['short_description']) . "'");
		}
		
		//-----------
		if (isset($data['post_related'])) {
			foreach ($data['post_related'] as $related_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "post_related WHERE post_id = '" . (int)$post_id . "' AND related_id = '" . (int)$related_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "post_related SET post_id = '" . (int)$post_id . "', related_id = '" . (int)$related_id . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "post_related WHERE post_id = '" . (int)$related_id . "' AND related_id = '" . (int)$post_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "post_related SET post_id = '" . (int)$related_id . "', related_id = '" . (int)$post_id . "'");
			}
		}
		//-----------
		if (isset($data['post_thread'])) {
			foreach ($data['post_thread'] as $thread_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "post_to_thread SET post_id = '" . (int)$post_id . "', thread_id = '" . (int)$thread_id . "'");
			}
		}
		
		if (!empty($data['post_attribute'])) {
			foreach ($data['post_attribute'] as $post_attribute) {
				if ($post_attribute['attribute_id']) {
					foreach ($post_attribute['post_attribute_description'] as $language_id => $post_attribute_description) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "post_attribute SET post_id = '" . (int)$post_id . "', attribute_id = '" . (int)$post_attribute['attribute_id'] . "', language_id = '" . (int)$language_id . "', text = '" .  $this->db->escape($post_attribute_description['text']) . "'");
					}
				}
			}
		}
		
		if (isset($data['post_image'])) {
			foreach ($data['post_image'] as $post_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "post_image SET post_id = '" . (int)$post_id . "', image = '" . $this->db->escape($post_image['image']) . "', sort_order = '" . (int)$post_image['sort_order'] . "'");
				
				$post_image_id = $this->db->getLastId();

				foreach ($post_image['post_image_description'] as $language_id => $post_image_description) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "post_image_description SET post_image_id = '" . (int)$post_image_id . "', language_id = '" . (int)$language_id . "', post_id = '" . (int)$post_id . "', title = '" .  $this->db->escape($post_image_description['title']) . "'");
				}
			}
		}
		
		if (!empty($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'post_id=" . (int)$post_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}else{
			$language_id = (int)$this->config->get('config_language_id');
			
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'post_id=" . (int)$post_id . "', keyword = '" . $this->db->escape(seo_alias($data['post'][$language_id]['title'])) . "'");
		}
	}
	
	public function editPost($post_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "post SET image = '" . $this->db->escape($data['image']) . "', banner = '" . $this->db->escape($data['banner']) . "', sort_order = '" . $this->db->escape($data['sort_order']) . "', date_available = '" . $this->db->escape($data['date_available']) . "',  status = '" . (int)$data['status'] . "' WHERE post_id = '" . (int)$post_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "post_description WHERE post_id = '" . (int)$post_id. "'");
		
		foreach ($data['post'] as $key => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX ."post_description SET post_id = '" . (int)$post_id . "', language_id = '" . (int)$key . "', title = '" . $this->db->escape($value['title']) . "',  meta_keyword = '".$value['meta_keyword']."', description = '" . $this->db->escape($value['description']) . "', short_description = '" . $this->db->escape($value['short_description']) . "'");
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'post_id=" . (int)$post_id. "'");
		
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'post_id=" . (int)$post_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
		//--------------------
		$this->db->query("DELETE FROM " . DB_PREFIX . "post_related WHERE post_id = '" . (int)$post_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "post_related WHERE related_id = '" . (int)$post_id . "'");

		if (isset($data['post_related'])) {
			foreach ($data['post_related'] as $related_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "post_related WHERE post_id = '" . (int)$post_id . "' AND related_id = '" . (int)$related_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "post_related SET post_id = '" . (int)$post_id . "', related_id = '" . (int)$related_id . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "post_related WHERE post_id = '" . (int)$related_id . "' AND related_id = '" . (int)$post_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "post_related SET post_id = '" . (int)$related_id . "', related_id = '" . (int)$post_id . "'");
			}
		}
		//--------------------
		$this->db->query("DELETE FROM " . DB_PREFIX . "post_to_thread WHERE post_id = '" . (int)$post_id . "'");
		
		if (isset($data['post_thread'])) {
			foreach ($data['post_thread'] as $thread_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "post_to_thread SET post_id = '" . (int)$post_id . "', thread_id = '" . (int)$thread_id . "'");
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "post_attribute WHERE post_id = '" . (int)$post_id . "'");

		if (!empty($data['post_attribute'])) {
			foreach ($data['post_attribute'] as $post_attribute) {
				if ($post_attribute['attribute_id']) {
					foreach ($post_attribute['post_attribute_description'] as $language_id => $post_attribute_description) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "post_attribute SET post_id = '" . (int)$post_id . "', attribute_id = '" . (int)$post_attribute['attribute_id'] . "', language_id = '" . (int)$language_id . "', text = '" .  $this->db->escape($post_attribute_description['text']) . "'");
					}
				}
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "post_image WHERE post_id = '" . (int)$post_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "post_image_description WHERE post_id = '" . (int)$post_id . "'");
		
		if (isset($data['post_image'])) {
			foreach ($data['post_image'] as $post_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "post_image SET post_id = '" . (int)$post_id . "', image = '" . $this->db->escape($post_image['image']) . "', sort_order = '" . (int)$post_image['sort_order'] . "'");
				
				$post_image_id = $this->db->getLastId();

				foreach ($post_image['post_image_description'] as $language_id => $post_image_description) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "post_image_description SET post_image_id = '" . (int)$post_image_id . "', language_id = '" . (int)$language_id . "', post_id = '" . (int)$post_id . "', title = '" .  $this->db->escape($post_image_description['title']) . "'");
				}
			}
		}
	}
	
	public function getPostToThreads($post_id) {
		$post_thread_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "post_to_thread WHERE post_id = '" . (int)$post_id . "'");

		foreach ($query->rows as $result) {
			$post_thread_data[] = $result['thread_id'];
		}

		return $post_thread_data;
	}
	
	public function getPost($post_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'post_id=" . (int)$post_id . "') AS keyword FROM " . DB_PREFIX . "post p LEFT JOIN " . DB_PREFIX . "post_description pd ON (p.post_id = pd.post_id) WHERE p.post_id = '" . (int)$post_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}
	
	public function getPosts($data) {
		
		$sql = "SELECT * FROM " . DB_PREFIX . "post n LEFT JOIN " . DB_PREFIX . "post_description nd ON n.post_id = nd.post_id WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		
	
		if (!empty($data['filter_name'])) {
			$sql .= " AND (nd.title LIKE '%" . $this->db->escape($data['filter_name']) . "%'
							or nd.short_description LIKE '%" . $this->db->escape($data['filter_name']) . "%')";
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND n.status = '" . (int)$data['filter_status'] . "'";
		}
		if (isset($data['filter_author']) && !is_null($data['filter_author'])) {
			$sql .= " AND n.user_id = '" . (int)$data['filter_author'] . "'";
		}
		
		$sort_data = array(
			'nd.title',
			'n.date_added',
			'n.status',
			'nd.short_description'
		);
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY n.post_id";
		}

		if (isset($data['order'])) {
			$sql .= " ".$data['order'];
		} else {
			$sql .= " DESC";
		}
		
		
		if (isset($data['start']) && isset($data['limit'])) {
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
	
	public function getPostDescription($post_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "post_description WHERE post_id = '" . (int)$post_id . "'"); 
		
		foreach ($query->rows as $result) {
			$post_description[$result['language_id']] = array(
				'title'       			=> $result['title'],
				'short_description'		=> $result['short_description'],
				'description' 			=> $result['description'],
				'meta_keyword' 			=> $result['meta_keyword']
			);
		}
		
		return $post_description;
	}
	
	public function getPostAttributes($post_id) {
		$post_attribute_data = array();

		$post_attribute_query = $this->db->query("SELECT attribute_id FROM " . DB_PREFIX . "post_attribute WHERE post_id = '" . (int)$post_id . "' GROUP BY attribute_id");

		foreach ($post_attribute_query->rows as $post_attribute) {
			$post_attribute_description_data = array();

			$post_attribute_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "post_attribute WHERE post_id = '" . (int)$post_id . "' AND attribute_id = '" . (int)$post_attribute['attribute_id'] . "'");

			foreach ($post_attribute_description_query->rows as $post_attribute_description) {
				$post_attribute_description_data[$post_attribute_description['language_id']] = array('text' => $post_attribute_description['text']);
			}

			$post_attribute_data[] = array(
				'attribute_id'                  => $post_attribute['attribute_id'],
				'post_attribute_description' => $post_attribute_description_data
			);
		}

		return $post_attribute_data;
	}
	
	public function getPostImages($post_id) {
		$post_image_data = array();

		$post_image_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "post_image WHERE post_id = '" . (int)$post_id . "' ORDER BY sort_order ASC");

		foreach ($post_image_query->rows as $post_image) {
			$post_image_description_data = array();

			$post_image_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "post_image_description WHERE post_image_id = '" . (int)$post_image['post_image_id'] . "' AND post_id = '" . (int)$post_id . "'");

			foreach ($post_image_description_query->rows as $post_image_description) {
				$post_image_description_data[$post_image_description['language_id']] = array('title' => $post_image_description['title']);
			}

			$post_image_data[] = array(
				'post_image_description' => $post_image_description_data,
				'image'                    => $post_image['image'],
				'sort_order'               => $post_image['sort_order']
			);
		}

		return $post_image_data;
	}
   
	public function deletePost($post_id) {

		$this->db->query("DELETE FROM " . DB_PREFIX . "post WHERE post_id = '" . (int)$post_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "post_description WHERE post_id = '" . (int)$post_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "post_related WHERE post_id = '" . (int)$post_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "post_related WHERE post_id = '" . (int)$post_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "post_to_thread WHERE post_id = '" . (int)$post_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "reviewpost WHERE post_id = '" . (int)$post_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'post_id=" . (int)$post_id. "'");
		$this->cache->delete('post');
	}
   
	public function getTotalPost($data) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "post n LEFT JOIN " . DB_PREFIX . "post_description nd ON n.post_id = nd.post_id WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		
	
		if (!empty($data['filter_name'])) {
			$sql .= " AND (nd.title LIKE '%" . $this->db->escape($data['filter_name']) . "%'
							or nd.short_description LIKE '%" . $this->db->escape($data['filter_name']) . "%')";
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND n.status = '" . (int)$data['filter_status'] . "'";
		}
		if (isset($data['filter_author']) && !is_null($data['filter_author'])) {
			$sql .= " AND n.user_id = '" . (int)$data['filter_author'] . "'";
		}
		
		$query = $this->db->query($sql);

	
		return $query->row['total'];
	}
	
	public function getTotalPostByAttributeId($attribute_id = 0){
		$query = $this->db->query("SELECT COUNT(*) as total FROM " . DB_PREFIX . "post_attribute WHERE attribute_id = '" . (int)$attribute_id . "'");
		
		return $query->row['total'];
	}
	
	public function getPostRelated($post_id) {
		$post_related_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "post_related WHERE post_id = '" . (int)$post_id . "'");

		foreach ($query->rows as $result) {
			$post_related_data[] = $result['related_id'];
		}

		return $post_related_data;
	}
}