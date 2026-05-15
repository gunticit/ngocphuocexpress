<?php
class ModelCatalogBooking extends Model {
	public function getBookingDateHours($id_booking){
		$sql = "SELECT * FROM ".DB_PREFIX."booking_hour WHERE `id_booking` = '".$id_booking."'";
		$query = $this->db->query($sql);
		$data = array();
		foreach($query->rows as $row){
			$data[] = array(
				'date_booking' => $row['date_booking'],
				'hour_booking' => $row['hour_booking'],
				'price' => $row['price'],
			);
		}
		return $data;
	}
	public function editBooking($id_booking, $data) {
		$this->event->trigger('pre.admin.booking.edit', $data);
		$this->db->query("UPDATE " . DB_PREFIX . "booking SET  note_admin = '" . $data['note_admin'] . "', status = '" . (int)$data['status'] . "' WHERE id_booking = '" . (int)$id_booking . "'");
		
		$this->cache->delete('booking');
		$this->event->trigger('post.admin.booking.edit', $id_booking);
	}
	public function getBooking($id_booking) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "booking WHERE id_booking = '" . (int)$id_booking . "'");
		return $query->row;
	}
	public function getBookings($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "booking WHERE 1";
		if (!empty($data['filter_date'])) {
			$sql .= " AND date_booking LIKE '" . $this->db->escape($data['filter_date']) . "%'";
		}
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND status = '" . (int)$data['filter_status'] . "'";
		}
		$sql .= " GROUP BY id_booking";
		$sort_data = array(
			'date_booking',
			'status',
			'sort_order'
		);
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY date_booking";
		}
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " DESC";
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

	public function getTotalBookings($data = array()) {
		$sql = "SELECT COUNT(DISTINCT id_booking) AS total FROM " . DB_PREFIX . "booking WHERE 1";
		if (!empty($data['filter_date'])) {
			$sql .= " AND date_booking LIKE '" . $this->db->escape($data['filter_date']) . "%'";
		}
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND status = '" . (int)$data['filter_status'] . "'";
		}
		$query = $this->db->query($sql);
		return $query->row['total'];
	}
}