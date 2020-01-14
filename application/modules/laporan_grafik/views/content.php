                  <!-- BEGIN CONTENT -->
                  <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content" style="background-color:#BFBFBF;">
                        <!-- BEGIN PAGE HEADER-->
                        <!-- BEGIN THEME PANEL -->
                        
                        <!-- END THEME PANEL -->
                        <!-- BEGIN PAGE BAR -->

                        <!-- END PAGE BAR -->
                        <!-- BEGIN PAGE TITLE-->
                        <div class="row">
                            <div class="col-md-12">
                            <div class="portlet light portlet-fit portlet-datatable bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-layers"></i>
                                        <span class="caption-subject bold uppercase"> LAPORAN GRAFIK</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mt-radio-inline">
                                                <label class="mt-radio">
                                                    <input type="radio" name="jumlah_kandang_grafik" id="jumlah_kandang_grafik_satu" value="0" checked> Satu Kandang
                                                    <span></span>
                                                </label>
                                                <label class="mt-radio">
                                                    <input type="radio" name="jumlah_kandang_grafik" id="jumlah_kandang_grafik_banyak" value="1"> Banyak Kandang
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                        </div>
                                    </div>
                                    <div id="grafik_satu_kandang">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-md-line-input has-success">
                                                    <select class="form-control" name="lokasi_grafik_satu_kandang" id="lokasi_grafik_satu_kandang">
                                                        <option value="" disabled selected>--Pilih--</option>
                                                        <?php
                                                            foreach($dataSemuaLokasi as $row)
                                                            {
                                                                echo '<option value="'.$row->id_lokasi.'">'.$row->nama_lokasi.'</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">Pilih Lokasi</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-md-line-input has-success">
                                                    <select class="form-control" name="kandang_grafik_satu_kandang" id="kandang_grafik_satu_kandang">
                                                        <option value="" disabled selected>--Pilih--</option>
                                                    </select>
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">Pilih Kandang</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="btn-group">
                                                    <a class="btn blue" id="cetak_data_grafik_satu_kandang"> Lihat Data </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="grafik_banyak_kandang" class="collapse">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group form-md-line-input has-success">
                                                    <select class="form-control" name="lokasi_grafik_banyak_kandang" id="lokasi_grafik_banyak_kandang">
                                                        <option value="" disabled selected>--Pilih--</option>
                                                        <?php
                                                            foreach($dataSemuaLokasi as $row)
                                                            {
                                                                echo '<option value="'.$row->id_lokasi.'">'.$row->nama_lokasi.'</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">Pilih Lokasi</span>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-8" style="margin-top:15px">
                                                <div class="form-group">
                                                    <div class="mt-checkbox-inline" name="kandang_grafik_banyak_kandang" id="kandang_grafik_banyak_kandang">
                                                        
                                                    </div>
                                                </div>
                                            </div> -->
                                            <div class="col-md-4">
                                                <div class="form-group form-md-line-input has-success">
                                                    <select class="form-control" name="kandang_grafik_banyak_kandang" id="kandang_grafik_banyak_kandang">
                                                        <option value="" disabled selected>--Pilih--</option>
                                                    </select>
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">Pilih Tanggal Menetas</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group form-md-line-input has-success">
                                                    <select class="form-control" name="strain_grafik_banyak_kandang" id="strain_grafik_banyak_kandang">
                                                        <option value="" disabled selected>--Pilih--</option>
                                                    </select>
                                                    <div class="form-control-focus"> </div>
                                                    <span class="help-block">Pilih Strain</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="btn-group">
                                                    <a class="btn blue" id="cetak_data_grafik_banyak_kandang"> Lihat Data </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12" id="tampilan_grafik">
                                            <div id="highchart_100" style="height:500px;">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet light portlet-fit bordered">
                                                <div class="portlet-body">
                                                    <div id="highchart_100" style="height:500px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>
                        </div>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <!-- BEGIN DASHBOARD STATS 1-->
                        
                        <!-- END DASHBOARD STATS 1-->
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
                <!-- BEGIN QUICK SIDEBAR -->

                <!-- END QUICK SIDEBAR -->
            </div>
            <!-- END CONTAINER -->