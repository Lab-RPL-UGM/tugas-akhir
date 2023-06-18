<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Profil_model extends CI_Model
{
    /**
     * This function is used to get the mahasiswa list
     * @param number $userId : This is get from user who is logged in
     * @return array $result : This is result
     */
    function getMahasiswa($userId)
    {
        $this->db->select('id_mahasiswa, nim, nama, foto, jumlah_sks, ipk, email, mobile, skill, pengalaman');
        $this->db->from('mahasiswa');
        $this->db->where('id_user', $userId);
        $query = $this->db->get();
        
        $result = $query->result();
        return $result;
    }

    /**
     * This function is used to check existance nim
     * @param number $nim : This is get nim from mahasiswa who is logged in
     * @param number $idMhs : This is get id_mahasiswa from mahasiswa who is logged in
     * @return bool : true if exist
     */
    function checkNim($nim,$idMhs = 0){
        $this->db->select("nim");
        $this->db->from("mahasiswa");
        $this->db->where("nim", $nim);
        $this->db->where("isDeleted", 0);
        if($idMhs != 0){
            $this->db->where("id_mahasiswa !=", $idMhs);
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
     * @param number $email : This is get email from mahasiswa who is logged in
     * @param number $idMhs : This is get id_mahasiswa from mahasiswa who is logged in
     * @return bool : true if exist
     */
    function checkEmail($email,$idMhs = 0){
        $this->db->select("email");
        $this->db->from("mahasiswa");
        $this->db->where("email", $email);
        $this->db->where("isDeleted", 0);
        if($idMhs != 0){
            $this->db->where("id_mahasiswa !=", $idMhs);
        }
        $query = $this->db->get();

        if( $query->num_rows() > 0 ){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    /**
     * This function is used to edit the mahasiswa information
     * @param array $mahasiswaInfo : This is mahasiswas updated information
     * @param number $id_mahasiswa : This is mahasiswa id
     * @return true if row in table increase
     */
    function editProfil($mahasiswaInfo, $id_mahasiswa)
    {
        $this->db->where('id_mahasiswa', $id_mahasiswa);
        $this->db->update('mahasiswa', $mahasiswaInfo);
        
        if($this->db->affected_rows() >= 0){
			return true;
		}else{
			return false;
		}
    }
    /**
     * This function is used to edit the user information
     * @param array $userInfo : This is users updated information
     * @param number $id_user : This is user id
     * @return true if row in table increase
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