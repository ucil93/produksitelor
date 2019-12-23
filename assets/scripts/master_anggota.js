function cleartambahanggota() {
    $("#nama_mt_anggota").val("");
    $("#password_mt_anggota").val("");
    $("#grup_mt_anggota").val("");
    $("#alert-msg-tambahmtanggota").empty();
};

$('#batal_tambahmtanggota').click(function () {
    cleartambahanggota();
    $('#tambah_mt_anggota').modal('hide');
});

$('#tambahmtanggota').click(function () {
    var form_data = {
        nama_anggota: $('#nama_mt_anggota').val(),
        password_anggota: $('#password_mt_anggota').val(),
        grup_anggota: $('#grup_mt_anggota').val(),
    };
    $.ajax({
        url: base_url + "master_anggota/simpan",
        type: 'POST',
        data: form_data,
        success: function (msg) {
            if (msg == 'YES') {
                $('#alert-msg-tambahmtanggota').html('<div class="alert alert-success text-center">Data Berhasil Disimpan!</div>');
                $("#tambah_mt_anggota").fadeTo(10000, 5000).slideUp(2000, function () {
                    $("#tambah_mt_anggota").modal('hide');
                });
                window.location.href = base_url + "master_anggota";
            }
            else {
                $('#alert-msg-tambahmtanggota').html('<div class="alert alert-danger">' + msg + '</div>');
            }
        }
    });
    return false;
});

function getDataAnggota(id) {
    var json = (function () {
        var json = null;
        $.ajax({
            'async': false,
            'global': false,
            'url': base_url + "master_anggota/getDataById",
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

function editDataAnggota(id) {
    var json = getDataAnggota(id);
    $.map(json, function (item) {
        $('#id_anggota_edit').val(item.id_anggota);
        $('#nama_anggota_edit').val(item.nama_anggota);
        $('#status_anggota_edit').val(item.status_anggota);
        $('#grup_anggota_edit').val(item.grup_anggota);
        $('#edit_mt_anggota').modal('show');
    })
}

function cleareditanggota() {
    $("#id_anggota_edit").val("");
    $("#nama_anggota_edit").val("");
    $("#status_anggota_edit").val("");
    $("#grup_anggota_edit").val("");
    $("#alert-msg-editanggota").empty();
};

$('#batal_editanggota').click(function () {
    cleareditanggota();
    $('#edit_mt_anggota').modal('hide');
});

$('#editanggota').click(function () {
    var form_data = {
        id_anggota_edit: $('#id_anggota_edit').val(),
        nama_anggota_edit: $('#nama_anggota_edit').val(),
        status_anggota_edit: $('#status_anggota_edit').val(),
        grup_anggota_edit: $('#grup_anggota_edit').val(),
    };
    $.ajax({
        url: base_url + "master_anggota/simpan_edit",
        type: 'POST',
        data: form_data,
        success: function (msg) {
            if (msg == 'YES') {
                $('#alert-msg-editanggota').html('<div class="alert alert-success text-center">Data Berhasil Disimpan!</div>');
                $("#edit_mt_anggota").fadeTo(10000, 5000).slideUp(2000, function () {
                    $("#edit_mt_anggota").modal('hide');
                });
                window.location.href = base_url + "master_anggota";
            }
            else {
                $('#alert-msg-editanggota').html('<div class="alert alert-danger">' + msg + '</div>');
            }
        }
    });
    return false;
});

function hapusDataAnggota(id) {
    var json = getDataAnggota(id);
    $.map(json, function (item) {
        $('#id_anggota_hapus').val(item.id_anggota);
        $('#nama_anggota_hapus').html(item.nama_anggota);
        $('#hapus_anggota').modal('show');
    })
}

function clearhapusanggota() {
    $("#id_anggota_hapus").val("");
    $("#nama_anggota_hapus").html("");
    $("#alert-msg-hapusanggota").empty();
};

$('#batal_hapusanggota').click(function () {
    clearhapusanggota();
    $('#hapus_anggota').modal('hide');
});

$('#hapusanggota').click(function () {
    var form_data = {
        id_anggota_hapus: $('#id_anggota_hapus').val()
    };
    $.ajax({
        url: base_url + "master_anggota/hapus",
        type: 'POST',
        data: form_data,
        success: function (msg) {
            if (msg == 'YES') {
                $('#alert-msg-hapusanggota').html('<div class="alert alert-success text-center">Data Berhasil Dihapus!</div>');
                $("#hapus_anggota").fadeTo(10000, 5000).slideUp(2000, function () {
                    $("#hapus_anggota").modal('hide');
                });
                window.location.href = base_url + "master_anggota";
            }
            else {
                $('#alert-msg-hapusanggota').html('<div class="alert alert-danger">' + msg + '</div>');
            }
        }
    });
    return false;
});

function resetPassword(id) {
    var json = getDataAnggota(id);
    $.map(json, function (item) {
        $('#id_anggota_reset').val(item.id_anggota);
        $('#nama_anggota_reset').html(item.nama_anggota);
        $('#reset_password').modal('show');
    })
}

function clearresetpassword() {
    $("#id_anggota_reset").val("");
    $("#nama_anggota_reset").html("");
    $("#alert-msg-resetpassword").empty();
};

$('#batal_resetpassword').click(function () {
    clearresetpassword();
    $('#reset_password').modal('hide');
});

$('#resetpassword').click(function () {
    var form_data = {
        id_anggota_reset: $('#id_anggota_reset').val()
    };
    $.ajax({
        url: base_url + "master_anggota/reset",
        type: 'POST',
        data: form_data,
        success: function (msg) {
            if (msg == 'YES') {
                $('#alert-msg-resetpassword').html('<div class="alert alert-success text-center">Kata Sandi Berhasil DIreset!</div>');
                $("#hapus_anggota").fadeTo(10000, 5000).slideUp(2000, function () {
                    $("#hapus_anggota").modal('hide');
                });
                window.location.href = base_url + "master_anggota";
            }
            else {
                $('#alert-msg-resetpassword').html('<div class="alert alert-danger">' + msg + '</div>');
            }
        }
    });
    return false;
});