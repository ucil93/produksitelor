$("input[name='jumlah_kandang_mingguan']").change(function(){
    var dataKandang = '<option value="" disabled selected>--Pilih--</option>';

    $('#lokasi_mingguan_satu_kandang').val(null);
    $('#kandang_mingguan_satu_kandang').html(dataKandang);
    $('#data_hasil_laporan_mingguan').html('');

    // var value = $(this).val();
    // if(value == 0 || value == '0') {
    //     $('#span_data_kandang').html('Pilih Data Kandang');
    // } else {
    //     $('#span_data_kandang').html('Pilih Tanggal Menetas');
    // }

    $('#lokasi_mingguan_banyak_kandang').val(null);
    $('#kandang_mingguan_banyak_kandang').html('');
    $('#tanggal_mulai_mingguan_banyak_kandang').val(null);
    $('#tanggal_selesai_mingguan_banyak_kandang').val(null);

    $("#mingguan_satu_kandang").toggleClass('collapse');
    $("#mingguan_banyak_kandang").toggleClass('collapse');
});

$(document).ready(function () {
    $('#btnExport1').hide();
    $('#btnExport2').hide();
    $('#lokasi_mingguan_satu_kandang').change(function () {
        var id_lokasi = $('#lokasi_mingguan_satu_kandang').val();
        // var jumlah_kandang = $("input[name ='jumlah_kandang']:checked").val();
        if (id_lokasi != '') {
            $.ajax({
                url: base_url + "laporan_mingguan/ambil_mingguan_satu_kandang",
                method: 'POST',
                data: { 
                    id_lokasi: id_lokasi,
                    // jumlah_kandang: jumlah_kandang
                },
                success: function (data) {
                    // console.log(data)
                    $('#kandang_mingguan_satu_kandang').html(data);
                }
            });
        } else {
            $('#kandang_mingguan_satu_kandang').html('');
        }
    });
});
$("#btnExport1").click(function(){
    $("#tabel_laporan").table2excel({
      fileext:".xls",
          exclude:".noExl",
        name:"Worksheet Name",
        filename:"laporan_mingguan",
      });
  });

$('#cetak_data_mingguan_satu_kandang').click(function() {
    var id_lokasi = $('#lokasi_mingguan_satu_kandang').val();
    // var jumlah_kandang = $("input[name ='jumlah_kandang']:checked").val();
    var data_kandang = $('#kandang_mingguan_satu_kandang').val();

    var dataKandang = '<option value="" disabled selected>--Pilih--</option>';
    var idJumlahKandang = 'jumlah_kandang_mingguan_satu';

    $.ajax({
        url: base_url + "laporan_mingguan/cetak_laporan_mingguan_satu_kandang",
        method: 'POST',
        data: { 
            id_lokasi: id_lokasi,
            // jumlah_kandang: jumlah_kandang,
            data_kandang: data_kandang
        },
        success: function (data) {
            // console.log(data)
            // window.location.href = base_url + "laporan_mingguan/cetak_laporan"
            $('#data_hasil_laporan_mingguan').html(data);

            $('#lokasi_mingguan_satu_kandang').val(null);
            $('#kandang_mingguan_satu_kandang').html(dataKandang);
            $('#' + idJumlahKandang).prop('checked',true);
            $('#btnExport1').show();
        }
    });
});

$('#lokasi_mingguan_banyak_kandang').click(function() {
    var id_lokasi = $('#lokasi_mingguan_banyak_kandang').val();
    // var jumlah_kandang = $("input[name ='jumlah_kandang']:checked").val();
    if (id_lokasi != '') {
        $.ajax({
            url: base_url + "laporan_mingguan/ambil_mingguan_banyak_kandang",
            method: 'POST',
            data: { 
                id_lokasi: id_lokasi,
                // jumlah_kandang: jumlah_kandang
            },
            success: function (data) {
                // console.log(data)
                $('#kandang_mingguan_banyak_kandang').html(data);
            }
        });
    } else {
        $('#kandang_mingguan_banyak_kandang').html('');
    }
});
$("#btnExport2").click(function(){
    $("#tabel_laporan").table2excel({
        exclude:".noExl",
        name:"Worksheet Name",
        filename:"laporan_mingguan",
        fileext:".xls",
      });
  
  });

//   $('#tanggal_mulai_mingguan_banyak_kandang').change(function(){
//     // alert($('#tanggal_mulai_mingguan_banyak_kandang').val())
//     var tanggal_selesai =new Date($('#tanggal_selesai_mingguan_banyak_kandang').val());
//     var tanggal_mulai =new Date($('#tanggal_mulai_mingguan_banyak_kandang').val());
//     if($('#tanggal_selesai_mingguan_banyak_kandang').val()=='0' || $('#tanggal_selesai_mingguan_banyak_kandang').val()=='' || $('#tanggal_selesai_mingguan_banyak_kandang').val()=='undefined' || $('#tanggal_selesai_mingguan_banyak_kandang').val()==null)
//     {

//     }
//     else{
//         if(tanggal_mulai<tanggal_selesai===false){
//             alert("Tanggal mulai harus sebelum tanggal selesai")
//             $('#tanggal_mulai_mingguan_banyak_kandang').val(null);
//         }
//         // alert("tanggal mulai " + tanggal_mulai);
//         // alert("tanggal selesai " + tanggal_selesai);
//         // if (tanggal_mulai >= tanggal_selesai) {
//         //     alert("Oop! dateTo must be later than dateFrom.");
//         // }
//     }
    
// });

// $('#tanggal_selesai_mingguan_banyak_kandang').change(function(){
//     // alert($('#tanggal_mulai_mingguan_banyak_kandang').val())
//     var tanggal_selesai =new Date($('#tanggal_selesai_mingguan_banyak_kandang').val());
//     var tanggal_mulai =new Date($('#tanggal_mulai_mingguan_banyak_kandang').val());
//     if($('#tanggal_mulai_mingguan_banyak_kandang').val()=='0' || $('#tanggal_mulai_mingguan_banyak_kandang').val()=='' || $('#tanggal_mulai_mingguan_banyak_kandang').val()=='undefined' || $('#tanggal_mulai_mingguan_banyak_kandang').val()==null)
//     {

//     }
//     else {
//         if(tanggal_mulai<tanggal_selesai===false){
//             alert("Tanggal selesai harus setelah tanggal mulai")
//             $('#tanggal_selesai_mingguan_banyak_kandang').val(null);
//         }
//         // alert("tanggal mulai " + tanggal_mulai);
//         // alert("tanggal selesai " + tanggal_selesai);
//         // if (tanggal_mulai >= tanggal_selesai) {
//         //     alert("Oop! dateTo must be later than dateFrom.");
//         // }
//     }
    
// });
  

$('#cetak_data_mingguan_banyak_kandang').click(function() {
    var id_lokasi = $('#lokasi_mingguan_banyak_kandang').val();

    var checkbox_mingguan_banyak_kandang = []
    $("input[name='checkbox_mingguan_banyak_kandang[]']:checked").each(function () {
        checkbox_mingguan_banyak_kandang.push($(this).val());
    });

    var tanggal_mulai = $('#tanggal_mulai_mingguan_banyak_kandang').val();
    var tanggal_selesai = $('#tanggal_selesai_mingguan_banyak_kandang').val();

    // var dataKandang = '<option value="" disabled selected>--Pilih--</option>';
    var idJumlahKandang = 'jumlah_kandang_mingguan_banyak';

    $.ajax({
        url: base_url + "laporan_mingguan/cetak_laporan_mingguan_banyak_kandang",
        method: 'POST',
        data: { 
            id_lokasi: id_lokasi,
            data_kandang: checkbox_mingguan_banyak_kandang,
            tanggal_mulai: tanggal_mulai,
            tanggal_selesai: tanggal_selesai,
        },
        success: function (data) {
            // console.log(data)
            // window.location.href = base_url + "laporan_mingguan/cetak_laporan"
            // $('#btnExport2').show();
            // $('#data_hasil_laporan_mingguan').html(data);

            // $('#lokasi_mingguan_banyak_kandang').val(null);
            // $('#kandang_mingguan_banyak_kandang').html(dataKandang);
            // $('#' + idJumlahKandang).prop('checked',true);
            // $("#mingguan_banyak_kandang").toggleClass('collapse');
            // $("#mingguan_satu_kandang").toggleClass('collapse');
            $('#data_hasil_laporan_mingguan').html(data);

            $('#lokasi_mingguan_banyak_kandang').val(null);
            $('#kandang_mingguan_banyak_kandang').html('');
            $('#' + idJumlahKandang).prop('checked',true);
            $('#tanggal_mulai_mingguan_banyak_kandang').val(null);
            $('#tanggal_selesai_mingguan_banyak_kandang').val(null);
            
            $('#btnExport2').show();
            
        }
    });
});

