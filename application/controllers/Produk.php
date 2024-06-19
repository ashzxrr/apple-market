<?php 
class Produk extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Produk_model'); // Sesuaikan dengan nama model Anda
        $this->load->library('session');
        $this->load->helper('url');

    }

    public function cari() {
        $keyword = $this->input->get('keyword');
        $kategori = $this->input->get('kategori');

        $data['produk'] = $this->Produk_model->cariProduk($keyword, $kategori);

        $this->load->view('header_univ');

        $this->load->view('hasil_pencarian', $data);
        $this->load->view('footer');

    }

    public function detail_produk($id_produk){
        $data['produk'] = $this->Produk_model->get_produk_by_id($id_produk);

        if (!$data['produk']) {
            // Handle jika produk tidak ditemukan
            show_404();
        }
        $data['rekomendasi'] = $this->Produk_model->get_produk_all($id_produk);
        $data['reviews'] = $this->Produk_model->get_reviews_by_produk($id_produk);
        $data['user_data'] = $this->session->userdata('user_data');
            $user_data = $this->session->userdata('user_data');
            
   

        // Get notifications from the model
        $this->load->model('user_model');
            $data['notifications'] = $this->user_model->get_user_notifications($user_data->id_pelanggan);


        $this->load->view("header_user", $data);
        $this->load->view('detail_produk', $data);
        $this->load->view('footer');
    }
    public function detail_produk_all($id_produk){
        $data['produk'] = $this->Produk_model->get_produk_by_id($id_produk);

        if (!$data['produk']) {
            // Handle jika produk tidak ditemukan
            show_404();
        }
        $data['rekomendasi'] = $this->Produk_model->get_produk_all($id_produk);
        $data['reviews'] = $this->Produk_model->get_reviews_by_produk($id_produk);


        $this->load->view("header_univ");
        $this->load->view('detail_produk', $data);
        $this->load->view('footer');
    }
    public function home() {
  
        $this->load->view('home_view');
    }
}
?>