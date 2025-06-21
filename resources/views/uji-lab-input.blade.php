<x-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:head_link>
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('pemantauan lapang') }}">Uji Laboratorium </a></li>
        <li class="breadcrumb-item"><a href="{{ route('input uji lab') }}">Input Hasil Uji</a></li>
        <li class="breadcrumb-item active" aria-current="page">Input Hasil Uji Blok : {{ $lahan->no_blok }}</li>
    </x-slot:head_link>

    {{-- start content --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Input Data Hasil Uji Laboratorium</h5>
                    <h6 class="card-subtitle text-muted">Inputkan hasil uji laboratorium untuk Blok
                        {{ $lahan->no_blok }}</h6>
                </div>
                <div class="card-body">
                    {{-- seklias data --}}
                    <div class="m-sm-1 m-md-2">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="text-muted mb-2">Nomor Blok</div>
                                    </div>
                                    <div class="col-6 text-right">
                                        <strong>{{ $lahan->no_blok }}</strong>
                                    </div>
                                </div>
                                <table class="table table-sm">
                                    <tbody>
                                        <tr>
                                            <td>Varietas</td>
                                            <td>:</td>
                                            <td class="text-right">{{ $lahan->varietas }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kelas Benih</td>
                                            <td>:</td>
                                            <td class="text-right">{{ $lahan->kb }}</td>
                                        </tr>
                                        <tr>
                                            <td>Luas Akhir / Lahan Lulus</td>
                                            <td>:</td>
                                            <td class="text-right">{{ $lahan->luas_akhir . ' ha' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tgl. Panen;</td>
                                            <td>: </td>
                                            <td class="text-right">
                                                {{ \Carbon\Carbon::parse($lahan->panen)->format('d/m/Y') }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="text-muted mb-2">Nomor Lapang</div>
                                    </div>
                                    <div class="col-6 text-right">
                                        <strong>{{ $lahan->lapang }}</strong>
                                    </div>
                                </div>
                                <table class="table table-sm">
                                    <tbody>
                                        <tr>
                                            <td>Taksasi</td>
                                            <td>:</td>
                                            <td class="text-right">
                                                {{ number_format($lahan->taksasi, 0, ',', '.') . ' Kg' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tonase</td>
                                            <td>:</td>
                                            <td class="text-right">
                                                {{ number_format($lahan->tonase, 0, ',', '.') . ' Kg' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tonase Sertifikat</td>
                                            <td>:</td>
                                            <td class="text-right">
                                                {{ number_format($lahan->tonase, 0, ',', '.') . ' Kg' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Label</td>
                                            <td>:</td>
                                            <td class="text-right">{{ number_format($lahan->tonase / 5, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tgl. Kadaluarsa;</td>
                                            <td>: </td>
                                            <td class="text-right" id="kdl">
                                                --
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4 text-center">
                                <img id="preview-label" class=""
                                    style="max-height:220px; max-width: 100%; margin: auto; "
                                    src="{{ asset('/label/' . $lahan->i_label) }}" alt="Unsplash">
                                <div class="text-muted mb-2">Foto Label</div>
                            </div>
                            <hr class="bg-primary col-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ambil" class="form-label">Tanggal Pengambilan Calon Benih</label>
                                    <div class="input-group date" id="datetimepicker-ambil" data-target-input="nearest">
                                        <input type="text" placeholder="Tanggal ambil..."
                                            class="form-control datetimepicker-input @error('ambil') is-invalid @enderror"
                                            value="{{ old('ambil', !empty($lahan->ambil) ? \Carbon\Carbon::parse($lahan->tg_pendahuluan)->format('d/m/Y') : '') }}"
                                            data-toggle="datetimepicker" data-target="#datetimepicker-ambil"
                                            id="ambil" name="ambil" data-mask="00/00/0000" />
                                        @error('ambil')
                                            <div class="jquery-validation-error small form-text invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="input-group-append" data-target="#datetimepicker-ambil"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="selesai" class="form-label">Tanggal Selesai Uji Lab</label>
                                    <div class="input-group date" id="datetimepicker-selesai" data-target-input="nearest">
                                        <input type="text" placeholder="Tanggal selesai..."
                                            class="form-control datetimepicker-input @error('selesai') is-invalid @enderror"
                                            value="{{ old('selesai', !empty($lahan->selesai) ? \Carbon\Carbon::parse($lahan->tg_pendahuluan)->format('d/m/Y') : '') }}"
                                            data-toggle="datetimepicker" data-target="#datetimepicker-selesai"
                                            id="selesai" name="selesai" data-mask="00/00/0000" />
                                        @error('selesai')
                                            <div class="jquery-validation-error small form-text invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="input-group-append" data-target="#datetimepicker-selesai"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tk">Kadar Air</label>
                                    <input type="number" class="form-control @error('tk') is-invalid @enderror"
                                        value="{{ old('tk', !empty($lahan->taksasu) ? $lahan->taksasu : '') }}"
                                        id="tk" name="tk" placeholder="Luas Lahan spotimg...">
                                    @error('tk')
                                        <div class="jquery-validation-error small form-text invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            {{-- <div class="col-md-4">

                                <form id="panen_f" action="{{ route('post panen', ['s' => $lahan->id]) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')

                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="panen" class="form-label">Tanggal Panen</label>
                                                <div class="input-group date" id="datetimepicker-panen"
                                                    data-target-input="nearest">
                                                    <input type="text" placeholder="Tanggal panen..."
                                                        class="form-control datetimepicker-input @error('panen') is-invalid @enderror"
                                                        value="{{ old('panen', !empty($lahan->panen) ? \Carbon\Carbon::parse($lahan->tg_pendahuluan)->format('d/m/Y') : '') }}"
                                                        data-toggle="datetimepicker" data-target="#datetimepicker-panen"
                                                        id="panen" name="panen" data-mask="00/00/0000" />
                                                    @error('panen')
                                                        <div
                                                            class="jquery-validation-error small form-text invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                    <div class="input-group-append"
                                                        data-target="#datetimepicker-panen"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tk">Taksasi</label>
                                                <input type="number"
                                                    class="form-control @error('tk') is-invalid @enderror"
                                                    value="{{ old('tk', !empty($lahan->taksasu) ? $lahan->taksasu : '') }}"
                                                    id="tk" name="tk"
                                                    placeholder="Luas Lahan spotimg...">
                                                @error('tk')
                                                    <div class="jquery-validation-error small form-text invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end content --}}
        @push('sc')
            <script>
                // const x = {{ \Carbon\Carbon::parse($lahan->semai)->format('d/m/Y') }};
                const x = moment('{{ \Carbon\Carbon::parse($lahan->semai)->format('d/m/Y') }}', 'DD/MM/YYYY');
                const y = {{ $lahan->luas_akhir }}
            </script>
            <script type="text/javascript" src="{{ asset('js/panen.js') }}"></script>
        @endpush
</x-layout>
