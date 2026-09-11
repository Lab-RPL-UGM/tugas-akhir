# CI/CD — Tugas Akhir (vps-trpl)

Auto-deploy ke **https://tugas-akhir.trpl.space** setiap push/merge ke `main`,
via GitHub Actions (`.github/workflows/deploy.yml`).

## Alur

1. **CI** — `composer validate` + `php -l` semua file PHP di `application/`,
   `index.php`, `default.php`.
2. **Deploy** — checkout, setup SSH key dari secret, `rsync` source ke
   `/var/www/tugas-akhir`, lalu post-deploy di VPS:
   - `application/logs` & `uploads` di-`chown www-data` + `chmod 775`
     (sekaligus memperbaiki log error yang selama ini tidak bisa ditulis).
   - `composer install --no-dev` **hanya** kalau `composer.lock` berubah.

## File yang TIDAK ikut ter-deploy (aman, tidak ketimpa)

`rsync` mengecualikan: `.git/`, `.github/`, `.idea/`, `.vscode/`, `.DS_Store`,
`application/config/config.php`, `application/config/database.php`,
`application/config/casdoor.php`, `application/logs/`, `uploads/`, `vendor/`.

Artinya kredensial produksi (DB, Casdoor secret), hasil upload user, dan
`vendor/` di VPS tetap utuh.

## Secret yang harus dipasang (repo → Settings → Secrets and variables → Actions)

| Secret | Nilai |
| --- | --- |
| `VPS_HOST` | `82.112.238.145` |
| `VPS_USER` | `root` |
| `VPS_PORT` | `22` |
| `VPS_PATH` | `/var/www/tugas-akhir` |
| `VPS_SSH_KEY` | isi private key deploy (ed25519) |
| `VPS_KNOWN_HOSTS` | output `ssh-keyscan` untuk host VPS |

Bisa juga lewat `gh`:

```sh
gh secret set VPS_HOST        --repo Lab-RPL-UGM/tugas-akhir --body "82.112.238.145"
gh secret set VPS_USER        --repo Lab-RPL-UGM/tugas-akhir --body "root"
gh secret set VPS_PORT        --repo Lab-RPL-UGM/tugas-akhir --body "22"
gh secret set VPS_PATH        --repo Lab-RPL-UGM/tugas-akhir --body "/var/www/tugas-akhir"
gh secret set VPS_KNOWN_HOSTS --repo Lab-RPL-UGM/tugas-akhir < known_hosts
gh secret set VPS_SSH_KEY     --repo Lab-RPL-UGM/tugas-akhir < ~/.ssh/gha_deploy
```

## Setup sekali saja

### 1. Buat SSH deploy key khusus (disarankan, jangan pakai key pribadi)

```sh
ssh-keygen -t ed25519 -C "gha-deploy-tugas-akhir" -f ~/.ssh/gha_deploy -N ""
```

Pasang public key-nya di VPS:

```sh
ssh vps-trpl 'cat >> /root/.ssh/authorized_keys' < ~/.ssh/gha_deploy.pub
```

Alternatif cepat: pakai key yang sudah ada (`~/.ssh/vps-trpl`), pubkey-nya sudah
terdaftar di VPS. Untuk produksi tetap disarankan key khusus.

### 2. Ambil known_hosts

```sh
ssh-keyscan -p 22 82.112.238.145 > known_hosts
```

### 3. Pasang secret

Lihat tabel di atas.

### 4. (Opsional) Environment `production`

Workflow memakai `environment: production`. Buat environment ini di repo
(Settings → Environments) kalau mau menambahkan *required reviewers* /
approval sebelum deploy jalan. Kalau tidak dibuat, GitHub membuatnya otomatis
tanpa approval.

## Menjalankan deploy

- Otomatis: push/merge ke `main`.
- Manual: tab **Actions → Deploy — Tugas Akhir → Run workflow**.

## Rollback

VPS bukan git checkout, jadi rollback dilakukan dari repo:

```sh
git revert <commit-bermasalah>
git push origin main
```

Push tersebut otomatis men-deploy ulang versi sebelumnya.

## Catatan

- `rsync` memakai `--delete`: file di VPS yang **tidak ada di repo dan tidak
  masuk daftar exclude** akan dihapus. Kalau ada file khusus produksi lain,
  tambahkan ke `--exclude` di workflow.
- `vendor/` di-exclude; sinkronisasi dependensi ditangani `composer install`
  saat `composer.lock` berubah.
- OPcache PHP-FPM (`validate_timestamps=On`, `revalidate_freq=2`) otomatis
  mengambil file baru dalam ~2 detik, jadi tidak perlu reload FPM.
- Rekomendasi hardening (belum dilakukan): pakai user `deploy` khusus +
  `sudo` terbatas, jangan `root` langsung.
