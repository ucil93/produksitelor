$("input[name='jumlah_kandang_harian']").change(function(){
    var dataKandang = '<option value="" disabled selected>--Pilih--</option>';

    $('#lokasi_harian_satu_kandang').val(null);
    $('#kandang_harian_satu_kandang').html(dataKandang);
    $('#data_hasil_laporan_harian').html('');

    // var value = $(this).val();
    // if(value == 0 || value == '0') {
    //     $('#span_data_kandang').html('Pilih Data Kandang');
    // } else {
    //     $('#span_data_kandang').html('Pilih Tanggal Menetas');
    // }

    $('#lokasi_harian_banyak_kandang').val(null);
    $('#kandang_harian_banyak_kandang').html('');
    $('#tanggal_mulai_harian_banyak_kandang').val(null);
    $('#tanggal_selesai_harian_banyak_kandang').val(null);

    $("#harian_satu_kandang").toggleClass('collapse');
    $("#harian_banyak_kandang").toggleClass('collapse');
});

$(document).ready(function () {
    $('#export1').hide();
    $('#export2').hide();
    $('#lokasi_harian_satu_kandang').change(function () {
        var id_lokasi = $('#lokasi_harian_satu_kandang').val();
        // var jumlah_kandang = $("input[name ='jumlah_kandang']:checked").val();
        if (id_lokasi != '') {
            $.ajax({
                url: base_url + "laporan_harian/ambil_harian_satu_kandang",
                method: 'POST',
                data: { 
                    id_lokasi: id_lokasi,
                    // jumlah_kandang: jumlah_kandang
                },
                success: function (data) {
                    // console.log(data)
                    $('#kandang_harian_satu_kandang').html(data);
                }
            });
        } else {
            $('#kandang_harian_satu_kandang').html('');
        }
    });
});
$("#export1").click(function(){
    $("#tabel_laporan").table2excel({
      fileext:".xls",
          exclude:".noExl",
        name:"Worksheet Name",
        filename:"laporan_mingguan",
      });
  });

$('#cetak_data_harian_satu_kandang').click(function() {
    var id_lokasi = $('#lokasi_harian_satu_kandang').val();
    // var jumlah_kandang = $("input[name ='jumlah_kandang']:checked").val();
    var data_kandang = $('#kandang_harian_satu_kandang').val();

    var dataKandang = '<option value="" disabled selected>--Pilih--</option>';
    var idJumlahKandang = 'jumlah_kandang_harian_satu';

    $.ajax({
        url: base_url + "laporan_harian/cetak_laporan_harian_satu_kandang",
        method: 'POST',
        data: { 
            id_lokasi: id_lokasi,
            // jumlah_kandang: jumlah_kandang,
            data_kandang: data_kandang
        },
        success: function (data) {
            // console.log(data)
            // window.location.href = base_url + "laporan_harian/cetak_laporan"
            $('#data_hasil_laporan_harian').html(data);

            $('#lokasi_harian_satu_kandang').val(null);
            $('#kandang_harian_satu_kandang').html(dataKandang);
            $('#' + idJumlahKandang).prop('checked',true);
            $('#export1').show();
        }
    });
});

$('#lokasi_harian_banyak_kandang').click(function() {
    var id_lokasi = $('#lokasi_harian_banyak_kandang').val();
    // var jumlah_kandang = $("input[name ='jumlah_kandang']:checked").val();
    if (id_lokasi != '') {
        $.ajax({
            url: base_url + "laporan_harian/ambil_harian_banyak_kandang",
            method: 'POST',
            data: { 
                id_lokasi: id_lokasi,
                // jumlah_kandang: jumlah_kandang
            },
            success: function (data) {
                // console.log(data)
                $('#kandang_harian_banyak_kandang').html(data);
            }
        });
    } else {
        $('#kandang_harian_banyak_kandang').html('');
    }
});
$("#export2").click(function(){
    $("#tabel_laporan").table2excel({
        exclude:".noExl",
        name:"Laporan Harian",
        filename:"laporan_harian",
        fileext:".xls",
      });
  
  });

$('#cetak_data_harian_banyak_kandang').click(function() {
    var id_lokasi = $('#lokasi_harian_banyak_kandang').val();

    var checkbox_harian_banyak_kandang = []
    $("input[name='checkbox_harian_banyak_kandang[]']:checked").each(function () {
        checkbox_harian_banyak_kandang.push($(this).val());
    });

    // var tanggal_mulai = $('#tanggal_mulai_harian_banyak_kandang').val();
    // var tanggal_selesai = $('#tanggal_selesai_harian_banyak_kandang').val();

    var dataKandang = '<option value="" disabled selected>--Pilih--</option>';
    var idJumlahKandang = 'jumlah_kandang_harian_banyak';

    $.ajax({
        url: base_url + "laporan_harian/cetak_laporan_harian_banyak_kandang",
        method: 'POST',
        data: { 
            id_lokasi: id_lokasi,
            data_kandang: checkbox_harian_banyak_kandang,
        },
        success: function (data) {
            // console.log(data)
            // window.location.href = base_url + "laporan_harian/cetak_laporan"
            $('#data_hasil_laporan_harian').html(data);
            
            $('#lokasi_harian_banyak_kandang').val(null);
            $('#kandang_harian_banyak_kandang').html('');
            $('#' + idJumlahKandang).prop('checked',true);

            
            $('#export2').show();
        }
    });
});