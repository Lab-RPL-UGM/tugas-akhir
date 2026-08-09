<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{
	/**
     * This function used to check the login credentials of the user
     * @param string $username : This is username of the user
     * @param string $password : This is encrypted password of the user
     */
    function loginAll($username, $password)
    {
        $this->db->select('BaseTbl.id_user, BaseTbl.password, BaseTbl.nama, BaseTbl.id_user_role, Roles.role');
        $this->db->from('user as BaseTbl');
        $this->db->join('user_role as Roles','Roles.id_user_role = BaseTbl.id_user_role');
        $this->db->where('BaseTbl.username', $username);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.id_user_role !=', 1); // Login kecuali kaprodi,
        $this->db->where('BaseTbl.id_user_role !=', 2); // Login kecuali akademik,
        $query = $this->db->get();
        
        $user = $query->result();
        
        if(!empty($user)){
            if(verifyHashedPassword($password, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
	
    
    /**
     * This function used to check the login credentials of the user
     * @param string $username : This is username of the user
     * @param string $password : This is encrypted password of the user
     */
    function loginMe($username, $password)
    {
        
        $this->db->select('BaseTbl.id_user, BaseTbl.password, BaseTbl.nama, BaseTbl.id_user_role, Roles.id_user_role');
        $this->db->from('user as BaseTbl');
        $this->db->join('user_role as Roles','Roles.id_user_role = BaseTbl.id_user_role');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->group_start();
        $this->db->where('BaseTbl.id_user_role', 2); // Login khusus Akademik, yang bisa login hanya akun Akademik
        $this->db->or_where('BaseTbl.id_user_role', 1); // Login khusus Kaprodi, yang bisa login hanya akun Kaprodi
        $this->db->group_end();
        $this->db->where('BaseTbl.username', $username);
        $query = $this->db->get();
        
        $user = $query->result();
        
        if(!empty($user)){
            if(verifyHashedPassword($password, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    /**
     * This function used to check username exists or not
     * @param {string} $username : This is users username id
     * @return {boolean} $result : TRUE/FALSE
     */
    function checkUsernameExist($username)
    {
        $this->db->select('id_user');
        $this->db->where('username', $username);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('user');

        if ($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }


    /**
     * This function used to insert reset password data
     * @param {array} $data : This is reset password data
     * @return {boolean} $result : TRUE/FALSE
     */
    function resetPasswordUser($data)
    {
        $result = $this->db->insert('user_reset_password', $data);

        if($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * This function is used to get customer information by email-id for forget password email
     * @param string $username : Username id of customer
     * @return object $result : Information of customer
     */
    function getCustomerInfoByEmail($username)
    {
        $this->db->select('id_user, username, nama');
        $this->db->from('user');
        $this->db->where('isDeleted', 0);
        $this->db->where('username', $username);
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * This function used to check correct activation deatails for forget password.
     * @param string $username : Username id of user
     * @param string $activation_id : This is activation string
     */
    function checkActivationDetails($username, $activation_id)
    {
        $this->db->select('id');
        $this->db->from('user_reset_password');
        $this->db->where('username', $username);
        $this->db->where('activation_id', $activation_id);
        $query = $this->db->get();
        return $query->num_rows;
    }

    // This function used to create new password by reset link
    function createPasswordUser($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('isDeleted', 0);
        $this->db->update('user', array('password'=>getHashedPassword($password)));
        $this->db->delete('user_reset_password', array('username'=>$username));
    }

    public function getDosen($id_dosen = NULL)
    {
        $this->db->select("*");
        $this->db->from('dosen');
        $this->db->where('isDeleted', 0);
        if ($id_dosen != NULL) {
            $this->db->where('id_dosen', $id_dosen);
        }
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    function getCountBimbingan($userId)
    {
        $this->db->select('m.id_mahasiswa');
        $this->db->from('dosbing d');
        $this->db->join('dosen ds', 'ds.id_dosen = d.id_dosen');
        $this->db->join('mahasiswa m', 'm.id_mahasiswa = d.id_mahasiswa');
        $this->db->join('tugas_akhir ta', 'ta.id_mahasiswa = m.id_mahasiswa');
        $this->db->join('sidang s', 's.id_mahasiswa = m.id_mahasiswa', 'left');
        $this->db->join('yudisium y', 'y.id_mahasiswa = m.id_mahasiswa', 'left');
        $this->db->join('periode p', 'p.id_periode = ta.id_periode');
    
        // Mahasiswa tidak dihapus
        $this->db->where('m.isDeleted', 0);
    
        // Status pengambilan TA
        $this->db->where_in('ta.status_pengambilan', ['terplotting', 'revisi']);
    
        // Belum yudisium
        $this->db->where('y.id_yudisium IS NULL', null, false);
    
        // Dosen pembimbing sesuai
        $this->db->where('ds.id_dosen', $userId);
    
        // Hindari duplikasi
        $this->db->group_by('m.id_mahasiswa');
    
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getSidangCount($id_dosen)
    {
        $this->db->select('j.tanggal, j.waktu, j.ruang, m.nim, m.nama, v.path, 
        p.id_penilaian, s.nilai_akhir_sidang, p.nilai_akhir_dosen, a.id_sidang');
        $this->db->from('sidang s');
        $this->db->join('mahasiswa m', 'm.id_mahasiswa = s.id_mahasiswa');
        $this->db->join('jadwal_sidang j', 'j.id_sidang = s.id_sidang');
        $this->db->join('validasi_berkas_sidang v', 'v.id_sidang = s.id_sidang');
        $this->db->join('anggota_sidang a', 'a.id_sidang = s.id_sidang');
        $this->db->join('penilaian p', 'p.id_anggota_sidang = a.id_anggota_sidang');
        $this->db->join('dosen d', 'd.id_dosen = a.id_dosen');
        $this->db->join('user u', 'u.id_user = d.id_user');
        $this->db->where('u.id_user', $id_dosen);
        $this->db->group_by('m.id_mahasiswa');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return FALSE;
        }
    }
}

?>