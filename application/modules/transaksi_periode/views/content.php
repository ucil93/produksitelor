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
                                        <i class="fa fa-indent"></i>
                                        <span class="caption-subject bold uppercase"> DATA PERIODE</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="btn-group pull-right">
                                                    <a data-target="#tambah_tr_periode" data-toggle="modal" class="btn blue"><i class="fa fa-plus"></i> Tambah Data </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <table class="table table-striped table-bordered table-hover order-column" id="sample_3">
                                            <thead class="btn-success">
                                                <tr>
                                                    <th> Nama Lokasi </th>
                                                    <th> Nama Anggota </th>
                                                    <th> Nama Kandang </th>
                                                    <th> Nama Strain </th>
                                                    <th> Nama Periode </th>
                                                    <th> Tanggal Masuk Kandang </th>
                                                    <th> Tanggal Menetas </th>
                                                    <th> Jumlah Ayam Masuk </th>
                                                    <th> Jumlah Ayam Saat Ini </th>
                                                    <th> Asal Pullet </th>
                                                    <th> HD </th>
                                                    <th> Status Periode </th>
                                                    <th> Aksi </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach($dataSemuaPeriode as $dt)
                                                    {
                                                        $date_masuk_kadang = date_create($dt->tanggal_masuk_kandang);
                                                        $date_menetas = date_create($dt->tanggal_menetas);

                                                        ?>
                                                            <tr class="odd gradeX">
                                                                <td><?php echo $dt->nama_lokasi; ?></td>
                                                                <td><?php echo $dt->nama_anggota; ?></td>
                                                                <td><?php echo $dt->nama_kandang; ?></td>
                                                                <td><?php echo $dt->nama_strain; ?></td>
                                                                <td><?php echo $dt->nama_periode; ?></td>
                                                                <td><?php echo date_format($date_masuk_kadang, "d F Y"); ?></td>
                                                                <td><?php echo date_format($date_menetas, "d F Y"); ?></td>
                                                                <td><?php echo $dt->awal_ayam_masuk; ?></td>
                                                                <td><?php echo $dt->jumlah_seluruh_ayam; ?></td>
                                                                <td><?php echo $dt->asal_pullet; ?></td>
                                                                <td><?php echo $dt->hd_periode; ?></td>
                                                                <td><?php echo $dt->status_periode; ?></td>
                                                                <td>
                                                                    <a type="button" class="btn btn-xs blue" onclick="editDataPeriode('<?php echo $dt->id_periode ?>')"><i class="fa fa-edit"></i> Ubah</a>
                                                                    &nbsp;&nbsp;&nbsp;
                                                                    <a type="button" class="btn btn-xs red" onclick="hapusDataPeriode('<?php echo $dt->id_periode ?>')"><i class="fa fa-remove"></i> Hapus</a>
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
<div id="tambah_tr_periode" class="modal container fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Tambah Data Periode</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
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
                </div>
                <div class="col-md-6">
                    <div class="form-group form-md-line-input has-success">
                        <select class="form-control" name="data_kandang" id="data_kandang">
                            <option value="" disabled selected>--Pilih--</option>
                        </select>
                        <div class="form-control-focus"> </div>
                        <span class="help-block">Pilih Kandang</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
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
                </div>
                <div class="col-md-6">
                    <div class="form-group form-md-line-input has-success form-md-floating-label">
                        <input type="text" id="nama_periode" name="nama_periode" value="" class="form-control">
                        <label for="form_control_1">Nama Periode</label>
                        <span class="help-block">Masukkan Nama Periode</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-success">
                        <label class="control-label">Tanggal Masuk Kandang</label>
                        <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-end-date="0d">
                            <input name="tanggal_masuk_kandang" id="tanggal_masuk_kandang" type="text" class="form-control" readonly>
                            <span class="input-group-btn">
                                <button class="btn default" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-success">
                        <label class="control-label">Tanggal Menetas</label>
                        <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-end-date="0d">
                            <input name="tanggal_menetas" id="tanggal_menetas" type="text" class="form-control" readonly>
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
                <div class="col-md-6">
                    <div class="form-group form-md-line-input has-success form-md-floating-label">
                        <input type="text" id="ayam_masuk" name="ayam_masuk" value="" class="form-control">
                        <label for="form_control_1">Jumlah Ayam Masuk</label>
                        <span class="help-block">Masukkan Jumlah Ayam Masuk</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-md-line-input has-success form-md-floating-label">
                        <input type="text" id="asal_pullet" name="asal_pullet" value="" class="form-control">
                        <label for="form_control_1">Asal Pullet</label>
                        <span class="help-block">Masukkan Asal Pullet</span>
                    </div>
                </div>
                <!-- <div class="col-md-6">
                    <div class="form-group form-md-line-input has-success form-md-floating-label">
                        <input type="text" id="umur_masuk" name="umur_masuk" value="" class="form-control">
                        <label for="form_control_1">Umur Masuk</label>
                        <span class="help-block">Masukkan Umur Masuk</span>
                    </div>
                </div> -->
                
            </div>
            <div class="row">
                
                <div class="col-md-6">
                    <div class="form-group form-md-line-input has-success form-md-floating-label">
                        <input type="text" id="hd_periode" name="hd_periode" value="" class="form-control">
                        <label for="form_control_1">HD</label>
                        <span class="help-block">Masukkan HD</span>
                    </div>
                </div>
            </div>
            
            <div id="alert-msg-tambahtrperiode"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" id="batal_tambahperiode" name="batal_tambahperiode">Batal</button>
            <button type="button" class="btn green" id="tambahtrperiode" name="tambahtrperiode">Simpan</button>
        </div>
    </div>
</div>
<!-- Selesai Modal Tambah Data -->

<!-- Mulai Modal Edit Data -->
<div id="edit_tr_periode" class="modal container fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Ubah Data Periode</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group form-md-line-input has-success form-md-floating-label">
                        <input type="text" id="nama_periode_edit" name="nama_periode_edit" value="" class="form-control">
                        <span class="help-block">Masukkan Nama Periode</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-success">
                        <label class="control-label">Tanggal Masuk Kandang</label>
                        <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-end-date="0d">
                            <input name="tanggal_masuk_kandang_edit" id="tanggal_masuk_kandang_edit" type="text" class="form-control" readonly>
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
                
                <div class="col-md-6">
                    <div class="form-group has-success">
                        <label class="control-label">Tanggal Menetas</label>
                        <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-end-date="0d">
                            <input name="tanggal_menetas_edit" id="tanggal_menetas_edit" type="text" class="form-control" readonly>
                            <span class="input-group-btn">
                                <button class="btn default" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-md-line-input has-success form-md-floating-label">
                        <input type="text" id="asal_pullet_edit" name="asal_pullet_edit" value="" class="form-control">
                        <span class="help-block">Masukkan Asal Pullet</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group form-md-line-input has-success form-md-floating-label">
                        <input type="text" id="hd_periode_edit" name="hd_periode_edit" value="" class="form-control">
                        <span class="help-block">Masukkan HD</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-md-line-input has-success">
                        <select class="form-control" name="status_periode_edit" id="status_periode_edit">
                            <option value="" disabled selected>--Pilih--</option>
                            <option value="AKTIF">AKTIF</option>
                            <option value="TIDAK AKTIF">TIDAK AKTIF</option>
                        </select>
                        <div class="form-control-focus"> </div>
                        <span class="help-block">Pilih Status Periode</span>
                    </div>
                </div>
            </div>
            
            <input type="hidden" id="id_periode_edit" name="id_periode_edit" value="" class="form-control">

            <div id="alert-msg-editperiode"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" id="batal_editperiode" name="batal_editperiode">Batal</button>
            <button type="button" class="btn green" id="editperiode" name="editperiode">Simpan</button>
        </div>
    </div>
</div>
<!-- Selesai Modal Edit Data -->

<!-- Mulai Modal Hapus Data -->
<div id="hapus_periode" class="modal container fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Hapus Data Periode</h4>
        </div>
        <div class="modal-body">
            <h5>Apakah Anda Yakin Ingin Menghapus Data "<label id="nama_periode_hapus"></label>". Apabila Data Periode Dihapus, Maka Data Produksi Telor Yang Berhubungan Akan Terhapus Juga?</h5>

            <input type="hidden" id="id_periode_hapus" name="id_periode_hapus" value="" class="form-control">

            <div id="alert-msg-hapusperiode"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" id="batal_hapusperiode" name="batal_hapusperiode">Batal</button>
            <button type="button" class="btn green" id="hapusperiode" name="hapusperiode">Ya</button>
        </div>
    </div>
</div>
<!-- Selesai Modal Hapus Data -->