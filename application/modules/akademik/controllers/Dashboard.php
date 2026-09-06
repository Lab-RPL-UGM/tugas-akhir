<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Dashboard extends BaseController {
    public function __construct(){
        parent::__construct();
        $this->load->model('Dashboard_model');
        $this->isLoggedIn();
        $this->isAkademik();
    }

    function index(){
        $data['dataPeriode'] = $this->Dashboard_model->getPeriodeAktif();
        $data['arrayAllPeriode'] = $this->Dashboard_model->getAllPeriode();

        // Periode yang difilter: dari dropdown (?id_periode=), default ke periode aktif
        $idPeriodeFilter = $this->input->get('id_periode');
        if (empty($idPeriodeFilter) && $data['dataPeriode']) {
            $idPeriodeFilter = $data['dataPeriode'][0]->id_periode;
        }
        $data['idPeriodeFilter'] = $idPeriodeFilter;

        $data['countProyek'] = $this->Dashboard_model->getProyekCount();
        $data['dataPengajuanDosen'] = $this->Dashboard_model->getPengajuanPerDosen($idPeriodeFilter);
        $data['rekapDipilih'] = $this->Dashboard_model->getRekapDipilihMahasiswaPerDosen(null, $idPeriodeFilter);
        // Gunakan data tabel rekap sebagai sumber grafik (agar 100% sinkron)
        $chartLabels        = [];
        $chartProyekVals    = [];
        $chartUsulVals      = [];
        $chartPembimbing2Vals = [];
        
        if (!empty($data['rekapDipilih'])) {
            foreach ($data['rekapDipilih'] as $r) {
                // Label pakai nama dosen (opsional: tambahkan ID untuk hindari tabrakan nama)
                $chartLabels[]         = $r['nama']; // atau "{$r['nama']} (ID {$r['id_dosen']})"
                $chartProyekVals[]     = (int)$r['jumlah_mhs_proyek'];
                $chartUsulVals[]       = (int)$r['jumlah_mhs_usul'];               // Pembimbing 1
                $chartPembimbing2Vals[]= (int)$r['jumlah_mhs_pembimbing_ke2'];      // Pembimbing 2
            }
        }
        
        // lempar ke view
        $data['chartLabels']          = $chartLabels;
        $data['chartProyekVals']      = $chartProyekVals;
        $data['chartUsulVals']        = $chartUsulVals;
        $data['chartPembimbing2Vals'] = $chartPembimbing2Vals;
        
        if($data['dataPeriode']){
            $data['countSidang'] = $this->Dashboard_model->getSidangCount($idPeriodeFilter);
            $data['countYudisium'] = $this->Dashboard_model->getYudisiumCount($idPeriodeFilter);
            $data['dataNilai'] = $this->getNilaiPerPeriode();
            // $data['dataNilaiAkhirSidang'] = $this->getPenilaianSidang();
            $data['arrayPeriode'] = $this->Dashboard_model->getArrayPeriode(5);
        } else {
            $data['countSidang'] = 0;
            $data['countYudisium'] = 0;
            $data['dataNilai'] = 0;
        }
        $this->global['pageTitle'] = "TA-TRPL : Dashboard";
        $this->loadViews("dashboard",$this->global,$data);
    }

    function pageNotFound() {
        $this->global['pageTitle'] = 'TA-TRPL : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }

    function getNilaiPerPeriode(){
        $arrayPeriode = $this->Dashboard_model->getArrayPeriode(5);
        $dataKomponen = $this->Dashboard_model->getKomponen();

        $arrayNilai = array();
        
        if($arrayPeriode && $dataKomponen){
            foreach ($arrayPeriode as $data_periode) {
                $id_periode = $data_periode['id_periode'];
                $nama_periode = $data_periode['nama_periode'];
                $data_nilai = [];
                foreach ($dataKomponen as $komponen) {
                    $id_komponen = $komponen->id_komponen;
    
                    $record = $this->Dashboard_model->getPenilaian($id_periode,$id_komponen);
                    $count = 0;
                    $total_nilai = 0;
                    if($record != FALSE) {
                        foreach ($record as $result_nilai) {
                            $total_nilai = $total_nilai + $result_nilai->nilai;
                            $count++;
                        }
                        $rata2 = $total_nilai/$count;
                        $data_nilai[$komponen->nama] = round($rata2,2);
                    } else {
                        $data_nilai[$komponen->nama] = 0.00;
                    }
                }
                $array = [
                    'id_periode' => $id_periode,
                    'nama_periode' => $nama_periode,
                    'data_nilai'=> $data_nilai
                ];
                array_push($arrayNilai,$array);
            }
            return json_encode($arrayNilai);
        } else {
            return json_encode(FALSE);
        }
    }

    function getPenilaianSidang(){
        $id_periode = $this->input->get('id_periode');
        $result = $this->Dashboard_model->getNilaiSidang($id_periode);
        $array_nilai = [];
        if($result){
            $array_nilai = [
                'A' => 0,
                'A-' => 0,
                'A/B' => 0,
                'B+' => 0,
                'B' => 0,
                'B-' => 0,
                'B/C' => 0,
                'C+' => 0,
                'C' => 0,
                'C-' => 0,
                'Tidak Lulus' => 0
            ];
            foreach ($result as $data_sidang) {
                $nilai_akhir_sidang = $data_sidang->nilai_akhir_sidang;
                if($nilai_akhir_sidang >= 3.75){
                    $array_nilai['A'] = $array_nilai['A'] + 1;
                } elseif($nilai_akhir_sidang < 3.75 && $nilai_akhir_sidang >= 3.50){
                    $array_nilai['A-'] = $array_nilai['A-'] + 1;
                } elseif($nilai_akhir_sidang < 3.50 && $nilai_akhir_sidang >= 3.25){
                    $array_nilai['A/B'] = $array_nilai['A/B'] + 1;
                } elseif($nilai_akhir_sidang < 3.25 && $nilai_akhir_sidang >= 3.00){
                    $array_nilai['B+'] = $array_nilai['B+'] + 1;
                } elseif($nilai_akhir_sidang < 3.00 && $nilai_akhir_sidang >= 2.75){
                    $array_nilai['B'] = $array_nilai['B'] + 1;
                } elseif($nilai_akhir_sidang < 2.75 && $nilai_akhir_sidang >= 2.50){
                    $array_nilai['B-'] = $array_nilai['B-'] + 1;
                } elseif($nilai_akhir_sidang < 2.50 && $nilai_akhir_sidang >= 2.25){
                    $array_nilai['B/C'] = $array_nilai['B/C'] + 1;
                } elseif($nilai_akhir_sidang < 2.25 && $nilai_akhir_sidang >= 2.00){
                    $array_nilai['C+'] = $array_nilai['C+'] + 1;
                } elseif($nilai_akhir_sidang < 2.00 && $nilai_akhir_sidang >= 1.75){
                    $array_nilai['C'] = $array_nilai['C'] + 1;
                } elseif($nilai_akhir_sidang < 1.75 && $nilai_akhir_sidang >= 1.50){
                    $array_nilai['C-'] = $array_nilai['C-'] + 1;
                } else {
                    $array_nilai['Tidak Lulus'] = $array_nilai['Tidak Lulus'] + 1;
                }
            }
        } else {
            $array_nilai = [
                'No data' => 'No data'
            ];
        }
        echo json_encode($array_nilai);
    }
}
