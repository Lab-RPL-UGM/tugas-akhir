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

    public function getAllPeriode(){
        $this->db->select("*");
        $this->db->from('periode');
        $this->db->order_by('id_periode', 'DESC');
        $query = $this->db->get();
        if( $query->num_rows() > 0 ){ return $query->result(); } else { return FALSE; }
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

    public function getPengajuanPerDosen($id_periode = null)
    {
        $this->db->select('d.nama, COUNT(DISTINCT pt.id_pengajuan_ta) AS total', false);
        $this->db->from('pengajuan_ta pt');
        $this->db->join('proyek p', 'pt.id_proyek = p.id_proyek', 'left');
        $this->db->join('dosen d', 'p.id_dosen = d.id_dosen', 'left');

        if (!empty($id_periode) && is_numeric($id_periode)) {
            $this->db->join('tugas_akhir ta', 'ta.id_ta = pt.id_ta', 'inner');
            $this->db->where('ta.id_periode', (int)$id_periode);
        }

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
    
    public function getRekapDipilihMahasiswaPerDosen($dosen_id = null, $id_periode = null)
    {
        // $id_periode divalidasi is_numeric lalu di-cast (int) sebelum interpolasi ke SQL,
        // jadi aman dari injection meski disisipkan langsung (bukan lewat placeholder ?)
        // -- perlu ditaruh di banyak titik (tiap subquery) sehingga lebih sederhana dari
        // pada menjejerkan banyak '?' positional yang gampang salah urutan dengan $dosen_id.
        //
        // SEMUA kolom di rekap ini SENGAJA dihitung dari sisi PENGAJUAN (pengajuan_ta /
        // usulan.id_dosen / usulan.id_dosen2), bukan dari dosbing -- rekap ini menjawab
        // "siapa yang MEMILIH/MENGUSULKAN dosen ini" (sinyal minat & calon beban kerja),
        // bukan "siapa yang SUDAH resmi dibimbing" (dosbing baru terisi setelah akademik
        // menerima salah satu pilihan -- lihat halaman plotting per-mahasiswa/proyek).
        // Versi sebelumnya keliru: kolom "usulan" & "pembimbing ke-2" di sini malah
        // membaca dosbing (jadi baru muncul SETELAH diterima, bukan saat baru diajukan),
        // dan pembimbing ke-2 yang diusulkan (usulan.id_dosen2) tidak pernah dihitung.
        $periodeFilterTa = '';
        if (!empty($id_periode) && is_numeric($id_periode)) {
            $idPeriode = (int)$id_periode;
            $periodeFilterTa = " AND ta.id_periode = {$idPeriode} ";
        }

        $sql = "
        SELECT
          d.id_dosen,
          d.nama AS nama,
          COALESCE(mp.jml, 0) AS jumlah_mhs_proyek,
          COALESCE(mu.jml, 0) AS jumlah_mhs_usul,
          COALESCE(mk.jml, 0) AS jumlah_mhs_pembimbing_ke2,
          COALESCE(tt.jml, 0) AS total_dipilih_mahasiswa
        FROM dosen AS d

        LEFT JOIN (
          SELECT p.id_dosen, COUNT(DISTINCT m.id_mahasiswa) AS jml
          FROM pengajuan_ta pt
          JOIN proyek p       ON p.id_proyek = pt.id_proyek
          JOIN tugas_akhir ta ON ta.id_ta = pt.id_ta
          JOIN mahasiswa m    ON m.id_mahasiswa = ta.id_mahasiswa AND m.isDeleted = 0
          WHERE LOWER(TRIM(pt.jenis)) = 'proyek' {$periodeFilterTa}
          GROUP BY p.id_dosen
        ) AS mp
          ON mp.id_dosen = d.id_dosen

        -- Mengajukan usulan dengan dosen ini diusulkan sbg Pembimbing 1
        -- (usulan.id_dosen) -- terlepas sudah diputuskan akademik atau belum.
        LEFT JOIN (
          SELECT u.id_dosen, COUNT(DISTINCT m.id_mahasiswa) AS jml
          FROM pengajuan_ta pt
          JOIN usulan u       ON u.id_pengajuan_ta = pt.id_pengajuan_ta
          JOIN tugas_akhir ta ON ta.id_ta = pt.id_ta
          JOIN mahasiswa m    ON m.id_mahasiswa = ta.id_mahasiswa AND m.isDeleted = 0
          WHERE LOWER(TRIM(pt.jenis)) = 'usul' AND u.id_dosen IS NOT NULL {$periodeFilterTa}
          GROUP BY u.id_dosen
        ) AS mu
          ON mu.id_dosen = d.id_dosen

        -- Diusulkan sbg Pembimbing 2 (usulan.id_dosen2, opsional).
        LEFT JOIN (
          SELECT u.id_dosen2 AS id_dosen, COUNT(DISTINCT m.id_mahasiswa) AS jml
          FROM pengajuan_ta pt
          JOIN usulan u       ON u.id_pengajuan_ta = pt.id_pengajuan_ta
          JOIN tugas_akhir ta ON ta.id_ta = pt.id_ta
          JOIN mahasiswa m    ON m.id_mahasiswa = ta.id_mahasiswa AND m.isDeleted = 0
          WHERE LOWER(TRIM(pt.jenis)) = 'usul' AND u.id_dosen2 IS NOT NULL {$periodeFilterTa}
          GROUP BY u.id_dosen2
        ) AS mk
          ON mk.id_dosen = d.id_dosen

        -- Total mahasiswa UNIK yang memilih dosen ini lewat cara apapun (proyek,
        -- diusulkan pembimbing 1, atau diusulkan pembimbing 2).
        LEFT JOIN (
          SELECT id_dosen, COUNT(DISTINCT id_mahasiswa) AS jml
          FROM (
            SELECT p.id_dosen, m.id_mahasiswa
            FROM pengajuan_ta pt
            JOIN proyek p       ON p.id_proyek = pt.id_proyek
            JOIN tugas_akhir ta ON ta.id_ta = pt.id_ta
            JOIN mahasiswa m    ON m.id_mahasiswa = ta.id_mahasiswa AND m.isDeleted = 0
            WHERE LOWER(TRIM(pt.jenis)) = 'proyek' {$periodeFilterTa}

            UNION

            SELECT u.id_dosen, m.id_mahasiswa
            FROM pengajuan_ta pt
            JOIN usulan u       ON u.id_pengajuan_ta = pt.id_pengajuan_ta
            JOIN tugas_akhir ta ON ta.id_ta = pt.id_ta
            JOIN mahasiswa m    ON m.id_mahasiswa = ta.id_mahasiswa AND m.isDeleted = 0
            WHERE LOWER(TRIM(pt.jenis)) = 'usul' AND u.id_dosen IS NOT NULL {$periodeFilterTa}

            UNION

            SELECT u.id_dosen2, m.id_mahasiswa
            FROM pengajuan_ta pt
            JOIN usulan u       ON u.id_pengajuan_ta = pt.id_pengajuan_ta
            JOIN tugas_akhir ta ON ta.id_ta = pt.id_ta
            JOIN mahasiswa m    ON m.id_mahasiswa = ta.id_mahasiswa AND m.isDeleted = 0
            WHERE LOWER(TRIM(pt.jenis)) = 'usul' AND u.id_dosen2 IS NOT NULL {$periodeFilterTa}
          ) x
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
