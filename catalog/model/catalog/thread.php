<?php
class ModelCatalogthread extends Model {
	public function getThread($thread_id) {
		
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "thread t LEFT JOIN " . DB_PREFIX . "thread_description td ON (t.thread_id = td.thread_id) LEFT JOIN " . DB_PREFIX . "thread_to_store t2s ON (t.thread_id = t2s.thread_id) WHERE t.thread_id = '" . (int)$thread_id . "' AND td.language_id = '" . (int)$this->config->get('config_language_id') . "' AND t2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND t.status = '1'");
		return $query->row;
	}

	public function getThreads($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "thread t LEFT JOIN " . DB_PREFIX . "thread_description td ON (t.thread_id = td.thread_id) LEFT JOIN " . DB_PREFIX . "thread_to_store t2s ON (t.thread_id = t2s.thread_id) WHERE td.language_id = '" . (int)$this->config->get('config_language_id') . "' AND t2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  AND t.status = '1'";
		
		if (!empty($data['parent_id'])) {
			$sql .= " AND t.parent_id = '" . (int)$data['parent_id'] . "'";
		}
		
		$sql .= " ORDER BY t.sort_order, LCASE(td.name)";
		
		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getThreadFilters($thread_id) {
		$implode = array();

		$query = $this->db->query("SELECT filter_id FROM " . DB_PREFIX . "thread_filter WHERE thread_id = '" . (int)$thread_id . "'");

		foreach ($query->rows as $result) {
			$implode[] = (int)$result['filter_id'];
		}

		$filter_group_data = array();

		if ($implode) {
			$filter_group_query = $this->db->query("SELECT DISTINCT f.filter_group_id, fgd.name, fg.sort_order FROM " . DB_PREFIX . "filter f LEFT JOIN " . DB_PREFIX . "filter_group fg ON (f.filter_group_id = fg.filter_group_id) LEFT JOIN " . DB_PREFIX . "filter_group_description fgd ON (fg.filter_group_id = fgd.filter_group_id) WHERE f.filter_id IN (" . implode(',', $implode) . ") AND fgd.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY f.filter_group_id ORDER BY fg.sort_order, LCASE(fgd.name)");

			foreach ($filter_group_query->rows as $filter_group) {
				$filter_data = array();

				$filter_query = $this->db->query("SELECT DISTINCT f.filter_id, fd.name FROM " . DB_PREFIX . "filter f LEFT JOIN " . DB_PREFIX . "filter_description fd ON (f.filter_id = fd.filter_id) WHERE f.filter_id IN (" . implode(',', $implode) . ") AND f.filter_group_id = '" . (int)$filter_group['filter_group_id'] . "' AND fd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY f.sort_order, LCASE(fd.name)");

				foreach ($filter_query->rows as $filter) {
					$filter_data[] = array(
						'filter_id' => $filter['filter_id'],
						'name'      => $filter['name']
					);
				}

				if ($filter_data) {
					$filter_group_data[] = array(
						'filter_group_id' => $filter_group['filter_group_id'],
						'name'            => $filter_group['name'],
						'filter'          => $filter_data
					);
				}
			}
		}

		return $filter_group_data;
	}

	public function getThreadLayoutId($thread_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "thread_to_layout WHERE thread_id = '" . (int)$thread_id . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			return $query->row['layout_id'];
		} else {
			return 0;
		}
	}
	
	public function getTotalThreadsByThreadId($parent_id = 0) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "thread t LEFT JOIN " . DB_PREFIX . "thread_to_store t2s ON (t.thread_id = t2s.thread_id) WHERE t.parent_id = '" . (int)$parent_id . "' AND t2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND t.status = '1'");

		return $query->row['total'];
	}
}