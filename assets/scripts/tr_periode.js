$(document).ready(function () {
    $('#data_tabel_lokasi').change(function () {
        var id_lokasi = $('#data_tabel_lokasi').val();
        if (id_lokasi != '') {
            $.ajax({
                url: base_url + "transaksi_periode/ambil_kandang",
                method: 'POST',
                data: { id_lokasi: id_lokasi },
                success: function (data) {
                    $('#data_kandang').html(data);
                }
            });
        }
        else {
            $('#data_kandang').html('<option value="" disabled selected>--Pilih--</option>');
        }
    });
});

function cleartambahperiode() {
    $("#data_tabel_lokasi").val("");
    $("#data_kandang").val("");
    $("#data_tabel_strain").val("");
    $("#nama_periode").val("");
    $("#ayam_masuk").val("");
    $("#tanggal_masuk_kandang").val("");
    $("#tanggal_menetas").val("");
    // $("#umur_masuk").val("");
    $("#asal_pullet").val("");
    $("#hd_periode").val("");
    $("#alert-msg-tambahtrperiode").empty();
};

$('#batal_tambahperiode').click(function () {
    cleartambahperiode();
    $('#tambah_tr_periode').modal('hide');
});

$('#tambahtrperiode').click(function () {
    var form_data = {
        data_tabel_lokasi: $('#data_tabel_lokasi').val(),
        data_kandang: $('#data_kandang').val(),
        data_tabel_strain: $('#data_tabel_strain').val(),
        nama_periode: $('#nama_periode').val(),
        ayam_masuk: $('#ayam_masuk').val(),
        tanggal_masuk_kandang: $('#tanggal_masuk_kandang').val(),
        tanggal_menetas: $('#tanggal_menetas').val(),
        // umur_masuk: $('#umur_masuk').val(),
        asal_pullet: $('#asal_pullet').val(),
        hd_periode: $('#hd_periode').val(),
    };
    $.ajax({
        url: base_url + "transaksi_periode/simpan",
        type: 'POST',
        data: form_data,
        success: function (msg) {
            if (msg == 'YES') {
                $('#alert-msg-tambahtrperiode').html('<div class="alert alert-success text-center">Data Berhasil Disimpan!</div>');
                $("#tambah_tr_periode").fadeTo(10000, 5000).slideUp(2000, function () {
                    $("#tambah_tr_periode").modal('hide');
                });
                window.location.href = base_url + "transaksi_periode";
            }
            else if (msg == 'NO1') {
                $('#alert-msg-tambahtrperiode').html('<div class="alert alert-danger text-center">Data Kandang Sudah Ada!</div>');
            }
            else if (msg == 'NO2') {
                $('#alert-msg-tambahtrperiode').html('<div class="alert alert-danger text-center">Jumlah Ayam Tidak Boleh Melebihi Kapasitas Kandang!</div>');
            }
            else {
                $('#alert-msg-tambahtrperiode').html('<div class="alert alert-danger">' + msg + '</div>');
            }
        }
    });
    return false;
});

function getDataPeriode(id) {
    var json = (function () {
        var json = null;
        $.ajax({
            'async': false,
            'global': false,
            'url': base_url + "transaksi_periode/getDataById",
            'data': { 'id': id },
            'dataType': "json",
            'success': function (data) {
                json = data;
            }
        });
        return json;
    })();
    return json;
}

function editDataPeriode(id) {
    var json = getDataPeriode(id);
    $.map(json, function (item) {
        $('#id_periode_edit').val(item.id_periode);
        $('#nama_periode_edit').val(item.nama_periode);
        $('#hd_periode_edit').val(item.hd_periode);
        $('#status_periode_edit').val(item.status_periode);
        $('#tanggal_masuk_kandang_edit').val(moment(item.tanggal_masuk_kandang, 'YYYY-MM-DD').format('YYYY-MM-DD'));
        $('#tanggal_menetas_edit').val(moment(item.tanggal_menetas, 'YYYY-MM-DD').format('YYYY-MM-DD'));
        $('#asal_pullet_edit').val(item.asal_pullet);
        $('#edit_tr_periode').modal('show');
    })
}

function cleareditperiode() {
    $("#id_periode_edit").val("");
    $("#nama_periode_edit").val("");
    $("#hd_periode_edit").val("");
    $("#status_periode_edit").val("");
    $("#tanggal_masuk_kandang_edit").val("");
    $("#tanggal_menetas_edit").val("");
    $("#asal_pullet_edit").val("");
    $("#alert-msg-editperiode").empty();
};

$('#batal_editperiode').click(function () {
    cleareditperiode();
    $('#edit_tr_periode').modal('hide');
});

$('#editperiode').click(function () {
    var form_data = {
        id_periode_edit: $('#id_periode_edit').val(),
        nama_periode_edit: $('#nama_periode_edit').val(),
        hd_periode_edit: $('#hd_periode_edit').val(),
        status_periode_edit: $('#status_periode_edit').val(),
        tanggal_masuk_kandang_edit: $('#tanggal_masuk_kandang_edit').val(),
        tanggal_menetas_edit: $('#tanggal_menetas_edit').val(),
        asal_pullet_edit: $('#asal_pullet_edit').val(),
    };
    $.ajax({
        url: base_url + "transaksi_periode/simpan_edit",
        type: 'POST',
        data: form_data,
        success: function (msg) {
            if (msg == 'YES') {
                $('#alert-msg-editperiode').html('<div class="alert alert-success text-center">Data Berhasil Disimpan!</div>');
                $("#edit_tr_periode").fadeTo(10000, 5000).slideUp(2000, function () {
                    $("#edit_tr_periode").modal('hide');
                });
                window.location.href = base_url + "transaksi_periode";
            }
            else {
                $('#alert-msg-editperiode').html('<div class="alert alert-danger">' + msg + '</div>');
            }
        }
    });
    return false;
});