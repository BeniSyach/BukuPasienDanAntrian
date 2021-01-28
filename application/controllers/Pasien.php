<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    public function data_pasien()
    {
        $data['title'] = 'Data Pasien';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Pasien_model', 'pasien');
        $data['pasien'] = $this->pasien->semua_pasien();

        $data['riwayat'] = $this->db->get('riwayat_pasien')->row_array();

        $this->load->view('template/admin_header', $data);
        $this->load->view('template/admin_sidebar', $data);
        $this->load->view('template/admin_topbar', $data);
        $this->load->view('pasien/data_pasien', $data);
        $this->load->view('template/admin_footer');
    }

    public function edit_data_pasien()
    {
        $data['title'] = 'Edit Data Pasien';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['huruf'] = $this->db->get('abjad')->result_array();

        $this->load->view('template/admin_header', $data);
        $this->load->view('template/admin_sidebar', $data);
        $this->load->view('template/admin_topbar', $data);
        $this->load->view('pasien/edit_data_pasien', $data);
        $this->load->view('template/admin_footer');
    }

    public function riwayat_pasien()
    {
        $data['title'] = 'Riwayat Pasien';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['pasien'] = $this->db->get('riwayat_pasien')->result_array();


        $this->load->view('template/admin_header', $data);
        $this->load->view('template/admin_sidebar', $data);
        $this->load->view('template/admin_topbar', $data);
        $this->load->view('pasien/riwayat_pasien', $data);
        $this->load->view('template/admin_footer');
    }

    public function tambah_riwayat_pasien()
    {
        $nama = $this->input->post('nama');
        $nomor = $this->input->post('nomor');
        $huruf = $this->input->post('huruf');
        $tanggal = time();

        $data = [
            'nama' => $nama,
            'nomor' => $nomor,
            'huruf' => $huruf,
            'tanggal' => $tanggal
        ];

        $this->db->insert('riwayat_pasien', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Telah Ditambahkan Ke Riwayat
          </div>');
    }

    public function editpasien($id)
    {
        $data['title'] = 'Edit Data Pasien';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        if ($id == '1') {
            $data['pasien'] = $this->db->get('data_pasien')->result_array();
            $data['nomor'] = $this->db->order_by('id', "desc")->limit(1)->get('data_pasien')->row_array();

            if ($this->form_validation->run() == false) {
                $this->load->view('template/admin_header', $data);
                $this->load->view('template/admin_sidebar', $data);
                $this->load->view('template/admin_topbar', $data);
                $this->load->view('pasien/pasien_a', $data);
                $this->load->view('template/admin_footer');
            } else {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'nomor' => $this->input->post('nomor'),
                    'huruf' => 'A'
                ];
                $this->db->insert('data_pasien', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Tambahkan!!!
          </div>');
                redirect('pasien/editpasien/' . $id);
            }
        } else if ($id == '2') {
            $data['pasien'] = $this->db->get('huruf_b')->result_array();
            $data['nomor'] = $this->db->order_by('id', "desc")->limit(1)->get('huruf_b')->row_array();
            if ($this->form_validation->run() == false) {
                $this->load->view('template/admin_header', $data);
                $this->load->view('template/admin_sidebar', $data);
                $this->load->view('template/admin_topbar', $data);
                $this->load->view('pasien/pasien_b', $data);
                $this->load->view('template/admin_footer');
            } else {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'nomor' => $this->input->post('nomor'),
                    'huruf' => 'A'
                ];
                $this->db->insert('huruf_b', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Tambahkan!!!
          </div>');
                redirect('pasien/editpasien/' . $id);
            }
        } else if ($id == '3') {
            $data['pasien'] = $this->db->get('huruf_c')->result_array();
            $data['nomor'] = $this->db->order_by('id', "desc")->limit(1)->get('huruf_c')->row_array();
            if ($this->form_validation->run() == false) {
                $this->load->view('template/admin_header', $data);
                $this->load->view('template/admin_sidebar', $data);
                $this->load->view('template/admin_topbar', $data);
                $this->load->view('pasien/pasien_c', $data);
                $this->load->view('template/admin_footer');
            } else {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'nomor' => $this->input->post('nomor'),
                    'huruf' => 'A'
                ];
                $this->db->insert('huruf_c', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Tambahkan!!!
          </div>');
                redirect('pasien/editpasien/' . $id);
            }
        } else if ($id == '4') {
            $data['pasien'] = $this->db->get('huruf_d')->result_array();
            $data['nomor'] = $this->db->order_by('id', "desc")->limit(1)->get('huruf_d')->row_array();
            if ($this->form_validation->run() == false) {
                $this->load->view('template/admin_header', $data);
                $this->load->view('template/admin_sidebar', $data);
                $this->load->view('template/admin_topbar', $data);
                $this->load->view('pasien/pasien_d', $data);
                $this->load->view('template/admin_footer');
            } else {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'nomor' => $this->input->post('nomor'),
                    'huruf' => 'A'
                ];
                $this->db->insert('huruf_d', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Tambahkan!!!
          </div>');
                redirect('pasien/editpasien/' . $id);
            }
        } else if ($id == '5') {
            $data['pasien'] = $this->db->get('huruf_e')->result_array();
            $data['nomor'] = $this->db->order_by('id', "desc")->limit(1)->get('huruf_e')->row_array();
            if ($this->form_validation->run() == false) {
                $this->load->view('template/admin_header', $data);
                $this->load->view('template/admin_sidebar', $data);
                $this->load->view('template/admin_topbar', $data);
                $this->load->view('pasien/pasien_e', $data);
                $this->load->view('template/admin_footer');
            } else {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'nomor' => $this->input->post('nomor'),
                    'huruf' => 'A'
                ];
                $this->db->insert('huruf_e', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Tambahkan!!!
          </div>');
                redirect('pasien/editpasien/' . $id);
            }
        } else if ($id == '6') {
            $data['pasien'] = $this->db->get('huruf_f')->result_array();
            $data['nomor'] = $this->db->order_by('id', "desc")->limit(1)->get('huruf_f')->row_array();
            if ($this->form_validation->run() == false) {
                $this->load->view('template/admin_header', $data);
                $this->load->view('template/admin_sidebar', $data);
                $this->load->view('template/admin_topbar', $data);
                $this->load->view('pasien/pasien_f', $data);
                $this->load->view('template/admin_footer');
            } else {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'nomor' => $this->input->post('nomor'),
                    'huruf' => 'A'
                ];
                $this->db->insert('huruf_f', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Tambahkan!!!
          </div>');
                redirect('pasien/editpasien/' . $id);
            }
        } else if ($id == '7') {
            $data['pasien'] = $this->db->get('huruf_g')->result_array();
            $data['nomor'] = $this->db->order_by('id', "desc")->limit(1)->get('huruf_g')->row_array();
            if ($this->form_validation->run() == false) {
                $this->load->view('template/admin_header', $data);
                $this->load->view('template/admin_sidebar', $data);
                $this->load->view('template/admin_topbar', $data);
                $this->load->view('pasien/pasien_g', $data);
                $this->load->view('template/admin_footer');
            } else {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'nomor' => $this->input->post('nomor'),
                    'huruf' => 'A'
                ];
                $this->db->insert('huruf_g', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Tambahkan!!!
          </div>');
                redirect('pasien/editpasien/' . $id);
            }
        } else if ($id == '8') {
            $data['pasien'] = $this->db->get('huruf_h')->result_array();
            $data['nomor'] = $this->db->order_by('id', "desc")->limit(1)->get('huruf_h')->row_array();
            if ($this->form_validation->run() == false) {
                $this->load->view('template/admin_header', $data);
                $this->load->view('template/admin_sidebar', $data);
                $this->load->view('template/admin_topbar', $data);
                $this->load->view('pasien/pasien_h', $data);
                $this->load->view('template/admin_footer');
            } else {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'nomor' => $this->input->post('nomor'),
                    'huruf' => 'A'
                ];
                $this->db->insert('huruf_h', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Tambahkan!!!
          </div>');
                redirect('pasien/editpasien/' . $id);
            }
        } else if ($id == '9') {
            $data['pasien'] = $this->db->get('huruf_i')->result_array();
            $data['nomor'] = $this->db->order_by('id', "desc")->limit(1)->get('huruf_i')->row_array();
            if ($this->form_validation->run() == false) {
                $this->load->view('template/admin_header', $data);
                $this->load->view('template/admin_sidebar', $data);
                $this->load->view('template/admin_topbar', $data);
                $this->load->view('pasien/pasien_i', $data);
                $this->load->view('template/admin_footer');
            } else {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'nomor' => $this->input->post('nomor'),
                    'huruf' => 'A'
                ];
                $this->db->insert('huruf_i', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Tambahkan!!!
          </div>');
                redirect('pasien/editpasien/' . $id);
            }
        } else if ($id == '10') {
            $data['pasien'] = $this->db->get('huruf_j')->result_array();
            $data['nomor'] = $this->db->order_by('id', "desc")->limit(1)->get('huruf_j')->row_array();
            if ($this->form_validation->run() == false) {
                $this->load->view('template/admin_header', $data);
                $this->load->view('template/admin_sidebar', $data);
                $this->load->view('template/admin_topbar', $data);
                $this->load->view('pasien/pasien_j', $data);
                $this->load->view('template/admin_footer');
            } else {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'nomor' => $this->input->post('nomor'),
                    'huruf' => 'A'
                ];
                $this->db->insert('huruf_j', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Tambahkan!!!
          </div>');
                redirect('pasien/editpasien/' . $id);
            }
        } else if ($id == '11') {
            $data['pasien'] = $this->db->get('huruf_k')->result_array();
            $data['nomor'] = $this->db->order_by('id', "desc")->limit(1)->get('huruf_k')->row_array();
            if ($this->form_validation->run() == false) {
                $this->load->view('template/admin_header', $data);
                $this->load->view('template/admin_sidebar', $data);
                $this->load->view('template/admin_topbar', $data);
                $this->load->view('pasien/pasien_k', $data);
                $this->load->view('template/admin_footer');
            } else {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'nomor' => $this->input->post('nomor'),
                    'huruf' => 'A'
                ];
                $this->db->insert('huruf_k', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Tambahkan!!!
          </div>');
                redirect('pasien/editpasien/' . $id);
            }
        } else if ($id == '12') {
            $data['pasien'] = $this->db->get('huruf_l')->result_array();
            $data['nomor'] = $this->db->order_by('id', "desc")->limit(1)->get('huruf_l')->row_array();
            if ($this->form_validation->run() == false) {
                $this->load->view('template/admin_header', $data);
                $this->load->view('template/admin_sidebar', $data);
                $this->load->view('template/admin_topbar', $data);
                $this->load->view('pasien/pasien_l', $data);
                $this->load->view('template/admin_footer');
            } else {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'nomor' => $this->input->post('nomor'),
                    'huruf' => 'A'
                ];
                $this->db->insert('huruf_l', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Tambahkan!!!
          </div>');
                redirect('pasien/editpasien/' . $id);
            }
        } else if ($id == '13') {
            $data['pasien'] = $this->db->get('huruf_m')->result_array();
            $data['nomor'] = $this->db->order_by('id', "desc")->limit(1)->get('huruf_m')->row_array();
            if ($this->form_validation->run() == false) {
                $this->load->view('template/admin_header', $data);
                $this->load->view('template/admin_sidebar', $data);
                $this->load->view('template/admin_topbar', $data);
                $this->load->view('pasien/pasien_m', $data);
                $this->load->view('template/admin_footer');
            } else {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'nomor' => $this->input->post('nomor'),
                    'huruf' => 'A'
                ];
                $this->db->insert('huruf_m', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Tambahkan!!!
          </div>');
                redirect('pasien/editpasien/' . $id);
            }
        } else if ($id == '14') {
            $data['pasien'] = $this->db->get('huruf_n')->result_array();
            $data['nomor'] = $this->db->order_by('id', "desc")->limit(1)->get('huruf_n')->row_array();
            if ($this->form_validation->run() == false) {
                $this->load->view('template/admin_header', $data);
                $this->load->view('template/admin_sidebar', $data);
                $this->load->view('template/admin_topbar', $data);
                $this->load->view('pasien/pasien_n', $data);
                $this->load->view('template/admin_footer');
            } else {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'nomor' => $this->input->post('nomor'),
                    'huruf' => 'A'
                ];
                $this->db->insert('huruf_n', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Tambahkan!!!
          </div>');
                redirect('pasien/editpasien/' . $id);
            }
        } else if ($id == '15') {
            $data['pasien'] = $this->db->get('huruf_o')->result_array();
            $data['nomor'] = $this->db->order_by('id', "desc")->limit(1)->get('huruf_o')->row_array();
            if ($this->form_validation->run() == false) {
                $this->load->view('template/admin_header', $data);
                $this->load->view('template/admin_sidebar', $data);
                $this->load->view('template/admin_topbar', $data);
                $this->load->view('pasien/pasien_o', $data);
                $this->load->view('template/admin_footer');
            } else {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'nomor' => $this->input->post('nomor'),
                    'huruf' => 'A'
                ];
                $this->db->insert('huruf_o', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Tambahkan!!!
          </div>');
                redirect('pasien/editpasien/' . $id);
            }
        } else if ($id == '16') {
            $data['pasien'] = $this->db->get('huruf_p')->result_array();
            $data['nomor'] = $this->db->order_by('id', "desc")->limit(1)->get('huruf_p')->row_array();
            if ($this->form_validation->run() == false) {
                $this->load->view('template/admin_header', $data);
                $this->load->view('template/admin_sidebar', $data);
                $this->load->view('template/admin_topbar', $data);
                $this->load->view('pasien/pasien_p', $data);
                $this->load->view('template/admin_footer');
            } else {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'nomor' => $this->input->post('nomor'),
                    'huruf' => 'A'
                ];
                $this->db->insert('huruf_p', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Tambahkan!!!
          </div>');
                redirect('pasien/editpasien/' . $id);
            }
        } else if ($id == '17') {
            $data['pasien'] = $this->db->get('huruf_r')->result_array();
            $data['nomor'] = $this->db->order_by('id', "desc")->limit(1)->get('huruf_r')->row_array();
            if ($this->form_validation->run() == false) {
                $this->load->view('template/admin_header', $data);
                $this->load->view('template/admin_sidebar', $data);
                $this->load->view('template/admin_topbar', $data);
                $this->load->view('pasien/pasien_r', $data);
                $this->load->view('template/admin_footer');
            } else {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'nomor' => $this->input->post('nomor'),
                    'huruf' => 'A'
                ];
                $this->db->insert('huruf_r', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Tambahkan!!!
          </div>');
                redirect('pasien/editpasien/' . $id);
            }
        } else if ($id == '18') {
            $data['pasien'] = $this->db->get('huruf_s')->result_array();
            $data['nomor'] = $this->db->order_by('id', "desc")->limit(1)->get('huruf_s')->row_array();
            if ($this->form_validation->run() == false) {
                $this->load->view('template/admin_header', $data);
                $this->load->view('template/admin_sidebar', $data);
                $this->load->view('template/admin_topbar', $data);
                $this->load->view('pasien/pasien_s', $data);
                $this->load->view('template/admin_footer');
            } else {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'nomor' => $this->input->post('nomor'),
                    'huruf' => 'A'
                ];
                $this->db->insert('huruf_s', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Tambahkan!!!
          </div>');
                redirect('pasien/editpasien/' . $id);
            }
        } else if ($id == '19') {
            $data['pasien'] = $this->db->get('huruf_t')->result_array();
            $data['nomor'] = $this->db->order_by('id', "desc")->limit(1)->get('huruf_t')->row_array();
            if ($this->form_validation->run() == false) {
                $this->load->view('template/admin_header', $data);
                $this->load->view('template/admin_sidebar', $data);
                $this->load->view('template/admin_topbar', $data);
                $this->load->view('pasien/pasien_t', $data);
                $this->load->view('template/admin_footer');
            } else {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'nomor' => $this->input->post('nomor'),
                    'huruf' => 'A'
                ];
                $this->db->insert('huruf_t', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Tambahkan!!!
          </div>');
                redirect('pasien/editpasien/' . $id);
            }
        } else if ($id == '20') {
            $data['pasien'] = $this->db->get('huruf_u')->result_array();
            $data['nomor'] = $this->db->order_by('id', "desc")->limit(1)->get('huruf_u')->row_array();
            if ($this->form_validation->run() == false) {
                $this->load->view('template/admin_header', $data);
                $this->load->view('template/admin_sidebar', $data);
                $this->load->view('template/admin_topbar', $data);
                $this->load->view('pasien/pasien_u', $data);
                $this->load->view('template/admin_footer');
            } else {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'nomor' => $this->input->post('nomor'),
                    'huruf' => 'A'
                ];
                $this->db->insert('huruf_u', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Tambahkan!!!
          </div>');
                redirect('pasien/editpasien/' . $id);
            }
        } else if ($id == '21') {
            $data['pasien'] = $this->db->get('huruf_v')->result_array();
            $data['nomor'] = $this->db->order_by('id', "desc")->limit(1)->get('huruf_v')->row_array();
            if ($this->form_validation->run() == false) {
                $this->load->view('template/admin_header', $data);
                $this->load->view('template/admin_sidebar', $data);
                $this->load->view('template/admin_topbar', $data);
                $this->load->view('pasien/pasien_v', $data);
                $this->load->view('template/admin_footer');
            } else {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'nomor' => $this->input->post('nomor'),
                    'huruf' => 'A'
                ];
                $this->db->insert('huruf_v', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Tambahkan!!!
          </div>');
                redirect('pasien/editpasien/' . $id);
            }
        } else if ($id == '22') {
            $data['pasien'] = $this->db->get('huruf_w')->result_array();
            $data['nomor'] = $this->db->order_by('id', "desc")->limit(1)->get('huruf_w')->row_array();
            if ($this->form_validation->run() == false) {
                $this->load->view('template/admin_header', $data);
                $this->load->view('template/admin_sidebar', $data);
                $this->load->view('template/admin_topbar', $data);
                $this->load->view('pasien/pasien_w', $data);
                $this->load->view('template/admin_footer');
            } else {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'nomor' => $this->input->post('nomor'),
                    'huruf' => 'A'
                ];
                $this->db->insert('huruf_w', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Tambahkan!!!
          </div>');
                redirect('pasien/editpasien/' . $id);
            }
        } else if ($id == '23') {
            $data['pasien'] = $this->db->get('huruf_y')->result_array();
            $data['nomor'] = $this->db->order_by('id', "desc")->limit(1)->get('huruf_y')->row_array();
            if ($this->form_validation->run() == false) {
                $this->load->view('template/admin_header', $data);
                $this->load->view('template/admin_sidebar', $data);
                $this->load->view('template/admin_topbar', $data);
                $this->load->view('pasien/pasien_y', $data);
                $this->load->view('template/admin_footer');
            } else {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'nomor' => $this->input->post('nomor'),
                    'huruf' => 'A'
                ];
                $this->db->insert('huruf_y', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Tambahkan!!!
          </div>');
                redirect('pasien/editpasien/' . $id);
            }
        } else if ($id == '24') {
            $data['pasien'] = $this->db->get('huruf_z')->result_array();
            $data['nomor'] = $this->db->order_by('id', "desc")->limit(1)->get('huruf_z')->row_array();
            if ($this->form_validation->run() == false) {
                $this->load->view('template/admin_header', $data);
                $this->load->view('template/admin_sidebar', $data);
                $this->load->view('template/admin_topbar', $data);
                $this->load->view('pasien/pasien_z', $data);
                $this->load->view('template/admin_footer');
            } else {
                $data = [
                    'nama' => $this->input->post('nama'),
                    'nomor' => $this->input->post('nomor'),
                    'huruf' => 'A'
                ];
                $this->db->insert('huruf_z', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Tambahkan!!!
          </div>');
                redirect('pasien/editpasien/' . $id);
            }
        }
    }

    public function ubahpasien()
    {
        $nama = $this->input->post('nama');
        $nomor = $this->input->post('nomor');
        $huruf = $this->input->post('huruf');

        if ($huruf == 'A' or $huruf == 'a') {
            $id = 1;
            $this->db->set('nama', $nama);
            $this->db->set('nomor', $nomor);
            $this->db->set('huruf', $huruf);
            $this->db->where('nomor', $nomor);
            $this->db->update('data_pasien');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Ubah!!!
          </div>');
            redirect('pasien/editpasien/' . $id);
        } else if ($huruf == 'B' or $huruf == 'b') {
            $id = 2;
            $this->db->set('nama', $nama);
            $this->db->set('nomor', $nomor);
            $this->db->set('huruf', $huruf);
            $this->db->where('nomor', $nomor);
            $this->db->update('huruf_b');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Ubah!!!
          </div>');
            redirect('pasien/editpasien/' . $id);
        } else if ($huruf == 'C' or $huruf == 'c') {
            $id = 3;
            $this->db->set('nama', $nama);
            $this->db->set('nomor', $nomor);
            $this->db->set('huruf', $huruf);
            $this->db->where('nomor', $nomor);
            $this->db->update('huruf_c');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Ubah!!!
          </div>');
            redirect('pasien/editpasien/' . $id);
        } else if ($huruf == 'D' or $huruf == 'd') {
            $id = 4;
            $this->db->set('nama', $nama);
            $this->db->set('nomor', $nomor);
            $this->db->set('huruf', $huruf);
            $this->db->where('nomor', $nomor);
            $this->db->update('huruf_d');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Ubah!!!
          </div>');
            redirect('pasien/editpasien/' . $id);
        } else if ($huruf == 'E' or $huruf == 'e') {
            $id = 5;
            $this->db->set('nama', $nama);
            $this->db->set('nomor', $nomor);
            $this->db->set('huruf', $huruf);
            $this->db->where('nomor', $nomor);
            $this->db->update('huruf_e');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Ubah!!!
          </div>');
            redirect('pasien/editpasien/' . $id);
        } else if ($huruf == 'F' or $huruf == 'f') {
            $id = 6;
            $this->db->set('nama', $nama);
            $this->db->set('nomor', $nomor);
            $this->db->set('huruf', $huruf);
            $this->db->where('nomor', $nomor);
            $this->db->update('huruf_f');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Ubah!!!
          </div>');
            redirect('pasien/editpasien/' . $id);
        } else if ($huruf == 'G' or $huruf == 'g') {
            $id = 7;
            $this->db->set('nama', $nama);
            $this->db->set('nomor', $nomor);
            $this->db->set('huruf', $huruf);
            $this->db->where('nomor', $nomor);
            $this->db->update('huruf_g');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Ubah!!!
          </div>');
            redirect('pasien/editpasien/' . $id);
        } else if ($huruf == 'H' or $huruf == 'h') {
            $id = 8;
            $this->db->set('nama', $nama);
            $this->db->set('nomor', $nomor);
            $this->db->set('huruf', $huruf);
            $this->db->where('nomor', $nomor);
            $this->db->update('huruf_h');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Ubah!!!
          </div>');
            redirect('pasien/editpasien/' . $id);
        } else if ($huruf == 'I' or $huruf == 'i') {
            $id = 9;
            $this->db->set('nama', $nama);
            $this->db->set('nomor', $nomor);
            $this->db->set('huruf', $huruf);
            $this->db->where('nomor', $nomor);
            $this->db->update('huruf_i');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Ubah!!!
          </div>');
            redirect('pasien/editpasien/' . $id);
        } else if ($huruf == 'J' or $huruf == 'j') {
            $id = 10;
            $this->db->set('nama', $nama);
            $this->db->set('nomor', $nomor);
            $this->db->set('huruf', $huruf);
            $this->db->where('nomor', $nomor);
            $this->db->update('huruf_j');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Ubah!!!
          </div>');
            redirect('pasien/editpasien/' . $id);
        } else if ($huruf == 'K' or $huruf == 'k') {
            $id = 11;
            $this->db->set('nama', $nama);
            $this->db->set('nomor', $nomor);
            $this->db->set('huruf', $huruf);
            $this->db->where('nomor', $nomor);
            $this->db->update('huruf_k');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Ubah!!!
          </div>');
            redirect('pasien/editpasien/' . $id);
        } else if ($huruf == 'L' or $huruf == 'l') {
            $id = 12;
            $this->db->set('nama', $nama);
            $this->db->set('nomor', $nomor);
            $this->db->set('huruf', $huruf);
            $this->db->where('nomor', $nomor);
            $this->db->update('huruf_l');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Ubah!!!
          </div>');
            redirect('pasien/editpasien/' . $id);
        } else if ($huruf == 'M' or $huruf == 'm') {
            $id = 13;
            $this->db->set('nama', $nama);
            $this->db->set('nomor', $nomor);
            $this->db->set('huruf', $huruf);
            $this->db->where('nomor', $nomor);
            $this->db->update('huruf_m');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Ubah!!!
          </div>');
            redirect('pasien/editpasien/' . $id);
        } else if ($huruf == 'N' or $huruf == 'n') {
            $id = 14;
            $this->db->set('nama', $nama);
            $this->db->set('nomor', $nomor);
            $this->db->set('huruf', $huruf);
            $this->db->where('nomor', $nomor);
            $this->db->update('huruf_n');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Ubah!!!
          </div>');
            redirect('pasien/editpasien/' . $id);
        } else if ($huruf == 'O' or $huruf == 'o') {
            $id = 15;
            $this->db->set('nama', $nama);
            $this->db->set('nomor', $nomor);
            $this->db->set('huruf', $huruf);
            $this->db->where('nomor', $nomor);
            $this->db->update('huruf_o');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Ubah!!!
          </div>');
            redirect('pasien/editpasien/' . $id);
        } else if ($huruf == 'P' or $huruf == 'p') {
            $id = 16;
            $this->db->set('nama', $nama);
            $this->db->set('nomor', $nomor);
            $this->db->set('huruf', $huruf);
            $this->db->where('nomor', $nomor);
            $this->db->update('huruf_p');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Ubah!!!
          </div>');
            redirect('pasien/editpasien/' . $id);
        } else if ($huruf == 'R' or $huruf == 'r') {
            $id = 17;
            $this->db->set('nama', $nama);
            $this->db->set('nomor', $nomor);
            $this->db->set('huruf', $huruf);
            $this->db->where('nomor', $nomor);
            $this->db->update('huruf_r');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Ubah!!!
          </div>');
            redirect('pasien/editpasien/' . $id);
        } else if ($huruf == 'S' or $huruf == 's') {
            $id = 18;
            $this->db->set('nama', $nama);
            $this->db->set('nomor', $nomor);
            $this->db->set('huruf', $huruf);
            $this->db->where('nomor', $nomor);
            $this->db->update('huruf_s');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Ubah!!!
          </div>');
            redirect('pasien/editpasien/' . $id);
        } else if ($huruf == 'T' or $huruf == 't') {
            $id = 19;
            $this->db->set('nama', $nama);
            $this->db->set('nomor', $nomor);
            $this->db->set('huruf', $huruf);
            $this->db->where('nomor', $nomor);
            $this->db->update('huruf_t');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Ubah!!!
          </div>');
            redirect('pasien/editpasien/' . $id);
        } else if ($huruf == 'U' or $huruf == 'u') {
            $id = 20;
            $this->db->set('nama', $nama);
            $this->db->set('nomor', $nomor);
            $this->db->set('huruf', $huruf);
            $this->db->where('nomor', $nomor);
            $this->db->update('huruf_u');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Ubah!!!
          </div>');
            redirect('pasien/editpasien/' . $id);
        } else if ($huruf == 'V' or $huruf == 'v') {
            $id = 21;
            $this->db->set('nama', $nama);
            $this->db->set('nomor', $nomor);
            $this->db->set('huruf', $huruf);
            $this->db->where('nomor', $nomor);
            $this->db->update('huruf_v');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Ubah!!!
          </div>');
            redirect('pasien/editpasien/' . $id);
        } else if ($huruf == 'W' or $huruf == 'w') {
            $id = 22;
            $this->db->set('nama', $nama);
            $this->db->set('nomor', $nomor);
            $this->db->set('huruf', $huruf);
            $this->db->where('nomor', $nomor);
            $this->db->update('huruf_w');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Ubah!!!
          </div>');
            redirect('pasien/editpasien/' . $id);
        } else if ($huruf == 'Y' or $huruf == 'y') {
            $id = 23;
            $this->db->set('nama', $nama);
            $this->db->set('nomor', $nomor);
            $this->db->set('huruf', $huruf);
            $this->db->where('nomor', $nomor);
            $this->db->update('huruf_y');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Ubah!!!
          </div>');
            redirect('pasien/editpasien/' . $id);
        } else if ($huruf == 'Z' or $huruf == 'z') {
            $id = 24;
            $this->db->set('nama', $nama);
            $this->db->set('nomor', $nomor);
            $this->db->set('huruf', $huruf);
            $this->db->where('nomor', $nomor);
            $this->db->update('huruf_z');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Ubah!!!
          </div>');
            redirect('pasien/editpasien/' . $id);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Gagal Di Ubah!!!
          </div>');
            redirect('pasien/editpasien');
        }
    }

    public function hapuspasien_a($id)
    {
        $pasien = 1;
        $this->db->where('id', $id);
        $this->db->delete('data_pasien');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Hapus!!!
          </div>');
        redirect('pasien/editpasien/' . $pasien);
    }

    public function hapuspasien_b($id)
    {
        $pasien = 2;
        $this->db->where('id', $id);
        $this->db->delete('huruf_b');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Hapus!!!
          </div>');
        redirect('pasien/editpasien/' . $pasien);
    }

    public function hapuspasien_c($id)
    {
        $pasien = 3;
        $this->db->where('id', $id);
        $this->db->delete('huruf_c');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Hapus!!!
          </div>');
        redirect('pasien/editpasien/' . $pasien);
    }

    public function hapuspasien_d($id)
    {
        $pasien = 4;
        $this->db->where('id', $id);
        $this->db->delete('huruf_d');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Hapus!!!
          </div>');
        redirect('pasien/editpasien/' . $pasien);
    }

    public function hapuspasien_e($id)
    {
        $pasien = 5;
        $this->db->where('id', $id);
        $this->db->delete('huruf_e');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Hapus!!!
          </div>');
        redirect('pasien/editpasien/' . $pasien);
    }

    public function hapuspasien_f($id)
    {
        $pasien = 6;
        $this->db->where('id', $id);
        $this->db->delete('huruf_f');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Hapus!!!
          </div>');
        redirect('pasien/editpasien/' . $pasien);
    }

    public function hapuspasien_g($id)
    {
        $pasien = 7;
        $this->db->where('id', $id);
        $this->db->delete('huruf_g');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Hapus!!!
          </div>');
        redirect('pasien/editpasien/' . $pasien);
    }

    public function hapuspasien_h($id)
    {
        $pasien = 8;
        $this->db->where('id', $id);
        $this->db->delete('huruf_h');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Hapus!!!
          </div>');
        redirect('pasien/editpasien/' . $pasien);
    }

    public function hapuspasien_i($id)
    {
        $pasien = 9;
        $this->db->where('id', $id);
        $this->db->delete('huruf_i');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Hapus!!!
          </div>');
        redirect('pasien/editpasien/' . $pasien);
    }

    public function hapuspasien_j($id)
    {
        $pasien = 10;
        $this->db->where('id', $id);
        $this->db->delete('huruf_j');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Hapus!!!
          </div>');
        redirect('pasien/editpasien/' . $pasien);
    }

    public function hapuspasien_k($id)
    {
        $pasien = 11;
        $this->db->where('id', $id);
        $this->db->delete('huruf_k');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Hapus!!!
          </div>');
        redirect('pasien/editpasien/' . $pasien);
    }

    public function hapuspasien_l($id)
    {
        $pasien = 12;
        $this->db->where('id', $id);
        $this->db->delete('huruf_l');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Hapus!!!
          </div>');
        redirect('pasien/editpasien/' . $pasien);
    }

    public function hapuspasien_m($id)
    {
        $pasien = 13;
        $this->db->where('id', $id);
        $this->db->delete('huruf_m');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Hapus!!!
          </div>');
        redirect('pasien/editpasien/' . $pasien);
    }

    public function hapuspasien_n($id)
    {
        $pasien = 14;
        $this->db->where('id', $id);
        $this->db->delete('huruf_n');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Hapus!!!
          </div>');
        redirect('pasien/editpasien/' . $pasien);
    }

    public function hapuspasien_o($id)
    {
        $pasien = 15;
        $this->db->where('id', $id);
        $this->db->delete('huruf_o');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Hapus!!!
          </div>');
        redirect('pasien/editpasien/' . $pasien);
    }

    public function hapuspasien_p($id)
    {
        $pasien = 16;
        $this->db->where('id', $id);
        $this->db->delete('huruf_p');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Hapus!!!
          </div>');
        redirect('pasien/editpasien/' . $pasien);
    }

    public function hapuspasien_r($id)
    {
        $pasien = 17;
        $this->db->where('id', $id);
        $this->db->delete('huruf_r');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Hapus!!!
          </div>');
        redirect('pasien/editpasien/' . $pasien);
    }

    public function hapuspasien_s($id)
    {
        $pasien = 18;
        $this->db->where('id', $id);
        $this->db->delete('huruf_s');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Hapus!!!
          </div>');
        redirect('pasien/editpasien/' . $pasien);
    }

    public function hapuspasien_t($id)
    {
        $pasien = 19;
        $this->db->where('id', $id);
        $this->db->delete('huruf_t');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Hapus!!!
          </div>');
        redirect('pasien/editpasien/' . $pasien);
    }

    public function hapuspasien_u($id)
    {
        $pasien = 20;
        $this->db->where('id', $id);
        $this->db->delete('huruf_u');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Hapus!!!
          </div>');
        redirect('pasien/editpasien/' . $pasien);
    }

    public function hapuspasien_v($id)
    {
        $pasien = 21;
        $this->db->where('id', $id);
        $this->db->delete('huruf_v');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Hapus!!!
          </div>');
        redirect('pasien/editpasien/' . $pasien);
    }

    public function hapuspasien_w($id)
    {
        $pasien = 22;
        $this->db->where('id', $id);
        $this->db->delete('huruf_w');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Hapus!!!
          </div>');
        redirect('pasien/editpasien/' . $pasien);
    }

    public function hapuspasien_y($id)
    {
        $pasien = 23;
        $this->db->where('id', $id);
        $this->db->delete('huruf_y');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Hapus!!!
          </div>');
        redirect('pasien/editpasien/' . $pasien);
    }

    public function hapuspasien_z($id)
    {
        $pasien = 24;
        $this->db->where('id', $id);
        $this->db->delete('huruf_z');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Pasien Sudah Di Hapus!!!
          </div>');
        redirect('pasien/editpasien/' . $pasien);
    }
}
