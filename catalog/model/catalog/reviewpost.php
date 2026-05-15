<?php
class ModelCatalogReviewPost extends Model {
	
	
	public function addReviewPost ($post_id, $data) {
	
		$this->event->trigger('post.reviewpost.add', $reviewpost_id);
		$this->db->query("INSERT INTO " . DB_PREFIX . "reviewpost SET status=".$data['instantly'].", author = '" . $this->db->escape($data['author']) . "', customer_id = '" . (int)$this->customer->getId() . "', post_id = '" . (int)$post_id . "', text = '" . $this->db->escape($data['text']) . "', rating = '" . (int)$data['rating'] . "', date_added = NOW()");

		$reviewpost_id = $this->db->getLastId();
		$this->event->trigger('post.reviewpost.add', $reviewpost_id);
	}

	public function getReviewsByPostId($post_id, $start = 0, $limit = 20) {
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 20;
		}

		$query = $this->db->query("SELECT r.reviewpost_id, r.author, r.rating, r.text, n.post_id,r.date_added FROM " . DB_PREFIX . "reviewpost r LEFT JOIN " . DB_PREFIX . "post n ON (r.post_id = n.post_id) LEFT JOIN " . DB_PREFIX . "post_description nd ON (n.post_id = nd.post_id) WHERE n.post_id = '" . (int)$post_id . "'  AND n.status = '1' AND r.status = '1' AND nd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY r.date_added DESC LIMIT " . (int)$start . "," . (int)$limit);
		
		return $query->rows;
	}

	public function getTotalReviewsByPostId($post_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "reviewpost r LEFT JOIN " . DB_PREFIX . "post n ON (r.post_id = n.post_id) LEFT JOIN " . DB_PREFIX . "post_description nd ON (n.post_id = nd.post_id) WHERE n.post_id = '" . (int)$post_id . "' AND n.status = '1' AND r.status = '1' AND nd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row['total'];
	}
}
