<?php

/**
 * Created by nad.
 * Date: 23/03/2018
 * Time: 14:07
 * Description:
 */

class Pendadaran extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pendadaran_model');
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
            $data['pendadaranInfo'] = $this->pendadaran_model->getSidang($userId);
            foreach ($data['pendadaranInfo'] as $key => $value) {
                $data['pendadaranInfo'][$key]->ketuaPendadaranInfo = $this->pendadaran_model->getKetuaSidang($value->id_sidang);
                $data['pendadaranInfo'][$key]->sekertarisPendadaranInfo = $this->pendadaran_model->getSekertarisSidang($value->id_sidang);
            }
            $data['userId'] = $userId;
            $data['userRole'] = $userRole;
            $this->global['pageTitle'] = "TA-TRPL : Pendadaran";

            // echo "<pre>";
            // print_r($data);
            // exit;
            $this->loadViews("uji", $this->global, $data, NULL);
        }
    }
    /**
     * This function is used to get nilai detail information list
     */
    function nilai($idSidang, $idNilai)
    {
        if ($this->isDosen() == TRUE) {
            $this->loadThis();
        } else {
            $userId = $this->vendorId;
            $data['nilaiInfo'] = $this->pendadaran_model->getNilaiInfo($userId, $idNilai);
            $data['nilaiInfoEdit'] = $this->pendadaran_model->getNilaiInfoEdit($userId, $idNilai);
            $data['totalNilaiInfoKetua'] = $this->pendadaran_model->getTotalNilaiInfoKetua($userId, $idNilai);
            $data['revisiInfo'] = $this->pendadaran_model->getRevisiInfo($userId);
            $data['ketuaInfo'] = $this->pendadaran_model->getKetua($userId);
            $data['sekreInfo'] = $this->pendadaran_model->getSekre($userId);
            $data['anggotaInfo'] = $this->pendadaran_model->getAnggota($userId);
            $data['penilaianInfo'] = $this->pendadaran_model->getPenilaian($idSidang);
            $data['penilaianRataInfo'] = $this->pendadaran_model->getPenilaianRata($idSidang);

            $this->global['pageTitle'] = "Elusi : Sidang";
            $this->loadViews("nilai", $this->global, $data, NULL);
        }
    }
    /**
     * This function is used to submit nilai form
     */
    function submitNilai()
    {
        if ($this->isDosen() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $last_index = $this->input->post('last_index');
            $id_penilaian = $this->input->post('id_penilaian');
            $id_sidang = $this->input->post('id_sidang');

            for ($i = 1; $i < $last_index; $i++) {
                $this->form_validation->set_rules('nilai_' . $i, 'Nilai', 'trim|required|less_than_equal_to[4]');
                $nilai = $this->input->post('nilai_' . $i);
            }
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Wajib memasukkan semua nilai, nilai tidak lebih dari 4, dan 3 digits !');
                redirect("dosen/pendadaran/nilai/$id_sidang/$id_penilaian");
            } else {
                $nilai_akhir_dosen = $this->input->post('nilai_akhir_dosen');
                $id_sidang = $this->input->post('id_sidang');
                echo $last_index;
                $total = 0;
                for ($i = 1; $i < $last_index; $i++) {
                    $id_komponen_nilai = $this->input->post('id_komponen_nilai_' . $i);
                    $nilai = $this->input->post('nilai_' . $i);
                    $data = array(
                        'nilai' => $nilai
                    );
                    //                update nilai to table komponen_nilai
                    $result1 = $this->pendadaran_model->editKomponenNilai($data, $id_komponen_nilai);
                    //                total avg nilai dosen
                    $total = $total + ($nilai / ($last_index - 1));
                    //                $total = $total+($id_nilai_value/($last_index-1));
                }
                //            update penilaian average to penilaian table
                $result = $this->pendadaran_model->editPenilaian($total, $id_penilaian);
                //            get count anggota yang menjadi penguji
                $totalAnggota = $this->pendadaran_model->getCountAnggota($id_sidang);
                //            update nilai_akhir_sidang to table sidang
                //                $nilai_akhir_sidang = $total/$totalAnggota;
                //                $result = $this->pendadaran_model->editSidang($nilai_akhir_sidang ,$id_sidang);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Sidang berhasil dinilai!');
                } else {
                    $this->session->set_flashdata('error', 'Sidang gagal dinilai!');
                }
                redirect("dosen/pendadaran/nilai/$id_sidang/$id_penilaian");
            }
        }
    }
    //    penentuan lulus
    function submitPenentuanLulus()
    {
        if ($this->isDosen() == true) {
            $this->loadThis();
        } else {
            $idMhs = $this->input->post('id_mahasiswa');
            $id_penilaian = $this->input->post('id_penilaian');
            $id_sidang = $this->input->post('id_sidang');
            $nilai = $this->input->post('nilai');

            $pesanInfo = array(
                'id_mahasiswa' => $idMhs,
                'nama' => 'Lulus sidang',
                'deskripsi' => 'Selamat anda telah lulus sidang.'
            );
            $resultPesan = $this->pendadaran_model->addPesan($pesanInfo);

            $sidangInfo = array(
                'id_sidang' => $id_sidang,
                'nilai_akhir_sidang' => $nilai,
                'status' => 'lulus'
            );
            $result = $this->pendadaran_model->editSidang($sidangInfo, $id_sidang);

            if ($result > 0) {
                $this->session->set_flashdata('success', 'Mahasiswa telah berhasil dinilai!');
            } else {
                $this->session->set_flashdata('error', 'Mahasiswa gagal dinilai!');
            }
            redirect("dosen/pendadaran/nilai/$id_sidang/$id_penilaian");
        }
    }
    //    penentuan lulus dengan revisi
    function submitPenentuanLulusRevisi()
    {
        if ($this->isDosen() == true) {
            $this->loadThis();
        } else {
            $idMhs = $this->input->post('id_mahasiswa');
            $id_penilaian = $this->input->post('id_penilaian');
            $id_sidang = $this->input->post('id_sidang');
            $nilai = $this->input->post('nilai');

            $pesanInfo = array(
                'id_mahasiswa' => $idMhs,
                'nama' => 'Lulus sidang dengan revisi.',
                'deskripsi' => 'Selamat anda telah lulus sidang dengan revisi yang telah diberikan oleh dosen penguji.'
            );
            $resultPesan = $this->pendadaran_model->addPesan($pesanInfo);

            $sidangInfo = array(
                'id_sidang' => $id_sidang,
                'nilai_akhir_sidang' => $nilai,
                'status' => 'lulus_revisi'
            );
            $result = $this->pendadaran_model->editSidang($sidangInfo, $id_sidang);

            if ($result > 0) {
                $this->session->set_flashdata('success', 'Mahasiswa telah berhasil dinilai!');
            } else {
                $this->session->set_flashdata('error', 'Mahasiswa gagal dinilai!');
            }
            redirect("dosen/pendadaran/nilai/$id_sidang/$id_penilaian");
        }
    }
    //    penentuan mengulang
    function submitPenentuanUlang()
    {
        if ($this->isDosen() == true) {
            $this->loadThis();
        } else {
            $idMhs = $this->input->post('id_mahasiswa');
            $id_penilaian = $this->input->post('id_penilaian');
            $id_sidang = $this->input->post('id_sidang');
            $nilai = $this->input->post('nilai');

            $pesanInfo = array(
                'id_mahasiswa' => $idMhs,
                'nama' => 'Daftar ulang sidang.',
                'deskripsi' => 'Silahkan mendaftar ulang sidang.'
            );
            $resultPesan = $this->pendadaran_model->addPesan($pesanInfo);

            $sidangInfo = array(
                'id_sidang' => $id_sidang,
                'nilai_akhir_sidang' => $nilai,
                'status' => 'mengulang'
            );
            $result = $this->pendadaran_model->editSidang($sidangInfo, $id_sidang);

            if ($result > 0) {
                $this->session->set_flashdata('success', 'Mahasiswa telah berhasil dinilai!');
            } else {
                $this->session->set_flashdata('error', 'Mahasiswa gagal dinilai!');
            }
            redirect("dosen/pendadaran/nilai/$id_sidang/$id_penilaian");
        }
    }
    /**
     * This function is used to submit report revision each dosen
     */
    function submitRevisi()
    {
        if ($this->isDosen() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            //            get id needed
            $nama_dosen_revisi = $this->input->post('nama_dosen_revisi');
            $id_penilaian = $this->input->post('id_penilaian');
            $id_sidang = $this->input->post('id_sidang');
            //            validation
            $this->form_validation->set_rules('id_anggota_sidang', 'id', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('success', 'Revisi gagal dikirim!');
                redirect("dosen/pendadaran/nilai/$id_sidang/$id_penilaian");
            } else {
                $id_anggota_sidang = $this->input->post('id_anggota_sidang');
                //                upload file revision
                $config['upload_path'] = 'uploads/revisi_sidang';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = 10000;
                $config['max_width'] = 1024;
                $config['max_height'] = 1024;
                $new_name = "revisi-" . time() . "-" . $nama_dosen_revisi;
                $config['file_name'] = $new_name;

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('path')) {
                    // if upload revisi tidak sesuai
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_flashdata('error', 'Unggah file gagal!');
                } else {
                    // bila upload revisi berhasil
                    $terupload = $this->upload->data();
                    $revisiInfo = array(
                        'path' => $terupload['file_name'],
                        'id_anggota_sidang' => $id_anggota_sidang
                    );
                    $result = $this->pendadaran_model->addNewRevisi($revisiInfo);
                    if ($result == true) {
                        $this->session->set_flashdata('success', 'Unggah revisi berhasil!');
                    } else {
                        $this->session->set_flashdata('error', 'Unggah revisi gagal!');
                    }
                }
                redirect("dosen/pendadaran/nilai/$id_sidang/$id_penilaian");
            }
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
