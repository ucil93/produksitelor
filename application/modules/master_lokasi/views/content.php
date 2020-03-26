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
                                        <i class="icon-pointer"></i>
                                        <span class="caption-subject bold uppercase"> DATA LOKASI</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-container">
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="btn-group pull-right">
                                                <a data-target="#tambah_mt_lokasi" data-toggle="modal" class="btn blue"><i class="fa fa-plus"></i> Tambah Data </a>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <table class="table table-striped table-bordered table-hover order-column" id="sample_3">
                                            <thead class="btn-success">
                                                <tr>
                                                    <th> Nama Anggota</th>
                                                    <th> Nama Lokasi</th>
                                                    <th> Status </th>
                                                    <th> Aksi </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach($dataSemuaLokasi as $dt)
                                                    {
                                                        ?>
                                                            <tr class="odd gradeX">
                                                                <td><?php echo $dt->nama_anggota; ?></td>
                                                                <td><?php echo $dt->nama_lokasi; ?></td>
                                                                <td><?php echo $dt->status_lokasi; ?></td>
                                                                <td>
                                                                    <a type="button" class="btn btn-xs blue" onclick="editDataLokasi('<?php echo $dt->id_lokasi ?>')"><i class="fa fa-edit"></i> Ubah</a>&nbsp;&nbsp;&nbsp;
                                                                    <!-- <a type="button" class="btn btn-xs red" onclick="hapusDataLokasi('<?php echo $dt->id_lokasi ?>')"><i class="fa fa-edit"></i> Hapus</a> -->
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

<!-- Mulai Modal Tambah Data -->
<div id="tambah_mt_lokasi" class="modal container fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Tambah Data Lokasi</h4>
        </div>
        <div class="modal-body">
            <div class="form-group form-md-line-input has-success form-md-floating-label">
                <input type="text" id="nama_mt_lokasi" name="nama_mt_lokasi" value="" class="form-control">
                <label for="form_control_1">Nama Lokasi</label>
                <span class="help-block">Masukkan Nama Lokasi</span>
            </div>


            <div id="alert-msg-tambahmtlokasi"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" id="batal_tambahmtlokasi" name="batal_tambahmtlokasi">Batal</button>
            <button type="button" class="btn green" id="tambahmtlokasi" name="tambahmtlokasi">Simpan</button>
        </div>
    </div>
</div>
<!-- Selesai Modal Tambah Data -->

<!-- Mulai Modal Edit Data -->
<div id="edit_mt_lokasi" class="modal container fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Ubah Data Lokasi</h4>
        </div>
        <div class="modal-body">
            <div class="form-group form-md-line-input has-success form-md-floating-label">
                <input type="text" id="nama_lokasi_edit" name="nama_lokasi_edit" value="" class="form-control">
                <span class="help-block">Masukkan Nama Lokasi</span>
            </div>
            <div class="form-group form-md-line-input has-success">
                <select class="form-control" name="status_lokasi_edit" id="status_lokasi_edit">
                    <option value="" disabled selected>--Pilih--</option>
                    <option value="AKTIF">AKTIF</option>
                    <option value="TIDAK AKTIF">TIDAK AKTIF</option>
                </select>
                <div class="form-control-focus"> </div>
                <span class="help-block">Pilih Status Lokasi</span>
            </div>

            <input type="hidden" id="id_lokasi_edit" name="id_lokasi_edit" value="" class="form-control">

            <div id="alert-msg-editlokasi"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" id="batal_editlokasi" name="batal_editlokasi">Batal</button>
            <button type="button" class="btn green" id="editlokasi" name="editlokasi">Simpan</button>
        </div>
    </div>
</div>
<!-- Selesai Modal Edit Data -->

<!-- Mulai Modal Hapus Data -->
<div id="hapus_lokasi" class="modal container fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Hapus Data Lokasi</h4>
        </div>
        <div class="modal-body">
            <h5>Apakah Anda Yakin Ingin Menghapus Lokasi <label id="nama_lokasi_hapus"></label> ?</h5>

            <input type="hidden" id="id_lokasi_hapus" name="id_lokasi_hapus" value="" class="form-control">

            <div id="alert-msg-hapuslokasi"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" id="batal_hapuslokasi" name="batal_hapuslokasi">Batal</button>
            <button type="button" class="btn green" id="hapuslokasi" name="hapuslokasi">Ya</button>
        </div>
    </div>
</div>
<!-- Selesai Modal Hapus Data -->