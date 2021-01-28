<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    public function index()
    {
        $data['title'] = 'Menu Manajemen';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required', [
            'required' => 'Field Tidak Boleh Kosong !'
        ]);

        if ($this->form_validation->run() == false) {

            $this->load->view('template/admin_header', $data);
            $this->load->view('template/admin_sidebar', $data);
            $this->load->view('template/admin_topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('template/admin_footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Menu Anda Sudah Berhasil Di tambahkan !!!
          </div>');
            redirect('menu');
        }
    }

    public function Edit_menu()
    {
        $menu = $this->input->post('menu');
        $id = $this->input->post('id');

        $this->db->set('menu', $menu);
        $this->db->where('id', $id);
        $this->db->update('user_menu');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Menu Anda Berhasil Di Edit !!!
      </div>');
        redirect('menu');
    }

    public function delete_menu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_menu');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Menu Anda Berhasil Di Hapus !!!
      </div>');
        redirect('menu');
    }

    public function submenu()
    {
        $data['title'] = 'Sub Menu Manajemen';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        $this->load->model('Menu_model', 'menu');

        $data['SubMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Judul', 'required', [
            'required' => 'Field Tidak Boleh Kosong !'
        ]);
        $this->form_validation->set_rules('menu_id', 'Menu', 'required', [
            'required' => 'Field Tidak Boleh Kosong !'
        ]);
        $this->form_validation->set_rules('url', 'Url', 'required', [
            'required' => 'Field Tidak Boleh Kosong !'
        ]);
        $this->form_validation->set_rules('icon', 'Icon', 'required', [
            'required' => 'Field Tidak Boleh Kosong !'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('template/admin_header', $data);
            $this->load->view('template/admin_sidebar', $data);
            $this->load->view('template/admin_topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('template/admin_footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active'),
            ];

            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Sub Menu Anda Sudah Berhasil Di tambahkan !!!
          </div>');
            redirect('menu/submenu');
        }
    }

    public function edit_submenu()
    {
        $id = $this->input->post('id');

        $data = [
            'title' => $this->input->post('title'),
            'menu_id' => $this->input->post('menu_id'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'is_active' => $this->input->post('is_active')
        ];

        $this->db->where('id', $id);
        $this->db->update('user_sub_menu', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Menu Anda Berhasil Di edit !!!
      </div>');
        redirect('menu/submenu');
    }

    public function delete_submenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_sub_menu');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        SubMenu Anda Berhasil Di Hapus !!!
      </div>');
        redirect('menu/submenu');
    }
}
