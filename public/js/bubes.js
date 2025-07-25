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
    })
