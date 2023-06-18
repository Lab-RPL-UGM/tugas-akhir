<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Proyek_model extends CI_Model{
    public function getProyek($id = NULL){
        $this->db->select("*,p.nama nama_proyek,d.nama nama_dosen");
        $this->db->from('proyek p');
        $this->db->join('dosen d','p.id_dosen=d.id_dosen','inner');
        $this->db->where('p.isDeleted',0);
        if($id != NULL){
            $this->db->where('id_proyek',$id);
        } else {
            $this->db->order_by('p.status DESC');
        }
        $query = $this->db->get();

        return $query->result();
    }

    public function getDosen(){
        $this->db->select("*");
        $this->db->from('dosen');
        $this->db->where('isDeleted',0);
        $query = $this->db->get();

        return $query->result();
    }

    public function getStatus(){
        $this->db->select("status");
        $this->db->from('proyek');
        $query = $this->db->get();

        return $query->result();
    }

    public function insert($data){
        $this->db->trans_start();
        $this->db->insert('proyek', $data);
        $this->db->trans_complete();
        $result = $this->db->trans_status();
        
        return $result;
    }

    public function update($data,$id){
        $this->db->trans_start();

        $this->db->select("*");
        $this->db->from('pengajuan_ta pt');
        $this->db->join('tugas_akhir ta','pt.id_ta=ta.id_ta','inner');
        $this->db->where('pt.id_proyek',$id);
        $this->db->where('pt.status','diterima');
        $query = $this->db->get();

        if($query->num_rows() > 0 ) {
            $result = $query->result();

            $this->db->select('nama');
            $this->db->from('dosen');
            $this->db->where('id_dosen',$data['id_dosen']);
            $query_dosen = $this->db->get();

            $data_log = array(
                'id_mahasiswa' => $result[0]->id_mahasiswa,
                'nama' => 'Pengubahan dosen pembimbing',
                'deskripsi' => 'Dosen pembimbing anda telah diganti oleh akademik. Dosen pembimbing anda sekarang adalah <b>' . $query_dosen->result()[0]->nama . '</b>'
            );
            $this->db->insert('log_pesan',$data_log);
    
        }

        $this->db->where('id_proyek',$id);
        $this->db->update('proyek',$data);
        $this->db->trans_complete();
        $result = $this->db->trans_status();
        
        return $result;
    }

    public function delete($id){
        $this->db->trans_start();
        
        $this->db->set('isDeleted',1);
        $this->db->where('id_proyek',$id);
        $this->db->update('proyek');

        $this->db->trans_complete();
        $result = $this->db->trans_status();
        
        return $result;
    }

    public function change_status($id,$cond){
        $this->db->trans_start();
        if($cond == 1){
            $this->db->set('status','disetujui');
        } else {
            $this->db->set('status','ditolak');
        }
        $this->db->where('id_proyek',$id);
        $this->db->update('proyek');

        $this->db->trans_complete();
        $result = $this->db->trans_status();
        
        return $result;
    }
}