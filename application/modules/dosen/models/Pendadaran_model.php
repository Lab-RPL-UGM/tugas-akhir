<?php

/**
 * Created by nad.
 * Date: 26/03/2018
 * Time: 13:56
 * Description:
 */

class Pendadaran_model extends CI_Model
{
    /**
     * This function is used to get the mahasiswa pendadaran list
     * @param number $userId : This is get from user who is logged in
     * @return array $result : This is result
     */
    function getSidang($userId)
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
        $this->db->where('u.id_user', $userId);
        $this->db->where('m.isDeleted', 0);
        // $this->db->where('v.id_berkas_sidang', 1);
        // $this->db->where('v.isValid', '2');
        $this->db->order_by('j.tanggal', 'DESC');
        $this->db->group_by('m.id_mahasiswa');
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    /**
     * This function is used to get the nilai info mahasiswa
     * @param $userId : This is get from user who is logged in
     * @return array $result : This is result
     */
    //    get komponen nilai tiap dosen untuk insert
    function getNilaiInfo($userId, $nilaiId)
    {
        $this->db->select('p.id_sidang, p.id_penilaian, p.nilai_akhir_dosen, k.id_komponen, k.nama nama_nilai,
         kn.id_komponen_nilai, kn.nilai, a.id_anggota_sidang, m.id_mahasiswa, s.status');
        $this->db->from('penilaian p');
        $this->db->join('anggota_sidang a', 'a.id_anggota_sidang = p.id_anggota_sidang');
        $this->db->join('dosen d', 'd.id_dosen = a.id_dosen');
        $this->db->join('user u', 'u.id_user = d.id_user');
        $this->db->join('komponen_nilai kn', 'kn.id_penilaian = p.id_penilaian');
        $this->db->join('komponen k', 'k.id_komponen = kn.id_komponen');
        $this->db->join('sidang s', 's.id_sidang = a.id_sidang');
        $this->db->join('mahasiswa m', 'm.id_mahasiswa = s.id_mahasiswa');
        $this->db->where('u.id_user', $userId);
        $this->db->where('p.id_penilaian', $nilaiId);
        $this->db->where('k.isDeleted', 0);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    //    get komponen nilai tiap dosen untuk update
    function getNilaiInfoEdit($userId, $nilaiId)
    {
        $this->db->select('p.id_sidang, p.id_penilaian, p.nilai_akhir_dosen, k.id_komponen, k.nama nama_nilai,
         kn.id_komponen_nilai, kn.nilai, a.id_anggota_sidang, m.id_mahasiswa, s.status');
        $this->db->from('penilaian p');
        $this->db->join('anggota_sidang a', 'a.id_anggota_sidang = p.id_anggota_sidang');
        $this->db->join('dosen d', 'd.id_dosen = a.id_dosen');
        $this->db->join('user u', 'u.id_user = d.id_user');
        $this->db->join('komponen_nilai kn', 'kn.id_penilaian = p.id_penilaian');
        $this->db->join('komponen k', 'k.id_komponen = kn.id_komponen');
        $this->db->join('sidang s', 's.id_sidang = a.id_sidang');
        $this->db->join('mahasiswa m', 'm.id_mahasiswa = s.id_mahasiswa');
        $this->db->where('u.id_user', $userId);
        $this->db->where('p.id_penilaian', $nilaiId);
        $this->db->where('kn.nilai !=', null);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    //    get jumlah total nilai tiap anggota
    function getTotalNilaiInfoKetua($userId, $nilaiId)
    {
        $this->db->select('sum(kn.nilai) total_nilai');
        $this->db->from('penilaian p');
        $this->db->join('anggota_sidang a', 'a.id_anggota_sidang = p.id_anggota_sidang');
        $this->db->join('dosen d', 'd.id_dosen = a.id_dosen');
        $this->db->join('user u', 'u.id_user = d.id_user');
        $this->db->join('komponen_nilai kn', 'kn.id_penilaian = p.id_penilaian');
        $this->db->join('sidang s', 's.id_sidang = a.id_sidang');
        $this->db->join('mahasiswa m', 'm.id_mahasiswa = s.id_mahasiswa');
        $this->db->where('u.id_user', $userId);
        $this->db->where('p.id_penilaian', $nilaiId);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    /**
     * This function is used to get the revisi info mahasiswa
     * @param $userId : This is get from user who is logged in
     * @return array $result : This is result
     */
    function getRevisiInfo($userId)
    {
        $this->db->select('r.path');
        $this->db->from('revisi_sidang r');
        $this->db->join('anggota_sidang a', 'a.id_anggota_sidang = r.id_anggota_sidang');
        $this->db->join('dosen d', 'd.id_dosen = a.id_dosen');
        $this->db->join('user u', 'u.id_user = d.id_user');
        $this->db->where('u.id_user', $userId);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    //    count jumlah anggota sidang yang hadir
    function getCountAnggota($idSidang)
    {
        $this->db->select('a.id_anggota_sidang');
        $this->db->from('anggota_sidang a');
        $this->db->where('a.id_sidang', $idSidang);
        $this->db->where('a.role !=', null);

        $query = $this->db->get();
        return count($query->result());
    }
    //
    function getSekre($userId)
    {
        $this->db->select('a.role, d.nama');
        $this->db->from('anggota_sidang a');
        $this->db->join('dosen d', 'd.id_dosen=a.id_dosen');
        $this->db->join('user u', 'u.id_user=d.id_user');
        $this->db->where('u.id_user', $userId);
        $this->db->where('a.role', 'sekretaris');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    function getAnggota($userId)
    {
        $this->db->select('a.role, d.nama');
        $this->db->from('anggota_sidang a');
        $this->db->join('dosen d', 'd.id_dosen=a.id_dosen');
        $this->db->join('user u', 'u.id_user=d.id_user');
        $this->db->where('u.id_user', $userId);
        $this->db->where('a.role', 'anggota');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    function getKetua($userId)
    {
        $this->db->select('a.role, d.nama');
        $this->db->from('anggota_sidang a');
        $this->db->join('dosen d', 'd.id_dosen=a.id_dosen');
        $this->db->join('user u', 'u.id_user=d.id_user');
        $this->db->where('u.id_user', $userId);
        $this->db->where('a.role', 'ketua');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    function getKetuaSidang($idSidang)
    {
        $this->db->select('a.role, d.nama, u.id_user');
        $this->db->from('anggota_sidang a');
        $this->db->join('dosen d', 'd.id_dosen=a.id_dosen');
        $this->db->join('user u', 'u.id_user=d.id_user');
        $this->db->where('a.id_sidang', $idSidang);
        $this->db->where('a.role', 'ketua');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    function getSekertarisSidang($idSidang)
    {
        $this->db->select('a.role, d.nama, u.id_user');
        $this->db->from('anggota_sidang a');
        $this->db->join('dosen d', 'd.id_dosen=a.id_dosen');
        $this->db->join('user u', 'u.id_user=d.id_user');
        $this->db->where('a.id_sidang', $idSidang);
        $this->db->where('a.role', 'sekretaris');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    //    get total penilaian seluruh oleh anggota sidang  > show to ketua sidang
    function getPenilaian($idSidang)
    {
        //        $this->db->select('sum(kn.nilai) total_nilai');
        $this->db->select('a.role, p.nilai_akhir_dosen, sum(k.nilai) sum_nilai');
        $this->db->from('penilaian p');
        $this->db->join('komponen_nilai k', 'k.id_penilaian=p.id_penilaian', 'left');
        $this->db->join('sidang s', 's.id_sidang=p.id_sidang', 'left');
        $this->db->join('anggota_sidang a', 'a.id_anggota_sidang=p.id_anggota_sidang', 'left');
        $this->db->where('p.id_sidang', $idSidang);
        $this->db->group_by('a.role');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    //    get penilaian rata anggota sidang di total akhir
    function getPenilaianRata($idSidang)
    {
        $this->db->select('avg(p.nilai_akhir_dosen) avg_nilai');
        $this->db->from('penilaian p');
        $this->db->join('sidang s', 's.id_sidang=p.id_sidang', 'left');
        $this->db->join('anggota_sidang a', 'a.id_anggota_sidang=p.id_anggota_sidang', 'left');
        $this->db->where('p.id_sidang', $idSidang);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    /**
     * This function is used to edit komponen_nilai mahasiswa
     * @param array $data : This is array data include nilai
     * @param $idKomponenNilai : This is get id each komponen_nilai
     * @return array $result : This is result
     */
    function editKomponenNilai($data, $idKomponenNilai)
    {
        $this->db->where('id_komponen_nilai', $idKomponenNilai);
        $this->db->update('komponen_nilai', $data);
        return TRUE;
    }
    /**
     * This function is used to edit penilaian mahasiswa
     * @param array $total : This is array data include nilai average
     * @param $penilaianId : This is get id each penilaian
     * @return array $result : This is result
     */
    function editPenilaian($total, $penilaianId)
    {
        $this->db->set('nilai_akhir_dosen', $total);
        $this->db->where('id_penilaian', $penilaianId);
        $this->db->update('penilaian');
        return TRUE;
    }
    /**
     * This function is used to edit sidang mahasiswa STATUS = lulus || lulus_revisi || mengulang
     * @param array $sidangInfo : This is array data include status, nilai_akhir_sidang
     * @param $idSidang : This is get id each sidang
     * @return bool true : where affected row increase
     */
    function editSidang($sidangInfo, $idSidang)
    {
        $this->db->where('id_sidang', $idSidang);
        $this->db->update('sidang', $sidangInfo);
        return TRUE;
    }
    /**
     * This function is used to add new revisi report file
     * @param array $revisiInfo : This is validasi information list
     * @return number $insert_id : This is last inserted id
     */
    function addNewRevisi($revisiInfo)
    {
        $this->db->trans_start();
        $this->db->insert('revisi_sidang', $revisiInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
    /**
     * This function is used to add pesan to log_pesan
     * @param array $pesanInfo : This is pesan information list
     * @return number $insert_id : This is last inserted id
     */
    function addPesan($pesanInfo)
    {
        $this->db->trans_start();
        $this->db->insert('log_pesan', $pesanInfo);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
}
