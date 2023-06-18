<?php
/**
 * Created by nad.
 * Date: 27/03/2018
 * Time: 23:14
 * Description:
 */

class Dashboard_model extends CI_Model
{
    /**
     * This function is used to get total bimbingan mahasiswa
     * @param number $userId : This is get from user who is logged in
     * @return array $result : This is result
     */
    function getCountBimbingan($userId)
    {
        $this->db->select('d.*, ds.id_user');
        $this->db->from('dosbing d');
        $this->db->join('dosen ds', 'ds.id_dosen = d.id_dosen');
        $this->db->join('mahasiswa m', 'm.id_mahasiswa = d.id_mahasiswa');
        $this->db->join('tugas_akhir ta', 'ta.id_mahasiswa = m.id_mahasiswa');
        $this->db->join('sidang s','s.id_mahasiswa = m.id_mahasiswa','left');
        $this->db->join('yudisium y','y.id_mahasiswa = m.id_mahasiswa','left');
        $this->db->join('periode p', 'p.id_periode = ta.id_periode');
        // $this->db->where('p.status_periode', 1);
        $this->db->group_by('m.nama');
        $this->db->where('ds.isDeleted', 0);
        $this->db->where('y.id_yudisium IS NULL');
        $this->db->where('ds.id_user', $userId);
        $query = $this->db->get();
        return count($query->result());
    }
    /**
     * This function is used to get total pendadaran mahasiswa
     * @param number $userId : This is get from user who is logged in
     * @return array $result : This is result
     */
    function getCountPendadaran($userId)
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
        $this->db->where('u.id_user',$userId);
        $this->db->where('v.id_berkas_sidang',1);
        $this->db->where('v.isValid','2');
        $query = $this->db->get();
        return count($query->result());
    }
    /**
     * This function is used to get total pendadaran mahasiswa
     * @param number $userId : This is get from user who is logged in
     * @return array $result : This is result
     */
    function getCountYudisium($userId)
    {
        $this->db->select('d.*, ds.id_user');
        $this->db->from('dosbing d');
        $this->db->join('dosen ds', 'ds.id_dosen = d.id_dosen');
        $this->db->join('mahasiswa m', 'm.id_mahasiswa = d.id_mahasiswa');
        $this->db->join('tugas_akhir ta', 'ta.id_mahasiswa = m.id_mahasiswa');
        $this->db->join('sidang s','s.id_mahasiswa = m.id_mahasiswa','left');
        $this->db->join('yudisium y','y.id_mahasiswa = m.id_mahasiswa','left');
        $this->db->join('periode p', 'p.id_periode = ta.id_periode');
        // $this->db->where('p.status_periode', 1);
        $this->db->group_by('m.nama');
        $this->db->where('ds.isDeleted', 0);
        $this->db->where('y.id_yudisium IS NOT NULL');
        $this->db->where('ds.id_user', $userId);
        $query = $this->db->get();
        return count($query->result());
    }
    /**
     * This function is used to get total project
     * @param number $userId : This is get from user who is logged in
     * @return array $result : This is result
     */
    function getCountProyek($userId)
    {
        $this->db->select('p.id_dosen');
        $this->db->from('proyek p');
        $this->db->join('dosen ds', 'ds.id_dosen = p.id_dosen');
        $this->db->where('ds.isDeleted', 0);
        $this->db->where('ds.id_user', $userId);

        $query = $this->db->get();
        return count($query->result());
    }

}