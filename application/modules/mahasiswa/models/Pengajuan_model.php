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
     * This function is used to get the proyek list
     * @return array $result : This is result
     * where proyek = disetujui AND status pengajuan_ta != diterima AND sidang status_pengambilan != 'terplotting'
     */
    function getProyek()
    {
        $query = $this->db->query(
            'SELECT p.id_proyek, p.nama FROM proyek p
            WHERE p.id_proyek 
            NOT IN (
            SELECT id_proyek FROM pengajuan_ta pt WHERE pt.status = \'diterima\' AND id_proyek IS NOT NULL
            ) AND p.status = \'disetujui\''
        );

        $result = $query->result();
        return $result;
    }
    /**
     * This function is used to get the tugas_akhir by id_mahasiswa
     * @return array $result : This is result
     */
    function getTa($id_mahasiswa)
    {
        $this->db->select('ta.id_ta, ta.reason, ta.status_pengambilan, pt.id_pengajuan_ta, pt.pilihan, pt.jenis, p.id_proyek, p.nama, u.id_usulan, u.judul, u.deskripsi, u.bisnis_rule, u.file_persetujuan');
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
        $this->db->select('id_mahasiswa');
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
}
