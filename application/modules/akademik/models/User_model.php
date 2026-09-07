<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{
    function insert($data){
        $this->db->trans_start();
        $data_user = array(
            'nama' => $data['nama'],
            'username' => $data['username'],
            'id_user_role' => $data['id_user_role']
        );
        // Mahasiswa login lewat SSO saja — tidak ada password lokal untuk di-set.
        if (isset($data['password'])) {
            $data_user['password'] = $data['password'];
        }
        $this->db->insert('user', $data_user);
        $insert_id = $this->db->insert_id();
        if($data['id_user_role'] == ROLE_MAHASISWA){
            $data_another_table = array(
                'id_user' => $insert_id,
                'nama' => $data['nama'],
                'nim' => $data['nomor_induk'],
                'email' => $data['email']
            );
            $this->db->insert('mahasiswa', $data_another_table);
        } elseif($data['id_user_role'] == ROLE_DOSEN){
            $data_another_table = array(
                'id_user' => $insert_id,
                'nama' => $data['nama'],
                'nid' => $data['nomor_induk'],
                'gelar_depan' => $data['gelar_depan'],
                'gelar_belakang' => $data['gelar_belakang'],
                'kuota_mahasiswa' => $data['kuota_mahasiswa'],
                // Wajib diisi -- ini yang dipakai Login_model::findUserByEmail() buat
                // mencocokkan akun SSO Casdoor ke dosen ini. Tanpa ini dosen tidak akan
                // pernah bisa login (password lokal bukan jalur login yang dipakai).
                'email' => $data['email'],
            );
            $this->db->insert('dosen', $data_another_table);
        } elseif($data['id_user_role'] == ROLE_AKADEMIK){
            $data_akademik = array(
                'id_user' => $insert_id,
                'nama' => $data['nama']
            );
            $this->db->insert('akademik', $data_akademik);
        } elseif($data['id_user_role'] == ROLE_KAPRODI){
            $data_akademik = array(
                'id_user' => $insert_id,
                'nama' => $data['nama']
            );
            $this->db->insert('akademik', $data_akademik);
            $id_akademik = $this->db->insert_id();
            
            $data_dosen = array(
                'id_user' => $insert_id,
                'nama' => $data['nama'],
                'nid' => $data['nomor_induk'],
                'gelar_depan' => $data['gelar_depan'],
                'gelar_belakang' => $data['gelar_belakang'],
                'kuota_mahasiswa' => $data['kuota_mahasiswa']
            );
            $this->db->insert('dosen', $data_dosen);
            $id_dosen = $this->db->insert_id();

            $data_kaprodi = array(
                'id_dosen' => $id_dosen,
                'id_akademik' => $id_akademik,
                'id_user' => $insert_id,
                'nama' => $data['nama']
            );

            $this->db->insert('kaprodi', $data_kaprodi);
        }
        $this->db->trans_complete();
        $result = $this->db->trans_status();
        
        return $result;
    }

    function insert_multiple($data){
        $this->db->trans_start();
        $count = count($data);
        $all_data_user = array();
        foreach ($data as $result_excel) {
            $data_user = array(
                'nama' => $result_excel['nama'],
                'username' => $result_excel['username'],
                'password' => $result_excel['password'],
                'id_user_role' => $result_excel['id_user_role']
            );
            array_push($all_data_user,$data_user);
        }
        $this->db->insert_batch('user', $all_data_user);
        $first_id = $this->db->insert_id();
        $last_id = $first_id + ($count-1);
        $i = 0;
        $data_another_table = array();
        if($data[0]['id_user_role'] == ROLE_MAHASISWA){    
            for ($id=$first_id; $id<=$last_id ; $id++) { 
                $data_person = array(
                    'id_user' => $id,
                    'nama' => $data[$i]['nama'],
                    'nim' => $data[$i]['nomor_induk']
                );
                array_push($data_another_table,$data_person);
                $i++;
            }
            $this->db->insert_batch('mahasiswa', $data_another_table);
        } elseif($data[0]['id_user_role'] == ROLE_DOSEN){
            for ($id=$first_id; $id<=$last_id ; $id++) { 
                $data_person = array(
                    'id_user' => $id,
                    'nama' => $data[$i]['nama'],
                    'nid' => $data[$i]['nomor_induk'],
                    'gelar_depan' => $data['gelar_depan'],
                    'gelar_belakang' => $data['gelar_belakang'],
                    'kuota_mahasiswa' => $data['kuota_mahasiswa']
                );
                array_push($data_another_table,$data_person);
                $i++;
            }    
            $this->db->insert_batch('dosen', $data_another_table);
        } elseif($data[0]['id_user_role'] == ROLE_AKADEMIK){
            for ($id=$first_id; $id<=$last_id ; $id++) { 
                $data_person = array(
                    'id_user' => $id,
                    'nama' => $data[$i]['nama']
                );
                array_push($data_another_table,$data_person);
                $i++;
            }
            $this->db->insert_batch('akademik', $data_another_table);
        }
        
        $this->db->trans_complete();
        $result = $this->db->trans_status();
        
        return $result;
    }

    function update($data,$id,$role){
        $this->db->trans_start();
        // Mahasiswa tidak lagi kirim username/password dari form (login murni SSO) —
        // nama tetap di-update, username & password lama dibiarkan apa adanya.
        $data_user = array('nama' => $data['nama']);
        if (isset($data['username'])) {
            $data_user['username'] = $data['username'];
        }
        if (!empty($data['password'])) {
            $data_user['password'] = $data['password'];
        }
        $this->db->where('id_user',$id);
        $this->db->update('user',$data_user);

        if($role == ROLE_MAHASISWA){
            $data_mahasiswa = array(
                'nama' => $data['nama'],
                'nim' => $data['nim'],
                'email' => $data['email']
            );
            $this->db->where('id_user',$id);
            $this->db->update('mahasiswa', $data_mahasiswa);
            $this->db->where('id_mahasiswa',$data['id_mahasiswa']);
            $this->db->update('tugas_akhir', array('status_pengambilan' => $data['status_pengambilan']));
        }
        if($role == ROLE_DOSEN){
            $data_dosen = array(
                'nama' => $data['nama'],
                'nid' => $data['nid'],
                'gelar_depan' => $data['gelar_depan'],
                'gelar_belakang' => $data['gelar_belakang'],
                'kuota_mahasiswa' => $data['kuota_mahasiswa'],
                'email' => $data['email'],
            );
            $this->db->where('id_user',$id);
            $this->db->update('dosen', $data_dosen);
        }
        if($role == ROLE_AKADEMIK){
            $data_akademik = array(
                'nama' => $data['nama']
            );
            $this->db->where('id_user',$id);
            $this->db->update('akademik', $data_akademik);
        }
        if($role == ROLE_KAPRODI){
            $data_another_table = array(
                'nama' => $data['nama']
            );
            $data_dosen = array(
                'nama' => $data['nama'],
                'nid' => $data['nid'],
                'gelar_depan' => $data['gelar_depan'],
                'gelar_belakang' => $data['gelar_belakang'],
                'kuota_mahasiswa' => $data['kuota_mahasiswa']
            );
            $this->db->where('id_user',$id);
            $this->db->update('kaprodi', $data_another_table);

            $this->db->where('id_user',$id);
            $this->db->update('dosen', $data_dosen);

            $this->db->where('id_user',$id);
            $this->db->update('akademik', $data_another_table);
        }

        $this->db->trans_complete();
        $result = $this->db->trans_status();
        
        return $result;
    }

    function checkEmail($email,$userId = 0){
        // Kolom "email" ada di tabel mahasiswa, bukan user — sama seperti checkNIM().
        $this->db->select("m.email");
        $this->db->from("user u");
        $this->db->join("mahasiswa m","u.id_user = m.id_user","inner");
        $this->db->where("m.email", $email);
        $this->db->where("u.isDeleted", 0);
        if($userId != 0){
            $this->db->where("u.id_user !=", $userId);
        }
        $query = $this->db->get();

        if( $query->num_rows() > 0 ){ return TRUE; } else { return FALSE; }
    }

    function checkEmailDosen($email, $userId = 0){
        // Sama seperti checkEmail() tapi untuk dosen -- email jadi kunci pencocokan
        // login SSO, jadi tidak boleh dobel antar dosen (Login_model::findUserByEmail()
        // cuma ambil baris pertama yang cocok kalau ada duplikat).
        $this->db->select("d.email");
        $this->db->from("user u");
        $this->db->join("dosen d","u.id_user = d.id_user","inner");
        $this->db->where("d.email", $email);
        $this->db->where("u.isDeleted", 0);
        if($userId != 0){
            $this->db->where("u.id_user !=", $userId);
        }
        $query = $this->db->get();

        if( $query->num_rows() > 0 ){ return TRUE; } else { return FALSE; }
    }

    function checkUsername($username,$userId = 0){
        $this->db->select("username");
        $this->db->from("user");
        $this->db->where("username", $username);   
        $this->db->where("isDeleted", 0);
        if($userId != 0){
            $this->db->where("id_user !=", $userId);
        }
        $query = $this->db->get();

        if( $query->num_rows() > 0 ){ return TRUE; } else { return FALSE; }
    }

    function checkNIM($nim,$userId = 0){
        $this->db->select("m.nim");
        $this->db->from("user u");
        $this->db->join("mahasiswa m","u.id_user = m.id_user","inner");
        $this->db->where("m.nim", $nim);   
        $this->db->where("u.isDeleted", 0);
        if($userId != 0){
            $this->db->where("u.id_user !=", $userId);
        }
        $query = $this->db->get();

        if( $query->num_rows() > 0 ){ return TRUE; } else { return FALSE; }
    }

    function checkNID($nid,$userId = 0){
        $this->db->select("d.nid");
        $this->db->from("user u");
        $this->db->join("dosen d","u.id_user = d.id_user","inner");
        $this->db->where("d.nid", $nid);   
        $this->db->where("u.isDeleted", 0);
        if($userId != 0){
            $this->db->where("u.id_user !=", $userId);
        }
        $query = $this->db->get();

        if( $query->num_rows() > 0 ){ return TRUE; } else { return FALSE; }
    }

    public function getUserTable($role){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id_user_role',$role);
        $this->db->where('isDeleted',0);
        $this->db->order_by('createdDtm DESC');
        $query = $this->db->get();

        if($query->num_rows() > 0) { return $query->result(); } else { return FALSE; }
    }

    public function getUserTableWithTA(){
        // Subquery (bukan JOIN langsung ke tugas_akhir) supaya mahasiswa dengan lebih dari
        // satu baris tugas_akhir (mis. pernah ganti pengajuan) tidak muncul dobel di listing —
        // cuma diambil baris tugas_akhir yang paling baru per mahasiswa.
        $this->db->select("u.*, m.nim, m.email, m.id_mahasiswa,
            (SELECT t.status_pengambilan FROM tugas_akhir t
             WHERE t.id_mahasiswa = m.id_mahasiswa
             ORDER BY t.id_ta DESC LIMIT 1) AS status_pengambilan", FALSE);
        $this->db->from('user u');
        $this->db->join('mahasiswa m','u.id_user = m.id_user','inner');
        $this->db->where('u.id_user_role',ROLE_MAHASISWA);
        $this->db->where('u.isDeleted',0);
        $this->db->where('m.isDeleted',0);
        $this->db->order_by('u.createdDtm DESC');
        $query = $this->db->get();

        if($query->num_rows() > 0) { return $query->result(); } else { return FALSE; }
    }

    public function getTA($userId){
        $this->db->select('tugas_akhir.*');
        $this->db->from('tugas_akhir');
        $this->db->join('mahasiswa m','tugas_akhir.id_mahasiswa = m.id_mahasiswa','inner');
        $this->db->where('m.id_user',$userId);
        $this->db->order_by('tugas_akhir.createdDtm DESC');
        $query = $this->db->get();

        if($query->num_rows() > 0) { return $query->result(); } else { return FALSE; }
    }

    function getUserDosenTable($role){
        $this->db->select('u.*, d.gelar_depan, d.gelar_belakang, d.is_admin');
        $this->db->from('user u');
        $this->db->join("dosen d","u.id_user = d.id_user","inner");
        $this->db->where('u.id_user_role',$role);
        $this->db->where('u.isDeleted',0);
        $this->db->order_by('u.createdDtm DESC');
        $query = $this->db->get();

        if($query->num_rows() > 0) { return $query->result(); } else { return FALSE; }
    }

    /**
     * Toggles admin (akademik panel) access for a dosen account — lets a dosen
     * be granted/revoked admin privileges without a separate fixed admin account.
     */
    function toggleAdmin($id_user){
        $this->db->select('is_admin');
        $this->db->from('dosen');
        $this->db->where('id_user', $id_user);
        $current = $this->db->get()->row();

        if (!$current) {
            return FALSE;
        }

        $this->db->where('id_user', $id_user);
        return $this->db->update('dosen', array('is_admin' => $current->is_admin ? 0 : 1));
    }

    public function getUser($id,$role = NULL){
        $this->db->select("*,u.nama nama_user");
        $this->db->from('user u');
        $this->db->where('u.id_user',$id);
        $this->db->where('u.isDeleted',0);
        if($role != NULL){
            if($role == ROLE_MAHASISWA){
                $this->db->join('mahasiswa m','u.id_user=m.id_user','inner');
            } elseif($role == ROLE_DOSEN || $role == ROLE_KAPRODI) {
                $this->db->join('dosen d','u.id_user=d.id_user','inner');
            }
        }
        $query = $this->db->get();

        return $query->result();
    }

    public function delete($id){
        $this->db->trans_start();

        
        $this->db->select('id_user_role');
        $this->db->from('user');
        $this->db->where('id_user',$id);
        $query = $this->db->get();
        $role = $query->result()[0]->id_user_role;

        $this->db->set('isDeleted',1);
        $this->db->where('id_user',$id);
        $this->db->update('user');

        if($role == ROLE_MAHASISWA){
            $data_another_table = array(
                'isDeleted' => 1
            );
            $this->db->where('id_user',$id);
            $this->db->update('mahasiswa', $data_another_table);
        }

        if($role == ROLE_DOSEN){
            $data_another_table = array(
                'isDeleted' => 1
            );
            $this->db->where('id_user',$id);
            $this->db->update('dosen', $data_another_table);
        }

        if($role == ROLE_AKADEMIK){
            $data_another_table = array(
                'isDeleted' => 1
            );
            $this->db->where('id_user',$id);
            $this->db->update('akademik', $data_another_table);
        }

        if($role == ROLE_KAPRODI){
            $data_another_table = array(
                'isDeleted' => 1
            );
            $this->db->where('id_user',$id);
            $this->db->update('kaprodi', $data_another_table);

            $this->db->where('id_user',$id);
            $this->db->update('akademik', $data_another_table);

            $this->db->where('id_user',$id);
            $this->db->update('dosen', $data_another_table);
        }

        $this->db->trans_complete();
        $result = $this->db->trans_status();
        
        return $result;
    }
}