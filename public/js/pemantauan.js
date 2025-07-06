    $(document).ready(function () {
        // var imgCheck_p = true
        if (window.innerWidth > 912) { // 768px adalah breakpoint 'md' di Bootstrap
            $("#sidebar").addClass("toggled");
        }

        // Datetimepicker
        $('#datetimepicker-tg_p').datetimepicker({
            format: 'DD/MM/YYYY',
        });
        $('#datetimepicker-tg_p').datetimepicker('minDate', moment(tanam, 'DD/MM/YYYY').clone().add(1, 'days'));

        $('#datetimepicker-tg_pl1').datetimepicker({
            format: 'DD/MM/YYYY',
        });
        $('#datetimepicker-tg_pl2').datetimepicker({
            format: 'DD/MM/YYYY',
        });
        $('#datetimepicker-tg_pl3').datetimepicker({
            format: 'DD/MM/YYYY',
        });
        if (tg_p) {
            $('#datetimepicker-tg_pl1').datetimepicker('minDate', moment(tg_p, 'DD/MM/YYYY').clone().add(1, 'days'));
        }
        if (tg_pl1) {
            $('#datetimepicker-tg_p').datetimepicker('maxDate', moment(tg_pl1, 'DD/MM/YYYY').clone().subtract(1, 'days'));
            $('#datetimepicker-tg_pl2').datetimepicker('minDate', moment(tg_pl1, 'DD/MM/YYYY').clone().add(1, 'days'));
        }
        if (tg_pl2) {
            $('#datetimepicker-tg_pl1').datetimepicker('maxDate', moment(tg_pl2, 'DD/MM/YYYY').clone().subtract(1, 'days'));
            $('#datetimepicker-tg_pl3').datetimepicker('minDate', moment(tg_pl2, 'DD/MM/YYYY').clone().add(1, 'days'));
        }
        if (tg_pl3) {
            $('#datetimepicker-tg_pl2').datetimepicker('maxDate', moment(tg_p, 'DD/MM/YYYY').clone().subtract(1, 'days'));
        }
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
        $('#pl3').on('change', function () {
            const file = this.files[0];
            const $preview = $('#preview-pl3');

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

        $('#h_pendahuluan').on('change', function () {
            const file = this.files[0];
            const btn = $('#btn-preview-h_p');

            // const $iframe = $('#preview-h_p');

            if (file) {
                const fileType = file.type;

                const allowedTypes = ['application/pdf', 'image/png', 'image/jpeg', 'image/jpg'];
                if (allowedTypes.includes(fileType)) {
                    $('#btn-preview-h_p').show();
                    $('#btn-preview-h_p').data('doc', '');
                } else {
                    $('#btn-preview-h_p').hide();
                    alert('Tipe file tidak didukung');
                }
            } else {
                btn.hide();
            }
        });

        $('#btn-preview-h_p').on('click', function () {
            const fileUrl = $(this).data('doc');

            if (fileUrl) { // hanya jika tidak kosong/null/undefined
                $('#iframePreviewFile').attr('src', fileUrl);
            } else {
                const file = $('#h_pendahuluan')[0].files[0];
                render_doc(file)
            }
        });

        $('#h_pl1').on('change', function () {
            const file = this.files[0];
            const btn = $('#btn-preview-h_pl1');

            // const $iframe = $('#preview-h_p');

            if (file) {
                const fileType = file.type;

                const allowedTypes = ['application/pdf', 'image/png', 'image/jpeg', 'image/jpg'];
                if (allowedTypes.includes(fileType)) {
                    $('#btn-preview-h_pl1').show();
                    $('#btn-preview-h_pl1').data('doc', '');
                } else {
                    $('#btn-preview-h_pl1').hide();
                    alert('Tipe file tidak didukung');
                }
            } else {
                btn.hide();
            }
        });

        $('#btn-preview-h_pl1').on('click', function () {
            const fileUrl = $(this).data('doc');

            if (fileUrl) { // hanya jika tidak kosong/null/undefined
                $('#iframePreviewFile').attr('src', fileUrl);
            } else {
                const file = $('#h_pl1')[0].files[0];
                render_doc(file)
            }
        });
        $('#h_pl2').on('change', function () {
            const file = this.files[0];
            const btn = $('#btn-preview-h_pl2');

            // const $iframe = $('#preview-h_p');

            if (file) {
                const fileType = file.type;

                const allowedTypes = ['application/pdf', 'image/png', 'image/jpeg', 'image/jpg'];
                if (allowedTypes.includes(fileType)) {
                    $('#btn-preview-h_pl2').show();
                    $('#btn-preview-h_pl2').data('doc', '');
                } else {
                    $('#btn-preview-h_pl2').hide();
                    alert('Tipe file tidak didukung');
                }
            } else {
                btn.hide();
            }
        });

        $('#btn-preview-h_pl2').on('click', function () {
            const fileUrl = $(this).data('doc');

            if (fileUrl) { // hanya jika tidak kosong/null/undefined
                $('#iframePreviewFile').attr('src', fileUrl);
            } else {
                const file = $('#h_pl2')[0].files[0];
                render_doc(file)
            }
        });
        $('#h_pl3').on('change', function () {
            const file = this.files[0];
            const btn = $('#btn-preview-h_pl3');

            // const $iframe = $('#preview-h_p');

            if (file) {
                const fileType = file.type;

                const allowedTypes = ['application/pdf', 'image/png', 'image/jpeg', 'image/jpg'];
                if (allowedTypes.includes(fileType)) {
                    $('#btn-preview-h_pl3').show();
                    $('#btn-preview-h_pl3').data('doc', '');
                } else {
                    $('#btn-preview-h_pl3').hide();
                    alert('Tipe file tidak didukung');
                }
            } else {
                btn.hide();
            }
        });

        $('#btn-preview-h_pl3').on('click', function () {
            const fileUrl = $(this).data('doc');

            if (fileUrl) { // hanya jika tidak kosong/null/undefined
                $('#iframePreviewFile').attr('src', fileUrl);
            } else {
                const file = $('#h_pl3')[0].files[0];
                render_doc(file)
            }
        });

        function render_doc(file) {
            const fileType = file.type;
            const $iframe = $('#iframePreviewFile');

            if (fileType.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = async function (e) {
                    const imageBytes = await fetch(e.target.result).then(res => res.arrayBuffer());
                    const pdfDoc = await PDFLib.PDFDocument.create();
                    const image = fileType === 'image/png' ?
                        await pdfDoc.embedPng(imageBytes) :
                        await pdfDoc.embedJpg(imageBytes);

                    const page = pdfDoc.addPage([image.width, image.height]);
                    page.drawImage(image, {
                        x: 0,
                        y: 0,
                        width: image.width,
                        height: image.height,
                    });

                    const pdfBytes = await pdfDoc.save();
                    const pdfBlob = new Blob([pdfBytes], {
                        type: 'application/pdf'
                    });
                    const pdfUrl = URL.createObjectURL(pdfBlob);

                    $iframe.attr('src', pdfUrl);
                };
                reader.readAsDataURL(file);

            } else if (fileType === 'application/pdf') {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $iframe.attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
            } else {
                alert('Tipe file tidak didukung');
            }
        }

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
                "h_pendahuluan": {
                    required: imgCheck_p,
                    accept: "image/png, image/jpg, image/jpeg, application/pdf",
                    filesize: {
                        param: 2097152, // 2MB
                        depends: function (element) {
                            return !imgCheck_p && $(element).val() !== "";
                        } // Max file size in bytes (5MB)
                    },
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
                "h_pendahuluan": {
                    required: "Dokumen Permohonan wajib diisi",
                    accept: "Pilih dengan format (jpg,jpeg,png,pdf)", // Allowed extensions
                    filesize: "Pilih file dengan ukuran maks. 2MB", // Max file size in bytes (5MB)
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
                "h_pl1": {
                    required: imgCheck_pl1,
                    accept: "image/png, image/jpg, image/jpeg, application/pdf",
                    filesize: {
                        param: 2097152, // 2MB
                        depends: function (element) {
                            return !imgCheck_pl1 && $(element).val() !== "";
                        } // Max file size in bytes (5MB)
                    },
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
                "h_pl1": {
                    required: "Dokumen Permohonan wajib diisi",
                    accept: "Pilih dengan format (jpg,jpeg,png,pdf)", // Allowed extensions
                    filesize: "Pilih file dengan ukuran maks. 2MB", // Max file size in bytes (5MB)
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
        $("#pl3_f").validate({
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
                "k_pl3": {
                    required: true,
                },
                "pl3": {
                    required: imgCheck_pl3,
                    accept: "image/png, image/jpg, image/jpeg",
                    filesize: {
                        param: 2097152, // 2MB
                        depends: function (element) {
                            return !imgCheck_pl3 && $(element).val() !== "";
                        } // Max file size in bytes (5MB)
                    },
                },
                "s_pl3": {
                    required: true,
                    number: true,
                    min: 0.0
                },
                "tg_pl3": {
                    required: true,
                    dateITA: true,
                },
            },
            messages: {
                "k_pl3": {
                    required: "Keterangan wajib diisi",
                },
                "pl3": {
                    required: "Foto pependahuluan wajib diisi",
                    accept: "Pilih dengan format (jpg,jpeg,png)", // Allowed extensions
                    filesize: "Pilih file dengan ukuran maks. 2MB", // Max file size in bytes (5MB)
                },
                "s_pl3": {
                    required: "Luas Lahan spoting wajib diisi, isi 0 jika memang kosong",
                    number: "Luas Lahan spoting wajib diisi dengan angkat",
                },
                "tg_pl3": {
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
