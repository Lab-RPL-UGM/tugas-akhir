<?php

/**
 * Created by nad.
 * Date: 23/03/2018
 * Time: 14:11
 * Description:
 */

class Bimbingan extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('bimbingan_model');
        $this->isLoggedIn();
        $this->isDosen();
    }
    /**
     * This function is used to load the main page
     */
    function index()
    {
        if ($this->isDosen() == TRUE) {
            $this->loadThis();
        } else {
            $userId = $this->vendorId;
            $userRole = $this->role;
            $data['bimbinganInfo'] = $this->bimbingan_model->getBimbingan($userId);
            $data['userId'] = $userId;
            $data['userRole'] = $userRole;
            $this->global['pageTitle'] = "TA-TRPL : Bimbingan";
            $this->loadViews("bimbingan", $this->global, $data, NULL);
        }
    }
    /**
     * This function is used load detail mahasiswa information
     * @param number $idMhs : This is mahasiswa id
     */
    function detail($idMhs = NULL)
    {
        if ($this->isDosen() == TRUE) {
            $this->loadThis();
        } else {
            if ($idMhs == null) {
                redirect('dosen/bimbingan');
            }
            $data['bimbinganInfo'] = $this->bimbingan_model->getBimbinganMahasiswa($idMhs);
            $data['mhsInfo'] = $this->bimbingan_model->getMahasiswa($idMhs);
            $this->loadViews("profil-mhs", $this->global, $data, NULL);
        }
    }
    /**
     * This function is used load detail mahasiswa information
     * @param number $idMhs : This is mahasiswa id
     */
    function progress($idMhs = NULL)
    {
        if ($this->isDosen() == TRUE) {
            $this->loadThis();
        } else {
            if ($idMhs == null) {
                redirect('dosen/bimbingan');
            }
            $data['bimbinganInfo'] = $this->bimbingan_model->getBimbinganMahasiswa($idMhs);
            $data['mhsInfo'] = $this->bimbingan_model->getMahasiswa($idMhs);
            $data['taTerplotting'] = $this->bimbingan_model->getTATerplotting($idMhs);
            $data['taDosbing'] = $this->bimbingan_model->getDosbing($idMhs);
            $data['taBimbingan'] = $this->bimbingan_model->getBimbinganProgress($data['bimbinganInfo'][0]->id_ta);
            $data['dosenId'] = $this->vendorId;
            $this->loadViews("bimbingan-mhs", $this->global, $data, NULL);
        }
    }

    function updateProgress()
    {
        if ($this->isDosen() == TRUE) {
            $this->loadThis();
        } else {
            $id_ta = $this->input->post('id_ta');
            $progress = $this->input->post('progress');
            $reason = $this->input->post('reason');
            $status = $this->input->post('status');

            $updateBimbingan = array(
                'reason' => $reason,
                'progress_percentage' => $progress,
                'status' => $status
            );
            $this->db->where('id', $this->input->post('id_bimbingan'));
            $this->db->update('bimbingan', $updateBimbingan);

            $updateTA = array(
                'progress' => $progress
            );
            $this->db->where('id_ta', $id_ta);
            $this->db->update('tugas_akhir', $updateTA);

            // Beri tahu mahasiswa lewat Pemberitahuan bahwa dosen sudah merespon
            // bimbingannya -- sebelumnya mahasiswa cuma dapat notifikasi sekali waktu
            // TA-nya diterima/terplotting, tidak pernah diberi tahu lagi soal
            // perkembangan bimbingan berikutnya.
            $ta = $this->db->select('id_mahasiswa')->from('tugas_akhir')->where('id_ta', $id_ta)->get()->row();
            if ($ta) {
                $dosen = $this->db->select('nama')->from('dosen')->where('id_user', $this->vendorId)->get()->row();
                $namaDosen = $dosen ? $dosen->nama : 'Dosen Pembimbing';
                $catatan = !empty($reason) ? htmlspecialchars($reason, ENT_QUOTES, 'UTF-8') : '(tidak ada catatan)';

                $data_log = array(
                    'id_mahasiswa' => $ta->id_mahasiswa,
                    'nama' => 'Progress bimbingan diperbarui',
                    'deskripsi' => htmlspecialchars($namaDosen, ENT_QUOTES, 'UTF-8') . ' telah merespon bimbingan Anda.<br>
                                    <table>
                                    <tr>
                                    <td style="padding: 5px;" ><h4>Progress Tugas Akhir</h4></td>
                                    <td style="padding: 5px;" ><h4>:</h4></td>
                                    <td style="padding: 5px;" ><h4><strong>' . (int) $progress . '%</strong></h4></td>
                                    </tr>
                                    <tr>
                                    <td style="padding: 5px;" ><h4>Catatan Dosen</h4></td>
                                    <td style="padding: 5px;" ><h4>:</h4></td>
                                    <td style="padding: 5px;" ><h4><strong>' . $catatan . '</strong></h4></td>
                                    </tr>
                                    </table>',
                );
                $this->db->insert('log_pesan', $data_log);
            }

            redirect('dosen/bimbingan');
        }
    }

    /**
     * Dosen menentukan/mengubah judul Tugas Akhir mahasiswa bimbingannya setelah
     * berdiskusi -- terutama buat mahasiswa yang di-plot manual oleh akademik tanpa
     * usulan judul (lihat placeholder "Silahkan menghubungi dosen..." di Ta_model).
     */
    function editJudul()
    {
        if ($this->isDosen() == TRUE) {
            $this->loadThis();
        } else {
            $id_ta = $this->input->post('id_ta');
            $id_mahasiswa = $this->input->post('id_mahasiswa');
            $judul = trim((string) $this->input->post('judul'));

            if (empty($judul)) {
                $this->session->set_flashdata('error', 'Judul Tugas Akhir tidak boleh kosong');
            } else {
                $result = $this->bimbingan_model->updateJudulUsulan($id_ta, strtoupper($judul), $this->vendorId);
                if ($result) {
                    $this->session->set_flashdata('success', 'Judul Tugas Akhir berhasil diubah');
                } else {
                    $this->session->set_flashdata('error', 'Gagal mengubah judul -- pastikan Anda adalah dosen pembimbing mahasiswa ini');
                }
            }
            redirect('dosen/bimbingan/progress/' . $id_mahasiswa);
        }
    }
    /**
     * This function is used to load the 404 page not found
     */
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Elusi : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}
