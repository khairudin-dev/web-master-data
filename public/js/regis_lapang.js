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
    //     focusInvalid: true,
    //     onkeyup: function (element) {
    //         $(element).valid();
    //     },
    //     onclick: true,
    //     onfocusout: function (element) {
    //         $(element).valid();
    //     },
    //     rules: {
    //         "lapang": {
    //             required: true,
    //         },
    //     },
    //     messages: {
    //         "lapang": {
    //             required: "Nomor Blok wajib diisi",
    //         },
    //     },

    //     // Errors
    //     errorPlacement: function errorPlacement(error, element) {
    //         var $parent = $(element).parents(".form-group");
    //         // Do not duplicate errors
    //         if ($parent.find(".jquery-validation-error").length) {
    //             return;
    //         }
    //         $parent.append(
    //             error.addClass("jquery-validation-error small form-text invalid-feedback")
    //         );
    //     },
    //     highlight: function (element) {
    //         var $el = $(element);
    //         $el.addClass("is-invalid");
    //         // Select2 and Tagsinput
    //         if ($el.hasClass("select2-hidden-accessible") || $el.attr("data-role") === "tagsinput") {
    //             $el.parent().addClass("is-invalid");
    //         }
    //     },
    //     unhighlight: function (element) {
    //         $(element).parents(".form-group").find(".is-invalid").removeClass("is-invalid");
    //     }
    // });
    $(document).on('click', '.accr-detail', function () {
        var noBlok = $(this).data('blok_lahan');
        $('#title_blok').text("Input Nomor Lapang | Blok : " + noBlok);
        $('#lapang').val($(this).data('lapang'));
        $('#formLapang').attr('action', '/regis-lapang/' + $(this).data('s'));
        $('#area_form_lapang').html('<p>Memuat data...</p>');

        //ambil detail lahan
        loadDetailLahan_acccord(noBlok)

    });
    $("#formLapang").validate({
        ignore: ".ignore, .select2-input",
        focusInvalid: true,
        onkeyup: function (element) {
            $(element).valid();
        },
        onclick: true,
        onfocusout: function (element) {
            $(element).valid();
        },
        rules: {
            "lapang": {
                required: true,
                remote: {
                    url: '/u-lpg',
                    type: 'post',
                    data: {
                        no_blok: function () {
                            return $('#lapang').val();
                        },
                        _token: $('meta[name="csrf-token"]').attr('content') // jika pakai Laravel
                    }
                }
            },
        },
        messages: {
            "lapang": {
                required: "Nomor Lapang wajib diisi",
                remote: "Nomor Lapang sudah terpakai",
            },
        },

        // Errors
        errorPlacement: function errorPlacement(error, element) {
            var $parent = $(element).parents(".form-group");
            // Do not duplicate errors
            if ($parent.find(".jquery-validation-error").length) {
                return;
            }
            $parent.append(
                error.addClass("jquery-validation-error small form-text invalid-feedback")
            );
        },
        highlight: function (element) {
            var $el = $(element);
            $el.addClass("is-invalid");
            // Select2 and Tagsinput
            if ($el.hasClass("select2-hidden-accessible") || $el.attr("data-role") ===
                "tagsinput") {
                $el.parent().addClass("is-invalid");
            }
        },
        unhighlight: function (element) {
            $(element).parents(".form-group").find(".is-invalid").removeClass("is-invalid");
        }
    });
    $(document).on('click', '.go-detail', function () {
        var noBlok = $(this).data('blok_lahan');
        $('#title_blok').text("Lahan " + noBlok);
        $('#modal-body-detailahan').html('<p>Memuat data...</p>');

        //ambil detail lahan
        loadDetailLahan(noBlok)

    });
});
