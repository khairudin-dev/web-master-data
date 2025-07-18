<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:head_link>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
    </x-slot:head_link>

    {{-- start content --}}
    <div class="row">
        <div class="col-12">
            <div class="card">

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
                @else
                    <div class="card-header">
                        <h5 class="card-title mb-0">Empty card</h5>
                    </div>
                    <div class="card-body">
                        <div class="my-5">&nbsp;</div>
                    </div>
                @endif

            </div>
        </div>
    </div>
    {{-- end content --}}
    @push('sc')
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
    @endpush
</x-layout>
