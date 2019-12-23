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
                                        <i class="fa fa-cubes"></i>
                                        <span class="caption-subject bold uppercase"> DATA STRAIN NILAI</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-container">
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="btn-group pull-right">
                                                <a data-target="#tambah_mt_strain_nilai" data-toggle="modal" class="btn blue"><i class="fa fa-plus"></i> Tambah Data </a>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <table class="table table-striped table-bordered table-hover order-column" id="sample_3">
                                            <thead class="btn-success">
                                                <tr>
                                                    <th> Nama Strain</th>
                                                    <th> Nama Strain Nilai </th>
                                                    <th> Minggu Ke </th>
                                                    <th> Standar Strain Nilai </th>
                                                    <th> Status Strain Nilai </th>
                                                    <th> Aksi </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach($dataSemuaStrainNilai as $dt)
                                                    {
                                                        ?>
                                                            <tr class="odd gradeX">
                                                                <td><?php echo $dt->nama_strain; ?></td>
                                                                <td><?php echo $dt->nama_strain_nilai; ?></td>
                                                                <td><?php echo $dt->minggu_strain_nilai; ?></td>
                                                                <td><?php echo $dt->standar_strain_nilai; ?></td>
                                                                <td><?php echo $dt->status_strain_nilai; ?></td>
                                                                <td>
                                                                    <a type="button" class="btn btn-xs blue" onclick="editDataStrainNilai('<?php echo $dt->id_strain_nilai ?>')"><i class="fa fa-edit"></i> Ubah</a>&nbsp;&nbsp;&nbsp;
                                                                    <!-- <a type="button" class="btn btn-xs red" onclick="hapusDataStrainNilai('<?php echo $dt->id_strain_nilai ?>')"><i class="fa fa-edit"></i> Hapus</a> -->
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
<div id="tambah_mt_strain_nilai" class="modal container fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
   <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Tambah Data Strain Nilai</h4>
        </div>
        <div class="modal-body">
            <div class="form-group form-md-line-input has-success">
                <select class="form-control" name="data_tabel_strain" id="data_tabel_strain">
                    <option value="" disabled selected>--Pilih--</option>
                    <?php
                        foreach($dataSemuaStrain as $row)
                        {
                            echo '<option value="'.$row->id_strain.'">'.$row->nama_strain.'</option>';
                        }
                    ?>
                </select>
                <div class="form-control-focus"> </div>
                <span class="help-block">Pilih Strain</span>
            </div>
            <div class="form-group form-md-line-input has-success form-md-floating-label">
                <input type="text" id="nama_mt_strain_nilai" name="nama_mt_strain_nilai" value="" class="form-control">
                <label for="form_control_1">Nama Strain Nilai</label>
                <span class="help-block">Masukkan Nama Strain Nilai</span>
            </div>
            <div class="form-group form-md-line-input has-success form-md-floating-label">
                <input type="text" id="minggu_mt_strain_nilai" name="minggu_mt_strain_nilai" value="" class="form-control">
                <label for="form_control_1">Minggu Ke</label>
                <span class="help-block">Masukkan Minggu Ke</span>
            </div>
            <div class="form-group form-md-line-input has-success form-md-floating-label">
                <input type="text" id="standar_mt_strain_nilai" name="standar_mt_strain_nilai" value="" class="form-control">
                <label for="form_control_1">Standar Strain Nilai</label>
                <span class="help-block">Masukkan Standar Strain Nilai</span>
            </div>


            <div id="alert-msg-tambahmtstrainnilai"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" id="batal_tambahmtstrainnilai" name="batal_tambahmtstrainnilai">Batal</button>
            <button type="button" class="btn green" id="tambahmtstrainnilai" name="tambahmtstrainnilai">Simpan</button>
        </div>
    </div>
</div>
<!-- Selesai Modal Tambah Data -->

<!-- Mulai Modal Edit Data -->
<div id="edit_mt_strain_nilai" class="modal container fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Ubah Data Strain Nilai</h4>
        </div>
        <div class="modal-body">
            <div class="form-group form-md-line-input has-success">
                <select class="form-control" name="data_tabel_strain_nilai_edit" id="data_tabel_strain_nilai_edit">
                    <option value="" disabled selected>--Pilih--</option>
                    <?php
                        foreach($dataSemuaStrain as $row)
                        {
                            echo '<option value="'.$row->id_strain.'">'.$row->nama_strain.'</option>';
                        }
                    ?>
                </select>
                <div class="form-control-focus"> </div>
                <span class="help-block">Pilih Strain</span>
            </div>
            <div class="form-group form-md-line-input has-success form-md-floating-label">
                <input type="text" id="nama_strain_nilai_edit" name="nama_strain_nilai_edit" value="" class="form-control">
                <span class="help-block">Masukkan Nama Strain Nilai</span>
            </div>
            <div class="form-group form-md-line-input has-success form-md-floating-label">
                <input type="text" id="minggu_strain_nilai_edit" name="minggu_strain_nilai_edit" value="" class="form-control">
                <span class="help-block">Masukkan Minggu Ke</span>
            </div>
            <div class="form-group form-md-line-input has-success form-md-floating-label">
                <input type="text" id="standar_strain_nilai_edit" name="standar_strain_nilai_edit" value="" class="form-control">
                <span class="help-block">Masukkan Standar Strain Nilai</span>
            </div>
            <div class="form-group form-md-line-input has-success">
                <select class="form-control" name="status_strain_nilai_edit" id="status_strain_nilai_edit">
                    <option value="" disabled selected>--Pilih--</option>
                    <option value="AKTIF">AKTIF</option>
                    <option value="TIDAK AKTIF">TIDAK AKTIF</option>
                </select>
                <div class="form-control-focus"> </div>
                <span class="help-block">Pilih Status Strain Nilai</span>
            </div>
            
            <input type="hidden" id="id_strain_nilai_edit" name="id_strain_nilai_edit" value="" class="form-control">

            <div id="alert-msg-editstrainnilai"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" id="batal_editstrainnilai" name="batal_editstrainnilai">Batal</button>
            <button type="button" class="btn green" id="editstrainnilai" name="editstrainnilai">Simpan</button>
        </div>
    </div>
</div>
<!-- Selesai Modal Edit Data -->

<!-- Mulai Modal Hapus Data -->
<div id="hapus_strain_nilai" class="modal container fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Hapus Data Strain Nilai</h4>
        </div>
        <div class="modal-body">
            <h5>Apakah Anda Yakin Ingin Menghapus Data <label id="nama_strain_nilai_hapus"></label> ?</h5>

            <input type="hidden" id="id_strain_nilai_hapus" name="id_strain_nilai_hapus" value="" class="form-control">

            <div id="alert-msg-hapusstrainnilai"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" id="batal_hapusstrainnilai" name="batal_hapusstrainnilai">Batal</button>
            <button type="button" class="btn green" id="hapusstrainnilai" name="hapusstrainnilai">Ya</button>
        </div>
    </div>
</div>
<!-- Selesai Modal Hapus Data -->