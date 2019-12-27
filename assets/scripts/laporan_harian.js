$(document).ready(function () {
    $('#data_dropdown_lokasi').change(function () {
        var id_lokasi = $('#data_dropdown_lokasi').val();
        if (id_lokasi != '') {
            $.ajax({
                url: base_url + "laporan_harian/ambil_kandang",
                method: 'POST',
                data: { id_lokasi: id_lokasi },
                success: function (data) {
                    $('#data_kandang_laporan').html(data);
                }
            });
        }
        else {
            $('#data_kandang_laporan').html('<option value="" disabled selected>--Pilih--</option>');
        }
    });
});