    $(document).ready(function () {
        // var imgCheck_p = true
        if (window.innerWidth > 912) { // 768px adalah breakpoint 'md' di Bootstrap
            $("#sidebar").addClass("toggled");
        }

        // Datetimepicker
        $('#datetimepicker-panen').datetimepicker({
            format: 'DD/MM/YYYY',

        });
        $('#datetimepicker-panen').datetimepicker('minDate', moment(z, 'DD/MM/YYYY').clone().add(1, 'days'));
        $('#tk').change(function () {
            // $('#tonase').text($(this).val() * y);
            const nilai = parseFloat($(this).val());
            if (!isNaN(nilai)) {
                $('#tonase').text((nilai * y).toFixed(2)); // Format ke 2 desimal (opsional)
            } else {
                $('#tonase').text('0'); // Default jika nilai tidak valid
            }
        });
        // Saat tanggal panen diubah
        $("#datetimepicker-panen").on("change.datetimepicker", function (e) {
            // Ambil nilai tanggal panen yang dipilih
            const tanggalPanen = moment(e.date, 'DD/MM/YYYY');

            // Hitung selisih hari antara panen dan semai
            const umur = tanggalPanen.diff(x, 'days');

            // Tampilkan hasil ke dalam <td>
            $('#umur').text(umur + ' hari');
            // $('#datetimepicker-tanam').datetimepicker('minDate', e.date.add(1, 'day'));
        });
        $("#panen_f").validate({
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
                "tk": {
                    required: true,
                    number: true,
                    min: 0.0
                },
                "panen": {
                    required: true,
                    dateITA: true,
                },
            },
            messages: {
                "tk": {
                    required: "Taksasi wajib diisi, isi 0 jika memang kosong",
                    number: "Luas Lahan spoting wajib diisi dengan angkat",
                },
                "Panen": {
                    required: "Tanggal Panen wajib diisi",
                    dateITA: "Isian wajib berupa tanggal! (HH/BB/TTTT)",
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
        // $("#pendahuluan_f").validate({
        //     ignore: ".ignore, .select2-input",
        //     focusInvalid: true,
        //     onkeyup: function (element) {
        //         $(element).valid();
        //     },
        //     onclick: true,
        //     onfocusout: function (element) {
        //         $(element).valid();
        //     },
        //     rules: {
        //         "k_p": {
        //             required: true,
        //         },
        //         "pendahuluan": {
        //             required: imgCheck_p,
        //             accept: "image/png, image/jpg, image/jpeg",
        //             filesize: {
        //                 param: 2097152, // 2MB
        //                 depends: function (element) {
        //                     return !imgCheck_p && $(element).val() !== "";
        //                 } // Max file size in bytes (5MB)
        //             },
        //         },
        //         "s_p": {
        //             required: true,
        //             number: true,
        //             min: 0.0
        //         },
        //         "tg_p": {
        //             required: true,
        //             dateITA: true,
        //         },
        //     },
        //     messages: {
        //         "k_p": {
        //             required: "Keterangan wajib diisi",
        //         },
        //         "pendahuluan": {
        //             required: "Foto pependahuluan wajib diisi",
        //             accept: "Pilih dengan format (jpg,jpeg,png)", // Allowed extensions
        //             filesize: "Pilih file dengan ukuran maks. 2MB", // Max file size in bytes (5MB)
        //         },
        //         "s_p": {
        //             required: "Luas Lahan spoting wajib diisi, isi 0 jika memang kosong",
        //             number: "Luas Lahan spoting wajib diisi dengan angkat",
        //         },
        //         "tg_p": {
        //             required: "Tanggal Pemantauan wajib diisi",
        //             dateITA: "Isian wajib berupa tanggal! (HH/BB/TTTT)",
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
        //         var $parent = $el.parents(".form-group");
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

    });
