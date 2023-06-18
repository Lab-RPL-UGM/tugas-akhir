<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_mahasiswa_model extends CI_Model{
    public function getMahasiswa($id_mahasiswa = NULL,$angkatan = NULL){
        $this->db->select("*");
        $this->db->from('mahasiswa');
        $this->db->where('isDeleted',0);
        if($id_mahasiswa != NULL){
            $this->db->where('id_mahasiswa',$id_mahasiswa);
        }
        if($angkatan != NULL){
            $this->db->where('substring(nim,1,2)',$angkatan);
        }
        $this->db->order_by('nim DESC, nama');
        $query = $this->db->get();

        return $query->result();
    }

    public function isJudul($id_mahasiswa){
        $this->db->select("*");
        $this->db->from('tugas_akhir');
        $this->db->where('id_mahasiswa',$id_mahasiswa);
        $query = $this->db->get();

        if( $query->num_rows() > 0 ){ return TRUE; } else { return FALSE; }
    }

    public function isSidang($id_mahasiswa){
        $this->db->select("*");
        $this->db->from('sidang');
        $this->db->group_start();
        $this->db->where('status','disetujui');
        $this->db->or_where('status','lulus_revisi');
        $this->db->or_where('status','lulus');
        $this->db->group_end();
        $this->db->where('id_mahasiswa',$id_mahasiswa);
        $query = $this->db->get();

        if( $query->num_rows() > 0 ){ return TRUE; } else { return FALSE; }
    }

    public function get_nilai_akhir($id_mahasiswa = NULL){
        $this->db->select("*");
        $this->db->from('sidang');
        if($id_mahasiswa != NULL){
            $this->db->where('id_mahasiswa',$id_mahasiswa);
        }
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            return $query->result();
            
        } else {
            return FALSE;
        }
    }

    public function isYudisium($id_mahasiswa){
        $this->db->select("*");
        $this->db->from('yudisium');
        $this->db->where('id_mahasiswa',$id_mahasiswa);
        $this->db->where('status','disetujui');

        $query = $this->db->get();

        if( $query->num_rows() > 0 ){ return TRUE; } else { return FALSE; }
    }

    public function getDosbing($id_mahasiswa){
        $this->db->select("*");
        $this->db->from('dosbing ds');
        $this->db->join('dosen d','ds.id_dosen = d.id_dosen', 'inner');
        $this->db->where('ds.id_mahasiswa',$id_mahasiswa);

        $query = $this->db->get();

        if( $query->num_rows() > 0 ){ return $query->result(); } else { return NULL; }
    }

    public function getJudulTA($id_mahasiswa){
        $this->db->select("*");
        $this->db->from('tugas_akhir ta');
        $this->db->join('pengajuan_ta pt','ta.id_ta = pt.id_ta', 'inner');
        $this->db->where('ta.id_mahasiswa',$id_mahasiswa);
        $this->db->where('pt.status','diterima');
        $query_pengajuan = $this->db->get();

        if($query_pengajuan->num_rows() > 0){
            $id_pengajuan_ta = $query_pengajuan->result()[0]->id_pengajuan_ta;
            $id_proyek = $query_pengajuan->result()[0]->id_proyek;
            if($id_proyek != NULL) {
                $this->db->select("*,nama judul_ta");
                $this->db->from('proyek');
                $this->db->where('id_proyek',$id_proyek);
                $query_proyek = $this->db->get();

                return $query_proyek->result();
            } else {
                $this->db->select("*,judul judul_ta");
                $this->db->from('usulan');
                $this->db->where('id_pengajuan_ta',$id_pengajuan_ta);
                $query_proyek = $this->db->get();

                return $query_proyek->result();
            }
        } else {
            return FALSE;
        }
    }

    public function getBerkasSidang($id_mahasiswa){
        $this->db->select("*");
        $this->db->from('sidang s');
        $this->db->join('validasi_berkas_sidang v','s.id_sidang=v.id_sidang','inner');
        $this->db->join('berkas_sidang b','v.id_berkas_sidang=b.id_berkas_sidang','inner');
        $this->db->where('s.id_mahasiswa',$id_mahasiswa);
        $query = $this->db->get();

        if( $query->num_rows() > 0 ){ return $query->result(); } else { return FALSE; }
    }

    public function getPenilaian($id_mahasiswa,$id_komponen){
        $this->db->select("*");
        $this->db->from('sidang s');
        $this->db->join('penilaian p','s.id_sidang=p.id_sidang','inner');
        $this->db->join('komponen_nilai kn','p.id_penilaian=kn.id_penilaian','inner');
        $this->db->join('komponen k','k.id_komponen=kn.id_komponen','inner');
        $this->db->where('s.id_mahasiswa',$id_mahasiswa);
        $this->db->where('k.id_komponen',$id_komponen);
        $query = $this->db->get();

        if( $query->num_rows() > 0 ){ return $query->result(); } else { return FALSE; }
    }

    public function getKomponen(){
        $this->db->select("*");
        $this->db->from('komponen');
        $query = $this->db->get();

        if( $query->num_rows() > 0 ){ return $query->result(); } else { return FALSE; }
    }

    public function getNilaiSidang($id_mahasiswa){
        $this->db->select("*");
        $this->db->from('sidang');
        $this->db->where('id_mahasiswa',$id_mahasiswa);
        $query = $this->db->get();

        if( $query->num_rows() > 0 ){ return $query->result(); } else { return FALSE; }
    }

    public function getBerkasYudisium($id_mahasiswa){
        $this->db->select("*");
        $this->db->from('yudisium y');
        $this->db->join('validasi_berkas_yudisium v','y.id_yudisium=v.id_yudisium','inner');
        $this->db->join('berkas_yudisium b','v.id_berkas_yudisium=b.id_berkas_yudisium','inner');
        $this->db->where('y.id_mahasiswa',$id_mahasiswa);
        $query = $this->db->get();

        if( $query->num_rows() > 0 ){ return $query->result(); } else { return FALSE; }
    }

    public function getAngkatan(){
        $this->db->select('substring(nim,1,2) as angkatan');
        $this->db->from('mahasiswa');
        $this->db->group_by("angkatan");
        $query = $this->db->get();

        if( $query->num_rows() > 0 ){ return $query->result(); } else { return FALSE; }

    }
}