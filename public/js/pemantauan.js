    $(document).ready(function () {
        // var imgCheck_p = true
        if (window.innerWidth > 912) { // 768px adalah breakpoint 'md' di Bootstrap
            $("#sidebar").addClass("toggled");
        }

        // Datetimepicker
        $('#datetimepicker-tg_p').datetimepicker({
            format: 'DD/MM/YYYY',

        });
        $('#datetimepicker-tg_pl1').datetimepicker({
            format: 'DD/MM/YYYY',
        });
        $('#datetimepicker-tg_pl2').datetimepicker({
            format: 'DD/MM/YYYY',
        });
        // Saat tanggal pemandahuluan diubah
        // $("#datetimepicker-tg_p").on("change.datetimepicker", function (e) {
        //     // Set tanggal minimum untuk tanam agar setelah semai
        //     $('#datetimepicker-tanam').datetimepicker('minDate', e.date.add(1, 'day'));
        // });

        $('#pendahuluan').on('change', function () {
            const file = this.files[0];
            const $preview = $('#preview-pendahuluan');

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $preview.attr('src', e.target.result).show();
                };
                reader.readAsDataURL(file);
            } else {
                $preview.attr('src', '#').hide();
            }
        });
        $('#pl1').on('change', function () {
            const file = this.files[0];
            const $preview = $('#preview-pl1');

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $preview.attr('src', e.target.result).show();
                };
                reader.readAsDataURL(file);
            } else {
                $preview.attr('src', '#').hide();
            }
        });
        $('#pl2').on('change', function () {
            const file = this.files[0];
            const $preview = $('#preview-pl2');

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $preview.attr('src', e.target.result).show();
                };
                reader.readAsDataURL(file);
            } else {
                $preview.attr('src', '#').hide();
            }
        });

        $.validator.addMethod("filesize", function (value, element, arg) {
            if (element.files.length > 0 && element.files[0].size <= arg) {
                return true;
            }
            return false;
        }, "File size must be less than {0} bytes.");

        $("#pendahuluan_f").validate({
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
                "k_p": {
                    required: true,
                },
                "pendahuluan": {
                    required: imgCheck_p,
                    accept: "image/png, image/jpg, image/jpeg",
                    filesize: {
                        param: 2097152, // 2MB
                        depends: function (element) {
                            return !imgCheck_p && $(element).val() !== "";
                        } // Max file size in bytes (5MB)
                    },
                },
                "s_p": {
                    required: true,
                    number: true,
                    min: 0.0
                },
                "tg_p": {
                    required: true,
                    dateITA: true,
                },
            },
            messages: {
                "k_p": {
                    required: "Keterangan wajib diisi",
                },
                "pendahuluan": {
                    required: "Foto pependahuluan wajib diisi",
                    accept: "Pilih dengan format (jpg,jpeg,png)", // Allowed extensions
                    filesize: "Pilih file dengan ukuran maks. 2MB", // Max file size in bytes (5MB)
                },
                "s_p": {
                    required: "Luas Lahan spoting wajib diisi, isi 0 jika memang kosong",
                    number: "Luas Lahan spoting wajib diisi dengan angkat",
                },
                "tg_p": {
                    required: "Tanggal Pemantauan wajib diisi",
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

        $("#pl1_f").validate({
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
                "k_pl1": {
                    required: true,
                },
                "pl1": {
                    required: imgCheck_pl1,
                    accept: "image/png, image/jpg, image/jpeg",
                    filesize: {
                        param: 2097152, // 2MB
                        depends: function (element) {
                            return !imgCheck_pl1 && $(element).val() !== "";
                        } // Max file size in bytes (5MB)
                    },
                },
                "s_pl1": {
                    required: true,
                    number: true,
                    min: 0.0
                },
                "tg_pl1": {
                    required: true,
                    dateITA: true,
                },
            },
            messages: {
                "k_pl1": {
                    required: "Keterangan wajib diisi",
                },
                "pl1": {
                    required: "Foto pependahuluan wajib diisi",
                    accept: "Pilih dengan format (jpg,jpeg,png)", // Allowed extensions
                    filesize: "Pilih file dengan ukuran maks. 2MB", // Max file size in bytes (5MB)
                },
                "s_pl1": {
                    required: "Luas Lahan spoting wajib diisi, isi 0 jika memang kosong",
                    number: "Luas Lahan spoting wajib diisi dengan angkat",
                },
                "tg_pl1": {
                    required: "Tanggal Pemantauan wajib diisi",
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
        $("#pl2_f").validate({
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
                "k_pl2": {
                    required: true,
                },
                "pl2": {
                    required: imgCheck_pl2,
                    accept: "image/png, image/jpg, image/jpeg",
                    filesize: {
                        param: 2097152, // 2MB
                        depends: function (element) {
                            return !imgCheck_pl2 && $(element).val() !== "";
                        } // Max file size in bytes (5MB)
                    },
                },
                "s_pl2": {
                    required: true,
                    number: true,
                    min: 0.0
                },
                "tg_pl2": {
                    required: true,
                    dateITA: true,
                },
            },
            messages: {
                "k_pl2": {
                    required: "Keterangan wajib diisi",
                },
                "pl2": {
                    required: "Foto pependahuluan wajib diisi",
                    accept: "Pilih dengan format (jpg,jpeg,png)", // Allowed extensions
                    filesize: "Pilih file dengan ukuran maks. 2MB", // Max file size in bytes (5MB)
                },
                "s_pl2": {
                    required: "Luas Lahan spoting wajib diisi, isi 0 jika memang kosong",
                    number: "Luas Lahan spoting wajib diisi dengan angkat",
                },
                "tg_pl2": {
                    required: "Tanggal Pemantauan wajib diisi",
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

    });
