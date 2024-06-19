<?php
// application/models/Log_model.php

class Log_model extends CI_Model {
    public function __construct(){
        $this->load->database();
    }

    public function get_admin($username, $password) {
        $query = $this->db->get_where('tb_admin', array('username' => $username, 'password' => $password));
        return $query->row();
    }
}
?>