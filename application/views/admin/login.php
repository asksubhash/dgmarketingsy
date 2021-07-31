<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
     <link rel="stylesheet" href="<?= base_url()?>public/admin/css/bootstrap.min.css">
     <link rel="stylesheet" href="<?= base_url()?>public/admin/css/AdminLTE.min.css">
     <link rel="stylesheet" href="<?= base_url()?>public/admin/plugins/font_awesome-pro/css/all.css">
     <link rel="stylesheet" href="<?= base_url()?>public/admin/css/style.css">
     <link rel="stylesheet" href="<?= base_url()?>public/admin/plugins/toast/toastr.css">
     <script src="<?= base_url()?>public/admin/js/jquery.min.js"></script>
     <script src="<?= base_url()?>public/admin/plugins/toast/toastr.js"></script>
   
</head>

<body>

    <div class="login-box ">
        <div class="login-logo"> <a href="#"><b>Admin Panel, Log in </b> </a> </div>
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to access your data</p>

            <?php if(!empty($this->session->flashdata('msg'))): ?>
                <script type="text/javascript">
                    toastr["<?php echo $this->session->flashdata('icon'); ?>"]("<?php echo $this->session->flashdata('msg'); ?>")
                </script>
            <?php endif; ?>


            <form method="POST" action="<?= base_url().'admin/login/authenticate'?>" autocomplete="off" >

                <div class="form-group has-feedback">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" />
                    <span class="fa fa-envelope form-control-feedback"></span>
                    <span class="text-danger"><?php echo form_error('email');?></span>

                </div>

                <div class="form-group has-feedback">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" autocomplete="off" />
                    <span class="fa fa-lock form-control-feedback"></span>
                    <span class="text-danger"><?php echo form_error('password');?></span>

                </div>

                <div class="row">
                    <div class="col-xs-12 text-center">
                        <input type="submit" class="btn btn-primary btn-flat" name="submit">
                    </div>
                </div>
            </form>
            <br>

        </div>
    </div>
</body>



</html>