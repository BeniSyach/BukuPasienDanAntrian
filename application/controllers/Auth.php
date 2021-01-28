<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper(array('Form', 'Cookie', 'String'));
    }

    public function index()
    {

        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {

            $data['title'] = 'Login';
            $this->load->view('template/header', $data);
            $this->load->view('auth/login');
            $this->load->view('template/footer');
        } else {
            // Validasi Sukses
            $this->_login();
        }
    }

    private function _login()
    {
        $email = htmlspecialchars($this->input->post('email', true));
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', [
            'email' => $email
        ])->row_array();

        if ($user) {
            //    user ada


            if ($user['is_actived'] == 1) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'rule_id' => $user['rule_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['rule_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Password Anda Salah !!!
          </div>');
                    redirect('Auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email anda Belum diaktivasi !!!
          </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email anda Belum Terdaftar !!!
          </div>');
            redirect('Auth');
        }
    }

    public function register()
    {
        if ($this->session->userdata('email')) {

            redirect('user');
        }

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email ini sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'matches' => 'Password Tidak Sama!',
            'min_length' => 'Password terlalu Pendek!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');


        if ($this->form_validation->run() == false) {

            $data['title'] = 'Daftar Akun';
            $this->load->view('template/header', $data);
            $this->load->view('auth/register');
            $this->load->view('template/footer');
        } else {

            $email = $this->input->post('email', true);
            $data = [
                'email' => htmlspecialchars($email),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'nama_lengkap' => htmlspecialchars($this->input->post('nama', true)),
                'rule_id' => 3,
                'is_actived' => 0,
                'date_created' => time(),
                'gambar' => 'default.jpg'
            ];
            // siapkan token

            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()

            ];

            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);

            $this->_sendemail($token, 'verify');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Selamat !!! Akun anda Sudah Terdaftar, Silahkan Cek Email Anda Untuk Aktifasi akun !
          </div>');
            redirect('Auth');
        }
    }

    private function _sendemail($token, $type)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'benisyach32@gmail.com',
            'smtp_pass' => 'celana2003',
            'smtp_port' => '465',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('benisyach32@gmail.com', 'Web Buku Pasien Praktek Bidan Rizky');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {

            $this->email->subject('Verifikasi Akun');
            $this->email->message('Click Di Sini Untuk Aktifasi Akun Anda : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Aktivasi</a> ');
        } else if ($type == 'lupa_password') {
            $this->email->subject('Reset Password Akun');
            $this->email->message('Click Di Sini Untuk Reset Akun Anda : <a href="' . base_url() . 'auth/lupa?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a> ');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {

        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {

                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {

                    $this->db->set('is_actived', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Email ' . $email . ' Aktifasi Akun Anda Berhasil !!! Silahkan Login Kembali
                  </div>');
                    redirect('Auth');
                } else {

                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Aktifasi Akun Anda Gagal !!! Masa Aktifasi Akun Anda Sudah Berlalu
              </div>');
                    redirect('Auth');
                }
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Aktifasi Akun Anda Gagal !!! Token Invalid
              </div>');
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Aktifasi Akun Anda Gagal !!! Email Anda Salah
      </div>');
            redirect('Auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('rule_id');


        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Anda Sudah Logout !!!
      </div>');
        redirect('Auth');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }

    public function lupa_password()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        if ($this->form_validation->run() == false) {

            $data['title'] = 'Lupa Password';
            $this->load->view('template/header', $data);
            $this->load->view('auth/lupa_password');
            $this->load->view('template/footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_actived' => 1])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendemail($token, 'lupa_password');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
              Link Reset Password Sudah dikirim Ke email, Tolong Cek Email Anda Untuk ubah Password !!!
              </div>');
                redirect('Auth/lupa_password');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Email Anda Belum Terdaftar atau Aktivasi !!!
      </div>');
                redirect('Auth/lupa_password');
            }
        }
    }

    public function lupa()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->ganti_password();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Reset Password Gagal !!! Token Anda Salah
      </div>');
                redirect('Auth/lupa_password');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Reset Password Gagal !!! Email Anda Salah
      </div>');
            redirect('Auth/lupa_password');
        }
    }

    public function ganti_password()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('password1', 'password', 'required|trim|min_length[6]|matches[password2]', [
            'matches' => 'Password Tidak Sama!',
            'min_length' => 'Password terlalu Pendek!'
        ]);
        $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {

            $data['title'] = 'Ganti Password';
            $this->load->view('template/header', $data);
            $this->load->view('auth/ganti_password');
            $this->load->view('template/footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->db->delete('user_token', ['email' => $email]);

            $this->session->unset_userdata('reset_email');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Ubah Password Anda Berhasil !!! 
      </div>');
            redirect('Auth');
        }
    }
}
