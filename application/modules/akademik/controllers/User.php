<?php defined('BASEPATH') or exit('No direct script access allowed');

class User extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();
        $this->load->model('User_model');
        $this->isAkademik();
    }

    public function add_user($role)
    {
        if ($role == ROLE_MAHASISWA) {
            $nim = trim($this->input->post('nim'));
            $email = trim($this->input->post('email'));

            if ($this->User_model->checkEmail($email)) {
                $this->session->set_flashdata('error', 'Email ' . htmlspecialchars($email) . ' sudah dipakai mahasiswa lain.');
                redirect('akademik/akun_mahasiswa/add_form');
                return;
            }

            $data = array(
                'nama' => trim($this->input->post('fname')),
                // Username cuma identifier internal — login mahasiswa sekarang murni lewat
                // SSO (dicocokkan via email), jadi tidak lagi diminta manual dari admin.
                'username' => 'mhs' . $nim,
                'id_user_role' => $role,
                'nomor_induk' => $nim,
                'email' => $email,
            );
        } elseif ($role == ROLE_DOSEN || $role == ROLE_KAPRODI) {
            $email = trim($this->input->post('email'));

            // Email cuma diminta (dan cuma dipakai) untuk dosen -- kaprodi tidak punya
            // kolom email sendiri, identitasnya nempel ke dosen/akademik yang sudah ada.
            if ($role == ROLE_DOSEN) {
                if (empty($email)) {
                    $this->session->set_flashdata('error', 'Email UGM wajib diisi -- ini yang dipakai untuk login SSO.');
                    redirect('akademik/akun_dosen/add_form');
                    return;
                }
                if ($this->User_model->checkEmailDosen($email)) {
                    $this->session->set_flashdata('error', 'Email ' . htmlspecialchars($email) . ' sudah dipakai dosen lain.');
                    redirect('akademik/akun_dosen/add_form');
                    return;
                }
            }

            $data = array(
                'nama' => trim($this->input->post('fname')),
                'username' => trim($this->input->post('username')),
                'id_user_role' => $role,
                'nomor_induk' => trim($this->input->post('nid')),
                'gelar_depan' => trim($this->input->post('gelar_depan')),
                'gelar_belakang' => trim($this->input->post('gelar_belakang')),
                'kuota_mahasiswa' => trim($this->input->post('kuota_mahasiswa')),
                'email' => $email,
            );

            // Password OPSIONAL -- dosen/kaprodi login lewat SSO (dicocokkan by email),
            // password lokal cuma jalur cadangan. Kosongkan berarti tidak ada login lokal.
            $password = trim($this->input->post('password'));
            if (!empty($password)) {
                $data['password'] = getHashedPassword($password);
            }
        } else {
            $data = array(
                'nama' => trim($this->input->post('fname')),
                'username' => trim($this->input->post('username')),
                'password' => getHashedPassword(trim($this->input->post('password'))),
                'id_user_role' => $role
            );
        }

        $result = $this->User_model->insert($data);


        if ($result) {
            $this->session->set_flashdata('success', 'User baru telah dibuat');
        } else {
            $this->session->set_flashdata('error', 'User gagal dibuat. Masalah database');
        };
        if ($role == ROLE_MAHASISWA) {
            redirect('akademik/akun_mahasiswa/');
        } elseif ($role == ROLE_DOSEN) {
            redirect('akademik/akun_dosen/');
        } elseif ($role == ROLE_AKADEMIK) {
            redirect('akademik/akun_akademik/');
        } elseif ($role == ROLE_KAPRODI) {
            redirect('akademik/akun_kaprodi/');
        }
    }

    public function upload_data_user($role)
    {
        set_time_limit(300);
        date_default_timezone_set("Asia/Jakarta");
        if ($_FILES["file_excel"]) {
            $new_name = date("YmdHis") . "-" . $_FILES["file_excel"]['name'];
        } else {
            delete_files('./uploads/data_users/');
            if ($role == ROLE_MAHASISWA) {
                $this->session->set_flashdata('error', 'Pilih file (.xlsx) terlebih dahulu');
                redirect('akademik/akun_mahasiswa/add_form');
            } elseif ($role == ROLE_DOSEN) {
                $this->session->set_flashdata('error', 'Pilih file (.xlsx) terlebih dahulu');
                redirect('akademik/akun_dosen/add_form');
            } elseif ($role == ROLE_AKADEMIK) {
                $this->session->set_flashdata('error', 'Pilih file (.xlsx) terlebih dahulu');
                redirect('akademik/akun_akademik/add_form');
            }
        }


        $config['upload_path']          = './uploads/data_users';
        $config['allowed_types']        = 'xlsx|xls';
        $config['file_name'] = $new_name;


        $this->load->library('upload', $config);

        if (!$this->upload->do_upload("file_excel")) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            if ($this->input->post('role') == ROLE_MAHASISWA) {
                redirect('akademik/akun_mahasiswa/add_form');
            } elseif ($this->input->post('role') == ROLE_DOSEN) {
                redirect('akademik/akun_mahasiswa/add_form');
            } elseif ($this->input->post('role') == ROLE_AKADEMIK) {
                redirect('akademik/akun_mahasiswa/add_form');
            } elseif ($this->input->post('role') == ROLE_KAPRODI) {
                redirect('akademik/akun_mahasiswa/add_form');
            }
        } else {
            $this->global['pageTitle'] = "Elusi : Add New User";
            $file_extension = $this->upload->data('file_ext');
            $data['file_extension'] = $file_extension;
            $data['dataThead'] = array();
            if ($file_extension == '.xlsx') {
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
            } else {
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xls');
            }
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load("./uploads/data_users/" . str_replace(" ", "_", $new_name));
            //$spreadsheet = $reader->load("./uploads/data_users/book1.xlsx");
            $data['file_name'] = $new_name;
            $data['role'] = $this->input->post('role');
            $worksheet = $spreadsheet->getActiveSheet();

            $data['dataThead'] = $spreadsheet->getActiveSheet()->rangeToArray(
                'A1:' . $worksheet->getHighestColumn() . '1',     // The worksheet range that we want to retrieve
                NULL,        // Value that should be returned for empty cells
                TRUE,        // Should formulas be calculated (the equivalent of getCalculatedValue() for each cell)
                TRUE,        // Should values be formatted (the equivalent of getFormattedValue() for each cell)
                TRUE         // Should the array be indexed by cell row and cell column
            );

            $this->loadViews("upload_user", $this->global, $data);
        }
    }

    public function upload_submit()
    {
        // Import besar (100+ baris) butuh lebih dari 30 detik default PHP kalau
        // koneksi DB lagi lambat -- tanpa ini request bisa mati di tengah baca
        // spreadsheet / insert tanpa pesan error yang jelas ke user.
        set_time_limit(300);

        $filename = str_replace(" ", "_", $this->input->post('file_name'));
        $file_extension = $this->input->post('file_extension');
        $column_fname = $this->input->post('fname');
        $column_username = $this->input->post('username');
        $column_email = $this->input->post('email');
        $prodi = $this->input->post('prodi');
        $data = array();
        $this->load->model('User_model');
        $role = $this->input->post('role');
        if ($file_extension == '.xlsx') {
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        } else {
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xls');
        }
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load("./uploads/data_users/" . $filename);
        $worksheet = $spreadsheet->getActiveSheet();

        $highestRow = $worksheet->getHighestRow();
        for ($row = 2; $row <= $highestRow; ++$row) {
            $full_username = explode("/", trim($worksheet->getCell($column_username . $row)->getValue()));
            $username = (empty($full_username[1]) ? $full_username[0] : $full_username[1]);
            $check = $this->User_model->checkUsername($username);
            if ($check) {
                continue;
            } else {
                $dataUser = array(
                    'nama' => $worksheet->getCell($column_fname . $row)->getValue(),
                    'nomor_induk' => trim($worksheet->getCell($column_username . $row)->getValue()),
                    'username' => $username,
                    'password' => getHashedPassword(trim($username)),
                    'id_user_role' => $role
                );
                if ($role == ROLE_MAHASISWA && !empty($column_email)) {
                    // Wajib -- login SSO mahasiswa dicocokkan lewat mahasiswa.email
                    // (lihat Login_model::findUserByEmail()). Tanpa ini akun hasil
                    // import tidak akan pernah bisa login.
                    $dataUser['email'] = trim($worksheet->getCell($column_email . $row)->getValue());
                }
                array_push($data, $dataUser);
            }
        }

        if (empty($data)) {
            unlink('./uploads/data_users/' . $filename);
            $this->session->set_flashdata('error', 'Seluruh data yang diimpor sudah ada di database');
        } else {
            $result = $this->User_model->insert_multiple($data);
            if ($result) {
                unlink('./uploads/data_users/' . $filename);
                $this->session->set_flashdata('success', 'User telah berhasil dibuat');
            } else {
                unlink('./uploads/data_users/' . $filename);
                $this->session->set_flashdata('error', 'User gagal dibuat');
            };
        }
        if ($role == ROLE_MAHASISWA) {
            redirect('akademik/akun_mahasiswa/');
        } elseif ($role == ROLE_DOSEN) {
            redirect('akademik/akun_dosen/');
        } elseif ($role == ROLE_AKADEMIK) {
            redirect('akademik/akun_akademik/');
        } elseif ($role == ROLE_KAPRODI) {
            redirect('akademik/akun_kaprodi/');
        }
    }

    public function edit_user($role)
    {
        if ($role == ROLE_MAHASISWA) {
            $user_id = $this->input->post('userId');
            $email = trim($this->input->post('email'));

            if ($this->User_model->checkEmail($email, $user_id)) {
                $this->session->set_flashdata('error', 'Email ' . htmlspecialchars($email) . ' sudah dipakai mahasiswa lain.');
                redirect('akademik/akun_mahasiswa/edit_form/' . $user_id);
                return;
            }

            // Username/password tidak lagi diminta dari form — login mahasiswa murni SSO.
            $data = array(
                'nama' => trim($this->input->post('fname')),
                'nim' => trim($this->input->post('nim')),
                'email' => $email,
                'id_mahasiswa' => trim($this->input->post('id_mahasiswa')),
                'status_pengambilan' => trim($this->input->post('status_pengambilan'))
            );
        } elseif ($role == ROLE_DOSEN || $role == ROLE_KAPRODI) {
            $user_id = $this->input->post('userId');
            $email = trim($this->input->post('email'));

            // Email cuma diminta (dan cuma dipakai) untuk dosen -- kaprodi tidak punya
            // kolom email sendiri, identitasnya nempel ke dosen/akademik yang sudah ada.
            if ($role == ROLE_DOSEN) {
                if (empty($email)) {
                    $this->session->set_flashdata('error', 'Email UGM wajib diisi -- ini yang dipakai untuk login SSO.');
                    redirect('akademik/akun_dosen/edit_form/' . $user_id);
                    return;
                }
                if ($this->User_model->checkEmailDosen($email, $user_id)) {
                    $this->session->set_flashdata('error', 'Email ' . htmlspecialchars($email) . ' sudah dipakai dosen lain.');
                    redirect('akademik/akun_dosen/edit_form/' . $user_id);
                    return;
                }
            }

            if (empty($this->input->post('password'))) {
                $data = array(
                    'nama' => trim($this->input->post('fname')),
                    'username' => trim($this->input->post('username')),
                    'nid' => trim($this->input->post('nid')),
                    'gelar_depan' => trim($this->input->post('gelar_depan')),
                    'gelar_belakang' => trim($this->input->post('gelar_belakang')),
                    'kuota_mahasiswa' => trim($this->input->post('kuota_mahasiswa')),
                    'email' => $email,
                );
            } else {
                $data = array(
                    'nama' => trim($this->input->post('fname')),
                    'username' => trim($this->input->post('username')),
                    'nid' => trim($this->input->post('nid')),
                    'gelar_depan' => trim($this->input->post('gelar_depan')),
                    'gelar_belakang' => trim($this->input->post('gelar_belakang')),
                    'password' => getHashedPassword(trim($this->input->post('password'))),
                    'kuota_mahasiswa' => trim($this->input->post('kuota_mahasiswa')),
                    'email' => $email,
                );
            }
        } else {
            if (empty($this->input->post('password'))) {
                $data = array(
                    'nama' => trim($this->input->post('fname')),
                    'username' => trim($this->input->post('username'))
                );
            } else {
                $data = array(
                    'nama' => trim($this->input->post('fname')),
                    'username' => trim($this->input->post('username')),
                    'password' => getHashedPassword(trim($this->input->post('password')))
                );
            }
        }
        $user_id = $this->input->post('userId');
        $result = $this->User_model->update($data, $user_id, $role);
        if ($result) {
            $this->session->set_flashdata('success', 'User telah berhasil diubah');
        } else {
            $this->session->set_flashdata('error', 'User gagal diubah');
        };

        $role = $this->input->post('role');
        if ($role == ROLE_MAHASISWA) {
            redirect('akademik/akun_mahasiswa/');
        } elseif ($role == ROLE_DOSEN) {
            redirect('akademik/akun_dosen/');
        } elseif ($role == ROLE_AKADEMIK) {
            redirect('akademik/akun_akademik/');
        } elseif ($role == ROLE_KAPRODI) {
            redirect('akademik/akun_kaprodi/');
        }
    }

    public function checkEmailExists()
    {
        //if (array_key_exists('email', $_POST)) {
        $userId = $this->input->post("userId");
        $email = $this->input->post("email");

        if (empty($userId)) {
            $result = $this->User_model->checkEmail($email);
        } else {
            $result = $this->User_model->checkEmail($email, $userId);
        }

        if ($result) {
            echo json_encode(FALSE);
        } else {
            echo json_encode(TRUE);
        }
    }

    public function checkUsernameExists()
    {
        //if (array_key_exists('email', $_POST)) {
        $userId = $this->input->post("userId");
        $username = $this->input->post("username");

        if (empty($userId)) {
            $result = $this->User_model->checkUsername($username);
        } else {
            $result = $this->User_model->checkUsername($username, $userId);
        }

        if ($result) {
            echo json_encode(FALSE);
        } else {
            echo json_encode(TRUE);
        }
    }

    public function checkNIMExists()
    {
        //if (array_key_exists('email', $_POST)) {
        $userId = $this->input->post("userId");
        $nim = $this->input->post("nim");

        if (empty($userId)) {
            $result = $this->User_model->checkNIM($nim);
        } else {
            $result = $this->User_model->checkNIM($nim, $userId);
        }

        if ($result) {
            echo json_encode(FALSE);
        } else {
            echo json_encode(TRUE);
        }
    }

    public function checkNIDExists()
    {
        //if (array_key_exists('email', $_POST)) {
        $userId = $this->input->post("userId");
        $nid = $this->input->post("nid");

        if (empty($userId)) {
            $result = $this->User_model->checkNID($nid);
        } else {
            $result = $this->User_model->checkNID($nid, $userId);
        }

        if ($result) {
            echo json_encode(FALSE);
        } else {
            echo json_encode(TRUE);
        }
    }

    public function toggle_admin()
    {
        $user_id = $this->input->post('userId');
        $result = $this->User_model->toggleAdmin($user_id);
        if ($result) {
            $this->session->set_flashdata('success', 'Status admin dosen telah diubah');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengubah status admin');
        }
        redirect('akademik/akun_dosen/');
    }

    public function delete_user()
    {
        $user_id = $this->input->post("userId");
        $role = $this->input->post('role');
        $result = $this->User_model->delete($user_id);
        if ($result) {
            $this->session->set_flashdata('success', 'User telah dihapus');
        } else {
            $this->session->set_flashdata('error', 'User gagal dihapus');
        };
        $role = $this->input->post('role');
        if ($role == ROLE_MAHASISWA) {
            redirect('akademik/akun_mahasiswa/');
        } elseif ($role == ROLE_DOSEN) {
            redirect('akademik/akun_dosen/');
        } elseif ($role == ROLE_AKADEMIK) {
            redirect('akademik/akun_akademik/');
        } elseif ($role == ROLE_KAPRODI) {
            redirect('akademik/akun_kaprodi/');
        }
    }

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Elusi : 404 - Page Not Found';
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}
