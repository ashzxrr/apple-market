<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once FCPATH.'vendor/autoload.php';

class Admin extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');  
        $this->load->model('produk_model'); // Memuat model Produk_model
        $this->load->model('admin_model');
        $this->load->library('session');
        $this->load->helper('string');

 

        
    }

    public function dashboard() {
        // Logika untuk halaman dashboard admin
        $data['notifications']=$this->admin_model->get_notification();
        $this->load->view('header', $data);
        $this->load->view('admin/dashboard');
    }
 
    public function home() {
        // Logika untuk halaman home admin
        $data['notifications']=$this->admin_model->get_notification();
        $this->load->view('header', $data);
        $this->load->view('admin/home');
    }

    public function produk() {
        // Logika untuk halaman produk admin
        $data['produk']=$this->produk_model->get_produk();
        $data['notifications']=$this->admin_model->get_notification();
        $this->load->view('header', $data);

        $this->load->view('admin/produk', $data);
    } 
    public function orders(){
        $data['notifications']=$this->admin_model->get_notification();
        $this->load->view('header', $data);

        $data['orders']=$this->admin_model->get_all();
        $this->load->view('admin/orders', $data);
    } 
    // admin.php
    public function detail_order($id_pesanan) {
        // Load data order dan detail order dari model
        $data['order'] = $this->admin_model->get_orders($id_pesanan);
        //$data['order_details'] = $this->admin_model->get_order_details($id_pesanan);
        // Load view dengan data yang sudah diambil
        $data['notifications']=$this->admin_model->get_notification();
        $this->load->view('header', $data);

        $this->load->view('admin/detail_order', $data);
    }
    
    public function konfirmasi_pembayaran($id_pesanan) {
        // Lakukan validasi atau logika lain yang diperlukan
        // ... 
    
        // Ubah status pesanan menjadi Barang Sedang Dikemas
        $this->admin_model->update_order_status($id_pesanan, 'Barang Sedang Dikemas');
    
        // Ubah status pembayaran menjadi Terkonfirmasi
        $this->admin_model->update_payment_status($id_pesanan, 'Terkonfirmasi');
        // Tambahkan notifikasi untuk user
          $notification_data = array(
            'id_pelanggan' => $this->input->post('id_pelanggan'), // Ganti dengan kolom yang sesuai pada tabel user
            'title' => 'Pesanan Sudah Dikonfirmasi',
            'message' => 'Pesanan Kamu sedang Dikemas loo, Tunggu yaaa',
            'jam_msg' => date('Y-m-d H:i:s')
        );
        $this->db->insert('tb_notif', $notification_data);

        // Redirect atau tampilkan pesan sukses
        redirect('admin/orders');
    }


    public function kemas_pro($id_pesanan) {
        // Ubah status pesanan menjadi 'Barang Sedang Dikemas'
        $this->admin_model->update_status($id_pesanan, 'Barang Sedang Dikemas');
        
        redirect('admin/orders');
    }
    
    public function kirim_pro($id_pesanan, $id_pelanggan) {
        // Ubah status pesanan menjadi 'Barang Dikirim'
        $this->admin_model->update_status($id_pesanan, 'Barang Dikirim');
        
        $resi_prefix = 'REF';
        $random_resi = $resi_prefix . random_string('numeric', 8);
    
        // Update nomor resi
        $this->admin_model->update_resi($id_pesanan, $random_resi);

        $notification_data = array(
            'id_pelanggan' => $id_pelanggan, // Ganti dengan kolom yang sesuai pada tabel user
            'title' => 'Pesanan Selesai di Kemas',
            'message' => 'Pesanan kamu sedang dibawa Oleh Kurir yaa, Silahkan cek Resi nya!!',
            'jam_msg' => date('Y-m-d H:i:s')
        );
        $this->db->insert('tb_notif', $notification_data);
        redirect('admin/orders');
    }
    
    
    public function pelanggan() {
        // Logika untuk halaman pelanggan admin
        $data['pel'] = $this->admin_model->get_pelanggan();
        $this->load->view('admin/pelanggan', $data);
    }

    public function pembayaran() {
        // Logika untuk halaman pembayaran admin
        $data['notifications']=$this->admin_model->get_notification();
        $this->load->view('header', $data);
        $data['orders']=$this->admin_model->get_all_pembayaran();
        $this->load->view('admin/pembayaran', $data);
    }

    public function logout() {
        // Logika untuk logout admin
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('login');
    }

    //tambah produk

    public function tambah_produk(){
        $data['notifications']=$this->admin_model->get_notification();
        $this->load->view('header', $data);

        $this->load->view('admin/tambah_produk');
    }

    public function save_product() {
        $config['upload_path'] = './upload/produk/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 1024;
    
        $this->load->library('upload', $config);
    
        if (!$this->upload->do_upload('foto')) {
            $error = array('error' => $this->upload->display_errors());
            // Tambahkan notifikasi untuk file selain foto
            $this->session->set_flashdata('error', 'Hanya file gambar (gif, jpg, png) yang diizinkan.');
            redirect('admin/tambah_produk');
        } else { 
            $data = $this->upload->data();
            
            // Generate nama file acak
            $file_name = md5(uniqid(rand(), true)) . $data['file_ext'];
            
            // Pindahkan file ke folder uploads dan ganti nama
            rename($data['full_path'], $data['file_path'] . $file_name);
    
            $produk_data = array(
                'nama_produk' => $this->input->post('nama_produk'),
                'harga' => $this->input->post('harga'),
                'deskripsi' => $this->input->post('deskripsi'),
                'stok' => $this->input->post('stok'),
                'foto' => $file_name, // Gunakan nama file yang baru
                'kategori' => $this->input->post('kategori')
            );
    
            $this->produk_model->insert_produk($produk_data);
    
            // Set flash data untuk notifikasi
            $this->session->set_flashdata('success', 'Produk berhasil ditambahkan');
    
            redirect('admin/produk');
        }
}

public function edit_produk($id_produk) {
    // Ambil data produk berdasarkan ID
    $data['produk'] = $this->produk_model->get_produk_by_id($id_produk);

    $data['notifications']=$this->admin_model->get_notification();
    $this->load->view('header', $data);

    $this->load->view('admin/edit_produk', $data);
}

public function update_product() {
    // Validasi form (sesuaikan dengan kebutuhan Anda)

    // Ambil data dari form
    $id_produk = $this->input->post('id_produk');
    $nama_produk = $this->input->post('nama_produk');
    $harga = $this->input->post('harga');
    $deskripsi = $this->input->post('deskripsi');
    $stok = $this->input->post('stok');
    $kategori = $this->input->post('kategori');

    // Ambil file foto yang di-upload
    $config['upload_path'] = './upload/produk/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size'] = 1024;

    $this->load->library('upload', $config);

    // Cek apakah ada file foto yang di-upload
    if ($this->upload->do_upload('foto')) {
        $data = $this->upload->data();

        // Generate nama file acak
        $file_name = md5(uniqid(rand(), true)) . $data['file_ext'];

        // Pindahkan file ke folder uploads dan ganti nama
        rename($data['full_path'], $data['file_path'] . $file_name);

        // Update data produk dengan foto baru
        $produk_data = array(
            'nama_produk' => $nama_produk,
            'harga' => $harga,
            'deskripsi' => $deskripsi,
            'stok' => $stok,
            'foto' => $file_name,
            'kategori' => $kategori
        );
    } else {
        // Update data produk tanpa foto baru
        $produk_data = array(
            'nama_produk' => $nama_produk,
            'harga' => $harga,
            'deskripsi' => $deskripsi,
            'stok' => $stok,
            'kategori' => $kategori
        );
    }

    // Panggil model untuk update produk
    $this->produk_model->update_produk($id_produk, $produk_data);

     // Set flash data untuk notifikasi
     $this->session->set_flashdata('success', 'Produk berhasil diupdate');

    // Redirect ke halaman produk setelah update
    redirect('admin/produk');
}

public function hapus_produk($id_produk) {
    // Panggil model untuk hapus produk
    $this->produk_model->hapus_produk($id_produk);

    // Set flash data untuk notifikasi
    $this->session->set_flashdata('success', 'Produk berhasil dihapus');

    // Redirect ke halaman produk setelah hapus
    redirect('admin/produk');
}

public function cetak_laporan() {
  // Load the Dompdf library
  require_once APPPATH.'third_party/dompdf/autoload.inc.php';

  // Create an instance of the Dompdf class
  $dompdf = new Dompdf\Dompdf();

  // Load HTML content from your view file
  $html = $this->load->view('admin/admin_pdf_view', [], true);

  // Load the HTML into Dompdf
  $dompdf->loadHtml($html);

  // Set paper size (A4)
  $dompdf->setPaper('A4', 'portrait');

  // Render PDF (first, generate the PDF, then output to browser or save to a file)
  $dompdf->render();

  // Output file to the browser
  $dompdf->stream('Laporan_Admin_Pembayaran.pdf', array('Attachment' => 0));
}

public function notifikasi(){
    $data['notifications']=$this->admin_model->get_notification();
    $this->load->view('header', $data);
    $this->load->view('admin/notifikasi', $data);

}

}