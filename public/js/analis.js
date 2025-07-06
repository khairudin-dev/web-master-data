$(document).ready(function () {
    // Datatables basic
    $('#lahan').DataTable({
        ordering: true,
        order: [
            [0, 'asc']
        ],
        scrollX: true,
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            zeroRecords: "Data tidak ditemukan"
        }
    });

    // Ketika tombol detail diklik
    // $(document).on('click', '.go-detail', function () {
    //     var noBlok = $(this).data('blok_lahan');
    //     $('#title_blok').text("Lahan " + noBlok);
    //     $('#modal-body-detailahan').html('<p>Memuat data...</p>');

    //     //ambil detail lahan
    //     loadDetailLahan(noBlok)

    // });

    // $(document).on('click', '.go-del', function () {
    //     var noBlok = $(this).data('blok_lahan');
    //     var Blok = $(this).data('blok');
    //     var actionUrl = $(this).data('action').replace('__ID__', Blok);
    //     var formHtml =
    //         '<form action="' + actionUrl + '" method="POST">' +
    //         '<input type="hidden" name="_token" value="' + $('meta[name="csrf-token"]').attr('content') + '">' +
    //         '<input type="hidden" name="_method" value="DELETE">' +
    //         '<h1 class="mb-2 text-center text-warning">' +
    //         '<i class="align-middle mr-2 fas fa-fw fa-question-circle"></i>' +
    //         '</h1>' +
    //         '<div class="text-center">' +
    //         '<h3>Yakin hapus data ini?</h3>' +
    //         '<h5>No. Blok : ' + noBlok + '</h5><br>' +
    //         '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button> ' +
    //         '<button type="submit" class="btn btn-danger">Hapus</button>' +
    //         '</div>' +
    //         '</form>';

    //     $('#modal-body-detailahan').html(formHtml);
    //     $('#footer-body-detailahan').remove();
    //     $('#header-body-detailahan').remove();


    // });


});
