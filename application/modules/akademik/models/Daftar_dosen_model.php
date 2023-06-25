<?php defined('BASEPATH') or exit('No direct script access allowed');

class Daftar_dosen_model extends CI_Model
{
    public function getDosen($id_dosen = NULL)
    {
        $this->db->select("*");
        $this->db->from('dosen');
        $this->db->where('isDeleted', 0);
        if ($id_dosen != NULL) {
            $this->db->where('id_dosen', $id_dosen);
        }
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    function getCountBimbingan($userId)
    {
        $this->db->select('d.*, ds.id_user');
        $this->db->from('dosbing d');
        $this->db->join('dosen ds', 'ds.id_dosen = d.id_dosen');
        $this->db->join('mahasiswa m', 'm.id_mahasiswa = d.id_mahasiswa');
        $this->db->join('tugas_akhir ta', 'ta.id_mahasiswa = m.id_mahasiswa');
        $this->db->join('sidang s', 's.id_mahasiswa = m.id_mahasiswa', 'left');
        $this->db->join('yudisium y', 'y.id_mahasiswa = m.id_mahasiswa', 'left');
        $this->db->join('periode p', 'p.id_periode = ta.id_periode');
        // $this->db->where('p.status_periode', 1);
        $this->db->group_by('m.nama');
        $this->db->where('ds.isDeleted', 0);
        $this->db->where('ta.status_pengambilan', 'terplotting');
        $this->db->where('y.id_yudisium IS NULL');
        $this->db->where('ds.id_dosen', $userId);
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
        $this->db->where('d.id_dosen', $userId);
        $this->db->where('v.id_berkas_sidang', 1);
        $this->db->where('v.isValid', '2');
        $query = $this->db->get();
        return count($query->result());
    }

    public function getBimbinganCount($id_dosen)
    {
        $this->db->select("*");
        $this->db->from('dosbing');
        $this->db->where('id_dosen', $id_dosen);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return FALSE;
        }
    }

    public function getSidangCount($id_dosen)
    {
        $this->db->select("*");
        $this->db->from('anggota_sidang');
        $this->db->where('id_dosen', $id_dosen);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return FALSE;
        }
    }

    public function getBimbingan($id_dosen)
    {
        $this->db->select("*");
        $this->db->from('dosbing ds');
        $this->db->join('mahasiswa m', 'm.id_mahasiswa=ds.id_mahasiswa', 'inner');
        $this->db->where('ds.id_dosen', $id_dosen);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function getJudulTA($id_mahasiswa)
    {
        $this->db->select("*");
        $this->db->from('mahasiswa m');
        $this->db->join('tugas_akhir ta', 'ta.id_mahasiswa=m.id_mahasiswa', 'inner');
        $this->db->join('pengajuan_ta pta', 'pta.id_ta=ta.id_ta', 'inner');
        $this->db->where('m.id_mahasiswa', $id_mahasiswa);
        $this->db->where('pta.status', 'diterima');
        $this->db->where('ta.status_pengambilan', 'terplotting');
        $this->db->where('m.isDeleted', 0);

        $query_pengajuan = $this->db->get();
        if ($query_pengajuan->num_rows() > 0) {
            if ($query_pengajuan->result()[0]->id_proyek != NULL) {
                $id_proyek = $query_pengajuan->result()[0]->id_proyek;
                $this->db->select("*");
                $this->db->from('proyek');
                $this->db->where('id_proyek', $id_proyek);

                $query_proyek = $this->db->get();

                return $query_proyek->result()[0]->nama;
            } else {
                $id_pengajuan_ta = $query_pengajuan->result()[0]->id_pengajuan_ta;
                $this->db->select("*");
                $this->db->from('usulan');
                $this->db->where('id_pengajuan_ta', $id_pengajuan_ta);

                $query_usulan = $this->db->get();

                return $query_usulan->result()[0]->judul;
            }
        } else {
            return FALSE;
        }
    }

    public function isJudul($id_mahasiswa)
    {
        $this->db->select("*");
        $this->db->from('tugas_akhir');
        $this->db->where('id_mahasiswa', $id_mahasiswa);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function isSidang($id_mahasiswa)
    {
        $this->db->select("*");
        $this->db->from('sidang');
        $this->db->group_start();
        $this->db->where('status', 'disetujui');
        $this->db->or_where('status', 'lulus_revisi');
        $this->db->or_where('status', 'lulus');
        $this->db->group_end();
        $this->db->where('id_mahasiswa', $id_mahasiswa);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_nilai_akhir($id_mahasiswa)
    {
        $this->db->select("*");
        $this->db->from('sidang');
        if ($id_mahasiswa != NULL) {
            $this->db->where('id_mahasiswa', $id_mahasiswa);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function isYudisium($id_mahasiswa)
    {
        $this->db->select("*");
        $this->db->from('yudisium');
        $this->db->where('id_mahasiswa', $id_mahasiswa);
        $this->db->where('status', 'disetujui');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
