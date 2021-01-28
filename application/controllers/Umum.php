<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Umum extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    public function index()
    {

        $data['title'] = 'Cari Data Pasien';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Pasien_model', 'pasien');
        $data['pasien'] = $this->pasien->semua_pasien();

        $this->load->view('template/admin_header', $data);
        $this->load->view('template/admin_sidebar', $data);
        $this->load->view('template/admin_topbar', $data);
        $this->load->view('umum/pasien', $data);
        $this->load->view('template/admin_footer');
    }
}
