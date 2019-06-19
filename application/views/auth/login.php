

<div class="login-box">
  <div class="login-logo">
    <img src="<?= base_url('assets/'); ?>" alt="">
    <h3><b>SISTEM INFORMASI LABORATORIUM</b></h3>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Silahkan login untuk memulai</p>

    <?= $this->session->flashdata('message'); ?>

    <form action="<?= base_url('auth'); ?>" method="post">
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
      </div>
      <div class="row">
        
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    
    <a href="#">Lupa password</a><br>
    <a href="<?= base_url('auth/register'); ?>" class="text-center">Daftar member baru</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

