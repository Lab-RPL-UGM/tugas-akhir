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

    public function getPengajuanPerDosen()
    {
        $this->db->select('d.nama, COUNT(DISTINCT pt.id_pengajuan_ta) AS total', false);
        $this->db->from('pengajuan_ta pt');
        $this->db->join('proyek p', 'pt.id_proyek = p.id_proyek', 'left');
        $this->db->join('dosen d', 'p.id_dosen = d.id_dosen', 'left');
    
        $this->db->where('pt.jenis', 'proyek');
        $this->db->where('pt.status', 'proses');
    
        // Raw WHERE: non-escaped
        $this->db->where('d.nama IS NOT NULL', null, false);
        // Alternatif aman (pilih salah satu, jangan keduanya):
        // $this->db->where('d.nama_dosen !=', null);
    
        // Hindari ONLY_FULL_GROUP_BY error
        $this->db->group_by(['d.id_dosen', 'd.nama']);
    
        $this->db->order_by('total', 'DESC');
        $this->db->limit(10);
    
        $query = $this->db->get();
    
        // Debug – matikan saat production
        // echo $this->db->last_query(); exit;
    
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }
    
    public function getRekapDipilihMahasiswaPerDosen($dosen_id = null)
    {
        $sql = "
        SELECT
          d.id_dosen,
          d.nama AS nama,
          COALESCE(mp.jml, 0) AS jumlah_mhs_proyek,
          COALESCE(mu.jml, 0) AS jumlah_mhs_usul,               -- HANYA pembimbing pertama
          COALESCE(mk.jml, 0) AS jumlah_mhs_pembimbing_ke2,
          COALESCE(tt.jml, 0) AS total_dipilih_mahasiswa
        FROM dosen AS d
    
        LEFT JOIN (
          SELECT p.id_dosen, COUNT(DISTINCT m.id_mahasiswa) AS jml
          FROM pengajuan_ta pt
          JOIN proyek p       ON p.id_proyek = pt.id_proyek
          JOIN tugas_akhir ta ON ta.id_ta = pt.id_ta
          JOIN mahasiswa m    ON m.id_mahasiswa = ta.id_mahasiswa AND m.isDeleted = 0
          WHERE LOWER(TRIM(pt.jenis)) = 'proyek'
          GROUP BY p.id_dosen
        ) AS mp
          ON mp.id_dosen = d.id_dosen
    
        LEFT JOIN (
          SELECT db1.id_dosen, COUNT(DISTINCT m.id_mahasiswa) AS jml
          FROM pengajuan_ta pt
          JOIN tugas_akhir ta ON ta.id_ta = pt.id_ta
          JOIN mahasiswa m    ON m.id_mahasiswa = ta.id_mahasiswa AND m.isDeleted = 0
          JOIN (
            SELECT a.id_mahasiswa, MIN(a.id_dosbing) AS first_id
            FROM dosbing a
            JOIN mahasiswa m2 ON m2.id_mahasiswa = a.id_mahasiswa AND m2.isDeleted = 0
            JOIN dosen dz     ON dz.id_dosen     = a.id_dosen     AND dz.isDeleted = 0
            GROUP BY a.id_mahasiswa
          ) f  ON f.id_mahasiswa = m.id_mahasiswa
          JOIN dosbing db1 ON db1.id_dosbing = f.first_id
          WHERE LOWER(TRIM(pt.jenis)) = 'usul'
          GROUP BY db1.id_dosen
        ) AS mu
          ON mu.id_dosen = d.id_dosen
    
        LEFT JOIN (
          SELECT db2.id_dosen, COUNT(DISTINCT m.id_mahasiswa) AS jml
          FROM (
            SELECT a.id_mahasiswa, MIN(b.id_dosbing) AS second_id
            FROM dosbing a
            JOIN dosbing b
              ON b.id_mahasiswa = a.id_mahasiswa
             AND b.id_dosbing  > a.id_dosbing
            JOIN mahasiswa mm ON mm.id_mahasiswa = a.id_mahasiswa AND mm.isDeleted = 0
            JOIN dosen dz     ON dz.id_dosen     = a.id_dosen     AND dz.isDeleted = 0
            GROUP BY a.id_mahasiswa
          ) s
          JOIN dosbing db2 ON db2.id_dosbing = s.second_id
          JOIN mahasiswa m ON m.id_mahasiswa = db2.id_mahasiswa AND m.isDeleted = 0
          GROUP BY db2.id_dosen
        ) AS mk
          ON mk.id_dosen = d.id_dosen
    
        LEFT JOIN (
          SELECT id_dosen, COUNT(DISTINCT id_mahasiswa) AS jml
          FROM (
            SELECT p.id_dosen, m.id_mahasiswa
            FROM pengajuan_ta pt
            JOIN proyek p       ON p.id_proyek = pt.id_proyek
            JOIN tugas_akhir ta ON ta.id_ta = pt.id_ta
            JOIN mahasiswa m    ON m.id_mahasiswa = ta.id_mahasiswa AND m.isDeleted = 0
            WHERE LOWER(TRIM(pt.jenis)) = 'proyek'
            GROUP BY p.id_dosen, m.id_mahasiswa
    
            UNION
    
            SELECT db1.id_dosen, m2.id_mahasiswa
            FROM pengajuan_ta pt2
            JOIN tugas_akhir ta2 ON ta2.id_ta = pt2.id_ta
            JOIN mahasiswa m2    ON m2.id_mahasiswa = ta2.id_mahasiswa AND m2.isDeleted = 0
            JOIN (
              SELECT a.id_mahasiswa, MIN(a.id_dosbing) AS first_id
              FROM dosbing a
              JOIN mahasiswa m3 ON m3.id_mahasiswa = a.id_mahasiswa AND m3.isDeleted = 0
              JOIN dosen dz2    ON dz2.id_dosen     = a.id_dosen     AND dz2.isDeleted = 0
              GROUP BY a.id_mahasiswa
            ) f2 ON f2.id_mahasiswa = m2.id_mahasiswa
            JOIN dosbing db1 ON db1.id_dosbing = f2.first_id
            WHERE LOWER(TRIM(pt2.jenis)) = 'usul'
    
            UNION
            SELECT db2.id_dosen, m4.id_mahasiswa
            FROM (
              SELECT a.id_mahasiswa, MIN(b.id_dosbing) AS second_id
              FROM dosbing a
              JOIN dosbing b
                ON b.id_mahasiswa = a.id_mahasiswa
               AND b.id_dosbing  > a.id_dosbing
              JOIN mahasiswa mm2 ON mm2.id_mahasiswa = a.id_mahasiswa AND mm2.isDeleted = 0
              JOIN dosen dz3     ON dz3.id_dosen     = a.id_dosen     AND dz3.isDeleted = 0
              GROUP BY a.id_mahasiswa
            ) s2
            JOIN dosbing db2 ON db2.id_dosbing = s2.second_id
            JOIN mahasiswa m4 ON m4.id_mahasiswa = db2.id_mahasiswa AND m4.isDeleted = 0
            GROUP BY db2.id_dosen, m4.id_mahasiswa
          ) u
          GROUP BY id_dosen
        ) AS tt
          ON tt.id_dosen = d.id_dosen
    
        WHERE d.isDeleted = 0
        ";
    
        $params = [];
        if (!empty($dosen_id) && is_numeric($dosen_id)) {
            $sql .= " AND d.id_dosen = ? ";
            $params[] = (int)$dosen_id;
        }
    
        $sql .= " ORDER BY tt.jml DESC, d.nama ";
    
        $query = $this->db->query($sql, $params);
        return $query->result_array();
    }
    
    public function getChartProyekUsulAligned($status = 'proses', $limit = null)
    {
        // Satu query yang menghasilkan per dosen: mhs_proyek & mhs_usul_first
        $sql = "
        SELECT
          d.id_dosen,
          d.nama,
          COALESCE(mp.jml, 0) AS mhs_proyek,
          COALESCE(mu.jml, 0) AS mhs_usul_first
        FROM dosen AS d
    
        /* Proyek: distinct mahasiswa aktif yang mengajukan jenis='proyek' ke proyek dosen tsb */
        LEFT JOIN (
          SELECT p.id_dosen, COUNT(DISTINCT m.id_mahasiswa) AS jml
          FROM pengajuan_ta pt
          JOIN proyek p       ON p.id_proyek = pt.id_proyek
          JOIN tugas_akhir ta ON ta.id_ta = pt.id_ta
          JOIN mahasiswa m    ON m.id_mahasiswa = ta.id_mahasiswa AND m.isDeleted = 0
          WHERE LOWER(TRIM(pt.jenis)) = 'proyek' " . (!empty($status) ? " AND LOWER(TRIM(pt.status)) = ? " : "") . "
          GROUP BY p.id_dosen
        ) AS mp
          ON mp.id_dosen = d.id_dosen
    
        /* Usul: distinct mahasiswa aktif yang mengajukan jenis='usul' dan dosen tsb adalah pembimbing pertama */
        LEFT JOIN (
          SELECT db1.id_dosen, COUNT(DISTINCT m.id_mahasiswa) AS jml
          FROM pengajuan_ta pt
          JOIN tugas_akhir ta ON ta.id_ta = pt.id_ta
          JOIN mahasiswa m    ON m.id_mahasiswa = ta.id_mahasiswa AND m.isDeleted = 0
          /* first_dosbing = MIN(id_dosbing) per mahasiswa, hanya pasangan (dosen, mhs) aktif */
          JOIN (
            SELECT a.id_mahasiswa, MIN(a.id_dosbing) AS first_id
            FROM dosbing a
            JOIN mahasiswa m2 ON m2.id_mahasiswa = a.id_mahasiswa AND m2.isDeleted = 0
            JOIN dosen dz     ON dz.id_dosen     = a.id_dosen     AND dz.isDeleted = 0
            GROUP BY a.id_mahasiswa
          ) f  ON f.id_mahasiswa = m.id_mahasiswa
          JOIN dosbing db1 ON db1.id_dosbing = f.first_id
          JOIN dosen d2    ON d2.id_dosen    = db1.id_dosen AND d2.isDeleted = 0
          WHERE LOWER(TRIM(pt.jenis)) = 'usul' " . (!empty($status) ? " AND LOWER(TRIM(pt.status)) = ? " : "") . "
          GROUP BY db1.id_dosen
        ) AS mu
          ON mu.id_dosen = d.id_dosen
    
        /* Dosen aktif saja */
        WHERE d.isDeleted = 0
        ORDER BY (COALESCE(mp.jml,0) + COALESCE(mu.jml,0)) DESC, d.nama
        ";
    
        $params = [];
        if (!empty($status)) {
            // status dipakai di subquery proyek & usul → bind dua kali
            $params[] = strtolower($status);
            $params[] = strtolower($status);
        }
    
        if (!empty($limit) && is_numeric($limit)) {
            $sql .= " LIMIT " . (int)$limit;
        }
    
        $q = $this->db->query($sql, $params);
        return $q->result_array();
    }

}
