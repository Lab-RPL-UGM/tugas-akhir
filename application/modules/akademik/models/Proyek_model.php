<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Proyek_model extends CI_Model{
    public function getProyek($id = NULL){
        // jumlah_diterima > 0 berarti proyek ini sudah punya mahasiswa yang resmi diterima
        // (pengajuan_ta.status='diterima') -- proyek begini tidak boleh ditolak/dihapus lagi,
        // supaya mahasiswa yang sudah jalan tidak kehilangan pegangan proyeknya.
        //
        // nama_bidang/id_bidang lewat subquery (bukan JOIN ke proyek_bidang) supaya kolom
        // "id_proyek" dari proyek_bidang tidak menimpa "id_proyek" milik proyek sendiri lewat
        // "*" -- LEFT JOIN yang tidak match bikin id_proyek jadi NULL dan merusak semua
        // link edit/hapus/tolak yang bergantung ke $data->id_proyek.
        // Satu proyek bisa punya BEBERAPA bidang (many-to-many) -- GROUP_CONCAT buat
        // ditampilkan di listing; daftar id per-bidang buat pre-check di form edit
        // diambil terpisah lewat getBidangIdsForProyek() (lihat di bawah).
        $this->db->select("*,p.nama nama_proyek,d.nama nama_dosen,per.semester,per.tahun_ajaran,
            (SELECT GROUP_CONCAT(b.nama ORDER BY b.nama SEPARATOR ', ') FROM proyek_bidang pb JOIN bidang b ON b.id_bidang = pb.id_bidang WHERE pb.id_proyek = p.id_proyek) AS nama_bidang,
            (SELECT COUNT(*) FROM pengajuan_ta pt WHERE pt.id_proyek = p.id_proyek AND pt.status = 'diterima') AS jumlah_diterima,
            (SELECT COUNT(*) FROM pengajuan_ta pt WHERE pt.id_proyek = p.id_proyek) AS jumlah_pendaftar", false);
        $this->db->from('proyek p');
        $this->db->join('dosen d','p.id_dosen=d.id_dosen','inner');
        $this->db->join('periode per','p.id_periode=per.id_periode','left');
        $this->db->where('p.isDeleted',0);
        if($id != NULL){
            $this->db->where('p.id_proyek',$id);
        } else {
            $this->db->order_by('p.status DESC');
        }
        $query = $this->db->get();

        return $query->result();
    }

    public function getPeriodeList(){
        $this->db->select('*');
        $this->db->from('periode');
        $this->db->order_by('id_periode', 'DESC');
        $query = $this->db->get();

        return $query->result();
    }

    public function getBidangList(){
        $this->db->select('*');
        $this->db->from('bidang');
        $this->db->where('isDeleted', 0);
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    // Satu proyek boleh punya BEBERAPA bidang sekaligus (SOP: "bisa dipilih lebih dari 1") --
    // $id_bidang berupa array id. Hapus dulu baris lama baru pasang ulang semua yang dipilih.
    public function setBidangProyek($id_proyek, $id_bidang){
        $this->db->where('id_proyek', $id_proyek);
        $this->db->delete('proyek_bidang');

        if (!empty($id_bidang)) {
            $rows = [];
            foreach ((array)$id_bidang as $b) {
                if ($b === '' || $b === null) continue;
                $rows[] = ['id_proyek' => $id_proyek, 'id_bidang' => (int)$b];
            }
            if (!empty($rows)) {
                $this->db->insert_batch('proyek_bidang', $rows);
            }
        }
    }

    // Daftar mahasiswa yang memilih proyek ini (lewat pengajuan_ta, jenis='proyek'),
    // beserta nomor pilihan ke berapa dan status ajuannya -- dipakai akademik untuk
    // menentukan siapa yang diterima ("lensa per-proyek").
    public function getMahasiswaPemilihProyek($id_proyek){
        $this->db->select('pt.id_pengajuan_ta, pt.id_ta, pt.pilihan, pt.status, m.id_mahasiswa, m.nim, m.nama AS nama_mahasiswa, m.email');
        $this->db->from('pengajuan_ta pt');
        $this->db->join('tugas_akhir ta', 'ta.id_ta = pt.id_ta', 'inner');
        $this->db->join('mahasiswa m', 'm.id_mahasiswa = ta.id_mahasiswa', 'inner');
        $this->db->where('pt.id_proyek', $id_proyek);
        $this->db->where('pt.jenis', 'proyek');
        $this->db->order_by('pt.status', 'DESC'); // 'diterima' duluan biar kelihatan siapa pemenangnya
        $this->db->order_by('pt.pilihan', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    // Daftar id bidang yang sudah dipilih untuk satu proyek -- dipakai form edit
    // buat nge-check banyak <option> sekaligus di <select multiple>.
    public function getBidangIdsForProyek($id_proyek){
        $this->db->select('id_bidang');
        $this->db->from('proyek_bidang');
        $this->db->where('id_proyek', $id_proyek);
        $query = $this->db->get();

        return array_map(fn($row) => (int)$row->id_bidang, $query->result());
    }

    // Proyek yang sudah punya mahasiswa diterima tidak boleh ditolak/dihapus lagi --
    // dulu bisa, dan itu meninggalkan mahasiswa dengan proyek yang statusnya 'ditolak'/terhapus
    // padahal dia sudah aktif dikerjakan (lihat id_proyek=1,2,3,... di data existing).
    public function hasAcceptedPengajuan($id_proyek){
        $this->db->select('id_pengajuan_ta');
        $this->db->from('pengajuan_ta');
        $this->db->where('id_proyek',$id_proyek);
        $this->db->where('status','diterima');
        $this->db->limit(1);
        $query = $this->db->get();

        return $query->num_rows() > 0;
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
        $id_proyek = $this->db->insert_id();
        $this->db->trans_complete();

        return $this->db->trans_status() ? $id_proyek : false;
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