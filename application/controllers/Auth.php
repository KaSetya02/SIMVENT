<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Auth_model', 'auth');
        $this->load->model('Admin_model', 'admin');
    }

    private function _has_login()
    {
        if ($this->session->has_userdata('login_session')) {
            redirect('dashboard');
        }
    }

    public function index()
    {
        $this->_has_login();

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login User';
            $this->template->load('templates/auth', 'auth/login', $data);
        } else {
            $input = $this->input->post(null, true);

            $cek_username = $this->auth->cek_username($input['username']);
            if ($cek_username > 0) {
                $password = $this->auth->get_password($input['username']);
                if (password_verify($input['password'], $password)) {
                    $user_db = $this->auth->userdata($input['username']);
                    if ($user_db['is_active'] != 1) {
                        set_pesan('Akun anda belum aktif/dinonaktifkan. Silahkan Hubungi Admin Untuk Aktivasi Akun.', false);
                        redirect('auth');
                    } else { 
                        $userdata = [
                            'user'  => $user_db['id_user'],
                            'role'  => $user_db['role'],
                            'timestamp' => time()
                        ];
                        $this->session->set_userdata('login_session', $userdata);
                        redirect('dashboard');
                    }
                } else {
                    set_pesan('password salah', false);
                    redirect('auth');
                }
            } else {
                set_pesan('username belum terdaftar', false);
                redirect('auth');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('login_session');

        set_pesan('anda telah berhasil logout');
        redirect('login');
    }

    public function register()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]|alpha_numeric');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]|trim');
        $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'matches[password]|trim|required');
        $this->form_validation->set_rules('no_induk', 'NIM/NIP', 'required|trim|is_unique[user.no_induk]');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required|trim|numeric');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Register';
            $this->template->load('templates/auth', 'auth/register', $data);
        } else {
            $input = $this->input->post(null, true);
            unset($input['password2']);
            $input['password']      = password_hash($input['password'], PASSWORD_DEFAULT);
            $input['role']          = 'mahasiswa';
            $input['foto']          = 'user.png';
            $input['is_active']     = 1;
            $input['created_at']    = time();

            $query = $this->admin->insert('user', $input);
            if ($query) {
                set_pesan('Daftar berhasil.');
                redirect('auth');
            } else {
                set_pesan('Gagal menyimpan ke database', false);
                redirect('register');
            }
        }
    }

     private function _sendEmail($token, $type)
    {
        $config = [

            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'amsetya02@gmail.com',
            'smtp_pass' => 'xaqigfbnmigrkoqp',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->from('amsetya02@gmail.com', 'Politeknik TEDC Bandung');
        $this->email->to($this->input->post('email'));
        if($type == 'forgotPassword') {
            $this->email->subject('Reset Password');
            $this->email->message('Click This Link To Reset your password : <a href="'.base_url(). 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        }
        
        if($this->email->send()) {
            return true;

        }else{
            echo $this->email->print_debugger();
            die;
        }

    }

    public function forgotPassword(){
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        if ($this->form_validation->run() == false) {
        $data['title'] = 'Forgot Password';
        $this->template->load('templates/auth', 'auth/forgot-password', $data);
        }else{
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();
            if($user){
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];
                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgotPassword');
                set_pesan('Please check your email to reset your password');
                redirect('auth');
            }else{
                set_pesan('Email is not register or activated', false);
                redirect('auth/forgotpassword');
            }
        }
    }
    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user)
        {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token){
               $this->session->set_userdata('reset_email', $email);
               $this->changePassword();
            }else{
                set_pesan('Reset Password Failed! Wrong Token.', false);
                redirect('auth');
            }
        }else{
             set_pesan('Reset Password Failed! Wrong Email.', false);
             redirect('auth');
        }
    }
    public function changePassword(){

       if(!$this->session->userdata('reset_email')){
            redirect('auth');
       }

       $this->form_validation->set_rules('password1', 'Password ', 'required|trim|min_length[3]|matches[password2]');
       $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|min_length[3]|matches[password1]');
        if ($this->form_validation->run() == false) {
        $data['title'] = 'Change Password';
        $this->template->load('templates/auth', 'auth/change-password', $data);
        }else{
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');
            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');

             set_pesan('Password berhasil Diubah. Selanjutnya silahkan untuk login ke akun anda.');
             redirect('auth');
        }

    }
}
