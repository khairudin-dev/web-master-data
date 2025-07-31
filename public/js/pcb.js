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

        $(document).on('click', '.accr-inpspl', function () {
            var noBlok = $(this).data('blok_lahan');
            $('#title_blok').text("Data Proses | Blok : " + noBlok);
            // $('#lapang').val($(this).data('lapang'));
            $('#formAmbil').attr('action', '/ambil/' + $(this).data('s'));
            // $('#area_form_lapang').html('<p>Memuat data...</p>');
            //    console.log($(this).data('l').luas_akhir)
            $('#td_lulus').html($(this).data('l').luas_akhir + ' ha');
            $('#td_varietas').html($(this).data('l').varietas);
            $('#txt_blok').html($(this).data('l').no_blok);
            $('#td_panen').html(moment($(this).data('l').panen).format("DD/MM/yyyy"));
            var limit = moment($(this).data('l').tg_p_spl).format("DD/MM/yyyy");
            $('#datetimepicker-ambil').datetimepicker('minDate', moment(limit, 'DD/MM/YYYY').clone());
            $('#txt_lpg').html($(this).data('l').lapang);
            $('#td_tg_p_spl').html(moment($(this).data('l').tg_p_spl).format("DD/MM/yyyy"));
            $('#td_gkp').html($(this).data('l').gkp + " Kg");
            $('#td_cbb').html($(this).data('l').cbb + " Kg");
            const p_spl = $(this).data('spl_doc');
            $('#preview-spl-pdf').attr('src', p_spl) // atur sumber PDF

            const tg_pengambilan = $(this).data('l').tg_pengambilan;
            if (tg_pengambilan) {
                const formattedDate = moment(tg_pengambilan).format("DD/MM/YYYY");
                $('#datetimepicker-ambil').datetimepicker('date', formattedDate);
            }
            const doc_pengambilan = $(this).data('doc');
            if (doc_pengambilan) {
                $('#preview-pdf')
                    .attr('src', doc_pengambilan) // atur sumber PDF
                    .css('display', 'block'); // tampilkan iframe
            }

            //ambil detail lahan
            // loadDetailLahan_acccord(noBlok)

        });
        $('#datetimepicker-ambil').datetimepicker({
            format: 'DD/MM/YYYY',
            useCurrent: false // Penting agar tidak otomatis mengisi saat tanam ketika semai dipilih
        });
        $('#permohonan').on('change', function () {
            const file = this.files[0];
            const $iframe = $('#preview-pdf');

            if (file) {
                const fileType = file.type;

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

                        $iframe.attr('src', pdfUrl).show();
                    };
                    reader.readAsDataURL(file);
                } else if (fileType === 'application/pdf') {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        $iframe.attr('src', e.target.result).show();
                    };
                    reader.readAsDataURL(file);
                } else {
                    $iframe.hide();
                    alert('Tipe file tidak didukung');
                }
            } else {
                $iframe.hide();
            }
        });
        $("#formAmbil").validate({
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
                "permohonan": {
                    required: imgCheck,
                    accept: "image/png, image/jpg, image/jpeg, application/pdf",
                    filesize: {
                        param: 2097152, // 2MB
                        depends: function (element) {
                            return !imgCheck && $(element).val() !== "";
                        } // Max file size in bytes (5MB)
                    },
                },
                "ambil": {
                    required: true,
                    dateITA: true,
                },
            },
            messages: {
                "permohonan": {
                    required: "Dokumen Permohonan wajib diisi",
                    accept: "Pilih dengan format (jpg,jpeg,png,pdf)", // Allowed extensions
                    filesize: "Pilih file dengan ukuran maks. 2MB", // Max file size in bytes (5MB)

                },
                "sampel": {
                    required: "Tanggal Permohonan wajib diisi",
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
        $('.btn-preview-doc').on('click', function () {
            const fileUrl = $(this).data('doc');
            $('#iframePreviewFile').attr('src', fileUrl);
        });

    })
