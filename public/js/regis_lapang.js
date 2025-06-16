function editForm() {
    $("#form_regis_lapang").validate({
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
                // minlength: 10,
                // remote: {
                //     url: '/u-blk',
                //     type: 'post',
                //     data: {
                //         no_blok: function () {
                //             return $('#blok').val();
                //         },
                //         edit: function () {
                //             return editMode ? getFormParam('s') : null; // atau sesuaikan nama field ID Anda
                //         },
                //         _token: $('meta[name="csrf-token"]').attr('content') // jika pakai Laravel
                //     }
                // }
            },
        },
        messages: {
            "lapang": {
                required: "Nomor Blok wajib diisi",
                // minlength: "Nomor Blok minimal 10 karakter",
                remote: "Nomor Blok sudah digunakan"
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
}
