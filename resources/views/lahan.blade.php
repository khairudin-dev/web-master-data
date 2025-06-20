<x-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:head_link>
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        @if (auth()->user()->role == 'qc')
            @if (isset($regis_lpg))
                <li class="breadcrumb-item"><a href="{{ route('lapang') }}">Lapang</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
            @elseif (isset($inppmt))
                <li class="breadcrumb-item"><a href="{{ route('pemantauan lapang') }}">Pemantauan</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
            @elseif (isset($pmt))
                <li class="breadcrumb-item active" aria-current="page">Pemantauan</li>
            @elseif (isset($inppn))
                <li class="breadcrumb-item"><a href="{{ route('panen') }}">Panen</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
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
                            @if (isset($regis_lpg))
                                <h6 class="card-subtitle text-muted">Daftar data lahan yang belum terregistrsi nomor
                                    lapang
                                </h6>
                            @elseif(isset($lpg) or isset($inppmt))
                                <h6 class="card-subtitle text-muted">Daftar data lahan yang telah diregistrsi Nomor
                                    Lapang
                                </h6>
                            @elseif(isset($inppn) or isset($pmt))
                                <h6 class="card-subtitle text-muted">Daftar data lahan yang telah dipantau
                                </h6>
                            @else
                                <h6 class="card-subtitle text-muted">Daftar data lahan yang telah dipanen
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
                                        @if (auth()->user()->role == 'qc' or auth()->user()->role == 'produksi')

                                            @if (isset($regis_lpg) or auth()->user()->role == 'produksi')
                                                <th>Alamat Pemilik</th>
                                            @else
                                                <th>Nomor Lapang</th>
                                            @endif
                                            @if (isset($pmt))
                                                <th>Pendahuluan</th>
                                                <th>PL 1</th>
                                                <th>PL 2</th>
                                                <th>PL 3</th>
                                            @elseif(isset($pn))
                                                <th>Panen</th>
                                                <th>Luas Lulus</th>
                                                <th>Taksasi</th>
                                                <th>tonase</th>
                                            @else
                                                @if (!isset($inppn))
                                                    <th>Nama Pemilik</th>
                                                @else
                                                    <th>Kelas Benih</th>
                                                @endif
                                                <th>Varietas</th>
                                                <th>Luas</th>
                                                @if (isset($inppn))
                                                    <th>Luas Akhir</th>
                                                @endif
                                                <th>Tgl. Semai</th>
                                                <th>Tgl. Tanam</th>
                                            @endif
                                        @endif
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($lahans as $lahan)
                                        <tr>
                                            <td>{{ $lahan->no_blok }}</td>
                                            @if (auth()->user()->role == 'qc' or auth()->user()->role == 'produksi')
                                                @if (isset($regis_lpg) or auth()->user()->role == 'produksi')
                                                    <td>{{ $lahan->alamat }}</td>
                                                @else
                                                    <td>{{ $lahan->lapang }}</td>
                                                @endif
                                                @if (isset($pmt))
                                                    <td
                                                        class="text-lg {{ $lahan->tg_pendahuluan ? 'text-info' : '' }}">
                                                        @if ($lahan->tg_pendahuluan)
                                                            <i class="align-middle mr-2 fas fa-fw fa-check-circle"></i>
                                                        @else
                                                            <i class="align-middle mr-2 fas fa-fw fa-clock"></i>
                                                        @endif
                                                    </td>
                                                    <td class="text-lg {{ $lahan->tg_pl1 ? 'text-info' : '' }}">
                                                        @if ($lahan->tg_pl1)
                                                            <i class="align-middle mr-2 fas fa-fw fa-check-circle"></i>
                                                        @else
                                                            <i class="align-middle mr-2 fas fa-fw fa-clock"></i>
                                                        @endif
                                                    </td>
                                                    <td class="text-lg {{ $lahan->tg_pl2 ? 'text-info' : '' }}">
                                                        @if ($lahan->tg_pl2)
                                                            <i class="align-middle mr-2 fas fa-fw fa-check-circle"></i>
                                                        @else
                                                            <i class="align-middle mr-2 fas fa-fw fa-clock"></i>
                                                        @endif
                                                    </td>
                                                    <td class="text-lg {{ $lahan->tg_pl3 ? 'text-info' : '' }}">
                                                        @if ($lahan->tg_pl3)
                                                            <i class="align-middle mr-2 fas fa-fw fa-check-circle"></i>
                                                        @else
                                                            <i class="align-middle mr-2 fas fa-fw fa-clock"></i>
                                                        @endif
                                                    </td>
                                                @elseif (isset($pn))
                                                    <th>{{ \Carbon\Carbon::parse($lahan->panen)->format('d/m/Y') }}
                                                    </th>
                                                    <th>{{ $lahan->luas_akhir . ' (ha)' }}</th>
                                                    <th>{{ number_format($lahan->taksasi, 0, '.', ','). ' (Kg)' }}</th>
                                                    <th>{{ number_format($lahan->tonase, 0, '.', ','). ' (Kg)' }}</th>
                                                @else
                                                    @if (!isset($inppn))
                                                        <td>{{ $lahan->nama }}</td>
                                                    @else
                                                        <td>{{ $lahan->kb }}</td>
                                                    @endif
                                                    <td>{{ $lahan->varietas }}</td>
                                                    <td>{{ $lahan->luas . ' ha' }}</td>
                                                    @if (isset($inppn))
                                                        <td>{{ $lahan->luas_akhir . ' ha' }}</td>
                                                    @endif
                                                    <td>{{ \Carbon\Carbon::parse($lahan->semai)->format('d/m/Y') }}
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($lahan->tanam)->format('d/m/Y') }}
                                                    </td>
                                                @endif
                                            @endif
                                            <td>

                                                @if (auth()->user()->role == 'qc')
                                                    @if (isset($regis_lpg) or isset($lpg))
                                                        <a href="#collapseOne" data-toggle="collapse"
                                                            data-target="#collapseOne" class="accr-detail text-info"
                                                            aria-expanded="true" aria-controls="collapseOne"
                                                            data-lapang="{{ $lahan->lapang }}"
                                                            data-blok_lahan="{{ $lahan->no_blok }}"
                                                            data-s="{{ $lahan->id }}">
                                                            <i class="align-middle mr-2 far fa-fw fa-edit"></i>
                                                        </a>
                                                    @elseif (isset($inppn))
                                                        <a href="{{ route('form panen', ['s' => $lahan->id]) }}"
                                                            class="text-info">
                                                            <i class="align-middle mr-2 far fa-fw fa-edit"></i>
                                                        </a>
                                                    @else
                                                        @if (isset($pmt))
                                                            {{-- <a href="#detailahan" data-toggle="modal"
                                                                class="go-detail text-info"
                                                                data-blok_lahan="{{ $lahan->no_blok }}">
                                                                <i class="align-middle fas fa-fw fa-eye"></i></a> --}}
                                                        @endif
                                                        @if (isset($pmt) or isset($inppmt))
                                                            <a href="{{ route('form pemantauan lapang', ['s' => $lahan->id]) }}"
                                                                class="text-info">
                                                                <i class="align-middle mr-2 far fa-fw fa-edit"></i>
                                                            </a>
                                                        @endif
                                                    @endif
                                                @elseif (auth()->user()->role == 'produksi')
                                                    <a href="#detailahan" data-toggle="modal"
                                                        class="go-detail text-info"
                                                        data-blok_lahan="{{ $lahan->no_blok }}">
                                                        <i class="align-middle fas fa-fw fa-eye"></i></a>
                                                    <a href="#detailahan" data-toggle="modal" class="go-del text-danger"
                                                        data-blok_lahan="{{ $lahan->no_blok }}"
                                                        data-blok="{{ $lahan->id }}"
                                                        data-action="{{ route('delete regis lahan', ['s' => '__ID__']) }}">
                                                        <i class="align-middle fas fa-fw fa-trash"></i></a>
                                                @else
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger p-1">
                                            @if (auth()->user()->role == 'qc')
                                                @if (isset($regis_lpg))
                                                    Belum ada Lahan yang bisa diregistrasi nomor lapang
                                                @elseif (isset($inppmt))
                                                    Belum ada Lahan yang bisa diinput pemantauan
                                                @elseif (isset($inppn))
                                                    Belum ada Lahan yang bisa diinput panen
                                                @elseif (isset($pn))
                                                    Belum ada Lahan yang dipanen
                                                @elseif (isset($pmt))
                                                    Belum ada Lahan yang dipantau
                                                @else
                                                @endif
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
                @if (auth()->user()->role == 'qc' && isset($regis_lpg) or isset($lpg))
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="card-title my-2" id="title_blok">
                                Input / Perbarui Nomor Lapang
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse @error('lapang') show @enderror"
                            aria-labelledby="headingOne" data-parent="#accordionExample">
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
                                                placeholder="No. Lapang..." value="{{ old('lapang') }}"
                                                id="lapang" name="lapang" style="width: 80%">
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
        <script></script>
        @if (auth()->user()->role == 'qc')
            <script src="{{ asset('js/regis_lapang.js') }}"></script>
        @else
            <script src="{{ asset('js/lahan.js') }}"></script>
        @endif
    @endpush
</x-layout>
