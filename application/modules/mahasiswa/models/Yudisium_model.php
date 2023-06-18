<?php
/**
 * Created by nad.
 * Date: 25/03/2018
 * Time: 06:33
 * Description:
 */

class Yudisium_model extends CI_Model
{
    /**
     * This function is used to get the periode to access page
     * @return array $result : This is result
     */
    function getPeriode(){
        $this->db->select('id_periode, status_periode, tgl_awal_regis_yudisium, tgl_akhir_regis_yudisium');
        $this->db->from('periode');
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
//    get id mahasiswa where have been sidang, mahasiswa have to sidang if wanna yudisium
    function getSidang($userId)
    {
        $this->db->select('s.id_mahasiswa');
        $this->db->from('sidang s');
        $this->db->join('mahasiswa m','m.id_mahasiswa = s.id_mahasiswa');
        $this->db->join('user u','u.id_user = m.id_user');
        $this->db->group_start();
        $this->db->where('s.status','lulus');
        $this->db->or_where('s.status','lulus_revisi');
        $this->db->group_end();
        $this->db->where('u.id_user', $userId);

        $query = $this->db->get();
        if ($query->num_rows()>0){
            return $query->result();
        }else{
            return false;
        }
    }
    /**
     * This function used to get berkas list by id
     * @param number $userId : This is user who is logged in
     * @return array $result : This is berkas information
     */
    function getBerkasInfo($userId)
    {
        $this->db->select('berkas.id_berkas_yudisium, berkas.nama_berkas, val.id_valid_yudisium,
         val.isValid, val.path, yudisium.id_yudisium, mahasiswa.id_mahasiswa');
        $this->db->from('berkas_yudisium berkas');
        $this->db->join('validasi_berkas_yudisium val','val.id_berkas_yudisium = berkas.id_berkas_yudisium');
        $this->db->join('yudisium','yudisium.id_yudisium = val.id_yudisium');
        $this->db->join('mahasiswa','mahasiswa.id_mahasiswa = yudisium.id_mahasiswa');
        $this->db->join('user','user.id_user = mahasiswa.id_user');
        $this->db->where('mahasiswa.id_user', $userId);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
//    get berkas where active
    function getIdBerkas()
    {
        $this->db->select('b.id_berkas_yudisium');
        $this->db->from('berkas_yudisium b');
        $this->db->where('b.isDeleted', 0);

        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
//    get total berkas where active
    function getCountBerkas()
    {
        $this->db->select('b.id_berkas_yudisium, b.nama_berkas, b.isDeleted');
        $this->db->from('berkas_yudisium b');
        $this->db->where('b.isDeleted', 0);

        $query = $this->db->get();
        return count($query->result());
    }
    /**
     * This function is used to get the nim mahasiswa who is login
     * @param number $userId : This is got from who is logged in
     * @return array $result : This is result
     */
    function cekMahasiswa($userId)
    {
        $this->db->select('mahasiswa.id_mahasiswa');
        $this->db->from('mahasiswa');
        $this->db->join('user','mahasiswa.id_user = user.id_user');
        $this->db->where('mahasiswa.id_user', $userId);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    /**
     * This function is used to add new yudisium to system
     * @param array $infoYudisium : This is list of detail sent to field
     * @return number $insert_id : This is last inserted id
     */
    function addNewYudisium($infoYudisium)
    {
        $this->db->trans_start();
        $this->db->insert('yudisium', $infoYudisium);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    /**
     * This function is used to add new validasi_berkas_yudisium to system
     * @param array $infoYudisium : This is list of detail sent to field
     * @return number $insert_id : This is last inserted id
     */
    function addNewValidasi($id)
    {
        $this->db->trans_start();
        $this->db->insert('validasi_berkas_yudisium', $id);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    /**
     * This function is used to edit the files in validasi_berkas_yudisium table
     * @param array $berkasInfo : This is array files wanna insert to validasi_berkas_yudisium field
     * @param number $id_berkas : This is berkas id
     */
    function editBerkas($berkasInfo, $id_berkas)
    {
        $this->db->where('id_valid_yudisium', $id_berkas);
        $this->db->update('validasi_berkas_yudisium', $berkasInfo);

        if($this->db->affected_rows() >= 0){
            return true;
        }else{
            return false;
        }
    }
}