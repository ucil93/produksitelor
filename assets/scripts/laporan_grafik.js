var x = document.getElementById("tampilan_grafik");

$(document).ready(function () {
    x.style.display = 'none';
});

$("input[name='jumlah_kandang_grafik']").change(function(){
    var dataKandang = '<option value="" disabled selected>--Pilih--</option>';

    $('#lokasi_grafik_satu_kandang').val(null);
    $('#kandang_grafik_satu_kandang').html(dataKandang);
    $('#data_hasil_laporan_grafik').html('');

    $('#lokasi_grafik_banyak_kandang').val(null);
    $('#kandang_grafik_banyak_kandang').html(dataKandang);
    $('#strain_grafik_banyak_kandang').html(dataKandang);

    $("#grafik_satu_kandang").toggleClass('collapse');
    $("#grafik_banyak_kandang").toggleClass('collapse');

    x.style.display = 'none';
});

$(document).ready(function () {
    $('#lokasi_grafik_satu_kandang').change(function () {
        var id_lokasi = $('#lokasi_grafik_satu_kandang').val();
        if (id_lokasi != '') {
            $.ajax({
                url: base_url + "laporan_grafik/ambil_grafik_satu_kandang",
                method: 'POST',
                data: { 
                    id_lokasi: id_lokasi,
                },
                success: function (data) {
                    $('#kandang_grafik_satu_kandang').html(data);
                }
            });
        } else {
            $('#kandang_grafik_satu_kandang').html('');
        }
    });
});

$('#cetak_data_grafik_satu_kandang').click(function() {
    var id_lokasi = $('#lokasi_grafik_satu_kandang').val();
    var data_kandang = $('#kandang_grafik_satu_kandang').val();

    var dataKandang = '<option value="" disabled selected>--Pilih--</option>';
    var idJumlahKandang = 'jumlah_kandang_grafik_satu';

    $.ajax({
        url: base_url + "laporan_grafik/cetak_laporan_grafik_satu_kandang",
        method: 'POST',
        dataType: "json",
        data: { 
            id_lokasi: id_lokasi,
            data_kandang: data_kandang
        },
        success: function (data) {
            x.style.display = 'block';
            grafik(data);

            $('#lokasi_grafik_satu_kandang').val(null);
            $('#kandang_grafik_satu_kandang').html(dataKandang);
            $('#' + idJumlahKandang).prop('checked',true);
        }
    });
});

$('#lokasi_grafik_banyak_kandang').click(function() {
    var id_lokasi = $('#lokasi_grafik_banyak_kandang').val();
    if (id_lokasi != '') {
        $.ajax({
            url: base_url + "laporan_grafik/ambil_grafik_banyak_kandang",
            method: 'POST',
            data: { 
                id_lokasi: id_lokasi,
            },
            success: function (data) {
                $('#kandang_grafik_banyak_kandang').html(data);
            }
        });
    } else {
        $('#kandang_grafik_banyak_kandang').html('');
    }
});

$('#kandang_grafik_banyak_kandang').click(function() {
    var id_lokasi = $('#lokasi_grafik_banyak_kandang').val();
    var tanggal_menetas = $('#kandang_grafik_banyak_kandang').val();
    if (id_lokasi != '') {
        if(tanggal_menetas != '') {
            $.ajax({
                url: base_url + "laporan_grafik/ambil_strain_banyak_kandang",
                method: 'POST',
                data: { 
                    id_lokasi: id_lokasi,
                    tanggal_menetas: tanggal_menetas,
                },
                success: function (data) {
                    $('#strain_grafik_banyak_kandang').html(data);
                }
            });
        } else {
            $('#strain_grafik_banyak_kandang').html('');
        }
    } else {
        $('#strain_grafik_banyak_kandang').html('');
    }
});

$('#cetak_data_grafik_banyak_kandang').click(function() {
    var id_lokasi = $('#lokasi_grafik_banyak_kandang').val();
    var tgl_menetas = $('#kandang_grafik_banyak_kandang').val();
    var id_strain = $('#strain_grafik_banyak_kandang').val();

    // var checkbox_grafik_banyak_kandang = []
    // $("input[name='checkbox_grafik_banyak_kandang[]']:checked").each(function () {
    //     checkbox_grafik_banyak_kandang.push($(this).val());
    // });

    var dataKandang = '<option value="" disabled selected>--Pilih--</option>';
    var idJumlahKandang = 'jumlah_kandang_grafik_satu';

    $.ajax({
        url: base_url + "laporan_grafik/cetak_laporan_grafik_banyak_kandang",
        method: 'POST',
        dataType: "json",
        data: { 
            id_lokasi: id_lokasi,
            tgl_menetas: tgl_menetas,
            id_strain: id_strain,
            // data_kandang: checkbox_grafik_banyak_kandang,
        },
        success: function (data) {
            x.style.display = 'block';
            grafik(data);

            $('#lokasi_grafik_satu_kandang').val(null);
            $('#kandang_grafik_satu_kandang').html(dataKandang);
            $('#' + idJumlahKandang).prop('checked',true);

            $("#grafik_satu_kandang").toggleClass('collapse');
            $("#grafik_banyak_kandang").toggleClass('collapse');
        }
    });
});

function grafik(data) {
    var data_grafik = data;
    var data_label = data.pop();
    console.log("data grafik ",data_grafik);
    console.log("data label ",data_label.data);
    $('#highchart_100').highcharts({
        chart: {
            style: {
                fontFamily: "Open Sans"
            }
        },
        title: {
            text: "",
            x: -20
        },
        subtitle: {
            text: "",
            x: -20
        },
        xAxis: {
            title: {
                text: "AGE OF PRODUCTION (WEEKS)"
            },
            categories: data_label.data
        },
        yAxis: {
            title: {
                text: ""
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: "#808080"
            }]
        },
        tooltip: {
            valueSuffix: ""
        },
        legend: {
            layout: "vertical",
            align: "right",
            verticalAlign: "middle",
            borderWidth: 0
        },
        plotOptions: {
            series: {
                marker: {
                    enabled: false
                }
            }
        },
        series: data,
    });
}