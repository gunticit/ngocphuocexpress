<?php
/**
 * Created by ANH To <anh.to87@gmail.com>.
 * User: baoan
 * Date: 11/7/15
 * Time: 12:20
 */

class ModelModuleAdvNewsletter extends Model
{
    public function getEmails($data = array()) {
        $sql = "SELECT * FROM " . DB_PREFIX . "email_subscribed";
        $sql .= " WHERE 1";
        if (!empty($data['filter_email'])) {
            $sql .= " AND email LIKE '%" . $this->db->escape($data['filter_email']) . "%'";
        }
        if (!empty($data['filter_status'])) {
            $sql .= " AND status IN (" . $this->db->escape($data['filter_status']) . ")";
        }
        $sql .= " ORDER BY id DESC";

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

    public function getTotalEmails($data = array()) {
        $sql = "SELECT COUNT(*) as total FROM " . DB_PREFIX . "email_subscribed";
        $sql .= " WHERE 1";
        if (!empty($data['filter_email'])) {
            $sql .= " AND email LIKE '" . $this->db->escape($data['filter_email']) . "%'";
        }
        if (!empty($data['filter_status'])) {
            $sql .= " AND status IN (" . $this->db->escape($data['filter_status']) . ")";
        }

        $query = $this->db->query($sql);

        return $query->row['total'];
    }
}