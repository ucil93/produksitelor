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
                                        <span class="caption-subject bold uppercase"> 
                                            LOKASI <?php echo $data_lokasi; ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
                                                    <input name="tanggal_catat" id="tanggal_catat" type="text" class="form-control" readonly>
                                                    <span class="input-group-btn">
                                                        <button class="btn default" type="button">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group form-md-line-input has-success form-md-floating-label">
                                                <input type="text" id="suhu_pagi" name="suhu_pagi" value="" class="form-control">
                                                <label for="form_control_1">Suhu Pagi</label>
                                                <span class="help-block">Masukkan Suhu Pagi</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group form-md-line-input has-success form-md-floating-label">
                                                <input type="text" id="suhu_siang" name="suhu_siang" value="" class="form-control">
                                                <label for="form_control_1">Suhu Siang</label>
                                                <span class="help-block">Masukkan Suhu Siang</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group form-md-line-input has-success form-md-floating-label">
                                                <input type="text" id="suhu_sore" name="suhu_sore" value="" class="form-control">
                                                <label for="form_control_1">Suhu Sore</label>
                                                <span class="help-block">Masukkan Suhu Sore</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group form-md-line-input has-success form-md-floating-label">
                                                <input type="text" id="suhu_malam" name="suhu_malam" value="" class="form-control">
                                                <label for="form_control_1">Suhu Malam</label>
                                                <span class="help-block">Masukkan Suhu Malam</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered">
                                                <thead class="btn-success">
                                                    <tr>
                                                        <th> Nama Kandang </th>
                                                        <th> M </th>
                                                        <th> C </th>
                                                        <th> Pakan (Kg) </th>
                                                        <th> Butir (Jumlah) </th>
                                                        <th> Rusak/Retak (Jumlah) </th>
                                                        <th> Butir (Kg) </th>
                                                        <th> Rusak/Retak (Kg) </th>
                                                        <th> Berat Badan </th>
                                                        <th> Keterangan </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        foreach($dataSemuaKandang as $dt)
                                                        {
                                                            ?>
                                                                <tr class="odd gradeX">
                                                                    <td>
                                                                        <?php echo $dt->nama_kandang; ?>
                                                                        <input type="hidden" class="form-control input-circle" value="<?php echo $dt->id_periode; ?>" name="id_periode[]"> 
                                                                        <input type="hidden" class="form-control input-circle" value="<?php echo $dt->jumlah_seluruh_ayam; ?>" name="jumlah_ayam[]"> 
                                                                        <input type="hidden" class="form-control input-circle" value="<?php echo $dt->hd_periode; ?>" name="hd_periode[]"> 
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

                                    <div id="alert-msg-tambahtrtelor"></div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-default" onclick="javascript:window.location.href=base_url + 'transaksi_telor'; return false;">Batal</button>
                                            <button type="button" class="btn green" id="tambah_tr_telor" name="tambah_tr_telor">Simpan</button>
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