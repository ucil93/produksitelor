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
                                        <i class="fa fa-cube"></i>
                                        <span class="caption-subject bold uppercase"> DATA STRAIN</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-container">
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="btn-group pull-right">
                                                <a data-target="#tambah_mt_strain" data-toggle="modal" class="btn blue"><i class="fa fa-plus"></i> Tambah Data </a>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <table class="table table-striped table-bordered table-hover order-column" id="sample_3">
                                            <thead class="btn-success">
                                                <tr>
                                                    <th> Nama Strain</th>
                                                    <th> Status </th>
                                                    <th> Aksi </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach($dataSemuaStrain as $dt)
                                                    {
                                                        ?>
                                                            <tr class="odd gradeX">
                                                                <td><?php echo $dt->nama_strain; ?></td>
                                                                <td><?php echo $dt->status_strain; ?></td>
                                                                <td>
                                                                    <a type="button" class="btn btn-xs blue" onclick="editDataStrain('<?php echo $dt->id_strain ?>')"><i class="fa fa-edit"></i> Ubah</a>&nbsp;&nbsp;&nbsp;
                                                                    <!-- <a type="button" class="btn btn-xs red" onclick="hapusDataStrain('<?php echo $dt->id_strain ?>')"><i class="fa fa-edit"></i> Hapus</a> -->
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
<div id="tambah_mt_strain" class="modal container fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Tambah Data Strain</h4>
        </div>
        <div class="modal-body">
            <div class="form-group form-md-line-input has-success form-md-floating-label">
                <input type="text" id="nama_mt_strain" name="nama_mt_strain" value="" class="form-control">
                <label for="form_control_1">Nama Strain</label>
                <span class="help-block">Masukkan Nama Strain</span>
            </div>


            <div id="alert-msg-tambahmtstrain"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" id="batal_tambahmtstrain" name="batal_tambahmtstrain">Batal</button>
            <button type="button" class="btn green" id="tambahmtstrain" name="tambahmtstrain">Simpan</button>
        </div>
    </div>
</div>
<!-- Selesai Modal Tambah Data -->

<!-- Mulai Modal Edit Data -->
<div id="edit_mt_strain" class="modal container fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Ubah Data Strain</h4>
        </div>
        <div class="modal-body">
            <div class="form-group form-md-line-input has-success form-md-floating-label">
                <input type="text" id="nama_strain_edit" name="nama_strain_edit" value="" class="form-control">
                <span class="help-block">Masukkan Nama Strain</span>
            </div>
            <div class="form-group form-md-line-input has-success">
                <select class="form-control" name="status_strain_edit" id="status_strain_edit">
                    <option value="" disabled selected>--Pilih--</option>
                    <option value="AKTIF">AKTIF</option>
                    <option value="TIDAK AKTIF">TIDAK AKTIF</option>
                </select>
                <div class="form-control-focus"> </div>
                <span class="help-block">Pilih Status Strain</span>
            </div>

            <input type="hidden" id="id_strain_edit" name="id_strain_edit" value="" class="form-control">

            <div id="alert-msg-editstrain"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" id="batal_editstrain" name="batal_editstrain">Batal</button>
            <button type="button" class="btn green" id="editstrain" name="editstrain">Simpan</button>
        </div>
    </div>
</div>
<!-- Selesai Modal Edit Data -->

<!-- Mulai Modal Hapus Data -->
<div id="hapus_strain" class="modal container fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Hapus Data Strain</h4>
        </div>
        <div class="modal-body">
            <h5>Apakah Anda Yakin Ingin Menghapus Strain <label id="nama_strain_hapus"></label> ?</h5>

            <input type="hidden" id="id_strain_hapus" name="id_strain_hapus" value="" class="form-control">

            <div id="alert-msg-hapusstrain"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" id="batal_hapusstrain" name="batal_hapusstrain">Batal</button>
            <button type="button" class="btn green" id="hapusstrain" name="hapusstrain">Ya</button>
        </div>
    </div>
</div>
<!-- Selesai Modal Hapus Data -->