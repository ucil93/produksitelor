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
                                        <i class="fa fa-map-o"></i>
                                        <span class="caption-subject bold uppercase"> DATA KANDANG</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-container">
                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="btn-group pull-right">
                                                    <a data-target="#tambah_mt_kandang" data-toggle="modal" class="btn blue"><i class="fa fa-plus"></i> Tambah Data </a>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <table class="table table-striped table-bordered table-hover order-column" id="sample_3">
                                            <thead class="btn-success">
                                                <tr>
                                                    <th> Nama Lokasi</th>
                                                    <th> Nama Kandang </th>
                                                    <th> Kapasitas Kandang </th>
                                                    <th> Status Kandang </th>
                                                    <th> Aksi </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach($dataSemuaKandang as $dt)
                                                    {
                                                        ?>
                                                            <tr class="odd gradeX">
                                                                <td><?php echo $dt->nama_lokasi; ?></td>
                                                                <td><?php echo $dt->nama_kandang; ?></td>
                                                                <td><?php echo $dt->kapasitas_ayam; ?></td>
                                                                <td><?php echo $dt->status_kandang; ?></td>
                                                                <td>
                                                                    <a type="button" class="btn btn-xs blue" onclick="editDataKandang('<?php echo $dt->id_kandang ?>')"><i class="fa fa-edit"></i> Ubah</a>
                                                                    <?php
                                                                        if($grup_anggota == 'ADMIN') {
                                                                            ?>
                                                                                &nbsp;&nbsp;&nbsp;
                                                                                <a type="button" class="btn btn-xs red" onclick="hapusDataKandang('<?php echo $dt->id_kandang ?>')"><i class="fa fa-remove"></i> Hapus</a>
                                                                            <?php
                                                                        }
                                                                    ?>
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
<div id="tambah_mt_kandang" class="modal container fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
   <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Tambah Data Kandang</h4>
        </div>
        <div class="modal-body">
            <div class="form-group form-md-line-input has-success">
                <select class="form-control" name="data_tabel_lokasi" id="data_tabel_lokasi">
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
            <div class="form-group form-md-line-input has-success form-md-floating-label">
                <input type="text" id="nama_mt_kandang" name="nama_mt_kandang" value="" class="form-control">
                <label for="form_control_1">Nama Kandang</label>
                <span class="help-block">Masukkan Nama Kandang</span>
            </div>
            <div class="form-group form-md-line-input has-success form-md-floating-label">
                <input type="text" id="kapasitas_mt_kandang" name="kapasitas_mt_kandang" value="" class="form-control">
                <label for="form_control_1">Kapasitas Kandang</label>
                <span class="help-block">Masukkan Kapasitas Kandang</span>
            </div>


            <div id="alert-msg-tambahmtkandang"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" id="batal_tambahmtkandang" name="batal_tambahmtkandang">Batal</button>
            <button type="button" class="btn green" id="tambahmtkandang" name="tambahmtkandang">Simpan</button>
        </div>
    </div>
</div>
<!-- Selesai Modal Tambah Data -->

<!-- Mulai Modal Edit Data -->
<div id="edit_mt_kandang" class="modal container fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Ubah Data Kandang</h4>
        </div>
        <div class="modal-body">
            <div class="form-group form-md-line-input has-success">
                <select class="form-control" name="data_tabel_lokasi_edit" id="data_tabel_lokasi_edit">
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
            <div class="form-group form-md-line-input has-success form-md-floating-label">
                <input type="text" id="nama_kandang_edit" name="nama_kandang_edit" value="" class="form-control">
                <span class="help-block">Masukkan Nama Kandang</span>
            </div>
            <div class="form-group form-md-line-input has-success form-md-floating-label">
                <input type="text" id="kapasitas_kandang_edit" name="kapasitas_kandang_edit" value="" class="form-control">
                <span class="help-block">Masukkan Kapasitas Kandang</span>
            </div>
            <div class="form-group form-md-line-input has-success">
                <select class="form-control" name="status_kandang_edit" id="status_kandang_edit">
                    <option value="" disabled selected>--Pilih--</option>
                    <option value="AKTIF">AKTIF</option>
                    <option value="TIDAK AKTIF">TIDAK AKTIF</option>
                </select>
                <div class="form-control-focus"> </div>
                <span class="help-block">Pilih Status Kandang</span>
            </div>
            
            <input type="hidden" id="id_kandang_edit" name="id_kandang_edit" value="" class="form-control">

            <div id="alert-msg-editkandang"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" id="batal_editkandang" name="batal_editkandang">Batal</button>
            <button type="button" class="btn green" id="editkandang" name="editkandang">Simpan</button>
        </div>
    </div>
</div>
<!-- Selesai Modal Edit Data -->

<!-- Mulai Modal Hapus Data -->
<div id="hapus_kandang" class="modal container fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Hapus Data Kandang</h4>
        </div>
        <div class="modal-body">
            <h5>Apakah Anda Yakin Ingin Menghapus Data "<label id="nama_kandang_hapus"></label>". Apabila Data Kandang Dihapus, Maka Data Periode Dan Data Produksi Telor Yang Berhubungan Akan Terhapus Juga?</h5>

            <input type="hidden" id="id_kandang_hapus" name="id_kandang_hapus" value="" class="form-control">

            <div id="alert-msg-hapuskandang"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" id="batal_hapuskandang" name="batal_hapuskandang">Batal</button>
            <button type="button" class="btn green" id="hapuskandang" name="hapuskandang">Ya</button>
        </div>
    </div>
</div>
<!-- Selesai Modal Hapus Data -->