<?php
/**
 * Created by nad.
 * Date: 27/03/2018
 * Time: 23:14
 * Description:
 */

class Dashboard_model extends CI_Model
{
    public function getPeriodeAktif()
    {
        $this->db->select("*");
        $this->db->from('periode');
        $this->db->where('status_periode', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    /** Total bimbingan mahasiswa */
    public function getCountBimbingan($userId)
    {
        $this->db->select('d.*, ds.id_user');
        $this->db->from('dosbing d');
        $this->db->join('dosen ds', 'ds.id_dosen = d.id_dosen');
        $this->db->join('mahasiswa m', 'm.id_mahasiswa = d.id_mahasiswa');
        $this->db->join('tugas_akhir ta', 'ta.id_mahasiswa = m.id_mahasiswa');
        $this->db->join('sidang s', 's.id_mahasiswa = m.id_mahasiswa', 'left');
        $this->db->join('yudisium y', 'y.id_mahasiswa = m.id_mahasiswa', 'left');
        $this->db->join('periode p', 'p.id_periode = ta.id_periode');
        // $this->db->where('p.status_periode', 1);
        $this->db->group_by('m.nama');
        $this->db->where('ds.isDeleted', 0);
        $this->db->where('m.isDeleted', 0);
        $this->db->where('ta.status_pengambilan', 'terplotting');
        $this->db->where('y.id_yudisium IS NULL');
        $this->db->where('ds.id_user', $userId);
        $query = $this->db->get();
        return count($query->result());
    }

    /** Total pendadaran mahasiswa */
    public function getCountPendadaran($userId)
    {
        $this->db->select('j.tanggal, j.waktu, j.ruang, m.nim, m.nama, v.path,
        p.id_penilaian, s.nilai_akhir_sidang, p.nilai_akhir_dosen, a.id_sidang');
        $this->db->from('sidang s');
        $this->db->join('mahasiswa m', 'm.id_mahasiswa = s.id_mahasiswa');
        $this->db->join('jadwal_sidang j', 'j.id_sidang = s.id_sidang');
        $this->db->join('validasi_berkas_sidang v', 'v.id_sidang = s.id_sidang');
        $this->db->join('anggota_sidang a', 'a.id_sidang = s.id_sidang');
        $this->db->join('penilaian p', 'p.id_anggota_sidang = a.id_anggota_sidang');
        $this->db->join('dosen d', 'd.id_dosen = a.id_dosen');
        $this->db->join('user u', 'u.id_user = d.id_user');
        $this->db->where('u.id_user', $userId);
        $this->db->where('m.isDeleted', 0);
        // $this->db->where('v.id_berkas_sidang', 1);
        // $this->db->where('v.isValid', '2');
        $this->db->group_by('m.id_mahasiswa');
        $query = $this->db->get();
        return count($query->result());
    }

    /** Total yudisium mahasiswa */
    public function getCountYudisium($userId)
    {
        $this->db->select('d.*, ds.id_user');
        $this->db->from('dosbing d');
        $this->db->join('dosen ds', 'ds.id_dosen = d.id_dosen');
        $this->db->join('mahasiswa m', 'm.id_mahasiswa = d.id_mahasiswa');
        $this->db->join('tugas_akhir ta', 'ta.id_mahasiswa = m.id_mahasiswa');
        $this->db->join('sidang s', 's.id_mahasiswa = m.id_mahasiswa', 'left');
        $this->db->join('yudisium y', 'y.id_mahasiswa = m.id_mahasiswa', 'left');
        $this->db->join('periode p', 'p.id_periode = ta.id_periode');
        // $this->db->where('p.status_periode', 1);
        $this->db->group_by('m.nama');
        $this->db->where('ds.isDeleted', 0);
        $this->db->where('m.isDeleted', 0);
        $this->db->where('y.id_yudisium IS NOT NULL');
        $this->db->where('ds.id_user', $userId);
        $query = $this->db->get();
        return count($query->result());
    }

    /** Total proyek milik dosen (id_user) */
    public function getCountProyek($userId)
    {
        $this->db->select('p.id_dosen');
        $this->db->from('proyek p');
        $this->db->join('dosen ds', 'ds.id_dosen = p.id_dosen');
        $this->db->where('p.isDeleted', 0);
        $this->db->where('ds.id_user', $userId);
        $query = $this->db->get();
        return count($query->result());
    }

    public function getPermohonanTAListByUser($userId)
    {
        $sql = "
            /* 1) MEMILIH PROYEK milik dosen ini */
            SELECT DISTINCT
                m.id_mahasiswa                                                   AS id_mahasiswa,
                m.nama                                                           AS nama_mahasiswa,
                ta.id_ta                                                         AS id_ta,
                p.nama                                                           AS judul,
                'proyek'                                                         AS jenis,
                COALESCE(
                    NULLIF(pt.createdDtm, '0000-00-00 00:00:00'),
                    NULLIF(ta.updatedDtm, '0000-00-00 00:00:00'),
                    NULLIF(ta.createdDtm, '0000-00-00 00:00:00'),
                    NOW()
                )                                                                AS tanggal_pengajuan
            FROM pengajuan_ta pt
            JOIN tugas_akhir ta ON ta.id_ta = pt.id_ta
            JOIN mahasiswa m    ON m.id_mahasiswa = ta.id_mahasiswa AND m.isDeleted = 0
            JOIN proyek p       ON p.id_proyek   = pt.id_proyek
            WHERE LOWER(TRIM(pt.jenis)) = 'proyek'
              AND p.id_dosen IN (SELECT d.id_dosen FROM dosen d WHERE d.id_user = ?)
    
            UNION ALL
    
            /* 2) MEMBAWA USULAN (terima: usulan.id_dosen ATAU pembimbing I dari dosbing) */
            SELECT DISTINCT
                m.id_mahasiswa                                                   AS id_mahasiswa,
                m.nama                                                           AS nama_mahasiswa,
                ta.id_ta                                                         AS id_ta,
                u.judul                                                          AS judul,              -- judul usulan (bisa NULL jika belum ada)
                CASE
                    -- dosen login diusulkan sebagai pembimbing kedua di usulan ini (bukan
                    -- pertama) -- beri label beda supaya tidak terbaca sebagai Pembimbing 1
                    WHEN u.id_dosen2 IN (SELECT d.id_dosen FROM dosen d WHERE d.id_user = ?)
                         AND u.id_dosen NOT IN (SELECT d.id_dosen FROM dosen d WHERE d.id_user = ?)
                    THEN 'usul_pembimbing2'
                    ELSE 'usul'
                END                                                              AS jenis,
                COALESCE(
                    NULLIF(pt.createdDtm, '0000-00-00 00:00:00'),
                    NULLIF(ta.updatedDtm, '0000-00-00 00:00:00'),
                    NULLIF(ta.createdDtm, '0000-00-00 00:00:00'),
                    NOW()
                )                                                                AS tanggal_pengajuan
            FROM pengajuan_ta pt
            JOIN tugas_akhir ta ON ta.id_ta = pt.id_ta
            JOIN mahasiswa m    ON m.id_mahasiswa = ta.id_mahasiswa AND m.isDeleted = 0
            /* judul usulan (bila ada) */
            LEFT JOIN usulan u  ON u.id_pengajuan_ta = pt.id_pengajuan_ta
            /* pembimbing I (dosbing pertama) */
            LEFT JOIN (
                SELECT a.id_mahasiswa, MIN(a.id_dosbing) AS first_id
                FROM dosbing a
                JOIN mahasiswa m2 ON m2.id_mahasiswa = a.id_mahasiswa AND m2.isDeleted = 0
                JOIN dosen dz     ON dz.id_dosen     = a.id_dosen     AND dz.isDeleted = 0
                GROUP BY a.id_mahasiswa
            ) f  ON f.id_mahasiswa = m.id_mahasiswa
            LEFT JOIN dosbing db1 ON db1.id_dosbing = f.first_id
    
            WHERE LOWER(TRIM(pt.jenis)) = 'usul'
              AND (
                    /* usulan langsung menunjuk ke dosen login (pembimbing pertama) */
                    u.id_dosen IN (SELECT d.id_dosen FROM dosen d WHERE d.id_user = ?)
                    /* ATAU usulan mengusulkan dosen login sebagai pembimbing kedua */
                 OR u.id_dosen2 IN (SELECT d.id_dosen FROM dosen d WHERE d.id_user = ?)
                    /* ATAU, bila usulan belum dicatat dosennya, tapi dosbing pertama adalah dosen login */
                 OR db1.id_dosen IN (SELECT d.id_dosen FROM dosen d WHERE d.id_user = ?)
              )
    
            UNION ALL
    
            /* 3) PEMBIMBING KE-2 (judul & tanggal dari pengajuan TA TERAKHIR untuk TA tsb) */
            SELECT DISTINCT
                m.id_mahasiswa                                                   AS id_mahasiswa,
                m.nama                                                           AS nama_mahasiswa,
                ta.id_ta                                                         AS id_ta,
                COALESCE(u_last.judul, p_last.nama, NULL)                        AS judul,
                'pembimbing_ke2'                                                 AS jenis,
                COALESCE(
                    NULLIF(pt_last.createdDtm, '0000-00-00 00:00:00'),
                    NULLIF(ta.updatedDtm, '0000-00-00 00:00:00'),
                    NULLIF(ta.createdDtm, '0000-00-00 00:00:00'),
                    NOW()
                )                                                                AS tanggal_pengajuan
            FROM (
                SELECT a.id_mahasiswa, MIN(b.id_dosbing) AS second_id
                FROM dosbing a
                JOIN dosbing b
                  ON b.id_mahasiswa = a.id_mahasiswa
                 AND b.id_dosbing  > a.id_dosbing
                GROUP BY a.id_mahasiswa
            ) s
            JOIN dosbing db2      ON db2.id_dosbing = s.second_id
            JOIN mahasiswa m      ON m.id_mahasiswa = db2.id_mahasiswa AND m.isDeleted = 0
            LEFT JOIN tugas_akhir ta ON ta.id_mahasiswa = m.id_mahasiswa
    
            /* pengajuan TA TERAKHIR untuk TA ini */
            LEFT JOIN pengajuan_ta pt_last
                   ON pt_last.id_ta = ta.id_ta
                  AND pt_last.createdDtm = (
                        SELECT MAX(NULLIF(ptx.createdDtm, '0000-00-00 00:00:00'))
                        FROM pengajuan_ta ptx
                        WHERE ptx.id_ta = ta.id_ta
                  )
    
            /* judul usulan/proyek dari pengajuan terakhir */
            LEFT JOIN usulan u_last ON u_last.id_pengajuan_ta = pt_last.id_pengajuan_ta
            LEFT JOIN proyek p_last ON p_last.id_proyek       = pt_last.id_proyek
    
            WHERE db2.id_dosen IN (SELECT d.id_dosen FROM dosen d WHERE d.id_user = ?)
            ORDER BY tanggal_pengajuan DESC
        ";
    
        // Eksekusi dengan parameter (id_user) untuk ketiga blok
        $old = $this->db->db_debug;
        $this->db->db_debug = FALSE;
        $query = $this->db->query($sql, array_fill(0, 7, (int)$userId));
        if (!$query) {
            $err = $this->db->error();
            log_message('error', 'getPermohonanTAListByUser SQL ERROR: '.$err['message'].' ('.$err['code'].')');
            $this->db->db_debug = $old;
            return [];
        }
        $this->db->db_debug = $old;
    
        return $query->result_array();
    }
}