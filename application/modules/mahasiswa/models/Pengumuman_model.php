<?php
/**
 * Created by nad.
 * Date: 26/03/2018
 * Time: 12:18
 * Description:
 */

class Pengumuman_model extends CI_Model
{
    /**
     * This function is used to get the pengumuman by id
     * @return $result : This is result
     */
    function getPengumumanList($id = NULL){
        $this->db->select("*");
        $this->db->from('pengumuman');
        if($id != NULL){
            $this->db->where('id_pengumuman',$id);
        }
        $query = $this->db->get();
        return $query->result();
    }
}