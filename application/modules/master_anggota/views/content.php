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
                                        <i class="fa fa-user-md"></i>
                                        <span class="caption-subject bold uppercase"> DATA ANGGOTA</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-container">
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="btn-group pull-right">
                                                <a data-target="#tambah_mt_anggota" data-toggle="modal" class="btn blue"><i class="fa fa-plus"></i> Tambah Data </a>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <table class="table table-striped table-bordered table-hover order-column" id="sample_3">
                                            <thead class="btn-success">
                                                <tr>
                                                    <th> Nama </th>
                                                    <th> Group </th>
                                                    <th> Status </th>
                                                    <th> Aksi </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach($dataSemuaAnggota as $dt)
                                                    {
                                                        ?>
                                                            <tr class="odd gradeX">
                                                                <td><?php echo $dt->nama_anggota; ?></td>
                                                                <td><?php echo $dt->grup_anggota; ?></td>
                                                                <td><?php echo $dt->status_anggota; ?></td>
                                                                <td>
                                                                    <a type="button" class="btn btn-xs blue" onclick="editDataAnggota('<?php echo $dt->id_anggota ?>')"><i class="fa fa-edit"></i> Ubah</a>&nbsp;&nbsp;&nbsp;
                                                                    <a type="button" class="btn btn-xs green" onclick="resetPassword('<?php echo $dt->id_anggota ?>')"><i class="fa fa-edit"></i> Reset</a>&nbsp;&nbsp;&nbsp;
                                                                    <!-- <a type="button" class="btn btn-xs red" onclick="hapusDataAnggota('<?php echo $dt->id_anggota ?>')"><i class="fa fa-edit"></i> Hapus</a> -->
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
<div id="tambah_mt_anggota" class="modal container fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Tambah Data Anggota</h4>
        </div>
        <div class="modal-body">
            <div class="form-group form-md-line-input has-success form-md-floating-label">
                <input type="text" id="nama_mt_anggota" name="nama_mt_anggota" value="" class="form-control">
                <label for="form_control_1">Nama Anggota</label>
                <span class="help-block">Masukkan Nama Anggota</span>
            </div>
            <div class="form-group form-md-line-input has-success form-md-floating-label">
                <input type="text" id="password_mt_anggota" name="password_mt_anggota" value="" class="form-control">
                <label for="form_control_1">Password Anggota</label>
                <span class="help-block">Masukkan Password Anggota</span>
            </div>
            <div class="form-group form-md-line-input has-success">
                <select class="form-control" name="grup_mt_anggota" id="grup_mt_anggota">
                    <option value="" disabled selected>--Pilih--</option>
                    <option value="ADMIN">ADMIN</option>
                    <option value="ANGGOTA">ANGGOTA</option>
                </select>
                <div class="form-control-focus"> </div>
                <span class="help-block">Pilih Grup Anggota</span>
            </div>


            <div id="alert-msg-tambahmtanggota"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" id="batal_tambahmtanggota" name="batal_tambahmtanggota">Batal</button>
            <button type="button" class="btn green" id="tambahmtanggota" name="tambahmtanggota">Simpan</button>
        </div>
    </div>
</div>
<!-- Selesai Modal Tambah Data -->

<!-- Mulai Modal Edit Data -->
<div id="edit_mt_anggota" class="modal container fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Ubah Data Anggota</h4>
        </div>
        <div class="modal-body">
            <div class="form-group form-md-line-input has-success form-md-floating-label">
                <input type="text" id="nama_anggota_edit" name="nama_anggota_edit" value="" class="form-control">
                <span class="help-block">Masukkan Nama Anggota</span>
            </div>
            <div class="form-group form-md-line-input has-success">
                <select class="form-control" name="status_anggota_edit" id="status_anggota_edit">
                    <option value="" disabled selected>--Pilih--</option>
                    <option value="AKTIF">AKTIF</option>
                    <option value="TIDAK AKTIF">TIDAK AKTIF</option>
                </select>
                <div class="form-control-focus"> </div>
                <span class="help-block">Pilih Status Anggota</span>
            </div>
            <div class="form-group form-md-line-input has-success">
                <select class="form-control" name="grup_anggota_edit" id="grup_anggota_edit">
                    <option value="" disabled selected>--Pilih--</option>
                    <option value="ADMIN">ADMIN</option>
                    <option value="ANGGOTA">ANGGOTA</option>
                </select>
                <div class="form-control-focus"> </div>
                <span class="help-block">Pilih Grup Anggota</span>
            </div>
            <br/>
            <input type="hidden" id="id_anggota_edit" name="id_anggota_edit" value="" class="form-control">

            <div id="alert-msg-editanggota"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" id="batal_editanggota" name="batal_editanggota">Batal</button>
            <button type="button" class="btn green" id="editanggota" name="editanggota">Simpan</button>
        </div>
    </div>
</div>
<!-- Selesai Modal Edit Data -->

<!-- Mulai Modal Hapus Data -->
<div id="hapus_anggota" class="modal container fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Hapus Data Anggota</h4>
        </div>
        <div class="modal-body">
            <h5>Apakah Anda Yakin Ingin Menghapus <label id="nama_anggota_hapus"></label> Dari Daftar Anggota ?</h5>

            <input type="hidden" id="id_anggota_hapus" name="id_anggota_hapus" value="" class="form-control">

            <div id="alert-msg-hapusanggota"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" id="batal_hapusanggota" name="batal_hapusanggota">Batal</button>
            <button type="button" class="btn green" id="hapusanggota" name="hapusanggota">Ya</button>
        </div>
    </div>
</div>
<!-- Selesai Modal Hapus Data -->

<!-- Mulai Modal Reset Password -->
<div id="reset_password" class="modal container fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Reset Kata Sandi</h4>
        </div>
        <div class="modal-body">
            <h5>Apakah Anda Yakin Ingin Mereset Kata Sandi <label id="nama_anggota_reset"></label> ?</h5>

            <input type="hidden" id="id_anggota_reset" name="id_anggota_reset" value="" class="form-control">

            <div id="alert-msg-resetpassword"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" id="batal_resetpassword" name="batal_resetpassword">Batal</button>
            <button type="button" class="btn green" id="resetpassword" name="resetpassword">Ya</button>
        </div>
    </div>
</div>
<!-- Selesai Modal Reset Password -->