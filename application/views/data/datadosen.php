  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              Data User
          </h1>
          <ol class="breadcrumb">
              <li><a href="<?= base_url('admin'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="#">Master Data</a></li>
              <li class="active">Data User</li>
          </ol>
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="row">
              <div class="col-xs-12">

                  <div class="box">
                      <div class="box-header">
                          <h3 class="box-title">Data User</h3>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                          <?= $this->session->flashdata('user');
                            ?>
                          <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Tambah User</a>
                          <br />
                          <br />
                          <table id="example1" class="table table-bordered table-striped table-hover">
                              <thead>
                                  <tr>
                                      <th>No.</th>
                                      <th>Nama User</th>
                                      <th>Role</th>
                                      <th>Aksi</th>

                                  </tr>
                              </thead>
                              <tbody>
                                  <?php foreach ($stat->result() as $k) { ?>

                                      <tr>
                                          <td><?= $k->id; ?></td>
                                          <td><?= $k->name; ?></td>
                                          <td><?= $k->email; ?></td>
                                          <td><a href="<?= base_url(); ?>admin/detiluser/<?= $k->id; ?> " class="btn btn-info btn-xs"> <i class="fa fa-search"></i> </a> | <a href="<?= base_url(); ?>admin/editUser/<?= $k->id; ?>" class="btn btn-warning btn-xs"> <i class="fa fa-edit "></i> </a> | <a href="<?= base_url(); ?>admin/deleteUser/<?= $k->id; ?>" class="btn btn-danger btn-xs"> <i class="fa fa-minus-circle"></i> </a> </td>

                                      </tr>
                                  <?php } ?>
                              </tbody>
                          </table>
                      </div>
                      <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
              </div>
              <!-- /.col -->
          </div>
          <!-- /.row -->
          <!-- Button trigger modal -->




      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
      function validasi() {
          var nama = document.getElementById("name").value;
          var email = document.getElementById("email").value;

          if (nama != "" && email != "") {
              return true;
          } else {
              alert('Anda harus mengisi data dengan lengkap !');
              return false;
          }
      }
  </script>

  <div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="newMenuModalLabel">Form Tambah User</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <form action="<?= base_url('admin/addUser'); ?>" method="post" onsubmit="return validasi()">
                  <div class="modal-body">
                      <div class="form-group">
                          <input type="text" class="form-control" id="name" name="name" placeholder="Nama User">
                          <?= form_error('name'); ?>
                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control" id="email" name="email" placeholder="Email User">
                          <?= form_error('email'); ?>
                      </div>

                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Add</button>
                  </div>
              </form>
          </div>
      </div>
  </div>