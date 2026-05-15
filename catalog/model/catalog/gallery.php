<?php
class ModelCataloggallery extends Model {
	public function getgallery($gallery_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "gallery c LEFT JOIN " . DB_PREFIX . "gallery_description cd ON (c.gallery_id = cd.gallery_id) WHERE c.gallery_id = '" . (int)$gallery_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c.status = '1'");

		return $query->row;
	}

	public function getgallerys() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "gallery c LEFT JOIN " . DB_PREFIX . "gallery_description cd ON (c.gallery_id = cd.gallery_id) WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c.status = '1' ORDER BY c.gallery_id");

		return $query->rows;
	}

	public function getTotalgallerys() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "gallery");

		return $query->row['total'];
	}

	public function getgalleryss($data = array()) {

		$sql = "SELECT * FROM " . DB_PREFIX . "gallery c LEFT JOIN " . DB_PREFIX . "gallery_description cd ON (c.gallery_id = cd.gallery_id) WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c.status = '1' ORDER BY c.gallery_id ";


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

	public function getgalleryImages($gallery_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "gallery_image WHERE gallery_id = '" . (int)$gallery_id . "' ORDER BY sort_order ASC");

		return $query->rows;
	}

}