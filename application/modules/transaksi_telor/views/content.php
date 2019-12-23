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
                                        <i class="fa fa-outdent"></i>
                                        <span class="caption-subject bold uppercase"> DATA TRANSAKSI</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-container">
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="btn-group pull-right">
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <table class="table table-striped table-bordered table-hover order-column" id="sample_3">
                                            <thead class="btn-success">
                                                <tr>
                                                    <th> Nama Lokasi</th>
                                                    <th> Aksi </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach($dataSemuaLokasi as $dt)
                                                    {
                                                        ?>
                                                            <tr class="odd gradeX">
                                                                <td><?php echo $dt->nama_lokasi; ?></td>
                                                                <td>
                                                                    <a href="<?php echo base_url(); ?>transaksi_telor/telor/<?=$dt->id_lokasi;?>" class="btn green active"><i class="fa fa-plus"> Pilih</i></a>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
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