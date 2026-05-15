<?php
class ModelCatalogvideo extends Model {
	public function getvideo($video_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "video c LEFT JOIN " . DB_PREFIX . "video_description cd ON (c.video_id = cd.video_id) WHERE c.video_id = '" . (int)$video_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c.status = '1'");

		return $query->row;
	}

	public function getvideos() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "video c LEFT JOIN " . DB_PREFIX . "video_description cd ON (c.video_id = cd.video_id) WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c.status = '1' ORDER BY c.video_id");

		return $query->rows;
	}

	public function getTotalvideos() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "video");

		return $query->row['total'];
	}

	public function getvideoss($data = array()) {

		$sql = "SELECT * FROM " . DB_PREFIX . "video c LEFT JOIN " . DB_PREFIX . "video_description cd ON (c.video_id = cd.video_id) WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c.status = '1' ORDER BY c.video_id ";


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

	public function getvideoImages($video_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "video_image WHERE video_id = '" . (int)$video_id . "' ORDER BY sort_order ASC");

		return $query->rows;
	}

}