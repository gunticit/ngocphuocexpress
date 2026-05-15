<?php
class ModelCataloggallery extends Model {
	public function addgallery($data) {
		$this->event->trigger('pre.admin.gallery.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "gallery SET status = '" . (int)$data['status'] . "'");

		$gallery_id = $this->db->getLastId();

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "gallery SET image = '" . $this->db->escape($data['image']) . "' WHERE gallery_id = '" . (int)$gallery_id . "'");
		}
		
		foreach ($data['gallery_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "gallery_description SET gallery_id = '" . (int)$gallery_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) ."'");
		}

		if (isset($data['gallery_image'])) {
			foreach ($data['gallery_image'] as $gallery_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "gallery_image SET gallery_id = '" . (int)$gallery_id . "', image = '" . $this->db->escape($gallery_image['image']) . "', sort_order = '" . (int)$gallery_image['sort_order'] . "'");
			}
		}

		if (!empty($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'gallery_id=" . (int)$gallery_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}else{
			$language_id = (int)$this->config->get('config_language_id');
			
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'gallery_id=" . (int)$gallery_id . "', keyword = '" . $this->db->escape(seo_alias($data['gallery_description'][$language_id]['name'])) . "'");
		}

		$this->cache->delete('gallery');

		$this->event->trigger('post.admin.gallery.add', $gallery_id);

		return $gallery_id;
	}

	public function editgallery($gallery_id, $data) {
		$this->event->trigger('pre.admin.gallery.edit', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "gallery SET status = '" . (int)$data['status'] . "' WHERE gallery_id = '" . (int)$gallery_id . "'");
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "gallery SET image = '" . $this->db->escape($data['image']) . "' WHERE gallery_id = '" . (int)$gallery_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "gallery_description WHERE gallery_id = '" . (int)$gallery_id . "'");

		foreach ($data['gallery_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "gallery_description SET gallery_id = '" . (int)$gallery_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}
		$this->db->query("DELETE FROM " . DB_PREFIX . "gallery_image WHERE gallery_id = '" . (int)$gallery_id . "'");

		if (isset($data['gallery_image'])) {
			foreach ($data['gallery_image'] as $gallery_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "gallery_image SET gallery_id = '" . (int)$gallery_id . "', image = '" . $this->db->escape($gallery_image['image']) . "', sort_order = '" . (int)$gallery_image['sort_order'] . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'gallery_id=" . (int)$gallery_id . "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'gallery_id=" . (int)$gallery_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('gallery');

		$this->event->trigger('post.admin.gallery.edit', $gallery_id);
	}

	public function deletegallery($gallery_id) {
		$this->event->trigger('pre.admin.gallery.delete', $gallery_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "gallery WHERE gallery_id = '" . (int)$gallery_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "gallery_description WHERE gallery_id = '" . (int)$gallery_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "gallery_image WHERE gallery_id = '" . (int)$gallery_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'gallery_id=" . (int)$gallery_id . "'");
		$this->cache->delete('gallery');

		$this->event->trigger('post.admin.gallery.delete', $gallery_id);
	}


	public function getgallery($gallery_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'gallery_id=" . (int)$gallery_id . "') AS keyword FROM " . DB_PREFIX . "gallery c LEFT JOIN " . DB_PREFIX . "gallery_description cd2 ON (c.gallery_id = cd2.gallery_id) WHERE c.gallery_id = '" . (int)$gallery_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getgallerys($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "gallery_description cd2 LEFT JOIN " . DB_PREFIX . "gallery c ON (c.gallery_id = cd2.gallery_id) WHERE cd2.language_id = '" . (int)$this->config->get('config_language_id') . "' ";


		if (!empty($data['filter_name'])) {
			$sql .= " AND cd2.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		$sql .= " GROUP BY cd2.gallery_id ";

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

	public function getgalleryDescriptions($gallery_id) {
		$gallery_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "gallery_description WHERE gallery_id = '" . (int)$gallery_id . "'");

		foreach ($query->rows as $result) {
			$gallery_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
			);
		}

		return $gallery_description_data;
	}

	public function getTotalgallery() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "gallery");

		return $query->row['total'];
	}

	public function getgalleryImages($gallery_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "gallery_image WHERE gallery_id = '" . (int)$gallery_id . "' ORDER BY sort_order ASC");

		return $query->rows;
	}
	

}
