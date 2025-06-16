<x-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:head_link>
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Lahan</li>
    </x-slot:head_link>

    {{-- start content --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Daftar Lahan</h5>
                    @if (auth()->user()->role == 'qc')
                        <h6 class="card-subtitle text-muted">Daftar data lahan yang belum terregistrsi nomor lapang</h6>
                    @else
                        <h6 class="card-subtitle text-muted">Daftar data lahan yang telah terregistrsi</h6>
                    @endif
                </div>
                <div class="card-body">
                    <table id="lahan" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nomor Blok</th>
                                <th>Nama Pemilik</th>
                                <th>Varietas</th>
                                <th>Alamat Pemilik</th>
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
                                    <td>{{ $lahan->alamat }}</td>
                                    <td>{{ $lahan->luas . ' ha' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($lahan->semai)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($lahan->tanam)->format('d/m/Y') }}</td>
                                    <td>

                                        @if (auth()->user()->role == 'qc')
                                            <a href="#detailahan" data-toggle="modal" class="go-detail text-info"
                                                data-blok_lahan="{{ $lahan->no_blok }}">
                                                <i class="align-middle mr-2 far fa-fw fa-edit"></i></a>
                                        @endif

                                        @if (auth()->user()->role == 'produksi')
                                            <a href="#detailahan" data-toggle="modal" class="go-detail text-info"
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
                                    Belum ada Lahan yang diregistrasi
                                </div>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    {{-- end content --}}
    @push('sc')
        <script>
            const qcMode = {{ auth()->user()->role == 'qc' ? 'true' : 'false' }};
        </script>
        {{-- @if (auth()->user()->role == 'qc')
            <script src="{{ asset('js/regis_lapang.js') }}"></script>
        @endif --}}
        <script src="{{ asset('js/lahan.js') }}"></script>
        <script></script>
    @endpush
</x-layout>
