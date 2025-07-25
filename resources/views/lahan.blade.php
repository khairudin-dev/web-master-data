<x-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:head_link>
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        @if (auth()->user()->role == 'produksi' or auth()->user()->role == 'superadmin')
            @if (isset($lhn))
                <li class="breadcrumb-item active" aria-current="page">Lahan</li>
            @endif
            @if (isset($inppn))
                <li class="breadcrumb-item"><a href="{{ route('panen') }}">Panen</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
            @endif
            @if (isset($pn))
                <li class="breadcrumb-item active" aria-current="page">Panen</li>
            @endif
        @endif
        @if (auth()->user()->role == 'procesing' or auth()->user()->role == 'superadmin')
            @if (isset($inpprs))
                <li class="breadcrumb-item"><a href="{{ route('panen') }}">Prosesing</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
            @endif
            @if (isset($prs))
                <li class="breadcrumb-item active" aria-current="page">Prosesing</li>
            @endif
            @if (isset($inpspl))
                <li class="breadcrumb-item"><a href="{{ route('sampel') }}">Permohonan Sampel</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
            @endif
            @if (isset($spl))
                <li class="breadcrumb-item active" aria-current="page">Permohonan Sampel</li>
            @endif
        @endif
        @if (auth()->user()->role == 'qc' or auth()->user()->role == 'superadmin')
            @if (isset($regis_lpg))
                <li class="breadcrumb-item"><a href="{{ route('lapang') }}">Lapang</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
            @endif
            @if (isset($lpg))
                <li class="breadcrumb-item active" aria-current="page">Lapang</li>
            @endif
            @if (isset($inppmt))
                <li class="breadcrumb-item"><a href="{{ route('pemantauan lapang') }}">Pemantauan</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
            @endif
            @if (isset($pmt))
                <li class="breadcrumb-item active" aria-current="page">Pemantauan</li>
            @endif
            {{-- @if (isset($inppn))
                <li class="breadcrumb-item"><a href="{{ route('panen') }}">Panen</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
            @endif
            @if (isset($pn))
                <li class="breadcrumb-item active" aria-current="page">Panen</li>
            @endif --}}
        @endif
        @if (auth()->user()->role == 'analis' or auth()->user()->role == 'superadmin')
            @if (isset($inplab))
                <li class="breadcrumb-item"><a href="{{ route('lab') }}">Uji Laboratrorium</a></li>
                <li class="breadcrumb-item active" aria-current="page">Input Hasil Uji</li>
            @endif
            @if (isset($lab))
                <li class="breadcrumb-item active" aria-current="page">Uji Laboratrorium</li>
            @endif
        @endif
        @if (auth()->user()->role == 'marketing' or auth()->user()->role == 'superadmin')
            @if (isset($mkt))
                <li class="breadcrumb-item active" aria-current="page">Data Distribusi</li>
            @endif
            @if (isset($inpmkt))
                <li class="breadcrumb-item"><a href="{{ route('mkt') }}">Data Distribusi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Input Data Distribusi</li>
            @endif
        @endif

        {{-- @if (auth()->user()->role == 'qc' or auth()->user()->role == 'superadmin')
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
        @elseif (auth()->user()->role == 'analis' or auth()->user()->role == 'superadmin' && isset($inplab))
            <li class="breadcrumb-item"><a href="{{ route('lab') }}">Uji Laboratrorium</a></li>
            <li class="breadcrumb-item active" aria-current="page">Input Hasil Uji</li>
        @elseif (auth()->user()->role == 'marketing' or auth()->user()->role == 'superadmin')
            @if (isset($mkt))
                <li class="breadcrumb-item active" aria-current="page">Data Distribusi</li>
            @else
                <li class="breadcrumb-item"><a href="{{ route('mkt') }}">Data Distribusi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Input Data Distribusi</li>
            @endif
        @else
            @if (auth()->user()->role == 'analis' or auth()->user()->role == 'superadmin')
                <li class="breadcrumb-item active" aria-current="page">Uji Laboratrorium</li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">Lahan</li>
        @endif --}}

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

                                Daftar Lahan Penangkaran
                            </a>
                        </h5>
                        @if (auth()->user()->role == 'produksi' or auth()->user()->role == 'superadmin')
                            @if (isset($lhn))
                                <h6 class="card-subtitle text-muted">Daftar data lahan penangkaran yang telah terdaftar
                                </h6>
                            @endif
                            @if (isset($inppn) or isset($pmt))
                                <h6 class="card-subtitle text-muted">Daftar data lahan yang telah dilakukan pemeriksaan
                                    Fase Masak
                                </h6>
                            @endif
                            @if (isset($pn))
                                <h6 class="card-subtitle text-muted">Daftar data lahan yang telah dipanen
                                </h6>
                            @endif

                        @endif
                        @if (auth()->user()->role == 'qc' or auth()->user()->role == 'superadmin')
                            @if (isset($regis_lpg))
                                <h6 class="card-subtitle text-muted">Daftar data lahan yang belum terdaftar nomor
                                    lapangan
                                </h6>
                            @endif
                            @if (isset($lpg) or isset($inppmt))
                                <h6 class="card-subtitle text-muted">Daftar data lahan yang telah diregistrasi nomor
                                    lapangan
                                </h6>
                            @endif
                            @if (isset($inppn) or isset($pmt))
                                <h6 class="card-subtitle text-muted">Daftar data lahan yang telah dilakukan pemeriksaan
                                </h6>
                            @endif
                            {{-- @if (isset($pn))
                                <h6 class="card-subtitle text-muted">Daftar data lahan yang telah dipanen
                                </h6>
                            @endif --}}
                        @endif
                        @if (auth()->user()->role == 'analis' or auth()->user()->role == 'superadmin')
                            @if (isset($inplab))
                                <h6 class="card-subtitle text-muted">Daftar data lahan yang telah dipanen
                                </h6>
                            @endif
                            @if (isset($lab))
                                <h6 class="card-subtitle text-muted">Daftar data lahan yang telah diuji
                                </h6>
                            @endif
                        @endif
                        @if (auth()->user()->role == 'marketing' or auth()->user()->role == 'superadmin')
                            @if (isset($inpmkt))
                                <h6 class="card-subtitle text-muted">Daftar data lahan yang telah Uji Lab
                                </h6>
                            @endif
                            @if (isset($mkt))
                                <h6 class="card-subtitle text-muted">Daftar data distribusi hasil panen
                                </h6>
                            @endif
                        @endif
                        @if (auth()->user()->role == 'procesing' or auth()->user()->role == 'superadmin')
                            @if (isset($inpprs))
                                <h6 class="card-subtitle text-muted">Daftar data lahan telah panen
                                </h6>
                            @endif
                            @if (isset($prs))
                                <h6 class="card-subtitle text-muted">Daftar data hasil proses
                                </h6>
                            @endif
                            @if (isset($inpspl))
                                <h6 class="card-subtitle text-muted">Daftar data lahan telah diproses
                                </h6>
                            @endif
                            @if (isset($spl))
                                <h6 class="card-subtitle text-muted">Daftar data lahan telah pengajuan pengambilan
                                    sampel
                                </h6>
                            @endif
                        @endif

                        {{-- @if (auth()->user()->role == 'qc' or auth()->user()->role == 'superadmin')
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
                        @elseif (auth()->user()->role == 'analis' or auth()->user()->role == 'superadmin')
                            @if (isset($inplab))
                                <h6 class="card-subtitle text-muted">Daftar data lahan yang telah dipanen
                                </h6>
                            @else
                                <h6 class="card-subtitle text-muted">Daftar data lahan yang telah diuji
                                </h6>
                            @endif
                        @elseif (auth()->user()->role == 'marketing' or auth()->user()->role == 'superadmin')
                            @if (isset($inpmkt))
                                <h6 class="card-subtitle text-muted">Daftar data lahan yang telah Uji Lab
                                </h6>
                            @else
                                <h6 class="card-subtitle text-muted">Daftar data distribusi hasil panen
                                </h6>
                            @endif
                        @else
                            <h6 class="card-subtitle text-muted">Daftar data lahan yang telah terregistrsi</h6>
                        @endif --}}
                    </div>
                    <div id="collapseListData" class="collapse show" aria-labelledby="headingListData"
                        data-parent="#accordionExample">
                        <div class="card-body" style="overflow-x: auto;">
                            <table id="lahan" class="table table-striped display nowrap">
                                <thead>
                                    <tr>
                                        <th>Nomor Blok</th>
                                        @if (auth()->user()->role == 'produksi' or auth()->user()->role == 'superadmin')
                                            @if (isset($lhn))
                                                <th>Alamat Koordinator</th>
                                                <th>Nama Koordinator</th>
                                                <th>Varietas</th>
                                                <th>Luas</th>
                                                <th>Tgl. Semai</th>
                                                <th>Tgl. Tanam</th>
                                            @endif
                                            @if (isset($inppn))
                                                <th>No. Lapang</th>
                                                <th>Nama Koordinator</th>
                                                <th>Alamat Koordinator</th>
                                                <th>Kualitas Benih</th>
                                                <th>Varietas</th>
                                                <th>Luas</th>
                                                <th>Luas Akhie</th>
                                                <th>Taksasi</th>
                                                <th>Tgl. Semai</th>
                                                <th>Tgl. Tanam</th>
                                            @endif
                                            @if (isset($pn))
                                                <th>No. Lapang</th>
                                                <th>Nama Koordinator</th>
                                                <th>Alamat Koordinator</th>
                                                <th>Varietas</th>
                                                <th>Panen</th>
                                                <th>Luas Lulus</th>
                                                <th>Taksasi</th>
                                                <th>Tonase</th>
                                            @endif
                                        @endif
                                        @if (auth()->user()->role == 'qc' or auth()->user()->role == 'superadmin')
                                            @if (isset($regis_lpg))
                                                <th>Nama Koordinator</th>
                                                <th>Alamat Koordinator</th>
                                                <th>Varietas</th>
                                                <th>Luas</th>
                                                <th>Tgl. Semai</th>
                                                <th>Tgl. Tanam</th>
                                            @endif
                                            @if (isset($lpg))
                                                <th>No. Lapang</th>
                                                <th>Nama Koordinator</th>
                                                <th>Alamat Koordinator</th>
                                                <th>Varietas</th>
                                                <th>Luas</th>
                                                <th>Tgl. Semai</th>
                                                <th>Tgl. Tanam</th>
                                            @endif
                                            @if (isset($inppmt))
                                                <th>No. Lapang</th>
                                                <th>Nama Koordinator</th>
                                                <th>Alamat Koordinator</th>
                                                <th>Varietas</th>
                                                <th>Luas</th>
                                                <th>Tgl. Semai</th>
                                                <th>Tgl. Tanam</th>
                                            @endif
                                            @if (isset($pmt))
                                                <th>No. Lapang</th>
                                                <th>Nama Koordinator</th>
                                                <th>Alamat Koordinator</th>
                                                <th>Varietas</th>
                                                <th>Pendahuluan</th>
                                                <th>PL 1</th>
                                                <th>PL 2</th>
                                                <th>PL 3</th>
                                            @endif
                                            {{-- @if (isset($inppn))
                                                <th>No. Lapang</th>
                                                <th>Nama Koordinator</th>
                                                <th>Alamat Koordinator</th>
                                                <th>Kualitas Benih</th>
                                                <th>Varietas</th>
                                                <th>Luas</th>
                                                <th>Luas Akhie</th>
                                                <th>Tgl. Semai</th>
                                                <th>Tgl. Tanam</th>
                                            @endif
                                            @if (isset($pn))
                                                <th>No. Lapang</th>
                                                <th>Nama Koordinator</th>
                                                <th>Alamat Koordinator</th>
                                                <th>Varietas</th>
                                                <th>Panen</th>
                                                <th>Luas Lulus</th>
                                                <th>Taksasi</th>
                                                <th>Tonase</th>
                                            @endif --}}
                                        @endif
                                        @if (auth()->user()->role == 'analis' or auth()->user()->role == 'superadmin')
                                            @if (isset($inplab))
                                                <th>Nomor Lapang</th>
                                                <th>Panen</th>
                                                <th>Luas Lulus</th>
                                                <th>Taksasi</th>
                                                <th>Tonase</th>
                                            @endif
                                            @if (isset($lab))
                                                <th>Nomor Lapang</th>
                                                <th>Kadar Air</th>
                                                <th>Daya berKecambah</th>
                                                <th>Benih Murni</th>
                                                <th>Hasil Uji</th>
                                                <th>Tonase Sertifikat</th>
                                                <th>No. Sertifikat</th>
                                                <th>Tgl. Kadaluarsa</th>
                                                <th>QTY Label</th>
                                                <th>No. Seri</th>
                                            @endif
                                        @endif
                                        @if (auth()->user()->role == 'marketing' or auth()->user()->role == 'superadmin')
                                            @if (isset($mkt))
                                                <th>Nomor Lapang</th>
                                                <th>Varietas</th>
                                                <th>Stok</th>
                                                <th>Bantuan</th>
                                                <th>Tonase</th>
                                                <th>Free Market</th>
                                                <th>Tonase</th>
                                                <th>Penangkaran</th>
                                                <th>Tonase</th>
                                                <th>Stok</th>
                                            @endif
                                            @if (isset($inpmkt))
                                                <th>Nomor Lapang</th>
                                                <th>Varietas</th>
                                                <th>Tonase Sertifikat</th>
                                                <th>Stok</th>
                                                <th>Nomor Sertifikat</th>
                                                <th>Tgl. Kadaluarsa</th>
                                                <th>QTY Label</th>
                                                <th>No. Seri</th>
                                            @endif
                                        @endif
                                        @if (auth()->user()->role == 'procesing' or auth()->user()->role == 'superadmin')
                                            @if (isset($inpprs))
                                                <th>No. Lapang</th>
                                                <th>Varietas</th>
                                                <th>Panen</th>
                                                <th>Luas Lulus</th>
                                                <th>Taksasi</th>
                                                <th>Tonase</th>
                                            @endif
                                            @if (isset($prs))
                                                <th>No. Lapang</th>
                                                <th>Varietas</th>
                                                <th>Panen</th>
                                                <th>Luas Lulus</th>
                                                <th>Taksasi</th>
                                                <th>Tonase</th>
                                                <th>GKP</th>
                                                <th>CBB</th>
                                            @endif
                                            @if (isset($inpspl))
                                                <th>No. Lapang</th>
                                                <th>Varietas</th>
                                                <th>Panen</th>
                                                <th>Luas Lulus</th>
                                                <th>Taksasi</th>
                                                <th>Tonase</th>
                                                <th>GKP</th>
                                                <th>CBB</th>
                                            @endif
                                            @if (isset($spl))
                                                <th>No. Lapang</th>
                                                <th>Varietas</th>
                                                <th>Panen</th>
                                                <th>Luas Lulus</th>
                                                {{-- <th>Taksasi</th>
                                                <th>Tonase</th> --}}
                                                <th>GKP</th>
                                                <th>CBB</th>
                                                <th>Tgl. Permohonan</th>
                                                <th>Dokumen</th>
                                            @endif
                                        @endif
                                        @if (isset($bubes))
                                            <td>No. Lapang</td>
                                            <td>Varietas</td>
                                            <td>Kelas Benih</td>
                                            <td>Lokasi</td>
                                            <td>Label Sumber</td>
                                            <td>Tgl. Semai</td>
                                            <td>Tgl. Tanam</td>
                                            <td>Luas</td>
                                            <td>Pendahuluan</td>
                                            <td>PL 1</td>
                                            <td>PL 2</td>
                                            <td>PL 3</td>
                                            <td>Panen</td>
                                            <td>LULUS</td>
                                            <td>Taksasi</td>
                                            <td>Tonase</td>
                                            <td>Umur Padi</td>
                                            <td>GKP</td>
                                            <td>CBB</td>
                                            <td>Tgl. Prngambilan</td>
                                            <td>Tgl. Selesai</td>
                                            <td>KA</td>
                                            <td>Daya Berkecambah</td>
                                            <td>Hasil Uji</td>
                                            <td>Tonase Sertif</td>
                                            <td>No. Sertif</td>
                                            <td>Tgl. Kadaluarsa<td>
                                            <td>QTY Label<td>
                                            <td>No. Sersi<td>
                                            <td>D. Bantuan<td>
                                            <td>Tonase<td>
                                            <td>Free Market<td>
                                            <td>Tonase<td>
                                            <td>Penangkaran<td>
                                            <td>Tonase<td>
                                        @endif

                                        {{-- @if (auth()->user()->role == 'qc' or auth()->user()->role == 'produksi' or auth()->user()->role == 'superadmin')

                                            @if (isset($regis_lpg) or auth()->user()->role == 'produksi')
                                                <th>Alamat Koordinator</th>
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
                                                    <th>Nama Koordinator</th>
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
                                        @elseif (auth()->user()->role == 'analis' or auth()->user()->role == 'superadmin')
                                            <th>Nomor Lapang</th>
                                            @if (isset($inplab))
                                                <th>Panen</th>
                                                <th>Luas Lulus</th>
                                                <th>Taksasi</th>
                                                <th>Tonase</th>
                                            @else
                                                <th>K A</th>
                                                <th>D K</th>
                                                <th>Mutu</th>
                                                <th>T Sertif</th>
                                                <th>No. Sertifikat</th>
                                                <th>Kdl</th>
                                                <th>QTY Label</th>
                                                <th>No. Seri</th>
                                            @endif
                                        @elseif (auth()->user()->role == 'marketing' or auth()->user()->role == 'superadmin')
                                            <th>Nomor Lapang</th>
                                            @if (@isset($mkt))
                                                <th>Bantuan</th>
                                                <th>Tonase</th>
                                                <th>Free Market</th>
                                                <th>Tonase</th>
                                                <th>Penangkaran</th>
                                                <th>Tonase</th>
                                                <th>Stok</th>
                                            @else
                                                <th>Tonase Sertifikat</th>
                                                <th>Nomor Sertifikat</th>
                                                <th>Tgl. Kadaluarsa</th>
                                                <th>QTY Label</th>
                                                <th>No. Seri</th>
                                            @endif
                                        @else
                                        @endif --}}
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($lahans as $lahan)
                                        <tr>
                                            <td>{{ $lahan->no_blok }}</td>
                                            @if (auth()->user()->role == 'produksi' or auth()->user()->role == 'superadmin')
                                                @if (isset($lhn))
                                                    <td>{{ '..., Kec. ' . $lahan->alamat_parts[2] . ' ' . $lahan->alamat_parts[3] }}
                                                    </td>
                                                    <td>{{ $lahan->nama }}</td>
                                                    <td>{{ $lahan->varietas }}</td>
                                                    <td>{{ $lahan->luas . ' ha' }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($lahan->semai)->format('d/m/Y') }}
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($lahan->tanam)->format('d/m/Y') }}
                                                    </td>
                                                    <td>
                                                        <a href="#detailahan" data-toggle="modal"
                                                            class="go-detail text-info"
                                                            data-blok_lahan="{{ $lahan->no_blok }}">
                                                            <i class="align-middle fas fa-fw fa-eye"></i></a>
                                                        <a href="#detailahan" data-toggle="modal"
                                                            class="go-del text-danger"
                                                            data-blok_lahan="{{ $lahan->no_blok }}"
                                                            data-blok="{{ $lahan->id }}"
                                                            data-action="{{ route('delete regis lahan', ['s' => '__ID__']) }}">
                                                            <i class="align-middle fas fa-fw fa-trash"></i></a>
                                                    </td>
                                                @endif
                                                @if (isset($inppn))
                                                    <th>{{ $lahan->lapang }}</th>
                                                    <th>{{ $lahan->nama }}</th>
                                                    <td>{{ '..., Kec. ' . $lahan->alamat_parts[2] . ' ' . $lahan->alamat_parts[3] }}
                                                    <th>{{ $lahan->kb }}</th>
                                                    <th>{{ $lahan->varietas }}</th>
                                                    <th>{{ $lahan->luas . ' ha' }}</th>
                                                    <th>{{ $lahan->luas_akhir . ' ha' }}</th>
                                                    <th>{{ $lahan->taksasi . ' Kg' }}</th>
                                                    <td>{{ \Carbon\Carbon::parse($lahan->semai)->format('d/m/Y') }}
                                                    <td>{{ \Carbon\Carbon::parse($lahan->tanam)->format('d/m/Y') }}
                                                    <td>
                                                        <a href="{{ route('form panen', ['s' => $lahan->id]) }}"
                                                            class="text-info">
                                                            <i class="align-middle mr-2 far fa-fw fa-edit"></i>
                                                        </a>
                                                    </td>
                                                @endif
                                                @if (isset($pn))
                                                    <th>{{ $lahan->lapang }}</th>
                                                    <th>{{ $lahan->nama }}</th>
                                                    <td>{{ '..., Kec. ' . $lahan->alamat_parts[2] . ' ' . $lahan->alamat_parts[3] }}
                                                    <th>{{ $lahan->varietas }}</th>
                                                    <td>{{ \Carbon\Carbon::parse($lahan->panen)->format('d/m/Y') }}
                                                    <th>{{ $lahan->lulus . ' ha' }}</th>
                                                    <th>{{ $lahan->tonase . ' Kg' }}</th>
                                                    <th>{{ $lahan->taksasi . ' Kg' }}</th>
                                                    <td>
                                                        <a href="{{ route('form panen', ['s' => $lahan->id]) }}"
                                                            class="text-info">
                                                            <i class="align-middle mr-2 far fa-fw fa-edit"></i>
                                                        </a>
                                                    </td>
                                                @endif
                                            @endif
                                            @if (auth()->user()->role == 'qc' or auth()->user()->role == 'superadmin')
                                                @if (isset($regis_lpg))
                                                    <th>{{ $lahan->nama }}</th>
                                                    <td>{{ '..., Kec. ' . $lahan->alamat_parts[2] . ' ' . $lahan->alamat_parts[3] }}
                                                    </td>
                                                    <th>{{ $lahan->varietas }}</th>
                                                    <th>{{ $lahan->luas . ' ha' }}</th>
                                                    <td>{{ \Carbon\Carbon::parse($lahan->semai)->format('d/m/Y') }}
                                                    <td>{{ \Carbon\Carbon::parse($lahan->tanam)->format('d/m/Y') }}
                                                    <th>
                                                        <a href="#collapseOne" data-toggle="collapse"
                                                            data-target="#collapseOne" class="accr-detail text-info"
                                                            aria-expanded="true" aria-controls="collapseOne"
                                                            data-lapang="{{ $lahan->lapang }}"
                                                            data-blok_lahan="{{ $lahan->no_blok }}"
                                                            data-s="{{ $lahan->id }}">
                                                            <i class="align-middle mr-2 far fa-fw fa-edit"></i>
                                                        </a>
                                                    </th>
                                                @endif
                                                @if (isset($lpg))
                                                    <th>{{ $lahan->lapang }}</th>
                                                    <th>{{ $lahan->nama }}</th>
                                                    <td>{{ '..., Kec. ' . $lahan->alamat_parts[2] . ' ' . $lahan->alamat_parts[3] }}
                                                    </td>
                                                    <th>{{ $lahan->varietas }}</th>
                                                    <th>{{ $lahan->luas . ' ha' }}</th>
                                                    <td>{{ \Carbon\Carbon::parse($lahan->semai)->format('d/m/Y') }}
                                                    <td>{{ \Carbon\Carbon::parse($lahan->tanam)->format('d/m/Y') }}
                                                    <th>
                                                        <a href="#detailahan" data-toggle="modal"
                                                            class="go-detail text-secondary"
                                                            data-blok_lahan="{{ $lahan->no_blok }}">
                                                            <i class="align-middle fas fa-fw fa-eye"></i></a>
                                                        <a href="#collapseOne" data-toggle="collapse"
                                                            data-target="#collapseOne" class="accr-detail text-info"
                                                            aria-expanded="true" aria-controls="collapseOne"
                                                            data-lapang="{{ $lahan->lapang }}"
                                                            data-blok_lahan="{{ $lahan->no_blok }}"
                                                            data-s="{{ $lahan->id }}">
                                                            <i class="align-middle mr-2 far fa-fw fa-edit"></i>
                                                        </a>
                                                    </th>
                                                @endif
                                                @if (isset($inppmt))
                                                    <th>{{ $lahan->lapang }}</th>
                                                    <th>{{ $lahan->nama }}</th>
                                                    <td>{{ '..., Kec. ' . $lahan->alamat_parts[2] . ' ' . $lahan->alamat_parts[3] }}
                                                    </td>
                                                    <th>{{ $lahan->varietas }}</th>
                                                    <th>{{ $lahan->luas . ' ha' }}</th>
                                                    <td>{{ \Carbon\Carbon::parse($lahan->semai)->format('d/m/Y') }}
                                                    <td>{{ \Carbon\Carbon::parse($lahan->tanam)->format('d/m/Y') }}
                                                    <th>
                                                        <a href="{{ route('form pemantauan lapang', ['s' => $lahan->id]) }}"
                                                            class="text-info">
                                                            <i class="align-middle mr-2 far fa-fw fa-edit"></i>
                                                        </a>
                                                    </th>
                                                @endif
                                                @if (isset($pmt))
                                                    <th>{{ $lahan->lapang }}</th>
                                                    <th>{{ $lahan->nama }}</th>
                                                    <td>{{ '..., Kec. ' . $lahan->alamat_parts[2] . ' ' . $lahan->alamat_parts[3] }}
                                                    </td>
                                                    <th>{{ $lahan->varietas }}</th>
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
                                                    <td>
                                                        {{-- <a href="#detailahan" data-toggle="modal"
                                                                class="go-detail text-info"
                                                                data-blok_lahan="{{ $lahan->no_blok }}">
                                                                <i class="align-middle fas fa-fw fa-eye"></i></a> --}}
                                                        <a href="{{ route('form pemantauan lapang', ['s' => $lahan->id]) }}"
                                                            class="text-info">
                                                            <i class="align-middle mr-2 far fa-fw fa-edit"></i>
                                                        </a>
                                                    </td>
                                                @endif
                                                {{-- @if (isset($inppn))
                                                    <th>{{ $lahan->lapang }}</th>
                                                    <th>{{ $lahan->nama }}</th>
                                                    <td>{{ '..., Kec. ' . $lahan->alamat_parts[2] . ' ' . $lahan->alamat_parts[3] }}
                                                    <th>{{ $lahan->kb }}</th>
                                                    <th>{{ $lahan->varietas }}</th>
                                                    <th>{{ $lahan->luas . ' ha' }}</th>
                                                    <th>{{ $lahan->luas_akhir . ' ha' }}</th>
                                                    <td>{{ \Carbon\Carbon::parse($lahan->semai)->format('d/m/Y') }}
                                                    <td>{{ \Carbon\Carbon::parse($lahan->tanam)->format('d/m/Y') }}
                                                    <td>
                                                        <a href="{{ route('form panen', ['s' => $lahan->id]) }}"
                                                            class="text-info">
                                                            <i class="align-middle mr-2 far fa-fw fa-edit"></i>
                                                        </a>
                                                    </td>
                                                @endif
                                                @if (isset($pn))
                                                    <th>{{ $lahan->lapang }}</th>
                                                    <th>{{ $lahan->nama }}</th>
                                                    <td>{{ '..., Kec. ' . $lahan->alamat_parts[2] . ' ' . $lahan->alamat_parts[3] }}
                                                    <th>{{ $lahan->varietas }}</th>
                                                    <td>{{ \Carbon\Carbon::parse($lahan->panen)->format('d/m/Y') }}
                                                    <th>{{ $lahan->lulus . ' ha' }}</th>
                                                    <th>{{ $lahan->tonase . ' Kg' }}</th>
                                                    <th>{{ $lahan->taksasi . ' Kg' }}</th>
                                                    <td>
                                                        <a href="{{ route('form panen', ['s' => $lahan->id]) }}"
                                                            class="text-info">
                                                            <i class="align-middle mr-2 far fa-fw fa-edit"></i>
                                                        </a>
                                                    </td>
                                                @endif --}}
                                            @endif
                                            @if (auth()->user()->role == 'analis' or auth()->user()->role == 'superadmin')
                                                @if (isset($inplab))
                                                    <td>{{ $lahan->lapang }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($lahan->panen)->format('d/m/Y') }}
                                                    <td>{{ $lahan->lulus . ' ha' }}</td>
                                                    <td>{{ $lahan->taksasi . ' Kg' }}</td>
                                                    <td>{{ $lahan->tonase . ' Kg' }}</td>
                                                    <td>
                                                        <a href="{{ route('form uji lab', ['s' => $lahan->id]) }}"
                                                            class="text-info">
                                                            <i class="align-middle mr-2 far fa-fw fa-edit"></i>
                                                        </a>
                                                    </td>
                                                @endif
                                                @if (isset($lab))
                                                    <td>{{ $lahan->lapang }}</td>
                                                    <td>{{ $lahan->ka }}</td>
                                                    <td>{{ $lahan->kecambah }}</td>
                                                    <td>{{ $lahan->bm }}</td>
                                                    <td>{{ $lahan->mutu == 1 ? 'Lulus' : 'Tidak' }}</td>
                                                    <td>{{ $lahan->tonase_sertifikat . ' Kg' }}</td>
                                                    <td>{{ $lahan->no_sertifikat }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($lahan->tg_kadaluarsa)->format('d/m/Y') }}
                                                    <td>{{ $lahan->label }}</td>
                                                    <td>{{ $lahan->seri_label }}</td>
                                                    <td>
                                                        <a href="{{ route('form uji lab', ['s' => $lahan->id]) }}"
                                                            class="text-info">
                                                            <i class="align-middle mr-2 far fa-fw fa-edit"></i>
                                                        </a>
                                                    </td>
                                                @endif
                                            @endif
                                            @if (auth()->user()->role == 'marketing' or auth()->user()->role == 'superadmin')
                                                @if (isset($mkt))
                                                    <td>{{ $lahan->lapang }}</td>
                                                    <td>{{ $lahan->varietas }}</td>
                                                    <td>{{ $lahan->stok . ' Kg' }}</td>
                                                    <td>{{ $lahan->bantuan }}</td>
                                                    <td>{{ $lahan->t_bantuan . ' Kg' }}</td>
                                                    <td>{{ $lahan->market }}</td>
                                                    <td>{{ $lahan->t_market . ' Kg' }}</td>
                                                    <td>{{ $lahan->penangkaran }}</td>
                                                    <td>{{ $lahan->t_penangkaran . ' Kg' }}</td>
                                                    <td>{{ $lahan->stok }}</td>
                                                    <td>
                                                        <a href="{{ route('form marketing', ['s' => $lahan->id]) }}"
                                                            class="text-info">
                                                            <i class="align-middle mr-2 far fa-fw fa-edit"></i>
                                                        </a>
                                                    </td>
                                                @endif
                                                @if (isset($inpmkt))
                                                    <td>{{ $lahan->lapang }}</td>
                                                    <td>{{ $lahan->varietas }}</td>
                                                    <td>{{ $lahan->tonase_sertifikat . ' Kg' }}</td>
                                                    <td>{{ $lahan->stok . ' Kg' }}</td>
                                                    <td>{{ $lahan->no_sertifikat }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($lahan->tg_kadaluarsa)->format('d/m/Y') }}
                                                    <td>{{ $lahan->label }}</td>
                                                    <td>{{ $lahan->seri_label }}</td>
                                                    <td>
                                                        <a href="{{ route('form marketing', ['s' => $lahan->id]) }}"
                                                            class="text-info">
                                                            <i class="align-middle mr-2 far fa-fw fa-edit"></i>
                                                        </a>
                                                    </td>
                                                @endif
                                            @endif
                                            @if (auth()->user()->role == 'procesing' or auth()->user()->role == 'superadmin')
                                                @if (isset($inpprs))
                                                    <th>{{ $lahan->lapang }}</th>
                                                    <th>{{ $lahan->varietas }}</th>
                                                    <th>{{ \Carbon\Carbon::parse($lahan->panen)->format('d/m/Y') }}
                                                    </th>
                                                    <th>{{ $lahan->luas_akhir . ' ha' }}</th>
                                                    <th>{{ $lahan->taksasi . ' Kg' }}</th>
                                                    <th>{{ $lahan->tonase . ' Kg' }}</th>
                                                    <th>
                                                        <a href="#collapseOne" data-toggle="collapse"
                                                            data-target="#collapseOne" class="accr-detail text-info"
                                                            aria-expanded="true" aria-controls="collapseOne"
                                                            data-lapang="{{ $lahan->lapang }}"
                                                            data-blok_lahan="{{ $lahan->no_blok }}"
                                                            data-s="{{ $lahan->id }}"
                                                            data-l="{{ $lahan }}">
                                                            <i class="align-middle mr-2 far fa-fw fa-edit"></i>
                                                        </a>
                                                    </th>
                                                @endif
                                                @if (isset($prs))
                                                    <th>{{ $lahan->lapang }}</th>
                                                    <th>{{ $lahan->varietas }}</th>
                                                    <th>{{ \Carbon\Carbon::parse($lahan->panen)->format('d/m/Y') }}
                                                    </th>
                                                    <th>{{ $lahan->luas_akhir . ' ha' }}</th>
                                                    <th>{{ $lahan->taksasi . ' Kg' }}</th>
                                                    <th>{{ $lahan->tonase . ' Kg' }}</th>
                                                    <th>{{ $lahan->gkp . ' Kg' }}</th>
                                                    <th>{{ $lahan->cbb . ' Kg' }}</th>
                                                    <th>
                                                        <a href="#collapseOne" data-toggle="collapse"
                                                            data-target="#collapseOne" class="accr-detail text-info"
                                                            aria-expanded="true" aria-controls="collapseOne"
                                                            data-lapang="{{ $lahan->lapang }}"
                                                            data-blok_lahan="{{ $lahan->no_blok }}"
                                                            data-s="{{ $lahan->id }}"
                                                            data-l="{{ $lahan }}">
                                                            <i class="align-middle mr-2 far fa-fw fa-edit"></i>
                                                        </a>
                                                    </th>
                                                @endif
                                                @if (isset($inpspl))
                                                    <th>{{ $lahan->lapang }}</th>
                                                    <th>{{ $lahan->varietas }}</th>
                                                    <th>{{ \Carbon\Carbon::parse($lahan->panen)->format('d/m/Y') }}
                                                    </th>
                                                    <th>{{ $lahan->luas_akhir . ' ha' }}</th>
                                                    <th>{{ $lahan->taksasi . ' Kg' }}</th>
                                                    <th>{{ $lahan->tonase . ' Kg' }}</th>
                                                    <th>{{ $lahan->gkp . ' Kg' }}</th>
                                                    <th>{{ $lahan->cbb . ' Kg' }}</th>
                                                    <th>
                                                        <a href="#collapseOne" data-toggle="collapse"
                                                            data-target="#collapseOne" class="accr-inpspl text-info"
                                                            aria-expanded="true" aria-controls="collapseOne"
                                                            data-lapang="{{ $lahan->lapang }}"
                                                            data-blok_lahan="{{ $lahan->no_blok }}"
                                                            data-s="{{ $lahan->id }}"
                                                            data-l="{{ $lahan }}">
                                                            <i class="align-middle mr-2 far fa-fw fa-edit"></i>
                                                        </a>
                                                    </th>
                                                @endif
                                                @if (isset($spl))
                                                    <th>{{ $lahan->lapang }}</th>
                                                    <th>{{ $lahan->varietas }}</th>
                                                    <th>{{ \Carbon\Carbon::parse($lahan->panen)->format('d/m/Y') }}
                                                    </th>
                                                    <th>{{ $lahan->luas_akhir . ' ha' }}</th>
                                                    {{-- <th>{{ $lahan->taksasi . ' Kg' }}</th>
                                                    <th>{{ $lahan->tonase . ' Kg' }}</th> --}}
                                                    <th>{{ $lahan->gkp . ' Kg' }}</th>
                                                    <th>{{ $lahan->cbb . ' Kg' }}</th>
                                                    <th>{{ \Carbon\Carbon::parse($lahan->tg_p_spl)->format('d/m/Y') }}
                                                    </th>
                                                    <th>
                                                        <button type="button" id="btn-preview-doc"
                                                            class="btn btn-outline-info btn-sm" data-toggle="modal"
                                                            data-doc="{{ asset('/storage/ambil sampel/' . $lahan->p_spl ?? '') }}"
                                                            data-target="#modalPreviewFile">
                                                            <i class="align-middle fas fa-fw fa-eye"></i> Lihat File
                                                        </button>

                                                    </th>
                                                    <th>
                                                        <a href="#collapseOne" data-toggle="collapse"
                                                            data-target="#collapseOne" class="accr-inpspl text-info"
                                                            aria-expanded="true" aria-controls="collapseOne"
                                                            data-lapang="{{ $lahan->lapang }}"
                                                            data-blok_lahan="{{ $lahan->no_blok }}"
                                                            data-s="{{ $lahan->id }}"
                                                            data-l="{{ $lahan }}">
                                                            <i class="align-middle mr-2 far fa-fw fa-edit"></i>
                                                        </a>
                                                    </th>
                                                @endif
                                            @endif
                                            @if (isset($bubes))
                                                <td>{{ $lahan->lapang }}</td>
                                                <td>{{ $lahan->varietas }}</td>
                                                <td>{{ $lahan->kb }}</td>
                                                <td>{{ '..., Kec. ' . $lahan->alamat_parts[2] . ' ' . $lahan->alamat_parts[3] }}
                                                <td>{{ $lahan->label_sumber }}</td>
                                                <td>{{ $lahan->semai }}</td>
                                                <td>{{ $lahan->tanam }}</td>
                                                <td>{{ $lahan->luas . ' ha' }}</td>
                                                <td>{{ $lahan->tg_pendahuluan}}</td>
                                                <td>{{ $lahan->tg_pl1}}</td>
                                                <td>{{ $lahan->tg_pl2}}</td>
                                                <td>{{ $lahan->tg_pl3}}</td>
                                                <td>{{ $lahan->panen}}</td>
                                                <td>{{ $lahan->lulus. ' ha'}}</td>
                                                <td>{{ $lahan->taksasi. ' Kg'}}</td>
                                                <td>{{ $lahan->tonase. ' Kg'}}</td>
                                                <td>{{ $lahan->umur_padi." hari"}}</td>
                                                <td>{{ $lahan->gkp}}</td>
                                                <td>{{ $lahan->cbb}}</td>
                                                <td>{{ $lahan->tg_pengambilan}}</td>
                                                <td>{{ $lahan->tg_selesai}}</td>
                                                <td>{{ $lahan->ka}}</td>
                                                <td>{{ $lahan->kecambah}}</td>
                                                <td>{{ $lahan->mutu}}</td>
                                                <td>{{ $lahan->tonase_sertifikat}}</td>
                                                <td>{{ $lahan->no_sertifikat}}</td>
                                                <td>{{ $lahan->tg_kadaluarsa}}<td>
                                                <td>{{ $lahan->label}}<td>
                                                <td>{{ $lahan->seri_label}}<td>
                                                <td>{{ $lahan->bantuan}}<td>
                                                <td>{{ $lahan->t_bantuan}}<td>
                                                <td>{{ $lahan->market}}<td>
                                                <td>{{ $lahan->t_market}}<td>
                                                <td>{{ $lahan->penangkaran}}<td>
                                                <td>{{ $lahan->t_penangkaran}}<td>
                                                <td>
                                                    <a href="#"
                                                        class="text-info">
                                                        <i class="align-middle mr-2 far fa-fw fa-eye"></i>
                                                    </a>
                                                </td>
                                            @endif

                                            {{-- @if (auth()->user()->role == 'qc' or auth()->user()->role == 'produksi' or auth()->user()->role == 'superadmin')
                                                @if (isset($regis_lpg) or auth()->user()->role == 'produksi')
                                                    <td>{{ $lahan->alamat }}</td>
                                                @else
                                                    <td>{{ $lahan->lapang }}</td>
                                                @endif
                                                @if (isset($pmt))
                                                    <td class="text-lg {{ $lahan->tg_pendahuluan ? 'text-info' : '' }}">
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
                                                @elseif (isset($pn) or isset($inppr))
                                                    <th>{{ \Carbon\Carbon::parse($lahan->panen)->format('d/m/Y') }}
                                                    </th>
                                                    <th>{{ $lahan->luas_akhir . ' (ha)' }}</th>
                                                    <th>{{ number_format($lahan->taksasi, 0, ',', '.') . ' (Kg)' }}
                                                    </th>
                                                    <th>{{ number_format($lahan->tonase, 0, ',', '.') . ' (Kg)' }}</th>
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
                                            @elseif (auth()->user()->role == 'analis' or auth()->user()->role == 'superadmin')
                                                <th>{{ $lahan->lapang }}</th>
                                                @if (isset($inplab))
                                                    <th>{{ \Carbon\Carbon::parse($lahan->panen)->format('d/m/Y') }}
                                                    </th>
                                                    <th>{{ $lahan->lulus . ' (ha)' }}</th>
                                                    <th>{{ number_format($lahan->taksasi, 0, ',', '.') . ' (Kg)' }}
                                                    </th>
                                                    <th>{{ number_format($lahan->tonase, 0, ',', '.') . ' (Kg)' }}</th>
                                                @else
                                                    <th>{{ $lahan->ka }}</th>
                                                    <th>{{ $lahan->kecambah }}</th>
                                                    <th
                                                        class="text-lg {{ $lahan->mutu == 1 ? 'text-info' : 'text-danger' }}">
                                                        @if ($lahan->mutu == 1)
                                                            <i class="align-middle mr-2 fas fa-fw fa-check-circle"></i>
                                                        @else
                                                            <i class="align-middle mr-2 fas fa-fw fa-minus-circle"></i>
                                                        @endif

                                                    </th>
                                                    <th>{{ $lahan->tonase_sertifikat }}</th>
                                                    <th>{{ $lahan->no_sertifikat }}</th>
                                                    <th>{{ \Carbon\Carbon::parse($lahan->tg_kadaluarsa)->format('d/m/Y') }}
                                                    <th>{{ $lahan->label }}</th>
                                                    <th>{{ $lahan->seri_label }}</th>
                                                @endif
                                            @elseif (auth()->user()->role == 'marketing' or auth()->user()->role == 'superadmin')
                                                <th>{{ $lahan->lapang }}</th>
                                                @if (@isset($mkt))
                                                    <th>{{ $lahan->bantuan }}</th>
                                                    <th>{{ $lahan->t_bantuan . ' Kg' }}</th>
                                                    <th>{{ $lahan->market }}</th>
                                                    <th>{{ $lahan->t_market . ' Kg' }}</th>
                                                    <th>{{ $lahan->penangkaran }}</th>
                                                    <th>{{ $lahan->t_penangkaran . ' Kg' }}</th>
                                                    <th>{{ $lahan->stok . ' Kg' }}</th>
                                                @else
                                                    <th>{{ $lahan->tonase_sertifikat . ' Kg' }}</th>
                                                    <th>{{ $lahan->no_sertifikat }}</th>
                                                    <th>{{ \Carbon\Carbon::parse($lahan->tg_kadaluarsa)->format('d/m/Y') }}
                                                    <th>{{ $lahan->label }}</th>
                                                    <th>{{ $lahan->seri_label }}</th>
                                                @endif
                                            @else
                                            @endif --}}
                                            @if (isset($dor))
                                                <td>

                                                    @if (auth()->user()->role == 'qc' or auth()->user()->role == 'superadmin')
                                                        @if (isset($regis_lpg) or isset($lpg))
                                                            <a href="#collapseOne" data-toggle="collapse"
                                                                data-target="#collapseOne"
                                                                class="accr-detail text-info" aria-expanded="true"
                                                                aria-controls="collapseOne"
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
                                                    @elseif (auth()->user()->role == 'produksi' or auth()->user()->role == 'superadmin')
                                                        <a href="#detailahan" data-toggle="modal"
                                                            class="go-detail text-info"
                                                            data-blok_lahan="{{ $lahan->no_blok }}">
                                                            <i class="align-middle fas fa-fw fa-eye"></i></a>
                                                        <a href="#detailahan" data-toggle="modal"
                                                            class="go-del text-danger"
                                                            data-blok_lahan="{{ $lahan->no_blok }}"
                                                            data-blok="{{ $lahan->id }}"
                                                            data-action="{{ route('delete regis lahan', ['s' => '__ID__']) }}">
                                                            <i class="align-middle fas fa-fw fa-trash"></i></a>
                                                    @elseif (auth()->user()->role == 'analis' or auth()->user()->role == 'superadmin')
                                                        <a href="{{ route('form uji lab', ['s' => $lahan->id]) }}"
                                                            class="text-info">
                                                            <i class="align-middle mr-2 far fa-fw fa-edit"></i>
                                                        </a>
                                                    @elseif (auth()->user()->role == 'marketing' or auth()->user()->role == 'superadmin')
                                                        <a href="{{ route('form marketing', ['s' => $lahan->id]) }}"
                                                            class="text-info">
                                                            <i class="align-middle mr-2 far fa-fw fa-edit"></i>
                                                        </a>
                                                    @else
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger p-1">
                                            @if (auth()->user()->role == 'produksi' or auth()->user()->role == 'superadmin')
                                                @if (isset($lhn))
                                                    Belum ada Lahan yang diregistrasi
                                                @endif
                                                @if (isset($inppn))
                                                    Belum ada Lahan yang bisa diinput panen
                                                @endif
                                                @if (isset($pn))
                                                    Belum ada Lahan yang dipanen
                                                @endif
                                            @endif
                                            @if (auth()->user()->role == 'qc' or auth()->user()->role == 'superadmin')
                                                @if (isset($regis_lpg))
                                                    Belum ada Lahan yang bisa diregistrasi nomor lapang
                                                @endif
                                                @if (isset($inppmt))
                                                    Belum ada Lahan yang bisa diinput pemantauan
                                                @endif
                                                @if (isset($pmt))
                                                    Belum ada Lahan yang dipantau
                                                @endif
                                                {{-- @if (isset($inppn))
                                                    Belum ada Lahan yang bisa diinput panen
                                                @endif
                                                @if (isset($pn))
                                                    Belum ada Lahan yang dipanen
                                                @endif --}}
                                            @endif
                                            @if (auth()->user()->role == 'analis' or auth()->user()->role == 'superadmin')
                                                @if (isset($inplab))
                                                    Belum ada Lahan yang dipanen
                                                @endif
                                                @if (isset($lab))
                                                    Belum ada Lahan yang diuji
                                                @endif
                                            @endif
                                            @if (auth()->user()->role == 'marketing' or auth()->user()->role == 'superadmin')
                                                @if (isset($inpmkt))
                                                    Belum ada Lahan yang dipanen
                                                @endif
                                                @if (isset($mkt))
                                                    Belum ada Lahan yang diuji
                                                @endif
                                            @endif
                                            @if (auth()->user()->role == 'procesing' or auth()->user()->role == 'superadmin')
                                                @if (isset($inpprs))
                                                    Belum ada Lahan yang dipanen
                                                @endif
                                                @if (isset($prs))
                                                    Belum ada Lahan yang diproses
                                                @endif
                                                @if (isset($inpspl))
                                                    Belum ada Lahan yang diproses
                                                @endif
                                                @if (isset($spl))
                                                    Belum ada Lahan yang diajukan
                                                @endif
                                            @endif

                                            {{-- @if (auth()->user()->role == 'qc' or auth()->user()->role == 'superadmin')
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
                                            @endif --}}

                                        </div>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                        @if (isset($mkt))
                            <div class="card-footer">
                                <h6 class="card-subtitle"> <strong>Total stok yang tersedia : {{ $total }}
                                        Kg</strong>
                                </h6>
                            </div>
                        @endif
                    </div>
                </div>
                @if ((auth()->user()->role == 'qc' || auth()->user()->role == 'superadmin') && (isset($regis_lpg) || isset($lpg)))
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
                @if ((auth()->user()->role == 'procesing' || auth()->user()->role == 'superadmin') && (isset($inpprs) || isset($prs)))
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="card-title my-2" id="title_blok">
                                Data Proses
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse @error('lapang') show @enderror"
                            aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="m-sm-1 m-md-2">
                                            <div class="row mb-4">
                                                <div class="col-md-6">
                                                    <div class="text-muted">Nomor Blok</div>
                                                    <strong id="txt_blok"></strong>
                                                </div>
                                                <div class="col-md-6 text-md-right">
                                                    <div class="text-muted">Nomor Lapang</div>
                                                    <strong id="txt_lpg">
                                                    </strong>
                                                </div>
                                            </div>

                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Variabel</th>
                                                        <th>&nbsp;</th>
                                                        <th class="text-right">Nilai</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Luas lulus</td>
                                                        <td>:</td>
                                                        <td class="text-right" id="td_lulus"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Varietas</td>
                                                        <td>:</td>
                                                        <td class="text-right" id="td_varietas"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tanggal Panen</td>
                                                        <td>: </td>
                                                        <td class="text-right" id="td_panen">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Taksasi</td>
                                                        <td>:</td>
                                                        <td class="text-right" id="td_tk"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tonase</td>
                                                        <td>:</td>
                                                        <td class="text-right" id="td_tn"></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-6">
                                        <h5>Input Data Proses</h5>
                                        <form class="row" id="formProses" action="#" method="POST">
                                            @csrf
                                            @method('put')

                                            <div class="form-group col-md-6">
                                                <label for="gkp">GKP</label>
                                                <input type="number"
                                                    class="form-control @error('gkp') is-invalid @enderror"
                                                    value="{{ old('gkp', !empty($lahan->gkp) ? $lahan->gkp : '') }}"
                                                    id="gkp" name="gkp" placeholder="Input GKP...">
                                                @error('gkp')
                                                    <div class="jquery-validation-error small form-text invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="cbb">CBB</label>
                                                <input type="number"
                                                    class="form-control @error('cbb') is-invalid @enderror"
                                                    value="{{ old('cbb', !empty($lahan->cbb) ? $lahan->cbb : '') }}"
                                                    id="cbb" name="cbb" placeholder="Input CBB...">
                                                @error('cbb')
                                                    <div class="jquery-validation-error small form-text invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endif
                @if ((auth()->user()->role == 'procesing' || auth()->user()->role == 'superadmin') && (isset($inpspl) || isset($spl)))
                    <div class="card" style="overflow: visible;">
                        <div class="card-header" id="headingOne">
                            <h5 class="card-title my-2" id="title_blok">
                                Data Permohonan Pengambilan Sampel
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse @error('lapang') show @enderror"
                            aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="m-sm-1 m-md-2">
                                            <div class="row mb-4">
                                                <div class="col-md-6">
                                                    <div class="text-muted">Nomor Blok</div>
                                                    <strong id="txt_blok"></strong>
                                                </div>
                                                <div class="col-md-6 text-md-right">
                                                    <div class="text-muted">Nomor Lapang</div>
                                                    <strong id="txt_lpg">
                                                    </strong>
                                                </div>
                                            </div>

                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Variabel</th>
                                                        <th>&nbsp;</th>
                                                        <th class="text-right">Nilai</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Luas lulus</td>
                                                        <td>:</td>
                                                        <td class="text-right" id="td_lulus"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Varietas</td>
                                                        <td>:</td>
                                                        <td class="text-right" id="td_varietas"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tanggal Panen</td>
                                                        <td>: </td>
                                                        <td class="text-right" id="td_panen">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Taksasi</td>
                                                        <td>:</td>
                                                        <td class="text-right" id="td_tk"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tonase</td>
                                                        <td>:</td>
                                                        <td class="text-right" id="td_tn"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>FKP</td>
                                                        <td>:</td>
                                                        <td class="text-right" id="td_gkp"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>CBB</td>
                                                        <td>:</td>
                                                        <td class="text-right" id="td_cbb"></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-6">
                                        <h5>Input Data Permohonan Pengambilan Sampel</h5>
                                        <form class="row" id="formSampel" action="#" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('put')

                                            <div class="form-group col-md-6">
                                                <label for="sampel" class="form-label">Tanggal Permohonan</label>
                                                <div class="input-group date" id="datetimepicker-sampel"
                                                    data-target-input="nearest">
                                                    <input type="text"
                                                        class="form-control datetimepicker-input @error('sampel') is-invalid @enderror"
                                                        value="{{ old('sampel', isset($lahan->tg_p_spl) ? \Carbon\Carbon::parse($lahan->tg_p_spl)->format('d/m/Y') : '') }}"
                                                        data-toggle="datetimepicker"
                                                        data-target="#datetimepicker-sampel" id="sampel"
                                                        placeholder="masukkan tanggal permohonan..." name="sampel"
                                                        data-mask="00/00/0000" />
                                                    @error('sampel')
                                                        <div
                                                            class="jquery-validation-error small form-text invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                    <div class="input-group-append"
                                                        data-target="#datetimepicker-sampel"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="permohonan">Dokumen Permohonan</label>
                                                <input type="file" id="permohonan" name="permohonan"
                                                    class="form-control-file validation-file @error('permohonan') is-invalid @enderror"
                                                    value="{{ old('permohonan') }}"
                                                    accept="application/pdf, image/*">
                                                @error('permohonan')
                                                    <div class="jquery-validation-error small form-text invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <div class="text-center mb-4">
                                                    <iframe id="preview-pdf"
                                                        style="width: 100%; height: 500px; {{ empty($lahan->p_spl) ? 'display: none;' : '' }}"
                                                        frameborder="0"
                                                        @if (!empty($lahan->p_spl)) src="{{ asset('/storage/permohonan/' . $lahan->p_spl) }}" @endif></iframe>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal fade" id="modalPreviewFile" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header" id="header-body-detailahan">
                                    <h5 class="modal-title" id="title_blok">Preview Dokumen</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body m-3">
                                    <iframe id="iframePreviewFile" style="width: 100%; height: 500px;"
                                        frameborder="0"></iframe>
                                </div>
                                <div class="modal-footer"id="footer-body-detailahan">
                                    <button type="button" class="btn btn-outline-secondary"
                                        data-dismiss="modal">Tutup</button>
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
        @if (auth()->user()->role == 'produksi' or auth()->user()->role == 'superadmin' and isset($lhn))
            <script src="{{ asset('js/lahan.js') }}"></script>
        @endif
        @if (auth()->user()->role == 'qc' or auth()->user()->role == 'superadmin')
            @if (isset($regis_lpg) or isset($lpg) or isset($inppmt) or isset($pmt) or isset($inppn) or isset($pn))
                <script src="{{ asset('js/regis_lapang.js') }}"></script>
            @endif
        @endif
        @if (auth()->user()->role == 'procesing' or auth()->user()->role == 'superadmin')
            @if (isset($inpprs) or isset($prs) or isset($inpspl) or isset($spl))
                <script type="text/javascript" src="{{ asset('js/pdf-lib.min.js') }}"></script>
                <script>
                    const imgCheck = {{ empty($lahan->p_spl) ? 'true' : 'false' }};
                </script>
                <script src="{{ asset('js/proses.js') }}"></script>
            @endif
        @endif
        @if (auth()->user()->role == 'analis' or auth()->user()->role == 'superadmin')
            @if (isset($inplab) or isset($lab))
                <script src="{{ asset('js/analis.js') }}"></script>
            @endif
        @endif
        @if (auth()->user()->role == 'marketing' or auth()->user()->role == 'superadmin')
            @if (isset($mkt) or isset($inpmkt))
                <script src="{{ asset('js/marketing.js') }}"></script>
            @endif
        @endif
        @if (isset($bubes))
            <script src="{{ asset('js/bubes.js') }}"></script>
        @endif
        {{-- @if (auth()->user()->role == 'qc' or auth()->user()->role == 'superadmin')
            <script src="{{ asset('js/regis_lapang.js') }}"></script>
        @else
            <script src="{{ asset('js/lahan.js') }}"></script>
        @endif --}}
    @endpush
</x-layout>
