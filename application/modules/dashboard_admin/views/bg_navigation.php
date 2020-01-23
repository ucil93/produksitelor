            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
                <div class="page-sidebar-wrapper">
                    <!-- BEGIN SIDEBAR -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <div class="page-sidebar navbar-collapse collapse">
                        <!-- BEGIN SIDEBAR MENU -->
                        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <li class="sidebar-toggler-wrapper hide">
                                <div class="sidebar-toggler">
                                    <span></span>
                                </div>
                            </li>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                            <?php if($grup_anggota == "ADMIN") { ?>
                                <li class="nav-item <?php echo $active_dashboard_admin?>">
                                    <a href="<?php echo base_url(); ?>dashboard_admin/" class="<?php echo $active_dashboard_admin; ?>">
                                        <i class="icon-home"></i>
                                        <span class="title">Dashboard</span>
                                    </a>
                                </li>
                                <li class="nav-item  <?php echo $active_master?>">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="fa fa-sticky-note-o"></i>
                                        <span class="title">Master</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="<?php echo $active_mtanggota; ?>">
                                            <a href="<?php echo base_url(); ?>master_anggota/" class="<?php echo $active_mtanggota; ?>">
                                                <i class="icon-user"></i>
                                                <span class="title">Master Anggota</span>
                                            </a>
                                        </li>
                                        <li class="<?php echo $active_mtstrain; ?>">
                                            <a href="<?php echo base_url(); ?>master_strain/" class="<?php echo $active_mtstrain; ?>">
                                                <i class="fa fa-cube"></i>
                                                <span class="title">Master Strain</span>
                                            </a>
                                        </li>
                                        <li class="<?php echo $active_mtstrainnilai; ?>">
                                            <a href="<?php echo base_url(); ?>master_strainnilai/" class="<?php echo $active_mtstrainnilai; ?>">
                                                <i class="fa fa-cubes"></i>
                                                <span class="title">Master Strain Nilai</span>
                                            </a>
                                        </li>
                                        <li class="<?php echo $active_mtlokasi; ?>">
                                            <a href="<?php echo base_url(); ?>master_lokasi/" class="<?php echo $active_mtlokasi; ?>">
                                                <i class="icon-pointer"></i>
                                                <span class="title">Master Lokasi</span>
                                            </a>
                                        </li>
                                        <li class="<?php echo $active_mtkandang; ?>">
                                            <a href="<?php echo base_url(); ?>master_kandang/" class="<?php echo $active_mtkandang; ?>">
                                                <i class="fa fa-map-o"></i>
                                                <span class="title">Master Kandang</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item  <?php echo $active_transaksi?>">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="fa fa-laptop"></i>
                                        <span class="title">Transaksi</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="<?php echo $active_tsperiode; ?>">
                                            <a href="<?php echo base_url(); ?>transaksi_periode/" class="<?php echo $active_tsperiode; ?>">
                                                <i class="fa fa-indent"></i>
                                                <span class="title">Periode</span>
                                            </a>
                                        </li>
                                        <li class="<?php echo $active_tstelor; ?>">
                                            <a href="<?php echo base_url(); ?>transaksi_telor/" class="<?php echo $active_tstelor; ?>">
                                            <i class="fa fa-outdent"></i>    
                                            <span class="title">Produksi Telor</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item  <?php echo $active_laporan?>">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="icon-layers"></i>
                                        <span class="title">Laporan</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="<?php echo $active_lpharian; ?>">
                                            <a href="<?php echo base_url(); ?>laporan_harian/" class="<?php echo $active_lpharian; ?>">
                                                <i class="fa fa-file-o"></i>
                                                <span class="title">Harian</span>
                                            </a>
                                        </li>
                                        <li class="<?php echo $active_lpmingguan; ?>">
                                            <a href="<?php echo base_url(); ?>laporan_mingguan/" class="<?php echo $active_lpmingguan; ?>">
                                                <i class="fa fa-files-o"></i>
                                                <span class="title">Mingguan</span>
                                            </a>
                                        </li>
                                        <!-- <li class="<?php echo $active_lpbulanan; ?>">
                                            <a href="<?php echo base_url(); ?>laporan_bulanan/" class="<?php echo $active_lpbulanan; ?>">
                                                <span class="title">Bulanan</span>
                                            </a>
                                        </li> -->
                                        <li class="<?php echo $active_lpgrafik; ?>">
                                            <a href="<?php echo base_url(); ?>laporan_grafik/" class="<?php echo $active_lpgrafik; ?>">
                                                <i class="fa fa-bar-chart"></i>
                                                <span class="title">Grafik</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php } else { ?>
                                <li class="nav-item <?php echo $active_dashboard_admin?>">
                                    <a href="<?php echo base_url(); ?>dashboard_admin/" class="<?php echo $active_dashboard_admin; ?>">
                                        <i class="icon-home"></i>
                                        <span class="title">Dashboard</span>
                                    </a>
                                </li>
                                <li class="nav-item  <?php echo $active_transaksi?>">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="fa fa-laptop"></i>
                                        <span class="title">Transaksi</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="<?php echo $active_tsperiode; ?>">
                                            <a href="<?php echo base_url(); ?>transaksi_periode/" class="<?php echo $active_tsperiode; ?>">
                                                <i class="fa fa-indent"></i>
                                                <span class="title">Periode</span>
                                            </a>
                                        </li>
                                        <li class="<?php echo $active_tstelor; ?>">
                                            <a href="<?php echo base_url(); ?>transaksi_telor/" class="<?php echo $active_tstelor; ?>">
                                            <i class="fa fa-outdent"></i>    
                                            <span class="title">Produksi Telor</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item  <?php echo $active_laporan?>">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="icon-layers"></i>
                                        <span class="title">Laporan</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="<?php echo $active_lpharian; ?>">
                                            <a href="<?php echo base_url(); ?>laporan_harian/" class="<?php echo $active_lpharian; ?>">
                                                <i class="fa fa-file-o"></i>
                                                <span class="title">Harian</span>
                                            </a>
                                        </li>
                                        <li class="<?php echo $active_lpmingguan; ?>">
                                            <a href="<?php echo base_url(); ?>laporan_mingguan/" class="<?php echo $active_lpmingguan; ?>">
                                                <i class="fa fa-files-o"></i>    
                                                <span class="title">Mingguan</span>
                                            </a>
                                        </li>
                                        <!-- <li class="<?php echo $active_lpbulanan; ?>">
                                            <a href="<?php echo base_url(); ?>laporan_bulanan/" class="<?php echo $active_lpbulanan; ?>">
                                                <span class="title">Bulanan</span>
                                            </a>
                                        </li> -->
                                        <li class="<?php echo $active_lpgrafik; ?>">
                                            <a href="<?php echo base_url(); ?>laporan_grafik/" class="<?php echo $active_lpgrafik; ?>">
                                                <i class="fa fa-bar-chart"></i>
                                                <span class="title">Grafik</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php } ?>
                        </ul>
                        <!-- END SIDEBAR MENU -->
                        <!-- END SIDEBAR MENU -->
                    </div>
                    <!-- END SIDEBAR -->
                </div>
                <!-- END SIDEBAR -->