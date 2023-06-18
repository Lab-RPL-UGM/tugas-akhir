<?php
/**
 * Created by nad.
 * Date: 27/03/2018
 * Time: 21:41
 * Description:
 */

class Dashboard_model extends CI_Model
{
    /**
     * This function is used to  get pesan list related to mahasiswa
     * @param number $userId : This is user id who is logged in
     * @return array $result : This is result
     */
    function getPesanList($userId)
    {
        $this->db->select("l.*, m.id_mahasiswa, u.id_user");
        $this->db->from('log_pesan l');
        $this->db->join('mahasiswa m','m.id_mahasiswa = l.id_mahasiswa');
        $this->db->join('user u','u.id_user = m.id_user');
        $this->db->where('u.id_user',$userId);
        $this->db->order_by('l.createdDtm','desc');
        $query = $this->db->get();

        if ($query->num_rows()>0){
            return $query->result();
        }else{
            return false;
        }
    }
    /**
     * This function is used to  get revisi from Sidang related to mahasiswa
     * @param number $userId : This is user id who is logged in
     * @return array $result : This is result
     */
    function getRevisiSidang($userId)
    {
        $this->db->select('r.path');
        $this->db->from('mahasiswa m');
        $this->db->join('user u','u.id_user = m.id_user','left');
        $this->db->join('sidang s','s.id_mahasiswa = m.id_mahasiswa','left');
        $this->db->join('anggota_sidang a','a.id_sidang = s.id_sidang','left');
        $this->db->join('revisi_sidang r','r.id_anggota_sidang = a.id_anggota_sidang','left');

        $this->db->where('u.id_user',$userId);
        $this->db->where('r.path !=',null);
        $query = $this->db->get();
        if ($query->num_rows()>0){
            return $query->result();
        }else{return false;}
    }
}