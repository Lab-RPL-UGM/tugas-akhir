<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Profil_model extends CI_Model
{
    /**
     * This function is used to get the dosen list
     * @param number $userId : This is get from user who is logged in
     * @return array $result : This is result
     */
    function getDosen($userId)
    {
        $this->db->select('id_dosen, nid, nama, foto, email, mobile, skill, kuota_mahasiswa');
        $this->db->from('dosen');
        $this->db->where('id_user', $userId);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    /**
     * This function is used to check existance nim
     * @param number $nim : This is get nim from dosen who is logged in
     * @param number $idMhs : This is get id_dosen from dosen who is logged in
     * @return bool : true if exist
     */
    function checkNid($nid,$idDosen = 0){
        $this->db->select("nid");
        $this->db->from("dosen");
        $this->db->where("nid", $nid);
        $this->db->where("isDeleted", 0);
        if($idDosen != 0){
            $this->db->where("id_dosen !=", $idDosen);
        }
        $query = $this->db->get();

        if( $query->num_rows() > 0 ){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    /**
     * This function is used to check existance email
     * @param number $email : This is get email from dosen who is logged in
     * @param number $idDosen : This is get id_dosen from dosen who is logged in
     * @return bool : true if exist
     */
    function checkEmail($email,$idDosen = 0){
        $this->db->select("email");
        $this->db->from("dosen");
        $this->db->where("email", $email);
        $this->db->where("isDeleted", 0);
        if($idDosen != 0){
            $this->db->where("id_dosen !=", $idDosen);
        }
        $query = $this->db->get();

        if( $query->num_rows() > 0 ){
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * This function is used to update the dosen information
     * @param array $dosenInfo : This is dosens updated information
     * @return array $result : This is result
     */
    function editProfil($dosenInfo, $id_dosen)
    {
        $this->db->where('id_dosen', $id_dosen);
        $this->db->update('dosen', $dosenInfo);

        if($this->db->affected_rows() >= 0){
            return true;
        }else{
            return false;
        }
    }
    /**
     * This function is used to update the user information
     * @param array $userInfo : This is user updated information
     * @return array $result : This is result
     */
    function editUser($userInfo, $id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->update('user', $userInfo);

        if($this->db->affected_rows() >= 0){
            return true;
        }else{
            return false;
        }
    }
}