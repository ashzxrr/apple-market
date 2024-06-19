<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');  
        $this->load->model('user_model'); // Memuat model Produk_model

        
    }
    public function index(){
        $this->load->view('daftar_v');
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
        'level' => $this->input->post('level'),
        );  // Panggil fungsi model untuk menyimpan data ke dalam tabel 'tb_pelanggan'
          $this->user_model->insert_pelanggan($data);

          // Setelah penyimpanan berhasil, Anda dapat mengarahkan pengguna ke halaman lain atau memberikan pesan sukses.
          $this->session->set_flashdata('success', 'Sign up successful!');
          $this->session->set_flashdata('message_type', 'success');
          $this->load->view('log_baru');
    }
    public function daftarklik() {
        $this->load->model('user_model');

        // Ambil data dari formulir
        $data = array(
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' =>$this->input->post('password'), // Hashing password
            'alamat' => $this->input->post('alamat'),
            'telepon' => $this->input->post('telepon'),
            'level' => $this->input->post('level'),

            // Logika untuk upload foto dan mendapatkan nama file
            
        );
 // Konfigurasi Upload 
        $config['upload_path']   = './upload/'; // Folder tempat menyimpan foto (pastikan folder ini ada dan dapat ditulis oleh server)
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size']      = 2048; // Ukuran maksimal dalam kilobita
        $config['encrypt_name']  = TRUE; // Mengenkripsi nama file

        $this->load->library('upload', $config);

        // Lakukan upload
        if ($this->upload->do_upload('foto')) {
            $upload_data = $this->upload->data();
            $data['foto'] = $upload_data['file_name']; // Mendapatkan nama file setelah upload
        } else {
            // Jika upload gagal, Anda dapat menangani kesalahan sesuai kebutuhan aplikasi Anda
            $error = array('error' => $this->upload->display_errors());
            print_r($error); // Anda mungkin ingin menangani ini lebih elegan
            return;
        }
        // Panggil fungsi model untuk menyimpan data ke dalam tabel 'tb_pelanggan'
        $this->user_model->insert_pelanggan($data);

        // Setelah penyimpanan berhasil, Anda dapat mengarahkan pengguna ke halaman lain atau memberikan pesan sukses.
        $this->load->view('daftar_sukses');
    }
}
