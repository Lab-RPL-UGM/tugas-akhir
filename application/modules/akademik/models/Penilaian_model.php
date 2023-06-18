<?php
/**
 * Created by nad.
 * Date: 03/04/2018
 * Time: 11:32
 * Description:
 */

class Penilaian_model extends CI_Model
{
//    get all items in komponen penilaian
    public function getKomponen($id = NULL){
        $this->db->select("*");
        $this->db->from('komponen');
        if($id != NULL){
            $this->db->where('id_komponen',$id);
        }
        $query = $this->db->get();

        return $query->result();
    }
//    add new komponen penilaian
    public function insert($data)
    {
        $this->db->trans_start();
        $this->db->insert('komponen', $data);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
//    update komponen penilaian
    public function update($data,$id){
        $this->db->trans_start();
        $this->db->where('id_komponen',$id);
        $this->db->update('komponen',$data);
        $this->db->trans_complete();
        $result = $this->db->trans_status();

        return $result;
    }
//    non-active syarat komponen penilaian
    public function off($id){
        $this->db->trans_start();

        $this->db->set('isDeleted',1);
        $this->db->where('id_komponen',$id);
        $this->db->update('komponen');

        $this->db->trans_complete();
        $result = $this->db->trans_status();

        return $result;
    }
//    active syarat komponen penilaian
    public function on($id){
        $this->db->trans_start();

        $this->db->set('isDeleted',0);
        $this->db->where('id_komponen',$id);
        $this->db->update('komponen');

        $this->db->trans_complete();
        $result = $this->db->trans_status();

        return $result;
    }
}