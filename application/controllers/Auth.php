<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends MY_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Log_model');
        $this->load->model('user_model');

        $this->load->library('session');
        $this->load->helper('url');  
    }

    public function index() {
        $data['error'] = $this->session->flashdata('error');
        $this->load->view('log_temp', $data);
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
            // Simpan data pengguna dalam sesi
            $this->session->set_userdata('user_data', $user);

        // Ambil pesanan terkait dan simpan dalam sesi
        $user_orders = $this->user_model->get_user_orders($user->id_pelanggan);
        $this->session->set_userdata('user_orders', $user_orders);

        redirect('user'); 
        } else {
            $this->session->set_flashdata('message_hapus', 'Username dan Password salah!!');
            $this->session->set_flashdata('message_type', 'error');
            redirect('auth');
        }
    }

    public function logout() {
        $this->session->unset_userdata('user_data');
        redirect('auth');
    }
}
