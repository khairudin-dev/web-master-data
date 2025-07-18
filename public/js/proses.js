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
   $(document).on('click', '.accr-detail', function () {
       var noBlok = $(this).data('blok_lahan');
       $('#title_blok').text("Data Proses | Blok : " + noBlok);
       // $('#lapang').val($(this).data('lapang'));
       $('#formProses').attr('action', '/proses/' + $(this).data('s'));
       // $('#area_form_lapang').html('<p>Memuat data...</p>');
       //    console.log($(this).data('l').luas_akhir)
       $('#td_lulus').html($(this).data('l').luas_akhir + ' ha');
       $('#td_varietas').html($(this).data('l').varietas);
       $('#txt_blok').html($(this).data('l').no_blok);
       $('#td_panen').html(moment($(this).data('l').panen).format("DD/MM/yyyy"));
       $('#txt_lpg').html($(this).data('l').lapang);
       $('#td_tn').html($(this).data('l').tonase + " Kg");
       $('#td_tk').html($(this).data('l').taksasi + " Kg");
       $('#gkp').html($(this).data('l').gkp);
       $('#cbb').html($(this).data('l').cbb);


       //ambil detail lahan
       // loadDetailLahan_acccord(noBlok)

   });
   $("#formProses").validate({
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
           "gkp": {
               required: true,
               number: true,
               min: 0.0
           },
           "cbb": {
               required: true,
               number: true,
               min: 0.0
           },
       },
       messages: {
           "gkp": {
               required: "GKP wajib diisi, isi 0 jika memang kosong",
               number: "GKP wajib diisi dengan angkat",
           },
           "cbb": {
               required: "CBB wajib diisi, isi 0 jika memang kosong",
               number: "CBB wajib diisi dengan angkat",
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
