<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    
    public function insert_pelanggan($data) {
        // Simpan data pelanggan ke tabel 'tb_pelanggan'
        $this->db->insert('tb_pelanggan', $data);
    }
    public function get_user($username, $password) {
        $query = $this->db->get_where('tb_pelanggan', array('username' => $username, 'password' => $password));
        return $query->row();  // Mengembalikan seluruh baris
    }
    public function get_user_orders($id_pelanggan) {
        $user_orders = $this->db->get_where('tb_orders_temp', array('id_pelanggan' => $id_pelanggan))->result();
    
        foreach ($user_orders as &$order) { 
            // Ambil detail produk dari tb_produk
            $product_details = $this->get_product_details($order->id_produk);
    
            // Gabungkan data detail produk ke dalam objek order
            $order->nama_produk = $product_details->nama_produk;
            $order->harga = $product_details->harga;
            // Tambahan atribut lainnya sesuai kebutuhan
        }
    
        return $user_orders;
    }
    // Di dalam model (user_model atau model terkait)
public function get_item_quantity($id_produk) {
    // Gantilah nama tabel dan kolom sesuai dengan struktur database Anda
    $this->db->select('jumlah');
    $this->db->from('tb_orders_detail');
    $this->db->where('id_produk', $id_produk);

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        $result = $query->row();
        return $result->jumlah;
    }

    return 0; // Atau nilai default sesuai kebutuhan
}

    public function get_product_details($id_produk) {
        $query = $this->db->get_where('tb_produk', array('id_produk' => $id_produk));
        return $query->row();
    }

    
// In User_model
public function get_selected_products($id_pelanggan, $selected_products) {
    $this->db->select('tb_orders_temp.id_order_temp, tb_orders_temp.id_produk, tb_orders_temp.warna, tb_orders_temp.id_pelanggan, tb_orders_temp.jumlah, tb_orders_temp.tgl_order_temp, tb_produk.id_produk, tb_produk.nama_produk, tb_produk.harga, tb_produk.foto');
    $this->db->from('tb_orders_temp');
    $this->db->join('tb_produk', 'tb_orders_temp.id_produk = tb_produk.id_produk');
    $this->db->where('tb_orders_temp.id_pelanggan', $id_pelanggan);
    $this->db->where_in('tb_orders_temp.id_produk', $selected_products);
    return $this->db->get()->result_array();
} 

    //tampilkan produk

    public function get_all_produk() {
        $this->db->order_by('harga', 'ASC');
        return $this->db->get('tb_produk')->result();
    }

    public function get_stok_produk($id_produk){
        $this->db->select('stok');
        $this->db->from('tb_produk');
        $this->db->where('id_produk', $id_produk);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->stok;
        } else {
            return 0; // Atau nilai default sesuai kebutuhan Anda
        }
    }

    public function is_produk_in_keranjang($id_pelanggan, $id_produk) {
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->where('id_produk', $id_produk);
        $query = $this->db->get('tb_orders_temp');

        return $query->num_rows() > 0;
    }
    public function get_quantity_in_keranjang($id_pelanggan, $id_produk) {
        $this->db->select('jumlah');
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->where('id_produk', $id_produk);
        $query = $this->db->get('tb_orders_temp');

        $result = $query->row();

        return $result ? $result->jumlah : 0;
    }
    public function kurangi_jumlah_produk($id_pelanggan, $id_produk) {
        // Tambahkan logika untuk mengurangi jumlah produk di tabel keranjang
        // dan hapus jika jumlah mencapai 0
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->where('id_produk', $id_produk);

        // Ambil jumlah sekarang
        $jumlah_sekarang = $this->db->get('tb_orders_temp')->row()->jumlah;

        // Kurangi satu
        $jumlah_baru = max($jumlah_sekarang - 1, 0);

        if ($jumlah_baru > 0) {
            // Perbarui jumlah di tabel
            $this->db->where('id_pelanggan', $id_pelanggan);
            $this->db->where('id_produk', $id_produk);
            $this->db->update('tb_orders_temp', ['jumlah' => $jumlah_baru]);
        } else {
            // Hapus item jika jumlah mencapai 0
            $this->db->where('id_pelanggan', $id_pelanggan);
            $this->db->where('id_produk', $id_produk);
            $this->db->delete('tb_orders_temp');
        }
    }

    public function update_jumlah_produk_in_keranjang($id_pelanggan, $id_produk, $jumlah) {
        $data = array('jumlah' => $jumlah);
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->where('id_produk', $id_produk);
        $this->db->update('tb_orders_temp', $data);
    }
    public function get_kota_list() {
        $query = $this->db->get('tb_kota');
        return $query->result();
    }

    public function remove_item_from_cart($id_pelanggan, $id_produk_array) {
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->where_in('id_produk', $id_produk_array);
        $this->db->delete('tb_orders_temp');
    }
    public function get_keranjang_by_id_pelanggan($id_pelanggan) {
        // Misalnya, tabel keranjang memiliki kolom-kolom id_produk, jumlah, dan lain-lain
        $this->db->select('id_produk, jumlah, warna');
        $this->db->where('id_pelanggan', $id_pelanggan);
        $query = $this->db->get('tb_orders_temp');

        // Mengembalikan hasil query sebagai array objek
        return $query->result();
    }
    public function hapus_keranjang_by_id($id_produk) {
        // Hapus item dari keranjang (tb_orders_temp) berdasarkan id_pelanggan dan id_produk
        $this->db->where('id_produk', $id_produk);
        $this->db->delete('tb_orders_temp');
    }

    public function hapus_keranjang($id_pelanggan){
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->delete('tb_orders_temp');

    }


    public function get_last_order_id($id_pelanggan) {
        $this->db->select('id_orders');
        $this->db->from('tb_orders');
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->order_by('id_orders', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row()->id_orders;
    }
    public function get_order_by_id($id_pesanan) {
        return $this->db->get_where('tb_orders', array('id_orders' => $id_pesanan))->row();
    }
    public function get_order_by_id_nih($id_pesanan) {
        return $this->db->get_where('orders', array('id_pesanan' => $id_pesanan))->row();
    }

    public function get_pengiriman_by_id($id_pesanan){
        return $this->db->get_where('tb_pengiriman', array('id_pesanan' => $id_pesanan))->row();
    }
    public function get_order_details($id_pesanan) {
        $this->db->select('od.id_produk, p.nama_produk, od.jumlah, p.harga, p.foto');
        $this->db->from('tb_orders_detail od');
        $this->db->join('tb_produk p', 'od.id_produk = p.id_produk');
        $this->db->where('od.id_orders_det', $id_pesanan); // Sesuaikan dengan kolom yang benar
        $query = $this->db->get();
        return $query->result();
    }
    public function get_order_details_nih($id_pesanan) {
        $this->db->select('od.id_produk, p.nama_produk, od.jumlah, od.warna, p.harga, p.foto');
        $this->db->select('od.id_pelanggan, pe.id_pelanggan');
        $this->db->select('od.id_pelanggan, pe.id_pelanggan');
        $this->db->from('orders_detail od');
        $this->db->join('tb_produk p', 'od.id_produk = p.id_produk');
        $this->db->join('tb_pelanggan pe', 'od.id_pelanggan = pe.id_pelanggan');
        $this->db->where('od.id_pesanan', $id_pesanan); // Sesuaikan dengan kolom yang benar
        $query = $this->db->get();
        return $query->result();
    }
    // Di dalam model user_model.php

public function get_user_orders_details_nihhh($id_pelanggan) {
    $this->db->select('orders.id_pesanan, orders.tgl_order,orders.nama_pembeli, orders.telepon, orders.alamat, orders.status_order, orders_detail.id_produk, orders_detail.id_pesanan, orders_detail.jumlah, tb_produk.nama_produk, tb_produk.foto, pembayaran.total_pem, pembayaran.metode, tb_pengiriman.ongkir');
    $this->db->from('orders');
    $this->db->join('orders_detail', 'orders.id_pesanan = orders_detail.id_pesanan');
    $this->db->join('tb_produk', 'orders_detail.id_produk = tb_produk.id_produk');
    $this->db->join('tb_pengiriman', 'orders.id_pesanan = tb_pengiriman.id_pesanan');
    $this->db->join('pembayaran', 'orders.id_pesanan = pembayaran.id_pesanan', 'left'); 
    $this->db->where('orders_detail.id_pelanggan', $id_pelanggan);
    $this->db->order_by('orders.tgl_order', 'ASCD'); 


    return $this->db->get()->result_array();
}

    public function get_produk_by_id($id_produk) {
        $query = $this->db->get_where('tb_produk', array('id_produk' => $id_produk));
        return $query->row();
    }

    public function kurangi_stok($id_produk, $jumlah) {
        $this->db->set('stok', 'stok - ' . $jumlah, FALSE);
        $this->db->where('id_produk', $id_produk);
        $this->db->update('tb_produk');
    }
    
    public function save_payment($data) {
        $this->db->insert('tb_pembayaran', $data);
        return $this->db->insert_id(); // Mengembalikan ID pembayaran yang baru saja dimasukkan
    }
    public function save_payment_nih($data) {
        $this->db->insert('pembayaran', $data);
        return $this->db->insert_id(); // Mengembalikan ID pembayaran yang baru saja dimasukkan
    }
    public function get_ongkir_by_kota($kota_id) {
        $this->db->where('id_kota', $kota_id);
        return $this->db->get('tb_kota')->row();
    }
    
    public function get_nama_kota_by_id($kota_id) {
        $this->db->where('id_kota', $kota_id);
        return $this->db->get('tb_kota')->row();
    }
    public function get_ongkos_kirim($id_kota) {
        $this->db->where('id_kota', $id_kota);
        return $this->db->get('tb_kota')->row();
    } 
    public function get_payment_by_order_id($id_orders) {
        $this->db->where('id_orders', $id_orders);
        return $this->db->get('tb_pembayaran')->row();
    }    
    // Dalam model atau direktori query
public function get_orders_by_user($id_pelanggan) {
    $this->db->where('id_pelanggan', $id_pelanggan);
    $query = $this->db->get('tb_orders');
    return $query->result();
}

public function get_pesanan_by_pelanggan($id_pelanggan) {
    $this->db->where('id_pelanggan', $id_pelanggan);
    return $this->db->get('orders')->result_array();
}


public function insert_order($data) {
    $this->db->insert('orders', $data);
    return $this->db->insert_id(); // Mengembalikan ID pesanan yang baru saja dibuat
}

public function insert_order_detail($data) {
    $this->db->insert('orders_detail', $data);
}

public function update_order_total($id_pesanan, $total_pembayaran) {
    $this->db->where('id_pesanan', $id_pesanan);
    $this->db->set('total', 'total + ' . $total_pembayaran, FALSE);
    $this->db->update('orders');
} 
public function insert_pengiriman($data_pengiriman)
{
    // Masukkan data pengiriman ke dalam tabel tb_pengiriman
    $this->db->insert('tb_pengiriman', $data_pengiriman);

    // Kembalikan ID pengiriman yang baru saja dibuat
    return $this->db->insert_id();
}
public function get_orders($id_pesanan) {
    $this->db->select('orders.id_pesanan, orders_detail.id_pelanggan, orders_detail.jumlah, orders_detail.warna, orders.nama_pembeli, orders.status_order, orders.tgl_order, orders.total, tb_pengiriman.ongkir, pembayaran.foto_bukti, tb_produk.nama_produk, tb_produk.harga, tb_produk.foto, tb_pengiriman.resi, tb_pengiriman.ekspedisi, tb_pengiriman.estimasi, tb_pengiriman.layanan');
    $this->db->from('orders');
    $this->db->join('tb_pengiriman', 'orders.id_pesanan = tb_pengiriman.id_pesanan');
    $this->db->join('pembayaran', 'orders.id_pesanan = pembayaran.id_pesanan'); 
    $this->db->join('orders_detail', 'orders.id_pesanan = orders_detail.id_pesanan'); 
    $this->db->join('tb_produk', 'orders_detail.id_produk = tb_produk.id_produk'); // Join ke tb_produk
    $this->db->where('orders.id_pesanan', $id_pesanan);

    return $this->db->get()->result();
}
public function update_status($id_pesanan, $new_status) {
    $this->db->where('id_pesanan', $id_pesanan);
    $this->db->update('orders', array('status_order' => $new_status));
}
public function saveReview($data) {
    return $this->db->insert('tb_review', $data);
}
private function get_produk_with_rating($produk)
    {
        foreach ($produk as $index => $item) {
            // Query untuk menghitung rata-rata rating
            $this->db->select('AVG(rating) as avg_rating');
            $this->db->from('tb_review');
            $this->db->where('id_produk', $item->id_produk);
            $result = $this->db->get()->row();

            // Tambahkan informasi rating ke dalam data produk
            $produk[$index]->avg_rating = ($result->avg_rating !== null) ? round($result->avg_rating) : null;
        }

        return $produk;
    }
public function get_user_data($id_pelanggan) {
    $this->db->where('id_pelanggan', $id_pelanggan);
    $query = $this->db->get('tb_pelanggan');

    // Mengembalikan data pelanggan sebagai array
    return $query->row_array();
}
public function checkCurrentPassword($id_pelanggan, $current_password) {
    $this->db->select('password');
    $this->db->from('tb_pelanggan');
    $this->db->where('id_pelanggan', $id_pelanggan);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        $stored_password = $query->row()->password;

        // Memeriksa kecocokan password dengan plain text
        return $current_password === $stored_password;
    }

    return FALSE;
}
public function changePassword($id_pelanggan, $new_password) {
 $data = array(
        'password' => $new_password
    );

    $this->db->where('id_pelanggan', $id_pelanggan);
    $this->db->update('tb_pelanggan', $data);

    return $this->db->affected_rows() > 0;
}
public function update_photo($id_pelanggan, $photo_filename)
{
    $data = array('foto' => $photo_filename);
    $this->db->where('id_pelanggan', $id_pelanggan);
    $this->db->update('tb_pelanggan', $data);
}
public function reduce_product_stock($id_produk, $jumlah) {
    $this->db->set('stok', 'stok - ' . $jumlah, false);
    $this->db->where('id_produk', $id_produk);
    $this->db->update('tb_produk');
}

public function save_notification($data) {
    return $this->db->insert('tb_notif', $data);
}

public function get_user_notifications($id_pelanggan) {
    $this->db->where('id_pelanggan', $id_pelanggan);
    $this->db->order_by('jam_msg', 'desc');
    return $this->db->get('tb_notif')->result();
}

}
