<?php defined('BASEPATH') or exit('No direct script access allowed');

class Tugas_akhir extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ta_model');
        $this->isLoggedIn();
        $this->load->library('form_validation');
        $this->isAkademik();
    }

    public function index()
    {
        $data['dataTable'] = $this->Ta_model->getTA();
        $this->global['pageTitle'] = "Elusi : Tugas Akhir";
        $this->loadViews("dashboard_ta", $this->global, $data);
    }

    public function detail($id)
    {
        $data['dataMahasiswa'] = $this->Ta_model->getTA($id);
        $result = $this->Ta_model->getPengajuanTA($id, 'diterima');
        if ($result[0]->jenis == 'proyek') {
            $detail_proyek = $this->Ta_model->getProyek($result[0]->id_proyek);
            if (isset($result[1]->id_dosen)) {
                $dosen2 = $this->Ta_model->getDosen($result[1]->id_dosen);
            }

            $pilihan_ta = array(
                'pilihan' => $result[0]->pilihan,
                'jenis' => $result[0]->jenis,
                'id_ta' => $id,
                'id_pengajuan_ta' => $result[0]->id_pengajuan_ta,
                'nama_proyek' => $detail_proyek[0]->nama_proyek,
                'nama_dosen' => $detail_proyek[0]->nama_dosen,
                'nama_dosen2' => (isset($result[1]->id_dosen)) ? $dosen2[0]->nama : '(Tidak Ada Dosen 2)'
            );
        } else {
            $detail_usulan = $this->Ta_model->getUsulan($result[0]->id_pengajuan_ta);
            $pilihan_ta = array(
                'judul' => $detail_usulan[0]->judul,
                'deskripsi' => $detail_usulan[0]->deskripsi,
                'bisnis_rule' => $detail_usulan[0]->bisnis_rule,
                'id_ta' => $id,
                'file' => $detail_usulan[0]->file_persetujuan,
                'pilihan' => $result[0]->pilihan,
                'jenis' => $result[0]->jenis,
                'id_dosen' => $detail_usulan[0]->id_dosen,
                'id_dosen2' => (isset($result[1]->id_dosen)) ? $result[1]->id_dosen : null,
                'id_pengajuan_ta' => $result[0]->id_pengajuan_ta
            );
            $data['dataDosen'] = $this->Ta_model->getDosen($detail_usulan[0]->id_dosen);
            if (isset($result[1]->id_dosen)) {
                $data['dataDosen2'] = $this->Ta_model->getDosen($result[1]->id_dosen);
            } else {
                $data['dataDosen2'] = [];
            }
        }
        $data['dataPengajuanTA'] = $pilihan_ta;
        $this->global['pageTitle'] = "Elusi : Detail Tugas Akhir";
        $this->loadViews("detail_ta", $this->global, $data);
    }

    /* MENAMPILKAN HALAMAN INFORMASI MAHASISWA YANG MENGAJUKAN TA*/
    public function plotting($id)
    {
        $data['dataTA'] = $this->Ta_model->getTA($id);
        $data['dataDosen'] = $this->Ta_model->getDosen();
        $data['dataProyek'] = $this->Ta_model->getProyek();
        $data['isMasaRegis'] = $this->Ta_model->isMasaRegisTA();
        /* Mendapatkan informasi tentang pilihan tugas akhir yang diambil */
        $data_pengajuan = $this->Ta_model->getPengajuanTA($id);

        $data['dataDosbing'] = $this->Ta_model->getDosbing($data['dataTA'][0]->id_mahasiswa);

        $i = 1;
        $pilihan_ta = array();
        foreach ($data_pengajuan as $result) {
            if ($result->jenis == 'proyek') {
                $detail_proyek = $this->Ta_model->getProyek($result->id_proyek);
                $array = array(
                    'pilihan' => $result->pilihan,
                    'jenis' => $result->jenis,
                    'id_pengajuan_ta' => $result->id_pengajuan_ta,
                    'id_proyek' => $detail_proyek[0]->id_proyek,
                    'nama_proyek' => $detail_proyek[0]->nama_proyek,
                    'nama_dosen' => $detail_proyek[0]->nama_dosen,
                    'deskripsi' => $detail_proyek[0]->deskripsi,
                    'tools' => $detail_proyek[0]->tools,
                );
                array_push($pilihan_ta, $array);
            } else {
                $detail_usulan = $this->Ta_model->getUsulan($result->id_pengajuan_ta);
                $array = array(
                    'judul' => $detail_usulan[0]->judul,
                    'deskripsi' => $detail_usulan[0]->deskripsi,
                    'bisnis_rule' => $detail_usulan[0]->bisnis_rule,
                    'file' => $detail_usulan[0]->file_persetujuan,
                    'pilihan' => $result->pilihan,
                    'jenis' => $result->jenis,
                    'id_pengajuan_ta' => $result->id_pengajuan_ta
                );
                array_push($pilihan_ta, $array);
            }
        }
        $data['dataPengajuanTA'] = $pilihan_ta;
        $this->global['pageTitle'] = "Elusi : Plotting Tugas Akhir";
        $this->loadViews("plotting_ta", $this->global, $data);
    }

    public function plotting_ta()
    {
        $this->form_validation->set_rules('terima', 'Pilihan', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Pilih salah satu tugas akhir terlebih dahulu');
            redirect('akademik/tugas_akhir/plotting/' . $this->input->post('id_ta'));
        } else {
            $id_ta = $this->input->post('id_ta');
            if ($this->input->post('pilihan') == 'Revisi') {

                $result = $this->Ta_model->revisi_ta($id_ta, $this->input->post('reason'));

                if ($result) {
                    $this->session->set_flashdata('success', 'Tugas akhir telah direvisi');
                } else {
                    $this->session->set_flashdata('error', 'Tugas akhir gagal direvisi');
                };

                redirect('akademik/tugas_akhir');
            }
            $tipe_plotting = $this->input->post('terima');
            /* Cek apakah dipilihkan ke proyek secara manual dari akademik atau tidak*/
            if ($tipe_plotting == 'manual') {
                $this->form_validation->set_rules('proyek', 'Proyek', 'required');
                if ($this->form_validation->run() == FALSE) {
                    $this->session->set_flashdata('error', 'Pilih salah satu proyek terlebih dahulu');
                    redirect('akademik/tugas_akhir/plotting/' . $this->input->post('id_ta'));
                } else {
                    $id_proyek = $this->input->post('proyek');
                    $id_ta = $this->input->post('id_ta');
                    $id_mahasiswa = $this->input->post('id_mahasiswa');
                    if ($this->Ta_model->check_proyek($id_proyek)) {
                        $this->session->set_flashdata('error', 'Proyek yang terpilih sudah terplotting di mahasiswa lain');

                        redirect('akademik/tugas_akhir/plotting/' . $id_ta);
                    } else {
                        $data = array(
                            'id_ta' => $id_ta,
                            'pilihan' => 4,
                            'id_proyek' => $id_proyek,
                            'status' => 'diterima',
                            'jenis' => 'proyek'
                        );
                        $result = $this->Ta_model->revisi_ta($id_ta, NULL, $id_mahasiswa, $data, $id_proyek, NULL);

                        if ($result) {
                            $this->session->set_flashdata('success', 'Tugas akhir telah terploting');
                        } else {
                            $this->session->set_flashdata('error', 'Tugas akhir gagal terploting');
                        };
                        redirect('akademik/tugas_akhir');
                    }
                }
            } else {
                $id_ta = $this->input->post('id_ta');
                $id_mahasiswa = $this->input->post('id_mahasiswa');

                $id_pengajuan_ta = explode(' ', $tipe_plotting)[0];
                $jenis = explode(' ', $tipe_plotting)[1];
                if ($jenis != 'usulan') {
                    $id_proyek = $jenis;

                    if ($this->Ta_model->check_proyek($id_proyek)) {
                        $this->session->set_flashdata('error', 'Proyek yang terpilih sudah terplotting di mahasiswa lain');

                        redirect('akademik/tugas_akhir/plotting/' . $id_ta);
                    } else {
                        $getProject = $this->Ta_model->getProyek($id_proyek);
                        $id_dosen2 = $this->input->post('dosen2');
                        if (!empty($id_dosen2) && $getProject[0]->id_dosen == $id_dosen2) {
                            $this->session->set_flashdata('error', 'Dosen Project dan Dosen 2 Harus berbeda');

                            redirect('akademik/tugas_akhir/plotting/' . $id_ta);
                        }

                        $data = array(
                            'status' => 'diterima'
                        );
                        $result = $this->Ta_model->terima_ta($id_ta, $id_pengajuan_ta, $id_mahasiswa, $data, $id_proyek, NULL, $id_dosen2);

                        if ($result) {
                            $this->session->set_flashdata('success', 'Plotting tugas akhir berhasil dilakukan');
                        } else {
                            $this->session->set_flashdata('error', 'Plotting tugas akhir gagal dilakukan');
                        };
                        redirect('akademik/tugas_akhir');
                    }
                } else {
                    $this->form_validation->set_rules('dosen', 'Dosen', 'required');

                    if ($this->form_validation->run() == FALSE) {
                        $this->session->set_flashdata('error', 'Pilih salah satu dosen terlebih dahulu');
                        redirect('akademik/tugas_akhir/plotting/' . $this->input->post('id_ta'));
                    } else {
                        $id_dosen = $this->input->post('dosen');
                        $id_dosen2 = $this->input->post('dosen2');

                        if (!empty($id_dosen2) && $id_dosen == $id_dosen2) {
                            $this->session->set_flashdata('error', 'Dosen 1 dan Dosen 2 Harus berbeda');

                            redirect('akademik/tugas_akhir/plotting/' . $id_ta);
                        }

                        $id_ta = $this->input->post('id_ta');
                        $id_mahasiswa = $this->input->post('id_mahasiswa');

                        $data = array(
                            'status' => 'diterima'
                        );
                        $result = $this->Ta_model->terima_ta($id_ta, $id_pengajuan_ta, $id_mahasiswa, $data, NULL, $id_dosen, $id_dosen2);

                        if ($result) {
                            $this->session->set_flashdata('success', 'Tugas akhir telah terploting');
                        } else {
                            $this->session->set_flashdata('error', 'Tugas akhir gagal terploting');
                        };
                        redirect('akademik/tugas_akhir');
                    }
                }
            }
        }
    }

    public function ubah_dosbing()
    {
        $id_mahasiswa = $this->input->post('id_mahasiswa');
        $id_pengajuan_ta = $this->input->post('id_pengajuan_ta');
        $id_dosen = $this->input->post('dosen');
        $id_ta = $this->input->post('id_ta');

        $result = $this->Ta_model->edit_dosbing($id_mahasiswa, $id_pengajuan_ta, $id_dosen);

        if ($result) {
            $this->session->set_flashdata('success', 'Dosbing telah diubah');
        } else {
            $this->session->set_flashdata('error', 'Dosbing gagal diubah. Masalah database');
        };

        redirect('akademik/tugas_akhir/detail/' . $id_ta);
    }
}
