    $(document).ready(function () {
        // var imgCheck_p = true

        // $('#seri').mask('Z', {
        //     translation: {
        //         'Z': {
        //             pattern: /[0-9\-]/,
        //             recursive: true
        //         }
        //     }
        // });

        // Select2

        if (window.innerWidth > 912) { // 768px adalah breakpoint 'md' di Bootstrap
            $("#sidebar").addClass("toggled");
        }

        // Datetimepicker
        $('#datetimepicker-selesai').datetimepicker({
            format: 'DD/MM/YYYY',

        });
        // $('#datetimepicker-ambil').datetimepicker({
        //     format: 'DD/MM/YYYY',

        // });
        // $('#tk').change(function () {
        //     // $('#tonase').text($(this).val() * y);
        //     const nilai = parseFloat($(this).val());
        //     if (!isNaN(nilai)) {
        //         $('#tonase').text((nilai * y).toFixed(2)); // Format ke 2 desimal (opsional)
        //     } else {
        //         $('#tonase').text('0'); // Default jika nilai tidak valid
        //     }
        // });

        // Saat tanggal panen diubah
        $('#datetimepicker-selesai').datetimepicker('minDate', moment(x, 'DD/MM/YYYY').clone().add(1, 'days'));

        // $("#datetimepicker-selesai").on("change.datetimepicker", function (e) {
        //     let tanggalDipilih = e.date;

        //     if (tanggalDipilih) {
        //         // Tambah 6 bulan menggunakan moment.js (bawaan tempusdominus)
        //         let tanggalBaru = tanggalDipilih.clone().add(6, 'months');

        //         // Tampilkan hasil di console
        //         console.log("Tanggal dipilih:", tanggalDipilih.format('DD/MM/yyy'));
        //         console.log("Tanggal setelah 6 bulan:", tanggalBaru.format('DD/MM/yyy'));

        //         // (Opsional) Set tanggal baru ke datetimepicker lain
        //         $('#kdl').text(tanggalBaru.format('DD/MM/yyy'));
        //     }
        // });

        $("#lab_f").validate({
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
                // "ambil": {
                //     required: true,
                //     dateITA: true,
                // },
                "selesai": {
                    required: true,
                    dateITA: true,
                },
                "ka": {
                    required: true,
                    number: true,
                    min: 0.0
                },
                "dk": {
                    required: true,
                    number: true,
                    min: 0.0
                },
                "bm": {
                    required: true,
                    number: true,
                    min: 0.0
                },
                "lab": {
                    required: true,
                },
                // "sertif": {
                //     required: true,
                // },
                // "seri": {
                //     required: true,
                // },
            },
            messages: {
                // "ambil": {
                //     required: "Tanggal Pengambilan wajib diisi",
                //     dateITA: "Isian wajib berupa tanggal! (HH/BB/TTTT)",
                // },
                "selesai": {
                    required: "Tanggal Selesai wajib diisi",
                    dateITA: "Isian wajib berupa tanggal! (HH/BB/TTTT)",
                },
                "ka": {
                    required: "Kadar Air wajib diisi, isi 0 jika memang kosong",
                    number: "harus dengan angkat",
                },
                "dk": {
                    required: "Daya berKecambah wajib diisi, isi 0 jika memang kosong",
                    number: "harus dengan angkat",
                },
                "bm": {
                    required: "Benih Murni wajib diisi, isi 0 jika memang kosong",
                    number: "harus dengan angkat",
                },
                "lab": {
                    required: "Hasil Uji wajib diisi",
                },
                // "sertif": {
                //     required: "Nomor sertifikat wajib diisi",
                // },
                // "seri": {
                //     required: "Nomor seri wajib diisi",
                // },
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

    });
