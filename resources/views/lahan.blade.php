<x-layout>
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
                    <h6 class="card-subtitle text-muted">Daftar data lahan yang telah terregistrsi</h6>
                </div>
                <div class="card-body">
                    <table id="lahan" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nomor Blok</th>
                                <th>Nama Pemilik</th>
                                <th>Lokasi Lahan</th>
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
                                    <td>{{ $lahan->lokasi }}</td>
                                    <td>{{ $lahan->luas . ' ha' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($lahan->semai)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($lahan->tanam)->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="#detailahan" data-toggle="modal" class="go-detail text-info"
                                            data-blok_lahan="{{ $lahan->no_blok }}">
                                            <i class="align-middle fas fa-fw fa-eye"></i></a>
                                        <a href="" class="go-del text-danger"><i
                                                class="align-middle fas fa-fw fa-trash"></i></a>
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
    <script src="{{ asset('js/lahan.js') }}"></script>

    @endpush
</x-layout>
