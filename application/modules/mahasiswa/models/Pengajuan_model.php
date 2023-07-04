<?php

/**
 * Created by nad.
 * Date: 22/03/2018
 * Time: 13:15
 * Description:
 */

class Pengajuan_model extends CI_Model
{
    /**
     * This function is used to get the periode to access page
     * @return array $result : This is result
     */
    function getPeriode()
    {
        $this->db->select('id_periode, status_periode, tgl_awal_regis_ta, tgl_akhir_regis_ta');
        $this->db->from('periode');
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    /**
     * This function is used to get the tugas_akhir by id_mahasiswa
     * @return array $result : This is result
     */
    function getTa($id_mahasiswa)
    {
        $this->db->select('ta.id_ta, ta.reason, ta.status_pengambilan, pt.id_pengajuan_ta, pt.pilihan, pt.jenis, p.id_proyek, p.nama, p.deskripsi as deskripsi_proyek, p.tools, u.id_usulan, u.judul, u.deskripsi, u.bisnis_rule, u.file_persetujuan');
        $this->db->from('tugas_akhir as ta');
        $this->db->join('pengajuan_ta as pt', 'pt.id_ta=ta.id_ta');
        $this->db->join('proyek as p', 'pt.id_proyek=p.id_proyek', 'left');
        $this->db->join('usulan as u', 'pt.id_pengajuan_ta=u.id_pengajuan_ta', 'left');
        $this->db->where('ta.id_mahasiswa', $id_mahasiswa);
        $this->db->order_by('pt.pilihan');
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    /**
     * This function is used to get id_mahasiswa who is logged in
     * @param $userId : This is input id_user
     * @return array $result : This is result
     */
    function getIdMahasiswa($userId)
    {
        $this->db->select('*');
        $this->db->from('mahasiswa');
        $this->db->where('id_user', $userId);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    /**
     * This function is used to add data to tugas_akhir table
     * @param $ta_info : This is input ta_info
     * @return array $insert_id : This is get new id_ta
     */
    function addNewTa($ta)
    {
        $this->db->trans_start();
        $this->db->insert('tugas_akhir', $ta);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    /**
     * This function is used to add data to pengajuan_ta table
     * @param $pengajuan_ta : This is input pengajuan_ta
     * @return array $insert_id : This is get new id_pengajuan_ta
     */
    function addNewPengajuanTa($pengajuan_ta)
    {
        $this->db->trans_start();
        $this->db->insert('pengajuan_ta', $pengajuan_ta);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    /**
     * This function is used to add data to usulan table
     * @param $usulan : This is input usulan
     * @return array $insert_id : This is get new usulan
     */
    function addNewUsulan($usulan)
    {
        $this->db->trans_start();
        $this->db->insert('usulan', $usulan);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }
    function getPengajuanTa($id_pengajuan_ta)
    {

        $this->db->where('id_pengajuan_ta', $id_pengajuan_ta);
        $this->db->select('*');
        $this->db->from('pengajuan_ta');
        $this->db->where('id_pengajuan_ta', $id_pengajuan_ta);
        $pengajuan = $this->db->get()->result();

        return $pengajuan;
    }
    public function update_ta($id_ta, $data_ta)
    {
        $this->db->trans_start();

        $this->db->where('id_ta', $id_ta);
        $this->db->update('tugas_akhir', $data_ta);

        $this->db->trans_complete();

        $result = $this->db->trans_status();

        return $result;
    }

    /**
     * This function is used to edit data to pengajuan_ta table
     * @param $pengajuan_ta : This is input pengajuan array
     * @param $id_pengajuan_ta : This is input id_pengajuan_ta where to update
     * @return : true
     */
    function editPengajuanTa($pengajuan_ta, $id_pengajuan_ta)
    {

        $this->db->where('id_pengajuan_ta', $id_pengajuan_ta);
        $this->db->update('pengajuan_ta', $pengajuan_ta);

        return TRUE;
    }
    /**
     * This function is used to edit data to usulan table
     * @param $usulan : This is input usulan array
     * @param $id_usulan : This is input id_usulan where to update
     * @return : true
     */
    function editUsulan($usulan, $id_usulan)
    {
        $this->db->select('*');
        $this->db->from('usulan');
        $this->db->where('id_usulan', $id_usulan);
        $nama_file = $this->db->get()->result()[0]->file_persetujuan;

        unlink('./uploads/persetujuan/' . $nama_file);
        $this->db->trans_start();

        $this->db->where('id_usulan', $id_usulan);
        $this->db->update('usulan', $usulan);

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    function deleteUsulan($id_usulan)
    {
        $this->db->select('*');
        $this->db->from('usulan');
        $this->db->where('id_usulan', $id_usulan);
        $nama_file = $this->db->get()->result()[0]->file_persetujuan;

        unlink('./uploads/persetujuan/' . $nama_file);

        $this->db->trans_start();

        $this->db->where('id_usulan', $id_usulan);
        $this->db->delete('usulan');

        $this->db->trans_complete();


        return $this->db->trans_status();
    }

    function getDosbing($id_mahasiswa)
    {
        $this->db->select('*');
        $this->db->from('dosbing d');
        $this->db->join('dosen ds', 'ds.id_dosen=d.id_dosen', 'left');
        $this->db->where('d.id_mahasiswa', $id_mahasiswa);
        return $this->db->get()->result();
    }

    function getBimbingan($id_ta)
    {
        $this->db->select('*');
        $this->db->from('bimbingan b');
        $this->db->where('b.id_ta', $id_ta);
        $this->db->order_by('id DESC');
        return $this->db->get()->result();
    }
    /**
     * Get data TA yang telah terplotting pada mahasiswa tertentu
     * @param $id_mahasiswa : id dari mahasiswa
     * @return : $array_data
     */
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
                    'judul_ta' => $record_usulan[0]->judul,
                    'dosbing' => $record_usulan[0]->nama_dosen,
                    'progress' => $record[0]->progress,
                ];
                return $array_ta;
            }
        } else {
            return FALSE;
        }
    }

    function nonaktivasiTA($id_ta, $data, $judul_ta)
    {
        $this->db->trans_start();
        //delete row tabel dosbing
        $this->db->select('id_mahasiswa');
        $this->db->from('tugas_akhir');
        $this->db->where('id_ta', $id_ta);
        $id_mahasiswa = $this->db->get()->result()[0]->id_mahasiswa;

        $this->db->where('id_mahasiswa', $id_mahasiswa);
        $this->db->delete('dosbing');

        //tambah di log pesan
        $array = [
            'id_mahasiswa' => $id_mahasiswa,
            'nama' => 'Tugas akhir telah dinonaktifkan',
            'deskripsi' => 'Tugas akhir anda yang berjudul <strong>"' . $judul_ta . '"</strong> telah dinonaktifkan'
        ];
        $this->db->insert('log_pesan', $array);

        //delete tabel tugas akhir
        $this->db->where('id_ta', $id_ta);
        $this->db->delete('tugas_akhir');

        $this->db->trans_complete();
        $result = $this->db->trans_status();

        return $result;
    }

    function isDataMahasiswaLengkap($id_mahasiswa)
    {
        $this->db->select('*');
        $this->db->from('mahasiswa');
        $this->db->where('id_mahasiswa', $id_mahasiswa);
        $query = $this->db->get();

        $result = $query->result();
        $nim = $result[0]->nama;
        $mobile = $result[0]->mobile;
        $email = $result[0]->email;
        $ipk = $result[0]->ipk;
        $jumlah_SKS = $result[0]->jumlah_SKS;
        $skill = $result[0]->skill;
        $pengalaman = $result[0]->pengalaman;

        if (empty($nim) || empty($mobile) || empty($email) || empty($ipk) || empty($jumlah_SKS) || empty($skill) || empty($pengalaman)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function getProyek($id_proyek = NULL)
    {
        if ($id_proyek == NULL) {
            $query = $this->db->query(
                'SELECT *,p.nama nama_proyek,d.nama nama_dosen FROM proyek p
                INNER JOIN dosen d ON d.id_dosen = p.id_dosen
                WHERE p.id_proyek 
                NOT IN (
                SELECT id_proyek FROM pengajuan_ta pt WHERE pt.status = \'diterima\' AND id_proyek IS NOT NULL
                ) AND p.status = \'disetujui\''
            );
        }

        if ($id_proyek != NULL) {
            $this->db->select("*,p.nama nama_proyek,d.nama nama_dosen");
            $this->db->from('proyek p');
            $this->db->join('dosen d', 'd.id_dosen = p.id_dosen', 'inner');
            $this->db->where('id_proyek', $id_proyek);
            $query = $this->db->get();
        }

        return $query->result();
    }

    function getCountActiveBimbingan($userId)
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
        $this->db->where('y.id_yudisium IS NULL');
        $this->db->where('ds.id_user', $userId);
        $query = $this->db->get();
        return count($query->result());
    }

    function getCountActivePendadaran($userId)
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
        // $this->db->where('v.id_berkas_sidang', 1);
        // $this->db->where('v.isValid', '2');
        $this->db->group_by('m.id_mahasiswa');
        $query = $this->db->get();
        return count($query->result());
    }

    public function getDosen($id_dosen = NULL)
    {
        $this->db->select("*");
        $this->db->from('dosen');
        $this->db->where('isDeleted', 0);
        if ($id_dosen != NULL) {
            $this->db->where('id_dosen', $id_dosen);
            $query = $this->db->get()->result();
        } else {
            $query = $this->db->get()->result();
            foreach ($query as $key => $value) {
                $activeBimbingan = $this->getCountActiveBimbingan($value->id_user);

                $sisaKuota = $value->kuota_mahasiswa - ($activeBimbingan);

                if ($sisaKuota <= 0) {
                    unset($query[$key]);
                }
            }
        }

        return $query;
    }
}
