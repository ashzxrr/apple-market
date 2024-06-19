<?php
// application/controllers/Login.php

class Login extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Log_model');
        $this->load->model('user_model');

        $this->load->library('session');
        $this->load->helper('url');  
    }

    public function index() {
        $data['error'] = $this->session->flashdata('error');
        $this->load->view('log_baru', $data);
    }

    public function process() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
    
        $admin = $this->Log_model->get_admin($username, $password);
        $user = $this->user_model->get_user($username, $password);
    
        if ($admin) {
            // Simpan data admin dalam sesi
            $this->session->set_userdata('user_data', $admin);
            redirect('admin');
        } elseif ($user) {
            // Simpan data pengg una dalam sesi
            $this->session->set_userdata('user_data', $user);

        // Ambil pesanan terkait dan simpan dalam sesi
        $user_orders = $this->user_model->get_user_orders($user->id_pelanggan);
        echo $user->id_pelanggan;


        $this->session->set_userdata('user_orders', $user_orders);
  

// Jika login berhasil
        $this->session->set_flashdata('message', 'Login successful!');
        redirect('user');  
        } else {
            $this->session->set_flashdata('error', 'Invalid username or password.');
            $this->session->set_flashdata('message_type', 'error');
            redirect('login');
        }
    }
    
    public function daftar_baru(){
        $this->load->model('user_model');
        $data = array(
        'nama' => $this->input->post('nama'),
        'email' => $this->input->post('email'),
        'username' => $this->input->post('username'),
        'password' =>$this->input->post('password'),
        'alamat' => $this->input->post('alamat'),
        'telepon' => $this->input->post('telepon'),
        'level' => 'user',
        );  // Panggil fungsi model untuk menyimpan data ke dalam tabel 'tb_pelanggan'
          $this->user_model->insert_pelanggan($data);

          // Setelah penyimpanan berhasil, Anda dapat mengarahkan pengguna ke halaman lain atau memberikan pesan sukses.
          $this->session->set_flashdata('success', 'Sign up successful!');
          $this->session->set_flashdata('message_type', 'success');
          $this->load->view('log_baru');
    }
    public function logout() {
        $this->session->unset_userdata('user_data');
        $this->session->set_flashdata('message_info', 'Logout Berhasil');
        $this->session->set_flashdata('message_type', 'success');
        redirect('login');
    }
    
    

   
    
}

?>