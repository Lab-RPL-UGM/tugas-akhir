<?php

/**
 * Created by nad.
 * Date: 26/03/2018
 * Time: 16:50
 * Description:
 */

class Bimbingan_model extends CI_Model
{
    /**
     * This function is used to get the bimbingan list
     * @param number $userId : This is get from user who is logged in
     * @return array $result : This is result
     */
    function getBimbingan($userId)
    {
        $this->db->select('m.id_mahasiswa, m.nim, m.nama, s.id_sidang, t.id_ta, y.id_yudisium');
        $this->db->from('dosbing ds');
        $this->db->join('dosen d', 'd.id_dosen = ds.id_dosen');
        $this->db->join('mahasiswa m', 'm.id_mahasiswa = ds.id_mahasiswa');
        $this->db->join('tugas_akhir t', 't.id_mahasiswa = m.id_mahasiswa');
        $this->db->join('pengajuan_ta ta', 'ta.id_ta = t.id_ta');

        $this->db->join('sidang s', 's.id_mahasiswa = m.id_mahasiswa', 'left');
        $this->db->join('yudisium y', 'y.id_mahasiswa = m.id_mahasiswa', 'left');

        $this->db->where('d.id_user', $userId);
        $this->db->where('m.isDeleted', 0);
        $this->db->where('y.id_yudisium IS NULL');
        $this->db->where('t.status_pengambilan', 'terplotting');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    function getBimbinganMahasiswa($mahasiswaId)
    {
        $this->db->select('m.id_mahasiswa, m.nim, m.nama, s.id_sidang, t.id_ta, y.id_yudisium');
        $this->db->from('dosbing ds');
        $this->db->join('dosen d', 'd.id_dosen = ds.id_dosen');
        $this->db->join('mahasiswa m', 'm.id_mahasiswa = ds.id_mahasiswa');
        $this->db->join('tugas_akhir t', 't.id_mahasiswa = m.id_mahasiswa');
        $this->db->join('pengajuan_ta ta', 'ta.id_ta = t.id_ta');

        $this->db->join('sidang s', 's.id_mahasiswa = m.id_mahasiswa', 'left');
        $this->db->join('yudisium y', 'y.id_mahasiswa = m.id_mahasiswa', 'left');

        $this->db->where('m.id_mahasiswa', $mahasiswaId);
        $this->db->where('m.isDeleted', 0);
        $this->db->where('y.id_yudisium IS NULL');
        $this->db->where('t.status_pengambilan', 'terplotting');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    function getTATerplotting($id_mahasiswa)
    {
        $this->db->select('*');
        $this->db->from('tugas_akhir ta');
        $this->db->join('pengajuan_ta pt', 'pt.id_ta=ta.id_ta', 'inner');
        $this->db->where('ta.id_mahasiswa', $id_mahasiswa);
        $this->db->where('ta.status_pengambilan', 'terplotting');
        $this->db->where('pt.status', 'diterima');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $record = $query->result();
            if ($record[0]->id_proyek != NULL) {
                $id_proyek = $record[0]->id_proyek;
                $this->db->select('*,p.nama nama_proyek,d.nama nama_dosen');
                $this->db->from('proyek p');
                $this->db->join('dosen d', 'd.id_dosen=p.id_dosen', 'inner');
                $this->db->where('p.id_proyek', $id_proyek);

                $record_proyek = $this->db->get()->result();
                $array_ta = [
                    'id_ta' => $record[0]->id_ta,
                    'jenis' => 'proyek',
                    'judul_ta' => $record_proyek[0]->nama_proyek,
                    'dosbing' => $record_proyek[0]->nama_dosen,
                    'progress' => $record[0]->progress,
                ];
                return $array_ta;
            } else {
                $id_pengajuan_ta = $record[0]->id_pengajuan_ta;
                $this->db->select('*,d.nama nama_dosen');
                $this->db->from('usulan u');
                $this->db->join('dosen d', 'd.id_dosen=u.id_dosen', 'inner');
                $this->db->where('u.id_pengajuan_ta', $id_pengajuan_ta);

                $record_usulan = $this->db->get()->result();

                $array_ta = [
                    'id_ta' => $record[0]->id_ta,
                    'jenis' => 'usul',
                    'judul_ta' => $record_usulan[0]->judul,
                    'dosbing' => $record_usulan[0]->nama_dosen,
                    'progress' => $record[0]->progress,
                    'file' => $record_usulan[0]->file_persetujuan,
                    'mitra' => $record_usulan[0]->mitra,
                    'deskripsi' => $record_usulan[0]->deskripsi,
                ];
                return $array_ta;
            }
        } else {
            return FALSE;
        }
    }
    function getDosbing($id_mahasiswa)
    {
        $this->db->select('*');
        $this->db->from('dosbing d');
        $this->db->join('dosen ds', 'ds.id_dosen=d.id_dosen', 'left');
        $this->db->where('d.id_mahasiswa', $id_mahasiswa);
        return $this->db->get()->result();
    }

    /**
     * Dosen menentukan/mengubah judul Tugas Akhir mahasiswa bimbingannya (jenis usul
     * saja -- judul proyek datang dari katalog proyek, bukan usulan mahasiswa) setelah
     * berdiskusi. $userId dicocokkan ke dosbing supaya cuma dosen pembimbing mahasiswa
     * ini yang bisa mengubahnya, bukan sembarang dosen yang login.
     * @return bool TRUE kalau berhasil, FALSE kalau tidak ditemukan / bukan pembimbingnya
     */
    function updateJudulUsulan($id_ta, $judul, $userId)
    {
        $this->db->select('pt.id_pengajuan_ta');
        $this->db->from('pengajuan_ta pt');
        $this->db->join('tugas_akhir ta', 'ta.id_ta = pt.id_ta');
        $this->db->join('dosbing db', 'db.id_mahasiswa = ta.id_mahasiswa');
        $this->db->join('dosen d', 'd.id_dosen = db.id_dosen');
        $this->db->where('pt.id_ta', $id_ta);
        $this->db->where('pt.status', 'diterima');
        $this->db->where('pt.jenis', 'usul');
        $this->db->where('d.id_user', $userId);
        $row = $this->db->get()->row();

        if (!$row) {
            return FALSE;
        }

        $this->db->where('id_pengajuan_ta', $row->id_pengajuan_ta);
        return $this->db->update('usulan', array('judul' => $judul));
    }

    function getBimbinganProgress($id_ta)
    {
        $this->db->select('*');
        $this->db->from('bimbingan b');
        $this->db->where('b.id_ta', $id_ta);
        $this->db->order_by('id DESC');
        return $this->db->get()->result();
    }
    /**
     * This function is used to get the detail mahasiswa
     * @param number $idMhs : This is get mahasiswa by id
     * @return array $result : This is result
     */
    function getMahasiswa($idMhs)
    {
        $this->db->select('*');
        $this->db->from('mahasiswa');
        $this->db->where('id_mahasiswa', $idMhs);
        $query = $this->db->get();

        return $query->result();
    }
}
