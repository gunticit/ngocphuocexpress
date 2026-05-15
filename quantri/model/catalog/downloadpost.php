<?php
class ModelCatalogDownloadpost extends Model {
	public function addDownloadpost($data) {
		$this->event->trigger('pre.admin.download.add', $data);
		$this->db->query("INSERT INTO " . DB_PREFIX . "downloadpost SET filename = '" . $this->db->escape($data['filename']) . "', mask = '" . $this->db->escape($data['mask']) . "', user_id = '" . $this->session->data['user_id'] . "', date_added = NOW()");


		$downloadpost_id = $this->db->getLastId();

		foreach ($data['downloadpost_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "downloadpost_description SET downloadpost_id = '" . (int)$downloadpost_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}

		$this->event->trigger('post.admin.download.add', $downloadpost_id);

		return $downloadpost_id;
	}

	public function editDownloadpost($downloadpost_id, $data) {
		$this->event->trigger('pre.admin.downloadpost.edit', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "downloadpost SET filename = '" . $this->db->escape($data['filename']) . "', mask = '" . $this->db->escape($data['mask']) . "' WHERE downloadpost_id = '" . (int)$downloadpost_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "downloadpost_description WHERE downloadpost_id = '" . (int)$downloadpost_id . "'");

		foreach ($data['downloadpost_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "downloadpost_description SET downloadpost_id = '" . (int)$downloadpost_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}

		$this->event->trigger('post.admin.downloadpost.edit', $downloadpost_id);
	}

	public function deleteDownloadpost($downloadpost_id) {
		$this->event->trigger('pre.admin.downloadpost.delete', $downloadpost_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "downloadpost WHERE downloadpost_id = '" . (int)$downloadpost_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "downloadpost_description WHERE downloadpost_id = '" . (int)$downloadpost_id . "'");

		$this->event->trigger('post.admin.download.delete', $downloadpost_id);
	}

	public function getDownloadpost($downloadpost_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "downloadpost d LEFT JOIN " . DB_PREFIX . "downloadpost_description dd ON (d.downloadpost_id = dd.downloadpost_id) WHERE d.downloadpost_id = '" . (int)$downloadpost_id . "' AND dd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getDownloadposts($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "downloadpost d LEFT JOIN " . DB_PREFIX . "downloadpost_description dd ON (d.downloadpost_id = dd.downloadpost_id) WHERE dd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		$sql .=" AND ((".$data['postpermission'].">=2) or (d.user_id=".$this->session->data['user_id'].")) ";	
			
		if (!empty($data['filter_name'])) {
			$sql .= " AND dd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		$sort_data = array(
			'dd.name',
			'd.date_added'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY d.date_added";
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

	public function getDownloadpostDescriptions($downloadpost_id) {
		$downloadpost_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "downloadpost_description WHERE downloadpost_id = '" . (int)$downloadpost_id . "'");

		foreach ($query->rows as $result) {
			$downloadpost_description_data[$result['language_id']] = array('name' => $result['name']);
		}

		return $downloadpost_description_data;
	}

	public function getTotalDownloadposts() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "downloadpost");

		return $query->row['total'];
	}
}