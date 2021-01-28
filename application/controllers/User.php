<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $api_url_indo = "https://api.kawalcorona.com/indonesia/";
        $api_indo = file_get_contents($api_url_indo);
        $data['indonesia'] = json_decode($api_indo, true);



        $api_url_indo_prov = "https://api.kawalcorona.com/indonesia/provinsi/";
        $api_indo_prov = file_get_contents($api_url_indo_prov);
        $data['provinsi'] = json_decode($api_indo_prov, true);

        $this->load->view('template/admin_header', $data);
        $this->load->view('template/admin_sidebar', $data);
        $this->load->view('template/admin_topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('template/admin_footer');
    }

    public function editprofile()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/admin_header', $data);
            $this->load->view('template/admin_sidebar', $data);
            $this->load->view('template/admin_topbar', $data);
            $this->load->view('user/edit_profile', $data);
            $this->load->view('template/admin_footer');
        } else {

            $nama_lengkap = $this->input->post('nama_lengkap');
            $email = $this->input->post('email');

            // Jika Ada gambar yang di upload
            $upload_gambar = $_FILES['gambar']['name'];

            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/profile/';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar')) {

                    $gambar_lama = $data['user']['gambar'];
                    if ($gambar_lama != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $gambar_lama);
                    }
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('gambar', $gambar_baru);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                    redirect('user');
                }
            }

            $this->db->set('nama_lengkap', $nama_lengkap);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Selamat !!! data anda Sudah diubah !
          </div>');
            redirect('user');
        }
    }

    public function ganti_password()
    {
        $data['title'] = 'Ganti Password';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $this->form_validation->set_rules('password_lama', 'Password Lama', 'required|trim');
        $this->form_validation->set_rules('password_1', 'Password Baru', 'required|trim|min_length[6]|matches[password_2]');
        $this->form_validation->set_rules('password_2', 'Konfirmasi Password Baru', 'required|trim|min_length[6]|matches[password_1]');


        if ($this->form_validation->run() == false) {

            $this->load->view('template/admin_header', $data);
            $this->load->view('template/admin_sidebar', $data);
            $this->load->view('template/admin_topbar', $data);
            $this->load->view('user/ganti_password', $data);
            $this->load->view('template/admin_footer');
        } else {
            $password_lama = $this->input->post('password_lama');
            $password_1 = $this->input->post('password_1');
            if (!password_verify($password_lama, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Password Lama Anda Salah !!!
              </div>');
                redirect('user/ganti_password');
            } else {
                if ($password_lama == $password_1) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
    Password Lama Anda Tidak Boleh Sama dengan Password Baru !!!
  </div>');
                    redirect('user/ganti_password');
                } else {
                    // password yang sudah benar
                    $password_hash = password_hash($password_1, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    Password Anda Telah Berhasil Di Ubah !!!
  </div>');
                    redirect('user/ganti_password');
                }
            }
        }
    }
}
