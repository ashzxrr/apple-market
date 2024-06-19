<?php
// application/models/Admin_model.php

class Admin_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    // Pada Admin_model.php
public function get_city_name_by_id($id_kota) {
    $this->db->select('nama_kota');
    $this->db->where('id_kota', $id_kota);
    $query = $this->db->get('tb_kota');
    $result = $query->row();
    return $result->nama_kota;
}  
 public function get_fee_by_id($id_kota) {
    $this->db->select('ongkos_kirim');
    $this->db->where('id_kota', $id_kota); 
    $query = $this->db->get('tb_kota');
    $result = $query->row();
    return $result->ongkos_kirim;
}
    public function get_all_orders() {
        $this->db->select('orders.*, tb_kota.ongkos_kirim');
    $this->db->from('orders');
    $this->db->join('tb_kota', 'orders.id_kota = tb_kota.id_kota');
    $query = $this->db->get();
    return $query->result();
    } 
    public function get_all() {
        $this->db->select('orders.id_pesanan, orders.order_at, orders_detail.id_pelanggan, orders.nama_pembeli, orders.status_order, orders.tgl_order, orders.total, tb_pengiriman.ongkir, tb_pengiriman.resi, pembayaran.foto_bukti' );
        $this->db->from('orders');
        $this->db->join('tb_pengiriman', 'orders.id_pesanan = tb_pengiriman.id_pesanan');
        $this->db->join('pembayaran', 'orders.id_pesanan = pembayaran.id_pesanan'); 
        $this->db->join('orders_detail', 'orders.id_pesanan = orders_detail.id_pesanan'); 
        $this->db->order_by('orders.order_at', 'DESC'); 
        return $this->db->get()->result();
    }
    public function get_orders($id_pesanan) {
        $this->db->select('orders.id_pesanan, orders_detail.id_pelanggan, orders_detail.jumlah, orders.nama_pembeli, orders.status_order, orders.tgl_order, orders.total, tb_pengiriman.ongkir, pembayaran.foto_bukti, tb_produk.nama_produk, tb_produk.harga, tb_produk.foto, tb_pengiriman.resi, tb_pengiriman.ekspedisi, tb_pengiriman.estimasi, tb_pengiriman.layanan');
        $this->db->from('orders');
        $this->db->join('tb_pengiriman', 'orders.id_pesanan = tb_pengiriman.id_pesanan');
        $this->db->join('pembayaran', 'orders.id_pesanan = pembayaran.id_pesanan'); 
        $this->db->join('orders_detail', 'orders.id_pesanan = orders_detail.id_pesanan'); 
        $this->db->join('tb_produk', 'orders_detail.id_produk = tb_produk.id_produk'); // Join ke tb_produk
        $this->db->where('orders.id_pesanan', $id_pesanan);
    
        return $this->db->get()->result();
    }
    
    public function get_all_pembayaran(){
        $this->db->select('orders.id_pesanan, orders_detail.id_pelanggan, orders.nama_pembeli,  pembayaran.foto_bukti, pembayaran.status, pembayaran.metode, pembayaran.total_pem, pembayaran.tgl_pesan, pembayaran.foto_bukti' );
        $this->db->from('orders');
        $this->db->join('pembayaran', 'orders.id_pesanan = pembayaran.id_pesanan'); 
        $this->db->join('orders_detail', 'orders.id_pesanan = orders_detail.id_pesanan'); 
        $this->db->order_by('orders.tgl_order', 'ASCD'); 
    
    
        return $this->db->get()->result();
    }

    public function update_status($id_pesanan, $new_status) {
        $this->db->where('id_pesanan', $id_pesanan);
        $this->db->update('orders', array('status_order' => $new_status));
    }

    public function get_user_orders_details_nihhh($id_pesanan) {
        $this->db->select('orders.id_pesanan, orders.tgl_order,orders.nama_pembeli, orders.telepon, orders.alamat, orders.status_order, orders_detail.id_produk, orders_detail.id_pesanan, orders_detail.jumlah, tb_produk.nama_produk, tb_produk.foto, pembayaran.total_pem, pembayaran.metode, tb_pengiriman.ongkir');
        $this->db->from('orders');
        $this->db->join('orders_detail', 'orders.id_pesanan = orders_detail.id_pesanan');
        $this->db->join('tb_produk', 'orders_detail.id_produk = tb_produk.id_produk');
        $this->db->join('tb_pengiriman', 'orders.id_pesanan = tb_pengiriman.id_pesanan');
        $this->db->join('pembayaran', 'orders.id_pesanan = pembayaran.id_pesanan', 'left'); 
        $this->db->where('orders.id_pesanan', $id_pesanan);
        $this->db->order_by('orders.tgl_order', 'DESC'); 
    
    
        return $this->db->get()->result_array();
    }
    public function get_order_details($id_pesanan) {
        // Query untuk mengambil detail order berdasarkan id_orders
        $this->db->select('orders_detail.*, tb_produk.nama_produk');
        $this->db->from('orders_detail');
        $this->db->join('tb_produk', 'orders_detail.id_produk = tb_produk.id_produk');
        $this->db->where('orders_detail.id_pesanan', $id_pesanan);
        return $this->db->get()->result();
    }
    public function get_payment_by_order_id($id_orders) {
        $this->db->where('id_orders', $id_orders);
        return $this->db->get('tb_pembayaran')->row();
    }
    public function update_order_status($id_pesanan, $status) {
        $this->db->where('id_pesanan', $id_pesanan);
        $this->db->update('orders', array('status_order' => $status));
    }
    
    public function update_payment_status($id_pesanan, $status) {
        $this->db->where('id_pesanan', $id_pesanan);
        $this->db->update('pembayaran', array('status' => $status));
    }
    public function update_resi($id_pesanan, $resi) {
        $this->db->where('id_pesanan', $id_pesanan);
        $this->db->update('tb_pengiriman', array('resi' => $resi));
    }
    




public function get_pembayaran_by_id($id_pesanan) {
    $this->db->select('foto_bukti');
    $this->db->from('pembayaran');
    $this->db->where('id_pesanan', $id_pesanan);
    return $this->db->get()->row();
}

    function input_data($data,$table){
		$this->db->insert($table,$data);
	}
    function hapus_data($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}
    

    function edit_data($where,$table){		
        return $this->db->get_where($table,$where);
    }
    function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

    function get_pelanggan(){
        $query = $this->db->get("tb_pelanggan");
        return $query->result();
    }

    function get_notification(){
        $query = $this->db->get('tb_notif_admin');
        return $query->result();
    }

    

    public function getNewOrders($lastCheckedTime) {
        $this->db->where('tgl_order >', $lastCheckedTime);
        $query = $this->db->get('orders');
        return $query->result();
    }
}
?> 