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
                                    <span class="caption-subject bold uppercase"> 
                                        Kandang <?php echo $data_kandang; ?>
                                    </span>
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
                                        <table class="table table-bordered">
                                            <thead class="btn-success">
                                                <tr>
                                                    <th> Tanggal Catat</th>
                                                    <th> M </th>
                                                    <th> C </th>
                                                    <th> Pakan (Kg) </th>
                                                    <th> Butir (Jumlah) </th>
                                                    <th> Rusak/Retak (Jumlah) </th>
                                                    <th> Butir (Kg) </th>
                                                    <th> Rusak/Retak (Kg) </th>
                                                    <th> Berat Badan </th>
                                                    <th> Keterangan </th>
                                                    <th> Aksi </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach($dataSemuaProduksi as $dt)
                                                    {
                                                        $date_catat = date_create($dt->tanggal_catat);

                                                        ?>
                                                            <tr class="odd gradeX">
                                                                <td><?php echo date_format($date_catat, "d F Y"); ?></td>
                                                                <td><?php echo $dt->ayam_m; ?></td>
                                                                <td><?php echo $dt->ayam_c; ?></td>
                                                                <td><?php echo $dt->pakan_kg; ?></td>
                                                                <td><?php echo $dt->butir_jumlah; ?></td>
                                                                <td><?php echo $dt->rusak_jumlah; ?></td>
                                                                <td><?php echo $dt->butir_kg; ?></td>
                                                                <td><?php echo $dt->rusak_kg; ?></td>
                                                                <td><?php echo $dt->berat_badan; ?></td>
                                                                <td><?php echo $dt->keterangan; ?></td>
                                                                <td>
                                                                    <a type="button" class="btn btn-xs red" onclick="hapusDataProduksi('<?php echo $dt->id_produksi ?>')"><i class="fa fa-remove"></i> Hapus</a>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-default" onclick="javascript:window.location.href=base_url + 'transaksi_telor'; return false;">Batal</button>
                                            </div>
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

<!-- Mulai Modal Hapus Data -->
<div id="hapus_produksi" class="modal container fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Hapus Data Produksi</h4>
        </div>
        <div class="modal-body">
            <h5>Apakah Anda Yakin Ingin Menghapus Data Produksi Dengan Tanggal Catat "<label id="tanggal_catat_hapus"></label>"?</h5>

            <input type="hidden" id="id_produksi_hapus" name="id_produksi_hapus" value="" class="form-control">
            <input type="hidden" id="id_periode_hapus" name="id_periode_hapus" value="" class="form-control">
            <input type="hidden" id="tanggal_catat_value_hapus" name="tanggal_catat_value_hapus" value="" class="form-control">

            <div id="alert-msg-hapusproduksi"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" id="batal_hapusproduksi" name="batal_hapusproduksi">Batal</button>
            <button type="button" class="btn green" id="hapusproduksi" name="hapusproduksi">Ya</button>
        </div>
    </div>
</div>
<!-- Selesai Modal Hapus Data -->