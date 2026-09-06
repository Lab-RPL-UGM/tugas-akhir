<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
/**
 * Created by nad.
 * Date: 22/03/2018
 * Time: 11:40
 * Description:
 */

class Pengajuan extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pengajuan_model');
        $this->isLoggedIn();
        $this->isMahasiswa();
    }

    /**
     * This function is used to load the main page
     */
    function tugasakhir()
    {
        if ($this->isMahasiswa() == TRUE) {
            $this->loadThis();
        } else {
            $userId = $this->vendorId;
            $data['userId'] = $userId;
            $data['userRole'] = $this->role;

            $data['proyekInfo'] = $this->Pengajuan_model->getProyek();
            $data['periodeInfo'] = $this->Pengajuan_model->getPeriode();
            $data['dataDosen'] = $this->Pengajuan_model->getDosen();

            // apabila dia sudah mendaftarkan TA
            $id_mahasiswa = $this->Pengajuan_model->getIdMahasiswa($userId);
            $ta_terplotting = $this->Pengajuan_model->getTATerplotting($id_mahasiswa[0]->id_mahasiswa);
            $data['dataDosbing'] = $this->Pengajuan_model->getDosbing($id_mahasiswa[0]->id_mahasiswa);
            // Cuma tampilkan peringatan lengkapi profil kalau memang belum lengkap --
            // sebelumnya selalu tampil (warna merah pula, kesannya sudah error).
            $data['isProfilLengkap'] = $this->Pengajuan_model->isDataMahasiswaLengkap($id_mahasiswa[0]->id_mahasiswa);
            if ($ta_terplotting) {
                $array = [
                    'id_ta' => $ta_terplotting['id_ta'],
                    'judul_ta' => $ta_terplotting['judul_ta'],
                    'dosbing' => $ta_terplotting['dosbing'],
                    'progress' => $ta_terplotting['progress']
                ];
                $data['taTerplotting'] = $array;
                $data['taDosbing'] = $this->Pengajuan_model->getDosbing($id_mahasiswa[0]->id_mahasiswa);
                $data['taBimbingan'] = $this->Pengajuan_model->getBimbingan($ta_terplotting['id_ta']);
            } else {
                $data['taTerplotting'] = $ta_terplotting;
                $taInfo = $this->Pengajuan_model->getTa($id_mahasiswa[0]->id_mahasiswa);
                $data['taInfo'] = $taInfo;
                $data['taDosbing'] = $this->Pengajuan_model->getDosbing($id_mahasiswa[0]->id_mahasiswa);
                $data['taBimbingan'] = $this->Pengajuan_model->getBimbingan($ta_terplotting['id_ta']);

                // Siapkan prefill utk form Edit multi-pilihan (SOP: 1 pengajuan bisa
                // berisi 1-3 pilihan, form Edit harus tampilkan & bisa ubah SEMUANYA,
                // bukan cuma pilihan pertama seperti form lama).
                $existingPilihan = [];
                if (!empty($taInfo)) {
                    foreach ($taInfo as $record) {
                        $existingPilihan[$record->pilihan] = [
                            'jenis' => $record->jenis,
                            'id_proyek' => $record->id_proyek,
                            'judul' => $record->judul,
                            'mitra' => $record->mitra,
                            'id_dosen' => $record->id_dosen_usulan,
                            'id_dosen2' => $record->id_dosen2_usulan,
                            'file_persetujuan' => $record->file_persetujuan,
                        ];
                    }
                    $data['id_ta_edit'] = $taInfo[0]->id_ta;
                }
                $data['existingPilihan'] = $existingPilihan;

                // Proyek yang sedang dipilih mahasiswa ini harus tetap muncul di
                // dropdown form Edit walau sudah tidak termasuk katalog periode aktif
                // -- supaya pilihan lama tidak "hilang" begitu saja saat form dibuka.
                $idProyekTerdaftar = array_column($data['proyekInfo'], 'id_proyek');
                foreach ($existingPilihan as $ep) {
                    if ($ep['jenis'] == 'proyek' && !empty($ep['id_proyek']) && !in_array($ep['id_proyek'], $idProyekTerdaftar)) {
                        $tambahan = $this->Pengajuan_model->getProyek($ep['id_proyek']);
                        if (!empty($tambahan)) {
                            $data['proyekInfo'][] = $tambahan[0];
                            $idProyekTerdaftar[] = $ep['id_proyek'];
                        }
                    }
                }
            }
            $this->loadViews("tugasakhir", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to Tugas Akhir Registration
     */
    function daftar_ta()
    {
        if ($this->isMahasiswa() == TRUE) {
            $this->loadThis();
        } else {
            $userId = $this->vendorId;
            $id_mahasiswa = $this->Pengajuan_model->getIdMahasiswa($userId);
            $isLengkap = $this->Pengajuan_model->isDataMahasiswaLengkap($id_mahasiswa[0]->id_mahasiswa);
            $mahasiswaID = $id_mahasiswa[0]->id_mahasiswa;

            if (!$isLengkap) {
                $this->session->set_flashdata('error', 'Lengkapi data diri Anda terlebih dahulu');
                redirect('mahasiswa/pengajuan/tugasakhir');
                return;
            }

            $id_periode = $this->input->post('id_periode');

            // Kumpulkan pilihan 1-3 yang benar-benar diisi (SOP: minimal 1, maksimal 3,
            // bebas kombinasi proyek existing / usulan sendiri).
            $pilihanValid = $this->_kumpulkanPilihanDariForm();
            if ($pilihanValid === false) {
                // pesan error sudah di-set di dalam _kumpulkanPilihanDariForm()
                redirect('mahasiswa/pengajuan/tugasakhir');
                return;
            }
            if (empty($pilihanValid)) {
                $this->session->set_flashdata('error', 'Isi minimal 1 pilihan (proyek atau usulan)');
                redirect('mahasiswa/pengajuan/tugasakhir');
                return;
            }

            $ta = array(
                'id_mahasiswa' => $mahasiswaID,
                'id_periode' => $id_periode,
            );
            $id_ta = $this->Pengajuan_model->addNewTa($ta);

            $hasil = $this->_simpanPilihanKeDb($id_ta, $pilihanValid);
            if ($hasil === false) {
                // pesan error sudah di-set (mis. upload file gagal)
                redirect('mahasiswa/pengajuan/tugasakhir');
                return;
            }

            $this->session->set_flashdata('success', 'Pendaftaran tugas akhir telah berhasil dilakukan (' . count($pilihanValid) . ' pilihan)');
            redirect('mahasiswa/pengajuan/tugasakhir');
        }
    }

    /**
     * Baca blok pilihan 1-3 dari POST, validasi, dan kembalikan array pilihan yang
     * benar-benar diisi (blok yang dibiarkan kosong di form dilewati, bukan error).
     * Return FALSE (dan set flashdata error) kalau ada input yang salah.
     */
    private function _kumpulkanPilihanDariForm()
    {
        $pilihanValid = [];
        $proyekDipilihSet = [];

        for ($n = 1; $n <= 3; $n++) {
            $jenis = $this->input->post("jenis_$n");
            if (empty($jenis)) {
                continue; // blok tidak ditampilkan/tidak diisi sama sekali
            }

            if ($jenis == 'proyek') {
                $idProyek = $this->input->post("proyek_$n");
                if (empty($idProyek)) {
                    continue; // blok proyek dibiarkan kosong, lewati
                }
                if (in_array($idProyek, $proyekDipilihSet)) {
                    $this->session->set_flashdata('error', 'Proyek yang sama tidak boleh dipilih lebih dari sekali');
                    return false;
                }
                $proyekDipilihSet[] = $idProyek;
                $pilihanValid[] = ['jenis' => 'proyek', 'n' => $n, 'id_proyek' => $idProyek];
            } else {
                $judul = trim((string)$this->input->post("judul_$n"));
                $idDosen = $this->input->post("dosen_$n");
                // dosen kedua opsional -- boleh dikosongkan, tapi kalau diisi tidak
                // boleh dosen yang sama dengan dosen pembimbing pertama.
                $idDosen2 = $this->input->post("dosen2_$n");
                if (!empty($idDosen2) && $idDosen2 == $idDosen) {
                    $this->session->set_flashdata('error', "Usulan Dosen Pembimbing Pertama dan Kedua tidak boleh sama pada pilihan usulan ke-$n");
                    return false;
                }
                $hasFile = !empty($_FILES["file_persetujuan_$n"]['name']);
                // existing_file_$n cuma terisi saat mode Edit -- artinya blok ini
                // sudah punya file proposal sebelumnya, jadi tidak upload ulang
                // dianggap valid (file lama tetap dipakai), bukan error.
                $existingFile = $this->input->post("existing_file_$n");
                if (empty($judul) && empty($idDosen) && !$hasFile && empty($existingFile)) {
                    continue; // blok usulan dibiarkan kosong, lewati
                }
                if (empty($judul) || empty($idDosen) || (!$hasFile && empty($existingFile))) {
                    $this->session->set_flashdata('error', "Lengkapi Judul, Dosen Pembimbing, dan File Proposal pada pilihan usulan ke-$n");
                    return false;
                }
                $pilihanValid[] = [
                    'jenis' => 'usul',
                    'n' => $n,
                    'judul' => $judul,
                    'mitra' => $this->input->post("mitra_$n"),
                    'id_dosen' => $idDosen,
                    'id_dosen2' => !empty($idDosen2) ? $idDosen2 : null,
                    'existing_file' => $hasFile ? null : $existingFile,
                ];
            }
        }

        return $pilihanValid;
    }

    /**
     * Simpan satu pengajuan_ta (+ usulan bila jenis=usul, termasuk upload filenya)
     * per pilihan yang lolos validasi. Return FALSE (dan set flashdata error) kalau
     * ada upload yang gagal.
     */
    private function _simpanPilihanKeDb($id_ta, $pilihanValid)
    {
        $pilihanKe = 0;
        foreach ($pilihanValid as $p) {
            $pilihanKe++;

            if ($p['jenis'] == 'proyek') {
                $pengajuan_ta = array(
                    'id_ta' => $id_ta,
                    'id_proyek' => $p['id_proyek'],
                    'pilihan' => $pilihanKe,
                    'jenis' => 'proyek',
                );
                $this->Pengajuan_model->addNewPengajuanTa($pengajuan_ta);
            } else {
                $pengajuan_ta = array(
                    'id_ta' => $id_ta,
                    'pilihan' => $pilihanKe,
                    'jenis' => 'usul',
                );
                $id_pengajuan_ta = $this->Pengajuan_model->addNewPengajuanTa($pengajuan_ta);

                $fileField = "file_persetujuan_{$p['n']}";
                if (!empty($_FILES[$fileField]['name'])) {
                    $config['upload_path'] = 'uploads/persetujuan';
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = 8000;
                    $config['max_width'] = 1024;
                    $config['max_height'] = 1024;
                    $config['file_name'] = "proposal-" . time() . "-{$p['n']}";
                    $this->load->library('upload');
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload($fileField)) {
                        $this->session->set_flashdata('error', 'Upload file pilihan ke-' . $p['n'] . ' gagal: ' . $this->upload->display_errors('', ''));
                        return false;
                    }
                    $terupload = $this->upload->data();
                    $namaFile = $terupload['file_name'];
                } else {
                    // mode Edit tanpa upload ulang -- pertahankan file lama
                    $namaFile = $p['existing_file'];
                }

                $usulan = array(
                    'id_pengajuan_ta' => $id_pengajuan_ta,
                    'judul' => strtoupper($p['judul']),
                    'mitra' => $p['mitra'],
                    'id_dosen' => $p['id_dosen'],
                    'id_dosen2' => $p['id_dosen2'],
                    'file_persetujuan' => $namaFile,
                );
                $this->Pengajuan_model->addNewUsulan($usulan);
            }
        }

        return true;
    }

    /**
     * This function is used to edit Tugas Akhir. Sejak pengajuan bisa berisi 1-3
     * pilihan sekaligus, Edit memakai form yang sama persis dengan Daftar (blok
     * pilihan 1-3, bebas proyek existing / usulan sendiri) -- bukan cuma 1 pilihan
     * seperti versi lama. Strateginya: ganti SELURUH set pilihan lama dengan set
     * baru dari form (hapus semua baris pengajuan_ta milik id_ta ini lalu simpan
     * ulang), bukan update baris satu-satu, supaya konsisten dengan Daftar dan
     * bisa menangani pilihan yang ditambah/dihapus/diubah jenisnya sekaligus.
     */
    function edit_ta()
    {
        if ($this->isMahasiswa() == TRUE) {
            $this->loadThis();
        } else {
            $userId = $this->vendorId;
            $id_mahasiswa = $this->Pengajuan_model->getIdMahasiswa($userId);
            $mahasiswaID = $id_mahasiswa[0]->id_mahasiswa;

            $id_ta = $this->input->post('id_ta');

            // Pastikan id_ta yang dikirim benar milik mahasiswa yang sedang login
            // (jangan percaya begitu saja hidden field dari client), dan belum
            // terplotting (SOP: proyek yang sudah diterima tidak bisa diedit lagi).
            $taInfo = $this->Pengajuan_model->getTa($mahasiswaID);
            $milikSendiri = false;
            foreach ($taInfo as $row) {
                if ($row->id_ta == $id_ta) {
                    $milikSendiri = true;
                    if ($row->status_pengajuan == 'diterima') {
                        $this->session->set_flashdata('error', 'Pengajuan yang sudah diterima tidak bisa diedit lagi');
                        redirect('mahasiswa/pengajuan/tugasakhir');
                        return;
                    }
                }
            }
            if (!$milikSendiri) {
                $this->session->set_flashdata('error', 'Pengajuan tidak ditemukan');
                redirect('mahasiswa/pengajuan/tugasakhir');
                return;
            }

            $pilihanValid = $this->_kumpulkanPilihanDariForm();
            if ($pilihanValid === false) {
                redirect('mahasiswa/pengajuan/tugasakhir');
                return;
            }
            if (empty($pilihanValid)) {
                $this->session->set_flashdata('error', 'Isi minimal 1 pilihan (proyek atau usulan)');
                redirect('mahasiswa/pengajuan/tugasakhir');
                return;
            }

            // Kumpulkan file lama yang masih dipakai (existing_file_n dari form) SEBELUM
            // pilihan lama dihapus, supaya file yang benar-benar sudah tidak dipakai lagi
            // (diganti/dihapus) bisa dibersihkan setelah data baru berhasil disimpan.
            $fileLamaSemua = $this->Pengajuan_model->getUsulanFileNamesByIdTa($id_ta);
            $fileMasihDipakai = [];
            foreach ($pilihanValid as $p) {
                if ($p['jenis'] == 'usul' && !empty($p['existing_file'])) {
                    $fileMasihDipakai[] = $p['existing_file'];
                }
            }

            $this->Pengajuan_model->deletePengajuanTaByIdTa($id_ta);
            $hasil = $this->_simpanPilihanKeDb($id_ta, $pilihanValid);
            if ($hasil === false) {
                redirect('mahasiswa/pengajuan/tugasakhir');
                return;
            }

            foreach ($fileLamaSemua as $namaFile) {
                if ($namaFile && !in_array($namaFile, $fileMasihDipakai)) {
                    @unlink('./uploads/persetujuan/' . $namaFile);
                }
            }

            $this->Pengajuan_model->update_ta($id_ta, ['status_pengambilan' => 'proses']);
            $this->session->set_flashdata('success', 'Pengajuan TA telah berhasil diubah (' . count($pilihanValid) . ' pilihan)');
            redirect('mahasiswa/pengajuan/tugasakhir');
        }
    }

    function setNonaktifTA()
    {
        if ($this->input->post('is_ubah') != 1) {
            $this->loadViews("404", $this->global, NULL, NULL);
        } else {
            $judul_ta = $this->input->post('judul_ta');
            $id_ta = $this->input->post('id_ta');
            $array = [
                'status_pengambilan' => 'nonaktif'
            ];
            $result = $this->Pengajuan_model->nonaktivasiTA($id_ta, $array, $judul_ta);
            if ($result == TRUE) {
                $this->session->set_flashdata('success', 'Tugas Akhir anda berhasil diganti');
                redirect('mahasiswa/pengajuan/tugasakhir');
            } else {
                $this->session->set_flashdata('error', 'Tugas Akhir anda gagal diganti. Masalah database');
            }
        }
    }

    function updateBimbingan()
    {
        date_default_timezone_set("Asia/Jakarta");

        // File bimbingan OPSIONAL -- mahasiswa boleh mencatat bimbingan tanpa
        // melampirkan file. Cuma jalankan upload kalau memang ada file yang dipilih.
        $namaFile = null;
        if (!empty($_FILES['file']['name'])) {
            $new_name = date("YmdHis") . "-" . $_FILES["file"]['name'];

            $config['upload_path']          = './uploads/data_bimbingan';
            $config['allowed_types']        = 'pdf';
            $config['file_name']            = $new_name;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload("file")) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('mahasiswa/pengajuan/tugasakhir');
                return;
            }
            $terupload = $this->upload->data();
            $namaFile = $terupload['file_name'];
        }

        $dataBimbingan = array(
            'id_ta' => $this->input->post('id_ta'),
            'subject' => $this->input->post('subject'),
            'description' => $this->input->post('description'),
            'status' => $this->input->post('status'),
            'file' => $namaFile,
        );
        $this->db->insert('bimbingan', $dataBimbingan);

        $this->session->set_flashdata('success', 'Bimbingan berhasil di upload');
        redirect('mahasiswa/pengajuan/tugasakhir');
    }
    /**
     * This function is used to load the 404 page not found
     */
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'TA-TRPL : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}
