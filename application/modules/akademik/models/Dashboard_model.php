<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model{
    public function getPeriodeAktif(){
        $this->db->select("*");
        $this->db->from('periode');
        $this->db->where('status_periode',1);
        $query = $this->db->get();
        if( $query->num_rows() > 0 ){ return $query->result(); } else { return FALSE; }
    }

    public function getProyekCount(){
        $this->db->select("*");
        $this->db->from('proyek p');
        $this->db->join('dosen d','p.id_dosen=d.id_dosen','inner');
        $this->db->where('p.isDeleted',0);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getSidangCount($id_periode){
        if($id_periode){
            $this->db->select("*");
            $this->db->from('sidang');
            $this->db->where('id_periode',$id_periode);
            $query = $this->db->get();
            $result = $query->num_rows();
        } else {
            $result = 0;
        }
        return $result;
    }

    public function getYudisiumCount($id_periode){
        $this->db->select("*");
        $this->db->from('yudisium');
        $this->db->where('id_periode',$id_periode);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getPeriode($semester,$tahun_ajaran){
        $this->db->select("id_periode,semester,tahun_ajaran");
        $this->db->from('periode');
        $this->db->where('semester',$semester);
        $this->db->where('tahun_ajaran',$tahun_ajaran);
        $query = $this->db->get();

        if( $query->num_rows() > 0 ){ return $query->result(); } else { return FALSE; }
    }

    public function getArrayPeriode($count) {
        $this->db->select("*");
        $this->db->from('periode');
        $this->db->where('status_periode','1');

        $query = $this->db->get();
        
        if($query->num_rows() > 0) { $periode = $query->result(); } else { return FALSE; }
        $id_periode = $periode[0]->id_periode;
        $semester = $periode[0]->semester;
        $tahun_ajaran = $periode[0]->tahun_ajaran;

        $thn1 = explode('/',$tahun_ajaran)[0];
        $thn2 = explode('/',$tahun_ajaran)[1];
        $array = ['id_periode' => $id_periode, 'nama_periode' => $thn1 . '/' . $thn2 . ' ' . ucfirst($semester)];
        $array_periode = array();
        array_push($array_periode,$array);
        for ($i=1; $i <= $count-1; $i++) {
            if($semester == 'ganjil'){
                $thn1 = $thn1 - 1;
                $thn2 = $thn2 - 1;
                $tahun_ajaran = $thn1 . '/' . $thn2;
                $periode = $this->getPeriode('genap',$tahun_ajaran);
                
                if($periode != FALSE) {
                    $id_periode = $periode[0]->id_periode;
                    $semester = $periode[0]->semester;
                    $tahun_ajaran = $periode[0]->tahun_ajaran;

                    $array = ['id_periode' => $id_periode, 'nama_periode' => $thn1 . '/' . $thn2 . ' ' . ucfirst($semester)];

                    array_push($array_periode,$array);
                } else {
                    break;
                }

            } else {
                $periode = $this->getPeriode('ganjil',$tahun_ajaran);
                if($periode != FALSE) {
                $id_periode = $periode[0]->id_periode;
                $semester = $periode[0]->semester;
                $tahun_ajaran = $periode[0]->tahun_ajaran;
                $array = ['id_periode' => $id_periode, 'nama_periode' => $thn1 . '/' . $thn2 . ' ' . ucfirst($semester)];

                    array_push($array_periode,$array);
                } else {
                    break;
                }
            }
        }
        return array_reverse($array_periode);
    }

    public function getKomponen(){
        $this->db->select('*');
        $this->db->from('komponen');
        $query = $this->db->get();
    
        if($query->num_rows() > 0){ return $query->result(); } else { return FALSE; }
    }

    public function getPenilaian($id_periode,$id_komponen){
        $this->db->select('*');
        $this->db->from('periode p');
        $this->db->join('sidang s','p.id_periode=s.id_periode','inner');
        $this->db->join('penilaian pn','pn.id_sidang=s.id_sidang','inner');
        $this->db->join('komponen_nilai kn','kn.id_penilaian=pn.id_penilaian','inner');
        $this->db->join('komponen k','k.id_komponen=kn.id_komponen','inner');
        $this->db->where('p.id_periode',$id_periode);
        $this->db->where('k.id_komponen',$id_komponen);
        $this->db->group_start();
        $this->db->where('s.status','lulus');
        $this->db->or_where('s.status','lulus_revisi');
        $this->db->group_end();
        $query = $this->db->get();

        if($query->num_rows() > 0){ return $query->result(); } else { return FALSE; }
    }

    public function getNilaiSidang($id_periode){
        $this->db->select('nilai_akhir_sidang');
        $this->db->from('sidang');
        $this->db->where('id_periode',$id_periode);
        $this->db->group_start();
        $this->db->where('status','lulus');
        $this->db->or_where('status','lulus_revisi');
        $this->db->group_end();
        $query = $this->db->get();

        if($query->num_rows() > 0){ return $query->result(); } else { return FALSE; }
    }
}
