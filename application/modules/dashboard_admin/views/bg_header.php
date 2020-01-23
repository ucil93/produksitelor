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
        <meta content="Preview page of Metronic Admin Theme #1 for statistics, charts, recent events and reports" name="description" />
        <meta content="" name="author" />

        <!-- MULAI TAMBAHAN -->
        <script type="text/javascript" src="<?php echo base_url().'assets/new/js/jquery-1.11.3.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo base_url().'assets/new/js/1.10.3/jquery-ui.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo base_url().'assets/global/plugins/jquery.table2excel.js'; ?>"></script>
        <!-- SELESAI TAMBAHAN -->
        
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" /> -->
        <link href="<?php echo base_url().'assets/global/plugins/font-awesome/css/font-awesome.min.css'; ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url().'assets/global/plugins/simple-line-icons/simple-line-icons.min.css'; ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url().'assets/global/plugins/bootstrap/css/bootstrap.min.css'; ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url().'assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css'; ?>" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url().'assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css'; ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url().'assets/global/plugins/morris/morris.css'; ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url().'assets/global/plugins/fullcalendar/fullcalendar.min.css'; ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url().'assets/global/plugins/jqvmap/jqvmap/jqvmap.css'; ?>" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->

        <!-- MULAI TAMBAHAN -->
        <link href="<?php echo base_url().'assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css'; ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url().'assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css'; ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url().'assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css'; ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url().'assets/global/plugins/clockface/css/clockface.css'; ?>" rel="stylesheet" type="text/css" />
        <!-- SELESAI TAMBAHAN -->
        <!-- MULAI TAMBAHAN -->
        <link href="<?php echo base_url().'assets/global/plugins/datatables/datatables.min.css'; ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url().'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css'; ?>" rel="stylesheet" type="text/css" />
        <!-- SELESAI TAMBAHAN -->
        <!-- MULAI TAMBAHAN -->
        <link href="<?php echo base_url().'assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css'; ?>" rel="stylesheet" type="text/css" />
        <!-- SELESAI TAMBAHAN -->
        <!-- MULAI TAMBAHAN -->
        <link href="<?php echo base_url().'assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css'; ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url().'assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css'; ?>" rel="stylesheet" type="text/css" />
        <!-- SELESAI TAMBAHAN -->
        
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo base_url().'assets/global/css/components.min.css'; ?>" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url().'assets/global/css/plugins.min.css'; ?>" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?php echo base_url().'assets/layouts/layout/css/layout.min.css'; ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url().'assets/layouts/layout/css/themes/darkblue.min.css'; ?>" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo base_url().'assets/layouts/layout/css/custom.min.css'; ?>" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="<?php echo base_url().'favicon.ico'; ?>" /> </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <div class="page-wrapper">
            <!-- BEGIN HEADER -->
            <div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <!-- <a href="index.html">
                            <img src="<?php echo base_url().'assets/layouts/layout/img/logo.png'; ?>" alt="logo" class="logo-default" /> </a> -->
                        <div class="menu-toggler sidebar-toggler">
                            <span></span>
                        </div>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                        <span></span>
                    </a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN NOTIFICATION DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after "dropdown-extended" to change the dropdown styte -->
                            <!-- DOC: Apply "dropdown-hoverable" class after below "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                            <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
                            
                            <!-- END NOTIFICATION DROPDOWN -->
                            <!-- BEGIN INBOX DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            
                            <!-- END INBOX DROPDOWN -->
                            <!-- BEGIN TODO DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            
                            <!-- END TODO DROPDOWN -->
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <span class="username username-hide-on-mobile"> <?php echo $username; ?> </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                        <a data-target="#ubahpassword" data-toggle="modal">
                                        <i class="icon-user"></i> Rubah Password </a>

                                        <div id="ubahpassword" class="modal fade modalInput" tabindex="-1"  data-backdrop="static" data-keyboard="false">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h4 class="modal-title">Rubah Password</h4>
                                              </div>
                                              <div class="modal-body">
                                                <div class="form-group form-md-line-input has-success form-md-floating-label">
                                                    <input type="password" id="passwordlama" name="passwordlama" value="" class="form-control">
                                                    <label for="form_control_1">Password Lama</label>
                                                    <span class="help-block">Masukkan Password Lama</span>
                                                </div>
                                                <div class="form-group form-md-line-input has-success form-md-floating-label">
                                                    <input type="password" id="passwordbaru" name="passwordbaru" value="" class="form-control">
                                                    <label for="form_control_1">Password Baru</label>
                                                    <span class="help-block">Masukkan Password Baru</span>
                                                </div>
                                                <div class="form-group form-md-line-input has-success form-md-floating-label">
                                                    <input type="password" id="passwordbaru2" name="passwordbaru2" value="" class="form-control">
                                                    <label for="form_control_1">Konfirmasi Password Baru</label>
                                                    <span class="help-block">Masukkan Konfirmasi Password Baru</span>
                                                </div>
                                                <span class="input-group-btn btn-left">

                                                  <input type=button class="btn blue-madison" id="show" value="Show Password" onclick="ShowPassword()">
                                                  <input type=button class="btn blue-madison" style="display:none" id="hide" value="Hide Password" onclick="HidePassword()">
                                                </span>
                                                <br/>
                                                  <div id="alert-msg-ubahpass"></div>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                <button type="button" class="btn green" id="ubahpass" name="ubahpass">Simpan</button>
                                              </div>
                                          </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('login/logout') ?>">
                                            <i class="icon-key"></i> Keluar </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                            <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                           
                            <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END HEADER INNER -->
            </div>
            <!-- END HEADER -->
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->