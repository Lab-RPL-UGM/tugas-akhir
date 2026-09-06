<?php

/**
 * Created by nad.
 * Date: 22/03/2018
 * Time: 21:15
 * Description:
 */

class Proyek_model extends CI_Model
{
    /**
     * This function used to get proyek information by id
     * @param number $id : This is project id
     * @return array $result : This is project information
     */
    function getProyekInfo($proyekId = NULL, $dosenId = NULL)
    {
        // Satu proyek bisa punya beberapa bidang -- GROUP_CONCAT buat ditampilkan;
        // daftar id per-bidang buat pre-check <select multiple> lewat getBidangIdsForProyek().
        $this->db->select("proyek.id_proyek, proyek.nama nama_proyek, proyek.klien,
                           proyek.status, proyek.id_dosen, proyek.id_periode, proyek.createdDtm, Dosen.nama nama_dosen, proyek.deskripsi, proyek.tools,
                           per.semester, per.tahun_ajaran,
                           (SELECT GROUP_CONCAT(b.nama ORDER BY b.nama SEPARATOR ', ') FROM proyek_bidang pb JOIN bidang b ON b.id_bidang = pb.id_bidang WHERE pb.id_proyek = proyek.id_proyek) AS nama_bidang,
                           (SELECT COUNT(*) FROM pengajuan_ta pt WHERE pt.id_proyek = proyek.id_proyek) AS jumlah_pendaftar,
                           (SELECT COUNT(*) FROM pengajuan_ta pt WHERE pt.id_proyek = proyek.id_proyek AND pt.status = 'diterima') AS jumlah_diterima", false);
        $this->db->from('proyek');
        $this->db->join('dosen as Dosen', 'Dosen.id_dosen = proyek.id_dosen', 'left');
        $this->db->join('periode per', 'per.id_periode = proyek.id_periode', 'left');
        $this->db->where('proyek.isDeleted', 0);
        if ($proyekId != null) {
            $this->db->where('proyek.id_proyek', $proyekId);
        }
        if ($dosenId != null) {
            $this->db->where('Dosen.id_user', $dosenId);
        }
        // Terbaru duluan -- cuma relevan buat listing (bukan lookup satu id).
        $this->db->order_by('proyek.createdDtm', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Dosen yang login sendiri -- proyek yang diajukan dosen selalu atas nama dirinya
    // sendiri, tidak boleh dilimpahkan/diatasnamakan dosen lain.
    function getDosenByUserId($userId){
        $this->db->select('id_dosen, nama');
        $this->db->from('dosen');
        $this->db->where('id_user', $userId);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();

        return $query->row();
    }

    function getPeriodeList(){
        $this->db->select('*');
        $this->db->from('periode');
        $this->db->order_by('id_periode', 'DESC');
        $query = $this->db->get();

        return $query->result();
    }

    function getPeriodeAktif(){
        $this->db->select('*');
        $this->db->from('periode');
        $this->db->where('status_periode', 1);
        $query = $this->db->get();

        return $query->row();
    }

    function getBidangList(){
        $this->db->select('*');
        $this->db->from('bidang');
        $this->db->where('isDeleted', 0);
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    // Satu proyek boleh punya BEBERAPA bidang sekaligus (SOP: "bisa dipilih lebih dari 1") --
    // $id_bidang berupa array id. Hapus dulu baris lama baru pasang ulang semua yang dipilih.
    function setBidangProyek($id_proyek, $id_bidang){
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

    // Daftar mahasiswa yang memilih proyek ini -- dosen lihat siapa saja yang
    // mengajukan diri, lengkap nomor pilihan & status ajuannya.
    function getMahasiswaPemilihProyek($id_proyek){
        $this->db->select('pt.id_pengajuan_ta, pt.id_ta, pt.pilihan, pt.status, m.id_mahasiswa, m.nim, m.nama AS nama_mahasiswa, m.email');
        $this->db->from('pengajuan_ta pt');
        $this->db->join('tugas_akhir ta', 'ta.id_ta = pt.id_ta', 'inner');
        $this->db->join('mahasiswa m', 'm.id_mahasiswa = ta.id_mahasiswa', 'inner');
        $this->db->where('pt.id_proyek', $id_proyek);
        $this->db->where('pt.jenis', 'proyek');
        $this->db->order_by('pt.status', 'DESC');
        $this->db->order_by('pt.pilihan', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    // Daftar id bidang yang sudah dipilih untuk satu proyek -- dipakai form edit.
    function getBidangIdsForProyek($id_proyek){
        $this->db->select('id_bidang');
        $this->db->from('proyek_bidang');
        $this->db->where('id_proyek', $id_proyek);
        $query = $this->db->get();

        return array_map(fn($row) => (int)$row->id_bidang, $query->result());
    }
    /**
     * This function used to get dosen information
     * @return array $result : This is dosen information
     */
    function getDosen()
    {
        $this->db->select('id_dosen, nama');
        $this->db->from('dosen');
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();

        return $query->result();
    }
    /**
     * This function is used to add new project to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewProject($proyekInfo)
    {
        $this->db->trans_start();
        $this->db->insert('proyek', $proyekInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    /**
     * This function is used to update the user information
     * @param array $proyekInfo : This is project updated information
     * @param number projectId : This is project id
     */
    function editProject($proyekInfo, $proyekId)
    {
        $this->db->where('id_proyek', $proyekId);
        $this->db->update('proyek', $proyekInfo);
        return TRUE;
    }
}
