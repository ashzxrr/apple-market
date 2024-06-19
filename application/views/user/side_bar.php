<style>
    .sidebar {
        height: 100%;
        width: 200px;
        position: fixed;
        background: linear-gradient(to bottom, #E6E6FA, #DFC5F5);
        
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        
    }

    .sidebar a {
        padding: 8px 8px 8px 25px;
        text-decoration: none;
        font-size: 15px;
        color: #818181;
        display: block;
        transition: 0.3s;
    }

    .sidebar a i {
        margin-right: 8px;
    }

    .sidebar a:hover {
        color: black;
    }

    .content {
        margin-left: 200px;
        padding: 16px;
    }

    .submenu {
        padding-left: 32px;
    }

    .sidebar.collapsed {
        margin-left: -60px;
    }

    .sidebar.collapsed a span {
        display: none;
    }

    @media screen and (max-width: 600px) {
        .sidebar {
            width: 60px;
        }

        .sidebar a {
            padding: 15px;
            text-align: center;
        }

        .sidebar a span {
            display: none;
        }

        .sidebar a i {
            margin-right: 0;
        }

        .content {
            margin-left: 60px;
            margin-top: 60px; /* Adjusted margin for the top navigation bar */
            transition: margin-left 0.3s;
        }

        .submenu {
            padding-left: 15px;
        }

        /* Hide the sidebar when not in use */
        .sidebar.collapsed {
            margin-left: -60px;
        }
    }
    
    

</style>

<div class="sidebar">
    <a href="<?= base_url('user/data_user');?>" title="Akun Saya"><i class="fas fa-user"></i><span>Akun Saya</span></a>
    <div class="submenu">
        <a href="<?= base_url('user/chg_pass');?>" title="Ganti Password"><i class="fas fa-lock"></i><span>Ganti Password</span></a>
        <a href="<?= base_url('user/chg_pp');?>" title="Ganti Foto"><i class="far fa-image"></i><span>Ganti Foto</span></a>
    </div>
    <a href="<?= base_url('user/pesanan_full');?>" title="Pesanan"><i class="fas fa-shopping-cart"></i><span>Pesanan</span></a>
    <div class="submenu">
        <a href="<?= base_url('user/wait');?>" title="Menunggu Pembayaran"><i class="fas fa-clock"></i><span>Menunggu Pembayaran</span></a>
        <a href="<?= base_url('user/dikemas');?>" title="Dikemas"><i class="fas fa-box"></i><span>Dikemas</span></a>
        <a href="<?= base_url('user/dikirim');?>" title="Dikirim"><i class="fas fa-truck"></i><span>Dikirim</span></a>
        <a href="<?= base_url('user/selesai');?>" title="Selesai"><i class="fas fa-check-circle"></i><span>Selesai</span></a>
    </div>
    <a href="#" title="Riwayat Pesanan"><i class="fas fa-history"></i><span>Riwayat Pesanan</span></a>
</div>

<script>
    function toggleSidebar() {
        var sidebar = document.querySelector('.sidebar');
        var content = document.querySelector('.content');
        sidebar.classList.toggle('collapsed');
        content.classList.toggle('collapsed-sidebar');
    }
</script>