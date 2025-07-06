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
    $.validator.addMethod("totalMax", function (value, element, params) {
        const tb = parseFloat($('#tb').val()) || 0;
        const tm = parseFloat($('#tm').val()) || 0;
        const tp = parseFloat($('#tp').val()) || 0;

        const total = tb + tm + tp;

        return total <= params.max;
    }, function (params, element) {
        return "Total Distribusi melebihi Stok " + params.max + " Kg";
    });

    $("#mkt_f").validate({
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
            "tb": {
                required: true,
                number: true,
                min: 0.0,
                totalMax: {
                    max: z
                } // Terapkan di sini

            },
            "bantuan": {
                required: true,
            },
            "tm": {
                required: true,
                number: true,
                min: 0.0,
                totalMax: {
                    max: z
                } // Terapkan di sini

            },
            "market": {
                required: true,
            },
            "tp": {
                required: true,
                number: true,
                min: 0.0,
                totalMax: {
                    max: z
                } // Terapkan di sini

            },
            "penangkaran": {
                required: true,
            },
        },
        messages: {
            "tb": {
                required: "Tonase wajib diisi, isi 0 jika memang kosong",
                number: "harus dengan angkat",
            },
            "tm": {
                required: "Tonase wajib diisi, isi 0 jika memang kosong",
                number: "harus dengan angkat",
            },
            "tp": {
                required: "Tonase wajib diisi, isi 0 jika memang kosong",
                number: "harus dengan angkat",
            },
            "bantuan": {
                required: "Bantuan wajib diisi, isi \"-\" jika memang kosong",
            },
            "maeket": {
                required: "Free Maeket wajib diisi, isi \"-\" jika memang kosong",
            },
            "penangkaran": {
                required: "Penangkaran wajib diisi, isi \"-\" jika memang kosong",
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
            var $parent = $el.parents(".form-group");
            $el.addClass("is-invalid");
            // Select2 and Tagsinput
            if ($el.hasClass("select2-hidden-accessible") || $el.attr("data-role") === "tagsinput") {
                $el.parent().addClass("is-invalid");
            }
        },
        unhighlight: function (element) {
            $(element).parents(".form-group").find(".is-invalid").removeClass("is-invalid");
        }
    });


    $('#tb').change(function () {
        getStok()
    });
    $('#tm').change(function () {
        getStok()
    });
    $('#tp').change(function () {
        getStok()
    });

    function getStok() {
        let tb = parseFloat($('#tb').val());
        let tm = parseFloat($('#tm').val());
        let tp = parseFloat($('#tp').val());

        if (isNaN(tb)) tb = 0;
        if (isNaN(tm)) tm = 0;
        if (isNaN(tp)) tp = 0;

        // Asumsikan variabel z sudah didefinisikan sebelumnya di luar fungsi
        $('#stok').text(z - tb - tm - tp); // 2 desimal
    }

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
