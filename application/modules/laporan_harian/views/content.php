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
                                        <span class="caption-subject bold uppercase"> LAPORAN HARIAN</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <?php
                                            foreach($dataSemuaJudul as $dt)
                                            {
                                                ?>
                                                    <h4 class="block">Populasi : <?php echo $dt->awal_ayam_masuk; ?></h4>
                                                    <h4 class="block">HD 2% : <?php echo $dt->hd_periode; ?></h4>
                                                    <h4 class="block">Strain : <?php echo $dt->nama_strain; ?></h4>
                                                    <h4 class="block">Kandang : <?php echo $dt->nama_kandang; ?></h4>
                                                    <h4 class="block">Asal Pullet : <?php echo $dt->asal_pullet; ?></h4>
                                                <?php
                                            }
                                        ?>

                                        <div class="col-md-12">
                                            <table class="table table-bordered">
                                                <thead class="btn-success">
                                                    <tr>
                                                        <th> Tanggal </th>
                                                        <th> Mati </th>
                                                        <th> Afkir </th>
                                                        <th> Total </th>
                                                        <th> Pakan (Kg) </th>
                                                        <th> Pakan (Gr) </th>
                                                        <th> Butir Telur (Jumlah) </th>
                                                        <th> Butir Telur (Kg) </th>
                                                        <th> Gr / Butir </th>
                                                        <th> % HH </th>
                                                        <th> % HD </th>
                                                        <th> FCR </th>
                                                        <th> BB </th>
                                                        <th> Keterangan </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        foreach($dataSemuaTransaksi as $dt)
                                                        {
                                                            ?>
                                                                <tr class="odd gradeX">
                                                                    <td>
                                                                        <?php echo $dt->nama_kandang; ?>
                                                                        <input type="text" class="form-control input-circle" value="<?php echo $dt->id_periode; ?>" name="id_periode[]"> 
                                                                        <input type="text" class="form-control input-circle" value="<?php echo $dt->jumlah_seluruh_ayam; ?>" name="jumlah_ayam[]"> 
                                                                        <input type="text" class="form-control input-circle" value="<?php echo $dt->hd_periode; ?>" name="hd_periode[]"> 
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control input-circle" placeholder="Masukkan M" name="data_m[]"> 
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control input-circle" placeholder="Masukkan C" name="data_c[]"> 
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control input-circle" placeholder="Masukkan Pakan" name="data_pakan[]"> 
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control input-circle" placeholder="Masukkan Butir (Jumlah)" name="data_butir_jumlah[]"> 
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control input-circle" placeholder="Masukkan Rusak/Retak (Jumlah)" name="data_rusak_jumlah[]"> 
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control input-circle" placeholder="Masukkan Butir (Kg)" name="data_butir_kg[]"> 
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control input-circle" placeholder="Masukkan Rusak/Retak (Kg)" name="data_rusak_kg[]"> 
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control input-circle" placeholder="Masukkan Berat Badan" name="data_berat_badan[]"> 
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control input-circle" placeholder="Masukkan Keterangan" name="data_ket[]"> 
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