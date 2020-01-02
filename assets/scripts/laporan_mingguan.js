$("input[name='jumlah_kandang']").change(function(){
    var dataKandang = '<option value="" disabled selected>--Pilih--</option>';

    $('#dropdown_data_lokasi').val(null);
    $('#dropdown_data_kandang').html(dataKandang);
    $('#data_hasil_laporan').html('');

    var value = $(this).val();
    if(value == 0 || value == '0') {
        $('#span_data_kandang').html('Pilih Data Kandang');
    } else {
        $('#span_data_kandang').html('Pilih Tanggal Menetas');
    }
});

$(document).ready(function () {
    $('#dropdown_data_lokasi').change(function () {
        var id_lokasi = $('#dropdown_data_lokasi').val();
        var jumlah_kandang = $("input[name ='jumlah_kandang']:checked").val();
        if (id_lokasi != '') {
            $.ajax({
                url: base_url + "laporan_mingguan/ambil_kandang",
                method: 'POST',
                data: { 
                    id_lokasi: id_lokasi,
                    jumlah_kandang: jumlah_kandang
                },
                success: function (data) {
                    // console.log(data)
                    $('#dropdown_data_kandang').html(data);
                }
            });
        } else {
            $('#dropdown_data_kandang').html('');
        }
    });
});

$('#cetak_data_mingguan').click(function() {
    var id_lokasi = $('#dropdown_data_lokasi').val();
    var jumlah_kandang = $("input[name ='jumlah_kandang']:checked").val();
    var data_kandang = $('#dropdown_data_kandang').val();

    var dataKandang = '<option value="" disabled selected>--Pilih--</option>';
    var idJumlahKandang = 'jumlah_kandang_satu';

    $.ajax({
        url: base_url + "laporan_mingguan/cetak_laporan",
        method: 'POST',
        data: { 
            id_lokasi: id_lokasi,
            jumlah_kandang: jumlah_kandang,
            data_kandang: data_kandang
        },
        success: function (data) {
            // console.log(data)
            // window.location.href = base_url + "laporan_mingguan/cetak_laporan"
            $('#data_hasil_laporan').html(data);

            $('#dropdown_data_lokasi').val(null);
            $('#dropdown_data_kandang').html(dataKandang);
            $('#' + idJumlahKandang).prop('checked',true);
        }
    });
});