-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2024 at 05:47 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marketphone`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_pesanan` int(11) NOT NULL,
  `nama_pembeli` varchar(100) NOT NULL,
  `alamat` varchar(400) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `kode_pos` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status_order` varchar(100) NOT NULL,
  `tgl_order` date NOT NULL,
  `jam_order` varchar(20) NOT NULL,
  `order_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_pesanan`, `nama_pembeli`, `alamat`, `telepon`, `email`, `kode_pos`, `total`, `status_order`, `tgl_order`, `jam_order`, `order_at`) VALUES
(29, 'LAL', 'Bandung', '08235573214', 'lal@gmail.com', 62355, 10000000, 'Selesai', '2024-01-13', '13:54:32', '2024-01-13 13:44:20'),
(30, 'Faukhi', 'Kediri', '9876545678', 'q@gmail.com', 9898, 6499000, 'Menunggu Pembayaran', '2024-01-13', '17:28:50', '2024-01-13 16:28:50');

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id_det` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `warna` varchar(20) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_detail`
--

INSERT INTO `orders_detail` (`id_det`, `id_pesanan`, `id_produk`, `id_pelanggan`, `warna`, `jumlah`) VALUES
(45, 30, 1295, 896, 'Silver', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pem` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `tgl_pesan` date NOT NULL,
  `metode` varchar(20) NOT NULL,
  `total_pem` int(11) NOT NULL,
  `foto_bukti` varchar(200) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pem`, `id_pesanan`, `tgl_pesan`, `metode`, `total_pem`, `foto_bukti`, `status`) VALUES
(54, 29, '2024-01-13', 'DANA', 10026000, '「_ᴀᴄᴋᴇʀʟᴇx_」.jpeg', 'Terkonfirmasi'),
(55, 30, '2024-01-13', 'BRI', 6510000, 'pngwing_com_(10)1.png', 'Menunggu Konfirmasi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `level` set('admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama_lengkap`, `username`, `password`, `foto`, `level`) VALUES
(1011, 'Admin E-Commerce', 'admin', 'admin', 'admin.jpg', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_notif`
--

CREATE TABLE `tb_notif` (
  `id_notif` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `tgl_msg` date NOT NULL,
  `jam_msg` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_notif`
--

INSERT INTO `tb_notif` (`id_notif`, `id_pelanggan`, `title`, `message`, `tgl_msg`, `jam_msg`) VALUES
(11252, 896, 'Pembayaran Berhasil', 'Pembayaran Anda telah berhasil.', '0000-00-00', '2024-01-13 06:54:46'),
(11253, 896, 'Pesanan Sudah Dikonfirmasi', 'Pesanan Kamu sedang Dikemas loo, Tunggu yaaa', '0000-00-00', '2024-01-13 07:07:03'),
(11254, 896, 'Pesanan Selesai di Kemas', 'Pesanan kamu sedang dibawa Oleh Kurir yaa, Silahkan cek Resi nya!!', '0000-00-00', '2024-01-13 07:22:26'),
(11255, 896, 'Pesanan Selesai!!', 'Jangan Lupa Review Yaaa', '0000-00-00', '2024-01-13 07:44:20'),
(11256, 896, 'Pembayaran Berhasil', 'Pembayaran Anda telah berhasil.', '0000-00-00', '2024-01-13 10:31:11');

-- --------------------------------------------------------

--
-- Table structure for table `tb_notif_admin`
--

CREATE TABLE `tb_notif_admin` (
  `id_notif_admin` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_notif_admin`
--

INSERT INTO `tb_notif_admin` (`id_notif_admin`, `id_pesanan`, `title`, `message`, `created_at`) VALUES
(28989, 29, 'Ada Pesanan Baru Masuk', 'Silahkan Cek Pesanannya!!', '2024-01-13 13:49:55');

-- --------------------------------------------------------

--
-- Table structure for table `tb_orders_temp`
--

CREATE TABLE `tb_orders_temp` (
  `id_order_temp` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `warna` varchar(20) NOT NULL,
  `tgl_order_temp` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `level` varchar(10) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `nama`, `email`, `username`, `password`, `alamat`, `telepon`, `level`, `foto`) VALUES
(891, 'coba', 'coba@gmail.com', 'coba', 'coba', 'coba', '78987', '', 'coba.png'),
(892, 'ahamd', 'sieafbijewn@giajeifjh', 'jnijn', 'ijnijn', 'kjnijn', 'jnijn', '', '332dffbe4219b1b73fb1bf8152c17c03.png'),
(893, 'ahmad', 'ahmadshohazar2911@gmail.com', 'ahmad', 'ahmad', 'mana aja kek', '0855556788', 'user', 'cb5b2435803ee7fb8eabd47129f8ac7f.jpeg'),
(894, 'user', 'user@gmail.com', 'user', 'j', 'user', '083767282', 'user', '5a940d31f8edb6a50f804414cdc3fe80.png'),
(895, 'Mila Rahmawati', 'mila2505@gmail.com', 'mila', 'mila', 'Tambakboyo, Pertigaan Culi', '0896879827', 'user', 'e9cf81c8f1430e60f720b9fd8d089e43.jpg'),
(896, 'M. Ikhlal Faukhi', 'faukhi@gmail.com', 'faukhi', 'faukhi', '', '', '', 'd1d2e0375460ca5da95e57af8e56f4ca.jpeg'),
(897, 'i', 'i@gmail.com', 'i', 'i', '', '', '', '007d16ce6a5dd7721099d434f99db8d4.jpeg'),
(898, 'a', 'a@gmail.com', 'a', 'a', '', '', '', ''),
(899, 'u', 'u@gmail.com', 'u', 'u', '', '', '', ''),
(900, 'e', 'es@s.com', 'e', 'e', '', '', '', ''),
(901, 'e', 'es@s.com', 'e', 'e', '', '', '', ''),
(902, 'p', 'p@gmail.com', 'p', 'p', '', '', '', ''),
(903, 'q', 'q@gmail.com', 'q', 'q', 'q', '97678', 'user', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengiriman`
--

CREATE TABLE `tb_pengiriman` (
  `id_pengiriman` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `ekspedisi` varchar(40) NOT NULL,
  `layanan` varchar(20) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `resi` varchar(15) NOT NULL,
  `estimasi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pengiriman`
--

INSERT INTO `tb_pengiriman` (`id_pengiriman`, `id_pesanan`, `ekspedisi`, `layanan`, `ongkir`, `resi`, `estimasi`) VALUES
(16, 29, 'jne', 'REG', 26000, 'REF15374268', '1-3'),
(17, 30, 'jne', 'REG', 11000, '', '1-2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `harga` int(20) NOT NULL,
  `deskripsi` text NOT NULL,
  `stok` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `nama_produk`, `harga`, `deskripsi`, `stok`, `foto`, `kategori`) VALUES
(1288, 'Iphone 13 Pro Max', 14999000, 'iPhone 13 Pro Max. Pembaruan sistem kamera Pro yang terbesar. Layar Super Retina XDR dengan ProMotion untuk penggunaan yang terasa lebih cepat dan responsif. Chip A15 Bionic yang secepat kilat. Desain kokoh dan kekuatan baterai terbaik yang pernah ada di iPhone. 1\r\n\r\n\r\n>> Poin-poin fitur utama\r\n\r\n   -> Layar Super Retina XDR 6,7 inci dengan ProMotion untuk penggunaan yang terasa lebih cepat dan responsif2\r\n   -> Mode Sinematik menambahkan kedalaman bidang yang dangkal dan pindah fokus secara otomatis di video Anda\r\n   -> Sistem kamera Pro dengan kamera Telefoto, Wide, dan Ultra Wide 12 MP; LiDAR Scanner; rentang zoom optik 6x; fotografi makro; Gaya Fotografi, video ProRes, Smart HDR 4, mode Malam, Apple ProRAW, perekaman HDR 4K Dolby Vision\r\n   -> Kamera depan TrueDepth 12 MP dengan mode Malam, perekaman HDR 4K Dolby Vision\r\n   -> Chip A15 Bionic untuk performa secepat kilat\r\n   -> Pemutaran video hingga 28 jam1\r\n   -> Desain kokoh dengan Ceramic Shield\r\n   -> Level ketahanan air IP68 terdepan di industri3\r\n   -> iOS 15 dilengkapi berbagai fitur baru untuk melakukan lebih banyak hal dengan iPhone4\r\n   -> Mendukung aksesori MagSafe untuk kemudahan pemasangan dan pengisian daya nirkabel yang lebih cepat5\r\n\r\n>> Legal\r\n\r\n   -> Kekuatan baterai bervariasi tergantung penggunaan dan konfigurasi. Lihat apple.com/batteries untuk informasi selengkapnya.\r\n   -> Layar memiliki sudut melengkung yang mengikuti desain lekukan yang indah, dan semua sudut ini berada di dalam bidang persegi standar. Jika diukur sebagai bentuk persegi standar, layarnya memiliki ukuran diagonal 6,06 inci. Area bidang layar berukuran lebih kecil.\r\n   -> iPhone 13 Pro Max tahan tumpahan, cipratan, dan debu dan diuji dalam kondisi laboratorium terkontrol dengan level IP68 menurut standar IEC 60529. Ketahanan terhadap tumpahan, cipratan, dan debu tidak berlaku secara permanen. Daya tahan mungkin berkurang akibat penggunaan sehari-hari. Jangan coba mengisi daya iPhone yang basah; lihat panduan pengguna untuk instruksi pembersihan dan pengeringan. Kerusakan akibat cairan tidak ditanggung dalam garansi.\r\n   -> Beberapa fitur mungkin tidak tersedia untuk semua negara atau semua wilayah.\r\n   -> Aksesori dijual terpisah.\r\n\r\nSpesifikasi teknis\r\nKunjungi apple.com/iphone/compare untuk informasi selengkapnya.', 7, '936250391fc88284533a9570c2b93d86.jpg', 'iPhone'),
(1290, 'MacBook Pro M2 ', 43499000, 'MacBook Pro 16 inci dengan M2 Pro dan M2 Max membawa daya dan kecepatan ke level berikutnya, saat tersambung ke daya atau menggunakan baterai. Dengan layar Liquid Retina XDR yang memukau, semua port yang Anda perlukan, dan kekuatan baterai sepanjang hari (1) — laptop pro ini siap mendampingi Anda ke mana pun.\r\n\r\n\r\n\r\n >> Poin-poin fitur utama :\r\n\r\n  -> Layar Liquid Retina XDR 16 inci yang menakjubkan dengan Extreme Dynamic Range dan rasio kontras (2)\r\n  -> Chip M2 Pro atau M2 Max untuk kecepatan dan keandalan luar biasa\r\n  -> CPU hingga 12-core menghadirkan kecepatan hingga 20 persen lebih tinggi untuk menuntaskan berbagai tahapan kerja pro lebih cepat (3)\r\n  -> GPU hingga 38-core dengan kecepatan hingga 30 persen lebih tinggi untuk aplikasi dan game kaya grafis (3)\r\n  -> Memori terintegrasi hingga 96 GB menjadikan segala yang Anda lakukan terasa cepat dan lancar\r\n  -> Kekuatan baterai hingga 22 jam (1)\r\n  -> Penyimpanan SSD super cepat hingga 8 TB membuka aplikasi dan file dalam sekejap\r\n  -> Kamera FaceTime HD 1080p\r\n  -> Sistem suara enam speaker dengan woofer force-cancelling\r\n  -> Deretan tiga mikrofon berkualitas studio menangkap suara Anda dengan lebih jernih\r\n  -> Tiga port Thunderbolt 4, port HDMI, slot kartu SDXC, jek headphone, port pengisian daya MagSafe\r\n  -> Konektivitas nirkabel Wi-Fi 6E untuk throughput hingga 2x lebih cepat (4)\r\n  -> Magic Keyboard dengan lampu latar dan Touch ID untuk membuka kunci dengan aman\r\n  -> macOS Ventura menghadirkan berbagai cara baru yang andal untuk menyelesaikan lebih banyak pekerjaan, berbagi dan berkolaborasi — di seluruh perangkat Apple Anda\r\n  -> Tersedia dalam warna abu-abu dan perak\r\n\r\n\r\nLegal\r\n  -> Tersedia opsi yang dapat dikonfigurasi.\r\n\r\n  -> Kekuatan baterai untuk pemutaran film aplikasi Apple TV. Kekuatan baterai bervariasi tergantung penggunaan dan konfigurasi. Lihat apple.com/batteries untuk informasi selengkapnya.\r\n  -> MacBook Pro 16 inci memiliki sudut melengkung di bagian atas. Jika diukur sebagai bentuk persegi standar, layarnya berukuran 16,2 inci secara diagonal (area bidang layar berukuran lebih kecil).\r\n  -> Dibandingkan dengan generasi sebelumnya.\r\n  -> Kecepatan didasarkan pada throughput teoretis dan mungkin bervariasi. Wi‑Fi 6E tidak tersedia di Tiongkok daratan. Memerlukan macOS 13.2 atau lebih baru di Jepang.', 8, '37e964f02169033b921b1708cada083e.jpg', 'Macbook'),
(1292, 'iPad Pro (Generasi ke-5)', 12799000, 'iPad Pro dilengkapi dengan chip Apple M1 yang bertenaga untuk performa tingkat selanjutnya dan kekuatan baterai sepanjang hari.(3) Layar Liquid Retina XDR 12,9 inci yang menghanyutkan untuk melihat dan mengedit foto serta video.(1) Model Cellular memungkinkan Anda tetap terhubung saat tidak ada Wi-Fi.(2) Dan kamera depan dengan Center Stage memudahkan Anda melakukan panggilan video. iPad Pro memiliki kamera pro dan LiDAR Scanner untuk foto dan video memukau, serta AR yang menghanyutkan. Thunderbolt untuk terhubung dengan aksesori berperforma tinggi. Dan Anda bisa menambahkan Apple Pencil untuk menulis catatan, menggambar, serta menandai dokumen, dan Magic Keyboard untuk trackpad dan pengalaman mengetik yang responsif.(4)\r\n\r\nPoin-poin Fitur utama :\r\n• Chip Apple M1 untuk performa tingkat selanjutnya\r\n• Layar Liquid Retina XDR 12,9 inci cemerlang1 dengan ProMotion, True Tone, dan warna luas P3\r\n• Sistem kamera TrueDepth memiliki kamera depan Ultra Wide dengan Center Stage\r\n• Kamera Wide 12 MP, kamera Ultra Wide 10 MP, dan LiDAR Scanner untuk AR yang imersif\r\n• Tetap terhubung dengan Wi-Fi 6 ultra cepat dan LTE(2)\r\n• Selangkah lebih maju dengan kekuatan baterai sepanjang hari(3)\r\n• Port Thunderbolt untuk terhubung ke penyimpanan eksternal cepat, layar, dan dock\r\n• Face ID untuk autentikasi aman\r\n• Audio empat speaker dan lima mikrofon kualitas studio\r\n• Dukungan untuk Apple Pencil (generasi ke-2), Magic Keyboard, dan Smart Keyboard Folio(4)\r\n• iPadOS begitu andal, intuitif, dan dirancang khusus untuk iPad\r\n• Lebih dari satu juta aplikasi di App Store khusus untuk iPad\r\n\r\nLegal :\r\nAplikasi tersedia di App Store. Ketersediaan judul dapat berubah sewaktu-waktu. \r\n1. Layar memiliki sudut melengkung. Jika diukur sebagai persegi, layar iPad Pro 12,9 inci memiliki ukuran diagonal 12,9 inci. Area bidang layar berukuran lebih kecil.\r\n2. Memerlukan paket data. Untuk lebih jelasnya, tanyakan kepada operator Anda. Kecepatan bervariasi menurut kondisi lokasi.\r\n3. Kekuatan baterai bervariasi tergantung penggunaan dan konfigurasi. Lihat apple.com/batteries untuk informasi selengkapnya.\r\n4. Aksesori dijual terpisah. Kompatibilitas bervariasi berdasarkan generasi.', 14, '8a8a668de7116b8062bf0f5b25a7c7dd.jpg', 'iPad'),
(1293, 'Iphone 13 Pro', 13999000, 'iPhone 13 Pro. Pembaruan sistem kamera Pro yang terbesar. Layar Super Retina XDR dengan ProMotion untuk penggunaan yang terasa lebih cepat dan responsif. Chip A15 Bionic yang secepat kilat. Desain kokoh dan lompatan besar dalam kekuatan baterai.\r\n\r\n\r\n>> Poin-poin fitur utama\r\n\r\n  -> Layar Super Retina XDR 6,1 inci dengan ProMotion untuk penggunaan yang terasa lebih cepat dan responsif1\r\n  -> Mode Sinematik menambahkan kedalaman bidang yang dangkal dan pindah fokus secara otomatis di video Anda\r\n  -> Sistem kamera Pro dengan kamera Telefoto, Wide, dan Ultra Wide 12 MP; LiDAR Scanner; rentang zoom optik 6x; fotografi makro; Gaya Fotografi, video ProRes, Smart HDR 4, mode Malam, Apple ProRAW, perekaman HDR 4K Dolby Vision\r\n  -> Kamera depan TrueDepth 12 MP dengan mode Malam, perekaman HDR 4K Dolby Vision\r\n  -> Chip A15 Bionic untuk performa secepat kilat\r\n  -> Pemutaran video hingga 22 jam2\r\n  -> Desain kokoh dengan Ceramic Shield\r\n  -> Level ketahanan air IP68 terdepan di industri3\r\n  -> iOS 15 dilengkapi berbagai fitur baru untuk melakukan lebih banyak hal dengan iPhone4\r\n  -> Mendukung aksesori MagSafe untuk kemudahan pemasangan dan pengisian daya nirkabel yang lebih cepat5\r\n\r\n>> Legal\r\n\r\n  -> Layar memiliki sudut melengkung yang mengikuti desain lekukan yang indah, dan semua sudut ini berada di dalam bidang persegi standar. Jika diukur sebagai bentuk persegi standar, layarnya memiliki ukuran diagonal 6,06 inci. Area bidang layar berukuran lebih kecil.\r\n  -> Kekuatan baterai bervariasi tergantung penggunaan dan konfigurasi. Lihat apple.com/batteries untuk informasi selengkapnya.\r\n  -> iPhone 13 Pro tahan tumpahan, cipratan, dan debu dan diuji dalam kondisi laboratorium terkontrol dengan level IP68 menurut standar IEC 60529. Ketahanan terhadap tumpahan, cipratan, dan debu tidak berlaku secara permanen. Daya tahan mungkin berkurang akibat penggunaan sehari-hari. Jangan coba mengisi daya iPhone yang basah; lihat panduan pengguna untuk instruksi pembersihan dan pengeringan. Kerusakan akibat cairan tidak ditanggung dalam garansi.\r\n  -> Beberapa fitur mungkin tidak tersedia untuk semua negara atau semua wilayah.\r\n  -> Aksesori dijual terpisah.\r\n\r\nSpesifikasi teknis\r\nKunjungi apple.com/iphone/compare untuk informasi selengkapnya.', 12, '089db24b0a8ecf2d1b223fa15153da99.jpeg', 'iPhone'),
(1294, 'Macbook Air M2', 15950000, 'Bertenaga super berkat chip M2 generasi berikutnya, MacBook Air yang didesain ulang menggabungkan performa andal dengan kekuatan baterai hingga 18 jam ke dalam penutup berbahan aluminium yang luar biasa tipis\r\n\r\n\r\n  -> Chip M2 dengan performa CPU, GPU, dan pembelajaran mesin generasi berikutnya\r\n  -> CPU 8-core dan GPU hingga 10-core yang lebih cepat untuk menjalankan berbagai tugas kompleks1\r\n  -> Neural Engine 16-core untuk berbagai tugas pembelajaran mesin canggih\r\n  -> Memori terintegrasi lebih cepat hingga 24 GB menjadikan segala yang Anda lakukan terasa lancar\r\n  -> Penerapan filter dan efek gambar hingga 20 persen lebih cepat\r\n  -> Pengeditan garis waktu video kompleks hingga 40 persen lebih cepat3\r\n  -> Lakukan banyak hal sepanjang hari dengan kekuatan baterai hingga 18 jam2\r\n  -> Desain tanpa kipas untuk pengoperasian yang senyap\r\n  -> Layar Liquid Retina 13,6 inci dengan kecerahan 500 nit dan warna luas P3 untuk gambar yang cemerlang dan detail luar biasa4\r\n  -> Kamera FaceTime HD 1080p dengan dua kali lipat resolusi dan performa dalam pencahayaan rendah\r\n  -> Deretan tiga mikrofon lebih mendengarkan Anda, bukan sekeliling Anda\r\n  -> Sistem suara empat speaker dengan Audio Spasial untuk pengalaman mendengarkan yang menghanyutkan\r\n  -> Berbagi konten dengan mulus antara iPhone dan Mac\r\n  -> Port pengisian daya MagSafe, dua port Thunderbolt, dan jek headphone\r\n  -> Magic Keyboard dengan lampu latar dan Touch ID untuk membuka kunci dan melakukan pembayaran dengan aman\r\n  -> Koneksi nirkabel Wi-Fi 6 yang kencang\r\n  -> Penyimpanan SSD super cepat membuka aplikasi dan file dalam sekejap\r\n  -> macOS Monterey memungkinkan Anda terhubung, berbagi, dan berkreasi dengan cara yang benar-benar baru — di semua perangkat Apple Anda\r\n  -> Tersedia dalam warna midnight, starlight, abu-abu, dan perak\r\n\r\nLegal\r\n\r\n\r\n  -> Tersedia opsi yang dapat dikonfigurasi.\r\n  -> Kekuatan baterai bervariasi tergantung penggunaan dan konfigurasi. Lihat apple.com/batteries untuk informasi selengkapnya.\r\n  -> Dibandingkan dengan generasi sebelumnya.\r\n  -> Layar MacBook Air 13,6 inci memiliki sudut melengkung di bagian atas. Jika diukur sebagai bentuk persegi standar, layarnya berukuran 13,6 inci secara diagonal (area bidang layar berukuran lebih kecil).', 10, 'a0cf786179ad42e9968b30be4ec0d576.jpg', 'Macbook'),
(1295, 'Apple Watch Series 8', 6499000, 'Apple Watch Series 8 dilengkapi aplikasi dan sensor kesehatan canggih, sehingga Anda dapat melakukan pengukuran EKG,1 detak jantung, dan kadar oksigen darah,2 serta memantau perubahan suhu3 untuk informasi mendalam tentang siklus menstruasi Anda.4 Dan dengan Deteksi Tabrakan, pemantauan tahap tidur, serta metrik olahraga canggih, Apple Watch Series 8 membantu Anda tetap aktif, sehat, selamat, dan terhubung.\r\n\r\n\r\n \r\nPoin-poin fitur utama\r\n\r\nSensor suhu3 memberikan perkiraan ovulasi retrospektif dan fitur pelacakan siklus lanjutan4\r\nUkur kadar oksigen darah Anda dengan sensor dan aplikasi andal2\r\nLakukan pengukuran EKG kapan saja, di mana saja1\r\nDapatkan pemberitahuan detak jantung rendah dan tinggi, serta ritme tidak teratur1\r\nFitur keselamatan canggih, termasuk Deteksi Jatuh, Darurat SOS,5 dan Deteksi Tabrakan\r\nAplikasi Olahraga yang disempurnakan dengan metrik dan cara berolahraga yang lebih canggih\r\nAplikasi Kompas yang didesain ulang sepenuhnya dengan titik jalan dan Runut Balik\r\nPantau aktivitas harian Anda melalui Apple Watch dan lihat tren Anda di aplikasi Kebugaran di iPhone\r\nKristal depan yang paling tahan retakan di Apple Watch, tahan debu dengan level IP6X dan desain yang siap dipakai berenang,6 serta ketahanan lebih baik untuk kegiatan dan kebugaran\r\nLakukan panggilan, kirim pesan teks dan email dengan beberapa ketukan saja\r\nDengarkan musik dan podcast favorit Anda (untuk digunakan dengan model GPS)\r\nLayar besar menyeluruh yang Selalu Aktif\r\nKekuatan baterai sepanjang hari dan pengisian daya cepat7\r\nPemantauan tahap tidur memungkinkan Anda melihat berapa banyak waktu yang Anda habiskan dalam fase REM, Tidur Inti, dan Tidur Lelap\r\nwatchOS 9 dilengkapi aplikasi Olahraga yang disempurnakan, aplikasi Pengobatan baru, Tahap Tidur, dan wawasan yang lebih luas tentang kesehatan jantung\r\nApple Watch hadir dengan 3 bulan gratis Apple Fitness+, dilengkapi 11 tipe olahraga berbeda, mulai dari  HIIT sampai Yoga, plus meditasi9\r\n\r\n\r\n\r\nSpesifikasi teknis\r\nKunjungi apple.com/watch/compare untuk informasi selengkapnya.\r\n\r\n\r\n \r\nLegal\r\nApple Watch Series 8 memerlukan iPhone 8 atau lebih baru dengan iOS 16 atau lebih baru.\r\n\r\nAplikasi EKG dan pemberitahuan ritme tidak teratur memerlukan watchOS dan iOS versi terbaru dan tidak untuk digunakan oleh orang berusia di bawah 22 tahun. Aplikasi EKG tersedia di Apple Watch Series 4 atau lebih baru (tidak termasuk Apple Watch SE). Pemberitahuan ritme tidak teratur tidak dirancang untuk orang yang didiagnosis fibrilasi atrium (AFib).\r\nPengukuran aplikasi Oksigen Darah bukan untuk tujuan medis, termasuk diagnosis mandiri atau konsultasi dengan dokter, dan hanya dirancang untuk tujuan kebugaran dan kesehatan secara umum.\r\nFitur sensor suhu bukanlah perangkat medis dan tidak ditujukan untuk digunakan dalam diagnosis medis, perawatan, atau untuk tujuan medis lainnya.\r\nAplikasi Pelacakan Siklus tidak ditujukan untuk digunakan dalam diagnosis medis, perawatan, atau tujuan medis apa pun, termasuk sebagai pengontrol kehamilan atau untuk membantu menentukan waktu konsepsi.\r\nDarurat SOS memerlukan panggilan Wi-Fi atau koneksi seluler dengan koneksi Internet dari Apple Watch Anda atau iPhone terdekat.\r\nApple Watch Series 8 memiliki level tahan air 50 meter menurut standar ISO 22810:2010. Artinya, bisa digunakan untuk aktivitas air dangkal seperti berenang di kolam renang atau di laut. Namun, Apple Watch Series 8 tidak boleh digunakan untuk scuba diving, ski air, atau aktivitas lainnya yang melibatkan air berkecepatan tinggi atau perendaman melebihi kedalaman dangkal. Ketahanan air bukanlah kondisi permanen dan dapat berkurang seiring waktu. Untuk informasi tambahan, lihat support.apple.com/en-us/HT205000.\r\nKekuatan baterai bervariasi tergantung penggunaan dan konfigurasi. Lihat apple.com/id/batteries untuk informasi selengkapnya.\r\nLayanan seluler memerlukan paket layanan nirkabel. Hubungi penyedia layanan Anda untuk detail lebih lanjut. Koneksi bervariasi berdasarkan ketersediaan jaringan. Kunjungi apple.com/watch/cellular untuk operator nirkabel yang berpartisipasi dan kelayakan. Lihat support.apple.com/en-us/HT207578 untuk petunjuk pengaturan tambahan.\r\nLangganan diperlukan untuk Apple Fitness+.', 7, '3a20c8b81372e9b99e68f9a11589a27b.jpg', 'iWatch'),
(1296, 'Iphone 13 Mini', 10999000, 'iPhone 13 mini. Sistem kamera ganda paling canggih yang pernah ada di iPhone. Chip A15 Bionic yang secepat kilat. Lompatan dalam kekuatan baterai. Desain kokoh. Dan layar Super Retina XDR yang lebih cerah.\r\n\r\n\r\n>>Poin-poin fitur utama\r\n\r\n  -> Layar Super Retina XDR 5,4 inci1\r\n  -> Mode Sinematik menambahkan kedalaman bidang yang dangkal dan pindah fokus secara otomatis di video Anda\r\n  -> Sistem kamera ganda canggih dengan kamera Wide dan Ultra Wide 12 MP; Gaya Fotografi, Smart HDR 4, mode Malam, perekaman HDR 4K Dolby Vision\r\n  -> Kamera depan TrueDepth 12 MP dengan mode Malam, perekaman HDR 4K Dolby Vision\r\n  -> Chip A15 Bionic untuk performa secepat kilat\r\n  -> Pemutaran video hingga 17 jam2\r\n  -> Desain kokoh dengan Ceramic Shield\r\n  -> Level ketahanan air IP68 terdepan di industri3\r\n  -> iOS 15 dilengkapi berbagai fitur baru untuk melakukan lebih banyak hal dengan iPhone4\r\n  -> Mendukung aksesori MagSafe untuk kemudahan pemasangan dan pengisian daya nirkabel yang lebih cepat5\r\n\r\n>>Legal\r\n\r\n  -> Layar memiliki sudut melengkung yang mengikuti desain lekukan yang indah, dan semua sudut ini berada di dalam bidang persegi standar. Jika diukur sebagai bentuk persegi standar, layarnya memiliki ukuran diagonal 5,42 inci. Area bidang layar berukuran lebih kecil.\r\n  -> Kekuatan baterai bervariasi tergantung penggunaan dan konfigurasi. Lihat apple.com/batteries untuk informasi selengkapnya.\r\n  -> iPhone 13 mini tahan tumpahan, cipratan, dan debu dan diuji dalam kondisi laboratorium terkontrol dengan level IP68 menurut standar IEC 60529. Ketahanan terhadap tumpahan, cipratan, dan debu tidak berlaku secara permanen. Daya tahan mungkin berkurang akibat penggunaan sehari-hari. Jangan coba mengisi daya iPhone yang basah; lihat panduan pengguna untuk instruksi pembersihan dan pengeringan. Kerusakan akibat cairan tidak ditanggung dalam garansi.\r\n  -> Beberapa fitur mungkin tidak tersedia untuk semua negara atau semua wilayah.\r\n  -> Aksesori dijual terpisah.\r\n\r\nSpesifikasi teknis\r\nKunjungi apple.com/iphone/compare untuk informasi selengkapnya.', 7, '3489bac5ea4d52b7ed657d717c4c8272.jpeg', 'iPhone'),
(1297, 'iPhone 14 Pro Max', 18999000, 'iPhone 14 Pro Max. Memotret detail menakjubkan dengan kamera Utama 48 MP. Nikmati iPhone dalam cara yang sepenuhnya baru dengan layar yang Selalu Aktif dan Dynamic Island. Deteksi Tabrakan,1 sebuah fitur keselamatan baru, memanggil bantuan saat Anda tak bisa.\r\n\r\n\r\n\r\n>>Poin-poin fitur utama\r\n\r\n  -> Layar Super Retina XDR 6,7 inci2 yang Selalu Aktif dan dilengkapi ProMotion\r\n  -> Dynamic Island, cara baru yang istimewa untuk berinteraksi dengan iPhone\r\n  -> Kamera utama 48 MP untuk resolusi hingga 4x lebih besar\r\n  -> Mode Sinematik kini dalam Dolby Vision 4K pada kecepatan hingga 30 fps\r\n  -> Mode Aksi untuk video handheld yang stabil\r\n  -> Teknologi keselamatan penting—Deteksi Tabrakan,1 memanggil bantuan saat Anda tak bisa\r\n  -> Kekuatan baterai sepanjang hari dan pemutaran video hingga 29 jam3\r\n  -> A16 Bionic, chip ponsel pintar paling maksimal. Seluler 5G super cepat4\r\n  -> Fitur ketahanan terdepan di industri dengan Ceramic Shield dan tahan air5\r\n  -> iOS 16 menawarkan semakin banyak cara untuk personalisasi, komunikasi, dan berbagi6\r\n\r\n\r\n\r\nLegal\r\n\r\n  -> Darurat SOS menggunakan Panggilan Wi-Fi atau koneksi seluler.\r\n  -> Layar memiliki sudut melengkung. Jika diukur sebagai persegi, layarnya memiliki ukuran diagonal 6,69 inci. Area bidang layar berukuran lebih kecil.\r\n  -> Kekuatan baterai bervariasi tergantung penggunaan dan konfigurasi; lihat apple.com/batteries untuk informasi selengkapnya.\r\n  -> Memerlukan paket data. 5G tersedia di pasar tertentu dan melalui operator tertentu. Kecepatan bervariasi menurut kondisi lokasi dan operator. Untuk detail tentang dukungan 5G, hubungi operator Anda dan lihat apple.com/iphone/cellular.\r\n  -> iPhone 14 Pro Max tahan cipratan, air, dan debu dan diuji dalam kondisi laboratorium terkontrol dengan level IP68 menurut standar IEC 60529 (kedalaman maksimum 6 meter hingga selama 30 menit). Ketahanan terhadap cipratan, air, dan debu tidak berlaku secara permanen. Daya tahan mungkin berkurang akibat penggunaan sehari-hari. Jangan coba mengisi daya iPhone yang basah; lihat panduan pengguna untuk instruksi pembersihan dan pengeringan. Kerusakan akibat cairan tidak ditanggung dalam garansi.\r\n  -> Beberapa fitur mungkin tidak tersedia untuk semua negara atau semua wilayah.', 10, '800a61e3e603c7210f3d0ff52b819b9b.jpg', 'iPhone'),
(1298, 'iPhone 14 Plus', 14999000, 'iPhone 14 Plus. Tuangkan lebih banyak kreativitas dengan layar besar 6,7 inci1 dan kekuatan baterai sepanjang hari.2 Ambil foto yang memukau dalam pencahayaan rendah maupun terang dengan sistem kamera ganda baru. Deteksi Tabrakan,(3) sebuah fitur keselamatan baru, memanggil bantuan saat Anda tak bisa.\r\n\r\n\r\n\r\n>>Poin-poin fitur utama\r\n\r\n  -> Layar Super Retina XDR 6,7 inci1\r\n  -> Sistem kamera canggih untuk foto yang lebih baik dalam berbagai kondisi pencahayaan\r\n  -> Mode Sinematik kini dalam Dolby Vision 4K pada kecepatan hingga 30 fps\r\n  -> Mode Aksi untuk video handheld yang stabil\r\n  -> Teknologi keselamatan penting—Deteksi Tabrakan,3memanggil bantuan saat Anda tak bisa\r\n  -> Kekuatan baterai sepanjang hari dan pemutaran video hingga 26 jam2\r\n  -> Chip A15 Bionic dengan GPU 5-core untuk performa secepat kilat. Seluler 5G super cepat4\r\n  -> Fitur ketahanan terdepan di industri dengan Ceramic Shield dan tahan air5\r\n  -> iOS 16 menawarkan semakin banyak cara untuk personalisasi, komunikasi, dan berbagi6\r\n\r\n\r\n>>Legal\r\n\r\n  -> Layar memiliki sudut melengkung. Jika diukur sebagai bentuk persegi standar, layarnya memiliki ukuran diagonal 6,68 inci. Area bidang layar berukuran lebih kecil.\r\n  -> Kekuatan baterai bervariasi tergantung penggunaan dan konfigurasi; lihat apple.com/batteries untuk informasi selengkapnya.\r\n  -> Darurat SOS menggunakan Panggilan Wi-Fi atau koneksi seluler.\r\n  -> Memerlukan paket data. 5G tersedia di pasar tertentu dan melalui operator tertentu. Kecepatan bervariasi menurut kondisi lokasi dan operator. Untuk detail tentang dukungan 5G, hubungi operator Anda dan lihat apple.com/iphone/cellular.\r\n  -> iPhone 14 Plus tahan cipratan, air, dan debu dan diuji dalam kondisi laboratorium terkontrol dengan level IP68 menurut standar IEC 60529 (kedalaman maksimum 6 meter hingga selama 30 menit). Ketahanan terhadap cipratan, air, dan debu tidak berlaku secara permanen. Daya tahan mungkin berkurang akibat penggunaan sehari-hari. Jangan coba mengisi daya iPhone yang basah; lihat panduan pengguna untuk instruksi pembersihan dan pengeringan. Kerusakan akibat cairan tidak ditanggung dalam garansi.\r\n  -> Beberapa fitur mungkin tidak tersedia untuk semua negara atau semua wilayah.', 5, 'd86356f43953e96620cd98db66951aeb.jpg', 'iPhone'),
(1299, 'iPad Pro (Generasi ke-6)', 14999000, 'iPad Pro. Dengan performa yang menakjubkan, konektivitas nirkabel super cepat, dan pengalaman Apple Pencil generasi berikutnya. Ditambah, fitur produktivitas dan kolaborasi baru yang andal di iPadOS 16. iPad Pro adalah pengalaman iPad terbaik.\r\n\r\n\r\n\r\n>> Poin-poin fitur utama\r\n\r\n  -> Layar Liquid Retina 12,9 inci atau 11 inci cemerlang1 dengan ProMotion, True Tone, dan warna luas P3\r\n  -> Chip M2 dengan CPU 8-core dan GPU 10-core\r\n  -> Kamera Wide 12 MP, kamera belakang Ultra Wide 10 MP, dan LiDAR Scanner untuk AR yang imersif\r\n  -> Kamera depan Ultra Wide 12 MP dengan Center Stage\r\n  -> Tetap terhubung dengan Wi-Fi 6E2 ultra cepat dan LTE3\r\n  -> Konektor USB-C dengan dukungan untuk Thunderbolt/USB\r\n  -> Face ID untuk autentikasi aman\r\n  -> Selangkah lebih maju dengan kekuatan baterai sepanjang hari4\r\n  -> Berfungsi dengan Apple Pencil (generasi ke-2), Magic Keyboard, dan Smart Keyboard Folio\r\n  -> Mendukung fitur layang Apple Pencil untuk sketsa dan goresan yang lebih presisi\r\n  -> iPadOS 16 menjadikan iPad semakin andal dengan fitur produktivitas dan kolaborasi baru yang luar biasa\r\n\r\n\r\n\r\nLegal\r\n\r\nAksesori dijual terpisah dan tergantung ketersediaan. Kompatibilitas bervariasi berdasarkan generasi. Aplikasi tersedia di App Store. Ketersediaan judul dapat berubah sewaktu-waktu. Perangkat lunak pihak ketiga dijual terpisah.\r\n\r\n  -> Layar memiliki sudut melengkung. Jika diukur sebagai persegi, layar iPad Pro 12,9 atau 11 inci memiliki ukuran diagonal 12,9 inci atau 11 inci. Area bidang layar berukuran lebih kecil\r\n  -> Wi-Fi 6E tidak tersedia di Tiongkok daratan dan Jepang.\r\n  -> Memerlukan paket data. Untuk lebih jelasnya, tanyakan kepada operator Anda. Kecepatan bervariasi menurut kondisi lokasi.\r\n  -> Kekuatan baterai bervariasi tergantung penggunaan dan konfigurasi. Lihat apple.com/batteries untuk informasi selengkapnya.', 3, 'e5d68a5deb1b49dde24628432b9aff7b.jpg', 'iPad'),
(1300, 'Apple Watch Nike SE', 3499000, 'Dengan Apple Watch Nike SE, Anda dapat melacak olahraga dengan aplikasi Nike Run Club. Selaraskan musik sebagai motivasi ke jam tangan Anda. Aktifkan Twilight Mode Nike untuk visibilitas yang lebih baik.1 Dan pilih wajah dan tali jam Nike eksklusif.\r\n\r\nPoin-poin fitur utama\r\n• Aplikasi Nike Run Club\r\n• Tali Jam Sport Nike dan Loop Sport Nike dengan warna baru\r\n• Wajah jam Nike baru dan lebih mudah disesuaikan\r\n• Model GPS memungkinkan Anda menjawab panggilan dan membalas teks dari pergelangan tangan Anda\r\n• Layar Retina OLED yang besar\r\n• Prosesor hingga 2x lebih cepat dibandingkan Series 3\r\n• Pantau aktivitas harian Anda melalui Apple Watch dan lihat tren Anda di aplikasi Kebugaran di iPhone\r\n• Ukur olahraga seperti berlari, berjalan, bersepeda, yoga, berenang, dan menari\r\n• Desain siap dipakai berenang2\r\n• Periksa detak jantung Anda kapan saja dengan aplikasi Detak Jantung\r\n• Dapatkan pemberitahuan untuk detak jantung tinggi dan rendah\r\n• Selaraskan musik dan podcast favorit Anda\r\n• Kompas bawaan dan pembacaan ketinggian secara real time\r\n• Mampu mendeteksi apabila Anda terjatuh dengan keras dan akan menghubungi layanan panggilan darurat secara otomatis untuk Anda\r\n• Panggilan darurat SOS membantu Anda mendapatkan bantuan melalui pergelangan tangan Anda3\r\n• watchOS 7 dengan pemantauan tidur, petunjuk arah bersepeda, dan wajah jam baru yang dapat disesuaikan\r\n• Casing aluminium\r\n\r\nLegal\r\nApple Watch SE memerlukan iPhone 6s atau lebih baru dengan iOS 14 atau lebih baru.\r\n1Tidak dimaksudkan untuk digunakan sebagai Alat Pelindung Diri (APD).\r\n2Standar ISO 22810:2010. Sesuai untuk aktivitas air dangkal seperti berenang. Tidak disarankan untuk perendaman melebihi kedalaman dangkal dan aktivitas air berkecepatan tinggi.\r\n3Agar dapat melakukan Panggilan darurat SOS, iPhone Anda harus berada dalam jarak dekat. Jika tidak, Apple Watch perlu terhubung ke jaringan Wi-Fi yang dikenal dan Anda perlu mengatur Panggilan Wi-Fi.', 3, '8a012839efb23eb6e871f5dd542bcd98.jpg', 'iWatch');

-- --------------------------------------------------------

--
-- Table structure for table `tb_review`
--

CREATE TABLE `tb_review` (
  `id_review` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` varchar(300) NOT NULL,
  `id_pesanan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`id_det`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `fk_orders_detail_orders` (`id_pesanan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pem`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_notif`
--
ALTER TABLE `tb_notif`
  ADD PRIMARY KEY (`id_notif`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `tb_notif_admin`
--
ALTER TABLE `tb_notif_admin`
  ADD PRIMARY KEY (`id_notif_admin`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- Indexes for table `tb_orders_temp`
--
ALTER TABLE `tb_orders_temp`
  ADD PRIMARY KEY (`id_order_temp`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `tb_pengiriman`
--
ALTER TABLE `tb_pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- Indexes for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `tb_review`
--
ALTER TABLE `tb_review`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `id_produk` (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `id_det` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1012;

--
-- AUTO_INCREMENT for table `tb_notif`
--
ALTER TABLE `tb_notif`
  MODIFY `id_notif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11257;

--
-- AUTO_INCREMENT for table `tb_notif_admin`
--
ALTER TABLE `tb_notif_admin`
  MODIFY `id_notif_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28990;

--
-- AUTO_INCREMENT for table `tb_orders_temp`
--
ALTER TABLE `tb_orders_temp`
  MODIFY `id_order_temp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=904;

--
-- AUTO_INCREMENT for table `tb_pengiriman`
--
ALTER TABLE `tb_pengiriman`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1301;

--
-- AUTO_INCREMENT for table `tb_review`
--
ALTER TABLE `tb_review`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD CONSTRAINT `fk_orders_detail_orders` FOREIGN KEY (`id_pesanan`) REFERENCES `orders` (`id_pesanan`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_detail_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `tb_pelanggan` (`id_pelanggan`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_detail_ibfk_3` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`) ON DELETE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `orders` (`id_pesanan`) ON DELETE CASCADE;

--
-- Constraints for table `tb_notif`
--
ALTER TABLE `tb_notif`
  ADD CONSTRAINT `tb_notif_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `tb_pelanggan` (`id_pelanggan`);

--
-- Constraints for table `tb_notif_admin`
--
ALTER TABLE `tb_notif_admin`
  ADD CONSTRAINT `tb_notif_admin_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `orders` (`id_pesanan`);

--
-- Constraints for table `tb_orders_temp`
--
ALTER TABLE `tb_orders_temp`
  ADD CONSTRAINT `tb_orders_temp_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_orders_temp_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `tb_pelanggan` (`id_pelanggan`) ON DELETE CASCADE;

--
-- Constraints for table `tb_pengiriman`
--
ALTER TABLE `tb_pengiriman`
  ADD CONSTRAINT `tb_pengiriman_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `orders` (`id_pesanan`) ON DELETE CASCADE;

--
-- Constraints for table `tb_review`
--
ALTER TABLE `tb_review`
  ADD CONSTRAINT `tb_review_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `orders` (`id_pesanan`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_review_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
