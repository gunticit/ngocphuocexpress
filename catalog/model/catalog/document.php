<?php
class ModelCatalogdocument extends Model {
	public function getdocument($document_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "document c LEFT JOIN " . DB_PREFIX . "document_description cd ON (c.document_id = cd.document_id) WHERE c.document_id = '" . (int)$document_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c.status = '1'");

		return $query->row;
	}

	public function getdocuments() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "document c LEFT JOIN " . DB_PREFIX . "document_description cd ON (c.document_id = cd.document_id) WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c.status = '1' ORDER BY c.document_id");

		return $query->rows;
	}

	public function getTotaldocuments() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "document");

		return $query->row['total'];
	}

	public function getdocumentss($data = array()) {

		$sql = "SELECT * FROM " . DB_PREFIX . "document c LEFT JOIN " . DB_PREFIX . "document_description cd ON (c.document_id = cd.document_id) WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c.status = '1' ORDER BY c.document_id ";


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

	public function getdocumentImages($document_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "document_image WHERE document_id = '" . (int)$document_id . "' ORDER BY sort_order ASC");

		return $query->rows;
	}

}