<?php
class ModelCatalogthread extends Model {
	public function addThread($data) {
		$this->event->trigger('pre.admin.thread.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "thread SET parent_id = '" . (int)$data['parent_id'] . "', `child` = '" . (isset($data['child']) ? (int)$data['child'] : 0) . "', `format` = '" . $this->db->escape($data['format']) . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW(), date_added = NOW()");

		$thread_id = $this->db->getLastId();

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "thread SET image = '" . $this->db->escape($data['image']) . "' WHERE thread_id = '" . (int)$thread_id . "'");
		}

		foreach ($data['thread_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "thread_description SET thread_id = '" . (int)$thread_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		// MySQL Hierarchical Data Closure Table Pattern
		$level = 0;

		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "thread_path` WHERE thread_id = '" . (int)$data['parent_id'] . "' ORDER BY `level` ASC");

		foreach ($query->rows as $result) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "thread_path` SET `thread_id` = '" . (int)$thread_id . "', `path_id` = '" . (int)$result['path_id'] . "', `level` = '" . (int)$level . "'");

			$level++;
		}

		$this->db->query("INSERT INTO `" . DB_PREFIX . "thread_path` SET `thread_id` = '" . (int)$thread_id . "', `path_id` = '" . (int)$thread_id . "', `level` = '" . (int)$level . "'");

		if (isset($data['thread_filter'])) {
			foreach ($data['thread_filter'] as $filter_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "thread_filter SET thread_id = '" . (int)$thread_id . "', filter_id = '" . (int)$filter_id . "'");
			}
		}

		if (isset($data['thread_store'])) {
			foreach ($data['thread_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "thread_to_store SET thread_id = '" . (int)$thread_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		// Set which layout to use with this thread
		if (isset($data['thread_layout'])) {
			foreach ($data['thread_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "thread_to_layout SET thread_id = '" . (int)$thread_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}
		
		if (!empty($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'thread_id=" . (int)$thread_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}else{
			$language_id = (int)$this->config->get('config_language_id');
			
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'thread_id=" . (int)$thread_id . "', keyword = '" . $this->db->escape(seo_alias($data['thread_description'][$language_id]['name'])) . "'");
		}

		$this->cache->delete('thread');

		$this->event->trigger('post.admin.thread.add', $thread_id);

		return $thread_id;
	}

	public function editThread($thread_id, $data) {
		$this->event->trigger('pre.admin.thread.edit', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "thread SET parent_id = '" . (int)$data['parent_id'] . "', `child` = '" . (isset($data['child']) ? (int)$data['child'] : 0) . "', `format` = '" . $this->db->escape($data['format']) . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE thread_id = '" . (int)$thread_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "thread SET image = '" . $this->db->escape($data['image']) . "' WHERE thread_id = '" . (int)$thread_id . "'");
		}
		//-----------------------------------------
		$this->db->query("DELETE FROM " . DB_PREFIX . "user_to_thread WHERE thread_id = '" . (int)$thread_id . "'");
		if (isset($data['post_thread'])) {
			foreach ($data['post_thread'] as $user_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "user_to_thread SET thread_id = '" . (int)$thread_id . "', user_id = '" . (int)$user_id . "'");
			}
		}
		//----------------------------------------
		$this->db->query("DELETE FROM " . DB_PREFIX . "thread_description WHERE thread_id = '" . (int)$thread_id . "'");

		foreach ($data['thread_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "thread_description SET thread_id = '" . (int)$thread_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		// MySQL Hierarchical Data Closure Table Pattern
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "thread_path` WHERE path_id = '" . (int)$thread_id . "' ORDER BY level ASC");

		if ($query->rows) {
			foreach ($query->rows as $thread_path) {
				// Delete the path below the current one
				$this->db->query("DELETE FROM `" . DB_PREFIX . "thread_path` WHERE thread_id = '" . (int)$thread_path['thread_id'] . "' AND level < '" . (int)$thread_path['level'] . "'");

				$path = array();

				// Get the nodes new parents
				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "thread_path` WHERE thread_id = '" . (int)$data['parent_id'] . "' ORDER BY level ASC");

				foreach ($query->rows as $result) {
					$path[] = $result['path_id'];
				}

				// Get whats left of the nodes current path
				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "thread_path` WHERE thread_id = '" . (int)$thread_path['thread_id'] . "' ORDER BY level ASC");

				foreach ($query->rows as $result) {
					$path[] = $result['path_id'];
				}

				// Combine the paths with a new level
				$level = 0;

				foreach ($path as $path_id) {
					$this->db->query("REPLACE INTO `" . DB_PREFIX . "thread_path` SET thread_id = '" . (int)$thread_path['thread_id'] . "', `path_id` = '" . (int)$path_id . "', level = '" . (int)$level . "'");

					$level++;
				}
			}
		} else {
			// Delete the path below the current one
			$this->db->query("DELETE FROM `" . DB_PREFIX . "thread_path` WHERE thread_id = '" . (int)$thread_id . "'");

			// Fix for records with no paths
			$level = 0;

			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "thread_path` WHERE thread_id = '" . (int)$data['parent_id'] . "' ORDER BY level ASC");

			foreach ($query->rows as $result) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "thread_path` SET thread_id = '" . (int)$thread_id . "', `path_id` = '" . (int)$result['path_id'] . "', level = '" . (int)$level . "'");

				$level++;
			}

			$this->db->query("REPLACE INTO `" . DB_PREFIX . "thread_path` SET thread_id = '" . (int)$thread_id . "', `path_id` = '" . (int)$thread_id . "', level = '" . (int)$level . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "thread_filter WHERE thread_id = '" . (int)$thread_id . "'");

		if (isset($data['thread_filter'])) {
			foreach ($data['thread_filter'] as $filter_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "thread_filter SET thread_id = '" . (int)$thread_id . "', filter_id = '" . (int)$filter_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "thread_to_store WHERE thread_id = '" . (int)$thread_id . "'");

		if (isset($data['thread_store'])) {
			foreach ($data['thread_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "thread_to_store SET thread_id = '" . (int)$thread_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "thread_to_layout WHERE thread_id = '" . (int)$thread_id . "'");

		if (isset($data['thread_layout'])) {
			foreach ($data['thread_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "thread_to_layout SET thread_id = '" . (int)$thread_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'thread_id=" . (int)$thread_id . "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'thread_id=" . (int)$thread_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('thread');

		$this->event->trigger('post.admin.thread.edit', $thread_id);
	}

	public function deleteThread($thread_id) {
		$this->event->trigger('pre.admin.thread.delete', $thread_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "thread_path WHERE thread_id = '" . (int)$thread_id . "'");

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "thread_path WHERE path_id = '" . (int)$thread_id . "'");

		foreach ($query->rows as $result) {
			$this->deletethread($result['thread_id']);
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "thread WHERE thread_id = '" . (int)$thread_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "thread_description WHERE thread_id = '" . (int)$thread_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "thread_filter WHERE thread_id = '" . (int)$thread_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "thread_to_store WHERE thread_id = '" . (int)$thread_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "thread_to_layout WHERE thread_id = '" . (int)$thread_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "post_to_thread WHERE thread_id = '" . (int)$thread_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'thread_id=" . (int)$thread_id . "'");

		$this->cache->delete('thread');

		$this->event->trigger('post.admin.thread.delete', $thread_id);
	}

	public function repairThreads($parent_id = 0) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "thread WHERE parent_id = '" . (int)$parent_id . "'");

		foreach ($query->rows as $thread) {
			// Delete the path below the current one
			$this->db->query("DELETE FROM `" . DB_PREFIX . "thread_path` WHERE thread_id = '" . (int)$thread['thread_id'] . "'");

			// Fix for records with no paths
			$level = 0;

			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "thread_path` WHERE thread_id = '" . (int)$parent_id . "' ORDER BY level ASC");

			foreach ($query->rows as $result) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "thread_path` SET thread_id = '" . (int)$thread['thread_id'] . "', `path_id` = '" . (int)$result['path_id'] . "', level = '" . (int)$level . "'");

				$level++;
			}

			$this->db->query("REPLACE INTO `" . DB_PREFIX . "thread_path` SET thread_id = '" . (int)$thread['thread_id'] . "', `path_id` = '" . (int)$thread['thread_id'] . "', level = '" . (int)$level . "'");

			$this->repairthreads($thread['thread_id']);
		}
	}

	public function getThread($thread_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT GROUP_CONCAT(cd1.name ORDER BY level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') FROM " . DB_PREFIX . "thread_path cp LEFT JOIN " . DB_PREFIX . "thread_description cd1 ON (cp.path_id = cd1.thread_id AND cp.thread_id != cp.path_id) WHERE cp.thread_id = c.thread_id AND cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY cp.thread_id) AS path, (SELECT DISTINCT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'thread_id=" . (int)$thread_id . "') AS keyword FROM " . DB_PREFIX . "thread c LEFT JOIN " . DB_PREFIX . "thread_description cd2 ON (c.thread_id = cd2.thread_id) WHERE c.thread_id = '" . (int)$thread_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}
	
	

	public function getThreads($data = array()) {
		$sql = "SELECT cp.thread_id AS thread_id, GROUP_CONCAT(cd1.name ORDER BY cp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name, c1.parent_id, c1.sort_order FROM " . DB_PREFIX . "thread_path cp LEFT JOIN " . DB_PREFIX . "thread c1 ON (cp.thread_id = c1.thread_id) LEFT JOIN " . DB_PREFIX . "thread c2 ON (cp.path_id = c2.thread_id) LEFT JOIN " . DB_PREFIX . "thread_description cd1 ON (cp.path_id = cd1.thread_id) LEFT JOIN " . DB_PREFIX . "thread_description cd2 ON (cp.thread_id = cd2.thread_id) WHERE cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND cd2.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		$sql .= " GROUP BY cp.thread_id";

		$sort_data = array(
			'name',
			'sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY sort_order";
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
	
	
	
	
	public function getThreadDescriptions($thread_id) {
		$thread_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "thread_description WHERE thread_id = '" . (int)$thread_id . "'");

		foreach ($query->rows as $result) {
			$thread_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'meta_title'       => $result['meta_title'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword'],
				'description'      => $result['description']
			);
		}

		return $thread_description_data;
	}

	public function getThreadFilters($thread_id) {
		$thread_filter_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "thread_filter WHERE thread_id = '" . (int)$thread_id . "'");

		foreach ($query->rows as $result) {
			$thread_filter_data[] = $result['filter_id'];
		}

		return $thread_filter_data;
	}

	public function getThreadStores($thread_id) {
		$thread_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "thread_to_store WHERE thread_id = '" . (int)$thread_id . "'");

		foreach ($query->rows as $result) {
			$thread_store_data[] = $result['store_id'];
		}

		return $thread_store_data;
	}

	public function getThreadLayouts($thread_id) {
		$thread_layout_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "thread_to_layout WHERE thread_id = '" . (int)$thread_id . "'");

		foreach ($query->rows as $result) {
			$thread_layout_data[$result['store_id']] = $result['layout_id'];
		}

		return $thread_layout_data;
	}

	public function getTotalthreads() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "thread");

		return $query->row['total'];
	}
	
	public function getTotalthreadsByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "thread_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}	
}
