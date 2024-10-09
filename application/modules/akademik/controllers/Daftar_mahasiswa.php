<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_mahasiswa extends BaseController
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Daftar_mahasiswa_model');
        $this->isLoggedIn();
        $this->isAkademik();
    }

    public function index(){
        if($this->input->get('angkatan')){
            $angkatan = $this->input->get('angkatan');
            if($angkatan == "all"){
                $data_mahasiswa = $this->Daftar_mahasiswa_model->getMahasiswa();
            } else {
                $data_mahasiswa = $this->Daftar_mahasiswa_model->getMahasiswa(NULL,$angkatan);
                $data['pilihan'] = intval(substr(date('Y'),0,2))*100+intval($angkatan);
            }
        } else {
            $data_mahasiswa = $this->Daftar_mahasiswa_model->getMahasiswa();
        }
        $data['arrayAngkatan'] = $this->Daftar_mahasiswa_model->getAngkatan();
        $track_mahasiswa = array();
        foreach ($data_mahasiswa as $result) {
            $id_mahasiswa = $result->id_mahasiswa;
            $nilai_result = $this->Daftar_mahasiswa_model->get_nilai_akhir($id_mahasiswa);
            
            if($nilai_result != FALSE){
                $nilai_akhir = $nilai_result[0]->nilai_akhir_sidang;
            } else {
                $nilai_akhir = FALSE;
            }
            $array_mahasiswa = array(
                'id_mahasiswa' => $id_mahasiswa,
                'nim' => $result->nim,
                'nama' => $result->nama,
                'no_hp'=> $result->mobile,
                'judul' => $this->Daftar_mahasiswa_model->isJudul($id_mahasiswa),
                'sidang' => $this->Daftar_mahasiswa_model->isSidang($id_mahasiswa),
                'nilai_akhir' => $nilai_akhir,
                'yudisium' => $this->Daftar_mahasiswa_model->isYudisium($id_mahasiswa)
            );

            array_push($track_mahasiswa,$array_mahasiswa);
        }
        $this->global['pageTitle'] = "TA-TRPL : Daftar Mahasiswa"; 
        $data['dataTable'] = $track_mahasiswa;
        $this->loadViews("daftar_mahasiswa",$this->global,$data);
    }

    public function detail_mahasiswa($id_mahasiswa){
        $data['dataMahasiswa'] = $this->Daftar_mahasiswa_model->getMahasiswa($id_mahasiswa);
        $data['dataDosbing'] = $this->Daftar_mahasiswa_model->getDosbing($id_mahasiswa);
        $data['dataJudulTA'] = $this->Daftar_mahasiswa_model->getJudulTA($id_mahasiswa);
        $data['dataBerkasSidang'] = $this->Daftar_mahasiswa_model->getBerkasSidang($id_mahasiswa);
        $data['dataBerkasYudisium'] = $this->Daftar_mahasiswa_model->getBerkasYudisium($id_mahasiswa);
        
        $dataSidang = $this->Daftar_mahasiswa_model->getNilaiSidang($id_mahasiswa);
        
        if(!$dataSidang){
            $data['dataNilaiSidang'] = FALSE;
        } else {
            $nilai_akhir_sidang = $dataSidang[0]->nilai_akhir_sidang;
            if($nilai_akhir_sidang >= 3.75){
                $data['dataNilaiSidang'] = 'A';
            } elseif($nilai_akhir_sidang < 3.75 && $nilai_akhir_sidang >= 3.50){
                $data['dataNilaiSidang'] = 'A-';
            } elseif($nilai_akhir_sidang < 3.50 && $nilai_akhir_sidang >= 3.25){
                $data['dataNilaiSidang'] = 'A/B';
            } elseif($nilai_akhir_sidang < 3.25 && $nilai_akhir_sidang >= 3.00){
                $data['dataNilaiSidang'] = 'B+';
            } elseif($nilai_akhir_sidang < 3.00 && $nilai_akhir_sidang >= 2.75){
                $data['dataNilaiSidang'] = 'B';
            } elseif($nilai_akhir_sidang < 2.75 && $nilai_akhir_sidang >= 2.50){
                $data['dataNilaiSidang'] = 'B-';
            } elseif($nilai_akhir_sidang < 2.50 && $nilai_akhir_sidang >= 2.25){
                $data['dataNilaiSidang'] = 'B/C';
            } elseif($nilai_akhir_sidang < 2.25 && $nilai_akhir_sidang >= 2.00){
                $data['dataNilaiSidang'] = 'C+';
            } elseif($nilai_akhir_sidang < 2.00 && $nilai_akhir_sidang >= 1.75){
                $data['dataNilaiSidang'] = 'C';
            } elseif($nilai_akhir_sidang < 1.75 && $nilai_akhir_sidang >= 1.50){
                $data['dataNilaiSidang'] = 'C-';
            } else {
                $data['dataNilaiSidang'] = 'Tidak Lulus';
            }
        }
        /* Mendapatkan nilai rata-rata dari masing-masing komponen nilai*/
        $dataKomponen = $this->Daftar_mahasiswa_model->getKomponen();

        $dataPenilaian = array();
        if($dataKomponen != FALSE){
            foreach ($dataKomponen as $record_komponen) {
                $data_nilai = $this->Daftar_mahasiswa_model->getPenilaian($id_mahasiswa,$record_komponen->id_komponen);
                
                if($data_nilai != NULL){
                    $nilai = 0;
                    $i = 0;
                    foreach ($data_nilai as $record_nilai) {
                        $i++;
                        $nilai = $nilai + $record_nilai->nilai;
                    }
                    $array_nilai = array(
                        'id_komponen' => $record_komponen->id_komponen,
                        'nama_komponen' => $record_komponen->nama,
                        'nilai' => $nilai / $i
                    );
                    array_push($dataPenilaian,$array_nilai);
                } else {
                    break;
                }
            }
        }
        $data['dataPenilaian'] = $dataPenilaian;

        $this->loadViews("detail_mahasiswa_view",$this->global,$data);
    }

    public function exportToExcel(){
        $data_mahasiswa = $this->Daftar_mahasiswa_model->getMahasiswa();
        $track_mahasiswa = array();
        foreach ($data_mahasiswa as $result) {
            $id_mahasiswa = $result->id_mahasiswa;
            $nilai_result = $this->Daftar_mahasiswa_model->get_nilai_akhir($id_mahasiswa);
            
            if($nilai_result != FALSE){
                $nilai_akhir = $nilai_result[0]->nilai_akhir_sidang;
            } else {
                $nilai_akhir = '0';
            }

            $array_mahasiswa = array(
                'nim' => $result->nim,
                'nama' => $result->nama,
                'no_hp'=> ($result->mobile == NULL ? '' : $result->mobile),
                'judul' => ($this->Daftar_mahasiswa_model->isJudul($id_mahasiswa) ? 'Terdaftar' : 'Belum Terdaftar'),
                'sidang' => ($this->Daftar_mahasiswa_model->isSidang($id_mahasiswa) ? 'Terdaftar' : 'Belum Terdaftar'),
                'nilai_akhir' => $nilai_akhir,
                'yudisium' => ($this->Daftar_mahasiswa_model->isYudisium($id_mahasiswa) ? 'Terdaftar' : 'Belum Terdaftar')
            );

            array_push($track_mahasiswa,$array_mahasiswa);
        }

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        foreach(range('A','H') as $columnID) {
			$spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue("A1","No.")
                    ->setCellValue("B1",'NIM')
                    ->setCellValue("C1",'Nama Lengkap')
                    ->setCellValue("D1",'Nomor HP')
                    ->setCellValue("E1",'Judul TA')
                    ->setCellValue("F1",'Sidang')
                    ->setCellValue("G1",'Nilai Akhir')
                    ->setCellValue("H1",'Yudisium');
        $i=2;
        $no=1;
        foreach ($track_mahasiswa as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue("A$i",$no)
                        ->setCellValue("B$i",$data['nim'])
                        ->setCellValue("C$i",$data['nama'])
                        ->setCellValue("D$i",$data['no_hp'])
                        ->setCellValue("E$i",$data['judul'])
                        ->setCellValue("F$i",$data['sidang'])
                        ->setCellValue("G$i",$data['nilai_akhir'])
                        ->setCellValue("H$i",$data['yudisium']);
            $i++;
            $no++;
        }
        $spreadsheet->getActiveSheet()->setTitle('Data_Mahasiswa');
        $spreadsheet->setActiveSheetIndex(0);
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="daftar_mahasiswa.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        //$writer->save('data_mahasiswa.xlsx');
    }
    
}