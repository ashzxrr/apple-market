<?php
use GuzzleHttp\Client;

    class User extends MY_Controller{

        public function __construct() {
            parent::__construct();
            $this->load->helper('url');  
            $this->load->model('user_model'); // Memuat model Produk_model
            $this->load->library('session');
            $this->load->library('rajaongkir');
            $this->load->library('form_validation');

            
        }
    
        public function dashboard() {
            $data['produk']=$this->user_model->get_all_produk();
            $data['user_data'] = $this->session->userdata('user_data');
            $user_data = $this->session->userdata('user_data');
            
   

        // Get notifications from the model
            $data['notifications'] = $this->user_model->get_user_notifications($user_data->id_pelanggan);
            
            $this->load->view('user/home', $data);
        }
        public function home() {    
            $data['produk']=$this->user_model->get_all_produk();
            $data['user_data'] = $this->session->userdata('user_data');
            $user_data = $this->session->userdata('user_data');
            
   

        // Get notifications from the model
            $data['notifications'] = $this->user_model->get_user_notifications($user_data->id_pelanggan);
            
            $this->load->view('user/home', $data);
        }
        public function produk() {
            // Logika untuk halaman produk admin
            $datapro['produk']=$this->user_model->get_all_produk();
            $data['user_data'] = $this->session->userdata('user_data');
            $data['produk_with_rating'] = $this->get_produk_with_rating($data['produk']);
            $data['user_data'] = $this->session->userdata('user_data');
            $user_data = $this->session->userdata('user_data');
            
   

        // Get notifications from the model
            $data['notifications'] = $this->user_model->get_user_notifications($user_data->id_pelanggan);

            
            $this->load->view('header_user', $data);
            $this->load->view('user/produk', $data);
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
        public function tambah_ke_keranjang2($id_produk) {
        $this->sendAdminNotificationEmail();

            // Ambil data pelanggan dari sesi
            $user_data = $this->session->userdata('user_data');
        
            // Ambil jumlah dari formulir
            $jumlah_input = $this->input->post('jumlah');
            $warna = $this->input->post('color');

        
            // Ambil stok produk dari database (pastikan model dan metode untuk mendapatkan stok sudah ada)
            $stok_produk = $this->user_model->get_stok_produk($id_produk); // Gantilah dengan metode yang sesuai
        
            // Ambil jumlah produk di keranjang
            $existing_quantity = $this->user_model->get_quantity_in_keranjang($user_data->id_pelanggan, $id_produk);
        
            // Pastikan jumlah tidak melebihi stok
            $jumlah = min($existing_quantity + $jumlah_input, $stok_produk);
        
            // Jika produk sudah ada di keranjang, update jumlah
            if ($this->user_model->is_produk_in_keranjang($user_data->id_pelanggan, $id_produk)) {
                $this->user_model->update_jumlah_produk_in_keranjang($user_data->id_pelanggan, $id_produk, $jumlah);
            } else {
                // Jika belum ada, masukkan ke keranjang (tb_orders_temp)
                $data = array(
                    'id_produk' => $id_produk,
                    'id_pelanggan' => $user_data->id_pelanggan,
                    'jumlah' => $jumlah,
                    'warna' => $warna,
                    'tgl_order_temp' => date('Y-m-d H:i:s')
                );
        
                $this->db->insert('tb_orders_temp', $data);
            }
        
            // Update data pesanan dalam sesi
            $user_orders = $this->user_model->get_user_orders($user_data->id_pelanggan);
            $this->session->set_userdata('user_orders', $user_orders);
        
            // Set pesan flashdata
            $this->session->set_flashdata('success', 'Produk berhasil ditambahkan ke keranjang.');
            $this->session->set_flashdata('message_type', 'success');
        
            // Redirect ke halaman produk atau halaman keranjang
            redirect('produk/detail_produk/'.$id_produk);
        }
        
        public function keranjang() {
                // Memuat model yang diperlukan
                $this->load->model('user_model');
            
                // Memuat header
            
                // Mengambil ID pelanggan dari sesi
                $user_data = $this->session->userdata('user_data');
            
                // Jika ID pelanggan tidak ada, Anda mungkin ingin menangani situasi ini sesuai kebutuhan Anda.
                if (!$user_data->id_pelanggan) {
                    // Misalnya, redirect ke halaman login
                    redirect('login');
                }
            
                // Mengambil data keranjang dari database berdasarkan ID pelanggan
                $keranjang = $this->user_model->get_keranjang_by_id_pelanggan($user_data->id_pelanggan);
                
            
                // Jika keranjang tidak kosong, ambil detail produk dari model
                if (!empty($keranjang)) {
                    foreach ($keranjang as &$order) {
                        // Ambil detail produk dari tb_produk
                        $product_details = $this->user_model->get_product_details($order->id_produk);
            
                        // Gabungkan data detail produk ke dalam objek order
                        $order->nama_produk = $product_details->nama_produk;
                        $order->harga = $product_details->harga;
                        $order->foto = $product_details->foto;
                        
                        // Tambahan atribut lainnya sesuai kebutuhan
                    }
                }

                $user_data = $this->session->userdata('user_data');
                
       
    
            // Get notifications from the model
                $data['notifications'] = $this->user_model->get_user_notifications($user_data->id_pelanggan);
                // Tampilkan halaman keranjang dengan data keranjang yang sudah diperbarui
                $this->load->view('header_user', $data);
                
                $this->load->view('user/keranjang', ['keranjang' => $keranjang]);
            }
            

    public function hapus_item($id_produk){
        $this->user_model->hapus_keranjang_by_id($id_produk);
        
        // Mengatur notifikasi flash data
        $this->session->set_flashdata('message', 'Item berhasil dihapus dari keranjang.');
        $this->session->set_flashdata('message_type', 'success');
        
        redirect('user/keranjang');
    }


    
    
    //proses 
    
   
    public function checkout_selected_items() {
        // Ambil ID produk yang dipilih untuk checkout
        $selected_products = $this->input->post('selected_products');
        
        // Ambil ID pelanggan dari sesi (pastikan pelanggan sudah login)
        $user_data = $this->session->userdata('user_data');
        $id_pelanggan = $user_data->id_pelanggan;
    
        if (!empty($selected_products) && !empty($id_pelanggan)) {
            // Ambil data keranjang untuk produk yang dipilih dan sesuai dengan id_pelanggan
            $data['selected_products'] = $this->user_model->get_selected_products($id_pelanggan, $selected_products);
            $data['notifications'] = $this->user_model->get_user_notifications($id_pelanggan);
            
            // Tampilkan halaman checkout_view dengan data produk yang dipilih
            $this->load->view('header_user', $data);
            $this->load->view('user/cc', $data);
        } else {
            // Redirect ke halaman keranjang jika tidak ada produk yang dipilih atau pelanggan tidak login
            redirect('user/keranjang');
        }
    }
        // Di dalam controller
// File: application/controllers/User.php

public function complete_order() {
    // Ambil data keranjang dari sesi
    $keranjang = $this->session->userdata('user_orders');

    // Ambil data pelanggan dari sesi
    $user_data = $this->session->userdata('user_data');

    // Simpan data ke tabel orders
    $data_orders = array(
        'nama_pembeli' => $this->input->post('nama_pembeli'),
        'alamat' => $this->input->post('alamat'),
        'telepon' => $this->input->post('telepon'),
        'email' => $this->input->post('email'),
        'status_order' => 'Menunggu Pembayaran',
        'tgl_order' => date('Y-m-d'),
        'jam_order' => date('H:i:s'),
        'kode_pos' => $this->input->post('kode_pos'),
        'total' => 0,  // Total awal dapat diatur nol, nanti akan diupdate setelah menghitung total pembayaran
        'order_at' => date('Y-m-d H:i:s')
    );

    // Simpan data ke tabel orders dan dapatkan ID pesanan yang baru saja dibuat
    $id_pesanan = $this->user_model->insert_order($data_orders);

    // Simpan data ke tabel orders_detail
    foreach ($keranjang as $item) {
        $data_orders_detail = array(
            'id_pesanan' => $id_pesanan,
            'id_produk' => $item->id_produk,
            'id_pelanggan' => $user_data->id_pelanggan,
            'warna'=> $item->warna,
            'jumlah' => $item->jumlah
        );

        $this->user_model->insert_order_detail($data_orders_detail);

        // Hitung total pembayaran
        $total_pembayaran = $item->harga * $item->jumlah;

        // Update total di tabel orders
        $this->user_model->update_order_total($id_pesanan, $total_pembayaran);
    }

       $id_produk_array = array();
   foreach ($keranjang as $item) {
       $id_produk_array[] = $item->id_produk;
   }

   // Menghapus item dari keranjang
    $this->user_model->remove_item_from_cart($user_data->id_pelanggan, $id_produk_array);
    // Mendapatkan id_produk dan jumlah yang akan dibeli
    $id_produk_jumlah_array = array();
    foreach ($keranjang as $item) {
        $id_produk_jumlah_array[$item->id_produk] = $item->jumlah;
    }

    // Mengurangi stok produk
    foreach ($id_produk_jumlah_array as $id_produk => $jumlah) {
        $this->user_model->reduce_product_stock($id_produk, $jumlah);
    }
    // Simpan data ke tabel tb_pengiriman
    $origin_city_id = '222'; // Ganti dengan city_id kota asal
    $destination_city_id = $this->input->post('city_id');
    $weight = 1000;
    $courier = $this->input->post('ekspedisi');// Mengambil ekspedisi dari form

    $client = new Client();
    $endpoint = 'cost';

    $response = $client->request('POST', $this->rajaongkir->getBaseUrl() . $endpoint, [
        'headers' => [
            'key' => $this->rajaongkir->getApiKey(),
        ],
        'form_params' => [
            'origin' => $origin_city_id,
            'destination' => $destination_city_id,
            'weight' => $weight,
            'courier' => $courier,
        ],
    ]);

    $ongkir_data = json_decode($response->getBody(), true);

    // Cari layanan reguler
    $layanan_reguler = '';
    $ongkir_reguler = 0;
    $estimasi_reguler = '';

    foreach ($ongkir_data['rajaongkir']['results'][0]['costs'] as $cost) {
        if ($cost['service'] === 'REG') { // Sesuaikan dengan kode layanan reguler yang sesuai
            $layanan_reguler = $cost['service'];
            $ongkir_reguler = $cost['cost'][0]['value'];
            $estimasi_reguler = $cost['cost'][0]['etd'];
            break;
        }
    }

    // Simpan data ke tabel tb_pengiriman
    $data_pengiriman = array(
        'id_pesanan' => $id_pesanan,
        'ekspedisi' => $courier,
        'layanan' => $layanan_reguler,
        'ongkir' => $ongkir_reguler,
        'resi' => '',  // Resi kosongkan terlebih dahulu
        'estimasi' => $estimasi_reguler,  // Ambil estimasi dari data API
    );

    $this->user_model->insert_pengiriman($data_pengiriman);

    // Redirect ke halaman pembayaran dengan membawa ID pesanan
    redirect('user/pembayaran_nih/' . $id_pesanan);
}


   

 public function pembayaran_nih($id_pesanan){
      // Ambil data pesanan dan detail pesanan
      $user_data = $this->session->userdata('user_data');

      $data['order'] = $this->user_model->get_order_by_id_nih($id_pesanan);
      $data['order_details'] = $this->user_model->get_order_details_nih($id_pesanan);
      $data['pengiriman'] = $this->user_model-> get_pengiriman_by_id($id_pesanan);
      $data['notifications'] = $this->user_model->get_user_notifications($user_data->id_pelanggan);
     $this->load->view('header_user', $data);
      $this->load->view('user/pembayaran_nih', $data);
 }
    
 public function process_payment_nih($id_pesanan) {
    // Ambil data pesanan
    $user_data = $this->session->userdata('user_data');

      
      $order = $this->user_model->get_order_by_id_nih($id_pesanan);
    
    // Ambil biaya ongkir dari data kota
    $kota_id = $order->id_kota;
    $ongkos_kirim = $this->user_model->get_pengiriman_by_id($id_pesanan);


    // Tambahkan ongkos kirim ke dalam data pembayaran
    $data_pembayaran['ongkos_kirim'] = $ongkos_kirim->ongkir;

    
    // Ambil nilai metode dari form post
    $metode = $this->input->post('metode');

    // Konfigurasi upload file
    $config['upload_path'] = './upload/buktitf/';
    $config['allowed_types'] = 'jpg|jpeg|png|gif';
    $config['max_size'] = 2048; // 2MB

    $this->load->library('upload', $config); 

    if ($this->upload->do_upload('foto')) {
        // File berhasil diunggah
        $upload_data = $this->upload->data();
        $foto = $upload_data['file_name'];

        // Proses pembayaran, simpan data ke tb_pembayaran
        $data_pembayaran = array(
            'id_pesanan' => $id_pesanan,
            'tgl_pesan' => $order->tgl_order,
            'metode' => $metode,
            'total_pem' => $order->total,
            'foto_bukti' => $foto,
            'status' => 'Menunggu Konfirmasi'
        );
        // Simpan data ke tb_pembayaran dengan total yang sudah termasuk ongkos kirim
        $data_pembayaran['total_pem'] = $order->total + $ongkos_kirim->ongkir;
        $this->load->model('user_model');
        $this->user_model->save_payment_nih($data_pembayaran);

          // Tambahkan notifikasi untuk user
          $notification_data = array(
            'id_pelanggan' => $user_data->id_pelanggan, // Ganti dengan kolom yang sesuai pada tabel user
            'title' => 'Pembayaran Berhasil',
            'message' => 'Pembayaran Anda telah berhasil.',
            'jam_msg' => date('Y-m-d H:i:s')
        );
        $this->db->insert('tb_notif', $notification_data);         
         $notification_data_admin = array(
            'id_pesanan' =>$id_pesanan, // Ganti dengan kolom yang sesuai pada tabel user
            'title' => 'Pesanan Baru',
            'message' => 'Silahkan Cek Pesanannya',
            'created_at' => date('Y-m-d H:i:s')
        );
        $this->db->insert('tb_notif_admin', $notification_data_admin);

        redirect('user/home');  // Sesuaikan dengan halaman setelah pembayaran
        

    } else {
        // File gagal diunggah
        $error = array('error' => $this->upload->display_errors());
        $this->load->view('user/pembayaran_nih', $error);
    }
 }
 private function sendAdminNotificationEmail() {

    $config    = [
        'mailtype'  => 'html',
        'charset'   => 'utf-8',
        'protocol'  => 'smtp',
        'smtp_host' => 'smtp.gmail.com',
        'smtp_user' => 'ahmadshohazar2911@gmail.com',  // Email gmail
        'smtp_pass'   => 'shohazar2911',  // Password gmail
        'smtp_crypto' => 'ssl',
        'smtp_port'   => 465,
        'crlf'    => "\r\n",
        'newline' => "\r\n"
    ];
    $this->load->library('email', $config);
    // Gantilah dengan alamat email admin yang sebenarnya
    $adminEmail = 'apisclover4@gmail.com';

    $subject = 'New Order Notification';
    $message = 'A new order has been placed. Check the admin dashboard for details.';




    $this->email->from('shohazar2911@gmail.com', 'Ahmad Shohazar');
    $this->email->to($adminEmail);
    $this->email->subject($subject);
    $this->email->message($message);

    $this->email->send();
}

public function pesanan_full() {
    $user_data = $this->session->userdata('user_data');
   
    // Ambil data pesanan dari model
    $user_orders_details = $this->user_model->get_user_orders_details_nihhh($user_data->id_pelanggan);

    // Kirim data ke view
    $data['user_orders_details'] = $user_orders_details;
    $data['notifications'] = $this->user_model->get_user_notifications($user_data->id_pelanggan);

     $this->load->view('header_user', $data);
    $this->load->view('user/side_bar');
   
    $this->load->view('user/pesanan_full', $data);
}

public function wait(){
    $user_data = $this->session->userdata('user_data');
   
    // Ambil data pesanan dari model
    $user_orders_details = $this->user_model->get_user_orders_details_nihhh($user_data->id_pelanggan);

    // Kirim data ke view
    $data['user_orders_details'] = $user_orders_details;
    $data['notifications'] = $this->user_model->get_user_notifications($user_data->id_pelanggan);

     $this->load->view('header_user', $data);
     $this->load->view('user/side_bar');
     $this->load->view('user/stat/wait', $data);
}
public function dikemas(){
    $user_data = $this->session->userdata('user_data');
   
    // Ambil data pesanan dari model
    $user_orders_details = $this->user_model->get_user_orders_details_nihhh($user_data->id_pelanggan);

    // Kirim data ke view
    $data['user_orders_details'] = $user_orders_details;
    $data['notifications'] = $this->user_model->get_user_notifications($user_data->id_pelanggan);

    $this->load->view('header_user', $data);
    $this->load->view('user/side_bar');
    $this->load->view('user/stat/dikemas', $data);
}public function dikirim(){
    $user_data = $this->session->userdata('user_data');
   
    // Ambil data pesanan dari model
    $user_orders_details = $this->user_model->get_user_orders_details_nihhh($user_data->id_pelanggan);

    // Kirim data ke view
    $data['user_orders_details'] = $user_orders_details;
    $data['notifications'] = $this->user_model->get_user_notifications($user_data->id_pelanggan);

    $this->load->view('header_user', $data);
    $this->load->view('user/side_bar');

    $this->load->view('user/stat/dikirim', $data);
}
public function selesai(){
    $user_data = $this->session->userdata('user_data');
   
    // Ambil data pesanan dari model
    $user_orders_details = $this->user_model->get_user_orders_details_nihhh($user_data->id_pelanggan);

    // Kirim data ke view
    $data['user_orders_details'] = $user_orders_details;
    $data['notifications'] = $this->user_model->get_user_notifications($user_data->id_pelanggan);

    $this->load->view('header_user', $data);
    $this->load->view('user/side_bar');

    $this->load->view('user/stat/selesai', $data);
}

public function detail_pesanan($id_pesanan){
    $user_data = $this->session->userdata('user_data');


        // Load data order dan detail order dari model
        $data['order'] = $this->user_model->get_orders($id_pesanan);
        $data['notifications'] = $this->user_model->get_user_notifications($user_data->id_pelanggan);

        $this->load->view('header_user', $data);
        $this->load->view('user/detail_pesanan', $data);
}
    
public function cekapi(){
    $this->load->view('user/cekapi');
}
public function get_provinces()
    {
        $client = new Client();
        $response = $client->request('GET', $this->rajaongkir->getBaseUrl() . 'province', [
            'headers' => [
                'key' => $this->rajaongkir->getApiKey(),
            ],
        ]);

        $provinces = json_decode($response->getBody(), true)['rajaongkir']['results'];

        $options = '<option value="">Pilih Provinsi</option>';
        foreach ($provinces as $province) {
            $options .= '<option value="' . $province['province_id'] . '">' . $province['province'] . '</option>';
        }

        echo $options;
    }


    public function get_cities()
    {
        $client = new Client();

        $province_id = $this->input->post('province_id'); // Ambil data dari request POST
        $response = $client->request('GET', $this->rajaongkir->getBaseUrl() . 'city', [
            'headers' => [
                'key' => $this->rajaongkir->getApiKey(),
            ],
            'query' => [
                'province' => $province_id,
            ],
        ]);

        $cities = json_decode($response->getBody(), true);

        $options = '<option value="">Pilih Kota/Kabupaten</option>';
        foreach ($cities['rajaongkir']['results'] as $city) {
            $options .= '<option value="' . $city['city_id'] . '">' . $city['type'] . ' ' . $city['city_name'] . '</option>';
        }

        echo $options;
    }

    public function cek_ongkir()
{
        $origin_city_id = '222'; // Ganti dengan city_id kota asal
        $destination_city_id = $this->input->post('city_id');
        $weight = $this->input->post('weight');
        $courier = $this->input->post('courier');

        $client = new Client();

        // Contoh endpoint untuk cek ongkir (perlu disesuaikan dengan API RajaOngkir)
        $endpoint = 'cost';
        $response = $client->request('POST', $this->rajaongkir->getBaseUrl() . $endpoint, [
            'headers' => [
                'key' => $this->rajaongkir->getApiKey(),
            ],
            'form_params' => [
                'origin' => $origin_city_id,
                'destination' => $destination_city_id,
                'weight' => $weight,
                'courier' => $courier,
            ],
        ]);

        $ongkir_data = json_decode($response->getBody(), true);

    // Tampilkan hasil cek ongkir, hanya layanan reguler
    $output = '<h3>Ongkir</h3>';
    $output .= '<table border="1">
                    <tr>
                        <th>Layanan</th>
                        <th>Biaya</th>
                        <th>Estimasi Pengiriman</th>
                    </tr>';

    foreach ($ongkir_data['rajaongkir']['results'][0]['costs'] as $cost) {
        if ($cost['service'] == 'REG') { // Filter hanya layanan reguler
            $output .= '<tr>
                            <td>' . $cost['service'] . '</td>
                            <td>' . $cost['cost'][0]['value'] . '</td>
                            <td>' . $cost['cost'][0]['etd'] . '</td>
                        </tr>';
            break; // Hanya tampilkan satu layanan reguler pertama
        }
    }

    $output .= '</table>';

    // Masukkan hasil cek ongkir ke dalam form sebagai input tersembunyi
    $output .= '<input type="hidden" name="ongkir" value="' . $ongkir_data['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'] . '">';

    echo $output;
}
public function pesanan_selesai($id_pesanan) {
    // Lakukan validasi atau logika lain yang diperlukan
    $this->user_model->update_status($id_pesanan, 'Selesai');
    $user_data = $this->session->userdata('user_data');


            $notification_data = array(
                'id_pelanggan' => $user_data->id_pelanggan, // Ganti dengan kolom yang sesuai pada tabel user
                'title' => 'Pesanan Selesai!!',
                'message' => 'Jangan Lupa Review Yaaa',
                'jam_msg' => date('Y-m-d H:i:s')
            );
            $this->db->insert('tb_notif', $notification_data);
            // Redirect ke halaman produk atau halaman keranjang
            redirect('user/pesanan_full');

}

// Di dalam controller Anda (contoh: User.php)
public function submit_review() {
 
        // Formulir valid, simpan data review ke database
        $data = array(
            'id_produk' => $this->input->post('id_produk'),
            'id_pesanan' => $this->input->post('id_pesanan'),
            'rating' => $this->input->post('rating'),
            'review' => $this->input->post('review')
        );
        $result = $this->user_model->saveReview($data);

        if ($result) {
            $this->session->set_flashdata('success', 'Yeayy Rating sudah di Submit');
            $this->session->set_flashdata('message_type', 'success');
        } else {
            // Review gagal disimpan, tampilkan pesan error
            $this->session->set_flashdata('message', 'Gagal menyimpan review. Silakan coba lagi.');
        }

        redirect('user/pesanan_full'); // Ganti dengan URL halaman produk
    }
    
// application/controllers/User.php

public function get_review_ratings($id_produk)
{
    // Ambil data rating dari database berdasarkan id_produk
    $ratings = $this->user_model->get_ratings_by_produk($id_produk);

    if ($ratings) {
        // Hitung rata-rata rating
        $total_ratings = count($ratings);
        $average_rating = array_sum($ratings) / $total_ratings;

        // Return data JSON
        $data = [
            'average_rating' => $average_rating,
            'total_ratings' => $total_ratings,
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    } else {
        // Jika tidak ada rating
        $this->output->set_content_type('application/json')->set_output(json_encode(['average_rating' => null, 'total_ratings' => 0]));
    }
}
private function get_average_rating($ratings)
{
    if ($ratings) {
        $average = array_sum($ratings) / count($ratings);
        return round($average, 1); // Bulatkan rata-rata ke satu desimal
    } else {
        return 0;
    }
}
private function get_total_reviews($ratings)
{
    return $ratings ? count($ratings) : 0;
}

//usertampilan

public function side_bar(){

                $user_data = $this->session->userdata('user_data');
$data['notifications'] = $this->user_model->get_user_notifications($user_data->id_pelanggan);
$this->load->view('header_user', $data);
$this->load->view('user/side_bar');
}
public function data_user() {
    $user_data = $this->session->userdata('user_data');
   
    // Ambil data pesanan dari model
    $user_data_id = $this->user_model->get_user_data($user_data->id_pelanggan);
    $data['notifications'] = $this->user_model->get_user_notifications($user_data->id_pelanggan);


    // Kirim data ke view
    $data['user'] = $user_data_id;
    $this->load->view('header_user', $data);
    $this->load->view('user/side_bar');

    $this->load->view('user/user_data', $data);
}

    public function chg_pass(){
        $user_data = $this->session->userdata('user_data');
   
        // Ambil data pesanan dari model
        $user_data = $this->user_model->get_user_data($user_data->id_pelanggan);
        $data['notifications'] = $this->user_model->get_user_notifications($user_data->id_pelanggan);
        
        // Kirim data ke view
        $data['user'] = $user_data;
        $this->load->view('header_user', $data);
        $this->load->view('user/side_bar');
    
        $this->load->view('user/chg_pass', $data);

    }

    public function chg_pass_act(){
        // Ambil data dari form
        $user = $this->session->userdata('user_data');
        $user_data = $this->user_model->get_user_data($user->id_pelanggan);
        
        // Kirim data ke view
        $data['user'] = $user_data;

        $current_password = $this->input->post('current_password');
        $new_password = $this->input->post('new_password');
        $confirm_password = $this->input->post('confirm_password');

        // Validasi jika password baru dan konfirmasi password cocok
        if ($new_password === $confirm_password) {

            $id_pelanggan = $user->id_pelanggan;
            $is_password_correct = $this->user_model->checkCurrentPassword($id_pelanggan, $current_password);
        
             if ($is_password_correct) {
                 $this->user_model->changePassword($id_pelanggan, $new_password);
                 $this->session->set_flashdata('success', 'Password Berhasil Diganti');
                 $this->session->set_flashdata('message_type', 'success');
                 redirect('user/chg_pass', $data); // Ganti 'your_success_url' dengan URL tujuan setelah berhasil mengganti password
             } else {
                $this->session->set_flashdata('error', 'Password Lama Salah'); 
                $this->session->set_flashdata('message_type', 'error');

                redirect('user/chg_pass', $data); // Ganti 'your_error_url' dengan URL tujuan setelah kesalahan password saat ini
             }
        } else {
            $this->session->set_flashdata('warning', 'Password Baru dan Konfirmasi Password tidak sama');
            $this->session->set_flashdata('message_type', 'warning');

            redirect('user/chg_pass', $data); 
    }
}   
public function chg_pp(){
    $user_data = $this->session->userdata('user_data');
    $user_data = $this->user_model->get_user_data($user_data->id_pelanggan);
    $data['notifications'] = $this->user_model->get_user_notifications($user_data->id_pelanggan);
    
    // Kirim data ke view
    $data['user'] = $user_data;
    $this->load->view('header_user', $data);
    $this->load->view('user/side_bar');

    $this->load->view('user/chg_pp', $data);
}
public function upload_photo()
{
    $user_data = $this->session->userdata('user_data');
    $user_data = $this->user_model->get_user_data($user_data->id_pelanggan);
    
    // Kirim data ke view
    $data['user'] = $user_data;
    // Konfigurasi upload
    $config['upload_path']   = './upload/'; // Ganti dengan path upload yang sesuai di proyek Anda
    $config['allowed_types'] = 'jpg|jpeg|png|gif';
    $config['max_size']      = 2048; // 2 MB (ukuran bisa disesuaikan)
    $config['encrypt_name']  = TRUE;

    $this->load->library('upload', $config);

    if ($this->upload->do_upload('photo')) {
        // Jika upload berhasil, update foto di database dan alihkan ke halaman lain
        $photo_data = $this->upload->data();
        $this->update_photo_in_database($photo_data['file_name']);
        $this->session->set_flashdata('success', 'Foto Berhasil Diganti');
        $this->session->set_flashdata('message_type', 'success'); // Panggil fungsi untuk menyimpan nama file di database
        redirect('user/chg_pp', $data); // Ganti dengan URL halaman profil pengguna setelah mengganti foto
    } else {
        // Jika upload gagal, tampilkan pesan error
        $error = $this->upload->display_errors();
        $this->session->set_flashdata('error', $error);
        $this->session->set_flashdata('message_type', 'error'); // Panggil fungsi untuk menyimpan nama file di database

        redirect('user/chg_pp', $data); // Kembali ke halaman ganti foto
    }
}

private function update_photo_in_database($photo_filename)
{
    // Implementasikan logika untuk menyimpan nama file foto baru di database
    // Misalnya, dengan menggunakan model
    $user_data = $this->session->userdata('user_data');
    $id_pelanggan = $user_data->id_pelanggan;
    $this->user_model->update_photo($id_pelanggan, $photo_filename);
}


public function get_realtime_notifications() {
    // Memeriksa apakah pengguna sudah login
        $user = $this->session->userdata('user_data');
        $user_id = $user->id_pelanggan;


        // Get real-time notifications for the logged-in user
        $notifications = $this->user_model->get_user_notifications($user_id);

        // Output as JSON
        echo json_encode($notifications);

} 
    }
?>
