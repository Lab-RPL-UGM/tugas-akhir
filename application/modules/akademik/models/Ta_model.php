<?php defined('BASEPATH') or exit('No direct script access allowed');

class Ta_model extends CI_Model
{
    public function getTA($id = NULL)
    {
        $this->db->select("*");
        $this->db->from('tugas_akhir ta');
        $this->db->join('mahasiswa m', 'm.id_mahasiswa = ta.id_mahasiswa', 'inner');
        $this->db->join('periode p', 'p.id_periode = ta.id_periode', 'inner');
        if ($id != NULL) {
            $this->db->where('id_ta', $id);
        } else {
            $this->db->order_by('ta.createdDtm DESC');
        }
        $query = $this->db->get();

        return $query->result();
    }

    function getDosenTA()
    {
        $this->db->select('id_dosen, nama nama_dosen');
        $this->db->from('dosen');
        $this->db->where('isDeleted', 0);
        $this->db->where_not_in('id_dosen');

        $query = $this->db->get();
        return $query->result();
    }

    public function isMasaRegisTA()
    {
        $this->db->select("*");
        $this->db->from("periode");
        $this->db->where("status_periode", 1);
        $result = $this->db->get()->result();

        $tanggal_sekarang = date("Y-m-d");
        $status_regis_ta = $tanggal_sekarang >= $result[0]->tgl_awal_regis_ta && $tanggal_sekarang <= $result[0]->tgl_akhir_regis_ta;

        return $status_regis_ta;
    }

    public function getPengajuanTA($id_ta, $status = NULL)
    {
        $this->db->select("pt.*, d.id_dosen");
        $this->db->from('pengajuan_ta pt');
        $this->db->join('tugas_akhir ta', 'pt.id_ta = ta.id_ta');
        $this->db->join('mahasiswa m', 'm.id_mahasiswa = ta.id_mahasiswa');
        $this->db->join('dosbing d', 'd.id_mahasiswa = m.id_mahasiswa', 'left');
        $this->db->where('pt.id_ta', $id_ta);
        if ($status != NULL) {
            $this->db->where('pt.status', $status);
        }
        $this->db->order_by('pt.pilihan', 'ASC');
        $this->db->order_by('d.id_dosbing', 'ASC');
        $query = $this->db->get();

        return $query->result();
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
            $this->db->select("*,p.nama nama_proyek,p.deskripsi,p.tools,d.nama nama_dosen");
            $this->db->from('proyek p');
            $this->db->join('dosen d', 'd.id_dosen = p.id_dosen', 'inner');
            $this->db->where('id_proyek', $id_proyek);
            $query = $this->db->get();
        }

        return $query->result();
    }

    public function getUsulan($id_pengajuan_ta)
    {
        $this->db->select("*");
        $this->db->from('usulan');
        $this->db->where('id_pengajuan_ta', $id_pengajuan_ta);
        $query = $this->db->get();

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

    public function check_proyek($id_proyek)
    {
        $this->db->select("*");
        $this->db->from('pengajuan_ta');
        $this->db->where('id_proyek', $id_proyek);
        $this->db->where('status', 'diterima');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getStatus()
    {
        $this->db->select("status");
        $this->db->from('proyek');
        $query = $this->db->get();

        return $query->result();
    }

    public function insert($data)
    {
        $this->db->trans_start();
        $this->db->insert('proyek', $data);
        $this->db->trans_complete();
        $result = $this->db->trans_status();

        return $result;
    }

    public function update($data, $id)
    {
        $this->db->trans_start();
        $this->db->where('id_proyek', $id);
        $this->db->update('proyek', $data);
        $this->db->trans_complete();
        $result = $this->db->trans_status();

        return $result;
    }

    function getDosbing($id_mahasiswa)
    {
        $this->db->select('*');
        $this->db->from('dosbing d');
        $this->db->join('dosen ds', 'ds.id_dosen=d.id_dosen', 'left');
        $this->db->where('d.id_mahasiswa', $id_mahasiswa);
        return $this->db->get()->result();
    }

    public function delete($id)
    {
        $this->db->trans_start();

        $this->db->set('isDeleted', 1);
        $this->db->where('id_proyek', $id);
        $this->db->update('proyek');

        $this->db->trans_complete();
        $result = $this->db->trans_status();

        return $result;
    }

    public function revisi_ta($id_ta, $reason)
    {
        $this->db->trans_start();

        /* Update tabel tugas_akhir*/
        $data_ta = array(
            'status_pengambilan' => 'revisi',
            'reason' => $reason
        );

        $this->db->where('id_ta', $id_ta);
        $this->db->update('tugas_akhir', $data_ta);

        $this->db->trans_complete();

        $result = $this->db->trans_status();

        return $result;
    }

    public function terima_ta($id_ta, $id_pengajuan_ta = NULL, $id_mahasiswa, $data, $id_proyek = NULL, $id_dosen = NULL, $id_dosen2 = NULL)
    {
        $this->db->trans_start();

        if ($id_pengajuan_ta != NULL) {
            /* Update tabel pengajuan_ta*/
            $this->db->where('id_pengajuan_ta', $id_pengajuan_ta);
            $this->db->update('pengajuan_ta', $data);

            $this->db->where('id_pengajuan_ta !=', $id_pengajuan_ta);
            $this->db->where('id_ta', $id_ta);
            $this->db->delete('pengajuan_ta');
        } else {
            $this->db->where('id_ta', $id_ta);
            $this->db->delete('pengajuan_ta', $data_another_row);

            /* Insert tabel pengajuan_ta */
            $this->db->insert('pengajuan_ta', $data);
        }


        /* Update tabel tugas_akhir*/
        $data_ta = array(
            'status_pengambilan' => 'terplotting'
        );

        $this->db->where('id_ta', $id_ta);
        $this->db->update('tugas_akhir', $data_ta);

        $this->db->where('id_mahasiswa', $id_mahasiswa);
        $this->db->delete('dosbing');

        if ($id_proyek != NULL) {
            $result = $this->getProyek($id_proyek);
            $judul_ta = $result[0]->nama_proyek;
            $nama_dosen = $result[0]->nama_dosen;

            /* Insert tabel dosbing*/
            $data_dosbing = array(
                'id_dosen' => $result[0]->id_dosen,
                'id_mahasiswa' => $id_mahasiswa
            );
            $this->db->insert('dosbing', $data_dosbing);

            if (!empty($id_dosen2)) {
                $data_dosbing = array(
                    'id_dosen' => $id_dosen2,
                    'id_mahasiswa' => $id_mahasiswa
                );
                $this->db->insert('dosbing', $data_dosbing);
            }
        } elseif ($id_dosen != NULL) {
            $this->db->where('id_pengajuan_ta', $id_pengajuan_ta);
            $this->db->update('usulan', array('id_dosen' => $id_dosen));

            $result = $this->getUsulan($id_pengajuan_ta);
            $judul_ta = $result[0]->judul;
            $nama_dosen = $this->getDosen($id_dosen)[0]->nama;

            /* Insert tabel dosbing*/
            $data_dosbing = array(
                'id_dosen' => $id_dosen,
                'id_mahasiswa' => $id_mahasiswa
            );
            $this->db->insert('dosbing', $data_dosbing);

            if (!empty($id_dosen2)) {
                $data_dosbing = array(
                    'id_dosen' => $id_dosen2,
                    'id_mahasiswa' => $id_mahasiswa
                );
                $this->db->insert('dosbing', $data_dosbing);
            }
        }

        $donsenKe2 = "";
        if (!empty($id_dosen2)) {
            $nama_dosen2 = $this->getDosen($id_dosen2)[0]->nama;
            $donsenKe2 = '
            <tr>
            <td style="padding: 5px;" ><h4>Dosen Pembimbing 2</h4></td>
            <td style="padding: 5px;" ><h4>:</h4></td>
            <td style="padding: 5px;" ><h4><strong>' . $nama_dosen2 . '</strong></h4></td>
            </tr>';
        }
        /* Insert tabel log */
        $data_log = array(
            'id_mahasiswa' => $id_mahasiswa,
            'nama' => 'Tugas akhir terplotting',
            'deskripsi' => 'Tugas akhir anda telah terplotting dengan judul dan dosbing sebagai berikut<br>
                            <table>
                            <tr>
                            <td style="padding: 5px;" ><h4>Judul</h4></td>
                            <td style="padding: 5px;" ><h4>:</h4></td>
                            <td style="padding: 5px;" ><h4><strong>' . $judul_ta . '</strong></h4></td>
                            </tr>
                            <tr>
                            <td style="padding: 5px;" ><h4>Dosen Pembimbing</h4></td>
                            <td style="padding: 5px;" ><h4>:</h4></td>
                            <td style="padding: 5px;" ><h4><strong>' . $nama_dosen . '</strong></h4></td>
                            </tr>
                            ' . $donsenKe2 . '
                            </table> '
        );

        $this->db->insert('log_pesan', $data_log);


        $this->db->trans_complete();

        $result = $this->db->trans_status();

        return $result;
    }

    public function edit_dosbing($id_mahasiswa, $id_pengajuan_ta, $id_dosen)
    {
        $this->db->trans_start();

        /* Update tabel dosbing */
        $this->db->where('id_mahasiswa', $id_mahasiswa);
        $this->db->update('dosbing', array('id_dosen' => $id_dosen));

        /* Update tabel usulan */
        $this->db->where('id_pengajuan_ta', $id_pengajuan_ta);
        $this->db->update('usulan', array('id_dosen' => $id_dosen));

        /* Insert log pesan ke mahasiswa terkait */
        $this->db->select('nama');
        $this->db->from('dosen');
        $this->db->where('id_dosen', $id_dosen);
        $query = $this->db->get();

        $data_log = array(
            'id_mahasiswa' => $id_mahasiswa,
            'nama' => 'Pengubahan dosen pembimbing',
            'deskripsi' => 'Dosen pembimbing anda telah diganti oleh akademik. Dosen pembimbing anda sekarang adalah <b>' . $query->result()[0]->nama . '</b>'
        );
        $this->db->insert('log_pesan', $data_log);


        $this->db->trans_complete();

        $result = $this->db->trans_status();

        $this->db->trans_complete();

        $result = $this->db->trans_status();

        return $result;
    }
}
