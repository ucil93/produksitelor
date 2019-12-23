function cleartambahlokasi() {
    $("#nama_mt_lokasi").val("");
    $("#alert-msg-tambahmtlokasi").empty();
};

$('#batal_tambahmtlokasi').click(function () {
    cleartambahlokasi();
    $('#tambah_mt_lokasi').modal('hide');
});

$('#tambahmtlokasi').click(function () {
    var form_data = {
        nama_mt_lokasi: $('#nama_mt_lokasi').val(),
    };
    $.ajax({
        url: base_url + "master_lokasi/simpan",
        type: 'POST',
        data: form_data,
        success: function (msg) {
            if (msg == 'YES') {
                $('#alert-msg-tambahmtlokasi').html('<div class="alert alert-success text-center">Data Berhasil Disimpan!</div>');
                $("#tambah_mt_lokasi").fadeTo(10000, 5000).slideUp(2000, function () {
                    $("#tambah_mt_lokasi").modal('hide');
                });
                window.location.href = base_url + "master_lokasi";
            }
            else {
                $('#alert-msg-tambahmtlokasi').html('<div class="alert alert-danger">' + msg + '</div>');
            }
        }
    });
    return false;
});

function getDataLokasi(id) {
    var json = (function () {
        var json = null;
        $.ajax({
            'async': false,
            'global': false,
            'url': base_url + "master_lokasi/getDataById",
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

function editDataLokasi(id) {
    var json = getDataLokasi(id);
    $.map(json, function (item) {
        $('#id_lokasi_edit').val(item.id_lokasi);
        $('#nama_lokasi_edit').val(item.nama_lokasi);
        $('#status_lokasi_edit').val(item.status_lokasi);
        $('#edit_mt_lokasi').modal('show');
    })
}

function cleareditlokasi() {
    $("#id_lokasi_edit").val("");
    $("#nama_lokasi_edit").val("");
    $("#status_lokasi_edit").val("");
    $("#alert-msg-editlokasi").empty();
};

$('#batal_editlokasi').click(function () {
    cleareditlokasi();
    $('#edit_mt_lokasi').modal('hide');
});

$('#editlokasi').click(function () {
    var form_data = {
        id_lokasi_edit: $('#id_lokasi_edit').val(),
        nama_lokasi_edit: $('#nama_lokasi_edit').val(),
        status_lokasi_edit: $('#status_lokasi_edit').val(),
    };
    $.ajax({
        url: base_url + "master_lokasi/simpan_edit",
        type: 'POST',
        data: form_data,
        success: function (msg) {
            if (msg == 'YES') {
                $('#alert-msg-editlokasi').html('<div class="alert alert-success text-center">Data Berhasil Disimpan!</div>');
                $("#edit_mt_lokasi").fadeTo(10000, 5000).slideUp(2000, function () {
                    $("#edit_mt_lokasi").modal('hide');
                });
                window.location.href = base_url + "master_lokasi";
            }
            else {
                $('#alert-msg-editlokasi').html('<div class="alert alert-danger">' + msg + '</div>');
            }
        }
    });
    return false;
});

function hapusDataLokasi(id) {
    var json = getDataLokasi(id);
    $.map(json, function (item) {
        $('#id_lokasi_hapus').val(item.id_lokasi);
        $('#nama_lokasi_hapus').html(item.nama_lokasi);
        $('#hapus_lokasi').modal('show');
    })
}

function clearhapuslokasi() {
    $("#id_lokasi_hapus").val("");
    $("#nama_lokasi_hapus").html("");
    $("#alert-msg-hapuslokasi").empty();
};

$('#batal_hapuslokasi').click(function () {
    clearhapuslokasi();
    $('#hapus_lokasi').modal('hide');
});

$('#hapuslokasi').click(function () {
    var form_data = {
        id_lokasi_hapus: $('#id_lokasi_hapus').val()
    };
    $.ajax({
        url: base_url + "master_lokasi/hapus",
        type: 'POST',
        data: form_data,
        success: function (msg) {
            if (msg == 'YES') {
                $('#alert-msg-hapuslokasi').html('<div class="alert alert-success text-center">Data Berhasil Dihapus!</div>');
                $("#hapus_lokasi").fadeTo(10000, 5000).slideUp(2000, function () {
                    $("#hapus_lokasi").modal('hide');
                });
                window.location.href = base_url + "master_lokasi";
            }
            else if (msg == 'NO') {
                $('#alert-msg-hapuslokasi').html('<div class="alert alert-danger text-center">Data Tidak Dapat Dihapus, Karena Masih Ada Di Tempat Lainnya!</div>');
            }
            else {
                $('#alert-msg-hapuslokasi').html('<div class="alert alert-danger">' + msg + '</div>');
            }
        }
    });
    return false;
});