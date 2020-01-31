$('#batal_tambahproduksi').click(function () {
    $('#modalFixData').modal('hide');
});

$('#tambah_tr_telor').click(function () {

    var id_periode_array = []
    $("input[name='id_periode[]']").each(function ()
    {
        var value = $(this).val();
        if (value)
        {
            id_periode_array.push(value);
        }
    });

    var jumlah_ayam_array = []
    $("input[name='jumlah_ayam[]']").each(function ()
    {
        var value = $(this).val();
        if (value)
        {
            jumlah_ayam_array.push(value);
        }
    });

    var hd_periode_array = []
    $("input[name='hd_periode[]']").each(function ()
    {
        var value = $(this).val();
        if (value)
        {
            hd_periode_array.push(value);
        }
    });

    var data_m_array = []
    $("input[name='data_m[]']").each(function ()
    {
        var value = $(this).val();
        var valueKosong = null;
        if (value)
        {
            data_m_array.push(value);
        }
        else
        {
            data_m_array.push(valueKosong);
        }
    });

    var data_c_array = []
    $("input[name='data_c[]']").each(function ()
    {
        var value = $(this).val();
        var valueKosong = null;
        if (value)
        {
            data_c_array.push(value);
        }
        else
        {
            data_c_array.push(valueKosong);
        }
    });

    var data_pakan_array = []
    $("input[name='data_pakan[]']").each(function ()
    {
        var value = $(this).val();
        var valueKosong = null;
        if (value)
        {
            data_pakan_array.push(value);
        }
        else
        {
            data_pakan_array.push(valueKosong);
        }
    });

    var data_butir_jumlah_array = []
    $("input[name='data_butir_jumlah[]']").each(function ()
    {
        var value = $(this).val();
        var valueKosong = null;
        if (value)
        {
            data_butir_jumlah_array.push(value);
        }
        else
        {
            data_butir_jumlah_array.push(valueKosong);
        }
    });

    var data_rusak_jumlah_array = []
    $("input[name='data_rusak_jumlah[]']").each(function ()
    {
        var value = $(this).val();
        var valueKosong = null;
        if (value)
        {
            data_rusak_jumlah_array.push(value);
        }
        else
        {
            data_rusak_jumlah_array.push(valueKosong);
        }
    });

    var data_butir_kg_array = []
    $("input[name='data_butir_kg[]']").each(function ()
    {
        var value = $(this).val();
        var valueKosong = null;
        if (value)
        {
            data_butir_kg_array.push(value);
        }
        else
        {
            data_butir_kg_array.push(valueKosong);
        }
    });

    var data_rusak_kg_array = []
    $("input[name='data_rusak_kg[]']").each(function ()
    {
        var value = $(this).val();
        var valueKosong = null;
        if (value)
        {
            data_rusak_kg_array.push(value);
        }
        else
        {
            data_rusak_kg_array.push(valueKosong);
        }
    });

    var data_berat_badan_array = []
    $("input[name='data_berat_badan[]']").each(function ()
    {
        var value = $(this).val();
        var valueKosong = null;
        if (value)
        {
            data_berat_badan_array.push(value);
        }
        else
        {
            data_berat_badan_array.push(valueKosong);
        }
    });

    var data_ket_array = []
    $("input[name='data_ket[]']").each(function ()
    {
        var value = $(this).val();
        var valueKosong = null;
        if (value)
        {
            data_ket_array.push(value);
        }
        else
        {
            data_ket_array.push(valueKosong);
        }
    });
    
    var form_data = {
        id_periode: id_periode_array,
        jumlah_ayam: jumlah_ayam_array,
        hd_periode: hd_periode_array,
        data_m: data_m_array,
        data_c: data_c_array,
        data_pakan: data_pakan_array,
        data_butir_jumlah: data_butir_jumlah_array,
        data_rusak_jumlah: data_rusak_jumlah_array,
        data_butir_kg: data_butir_kg_array,
        data_rusak_kg: data_rusak_kg_array,
        data_berat_badan: data_berat_badan_array,
        data_ket: data_ket_array,
        tanggal_catat: $('#tanggal_catat').val(),
        suhu_pagi: $('#suhu_pagi').val(),
        suhu_siang: $('#suhu_siang').val(),
        suhu_sore: $('#suhu_sore').val(),
        suhu_malam: $('#suhu_malam').val(),
    };
    $.ajax({
        url: base_url + "transaksi_telor/simpan",
        type: 'POST',
        data: form_data,
        success: function (msg) {
            var result = JSON.parse(msg);
            var i = 0;
            var status = 0;
            if(result.hasil == "TANGGAL_CATAT") {
                $('#alert-msg-tambahtrtelor').html('<div class="alert alert-danger text-center">Tanggal Catat Harus Diisi!</div>');
            } else {
                if(result.hasil == "SUHU_PAGI") {
                    $('#alert-msg-tambahtrtelor').html('<div class="alert alert-danger text-center">Suhu Pagi Harus Diisi!</div>');
                } else {
                    if(result.hasil == "SUHU_SIANG") {
                        $('#alert-msg-tambahtrtelor').html('<div class="alert alert-danger text-center">Suhu Siang Harus Diisi!</div>');
                    } else {
                        if(result.hasil == "SUHU_SORE") {
                            $('#alert-msg-tambahtrtelor').html('<div class="alert alert-danger text-center">Suhu Sore Harus Diisi!</div>');
                        } else {
                            if(result.hasil == "SUHU_MALAM") {
                                $('#alert-msg-tambahtrtelor').html('<div class="alert alert-danger text-center">Suhu Malam Harus Diisi!</div>');
                            } else {
                                for(i=0; i<result.length; i++) {
                                    if (result[i].hasil == 'NO_DATA_M_KOSONG') {
                                        status = 1;
                                    }
                                    if (result[i].hasil == 'NO_DATA_M_NUMBER') {
                                        status = 2;
                                    }
                                    if (result[i].hasil == 'NO_DATA_C_KOSONG') {
                                        status = 3;
                                    }
                                    if (result[i].hasil == 'NO_DATA_C_NUMBER') {
                                        status = 4;
                                    }
                                    if (result[i].hasil == 'NO_DATA_PAKAN_KOSONG') {
                                        status = 5;
                                    }
                                    if (result[i].hasil == 'NO_DATA_PAKAN_NUMBER') {
                                        status = 6;
                                    }
                                    if (result[i].hasil == 'NO_DATA_BUTIR_JUMLAH_KOSONG') {
                                        status = 7;
                                    }
                                    if (result[i].hasil == 'NO_DATA_BUTIR_JUMLAH_NUMBER') {
                                        status = 8;
                                    }
                                    if (result[i].hasil == 'NO_DATA_RUSAK_JUMLAH_KOSONG') {
                                        status = 9;
                                    }
                                    if (result[i].hasil == 'NO_DATA_RUSAK_JUMLAH_NUMBER') {
                                        status = 10;
                                    }
                                    if (result[i].hasil == 'NO_DATA_BUTIR_KG_KOSONG') {
                                        status = 11;
                                    }
                                    if (result[i].hasil == 'NO_DATA_BUTIR_KG_NUMBER') {
                                        status = 12;
                                    }
                                    if (result[i].hasil == 'NO_DATA_RUSAK_KG_KOSONG') {
                                        status = 13;
                                    }
                                    if (result[i].hasil == 'NO_DATA_RUSAK_KG_NUMBER') {
                                        status = 14;
                                    }
                                    if (result[i].hasil == 'NO_JUMLAH_AYAM') {
                                        status = 15;
                                    }
                                    if (result[i].hasil == 'NO_SETELAH_TANGGAL') {
                                        status = 16;
                                    }
                                }
                
                                if(status == 0) {
                                    $('#alert-msg-tambahtrtelor').html('<div class="alert alert-success text-center">Data Berhasil Disimpan!</div>');
                                    window.location.href = base_url + "transaksi_telor";
                                } else if (status == 1) {
                                    $('#alert-msg-tambahtrtelor').html('<div class="alert alert-danger text-center">Data M Harus Diisi Lengkap!</div>');
                                } else if (status == 2) {
                                    $('#alert-msg-tambahtrtelor').html('<div class="alert alert-danger text-center">Data M Harus Diisi Angka!</div>');
                                } else if (status == 3) {
                                    $('#alert-msg-tambahtrtelor').html('<div class="alert alert-danger text-center">Data C Harus Diisi Lengkap!</div>');
                                } else if (status == 4) {
                                    $('#alert-msg-tambahtrtelor').html('<div class="alert alert-danger text-center">Data C Harus Diisi Angka!</div>');
                                } else if (status == 5) {
                                    $('#alert-msg-tambahtrtelor').html('<div class="alert alert-danger text-center">Data Pakan Harus Diisi Lengkap!</div>');
                                } else if (status == 6) {
                                    $('#alert-msg-tambahtrtelor').html('<div class="alert alert-danger text-center">Data Pakan Harus Diisi Angka!</div>');
                                } else if (status == 7) {
                                    $('#alert-msg-tambahtrtelor').html('<div class="alert alert-danger text-center">Data Butir Jumlah Harus Diisi Lengkap!</div>');
                                } else if (status == 8) {
                                    $('#alert-msg-tambahtrtelor').html('<div class="alert alert-danger text-center">Data Butir Jumlah Harus Diisi Angka!</div>');
                                } else if (status == 9) {
                                    $('#alert-msg-tambahtrtelor').html('<div class="alert alert-danger text-center">Data Rusak Jumlah Harus Diisi Lengkap!</div>');
                                } else if (status == 10) {
                                    $('#alert-msg-tambahtrtelor').html('<div class="alert alert-danger text-center">Data Rusak Jumlah Harus Diisi Angka!</div>');
                                } else if (status == 11) {
                                    $('#alert-msg-tambahtrtelor').html('<div class="alert alert-danger text-center">Data Butir Kg Harus Diisi Lengkap!</div>');
                                } else if (status == 12) {
                                    $('#alert-msg-tambahtrtelor').html('<div class="alert alert-danger text-center">Data Butir Kg Harus Diisi Angka!</div>');
                                } else if (status == 13) {
                                    $('#alert-msg-tambahtrtelor').html('<div class="alert alert-danger text-center">Data Rusak Kg Harus Diisi Lengkap!</div>');
                                } else if (status == 14) {
                                    $('#alert-msg-tambahtrtelor').html('<div class="alert alert-danger text-center">Data Rusak Kg Harus Diisi Angka!</div>');
                                } else if (status == 15) {
                                    $('#alert-msg-tambahtrtelor').html('<div class="alert alert-danger text-center">Jumlah Ayam M dan C Melebihi Jumlah Seluruh Ayam!</div>');
                                } else if (status == 16) {
                                    $('#alert-msg-tambahtrtelor').html('<div class="alert alert-danger text-center">Terdapat Data Setelah Tanggal Input!</div>');
                                }
                            }
                        }
                    }
                }
            }
        }
    });
    return false;
});

function getDataProduksi(id) {
    var json = (function () {
        var json = null;
        $.ajax({
            'async': false,
            'global': false,
            'url': base_url + "transaksi_telor/getDataById",
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

function hapusDataProduksi(id) {
    var json = getDataProduksi(id);
    $.map(json, function (item) {
        $('#id_produksi_hapus').val(item.id_produksi);
        $('#id_periode_hapus').val(item.id_periode);
        $('#tanggal_catat_value_hapus').val(item.tanggal_catat);
        $('#tanggal_catat_hapus').html(moment(item.tanggal_catat, 'YYYY-MM-DD').format('DD MMMM YYYY'));
        $('#hapus_produksi').modal('show');
    })
}

function clearhapusproduksi() {
    $("#id_produksi_hapus").val("");
    $("#id_periode_hapus").val("");
    $("#tanggal_catat_value_hapus").val("");
    $("#tanggal_catat_hapus").html("");
    $("#alert-msg-hapusproduksi").empty();
};

$('#batal_hapusproduksi').click(function () {
    clearhapusproduksi();
    $('#hapus_produksi').modal('hide');
});

$('#hapusproduksi').click(function () {
    var form_data = {
        id_produksi_hapus: $('#id_produksi_hapus').val(),
        id_periode_hapus: $('#id_periode_hapus').val(),
        tanggal_catat_value_hapus: $('#tanggal_catat_value_hapus').val(),
    };
    $.ajax({
        url: base_url + "transaksi_telor/hapus",
        type: 'POST',
        data: form_data,
        success: function (msg) {
            if (msg == 'YES') {
                $('#alert-msg-hapusproduksi').html('<div class="alert alert-success text-center">Data Berhasil Dihapus!</div>');
                $("#hapus_produksi").fadeTo(10000, 5000).slideUp(2000, function () {
                    $("#hapus_produksi").modal('hide');
                });
                window.location.href = base_url + "transaksi_telor";
            }
            else if (msg == 'NO') {
                $('#alert-msg-hapusproduksi').html('<div class="alert alert-danger text-center">Data Tidak Dapat Dihapus, Karena Masih Ada Di Atas Tanggal Pilih!</div>');
            }
            else {
                $('#alert-msg-hapusproduksi').html('<div class="alert alert-danger">' + msg + '</div>');
            }
        }
    });
    return false;
});