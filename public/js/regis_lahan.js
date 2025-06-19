    $(document).ready(function () {
        if (window.innerWidth > 912) { // 768px adalah breakpoint 'md' di Bootstrap
            $("#sidebar").addClass("toggled");
        }

        $('#alamat, #lokasi').mask('A', {
            translation: {
                A: {
                    pattern: /[^,]/, //Semua karakter kecuali koma
                    recursive: true,
                }
            }
        });

        // $('#blok').mask('AAA S YYYY', {
        //     translation: {
        //         A: {
        //             pattern: /[A-Z]/
        //         },
        //         S: {
        //             pattern: /[A-Z]/
        //         },
        //         Y: {
        //             pattern: /[0-9]/
        //         }
        //     }
        // });

        // Select2

        $(".select2").select2({
            allowClear: true,
            placeholder: "Silahkan pilih...",
        }).change(function () {
            $(this).valid();
        });
        // Pastikan dataWilayah sudah tersedia dari blade sebelum file ini dijalankan
        // Isi dropdown provinsi
        $('#provinsi').append(`<option value="">Pilih Provinsi</option>`);
        dataWilayah.provinsi.forEach(prov => {
            $('#provinsi').append(`<option value="${prov.nama}">${prov.nama}</option>`);
        });

        $('#varietas').append(`<option value="">Pilih Provinsi</option>`);
        dataForm.varietas.forEach(varietas => {
            $('#varietas').append(`<option value="${varietas}">${varietas}</option>`);
        });
        $('#kb').append(`<option value="">Pilih Provinsi</option>`);
        dataForm.kb.forEach(kb => {
            $('#kb').append(`<option value="${kb}">${kb}</option>`);
        });
        $('#musim').append(`<option value="">Pilih Provinsi</option>`);
        dataForm.musim.forEach(musim => {
            $('#musim').append(`<option value="${musim}">${musim}</option>`);
        });

        // Datetimepicker
        $('#datetimepicker-semai').datetimepicker({
            format: 'DD/MM/YYYY',
            useCurrent: false // Penting agar tidak otomatis mengisi saat tanam ketika semai dipilih

        });
        $('#datetimepicker-tanam').datetimepicker({
            format: 'DD/MM/YYYY',
        });

        // Saat tanggal semai diubah
        $("#datetimepicker-semai").on("change.datetimepicker", function (e) {
            // Set tanggal minimum untuk tanam agar setelah semai
            $('#datetimepicker-tanam').datetimepicker('minDate', e.date.add(1, 'day'));
        });
        // Saat tanggal tanam diubah
        $("#datetimepicker-tanam").on("change.datetimepicker", function (e) {
            // Set tanggal maksimum untuk semai agar sebelum tanam
            $('#datetimepicker-semai').datetimepicker('maxDate', e.date.subtract(1, 'day'));
        });


        $('#label').on('change', function () {
            const file = this.files[0];
            const $preview = $('#preview-label');

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
        $('#lokasi').on('change', function () {
            const file = this.files[0];
            const $preview = $('#preview-lokasi');

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
        $('#provinsi').on('change', function () {
            let provinsiDipilih = $(this).val();
            $('#kota').empty().append(`<option value="">Pilih Kabupaten</option>`);
            $('#kecamatan').empty().append(`<option value="">Pilih Kecamatan</option>`);
            $('#desa').empty().append(`<option value="">Pilih Desa</option>`);

            let prov = dataWilayah.provinsi.find(p => p.nama === provinsiDipilih);
            if (prov) {
                prov.kabupaten.forEach(kab => {
                    $('#kota').append(`<option value="${kab.nama}">${kab.nama}</option>`);
                });
            }
        });

        $('#kota').on('change', function () {
            let provinsiDipilih = $('#provinsi').val();
            let kabupatenDipilih = $(this).val();

            $('#kecamatan').empty().append(`<option value="">Pilih Kecamatan</option>`);
            $('#desa').empty().append(`<option value="">Pilih Desa</option>`);

            let prov = dataWilayah.provinsi.find(p => p.nama === provinsiDipilih);
            if (!prov) return;

            let kab = prov.kabupaten.find(k => k.nama === kabupatenDipilih);
            if (kab) {
                kab.kecamatan.forEach(kec => {
                    $('#kecamatan').append(`<option value="${kec.nama}">${kec.nama}</option>`);
                });
            }
        });
        $('#kecamatan').on('change', function () {
            let provinsiDipilih = $('#provinsi').val();
            let kabupatenDipilih = $('#kota').val();
            let kecamatanDipilih = $(this).val();

            $('#desa').empty().append(`<option value="">Pilih Desa</option>`);

            let prov = dataWilayah.provinsi.find(p => p.nama === provinsiDipilih);
            if (!prov) return;

            let kab = prov.kabupaten.find(k => k.nama === kabupatenDipilih);
            if (!kab) return;

            let kec = kab.kecamatan.find(k => k.nama === kecamatanDipilih);
            if (kec) {
                kec.desa.forEach(desa => {
                    $('#desa').append(`<option value="${desa}">${desa}</option>`);
                });
            }
        });

        $.validator.addMethod("filesize", function (value, element, arg) {
            if (element.files.length > 0 && element.files[0].size <= arg) {
                return true;
            }
            return false;
        }, "File size must be less than {0} bytes.");

        $.validator.addMethod("noComma", function (value, element) {
            return this.optional(element) || value.indexOf(",") === -1;
        }, "Tidak boleh mengandung tanda koma (,)");


        function getFormParam(name) {
            const actionUrl = $('#form_regis').attr('action'); // "/update-lahan/2"
            const match = actionUrl.match(/\/update-lahan\/(\d+)/);
            return match ? match[1] : null;
        }

        $("#form_regis").validate({
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
                "blok": {
                    required: true,
                    // minlength: 10,
                    remote: {
                        url: '/u-blk',
                        type: 'post',
                        data: {
                            no_blok: function () {
                                return $('#blok').val();
                            },
                            edit: function () {
                                return editMode ? getFormParam('s') : null; // atau sesuaikan nama field ID Anda
                            },
                            _token: $('meta[name="csrf-token"]').attr('content') // jika pakai Laravel
                        }
                    }
                },
                "nama": {
                    required: true,
                    minlength: 3
                },
                "alamat": {
                    required: true,
                    // minlength: 16,
                    noComma: true
                },
                "provinsi": {
                    required: true,
                },
                "kota": {
                    required: true,
                },
                "kecamatan": {
                    required: true,
                },
                "desa": {
                    required: true,
                },
                "varietas": {
                    required: true,
                },
                "kb": {
                    required: true,
                },
                "musim": {
                    required: true,
                },
                "label": {
                    required: !editMode,
                    accept: "image/png, image/jpg, image/jpeg",
                    filesize: {
                        param: 2097152, // 2MB
                        depends: function (element) {
                            return !editMode && $(element).val() !== "";
                        } // Max file size in bytes (5MB)
                    },
                },
                "lokasi": {
                    required: !editMode,
                    accept: "image/png, image/jpg, image/jpeg",
                    filesize: {
                        param: 2097152, // 2MB
                        depends: function (element) {
                            return !editMode && $(element).val() !== "";
                        } // Max file size in bytes (5MB)
                    },
                },
                "sumber": {
                    required: true,
                    minlength: 3
                },
                "luas": {
                    required: true,
                    number: true,
                    min: 0.1
                },
                "semai": {
                    required: true,
                    dateITA: true,
                },
                "tanam": {
                    required: true,
                    dateITA: true,
                },
            },
            messages: {
                "blok": {
                    required: "Nomor Blok wajib diisi",
                    // minlength: "Nomor Blok minimal 10 karakter",
                    remote: "Nomor Blok sudah digunakan"
                },
                "nama": {
                    required: "Nama wajib diisi",
                    minlength: "Nama minimal 3 karakter"
                },
                "alamat": {
                    required: "Alamat wajib diisi",
                    // minlength: "Alamat minimal 16 karakter"
                },
                "provinsi": {
                    required: "Provinsi wajib diisi",
                },
                "kota": {
                    required: "Kota / Kabupaten wajib diisi",
                },
                "kecamatan": {
                    required: "Kecamatan wajib diisi",
                },
                "desa": {
                    required: "Desa / Kelurahan wajib diisi",
                },
                "varietas": {
                    required: "Varietas wajib diisi",
                },
                "kb": {
                    required: "Kualitas Benih wajib diisi",
                },
                "musim": {
                    required: "Musim Tanam wajib diisi",
                },
                "label": {
                    required: "Foto Label wajib diisi",
                    accept: "Pilih dengan format (jpg,jpeg,png)", // Allowed extensions
                    filesize: "Pilih file dengan ukuran maks. 2MB", // Max file size in bytes (5MB)
                },
                "lokasi": {
                    required: "Foto Label wajib diisi",
                    accept: "Pilih dengan format (jpg,jpeg,png)", // Allowed extensions
                    filesize: "Pilih file dengan ukuran maks. 2MB", // Max file size in bytes (5MB)
                },
                // "l_provinsi": {
                //     required: "Provinsi wajib diisi",
                // },
                // "l_kota": {
                //     required: "Kota / Kabupaten wajib diisi",
                // },
                // "l_kecamatan": {
                //     required: "Kecamatan wajib diisi",
                // },
                // "l_desa": {
                //     required: "Desa / Kelurahan wajib diisi",
                // },

                "sumber": {
                    required: "Label Sumber wajib diisi",
                    minlength: "Label Sumber minimal 3 karakter"
                },
                "luas": {
                    required: "Luas Lahan wajib diisi",
                    min: "Luas Lahan minimal 0.1 ha"
                },
                "semai": {
                    required: "Tanggal Semai wajib diisi",
                    dateITA: "Isian wajib berupa tanggal! (HH/BB/TTTT)",
                },
                "tanam": {
                    required: "Tanggal Tanam wajib diisi",
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


        $.each(formData, function (key, val) {
            if (val) {
                $("#" + key).val(val).trigger('change');
            }
        });

    });
