<?php
class ModelCatalogvideo extends Model {
	public function addvideo($data) {
		$this->event->trigger('pre.admin.video.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "video SET status = '" . (int)$data['status'] . "'");

		$video_id = $this->db->getLastId();

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "video SET image = '" . $this->db->escape($data['image']) . "' WHERE video_id = '" . (int)$video_id . "'");
		}
		
		foreach ($data['video_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "video_description SET video_id = '" . (int)$video_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) ."'");
		}

		if (isset($data['video_image'])) {
			foreach ($data['video_image'] as $video_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "video_image SET video_id = '" . (int)$video_id . "', tenvideo = '" . $this->db->escape($video_image['tenvideo']) . "', image = '" . $this->db->escape($video_image['image']) . "', sort_order = '" . (int)$video_image['sort_order'] . "'");
			}
		}

		if (!empty($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'video_id=" . (int)$video_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}else{
			$language_id = (int)$this->config->get('config_language_id');
			
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'video_id=" . (int)$video_id . "', keyword = '" . $this->db->escape(seo_alias($data['video_description'][$language_id]['name'])) . "'");
		}

		$this->cache->delete('video');

		$this->event->trigger('post.admin.video.add', $video_id);

		return $video_id;
	}

	public function editvideo($video_id, $data) {
		$this->event->trigger('pre.admin.video.edit', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "video SET status = '" . (int)$data['status'] . "' WHERE video_id = '" . (int)$video_id . "'");
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "video SET image = '" . $this->db->escape($data['image']) . "' WHERE video_id = '" . (int)$video_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "video_description WHERE video_id = '" . (int)$video_id . "'");

		foreach ($data['video_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "video_description SET video_id = '" . (int)$video_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}
		$this->db->query("DELETE FROM " . DB_PREFIX . "video_image WHERE video_id = '" . (int)$video_id . "'");

		if (isset($data['video_image'])) {
			foreach ($data['video_image'] as $video_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "video_image SET video_id = '" . (int)$video_id . "', tenvideo = '" . $this->db->escape($video_image['tenvideo']) . "', image = '" . $this->db->escape($video_image['image']) . "', sort_order = '" . (int)$video_image['sort_order'] . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'video_id=" . (int)$video_id . "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'video_id=" . (int)$video_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('video');

		$this->event->trigger('post.admin.video.edit', $video_id);
	}

	public function deletevideo($video_id) {
		$this->event->trigger('pre.admin.video.delete', $video_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "video WHERE video_id = '" . (int)$video_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "video_description WHERE video_id = '" . (int)$video_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "video_image WHERE video_id = '" . (int)$video_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'video_id=" . (int)$video_id . "'");
		$this->cache->delete('video');

		$this->event->trigger('post.admin.video.delete', $video_id);
	}


	public function getvideo($video_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'video_id=" . (int)$video_id . "') AS keyword FROM " . DB_PREFIX . "video c LEFT JOIN " . DB_PREFIX . "video_description cd2 ON (c.video_id = cd2.video_id) WHERE c.video_id = '" . (int)$video_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getvideos($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "video_description cd2 LEFT JOIN " . DB_PREFIX . "video c ON (c.video_id = cd2.video_id) WHERE cd2.language_id = '" . (int)$this->config->get('config_language_id') . "' ";


		if (!empty($data['filter_name'])) {
			$sql .= " AND cd2.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		$sql .= " GROUP BY cd2.video_id ";

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

	public function getvideoDescriptions($video_id) {
		$video_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "video_description WHERE video_id = '" . (int)$video_id . "'");

		foreach ($query->rows as $result) {
			$video_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
			);
		}

		return $video_description_data;
	}

	public function getTotalvideo() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "video");

		return $query->row['total'];
	}

	public function getvideoImages($video_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "video_image WHERE video_id = '" . (int)$video_id . "' ORDER BY sort_order ASC");

		return $query->rows;
	}
	

}
