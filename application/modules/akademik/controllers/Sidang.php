<?php

/**
 * Created by nad.
 * Date: 27/03/2018
 * Time: 07:10
 * Description:
 */

class Sidang extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Sidang_model');
        $this->isLoggedIn();
        $this->isAkademik();
    }
    /**
     * This function is used to load the main page
     */
    function index()
    {
        if ($this->isAkademik() == TRUE) {
            $this->loadThis();
        } else {
            $data['sidangInfo'] = $this->Sidang_model->getSidangAkademikInfo();
            $data['dosenInfo'] = $this->Sidang_model->getDosen();
            $data['komponenInfo'] = $this->Sidang_model->getCountKomponen();
            $this->loadViews("dashboard_sidang", $this->global, $data, NULL);
        }
    }
    /**
     * This function is used to load form accepting files sidang from mahasiswa
     */
    function detail($sidangId = NULL)
    {
        if ($this->isAkademik() == TRUE) {
            $this->loadThis();
        } else {
            if ($sidangId == null) {
                redirect('akademik/sidang');
            }
            $data['sidangInfo'] = $this->Sidang_model->getSidangInfo($sidangId);
            $data['berkasInfo'] = $this->Sidang_model->getBerkas($sidangId);
            $this->loadViews("edit_sidang", $this->global, $data, NULL);
        }
    }
    /**
     * This function is used to accepting files sidang from mahasiswa
     */
    function accept($idValidSidang = null, $idMhs)
    {
        if ($this->isAkademik() == TRUE) {
            $this->loadThis();
        } else {
            if (!empty($idValidSidang)) {
                $berkasInfo = array(
                    'id_valid_sidang' => $idValidSidang,
                    'isValid' => 2,
                );
                $result = $this->Sidang_model->accBerkas($berkasInfo, $idValidSidang);
                if ($result == true) {
                    $this->session->set_flashdata('success', 'Berkas berhasil diterima!');
                } else {
                    $this->session->set_flashdata('error', 'Berkas gagal diterima!');
                }
                redirect('akademik/sidang/detail/' . $idMhs);
            }
        }
    }
    /**
     * This function is used to add new message to the system
     */
    function pesan($idValidSidang = null, $idSidang)
    {
        if ($this->isAkademik() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $idMhs = $this->input->post('id_mahasiswa');
            $this->form_validation->set_rules('nama', 'Judul', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('deskripsi', 'Pesan', 'trim|required|max_length[128]');
            if ($this->form_validation->run() == FALSE) {
                $this->detail($idSidang);
            } else {
                if (!empty($idValidSidang)) {
                    $berkasInfo = array(
                        'id_valid_sidang' => $idValidSidang,
                        'isValid' => 3,
                    );
                    $result = $this->Sidang_model->decBerkas($berkasInfo, $idValidSidang);
                    if ($result == true) {
                        $this->session->set_flashdata('success', 'Berkas berhasil ditolak!');
                    } else {
                        $this->session->set_flashdata('error', 'Berkas gagal ditolak!');
                    }
                }
                $nama = $this->input->post('nama');
                $deskripsi = $this->input->post('deskripsi');
                $pesanInfo = array('id_mahasiswa' => $idMhs, 'nama' => $nama, 'deskripsi' => $deskripsi);
                $result = $this->Sidang_model->addPesan($pesanInfo);
                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Revisi berhasill dikirim!');
                } else {
                    $this->session->set_flashdata('error', 'Revisi gagal dikirim!');
                }
                redirect('akademik/sidang/detail/' . $idSidang);
            }
        }
    }
    /**
     * This function is used to load form create jadwal sidang mahasiswa
     */
    function plot($sidangId = NULL)
    {
        if ($this->isAkademik() == TRUE) {
            $this->loadThis();
        } else {
            if ($sidangId == null) {
                redirect('akademik/sidang');
            }
            $data['sidangInfo'] = $this->Sidang_model->getSidangInfo($sidangId);
            $data['dosenInfo'] = $this->Sidang_model->getDosen();

            $this->loadViews("add_jadwal", $this->global, $data, NULL);
        }
    }
    /**
     * This function is used to load form update jadwal sidang mahasiswa
     */
    function editPlot($sidangId = NULL)
    {
        if ($this->isAkademik() == TRUE) {
            $this->loadThis();
        } else {
            if ($sidangId == null) {
                redirect('akademik/sidang');
            }
            $data['sidangInfo'] = $this->Sidang_model->getSidangInfo($sidangId);
            $data['ketuaInfo'] = $this->Sidang_model->getKetuaInfo($sidangId);
            $data['sekreInfo'] = $this->Sidang_model->getSekreInfo($sidangId);
            $data['anggotaInfo'] = $this->Sidang_model->getAnggotaInfo($sidangId);
            $data['dosenInfo'] = $this->Sidang_model->getDosen();
            $data['komponenInfo'] = $this->Sidang_model->getCountKomponen();
            $this->loadViews("edit_jadwal", $this->global, $data, NULL);
        }
    }
    /**
     * This function is used to plotting dosen who is scheduled to sidang
     */
    function jadwal($idSidang = null, $idMhs)
    {
        if ($this->isAkademik() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $tanggalUji = $this->input->post('tanggalJadwal');
            $waktu = $this->input->post('waktuJadwal');
            $waktuSelesai = $this->input->post('waktuSelesaiJadwal');
            $ruang = $this->input->post('ruangJadwal');
            //            get id dan nama, sekretaris is optional
            $dataKetua = $this->input->post('dataKetua');
            $dataSekre = $this->input->post('dataSekretaris');
            $dataAnggota = $this->input->post('dataAnggota');

            $this->form_validation->set_rules('tanggalJadwal', 'Tanggal', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('waktuJadwal', 'Waktu', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('ruangJadwal', 'Ruang', 'trim|required|max_length[128]');

            if ($this->form_validation->run() == FALSE) {
                $this->index();
            } else {
                if (strtotime(date('Y-m-d')) >= strtotime(str_replace('/', '-', $tanggalUji))) {
                    $this->session->set_flashdata('error', 'Jadwal gagal dibuat tanggal tidak boleh kurang dari saat ini!');

                    redirect('akademik/sidang');
                }
                $tanggal = date_format(date_create_from_format('d/m/Y', $this->input->post('tanggalJadwal')), 'Y-m-d');
                if (!empty($idSidang)) {
                    //                    seperate id and nama ketua penguji
                    $array_explode = explode(' ', $dataKetua);
                    $sizeArray = sizeof($array_explode);
                    $id_ketua = $array_explode[0];
                    $nama_ketua = '';
                    for ($i = 1; $i < $sizeArray; $i++) {
                        $nama_ketua = $nama_ketua . ' ' . $array_explode[$i];
                    }
                    //                    seperate id and nama sekretaris penguji
                    if ($dataSekre != null) {
                        $array_explode_sekre = explode(' ', $dataSekre);
                        $sizeArraySekre = sizeof($array_explode_sekre);
                        $id_sekre = $array_explode_sekre[0];
                        $nama_sekre = '';
                        for ($i = 1; $i < $sizeArraySekre; $i++) {
                            $nama_sekre = $nama_sekre . ' ' . $array_explode_sekre[$i];
                        }
                    }
                    //                    seperate id and nama anggota penguji
                    $array_explode_anggota = explode(' ', $dataAnggota);
                    $sizeArrayAnggota = sizeof($array_explode_anggota);
                    $id_anggota = $array_explode_anggota[0];
                    $nama_anggota = '';
                    for ($i = 1; $i < $sizeArrayAnggota; $i++) {
                        $nama_anggota = $nama_anggota . ' ' . $array_explode_anggota[$i];
                    }

                    if (($id_ketua == $id_anggota) || ($dataSekre != null && $id_sekre == $id_ketua) || ($dataSekre != null && $id_sekre == $id_anggota)) {
                        $this->session->set_flashdata('error', 'Jadwal gagal diubah dosen tidak boleh sama!');

                        redirect('akademik/sidang');
                    }
                    //                  when sidang scheduled automate sidang is 'disetujui'
                    $statusInfo = array(
                        'id_sidang' => $idSidang,
                        'status' => 'disetujui',
                    );
                    $status = $this->Sidang_model->editStatus($statusInfo, $idSidang);
                    //                  post pesan to mahasiswa if there is sekretaris to the schedule
                    //                  else no sekretaris
                    if ($dataSekre != null) {
                        $pesanInfo = array(
                            'id_mahasiswa' => $idMhs,
                            'nama' => 'Jadwal sidang terplotting.',
                            'deskripsi' =>
                            'Sidang akan dilaksanakan pada : <br>
                            <table>
                            <tr>
                            <td style="padding: 5px;" ><h4>Tanggal</h4></td>
                            <td style="padding: 5px;" ><h4>:</h4></td>
                            <td style="padding: 5px;" ><h4><strong>' . $tanggalUji . ' pukul ' . $waktu . ' sampai ' . $waktuSelesai . '</strong></h4></td>
                            </tr>
                            <tr>
                            <td style="padding: 5px;" ><h4>Ruang</h4></td>
                            <td style="padding: 5px;" ><h4>:</h4></td>
                            <td style="padding: 5px;" ><h4><strong>' . $ruang . '</strong></h4></td>
                            </tr>
                            <tr>
                            <td style="padding: 5px;" ><h4>Ketua Penguji</h4></td>
                            <td style="padding: 5px;" ><h4>:</h4></td>
                            <td style="padding: 5px;" ><h4><strong>' . $nama_ketua . '</strong></h4></td>
                            </tr>
                            <tr>
                            <td style="padding: 5px;" ><h4>Sekretaris Penguji</h4></td>
                            <td style="padding: 5px;" ><h4>:</h4></td>
                            <td style="padding: 5px;" ><h4><strong>' . $nama_sekre . '</strong></h4></td>
                            </tr>
                            <tr>
                            <td style="padding: 5px;" ><h4>Anggota Penguji</h4></td>
                            <td style="padding: 5px;" ><h4>:</h4></td>
                            <td style="padding: 5px;" ><h4><strong>' . $nama_anggota . '</strong></h4></td>
                            </tr>
                            </table> '
                        );
                    } else {
                        $pesanInfo = array(
                            'id_mahasiswa' => $idMhs,
                            'nama' => 'Jadwal sidang terplotting.',
                            'deskripsi' =>
                            'Sidang akan dilaksanakan pada : <br>
                            <table>
                            <tr>
                            <td style="padding: 5px;" ><h4>Tanggal</h4></td>
                            <td style="padding: 5px;" ><h4>:</h4></td>
                            <td style="padding: 5px;" ><h4><strong>' . $tanggalUji . ' pukul ' . $waktu . ' sampai ' . $waktuSelesai . '</strong></h4></td>
                            </tr>
                            <tr>
                            <td style="padding: 5px;" ><h4>Ruang</h4></td>
                            <td style="padding: 5px;" ><h4>:</h4></td>
                            <td style="padding: 5px;" ><h4><strong>' . $ruang . '</strong></h4></td>
                            </tr>
                            <tr>
                            <td style="padding: 5px;" ><h4>Ketua Penguji</h4></td>
                            <td style="padding: 5px;" ><h4>:</h4></td>
                            <td style="padding: 5px;" ><h4><strong>' . $nama_ketua . '</strong></h4></td>
                            </tr>
                            <tr>
                            <td style="padding: 5px;" ><h4>Anggota Penguji</h4></td>
                            <td style="padding: 5px;" ><h4>:</h4></td>
                            <td style="padding: 5px;" ><h4><strong>' . $nama_anggota . '</strong></h4></td>
                            </tr>
                            </table> '
                        );
                    }
                    $resultPesan = $this->Sidang_model->addPesan($pesanInfo);
                    //                  post schedule sidang mahasiswa
                    $jadwalInfo = array(
                        'id_sidang' => $idSidang,
                        'waktu' => $waktu,
                        'waktu_selesai' => $waktuSelesai,
                        'tanggal' => $tanggal,
                        'ruang' => $ruang,
                    );
                    $jadwal = $this->Sidang_model->addJadwal($jadwalInfo);

                    //                    dipisah 3x karena berbeda role pada tbl anggota_sidang (ketua, sekretaris, anggota/dosbing)
                    $ketuaInfo = array(
                        'id_sidang' => $idSidang,
                        'id_dosen' => $id_ketua,
                        'role' => 'ketua'
                    );
                    $dosen1 = $this->Sidang_model->addAnggota($ketuaInfo);
                    if ($dataSekre != null) {
                        $sekreInfo = array(
                            'id_sidang' => $idSidang,
                            'id_dosen' => $id_sekre,
                            'role' => 'sekretaris'
                        );
                        $dosen2 = $this->Sidang_model->addAnggota($sekreInfo);
                    }
                    $anggotaInfo = array(
                        'id_sidang' => $idSidang,
                        'id_dosen' => $id_anggota,
                        'role' => 'anggota'
                    );
                    $dosen3 = $this->Sidang_model->addAnggota($anggotaInfo);
                    //                  when sidang scheduled, so form penilaian is created 3x based on anggota_sidang
                    $penilaianInfo = array(
                        "id_sidang" => $idSidang,
                        "id_anggota_sidang" => $dosen1
                    );
                    $idPenilaian = $this->Sidang_model->addPenilaian($penilaianInfo);
                    if ($dataSekre != null) {
                        $penilaianInfo2 = array(
                            "id_sidang" => $idSidang,
                            "id_anggota_sidang" => $dosen2
                        );
                        $idPenilaian2 = $this->Sidang_model->addPenilaian($penilaianInfo2);
                    }
                    $penilaianInfo3 = array(
                        "id_sidang" => $idSidang,
                        "id_anggota_sidang" => $dosen3
                    );
                    $idPenilaian3 = $this->Sidang_model->addPenilaian($penilaianInfo3);

                    //                  after penilaian created, insert to komponen nilai table get id from komponen table
                    $dataPenilaian = $this->Sidang_model->getPenilaian($idSidang);
                    $dataKomponen = $this->Sidang_model->getKomponen();

                    //                    insert to komponen_nilai table by anggota_sidang
                    foreach ($dataPenilaian as $record_penilaian) {
                        foreach ($dataKomponen as $record_komponen) {
                            $data_table_komponen_nilai = array(
                                'id_penilaian' => $record_penilaian->id_penilaian,
                                'id_komponen' => $record_komponen->id_komponen,
                            );
                            $result = $this->Sidang_model->addNewKomponenNilai($data_table_komponen_nilai);
                        }
                    }
                    if ($result == true) {
                        $this->session->set_flashdata('success', 'Jadwal berhasil dibuat!');
                    } else {
                        $this->session->set_flashdata('error', 'Jadwal gagal dibuat!');
                    }
                    redirect('akademik/sidang');
                }
            }
        }
    }
    /**
     * This function is used to udpate plotting dosen who is scheduled to sidang
     */
    function editJadwal($idSidang = null, $idMhs)
    {
        if ($this->isAkademik() == TRUE) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $tanggalUji = $this->input->post('editTanggalJadwal');
            $waktu = $this->input->post('editWaktuJadwal');
            $waktuSelesai = $this->input->post('editWaktuSelesaiJadwal');
            $ruang = $this->input->post('editRuangJadwal');
            //            get id dan nama dosen
            $dataKetua = $this->input->post('editDataKetua');
            $dataSekre = $this->input->post('editDataSekre');
            $dataAnggota = $this->input->post('editDataAnggota');
            //            get id anggota_sidang
            $idKetuaAnggota = $this->input->post('editIdKetua');
            $idSekreAnggota = $this->input->post('editIdSekre');
            $idAnggota = $this->input->post('editIdAnggota');

            $this->form_validation->set_rules('editTanggalJadwal', 'Tanggal', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('editWaktuJadwal', 'Waktu', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('editRuangJadwal', 'Ruang', 'trim|required|max_length[128]');

            if ($this->form_validation->run() == FALSE) {
                $this->index();
            } else {
                if (!empty($idSidang)) {
                    if (strtotime(date('Y-m-d')) >= strtotime(str_replace('/', '-', $tanggalUji))) {
                        $this->session->set_flashdata('error', 'Jadwal gagal diubah tanggal tidak boleh kurang dari saat ini!');

                        redirect('akademik/sidang');
                    }
                    $tanggal = date_format(date_create_from_format('d/m/Y', $this->input->post('editTanggalJadwal')), 'Y-m-d');
                    //                    get id dan nama ketua penguji
                    $array_explode = explode(' ', $dataKetua);
                    $sizeArray = sizeof($array_explode);
                    $id_ketua = $array_explode[0];
                    $nama_ketua = '';
                    for ($i = 1; $i < $sizeArray; $i++) {
                        $nama_ketua = $nama_ketua . ' ' . $array_explode[$i];
                    }
                    if ($dataSekre != null) {
                        //                    get id dan nama sekretaris penguji
                        $array_explode_sekre = explode(' ', $dataSekre);
                        $sizeArraySekre = sizeof($array_explode_sekre);
                        $id_sekre = $array_explode_sekre[0];
                        $nama_sekre = '';
                        for ($i = 1; $i < $sizeArraySekre; $i++) {
                            $nama_sekre = $nama_sekre . ' ' . $array_explode_sekre[$i];
                        }
                    }
                    //                    get id dan nama anggota penguji
                    $array_explode_anggota = explode(' ', $dataAnggota);
                    $sizeArrayAnggota = sizeof($array_explode_anggota);
                    $id_anggota = $array_explode_anggota[0];
                    $nama_anggota = '';
                    for ($i = 1; $i < $sizeArrayAnggota; $i++) {
                        $nama_anggota = $nama_anggota . ' ' . $array_explode_anggota[$i];
                    }

                    if (($id_ketua == $id_anggota) || ($dataSekre != null && $id_sekre == $id_ketua) || ($dataSekre != null && $id_sekre == $id_anggota)) {
                        $this->session->set_flashdata('error', 'Jadwal gagal diubah dosen tidak boleh sama!');

                        redirect('akademik/sidang');
                    }
                    if (strtotime($waktu) >= strtotime($waktuSelesai)) {
                        $this->session->set_flashdata('error', 'Jadwal gagal diubah waktu mulai dan selesai sidang tidak boleh sama!');

                        redirect('akademik/sidang');
                    }
                    if ($dataSekre != null) {
                        $pesanInfo = array(
                            'id_mahasiswa' => $idMhs,
                            'nama' => 'Jadwal sidang diubah.',
                            'deskripsi' => 'Sidang akan dilaksanakan pada : <br>
                            <table>
                            <tr>
                            <td style="padding: 5px;" ><h4>Tanggal</h4></td>
                            <td style="padding: 5px;" ><h4>:</h4></td>
                            <td style="padding: 5px;" ><h4><strong>' . $tanggalUji . '</strong></h4></td>
                            </tr>
                            <tr>
                            <td style="padding: 5px;" ><h4>Pukul</h4></td>
                            <td style="padding: 5px;" ><h4>:</h4></td>
                            <td style="padding: 5px;" ><h4><strong>' . $waktu . ' sampai ' . $waktuSelesai . '</strong></h4></td>
                            </tr>
                            <tr>
                            <td style="padding: 5px;" ><h4>Ruang</h4></td>
                            <td style="padding: 5px;" ><h4>:</h4></td>
                            <td style="padding: 5px;" ><h4><strong>' . $ruang . '</strong></h4></td>
                            </tr>
                            <tr>
                            <td style="padding: 5px;" ><h4>Ketua Penguji</h4></td>
                            <td style="padding: 5px;" ><h4>:</h4></td>
                            <td style="padding: 5px;" ><h4><strong>' . $nama_ketua . '</strong></h4></td>
                            </tr>
                            <tr>
                            <td style="padding: 5px;" ><h4>Sekretaris Penguji</h4></td>
                            <td style="padding: 5px;" ><h4>:</h4></td>
                            <td style="padding: 5px;" ><h4><strong>' . $nama_sekre . '</strong></h4></td>
                            </tr>
                            <tr>
                            <td style="padding: 5px;" ><h4>Anggota Penguji</h4></td>
                            <td style="padding: 5px;" ><h4>:</h4></td>
                            <td style="padding: 5px;" ><h4><strong>' . $nama_anggota . '</strong></h4></td>
                            </tr>
                            </table> '
                        );
                        $resultPesan1 = $this->Sidang_model->addPesan($pesanInfo);
                    } else {
                        $pesanInfo = array(
                            'id_mahasiswa' => $idMhs,
                            'nama' => 'Jadwal sidang diubah.',
                            'deskripsi' => 'Sidang akan dilaksanakan pada : <br>
                            <table>
                            <tr>
                            <td style="padding: 5px;" ><h4>Tanggal</h4></td>
                            <td style="padding: 5px;" ><h4>:</h4></td>
                            <td style="padding: 5px;" ><h4><strong>' . $tanggalUji . '</strong></h4></td>
                            </tr>
                            <tr>
                            <td style="padding: 5px;" ><h4>Pukul</h4></td>
                            <td style="padding: 5px;" ><h4>:</h4></td>
                            <td style="padding: 5px;" ><h4><strong>' . $waktu . ' sampai ' . $waktuSelesai . '</strong></h4></td>
                            </tr>
                            <tr>
                            <td style="padding: 5px;" ><h4>Ruang</h4></td>
                            <td style="padding: 5px;" ><h4>:</h4></td>
                            <td style="padding: 5px;" ><h4><strong>' . $ruang . '</strong></h4></td>
                            </tr>
                            <tr>
                            <td style="padding: 5px;" ><h4>Ketua Penguji</h4></td>
                            <td style="padding: 5px;" ><h4>:</h4></td>
                            <td style="padding: 5px;" ><h4><strong>' . $nama_ketua . '</strong></h4></td>
                            </tr>
                            <tr>
                            <td style="padding: 5px;" ><h4>Anggota Penguji</h4></td>
                            <td style="padding: 5px;" ><h4>:</h4></td>
                            <td style="padding: 5px;" ><h4><strong>' . $nama_anggota . '</strong></h4></td>
                            </tr>
                            </table> '
                        );
                        $resultPesan2 = $this->Sidang_model->addPesan($pesanInfo);
                    }

                    $jadwalInfo = array(
                        'id_sidang' => $idSidang,
                        'waktu' => $waktu,
                        'waktu_selesai' => $waktuSelesai,
                        'tanggal' => $tanggal,
                        'ruang' => $ruang,
                    );
                    $jadwal = $this->Sidang_model->editJadwal($jadwalInfo, $idSidang);

                    $ketuaInfo = array(
                        'id_sidang' => $idSidang,
                        'id_dosen' => $id_ketua
                    );
                    if ($dataAnggota != null) {
                        if ($idSekreAnggota != null) {
                            $anggotaInfo = array(
                                'id_sidang' => $idSidang,
                                'id_dosen' => $id_anggota
                            );
                            $dosenAnggota1 = $this->Sidang_model->editAnggotaSidang($anggotaInfo, $idAnggota);
                        } else {
                            $anggotaInfo = array(
                                'id_sidang' => $idSidang,
                                'id_dosen' => $id_anggota,
                                'role' => 'anggota'
                            );
                            $dosenAnggota = $this->Sidang_model->addAnggota($anggotaInfo);
                        }
                    }
                    if ($dataSekre != null) {
                        if ($idSekreAnggota != null) {
                            $sekreInfo = array(
                                'id_sidang' => $idSidang,
                                'id_dosen' => $id_sekre
                            );
                            $dosenSekre1 = $this->Sidang_model->editAnggotaSidang($sekreInfo, $idSekreAnggota);
                        } else {
                            $sekreInfo = array(
                                'id_sidang' => $idSidang,
                                'id_dosen' => $id_sekre,
                                'role' => 'sekretaris'
                            );
                            $dosenSekre = $this->Sidang_model->addAnggota($sekreInfo);
                        }
                    } else {
                        $sekreInfo = array(
                            'id_sidang' => $idSidang,
                            'id_dosen' => null
                        );
                        $dosenSekre2 = $this->Sidang_model->editAnggotaSidang($sekreInfo, $idSekreAnggota);
                    }

                    $result = $this->Sidang_model->editAnggotaSidang($ketuaInfo, $idKetuaAnggota);

                    if ($result == true) {
                        $this->session->set_flashdata('success', 'Jadwal berhasil diubah!');
                    } else {
                        $this->session->set_flashdata('error', 'Jadwal gagal diubah!');
                    }
                    redirect('akademik/sidang');
                } else {
                    echo "Alhamdulillah";
                }
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
