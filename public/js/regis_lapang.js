$(document).ready(function () {
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
            },
        },
        messages: {
            "lapang": {
                required: "Nomor Blok wajib diisi",
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
            if ($el.hasClass("select2-hidden-accessible") || $el.attr("data-role") === "tagsinput") {
                $el.parent().addClass("is-invalid");
            }
        },
        unhighlight: function (element) {
            $(element).parents(".form-group").find(".is-invalid").removeClass("is-invalid");
        }
    });
});

function editForm() {
}