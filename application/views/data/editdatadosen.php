<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Edit Data User
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Master Data</a></li>
                <li class="active">Edit Data User</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="box box-default">

                <div class="box-body">
                    <form action="<?= base_url('admin/updateUser'); ?>" method="post">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <div class="form-group">
                            <label for="name">Nama User</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $name ?>">

                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?= $email ?>">

                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>


                        <a href="<?= base_url('admin/datauser'); ?>" class="btn btn-warning">Batal</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.container -->
</div>