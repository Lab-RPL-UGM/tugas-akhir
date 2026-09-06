<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bidang_model extends CI_Model
{
    public function getBidang($id = NULL)
    {
        $this->db->select("*");
        $this->db->from('bidang');
        $this->db->where('isDeleted', 0);
        if ($id != NULL) {
            $this->db->where('id_bidang', $id);
        } else {
            $this->db->order_by('nama', 'ASC');
        }
        $query = $this->db->get();

        return $query->result();
    }

    public function insert($data)
    {
        $this->db->trans_start();
        $this->db->insert('bidang', $data);
        $this->db->trans_complete();
        $result = $this->db->trans_status();

        return $result;
    }

    public function update($data, $id)
    {
        $this->db->trans_start();
        $this->db->where('id_bidang', $id);
        $this->db->update('bidang', $data);
        $this->db->trans_complete();
        $result = $this->db->trans_status();

        return $result;
    }

    public function delete($id)
    {
        $this->db->trans_start();
        $this->db->set('isDeleted', 1);
        $this->db->where('id_bidang', $id);
        $this->db->update('bidang');
        $this->db->trans_complete();
        $result = $this->db->trans_status();

        return $result;
    }
}
