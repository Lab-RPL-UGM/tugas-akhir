<?php defined('BASEPATH') or exit('No direct script access allowed');

class Proyek extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Proyek_model');
        $this->load->model('Ta_model');
        $this->isLoggedIn();
        $this->isAkademik();
    }

    // Lensa per-proyek: lihat semua mahasiswa yang memilih satu proyek, lalu
    // tentukan siapa yang diterima dari sini. Satu proyek cuma untuk 1 mahasiswa --
    // begitu ada yang diterima, tombol Terima yang lain otomatis nonaktif.
    public function pendaftar($id_proyek)
    {
        $proyek = $this->Proyek_model->getProyek($id_proyek);
        if (empty($proyek)) {
            $this->session->set_flashdata('error', 'Proyek tidak ditemukan');
            redirect('akademik/proyek');
            return;
        }

        $data['proyek'] = $proyek[0];
        $data['dataPendaftar'] = $this->Proyek_model->getMahasiswaPemilihProyek($id_proyek);
        $data['sudahDiterima'] = $this->Ta_model->check_proyek($id_proyek);
        $this->global['pageTitle'] = "TA-TRPL : Pendaftar Proyek";
        $this->loadViews("pendaftar_proyek", $this->global, $data);
    }

    // Terima satu mahasiswa untuk proyek ini -- pilihan lain mahasiswa itu otomatis
    // dibuang (perilaku terima_ta() yang sudah ada di alur plotting akademik).
    public function terimaPendaftar()
    {
        $id_proyek = $this->input->post('id_proyek');
        $id_pengajuan_ta = $this->input->post('id_pengajuan_ta');
        $id_ta = $this->input->post('id_ta');
        $id_mahasiswa = $this->input->post('id_mahasiswa');

        if ($this->Ta_model->check_proyek($id_proyek)) {
            $this->session->set_flashdata('error', 'Proyek ini sudah diterima untuk mahasiswa lain');
            redirect('akademik/proyek/pendaftar/' . $id_proyek);
            return;
        }

        $result = $this->Ta_model->terima_ta($id_ta, $id_pengajuan_ta, $id_mahasiswa, ['status' => 'diterima'], $id_proyek);

        if ($result) {
            $this->session->set_flashdata('success', 'Mahasiswa berhasil diterima untuk proyek ini');
        } else {
            $this->session->set_flashdata('error', 'Gagal memproses penerimaan');
        }
        redirect('akademik/proyek/pendaftar/' . $id_proyek);
    }

    public function index()
    {
        $dataTable = $this->Proyek_model->getProyek();

        // Belum diproses (pending) ditaruh di tabel atas supaya akademik lihat dulu
        // yang butuh aksi; yang sudah diputuskan (disetujui/ditolak) turun ke tabel bawah.
        $dataBelumDiproses = [];
        $dataSudahDiproses = [];
        foreach ($dataTable as $row) {
            if ($row->status == 'pending') {
                $dataBelumDiproses[] = $row;
            } else {
                $dataSudahDiproses[] = $row;
            }
        }

        // Sudah Diproses: urutkan dari yang paling BARU DIPUTUSKAN (updatedDtm ke-update
        // otomatis saat accept/decline) -- bukan alfabetis/urutan insert seperti bawaan
        // DataTables kalau tidak di-set eksplisit.
        usort($dataSudahDiproses, function ($a, $b) {
            return strtotime($b->updatedDtm) <=> strtotime($a->updatedDtm);
        });

        $data = [];
        $data['dataBelumDiproses'] = $dataBelumDiproses;
        $data['dataSudahDiproses'] = $dataSudahDiproses;
        $this->global['pageTitle'] = "TA-TRPL : Proyek";
        $this->loadViews("dashboard_proyek", $this->global, $data);
    }

    public function add_form()
    {
        $data['dataDosen'] = $this->Proyek_model->getDosen();
        $data['dataPeriode'] = $this->Proyek_model->getPeriodeList();
        $data['dataBidang'] = $this->Proyek_model->getBidangList();
        $this->global['pageTitle'] = "TA-TRPL : Tambah Proyek";
        $this->loadViews("add_proyek", $this->global, $data);
    }

    public function edit_form($id)
    {
        $data['dataDosen'] = $this->Proyek_model->getDosen();
        $data['dataProyek'] = $this->Proyek_model->getProyek($id);
        $data['dataStatus'] = $this->Proyek_model->getStatus();
        $data['dataPeriode'] = $this->Proyek_model->getPeriodeList();
        $data['dataBidang'] = $this->Proyek_model->getBidangList();
        $data['selectedBidangIds'] = $this->Proyek_model->getBidangIdsForProyek($id);
        $this->global['pageTitle'] = "TA-TRPL : Tambah Proyek";
        $this->loadViews("edit_proyek", $this->global, $data);
    }

    public function add()
    {
        $id_dosen = trim($this->input->post('select_dosen'));
        $nama_proyek = trim($this->input->post('nama_proyek'));
        $instansi = trim($this->input->post('instansi'));
        $deskripsi = $this->input->post('deskripsi');
        $tools = $this->input->post('tools');
        $id_periode = $this->input->post('id_periode');
        $id_bidang = $this->input->post('id_bidang');
        $data = array(
            'id_dosen' => $id_dosen,
            'nama' => $nama_proyek,
            'klien' => $instansi,
            'status' => 'pending',
            'deskripsi' => $deskripsi,
            'tools' => $tools,
            'id_periode' => !empty($id_periode) ? $id_periode : NULL,
        );

        $id_proyek = $this->Proyek_model->insert($data);
        if ($id_proyek) {
            $this->Proyek_model->setBidangProyek($id_proyek, $id_bidang);
            $this->session->set_flashdata('success', 'Proyek baru telah ditambahkan');
        } else {
            $this->session->set_flashdata('error', 'Proyek gagal ditambahkan. (Masalah database)');
        };

        redirect('akademik/proyek');
    }

    public function edit()
    {
        $id_proyek = trim($this->input->post('id_proyek'));
        $id_dosen = trim($this->input->post('select_dosen'));
        $nama_proyek = trim($this->input->post('nama_proyek'));
        $instansi = trim($this->input->post('instansi'));
        $status = trim($this->input->post('status'));
        $deskripsi = $this->input->post('deskripsi');
        $tools = $this->input->post('tools');
        $id_periode = $this->input->post('id_periode');
        $id_bidang = $this->input->post('id_bidang');

        $data = array(
            'id_dosen' => $id_dosen,
            'nama' => $nama_proyek,
            'klien' => $instansi,
            'status' => $status,
            'deskripsi' => $deskripsi,
            'tools' => $tools,
            'id_periode' => !empty($id_periode) ? $id_periode : NULL,
        );

        $result = $this->Proyek_model->update($data, $id_proyek);
        $this->Proyek_model->setBidangProyek($id_proyek, $id_bidang);
        if ($result) {
            $this->session->set_flashdata('success', 'Proyek telah diubah');
        } else {
            $this->session->set_flashdata('error', 'Proyek gagal diubah. (Masalah database)');
        };

        redirect('akademik/proyek');
    }

    public function delete()
    {
        $id_proyek = $this->input->post("id_proyek");

        if ($this->Proyek_model->hasAcceptedPengajuan($id_proyek)) {
            $this->session->set_flashdata('error', 'Proyek tidak bisa dihapus karena sudah ada mahasiswa yang diterima di proyek ini.');
            redirect('akademik/proyek');
            return;
        }

        $result = $this->Proyek_model->delete($id_proyek);
        if ($result) {
            $this->session->set_flashdata('success', 'Proyek berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Proyek gagal dihapus. Masalah di database');
        };

        redirect('akademik/proyek');
    }

    public function accept()
    {
        $id_proyek = $this->input->post('id_proyek');
        $result = $this->Proyek_model->change_status($id_proyek, 1);
        $nama = $this->Proyek_model->getProyek($id_proyek)[0]->nama_proyek;
        if ($result) {
            $this->session->set_flashdata('success', 'Proyek ' . $nama . ' telah disetujui');
        } else {
            $this->session->set_flashdata('error', 'Proyek gagal disetujui. Masalah di database');
        };
        redirect('akademik/proyek');
    }

    public function decline()
    {
        $id_proyek = $this->input->post('id_proyek');
        $proyek = $this->Proyek_model->getProyek($id_proyek)[0];
        $nama = $proyek->nama_proyek;

        if ($this->Proyek_model->hasAcceptedPengajuan($id_proyek)) {
            $this->session->set_flashdata('error', 'Proyek ' . $nama . ' tidak bisa ditolak karena sudah ada mahasiswa yang diterima di proyek ini.');
            redirect('akademik/proyek');
            return;
        }

        if ($proyek->status == 'ditolak') {
            $this->session->set_flashdata('error', 'Proyek ' . $nama . ' sudah ditolak sebelumnya.');
            redirect('akademik/proyek');
            return;
        }

        $result = $this->Proyek_model->change_status($id_proyek, 0);
        if ($result) {
            $this->session->set_flashdata('success', 'Proyek ' . $nama . ' telah ditolak');
        } else {
            $this->session->set_flashdata('error', 'Proyek gagal ditolak. Masalah di database');
        };
        redirect('akademik/proyek');
    }

    public function multiple_action()
    {
        $array_data = $this->input->post('table_records');
        $submit = $this->input->post('submit_form');
        if (!empty($array_data) && $submit == 1) {
            for ($i = 0; $i < count($array_data); $i++) {
                $result = $this->Proyek_model->change_status($array_data[$i], 1);
            }
            if ($result) {
                $this->session->set_flashdata('success', count($array_data) . ' Proyek telah disetujui');
            } else {
                $this->session->set_flashdata('error', 'Proyek gagal disetujui. Masalah di database');
            };
        } elseif (!empty($array_data) && $submit == 0) {
            $ditolak = 0;
            $dilewati = 0;
            for ($i = 0; $i < count($array_data); $i++) {
                if ($this->Proyek_model->hasAcceptedPengajuan($array_data[$i])) {
                    $dilewati++;
                    continue;
                }
                if ($this->Proyek_model->change_status($array_data[$i], 0)) {
                    $ditolak++;
                }
            }
            if ($ditolak > 0) {
                $pesan = $ditolak . ' Proyek telah ditolak';
                if ($dilewati > 0) {
                    $pesan .= ', ' . $dilewati . ' dilewati karena sudah ada mahasiswa yang diterima';
                }
                $this->session->set_flashdata('success', $pesan);
            } elseif ($dilewati > 0) {
                $this->session->set_flashdata('error', 'Semua proyek yang dipilih dilewati karena sudah ada mahasiswa yang diterima');
            } else {
                $this->session->set_flashdata('error', 'Proyek gagal ditolak. Masalah di database');
            };
        } else {
            $this->session->set_flashdata('error', 'Pilih salah satu proyek terlebih dahulu');
        }

        redirect('akademik/proyek');
    }

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Elusi : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}
