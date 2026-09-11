<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class : BaseController
 * Base Class to control over all the classes
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class BaseController extends CI_Controller
{
	protected $role = '';
	protected $vendorId = '';
	protected $name = '';
	protected $roleText = '';
	protected $global = array();
	protected $lastLogin = '';
	// Dosen dengan flag dosen.is_admin juga bisa akses panel akademik — lihat isAkademik().
	protected $isAdmin = false;

	public function __construct()
	{
		parent::__construct();

		// Banyak query lama di aplikasi ini pakai GROUP BY pada satu kolom sambil
		// SELECT kolom lain yang tidak ikut di-GROUP BY / di-agregasi (mis.
		// "SELECT d.*, ds.id_user ... GROUP BY m.nama"). Ini valid di MariaDB (default
		// dev lokal) tapi DITOLAK oleh MySQL yang sql_mode-nya include
		// ONLY_FULL_GROUP_BY (default di MySQL 5.7+/8 -- umum di hosting produksi),
		// bikin query gagal -> 500 di halaman yang pakai pola ini (dosen, daftar
		// dosen, sidang, dll). 'stricton' di database.php TIDAK menghapus ini (cuma
		// STRICT_ALL_TABLES/STRICT_TRANS_TABLES), jadi dihapus manual di sini, sekali
		// per request, sebelum controller mana pun sempat menjalankan query.
		if (isset($this->db) && $this->db instanceof CI_DB)
		{
			$this->db->simple_query(
				"SET SESSION sql_mode = REPLACE(REPLACE(REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''), 'NO_ZERO_IN_DATE', ''), 'NO_ZERO_DATE', '')"
			);
		}
	}

	/**
	 * Takes mixed data and optionally a status code, then creates the response
	 *
	 * @access public
	 * @param array|NULL $data
	 *        	Data to output to the user
	 *        	running the script; otherwise, exit
	 */
	public function response($data = NULL)
	{
		$this->output->set_status_header(200)->set_content_type('application/json', 'utf-8')->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))->_display();
		exit();
	}

	/**
	 * This function used to check the user is logged in or not
	 */
	function isLoggedIn()
	{
		$isLoggedIn = $this->session->userdata('isLoggedIn');

		if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
			redirect('login');
		} else {
			$this->role = $this->session->userdata('role');
			$this->vendorId = $this->session->userdata('id_user');
			$this->name = $this->session->userdata('name');
			$this->roleText = $this->session->userdata('roleText');
			$this->lastLogin = $this->session->userdata('lastLogin');
			$this->isAdmin = $this->session->userdata('is_admin') == 1;

			$this->global['name'] = $this->name;
			$this->global['role'] = $this->role;
			$this->global['role_text'] = $this->roleText;
			$this->global['last_login'] = $this->lastLogin;
			$this->global['is_admin'] = $this->isAdmin;
		}
	}
	/**
	 * This function is used to check the access
	 */
	function isKaprodi()
	{
		if (!$this->session->userdata('isKaprodi')) {
			if ($this->role != ROLE_KAPRODI) {
				redirect('error_404');
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	/**
	 * This function is used to check the access
	 */
	function isAkademik()
	{
		$isDosenAdmin = $this->role == ROLE_DOSEN && $this->isAdmin;
		if ($this->role != ROLE_AKADEMIK && !$isDosenAdmin) {
			redirect('error_404');
		} else {
			return false;
		}
	}

	/**
	 * This function is used to check the access
	 */
	function isDosen()
	{
		if ($this->role != ROLE_DOSEN) {
			redirect('error_404');
		} else {
			return false;
		}
	}

	/**
	 * This function is used to check the access
	 */
	function isMahasiswa()
	{
		if ($this->role != ROLE_MAHASISWA) {
			redirect('error_404');
		} else {
			return false;
		}
	}

	/**
	 * This function is used to load the set of views
	 */
	function loadThis()
	{
		// $this->global ['pageTitle'] = 'TA-TRPL : Access Denied';

		//$this->load->view ( 'includes/header', $this->global );
		$this->load->view('error_404');
		//$this->load->view ( 'includes/footer' );
	}

	/**
	 * This function is used to logged out user from system
	 */
	function logout()
	{
		$this->session->sess_destroy();

		// Sesi lokal saja tidak cukup: Casdoor menyimpan sesinya sendiri di
		// browser (cookie terpisah). Tanpa dibersihkan juga, klik "Login dengan
		// SSO TRPL" berikutnya langsung auto-approve akun yang sama tanpa prompt,
		// sehingga logout terasa tidak berpengaruh.
		$this->config->load('casdoor');
		$casdoorConfig = $this->config->item('casdoor');

		$this->load->view('logout', array(
			'casdoorLogoutUrl' => $casdoorConfig['endpoint'] . '/api/logout',
			'loginUrl'         => base_url('login'),
		));
	}

	/**
	 * This function used to load views
	 * @param {string} $viewName : This is view name
	 * @param {mixed} $headerInfo : This is array of header information
	 * @param {mixed} $pageInfo : This is array of page information
	 * @param {mixed} $footerInfo : This is array of footer information
	 * @return {null} $result : null
	 */
	function loadViews($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL)
	{

		$this->load->view('includes/header', $headerInfo);
		$this->load->view($viewName, $pageInfo);
		$this->load->view('includes/footer', $footerInfo);
	}

	function loadViewPdf($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL)
	{
		$this->load->view($viewName, $pageInfo);
	}

	/**
	 * This function used provide the pagination resources
	 * @param {string} $link : This is page link
	 * @param {number} $count : This is page count
	 * @param {number} $perPage : This is records per page limit
	 * @return {mixed} $result : This is array of records and pagination data
	 */
	function paginationCompress($link, $count, $perPage = 10, $segment = SEGMENT)
	{
		$this->load->library('pagination');

		$config['base_url'] = base_url() . $link;
		$config['total_rows'] = $count;
		$config['uri_segment'] = $segment;
		$config['per_page'] = $perPage;
		$config['num_links'] = 5;
		$config['full_tag_open'] = '<nav><ul class="pagination">';
		$config['full_tag_close'] = '</ul></nav>';
		$config['first_tag_open'] = '<li class="arrow">';
		$config['first_link'] = 'First';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<li class="arrow">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li class="arrow">';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="arrow">';
		$config['last_link'] = 'Last';
		$config['last_tag_close'] = '</li>';

		$this->pagination->initialize($config);
		$page = $config['per_page'];
		$segment = $this->uri->segment($segment);

		return array(
			"page" => $page,
			"segment" => $segment
		);
	}
}
