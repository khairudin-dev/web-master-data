<x-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:head_link>
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('lab') }}">Uji Laboratorium </a></li>
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
                            <div class="col-md-6">
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
                                            <td class="text-right">{{ $lahan->lulus . ' ha' }}</td>
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
                            <div class="col-md-6">
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
                                                {{ $lahan->tg_kadaluarsa ? \Carbon\Carbon::parse($lahan->tg_kadaluarsa)->format('d/m/Y') : '--' }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr class="bg-primary col-12">
                        </div>
                        <form id="lab_f" action="{{ route('post uji lab', ['s' => $lahan->id]) }}" method="POST"
                            enctype="multipart/form-data" class="row mb-4">
                            @csrf
                            @method('put')

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ambil" class="form-label">Tanggal Pengambilan Calon Benih</label>
                                    <div class="input-group date" id="datetimepicker-ambil" data-target-input="nearest">
                                        <input type="text" placeholder="Tanggal ambil..."
                                            class="form-control datetimepicker-input @error('ambil') is-invalid @enderror"
                                            value="{{ old('ambil', !empty($lahan->tg_pengambilan) ? \Carbon\Carbon::parse($lahan->tg_pendahuluan)->format('d/m/Y') : '') }}"
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
                                    <div class="input-group date" id="datetimepicker-selesai"
                                        data-target-input="nearest">
                                        <input type="text" placeholder="Tanggal selesai..."
                                            class="form-control datetimepicker-input @error('selesai') is-invalid @enderror"
                                            value="{{ old('selesai', !empty($lahan->tg_selesai) ? \Carbon\Carbon::parse($lahan->tg_selesai)->format('d/m/Y') : '') }}"
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
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="ka">Kadar Air</label>
                                    <input type="number" class="form-control @error('ka') is-invalid @enderror"
                                        value="{{ old('ka', !empty($lahan->ka) ? $lahan->ka : '') }}" id="ka"
                                        name="ka" placeholder="Kadar air...">
                                    @error('ka')
                                        <div class="jquery-validation-error small form-text invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="dk">Daya Berkecambah</label>
                                    <input type="number" class="form-control @error('dk') is-invalid @enderror"
                                        value="{{ old('dk', !empty($lahan->kecambah) ? $lahan->kecambah : '') }}"
                                        id="dk" name="dk" placeholder="Daya berkecambah...">
                                    @error('dk')
                                        <div class="jquery-validation-error small form-text invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="bm">Benih Murni</label>
                                    <input type="number" class="form-control @error('bm') is-invalid @enderror"
                                        value="{{ old('bm', !empty($lahan->bm) ? $lahan->bm : '') }}" id="bm"
                                        name="bm" placeholder="Benih murni...">
                                    @error('bm')
                                        <div class="jquery-validation-error small form-text invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="lab">Hasil Uji Lab</label>
                                    <select id="lab" name="lab"
                                        class="form-control select2 @error('lab') is-invalid @enderror"
                                        data-toggle="select2">
                                        <option value='1' {{ old('lab', $lahan->mutu) == 1 ? 'selected' : '' }}>Lulus</option>
                                        <option value='0' {{ old('lab', $lahan->mutu) == 0 ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                    @error('lab')
                                        <div class="jquery-validation-error small form-text invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sertif">Nomor Sertifikat</label>
                                    <input type="text" class="form-control @error('sertif') is-invalid @enderror"
                                        value="{{ old('sertif', !empty($lahan->no_sertifikat) ? $lahan->no_sertifikat : '') }}"
                                        id="sertif" name="sertif" placeholder="Nomor Sertifikat...">
                                    @error('sertif')
                                        <div class="jquery-validation-error small form-text invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-12" for="seri">Nomor Seri Label</label>
                                    <input type="text"
                                        class="form-control col-8 @error('seri') is-invalid @enderror"
                                        value="{{ old('seri', !empty($lahan->seri_label) ? $lahan->seri_label : '') }}"
                                        id="seri" name="seri" placeholder="Seri Label...">
                                    @error('seri')
                                        <div class="jquery-validation-error small form-text invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <button type="submit" class="col-3 ml-2 btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- end content --}}
        @push('sc')
            <script>
                // const x = {{ \Carbon\Carbon::parse($lahan->semai)->format('d/m/Y') }};
                // const x = moment('{{ \Carbon\Carbon::parse($lahan->semai)->format('d/m/Y') }}', 'DD/MM/YYYY');
                // const y = {{ $lahan->luas_akhir }}
            </script>
            <script type="text/javascript" src="{{ asset('js/uji-lab.js') }}"></script>
        @endpush
</x-layout>
