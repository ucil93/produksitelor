function cleartambahstrain() {
    $("#nama_mt_strain").val("");
    $("#alert-msg-tambahmtstrain").empty();
};

$('#batal_tambahmtstrain').click(function () {
    cleartambahstrain();
    $('#tambah_mt_strain').modal('hide');
});

$('#tambahmtstrain').click(function () {
    var form_data = {
        nama_mt_strain: $('#nama_mt_strain').val(),
    };
    $.ajax({
        url: base_url + "master_strain/simpan",
        type: 'POST',
        data: form_data,
        success: function (msg) {
            if (msg == 'YES') {
                $('#alert-msg-tambahmtstrain').html('<div class="alert alert-success text-center">Data Berhasil Disimpan!</div>');
                $("#tambah_mt_strain").fadeTo(10000, 5000).slideUp(2000, function () {
                    $("#tambah_mt_strain").modal('hide');
                });
                window.location.href = base_url + "master_strain";
            }
            else {
                $('#alert-msg-tambahmtstrain').html('<div class="alert alert-danger">' + msg + '</div>');
            }
        }
    });
    return false;
});

function getDataStrain(id) {
    var json = (function () {
        var json = null;
        $.ajax({
            'async': false,
            'global': false,
            'url': base_url + "master_strain/getDataById",
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

function editDataStrain(id) {
    var json = getDataStrain(id);
    $.map(json, function (item) {
        $('#id_strain_edit').val(item.id_strain);
        $('#nama_strain_edit').val(item.nama_strain);
        $('#status_strain_edit').val(item.status_strain);
        $('#edit_mt_strain').modal('show');
    })
}

function cleareditstrain() {
    $("#id_strain_edit").val("");
    $("#nama_strain_edit").val("");
    $("#status_strain_edit").val("");
    $("#alert-msg-editstrain").empty();
};

$('#batal_editstrain').click(function () {
    cleareditstrain();
    $('#edit_mt_strain').modal('hide');
});

$('#editstrain').click(function () {
    var form_data = {
        id_strain_edit: $('#id_strain_edit').val(),
        nama_strain_edit: $('#nama_strain_edit').val(),
        status_strain_edit: $('#status_strain_edit').val(),
    };
    $.ajax({
        url: base_url + "master_strain/simpan_edit",
        type: 'POST',
        data: form_data,
        success: function (msg) {
            if (msg == 'YES') {
                $('#alert-msg-editstrain').html('<div class="alert alert-success text-center">Data Berhasil Disimpan!</div>');
                $("#edit_mt_strain").fadeTo(10000, 5000).slideUp(2000, function () {
                    $("#edit_mt_strain").modal('hide');
                });
                window.location.href = base_url + "master_strain";
            }
            else {
                $('#alert-msg-editstrain').html('<div class="alert alert-danger">' + msg + '</div>');
            }
        }
    });
    return false;
});

function hapusDataStrain(id) {
    var json = getDataStrain(id);
    $.map(json, function (item) {
        $('#id_strain_hapus').val(item.id_strain);
        $('#nama_strain_hapus').html(item.nama_strain);
        $('#hapus_strain').modal('show');
    })
}

function clearhapusstrain() {
    $("#id_strain_hapus").val("");
    $("#nama_strain_hapus").html("");
    $("#alert-msg-hapusstrain").empty();
};

$('#batal_hapusstrain').click(function () {
    clearhapusstrain();
    $('#hapus_strain').modal('hide');
});

$('#hapusstrain').click(function () {
    var form_data = {
        id_strain_hapus: $('#id_strain_hapus').val()
    };
    $.ajax({
        url: base_url + "master_strain/hapus",
        type: 'POST',
        data: form_data,
        success: function (msg) {
            if (msg == 'YES') {
                $('#alert-msg-hapusstrain').html('<div class="alert alert-success text-center">Data Berhasil Dihapus!</div>');
                $("#hapus_strain").fadeTo(10000, 5000).slideUp(2000, function () {
                    $("#hapus_strain").modal('hide');
                });
                window.location.href = base_url + "master_strain";
            }
            else if (msg == 'NO') {
                $('#alert-msg-hapusstrain').html('<div class="alert alert-danger text-center">Data Tidak Dapat Dihapus, Karena Masih Ada Di Tempat Lainnya!</div>');
            }
            else {
                $('#alert-msg-hapusstrain').html('<div class="alert alert-danger">' + msg + '</div>');
            }
        }
    });
    return false;
});