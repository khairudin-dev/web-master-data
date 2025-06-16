$(document).ready(function () {
        if (window.flashMessage?.success) {
            toastr["success"](`${window.flashMessage.success}`, "Berhasil.", {
                positionClass: "toast-top-center",
                closeButton: true,
                progressBar: true,
                newestOnTop: true,
                rtl: $("body").attr("dir") === "rtl" || $("html").attr("dir") === "rtl",
                timeOut: 10000
            });
        }

        if (window.flashMessage?.error) {
            toastr["error"](`${window.flashMessage.error}`, "Gagal!", {
                positionClass: "toast-top-center",
                closeButton: true,
                progressBar: true,
                newestOnTop: true,
                rtl: $("body").attr("dir") === "rtl" || $("html").attr("dir") === "rtl",
                timeOut: 10000
            });
        }
    $('#search_blk').on('submit', function (e) {
        e.preventDefault(); // Cegah reload halaman

        var noBlok = $(this).find('input[name="search_blk"]').val().trim();

        if (noBlok === '') {
            alert("Harap isi nomor blok terlebih dahulu.");
            return;
        }

        // Tampilkan modal dan isi dengan data dari AJAX (misalnya)
        $('#title_blok').text("Lahan " + noBlok);
        $('#modal-body-detailahan').html('<p>Memuat data untuk blok ' + noBlok + '...</p>');
        $('#detailahan').modal('show');

        loadDetailLahan(noBlok)

    });
    // Reset modal saat ditutup
    $('#detailahan').on('hidden.bs.modal', function () {
        $('#modal-body-detailahan').html('');
        $('#title_blok').text('Lahan');
    });

});
function loadDetailLahan(noBlok) {
    // AJAX ambil detail lahan
    $.ajax({
        url: '/detail-lahan/' + noBlok,
        type: 'GET',
        success: function (res) {
            $('#modal-body-detailahan').html(res);
            
        },
        error: function (res) {
            try {
                var json = JSON.parse(res.responseText);
                if (json.message) {
                    $('#modal-body-detailahan').html('<p class="text-danger">Data tidak ditemukan.</p>');
                } else {
                    $('#modal-body-detailahan').html('<div class="alert alert-danger">Terjadi kesalahan tidak diketahui.</div>');
                }
            } catch (e) {
                $('#modal-body-detailahan').html('<div class="alert alert-danger">Terjadi kesalahan pada server.</div>');
            }
        }
    });
}