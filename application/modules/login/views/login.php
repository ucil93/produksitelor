<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Website</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #1 for " name="description" />
        <meta content="" name="author" />
        <!-- MULAI TAMABAHAN -->
        <script type="text/javascript" src="<?php echo base_url().'assets/new/js/jquery-1.11.3.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo base_url().'assets/new/js/1.10.3/jquery-ui.js'; ?>"></script>
        <!-- SELESAI TAMABAHAN -->
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" /> -->
        <link href="<?php echo base_url().'assets/global/plugins/font-awesome/css/font-awesome.min.css'; ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url().'assets/global/plugins/simple-line-icons/simple-line-icons.min.css'; ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url().'assets/global/plugins/bootstrap/css/bootstrap.min.css'; ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url().'assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css'; ?>" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url().'assets/global/plugins/select2/css/select2.min.css'; ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url().'assets/global/plugins/select2/css/select2-bootstrap.min.css'; ?>" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo base_url().'assets/global/css/components.min.css'; ?>" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url().'assets/global/css/plugins.min.css'; ?>" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?php echo base_url().'assets/pages/css/login-2.min.css'; ?>" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="<?php echo base_url().'favicon.ico'; ?>" /> </head>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN : LOGIN PAGE 5-2 -->
        <div class="logo">
            <!-- <a href="index.html"> -->
                <!-- <img src="<?php echo base_url().'assets/pages/img/logo-big-white.png'; ?>" style="height: 17px;" alt="" /> </a> -->
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <?php echo form_open("login/act", array('class' => 'login-form', 'method' => 'post')); ?>
                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger">
                        <button class="close" data-close="alert"></button>
                        <?= $error ?>
                    </div>
                <?php endif; ?>
                <div class="form-title">
                    <span class="form-title">Selamat Datang.</span>
                    <span class="form-subtitle">Silahkan Masuk.</span>
                </div>
                <?php if (isset($error)) : ?>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                        <?= $error ?>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Pengguna</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Pengguna" name="username" requierd/> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Kata Sandi</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Kata Sandi" name="password" requierd/> </div>
                <div class="form-actions">
                    <button type="submit" class="btn red btn-block uppercase">Masuk</button>
                </div>
            <?php echo form_close(); ?>
        </div>
        <?php $tahun = date('Y'); ?>
        <div class="copyright"> <?php echo $tahun; ?> © Teknologi Informasi. </div>
        <!-- END : LOGIN PAGE 5-2 -->
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script>
<script src="../assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->

        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo base_url().'assets/global/plugins/jquery.min.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo base_url().'assets/global/plugins/bootstrap/js/bootstrap.min.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo base_url().'assets/global/plugins/js.cookie.min.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo base_url().'assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo base_url().'assets/global/plugins/jquery.blockui.min.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo base_url().'assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js'; ?>" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url().'assets/global/plugins/jquery-validation/js/jquery.validate.min.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo base_url().'assets/global/plugins/jquery-validation/js/additional-methods.min.js'; ?>" type="text/javascript"></script>
        <script src="<?php echo base_url().'assets/global/plugins/select2/js/select2.full.min.js'; ?>" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url().'assets/global/scripts/app.min.js'; ?>" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url().'assets/pages/scripts/login.min.js'; ?>" type="text/javascript"></script>

        <script type="text/javascript">
            var base_url = "<?php echo base_url(); ?>";
        </script>
    </body>

</html>
