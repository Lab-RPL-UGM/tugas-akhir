<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Class : Login (LoginController)
 * Login class to control to authenticate ta credentials and starts ta's session.
 * Created by nad.
 * Date: 07/03/2018
 * Time: 12:33
 * Description: 1=Kaprodi , 2=Akademik , 3=Dosen , 4=Mahasiswa
 */
class Login extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $this->isLoggedIn();
    }

    /**
     * This function used to check the ta is logged in or not
     */
    function isLoggedIn()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        $id_user_role = $this->session->userdata('role');

        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            $dataProfil = $this->Login_model->getDosen();

            $data['dataTable'] = array();
            if ($dataProfil) {
                foreach ($dataProfil as $record) {
                    $id_dosen = $record->id_dosen;
                    $array = array(
                        'id_dosen' => $record->id_dosen,
                        'nid' => $record->nid,
                        'nama_dosen' => $record->nama,
                        'gelar_depan' => $record->gelar_depan,
                        'gelar_belakang' => $record->gelar_belakang,
                        'mobile' => $record->mobile,
                        'kuota_mahasiswa' => $record->kuota_mahasiswa,
                        'bimbingan' => $this->Login_model->getCountBimbingan($id_dosen),
                        'sidang' => $this->Login_model->getSidangCount($record->id_user)
                    );
                    array_push($data['dataTable'], $array);
                }
            }
            
            $this->load->view('login', $data);
        }
        else
        {
			if($id_user_role == ROLE_MAHASISWA) {
				redirect('mahasiswa');
			}elseif($id_user_role == ROLE_DOSEN) {
				redirect('dosen');
			}elseif($id_user_role == ROLE_AKADEMIK) {
				redirect('akademik');
			}elseif($id_user_role == ROLE_KAPRODI) {
				redirect('kaprodi');
			}
        }
    }

    /**
     * This function used to logged in ta
     */
    public function loginMe()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[255]');

        if($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $result = $this->Login_model->loginAll($username, $password);

            if(count($result) > 0)
            {
                foreach ($result as $res)
                {
                    $id_user_role = $res->id_user_role;

                    $sessionArray = array(
                        'id_user'=>$res->id_user,
                        'role'=>$res->id_user_role,
                        'roleText'=>$res->role,
                        'name'=>$res->nama,
                        'isLoggedIn' => TRUE);

                    $this->session->set_userdata($sessionArray);

                    if($id_user_role == 4) {
                        redirect('mahasiswa');
                    }else if($id_user_role == 3) {
                        redirect('dosen');
                    }
                }
            }
            else
            {
                $this->session->set_flashdata('error', 'username or password mismatch');

                redirect('login');
            }
        }
    }

    /**
     * This function used to load forgot password view
     */
    public function forgotPassword()
    {
        $this->load->view('forgotPassword');
    }

    /**
     * This function used to generate reset password request link
     */
    function resetPasswordUser()
    {
        $status = '';

        $this->load->library('form_validation');

        $this->form_validation->set_rules('login_username','username');

        if($this->form_validation->run() == FALSE)
        {
            $this->forgotPassword();
        }
        else
        {
            $username = $this->input->post('login_username');

            if($this->Login_model->checkusernameExist($username))
            {
                $encoded_username = urlencode($username);

                $this->load->helper('string');
                $data['username'] = $username;
                $data['activation_id'] = random_string('alnum',15);
                $data['createdDtm'] = date('Y-m-d H:i:s');
                $data['agent'] = getBrowserAgent();
                $data['client_ip'] = $this->input->ip_address();

                $save = $this->Login_model->resetPasswordUser($data);

                if($save)
                {
                    $data1['reset_link'] = base_url() . "login/resetPasswordConfirmUser/" . $data['activation_id'] . "/" . $encoded_username;
                    $userInfo = $this->Login_model->getCustomerInfoByusername($username);

                    if(!empty($userInfo)){
                        $data1["name"] = $userInfo[0]->name;
                        $data1["username"] = $userInfo[0]->username;
                        $data1["message"] = "Reset Your Password";
                    }

                    $sendStatus = resetPasswordusername($data1);

                    if($sendStatus){
                        $status = "send";
                        setFlashData($status, "Reset password link sent successfully, please check mails.");
                    } else {
                        $status = "notsend";
                        setFlashData($status, "username has been failed, try again.");
                    }
                }
                else
                {
                    $status = 'unable';
                    setFlashData($status, "It seems an error while sending your details, try again.");
                }
            }
            else
            {
                $status = 'invalid';
                setFlashData($status, "This username is not registered with us.");
            }
            redirect('ta/forgotPassword');
        }
    }

    // This function used to reset the password
    function resetPasswordConfirmUser($activation_id, $username)
    {
        // Get username and activation code from URL values at index 3-4
        $username = urldecode($username);

        // Check activation id in database
        $is_correct = $this->Login_model->checkActivationDetails($username, $activation_id);

        $data['username'] = $username;
        $data['activation_code'] = $activation_id;

        if ($is_correct == 1)
        {
            $this->load->view('newPassword', $data);
        }
        else
        {
            redirect('login');
        }
    }

    // This function used to create new password
    function createPasswordUser()
    {
        $status = '';
        $message = '';
        $username = $this->input->post("username");
        $activation_id = $this->input->post("activation_code");

        $this->load->library('form_validation');

        $this->form_validation->set_rules('password','Password','required|max_length[20]');
        $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');

        if($this->form_validation->run() == FALSE)
        {
            $this->resetPasswordConfirmUser($activation_id, urlencode($username));
        }
        else
        {
            $password = $this->input->post('password');
            $cpassword = $this->input->post('cpassword');

            // Check activation id in database
            $is_correct = $this->Login_model->checkActivationDetails($username, $activation_id);

            if($is_correct == 1)
            {
                $this->Login_model->createPasswordUser($username, $password);

                $status = 'success';
                $message = 'Password changed successfully';
            }
            else
            {
                $status = 'error';
                $message = 'Password changed failed';
            }

            setFlashData($status, $message);

            redirect("login");
        }
    }
}
?>
