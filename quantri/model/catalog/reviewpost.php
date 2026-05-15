<?php
class ModelCatalogReviewpost extends Model {
	public function addReviewpost($data) {
		$this->event->trigger('pre.admin.reviewpost.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "reviewpost SET author = '" . $this->db->escape($data['author']) . "', post_id = '" . (int)$data['post_id'] . "', text = '" . $this->db->escape(strip_tags($data['text'])) . "', rating = '" . (int)$data['rating'] . "', status = '" . (int)$data['status'] . "', date_added = NOW()");

		$reviewpost_id = $this->db->getLastId();

		$this->cache->delete('post');

		$this->event->trigger('post.admin.reviewpost.add', $reviewpost_id);

		return $reviewpost_id;
	}

	public function editReviewpost($reviewpost_id, $data) {
		$this->event->trigger('pre.admin.reviewpost.edit', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "reviewpost SET author = '" . $this->db->escape($data['author']) . "', post_id = '" . (int)$data['post_id'] . "', text = '" . $this->db->escape(strip_tags($data['text'])) . "', rating = '" . (int)$data['rating'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE reviewpost_id = '" . (int)$reviewpost_id . "'");

		$this->cache->delete('post');

		$this->event->trigger('post.admin.reviewpost.edit', $reviewpost_id);
	}

	public function deleteReviewpost($reviewpost_id) {
		$this->event->trigger('pre.admin.reviewpost.delete', $reviewpost_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "reviewpost WHERE reviewpost_id = '" . (int)$reviewpost_id . "'");

		$this->cache->delete('post');

		$this->event->trigger('post.admin.reviewpost.delete', $reviewpost_id);
	}

	public function getReviewpost($reviewpost_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT pd.title FROM " . DB_PREFIX . "post_description pd WHERE pd.post_id = r.post_id AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS post FROM " . DB_PREFIX . "reviewpost r WHERE r.reviewpost_id = '" . (int)$reviewpost_id . "'");

		return $query->row;
	}

	public function getReviewspost($data = array()) {
		$sql = "SELECT r.reviewpost_id, r.text, pd.title, r.author, r.rating, r.status, r.date_added FROM " . DB_PREFIX . "reviewpost r LEFT JOIN " . DB_PREFIX . "post_description pd ON (r.post_id = pd.post_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		
		if (!empty($data['filter_post'])) {
			$sql .= " AND pd.title LIKE '" . $this->db->escape($data['filter_post']) . "%'";
		}

		if (!empty($data['filter_author'])) {
			$sql .= " AND r.author LIKE '" . $this->db->escape($data['filter_author']) . "%'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND r.status = '" . (int)$data['filter_status'] . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(r.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		$sort_data = array(
			'pd.title',
			'r.author',
			'r.rating',
			'r.status',
			'r.date_added'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY r.date_added";
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
 
	public function getTotalReviewspost($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "reviewpost r LEFT JOIN " . DB_PREFIX . "post_description pd ON (r.post_id = pd.post_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_post'])) {
			$sql .= " AND pd.title LIKE '" . $this->db->escape($data['filter_post']) . "%'";
		}

		if (!empty($data['filter_author'])) {
			$sql .= " AND r.author LIKE '" . $this->db->escape($data['filter_author']) . "%'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND r.status = '" . (int)$data['filter_status'] . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(r.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getTotalReviewspostAwaitingApproval() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "reviewpost WHERE status = '0'");

		return $query->row['total'];
	}
}