<?php

 class Produk_model extends CI_Model {
    public function __construct() {
        $this->load->database();
        
    }
    public function cariProduk($keyword, $kategori) {
        $this->db->group_start();
        $this->db->like('nama_produk', $keyword);
        $this->db->or_like('kategori', $keyword);
        $this->db->group_end();

        if (!empty($kategori)) {
            $this->db->where('kategori', $kategori);
        }

        $query = $this->db->get('tb_produk');
        return $query->result();
    }
    public function get_produk() {
        $query = $this->db->get('tb_produk');
        return $query->result();
    }
    public function get_all_produk() {
        $query = $this->db->get('tb_produk');
        return $query->row(); 
    }
    public function get_produk_all($id_produk = null) {
        if ($id_produk !== null) {
            $this->db->where('id_produk !=', $id_produk);
        }
    
        $query = $this->db->get('tb_produk');
        return $query->result_array();
    }
    public function insert_produk($data) {
        $this->db->insert('tb_produk', $data);
        return $this->db->insert_id();
    }
    public function get_produk_by_id($id_produk) {
        $query = $this->db->get_where('tb_produk', array('id_produk' => $id_produk));
        return $query->row();
    }

    public function update_produk($id_produk, $data) {
        $this->db->where('id_produk', $id_produk);

        // Cek apakah ada foto baru yang di-upload
        if (!empty($data['foto'])) {
            $this->db->update('tb_produk', $data);
        } else {
            // Jika tidak ada foto baru, hapus foto dari data yang akan diupdate
            unset($data['foto']);
            $this->db->update('tb_produk', $data);
        }
    }
    public function hapus_produk($id_produk) {
        $this->db->where('id_produk', $id_produk);
        $this->db->delete('tb_produk');
    }
    public function get_reviews_by_produk($id_produk) {
          // Menggabungkan data dari tb_review dan tb_pelanggan
          $this->db->select('tb_review.*, orders.nama_pembeli');
          $this->db->from('tb_review');
          $this->db->join('orders', 'tb_review.id_pesanan = orders.id_pesanan');
          $this->db->where('tb_review.id_produk', $id_produk);
          
          $query = $this->db->get();
          return $query->result_array();
      }
}


?>