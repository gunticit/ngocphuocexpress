<?php
class ModelCatalogdocument extends Model {
	public function adddocument($data) {
		$this->event->trigger('pre.admin.document.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "document SET status = '" . (int)$data['status'] . "'");

		$document_id = $this->db->getLastId();

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "document SET image = '" . $this->db->escape($data['image']) . "' WHERE document_id = '" . (int)$document_id . "'");
		}

		if (isset($data['mota'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "document SET mota = '" . $this->db->escape($data['mota']) . "' WHERE document_id = '" . (int)$document_id . "'");
		}
		
		if (isset($data['sort'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "document SET sort = '" . (int)($data['sort']) . "' WHERE document_id = '" . (int)$document_id . "'");
		}

		foreach ($data['document_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "document_description SET document_id = '" . (int)$document_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) ."'");
		}

		if (isset($data['document_image'])) {
			foreach ($data['document_image'] as $document_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "document_image SET document_id = '" . (int)$document_id . "', tendocument = '" . $this->db->escape($document_image['tendocument']) . "', image = '" . $this->db->escape($document_image['image']) . "', sort_order = '" . (int)$document_image['sort_order'] . "'");
			}
		}

		if (!empty($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'document_id=" . (int)$document_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}else{
			$language_id = (int)$this->config->get('config_language_id');
			
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'document_id=" . (int)$document_id . "', keyword = '" . $this->db->escape(seo_alias($data['document_description'][$language_id]['name'])) . "'");
		}

		$this->cache->delete('document');

		$this->event->trigger('post.admin.document.add', $document_id);

		return $document_id;
	}

	public function editdocument($document_id, $data) {
		$this->event->trigger('pre.admin.document.edit', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "document SET status = '" . (int)$data['status'] . "' WHERE document_id = '" . (int)$document_id . "'");
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "document SET image = '" . $this->db->escape($data['image']) . "' WHERE document_id = '" . (int)$document_id . "'");
		}

		if (isset($data['mota'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "document SET mota = '" . $this->db->escape($data['mota']) . "' WHERE document_id = '" . (int)$document_id . "'");
		}

		if (isset($data['sort'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "document SET sort = '" . (int)($data['sort']) . "' WHERE document_id = '" . (int)$document_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "document_description WHERE document_id = '" . (int)$document_id . "'");

		foreach ($data['document_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "document_description SET document_id = '" . (int)$document_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}
		$this->db->query("DELETE FROM " . DB_PREFIX . "document_image WHERE document_id = '" . (int)$document_id . "'");

		if (isset($data['document_image'])) {
			foreach ($data['document_image'] as $document_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "document_image SET document_id = '" . (int)$document_id . "', tendocument = '" . $this->db->escape($document_image['tendocument'])  . "', image = '" . $this->db->escape($document_image['image']) . "', sort_order = '" . (int)$document_image['sort_order'] . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'document_id=" . (int)$document_id . "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'document_id=" . (int)$document_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('document');

		$this->event->trigger('post.admin.document.edit', $document_id);
	}

	public function deletedocument($document_id) {
		$this->event->trigger('pre.admin.document.delete', $document_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "document WHERE document_id = '" . (int)$document_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "document_description WHERE document_id = '" . (int)$document_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "document_image WHERE document_id = '" . (int)$document_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'document_id=" . (int)$document_id . "'");
		$this->cache->delete('document');

		$this->event->trigger('post.admin.document.delete', $document_id);
	}


	public function getdocument($document_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'document_id=" . (int)$document_id . "') AS keyword FROM " . DB_PREFIX . "document c LEFT JOIN " . DB_PREFIX . "document_description cd2 ON (c.document_id = cd2.document_id) WHERE c.document_id = '" . (int)$document_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getdocuments($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "document_description cd2 LEFT JOIN " . DB_PREFIX . "document c ON (c.document_id = cd2.document_id) WHERE cd2.language_id = '" . (int)$this->config->get('config_language_id') . "' ";


		if (!empty($data['filter_name'])) {
			$sql .= " AND cd2.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		$sql .= " GROUP BY cd2.document_id ";

		$sort_data = array(
			'name',
			
		);

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

	public function getdocumentDescriptions($document_id) {
		$document_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "document_description WHERE document_id = '" . (int)$document_id . "'");

		foreach ($query->rows as $result) {
			$document_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
			);
		}

		return $document_description_data;
	}

	public function getTotaldocument() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "document");

		return $query->row['total'];
	}

	public function getdocumentImages($document_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "document_image WHERE document_id = '" . (int)$document_id . "' ORDER BY sort_order ASC");

		return $query->rows;
	}
	

}
