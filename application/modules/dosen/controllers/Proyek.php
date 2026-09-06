<?php

/**
 * Created by nad.
 * Date: 22/03/2018
 * Time: 21:10
 * Description:
 */

class Proyek extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('proyek_model');
        $this->isLoggedIn();
        $this->isDosen();
    }

    function index()
    {
        if ($this->isDosen() == TRUE) {
            $this->loadThis();
        } else {
            $userId = $this->vendorId;
            $this->load->model('proyek_model');
            $data['proyekInfo'] = $this->proyek_model->getProyekInfo(null, $userId);
            $this->global['pageTitle'] = "TA-TRPL : Proyek";

            $this->loadViews("proyek", $this->global, $data, NULL);
        }
    }
    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
        if ($this->isDosen() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->model('proyek_model');
            $userId = $this->vendorId;
            $data['dosenSaya'] = $this->proyek_model->getDosenByUserId($userId);
            $data['periodeAktif'] = $this->proyek_model->getPeriodeAktif();
            $data['dataBidang'] = $this->proyek_model->getBidangList();

            $this->loadViews("proyekadd", $this->global, $data, NULL);
        }
    }
    /**
     * This function is used to add new project to the system
     */
    function addNewProject()
    {
        if ($this->isDosen() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('nama-proyek', 'Judul Proyek', 'trim|required|max_length[128]');

            if ($this->form_validation->run() == FALSE) {
                $this->addNew();
            } else {
                // Penanggung jawab & periode TIDAK diambil dari input form -- proyek yang
                // diajukan dosen selalu atas nama dirinya sendiri di periode yang sedang
                // aktif sekarang, bukan pilihan bebas yang bisa dilimpahkan/diubah dari client.
                $userId = $this->vendorId;
                $dosenSaya = $this->proyek_model->getDosenByUserId($userId);
                $periodeAktif = $this->proyek_model->getPeriodeAktif();

                $name = ucwords(strtolower($this->input->post('nama-proyek')));
                $klien = strtoupper($this->input->post('klien'));
                $tools = ucwords(strtolower($this->input->post('tools')));
                $deskripsi = $this->input->post('deskripsi');
                $id_bidang = $this->input->post('id_bidang');

                $proyekInfo = [
                    'id_dosen' => $dosenSaya->id_dosen,
                    'nama' => $name,
                    'klien' => $klien,
                    'deskripsi' => $deskripsi,
                    'tools' => $tools,
                    'id_periode' => $periodeAktif ? $periodeAktif->id_periode : NULL,
                ];

                $result = $this->proyek_model->addNewProject($proyekInfo);

                if ($result > 0) {
                    $this->proyek_model->setBidangProyek($result, $id_bidang);
                    $this->session->set_flashdata('success', 'Berhasil mengajukan, status = waiting');
                } else {
                    $this->session->set_flashdata('error', 'Gagal mengajukan proyek');
                }
                redirect('dosen/proyek/addNew');
            }
        }
    }
    /**
     * This function is used load project edit information
     * @param number $proyekId: This is project id
     */
    function editOld($proyekId = NULL)
    {
        if ($this->isDosen() == TRUE) {
            $this->loadThis();
        } else {
            if ($proyekId == null) {
                redirect('dosen/proyek');
            }
            $userId = $this->vendorId;
            $dosenSaya = $this->proyek_model->getDosenByUserId($userId);
            $proyekInfo = $this->proyek_model->getProyekInfo($proyekId);

            // Dosen cuma boleh mengedit proyek atas nama dirinya sendiri.
            if (empty($proyekInfo) || $proyekInfo[0]->id_dosen != $dosenSaya->id_dosen) {
                $this->session->set_flashdata('error', 'Anda tidak berhak mengubah proyek ini');
                redirect('dosen/proyek');
                return;
            }

            // Proyek yang sudah disetujui akademik/kaprodi tidak boleh diubah lagi dosen --
            // supaya detail yang sudah dipakai mahasiswa untuk memilih tidak berubah diam-diam.
            if ($proyekInfo[0]->status == 'disetujui') {
                $this->session->set_flashdata('error', 'Proyek yang sudah disetujui tidak bisa diubah lagi');
                redirect('dosen/proyek');
                return;
            }

            $data['proyekInfo'] = $proyekInfo;
            $data['dosenSaya'] = $dosenSaya;
            $data['dataPeriode'] = $this->proyek_model->getPeriodeList();
            $data['dataBidang'] = $this->proyek_model->getBidangList();
            $data['selectedBidangIds'] = $this->proyek_model->getBidangIdsForProyek($proyekId);
            $this->loadViews("proyekedit", $this->global, $data, NULL);
        }
    }
    /**
     * This function is used to edit the project information
     */
    function editProject()
    {
        if ($this->isDosen() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $proyekId = $this->input->post('id-proyek');

            $this->form_validation->set_rules('nama-proyek', 'Judul Proyek', 'trim|required|max_length[128]');

            if ($this->form_validation->run() == FALSE) {
                $this->editOld($proyekId);
            } else {
                $userId = $this->vendorId;
                $dosenSaya = $this->proyek_model->getDosenByUserId($userId);
                $proyekLama = $this->proyek_model->getProyekInfo($proyekId);

                // Dosen cuma boleh mengedit proyek atas nama dirinya sendiri --
                // periksa ulang di sini juga karena ini endpoint yang beneran mengubah data.
                if (empty($proyekLama) || $proyekLama[0]->id_dosen != $dosenSaya->id_dosen) {
                    $this->session->set_flashdata('error', 'Anda tidak berhak mengubah proyek ini');
                    redirect('dosen/proyek');
                    return;
                }

                // Periksa ulang juga di sini -- jangan cuma disembunyikan di UI, endpoint
                // yang beneran menyimpan data harus menolaknya juga.
                if ($proyekLama[0]->status == 'disetujui') {
                    $this->session->set_flashdata('error', 'Proyek yang sudah disetujui tidak bisa diubah lagi');
                    redirect('dosen/proyek');
                    return;
                }

                $name = ucwords(strtolower($this->input->post('nama-proyek')));
                $klien = strtoupper($this->input->post('klien'));
                $tools = ucwords(strtolower($this->input->post('tools')));
                $deskripsi = $this->input->post('deskripsi');
                $id_periode = $this->input->post('id_periode');
                $id_bidang = $this->input->post('id_bidang');

                if (!empty($proyekId)) {
                    $proyekInfo = array(
                        'id_proyek' => $proyekId,
                        'id_dosen' => $dosenSaya->id_dosen,
                        'nama' => $name,
                        'klien' => $klien,
                        'deskripsi' => $deskripsi,
                        'tools' => $tools,
                        'id_periode' => !empty($id_periode) ? $id_periode : NULL,
                    );

                    $result = $this->proyek_model->editProject($proyekInfo, $proyekId);
                    $this->proyek_model->setBidangProyek($proyekId, $id_bidang);

                    if ($result == true) {
                        $this->session->set_flashdata('success', 'Proyek berhasil diperbaharui');
                    } else {
                        $this->session->set_flashdata('error', 'Proyek gagal diperbaharui');
                    }
                    redirect('dosen/proyek');
                } else {
                    echo "Alhamdulillah";
                }
            }
        }
    }
    /**
     * Lihat siapa saja mahasiswa yang memilih proyek ini (read-only -- dosen tidak
     * bisa menerima dari sini, itu wewenang akademik).
     */
    function pendaftar($proyekId = NULL)
    {
        if ($this->isDosen() == TRUE) {
            $this->loadThis();
        } else {
            if ($proyekId == null) {
                redirect('dosen/proyek');
                return;
            }
            $userId = $this->vendorId;
            $dosenSaya = $this->proyek_model->getDosenByUserId($userId);
            $proyekInfo = $this->proyek_model->getProyekInfo($proyekId);

            if (empty($proyekInfo) || $proyekInfo[0]->id_dosen != $dosenSaya->id_dosen) {
                $this->session->set_flashdata('error', 'Anda tidak berhak melihat proyek ini');
                redirect('dosen/proyek');
                return;
            }

            $data['proyek'] = $proyekInfo[0];
            $data['dataPendaftar'] = $this->proyek_model->getMahasiswaPemilihProyek($proyekId);
            $this->global['pageTitle'] = "TA-TRPL : Pendaftar Proyek";
            $this->loadViews("proyek_pendaftar", $this->global, $data, NULL);
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
