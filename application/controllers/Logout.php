<?php

class logout extends CI_Controller {
   

    public function index() {

        $this->load->helper('url');
        $this->load->library('session');
        $this->session->sess_destroy();
        redirect('login');

    }
}?>