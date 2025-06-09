$(document).ready(function () {
    // Datatables basic
    $('#lahan').DataTable({
        responsive: true
    });

    // Ketika tombol detail diklik
    $(document).on('click', '.go-detail', function () {
        var noBlok = $(this).data('blok_lahan');
        $('#title_blok').text("Lahan " + noBlok);
        $('#modal-body-detailahan').html('<p>Memuat data...</p>');

        //ambil detail lahan
        loadDetailLahan(noBlok)
    });

    // Reset modal saat ditutup
    $('#detailahan').on('hidden.bs.modal', function () {
        $('#modal-body-detailahan').html('');
        $('#title_blok').text('Lahan');
    });
});
