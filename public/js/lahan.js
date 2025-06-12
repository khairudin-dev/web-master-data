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
    $(document).on('click', '.go-del', function () {
        var noBlok = $(this).data('blok_lahan');
        $('#title_blok').text("Lahan " + noBlok);
        $('#modal-body-detailahan').html(
            '<div class="text-center">' +
            '<h3>Yakin hapus data ini?</h3>' +
            '<h5>No. Blok : ' + noBlok + '</h5> <br>' +
            '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button> <button type="button" class="btn btn-danger" data-dismiss="modal">Hapus</button>'+
            '</div>'
        );
        $('#footer-body-detailahan').remove(
        );
        $('#header-body-detailahan').remove();
        

    });

    // Reset modal saat ditutup
    $('#detailahan').on('hidden.bs.modal', function () {
        $('#modal-body-detailahan').html('');
        $('#title_blok').text('Lahan');
    });
});
