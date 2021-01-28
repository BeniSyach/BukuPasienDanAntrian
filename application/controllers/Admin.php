<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        $data['jumlah'] = $this->db->get('user')->result_array();
        $this->load->model('Admin_model', 'admin');
        $data['pengguna'] = $this->admin->user();

        $this->load->model('Pasien_model', 'pasien');
        $this->pasien->hapus_riwayat();

        $api_url_indo = "https://api.kawalcorona.com/indonesia/";
        $api_indo = file_get_contents($api_url_indo);
        $data['indonesia'] = json_decode($api_indo, true);



        $api_url_indo_prov = "https://api.kawalcorona.com/indonesia/provinsi/";
        $api_indo_prov = file_get_contents($api_url_indo_prov);
        $data['provinsi'] = json_decode($api_indo_prov, true);


        $this->load->view('template/admin_header', $data);
        $this->load->view('template/admin_sidebar', $data);
        $this->load->view('template/admin_topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('template/admin_footer');
    }

    public function edit_user()
    {
        $id = $this->input->post('id');
        $email = $this->input->post('email');
        $nama_lengkap = $this->input->post('nama_lengkap');
        $rule_id = $this->input->post('rule_id');
        $is_actived = $this->input->post('is_actived');

        $this->db->set('nama_lengkap', $nama_lengkap);
        $this->db->set('rule_id', $rule_id);
        $this->db->set('is_actived', $is_actived);
        $this->db->where('email', $email);
        $this->db->update('user');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Selamat !!! data anda Sudah diubah !
          </div>');
        redirect('admin');
    }

    public function hapus_user($id)
    {
        $this->db->where('date_created', $id);
        $this->db->delete('user');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data User Sudah Di Hapus
      </div>');
        redirect('admin');
    }

    public function rule()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $data['rule'] = $this->db->get('user_rule')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('template/admin_header', $data);
            $this->load->view('template/admin_sidebar', $data);
            $this->load->view('template/admin_topbar', $data);
            $this->load->view('admin/rule', $data);
            $this->load->view('template/admin_footer');
        } else {
            $role = $this->input->post('role');

            $data = [
                'role' => $role
            ];

            $this->db->insert('user_rule', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Rule Anda Telah Di Tambahkan !!!
          </div>');
            redirect('admin/rule');
        }
    }

    public function ruleakses($rule_id)
    {
        $data['title'] = 'Role Akses';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $data['rule'] = $this->db->get_where('user_rule', ['id' => $rule_id])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('template/admin_header', $data);
        $this->load->view('template/admin_sidebar', $data);
        $this->load->view('template/admin_topbar', $data);
        $this->load->view('admin/rule_akses', $data);
        $this->load->view('template/admin_footer');
    }

    public function ganti_akses()
    {

        $menu_id = $this->input->post('menuId');
        $rule_id = $this->input->post('ruleId');

        $data = [
            'rule_id' => $rule_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Akses Telah Di Ganti!!!
          </div>');
    }
}
