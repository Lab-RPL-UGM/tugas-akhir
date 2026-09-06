# Proses Bisnis Sistem Tugas Akhir (TA-TRPL)

Dokumen ini merangkum alur kerja sistem manajemen Tugas Akhir mahasiswa Prodi
Teknologi Rekayasa Perangkat Lunak (TRPL), dari proyek diusulkan dosen sampai
mahasiswa yudisium. Disusun berdasarkan SOP yang diklarifikasi langsung oleh
pemilik proses dan diverifikasi terhadap kode & data yang berjalan.

---

## 1. Peran (Role)

| Role | Konstanta | Ringkasan |
|---|---|---|
| **Kaprodi** | `ROLE_KAPRODI` | Bisa "pindah topi" jadi Akademik atau Dosen (`kaprodi/switch_akademik`, `kaprodi/switch_dosen`) untuk mengerjakan tugas administratif/pembimbingan. Tidak punya panel sendiri yang terpisah. |
| **Akademik** | `ROLE_AKADEMIK` | Staf administrasi prodi. Mengelola periode, kategori (bidang), memutuskan proyek & pengajuan TA mahasiswa, mengelola syarat berkas sidang/yudisium, dan memverifikasi berkas. |
| **Dosen** | `ROLE_DOSEN` | Mengusulkan proyek TA, membimbing mahasiswa, menilai sidang. |
| **Mahasiswa** | `ROLE_MAHASISWA` | Mendaftar TA (pilih proyek atau usulkan sendiri), bimbingan, mendaftar sidang & yudisium. |

---

## 2. Alur Utama (Lifecycle Tugas Akhir)

```
Dosen usulkan proyek
        |
        v
Akademik/Kaprodi setujui/tolak (+ atur periode & bidang)
        |
        v
Mahasiswa mendaftar TA (1-3 pilihan: proyek existing / usulan sendiri)
        |
        v
Akademik memutuskan (per-mahasiswa ATAU per-proyek) -- 1 proyek untuk 1 mahasiswa
        |
        v
Bimbingan (dosen <-> mahasiswa)
        |
        v
Sidang (upload syarat, dinilai per komponen, hasil lulus/revisi/mengulang)
        |
        v
Yudisium (syarat administratif terakhir) -> lulus
```

### 2.1 Dosen mengusulkan proyek

- **Endpoint**: `dosen/proyek/addNew`
- Dosen **hanya bisa mengusulkan atas nama dirinya sendiri** -- tidak ada pilihan
  "penanggung jawab" bebas, tidak bisa melimpahkan ke dosen lain. Ditentukan
  otomatis di server dari akun yang login.
- **Periode diisi otomatis** ke periode yang sedang aktif -- dosen tidak perlu
  (dan tidak bisa) memilih manual.
- Field yang diisi dosen: Judul Proyek, Deskripsi, Tools (input tag: ketik lalu
  Enter/koma jadi tag terpisah), **Mitra** (nama instansi/perusahaan mitra --
  label lama "Instansi" sudah diganti), dan **Bidang** (bisa pilih lebih dari
  satu, sesuai SOP).
- Status awal: `pending` ("Menunggu Persetujuan").

### 2.2 Akademik/Kaprodi meninjau proyek

- **Endpoint**: `akademik/proyek`
- Listing terpisah jadi dua tabel: **Belum Diproses** (pending, butuh
  tindakan) dan **Sudah Diproses** (disetujui/ditolak).
- Aksi yang tersedia: **Setujui**, **Tolak**, **Edit** (akademik boleh
  menugaskan ke dosen manapun -- ini beda dengan panel dosen yang dikunci ke
  diri sendiri), atur **Periode** dan **Bidang** (multi-pilih).
- **Aturan pengaman**:
  - Proyek yang **sudah punya mahasiswa diterima** tidak bisa dihapus atau
    ditolak lagi (supaya mahasiswa yang sedang mengerjakan tidak kehilangan
    pegangan).
  - Proyek yang **sudah berstatus ditolak** tidak bisa ditolak ulang (tombol
    otomatis nonaktif).
- **CRUD Bidang** (kategori proyek) ada terpisah di `akademik/bidang` --
  dipakai bersama oleh akademik dan kaprodi (lewat switch-role).

### 2.3 Proyek yang sudah diputuskan -- terkunci dari dosen

- **Endpoint**: `dosen/proyek`
- Begitu status proyek menjadi **disetujui** atau **ditolak**, dosen **tidak
  bisa mengedit lagi** -- tombol Edit diganti tombol **"Lihat"** yang membuka
  modal detail proyek (read-only). Hanya proyek berstatus **Menunggu
  Persetujuan** yang masih bisa diedit dosen.
- Listing menampilkan: Tanggal Pengajuan (terbaru dulu), Judul Proyek,
  Instansi, Status Pengajuan (label: *Menunggu Persetujuan* / *Usulan
  Diterima* / *Usulan Ditolak*), dan Aksi.
- Badge **jumlah pendaftar** (ikon orang + angka) **hanya muncul untuk
  proyek yang sudah diproses** -- proyek yang masih menunggu persetujuan tidak
  mungkin punya pendaftar karena belum pernah tampil ke mahasiswa.
- Dosen bisa klik badge itu untuk **melihat siapa saja mahasiswa yang memilih
  proyeknya** (read-only, bukan tempat menerima -- itu wewenang akademik),
  lengkap nomor pilihan & status, dan bisa lihat **profil tiap mahasiswa**.

### 2.4 Mahasiswa mendaftar Tugas Akhir

- **Endpoint**: `mahasiswa/pengajuan/tugasakhir`
- Mahasiswa mendaftar **satu kali per periode** (bisa diedit).
- Satu pengajuan berisi **1 sampai 3 pilihan**, bebas kombinasi:
  - **Pilih proyek existing** dari katalog periode aktif yang sudah disetujui
    -- **nama dosen disembunyikan** saat memilih (supaya keputusan berdasarkan
    isi proyek, bukan reputasi dosen).
  - **Usulkan proyek/judul sendiri** -- isi Judul, Mitra (opsional, tidak
    wajib), upload file proposal (wajib), dan **pilih sendiri dosen
    pembimbingnya**.
- Proyek yang sama tidak boleh dipilih dua kali dalam satu pengajuan (dicegah
  di form maupun di server).
- Minimal 1 pilihan wajib diisi.
- Setelah submit, mahasiswa bisa melihat status tiap pilihannya: **MENUNGGU
  KEPUTUSAN** atau **DITERIMA**, lengkap detail dosen/mitra/file per pilihan.

### 2.5 Akademik memutuskan (plotting / penerimaan)

Dua cara melihat & memutuskan, keduanya bermuara ke mekanisme penerimaan yang
sama:

1. **Per-mahasiswa** (`akademik/tugas_akhir/plotting/{id}`) -- lihat semua
   pilihan **satu mahasiswa**, pilih salah satu untuk diterima.
2. **Per-proyek** (`akademik/proyek/pendaftar/{id}`) -- lihat semua
   **mahasiswa yang memilih satu proyek**, terima salah satu langsung dari
   sana.

**Aturan inti**:
- **Satu proyek dosen hanya untuk satu mahasiswa.** Begitu diterima, proyek
  itu otomatis terkunci -- tombol Terima nonaktif untuk mahasiswa lain yang
  juga memilih proyek yang sama.
- **Satu mahasiswa hanya disetujui satu dari maksimal tiga pilihannya.**
  Begitu satu pilihan diterima, pilihan-pilihan lain mahasiswa itu otomatis
  dibuang dari antrian.
- Begitu diterima: status pengambilan TA berubah jadi *terplotting*, dan
  **pembimbing aktif (dosbing) baru ditetapkan di titik ini** -- bukan saat
  mahasiswa mendaftar (karena saat mendaftar bisa ada sampai 3 kandidat dosen
  berbeda dari 3 pilihan berbeda).

### 2.6 Bimbingan

- Mahasiswa mengunggah log bimbingan (subjek, deskripsi, file) ke dosen
  pembimbingnya.
- Dosen memantau progres semua mahasiswa bimbingannya lewat `dosen/bimbingan`,
  termasuk melihat profil masing-masing.

### 2.7 Sidang

- Mahasiswa mendaftar sidang dengan mengunggah berkas syarat yang **jumlah dan
  jenisnya dikonfigurasi dinamis** oleh akademik lewat CRUD di
  `akademik/berkas_sidang` -- tidak hardcode di form.
- Tim penguji menilai per **komponen rubrik** (skala 0-4): Tata Bahasa,
  Rumusan Masalah, Metode dan Perancangan, Kesimpulan, Presentasi, dst.
  Rata-rata skor komponen jadi nilai per dosen, digabung antar dosen jadi
  nilai akhir sidang.
- Hasil akhir: **lulus**, **lulus_revisi** (lulus dengan revisi), atau
  **mengulang** (sidang ulang).

### 2.8 Yudisium

- Tahap administratif terakhir **setelah lulus sidang** -- pengesahan resmi
  bahwa semua syarat kelulusan (termasuk revisi TA final) sudah lengkap.
- Berkas syarat dikonfigurasi dinamis juga (`akademik/berkas_yudisium`),
  serupa dengan sidang tapi tanpa komponen penilaian -- cuma status
  `pending`/`disetujui`.
- Gerbang terakhir sebelum mahasiswa dinyatakan resmi lulus/bisa diwisuda.

---

## 3. Ringkasan Aturan Bisnis Kunci (SOP)

1. Dosen menginputkan proyek sendiri; tidak bisa melimpahkan ke dosen lain.
2. CRUD kategori Bidang ada di sisi Akademik/Kaprodi.
3. Satu proyek boleh dikategorikan ke **lebih dari satu** Bidang.
4. Mahasiswa boleh mengusulkan judul TA/proyek sendiri, dengan input Mitra
   yang **opsional** (tidak wajib).
5. Nama dosen **disembunyikan** saat mahasiswa memilih dari katalog proyek.
6. Pengajuan mahasiswa: minimal 1, maksimal 3 pilihan, bebas kombinasi proyek
   existing atau usulan sendiri.
7. Mahasiswa mendaftar sekali per periode, pengajuannya bisa diedit.
8. Satu proyek dosen untuk satu mahasiswa; tidak bisa di-assign ke mahasiswa
   lain setelah diterima.
9. Satu mahasiswa hanya disetujui satu dari seluruh pilihannya.
10. Akademik bisa melihat & memutuskan penerimaan dari dua sudut pandang:
    per-mahasiswa (ajuan) dan per-proyek (siapa saja peminatnya).

---

## 4. Tabel Data Inti

| Tabel | Peran |
|---|---|
| `proyek` | Katalog proyek yang diusulkan dosen; terikat ke `periode` dan (via `proyek_bidang`) ke `bidang`. |
| `bidang` / `proyek_bidang` | Kategori proyek, relasi many-to-many ke `proyek`. |
| `tugas_akhir` | Satu baris per pengajuan TA mahasiswa (per periode). |
| `pengajuan_ta` | Satu baris per **pilihan** dalam satu pengajuan (`pilihan` = urutan 1-3, `jenis` = proyek/usul, `status` = proses/diterima). |
| `usulan` | Detail usulan mandiri mahasiswa (judul, `mitra`, dosen yang diusulkan, file proposal) -- terhubung 1-1 ke satu baris `pengajuan_ta` berjenis usul. |
| `dosbing` | Pembimbing aktif mahasiswa -- diisi **setelah** akademik menerima salah satu pilihan, bukan saat mendaftar. |
| `sidang`, `komponen`, `komponen_nilai`, `penilaian` | Pendaftaran & penilaian sidang. |
| `yudisium` | Pendaftaran & persetujuan yudisium. |
| `berkas_sidang`, `berkas_yudisium` | Master syarat dokumen (dikonfigurasi akademik) yang menentukan slot upload di form pendaftaran mahasiswa. |

---

*Dokumen ini mencerminkan proses bisnis yang disepakati dan alur yang sudah
diimplementasikan per sesi perbaikan terakhir. Bagian yang masih dalam
pengembangan (mis. form edit pengajuan TA untuk banyak pilihan) akan
diperbarui begitu selesai dikerjakan.*
