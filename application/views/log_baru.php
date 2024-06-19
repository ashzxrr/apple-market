<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="<?= base_url('assets/style_log2.css'); ?>" />
    <title>Login & Daftar</title>
    <link rel="website icon"href="<?= base_url('upload/ic/apple_logo_icon_147318.ico')?>"/>

  </head>
  <body>
  <?php if($this->session->flashdata('success')): ?>
                <div class="message <?= $this->session->flashdata('message_type'); ?>">
                    <?= $this->session->flashdata('success'); ?>
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                </div>
            <?php endif; ?>
            
            <?php if($this->session->flashdata('error_akses')): ?>
                <div class="message <?= $this->session->flashdata('message_type'); ?>">
                    <?= $this->session->flashdata('error_akses'); ?>
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                </div>
            <?php endif; ?>

    <div class="container">

      <div class="forms-container"> 
        <div class="signin-signup">
          <form action="<?php echo base_url('login-process'); ?>" method="post" class="sign-in-form">
            <h2 class="title">Sign in</h2>

            <?php if($this->session->flashdata('error')): ?>
                <div class="message <?= $this->session->flashdata('message_type'); ?>">
                    <?= $this->session->flashdata('error'); ?>
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                </div>
            <?php endif; ?>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="username" placeholder="Username" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" placeholder="Password" />
            </div>
            <input type="submit" value="Login" name="login" class="btn solid" />
          </form>
          <!-- form daftar -->
          <form action="<?= base_url('login/daftar_baru') ?>" method="post" class="sign-up-form">
            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name ="nama" placeholder="Nama Lengkap" />
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name ="username" placeholder="Username" />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" name="email" placeholder="Email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name = "password" placeholder="Password" />
            </div>
            <div class="input-field">
              <i class="fas fa-home"></i>
              <input type="text" name ="alamat" placeholder="Alamat" />
            </div>
            <div class="input-field">
              <i class="fas fa-phone"></i>
              <input type="text" name ="telepon" placeholder="No. Telepon" />
            </div>
            <input type="submit" class="btn" value="Sign up" />
          </form>
          
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here ?</h3>
            <p>
                Sign up and start your journey with us now! 
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="<?= base_url('upload/img/log.svg')?>" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>One of us ?</h3>
            <p>
                Login to access your account
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="<?= base_url('upload/img/register.svg')?>" class="image" alt="" />
        </div>
      </div>
    </div>
    <script src="<?= base_url('assets/js/app.js');?>"></script>
  </body>
</html>
