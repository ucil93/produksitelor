function cleartambahstrainnilai() {
    $("#data_tabel_strain").val("");
    $("#nama_mt_strain_nilai").val("");
    $("#minggu_mt_strain_nilai").val("");
    $("#standar_mt_strain_nilai").val("");
    $("#alert-msg-tambahmtstrainnilai").empty();
};

$('#batal_tambahmtstrainnilai').click(function () {
    cleartambahstrainnilai();
    $('#tambah_mt_strain_nilai').modal('hide');
});

$('#tambahmtstrainnilai').click(function () {
    var form_data = {
        data_tabel_strain: $('#data_tabel_strain').val(),
        nama_mt_strain_nilai: $('#nama_mt_strain_nilai').val(),
        minggu_mt_strain_nilai: $('#minggu_mt_strain_nilai').val(),
        standar_mt_strain_nilai: $('#standar_mt_strain_nilai').val(),
    };
    $.ajax({
        url: base_url + "master_strainnilai/simpan",
        type: 'POST',
        data: form_data,
        success: function (msg) {
            if (msg == 'YES') {
                $('#alert-msg-tambahmtstrainnilai').html('<div class="alert alert-success text-center">Data Berhasil Disimpan!</div>');
                $("#tambah_mt_strain_nilai").fadeTo(10000, 5000).slideUp(2000, function () {
                    $("#tambah_mt_strain_nilai").modal('hide');
                });
                window.location.href = base_url + "master_strainnilai";
            }
            else {
                $('#alert-msg-tambahmtstrainnilai').html('<div class="alert alert-danger">' + msg + '</div>');
            }
        }
    });
    return false;
});

function getDataStrainNilai(id) {
    var json = (function () {
        var json = null;
        $.ajax({
            'async': false,
            'global': false,
            'url': base_url + "master_strainnilai/getDataById",
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

function editDataStrainNilai(id) {
    var json = getDataStrainNilai(id);
    $.map(json, function (item) {
        $('#id_strain_nilai_edit').val(item.id_strain_nilai);
        $('#nama_strain_nilai_edit').val(item.nama_strain_nilai);
        $('#minggu_strain_nilai_edit').val(item.minggu_strain_nilai);
        $('#status_strain_nilai_edit').val(item.status_strain_nilai);
        $('#standar_strain_nilai_edit').val(item.standar_strain_nilai);
        $('#data_tabel_strain_nilai_edit').val(item.id_strain);
        $('#edit_mt_strain_nilai').modal('show');
    })
}

function cleareditstrainnilai() {
    $("#id_strain_nilai_edit").val("");
    $("#nama_strain_nilai_edit").val("");
    $("#minggu_strain_nilai_edit").val("");
    $("#status_strain_nilai_edit").val("");
    $("#standar_strain_nilai_edit").val("");
    $("#data_tabel_strain_nilai_edit").val("");
    $("#alert-msg-editstrainnilai").empty();
};

$('#batal_editstrainnilai').click(function () {
    cleareditstrainnilai();
    $('#edit_mt_strain_nilai').modal('hide');
});

$('#editstrainnilai').click(function () {
    var form_data = {
        id_strain_nilai_edit: $('#id_strain_nilai_edit').val(),
        nama_strain_nilai_edit: $('#nama_strain_nilai_edit').val(),
        minggu_strain_nilai_edit: $('#minggu_strain_nilai_edit').val(),
        status_strain_nilai_edit: $('#status_strain_nilai_edit').val(),
        standar_strain_nilai_edit: $('#standar_strain_nilai_edit').val(),
        data_tabel_strain_nilai_edit: $('#data_tabel_strain_nilai_edit').val(),
    };
    $.ajax({
        url: base_url + "master_strainnilai/simpan_edit",
        type: 'POST',
        data: form_data,
        success: function (msg) {
            if (msg == 'YES') {
                $('#alert-msg-editstrainnilai').html('<div class="alert alert-success text-center">Data Berhasil Disimpan!</div>');
                $("#edit_mt_strain_nilai").fadeTo(10000, 5000).slideUp(2000, function () {
                    $("#edit_mt_strain_nilai").modal('hide');
                });
                window.location.href = base_url + "master_strainnilai";
            }
            else {
                $('#alert-msg-editstrainnilai').html('<div class="alert alert-danger">' + msg + '</div>');
            }
        }
    });
    return false;
});

function hapusDataStrainNilai(id) {
    var json = getDataStrainNilai(id);
    $.map(json, function (item) {
        $('#id_strain_nilai_hapus').val(item.id_strain_nilai);
        $('#nama_strain_nilai_hapus').html(item.nama_strain_nilai);
        $('#hapus_strain_nilai').modal('show');
    })
}

function clearhapusstrainnilai() {
    $("#id_strain_nilai_hapus").val("");
    $("#nama_strain_nilai_hapus").html("");
    $("#alert-msg-hapusstrainnilai").empty();
};

$('#batal_hapusstrainnilai').click(function () {
    clearhapusstrainnilai();
    $('#hapus_strain_nilai').modal('hide');
});

$('#hapusstrainnilai').click(function () {
    var form_data = {
        id_strain_nilai_hapus: $('#id_strain_nilai_hapus').val()
    };
    $.ajax({
        url: base_url + "master_strainnilai/hapus",
        type: 'POST',
        data: form_data,
        success: function (msg) {
            if (msg == 'YES') {
                $('#alert-msg-hapusstrainnilai').html('<div class="alert alert-success text-center">Data Berhasil Dihapus!</div>');
                $("#hapus_strain_nilai").fadeTo(10000, 5000).slideUp(2000, function () {
                    $("#hapus_strain_nilai").modal('hide');
                });
                window.location.href = base_url + "master_strainnilai";
            }
            else if (msg == 'NO') {
                $('#alert-msg-hapusstrainnilai').html('<div class="alert alert-danger text-center">Data Tidak Dapat Dihapus, Karena Masih Ada Di Tempat Lainnya!</div>');
            }
            else {
                $('#alert-msg-hapusstrainnilai').html('<div class="alert alert-danger">' + msg + '</div>');
            }
        }
    });
    return false;
});