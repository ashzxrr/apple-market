<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->check_access();
    }

    private function check_access() {
        $allowed_pages = ['home', 'login', 'daftar']; // Halaman yang diizinkan tanpa login

        // Periksa apakah pengguna sudah login
        if (!$this->session->userdata('user_data')) {
            // Jika belum login, alihkan ke halaman login
            if (!in_array($this->uri->segment(1), $allowed_pages)) {
                $this->session->set_flashdata('error_akses', 'Silakan login untuk mengakses halaman ini.');
                $this->session->set_flashdata('message_type', 'error_akses');
            redirect('login');  
        
            }
        }
    }
}
