<x-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:head_link>
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        @if (auth()->user()->role == 'qc')
            @if ($regis)
                <li class="breadcrumb-item"><a href="{{ route('lapang') }}">Lapang</a></li>
                <li class="breadcrumb-item active" aria-current="page">Restrasi Nomor Lapang</li>
            @else
                <li class="breadcrumb-item active" aria-current="page">Lapang</li>
            @endif
        @else
            <li class="breadcrumb-item active" aria-current="page">Lahan</li>
        @endif

    </x-slot:head_link>

    {{-- start content --}}
    <div class="row">
        <div class="col-md-12">
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingListData">
                        <h5 class="card-title">
                            <a href="#" data-toggle="collapse" data-target="#collapseListData"
                                aria-expanded="true" aria-controls="collapseListData">
                                Daftar Lahan
                            </a>
                        </h5>
                        @if (auth()->user()->role == 'qc')
                            @if ($regis)
                                <h6 class="card-subtitle text-muted">Daftar data lahan yang belum terregistrsi nomor
                                    lapang
                                </h6>
                            @else
                                <h6 class="card-subtitle text-muted">Daftar data Nomor Lapang yang telah diregistrsi
                                </h6>
                            @endif
                        @else
                            <h6 class="card-subtitle text-muted">Daftar data lahan yang telah terregistrsi</h6>
                        @endif
                    </div>
                    <div id="collapseListData" class="collapse show" aria-labelledby="headingListData"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <table id="lahan" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nomor Blok</th>
                                        <th>Nama Pemilik</th>
                                        <th>Varietas</th>
                                        @if (auth()->user()->role == 'qc' && !$regis)
                                            <th>Nomor Lapang</th>
                                        @else
                                            <th>Alamat Pemilik</th>
                                        @endif
                                        <th>Luas</th>
                                        <th>Tgl. Semai</th>
                                        <th>Tgl. Tanam</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($lahans as $lahan)
                                        <tr>
                                            <td>{{ $lahan->no_blok }}</td>
                                            <td>{{ $lahan->nama }}</td>
                                            <td>{{ $lahan->varietas }}</td>
                                            @if (auth()->user()->role == 'qc' && !$regis)
                                                <td>{{ $lahan->lapang }}</td>
                                            @else
                                                <td>{{ $lahan->alamat }}</td>
                                            @endif

                                            <td>{{ $lahan->luas . ' ha' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($lahan->semai)->format('d/m/Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($lahan->tanam)->format('d/m/Y') }}</td>
                                            <td>

                                                @if (auth()->user()->role == 'qc')
                                                    <a href="#collapseOne" data-toggle="collapse"
                                                        data-target="#collapseOne" class="accr-detail text-info"
                                                        aria-expanded="true" aria-controls="collapseOne"
                                                        data-lapang="{{ $lahan->lapang }}"
                                                        data-blok_lahan="{{ $lahan->no_blok }}"
                                                        data-s="{{ $lahan->id }}">
                                                        <i class="align-middle mr-2 far fa-fw fa-edit"></i>
                                                    </a>
                                                @endif

                                                @if (auth()->user()->role == 'produksi')
                                                    <a href="#detailahan" data-toggle="modal"
                                                        class="go-detail text-info"
                                                        data-blok_lahan="{{ $lahan->no_blok }}">
                                                        <i class="align-middle fas fa-fw fa-eye"></i></a>
                                                    <a href="#detailahan" data-toggle="modal" class="go-del text-danger"
                                                        data-blok_lahan="{{ $lahan->no_blok }}"
                                                        data-blok="{{ $lahan->id }}"
                                                        data-action="{{ route('delete regis lahan', ['s' => '__ID__']) }}">
                                                        <i class="align-middle fas fa-fw fa-trash"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger p-1">
                                            @if (auth()->user()->role == 'qc')
                                                Belum ada Lahan yang bisa diregistrasi nomor lapang
                                            @else
                                                Belum ada Lahan yang diregistrasi
                                            @endif

                                        </div>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                @if (auth()->user()->role == 'qc')
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="card-title my-2" id="title_blok">
                                @if ($regis)
                                    Input
                                @else
                                    Perbarui
                                @endif Nomor Lapang
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse @error('lapang') show @enderror" aria-labelledby="headingOne"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6" id="area_form_lapang"></div>
                                    <div class="col-lg-7 col-md-6">
                                        <h5>Input Nomor Lapang</h5>
                                        <form class="form-inline form-group" id="formLapang" action="#"
                                            method="POST">
                                            @csrf
                                            @method('put')

                                            <input type="text"
                                                class="form-control mb-2 mr-sm-2 @error('lapang') is-invalid @enderror"
                                                placeholder="No. Lapang..." value="{{ old('lapang') }}" id="lapang"
                                                name="lapang" style="width: 80%">
                                            @error('lapang')
                                                <div class="jquery-validation-error small form-text invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- end content --}}
    @push('sc')
        <script>
            $(document).ready(function() {
                const qcMode = {{ auth()->user()->role == 'qc' ? 'true' : 'false' }};
            });
        </script>
        @if (auth()->user()->role == 'qc')
            <script src="{{ asset('js/regis_lapang.js') }}"></script>
        @else
            <script src="{{ asset('js/lahan.js') }}"></script>
        @endif
    @endpush
</x-layout>
