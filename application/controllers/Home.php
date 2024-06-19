<?php

    class home extends CI_Controller{
        public function __construct() {
            parent::__construct();
            $this->load->helper('url');  
            $this->load->model('user_model'); // Memuat model Produk_model
            $this->load->library('session');
            
        }
     
        public function home_i(){
            $this->load->view('home_view');
        }

    }
?>