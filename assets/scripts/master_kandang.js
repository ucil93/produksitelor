function cleartambahkandang() {
    $("#data_tabel_lokasi").val("");
    $("#nama_mt_kandang").val("");
    $("#kapasitas_mt_kandang").val("");
    $("#alert-msg-tambahmtkandang").empty();
};

$('#batal_tambahmtkandang').click(function () {
    cleartambahkandang();
    $('#tambah_mt_kandang').modal('hide');
});

$('#tambahmtkandang').click(function () {
    var form_data = {
        data_tabel_lokasi: $('#data_tabel_lokasi').val(),
        nama_mt_kandang: $('#nama_mt_kandang').val(),
        kapasitas_mt_kandang: $('#kapasitas_mt_kandang').val(),
    };
    $.ajax({
        url: base_url + "master_kandang/simpan",
        type: 'POST',
        data: form_data,
        success: function (msg) {
            if (msg == 'YES') {
                $('#alert-msg-tambahmtkandang').html('<div class="alert alert-success text-center">Data Berhasil Disimpan!</div>');
                $("#tambah_mt_kandang").fadeTo(10000, 5000).slideUp(2000, function () {
                    $("#tambah_mt_kandang").modal('hide');
                });
                window.location.href = base_url + "master_kandang";
            }
            else {
                $('#alert-msg-tambahmtkandang').html('<div class="alert alert-danger">' + msg + '</div>');
            }
        }
    });
    return false;
});

function getDataKandang(id) {
    var json = (function () {
        var json = null;
        $.ajax({
            'async': false,
            'global': false,
            'url': base_url + "master_kandang/getDataById",
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

function editDataKandang(id) {
    var json = getDataKandang(id);
    $.map(json, function (item) {
        $('#id_kandang_edit').val(item.id_kandang);
        $('#nama_kandang_edit').val(item.nama_kandang);
        $('#status_kandang_edit').val(item.status_kandang);
        $('#kapasitas_kandang_edit').val(item.kapasitas_ayam);
        $('#data_tabel_lokasi_edit').val(item.id_lokasi);
        $('#edit_mt_kandang').modal('show');
    })
}

function cleareditkandang() {
    $("#id_kandang_edit").val("");
    $("#nama_kandang_edit").val("");
    $("#status_kandang_edit").val("");
    $("#kapasitas_kandang_edit").val("");
    $("#data_tabel_lokasi_edit").val("");
    $("#alert-msg-editkandang").empty();
};

$('#batal_editkandang').click(function () {
    cleareditkandang();
    $('#edit_mt_kandang').modal('hide');
});

$('#editkandang').click(function () {
    var form_data = {
        id_kandang_edit: $('#id_kandang_edit').val(),
        nama_kandang_edit: $('#nama_kandang_edit').val(),
        status_kandang_edit: $('#status_kandang_edit').val(),
        kapasitas_kandang_edit: $('#kapasitas_kandang_edit').val(),
        data_tabel_lokasi_edit: $('#data_tabel_lokasi_edit').val(),
    };
    $.ajax({
        url: base_url + "master_kandang/simpan_edit",
        type: 'POST',
        data: form_data,
        success: function (msg) {
            if (msg == 'YES') {
                $('#alert-msg-editkandang').html('<div class="alert alert-success text-center">Data Berhasil Disimpan!</div>');
                $("#edit_mt_kandang").fadeTo(10000, 5000).slideUp(2000, function () {
                    $("#edit_mt_kandang").modal('hide');
                });
                window.location.href = base_url + "master_kandang";
            }
            else {
                $('#alert-msg-editkandang').html('<div class="alert alert-danger">' + msg + '</div>');
            }
        }
    });
    return false;
});

function hapusDataKandang(id) {
    var json = getDataKandang(id);
    $.map(json, function (item) {
        $('#id_kandang_hapus').val(item.id_kandang);
        $('#nama_kandang_hapus').html(item.nama_kandang);
        $('#hapus_kandang').modal('show');
    })
}

function clearhapuskandang() {
    $("#id_kandang_hapus").val("");
    $("#nama_kandang_hapus").html("");
    $("#alert-msg-hapuskandang").empty();
};

$('#batal_hapuskandang').click(function () {
    clearhapuskandang();
    $('#hapus_kandang').modal('hide');
});

$('#hapuskandang').click(function () {
    var form_data = {
        id_kandang_hapus: $('#id_kandang_hapus').val()
    };
    $.ajax({
        url: base_url + "master_kandang/hapus",
        type: 'POST',
        data: form_data,
        success: function (msg) {
            if (msg == 'YES') {
                $('#alert-msg-hapuskandang').html('<div class="alert alert-success text-center">Data Berhasil Dihapus!</div>');
                $("#hapus_kandang").fadeTo(10000, 5000).slideUp(2000, function () {
                    $("#hapus_kandang").modal('hide');
                });
                window.location.href = base_url + "master_kandang";
            }
            else {
                $('#alert-msg-hapuskandang').html('<div class="alert alert-danger">' + msg + '</div>');
            }
        }
    });
    return false;
});