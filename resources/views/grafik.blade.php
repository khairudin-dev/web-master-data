<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:head_link>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
    </x-slot:head_link>

    {{-- start content --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- <div class="card-header">
                    <h5 class="card-title mb-0">Empty card</h5>
                </div> -->
                @if (auth()->user()->role == 'superadmin')
                    <div class="col-12 col-md-12 col-xxl-4 d-flex">
                        <div class="card flex-fill w-100">
                            <div class="card-header">
                                {{-- <div class="card-actions float-right">
                                <a href="#" class="mr-1">
                                    <i class="align-middle" data-feather="refresh-cw"></i>
                                </a>
                                <div class="d-inline-block dropdown show">
                                    <a href="#" data-toggle="dropdown" data-display="static">
                                        <i class="align-middle" data-feather="more-vertical"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div> --}}
                                <h5 class="card-title mb-0">Data Lahan Penangkaran (ha) Standing Crop</h5>
                            </div>
                            <div class="card-body d-flex w-100">
                                <div class="align-self-center chart">
                                    <canvas id="chartjs-dashboard-bar-alt"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- <div class="col-12 col-md-12 col-xxl-4 d-flex">
                    <div class="card flex-fill w-100">
                        <div class="card-header">
                            <div class="card-actions float-right">
                                <a href="#" class="mr-1">
                                    <i class="align-middle" data-feather="refresh-cw"></i>
                                </a>
                                <div class="d-inline-block dropdown show">
                                    <a href="#" data-toggle="dropdown" data-display="static">
                                        <i class="align-middle" data-feather="more-vertical"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <h5 class="card-title mb-0">Data Stok (Ton)</h5>
                        </div>
                        <div class="card-body d-flex w-100">
                            <div class="align-self-center chart">
                                <canvas id="chartjs-stok"></canvas>
                            </div>
                        </div>
                    </div>
                </div> --}}


                <div class="card-body">
                    <div class="my-5">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>

    {{-- end content --}}
    <script src=" {{ asset('js/app.js') }}"></script>

    {{-- <script>
        $(function() {
            var mapData = {
                "US": 298,
                "SA": 200,
                "DE": 220,
                "FR": 540,
                "CN": 120,
                "AU": 760,
                "BR": 550,
                "IN": 200,
                "GB": 120,
            };
            $('#world_map').vectorMap({
                map: 'world_mill',
                backgroundColor: "transparent",
                zoomOnScroll: false,
                regionStyle: {
                    initial: {
                        fill: '#e4e4e4',
                        "fill-opacity": 0.9,
                        stroke: 'none',
                        "stroke-width": 0,
                        "stroke-opacity": 0
                    }
                },
                series: {
                    regions: [{
                        values: mapData,
                        scale: [window.theme.primary],
                        normalizeFunction: 'polynomial'
                    }]
                },
            });
            setTimeout(function() {
                $(window).trigger('resize');
            }, 350)
        })
    </script> --}}
    {{-- <script>
        $(function() {
            // Pie chart
            new Chart(document.getElementById("chartjs-dashboard-pie"), {
                type: 'pie',
                data: {
                    labels: ["Chrome", "Firefox", "IE", "Other"],
                    datasets: [{
                        data: [4401, 4003, 1589],
                        backgroundColor: [
                            window.theme.primary,
                            window.theme.warning,
                            window.theme.danger,
                            "#E8EAED"
                        ],
                        borderColor: "transparent"
                    }]
                },
                options: {
                    responsive: !window.MSInputMethodContext,
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    cutoutPercentage: 75
                }
            });
        });
    </script> --}}
    {{-- <script>
        $(function() {
            // Radar chart
            new Chart(document.getElementById("chartjs-dashboard-radar"), {
                type: "radar",
                data: {
                    labels: ["Technology", "Sports", "Media", "Gaming", "Arts"],
                    datasets: [{
                        label: "Interests",
                        backgroundColor: "rgba(0, 123, 255, 0.2)",
                        borderColor: "#2979ff",
                        pointBackgroundColor: "#2979ff",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "#2979ff",
                        data: [70, 53, 82, 60, 33]
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    }
                }
            });
        });
    </script> --}}
    @if (auth()->user()->role == 'superadmin')
        <script>
            $(function() {
                const labels = @json($hasil->pluck('varietas'));
                const values = @json($hasil->pluck('total_luas'));

                // Bar chart
                new Chart(document.getElementById("chartjs-dashboard-bar-alt"), {
                    type: "bar",
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Luas Tanam (ha)",
                            backgroundColor: window.theme.primary,
                            borderColor: window.theme.primary,
                            hoverBackgroundColor: window.theme.primary,
                            hoverBorderColor: window.theme.primary,
                            data: values,
                            barPercentage: .75,
                            categoryPercentage: .5
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                gridLines: {
                                    display: false
                                },
                                stacked: false,
                                ticks: {
                                    stepSize: 20
                                }
                            }],
                            xAxes: [{
                                stacked: false,
                                gridLines: {
                                    color: "transparent"
                                }
                            }]
                        }
                    }
                });
            });
        </script>
    @endif


    {{-- <script>
        $(function() {
            // Bar chart
            new Chart(document.getElementById("chartjs-stok"), {
                type: "bar",
                data: {
                    labels: ["Cakra", "Ciherang", "Ciliwung", "Cimelati", "Inpago 8", "Inpago 10",
                        "Inpago 13 Fortiz", "Inpara 2", "Inpara 8", "Inpara 9", "Inpari 30",
                        "Inpari 32", "Inpari 39", "Inpari 42", "Inpari 43", "Inpari 47", "Inpari 48",
                        "Inpari 49", "Inpari 50", "IR 64", "Logawa", "Mantap", "Mekongga", "Muncul",
                        "Nutrizinc", "Padjajaran", "Situbagendit"
                    ],
                    datasets: [{
                            label: "Stok Masuk Benih Dasar",
                            backgroundColor: "#FFFF00",
                            borderColor: "#FFFF00",
                            hoverBackgroundColor: "#FFFF00",
                            hoverBorderColor: "#FFFF00",
                            data: [54, 200, , 55, , 45, 55, 73, 60, 76, 148, 79, 254, 67, 41, 155, 262,
                                45, 255, 73, 60, 76, 48, 79, 20, 30, 90
                            ],
                            barPercentage: .75,
                            categoryPercentage: .5
                        }, {
                            label: "Stok Masuk Benih Pokok",
                            backgroundColor: "#800080",
                            borderColor: "#800080",
                            hoverBackgroundColor: "#800080",
                            hoverBorderColor: "#800080",
                            data: [69, 66, , 48, , 51, 44, 53, 62, 79, 51, 68, 69, 66, 24, 48, 52, 51,
                                44, 53, 62, 79, 51, 68, 50, 40, 10
                            ],
                            barPercentage: .75,
                            categoryPercentage: .5
                        }, {
                            label: "Stok Masuk Benih Sebar",
                            backgroundColor: "#0000FF",
                            borderColor: "#0000FF",
                            hoverBackgroundColor: "#0000FF",
                            hoverBorderColor: "#0000FF",
                            data: [69, 66, , 48, , 51, 44, 53, 62, 79, 51, 68, 69, 66, 24, 48, 52, 51,
                                44, 53, 62, 79, 51, 68, 50, 40, 10
                            ],
                            barPercentage: .75,
                            categoryPercentage: .5
                        },
                        {
                            label: "Stok Keluar Benih Dasar",
                            backgroundColor: "#FFFF00",
                            borderColor: "#FFFF00",
                            hoverBackgroundColor: "#FFFF00",
                            hoverBorderColor: "#FFFF00",
                            data: [54, 200, , 55, , 45, 55, 73, 60, 76, 148, 79, 254, 67, 41, 155, 262,
                                45, 255, 73, 60, 76, 48, 79, 20, 30, 90
                            ],
                            barPercentage: .75,
                            categoryPercentage: .5
                        }, {
                            label: "Stok Keluar Benih Pokok",
                            backgroundColor: "#800080",
                            borderColor: "#800080",
                            hoverBackgroundColor: "#800080",
                            hoverBorderColor: "#800080",
                            data: [69, 66, , 48, , 51, 44, 53, 62, 79, 51, 68, 69, 66, 24, 48, 52, 51,
                                44, 53, 62, 79, 51, 68, 50, 40, 10
                            ],
                            barPercentage: .75,
                            categoryPercentage: .5
                        }, {
                            label: "Stok Keluar Benih Sebar",
                            backgroundColor: "#0000FF",
                            borderColor: "#0000FF",
                            hoverBackgroundColor: "#0000FF",
                            hoverBorderColor: "#0000FF",
                            data: [69, 66, , 48, , 51, 44, 53, 62, 79, 51, 68, 69, 66, 24, 48, 52, 51,
                                44, 53, 62, 79, 51, 68, 50, 40, 10
                            ],
                            barPercentage: .75,
                            categoryPercentage: .5
                        }, {
                            label: "Stok Benih Dasar",
                            backgroundColor: "#FFFF00",
                            borderColor: "#FFFF00",
                            hoverBackgroundColor: "#FFFF00",
                            hoverBorderColor: "#FFFF00",
                            data: [54, 200, , 55, , 45, 55, 73, 60, 76, 148, 79, 254, 67, 41, 155, 262,
                                45, 255, 73, 60, 76, 48, 79, 20, 30, 90
                            ],
                            barPercentage: .75,
                            categoryPercentage: .5
                        }, {
                            label: "Stok Benih Pokok",
                            backgroundColor: "#800080",
                            borderColor: "#800080",
                            hoverBackgroundColor: "#800080",
                            hoverBorderColor: "#800080",
                            data: [69, 66, , 48, , 51, 44, 53, 62, 79, 51, 68, 69, 66, 24, 48, 52, 51,
                                44, 53, 62, 79, 51, 68, 50, 40, 10
                            ],
                            barPercentage: .75,
                            categoryPercentage: .5
                        }, {
                            label: "Stok Benih Sebar",
                            backgroundColor: "#0000FF",
                            borderColor: "#0000FF",
                            hoverBackgroundColor: "#0000FF",
                            hoverBorderColor: "#0000FF",
                            data: [69, 66, , 48, , 51, 44, 53, 62, 79, 51, 68, 69, 66, 24, 48, 52, 51,
                                44, 53, 62, 79, 51, 68, 50, 40, 10
                            ],
                            barPercentage: .75,
                            categoryPercentage: .5
                        },
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: false
                            },
                            stacked: false,
                            ticks: {
                                stepSize: 20
                            }
                        }],
                        xAxes: [{
                            stacked: false,
                            gridLines: {
                                color: "transparent"
                            }
                        }]
                    }
                }
            });
        });
    </script> --}}

    {{-- <script>
        $(function() {
            $("#datatables-dashboard-traffic").DataTable({
                pageLength: 7,
                lengthChange: false,
                bFilter: false,
                autoWidth: false,
                order: [
                    [1, "desc"]
                ]
            });
        });
    </script> --}}
</x-layout>
