<x-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:head_link>
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('lahan') }}">Lahan</a></li>
        @if (isset($edit))
            <li class="breadcrumb-item active" aria-current="page">Edit Data Lahan</li>
        @else
            <li class="breadcrumb-item active" aria-current="page">Registrasi Lahan Baru/li>
        @endif
    </x-slot:head_link>

    {{-- start content --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Input Data Lahan Baru</h5>
                    <h6 class="card-subtitle text-muted">Registrasikan lahan baru</h6>
                </div>
                <div class="card-body">
                    <form id="form_regis"
                        action="{{ isset($edit) && $edit ? route('update regis lahan', ['s' => $lahan->id]) : route('post regis lahan') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($edit))
                            @method('put')
                        @endif
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="blok">No. Blok</label>
                                <input type="text" class="form-control @error('blok') is-invalid @enderror"
                                    value="{{ old('blok', isset($edit) && $edit ? $lahan->no_blok : '') }}"
                                    id="blok" name="blok" placeholder="Nomor blok baru...">
                                @error('blok')
                                    <div class="jquery-validation-error small form-text invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="form-group col-md-6">
                                <label for="nama">Nama Pemilik</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    value="{{ old('nama', isset($edit) && $edit ? $lahan->nama : '') }}" id="nama"
                                    name="nama" placeholder="Nama pemilik lahan...">
                                @error('nama')
                                    <div class="jquery-validation-error small form-text invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat Pemilik Lahan</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                value="{{ old('alamat', isset($edit) && $edit ? $lahan->alamat_parts[0] : '') }}"
                                id="alamat" name="alamat" placeholder="Alamat pemilik lahan...">
                            @error('alamat')
                                <div class="jquery-validation-error small form-text invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="provinsi">Provinsi</label>
                                <select id="provinsi" name="provinsi"
                                    class="form-control select2 @error('provinsi') is-invalid @enderror"
                                    data-toggle="select2">
                                    <option></option>
                                </select>
                                @error('provinsi')
                                    <div class="jquery-validation-error small form-text invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="kota">Kota / Kabupaten</label>
                                <select id="kota" name="kota"
                                    class="form-control select2 @error('kota') is-invalid @enderror"
                                    data-toggle="select2">
                                    <option></option>
                                </select>
                                @error('kota')
                                    <div class="jquery-validation-error small form-text invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="kecamatan">Kecamatan</label>
                                <select id="kecamatan" name="kecamatan"
                                    class="form-control select2 @error('kecamatan') is-invalid @enderror"
                                    data-toggle="select2">
                                    <option></option>
                                </select>
                                @error('kecamatan')
                                    <div class="jquery-validation-error small form-text invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="form-group col-md-6">
                                <label for="desa">Desa / Kelurahan</label>
                                <select id="desa" name="desa"
                                    class="form-control select2 @error('desa') is-invalid @enderror"
                                    data-toggle="select2">
                                    <option></option>
                                </select>
                                @error('desa')
                                    <div class="jquery-validation-error small form-text invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <!-- Kolom Kiri -->
                            <div class="form-group col-md-6">
                                <label for="varietas">Varietas</label>
                                <select id="varietas" name="varietas"
                                    class="form-control select2 @error('varietas') is-invalid @enderror"
                                    data-toggle="select2">
                                    <option></option>
                                </select>
                                @error('varietas')
                                    <div class="jquery-validation-error small form-text invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="kb">Kelas Benih</label>
                                <select id="kb" name="kb"
                                    class="form-control select2 @error('kb') is-invalid @enderror"
                                    data-toggle="select2">
                                    <option></option>
                                </select>
                                @error('kb')
                                    <div class="jquery-validation-error small form-text invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="label">Label Benih</label>
                                    <input type="file" id="label" name="label"
                                        class="form-control-file validation-file @error('label') is-invalid @enderror"
                                        value="{{ old('label') }}" accept="image/*">
                                    @error('label')
                                        <div class="jquery-validation-error small form-text invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="text-center mb-4">
                                    <img id="preview-label" class=""
                                        style="max-width: 100%; max-height:230px; {{ empty($edit) ? 'display: none;' : '' }} margin: auto; "
                                        @if (!empty($edit)) src="{{ asset('/label/' . $lahan->i_label) }}" @endif
                                        alt="Unsplash">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lokasi">Lokasi Lahan</label>
                                    <input type="file"
                                        class="form-control-file validation-file @error('lokasi') is-invalid @enderror"
                                        value="{{ old('lokasi', isset($edit) && $edit ? $lahan->lokasi_parts : '') }}"
                                        id="lokasi" name="lokasi" accept="image/*">
                                    @error('lokasi')
                                        <div class="jquery-validation-error small form-text invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="text-center mb-4">
                                    <img id="preview-lokasi" class=""
                                        style="max-width: 100%; max-height:230px; {{ empty($edit) ? 'display: none;' : '' }} margin: auto; "
                                        @if (!empty($edit)) src="{{ asset('/lokasi/' . $lahan->lokasi) }}" @endif
                                        alt="Unsplash">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="sumber">Label Sumber</label>
                                <input type="text" class="form-control @error('sumber') is-invalid @enderror"
                                    value="{{ old('sumber', isset($edit) && $edit ? $lahan->label_sumber : '') }}"
                                    id="sumber" name="sumber" placeholder="Laberl Sumber...">
                                @error('sumber')
                                    <div class="jquery-validation-error small form-text invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="luas">Luas Lahan (ha)</label>
                                <input type="number" class="form-control @error('luas') is-invalid @enderror"
                                    value="{{ old('luas', isset($edit) && $edit ? $lahan->luas : '') }}"
                                    id="luas" name="luas" placeholder="Luas Lahan...">
                                @error('luas')
                                    <div class="jquery-validation-error small form-text invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label for="musim">Musim Tanam</label>
                                <select id="musim" name="musim"
                                    class="form-control select2 @error('musim') is-invalid @enderror"
                                    data-toggle="select2">
                                    <option></option>
                                </select>
                                @error('musim')
                                    <div class="jquery-validation-error small form-text invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="semai" class="form-label">Tanggal Semai</label>
                                <div class="input-group date" id="datetimepicker-semai" data-target-input="nearest">
                                    <input type="text"
                                        class="form-control datetimepicker-input @error('semai') is-invalid @enderror"
                                        value="{{ old('semai', isset($edit) && $edit ? \Carbon\Carbon::parse($lahan->semai)->format('d/m/Y') : '') }}"
                                        data-toggle="datetimepicker" data-target="#datetimepicker-semai"
                                        id="semai" name="semai" data-mask="00/00/0000" />
                                    @error('semai')
                                        <div class="jquery-validation-error small form-text invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="input-group-append" data-target="#datetimepicker-semai"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tanam" class="form-label">Tanggal Tanam</label>
                                <div class="input-group date" id="datetimepicker-tanam" data-target-input="nearest">
                                    <input type="text"
                                        class="form-control datetimepicker-input @error('tanam') is-invalid @enderror"
                                        value="{{ old('tanam', isset($edit) && $edit ? \Carbon\Carbon::parse($lahan->tanam)->format('d/m/Y') : '') }}"
                                        data-toggle="datetimepicker" data-target="#datetimepicker-tanam"
                                        id="tanam" name="tanam" data-mask="00/00/0000" />
                                    @error('tanam')
                                        <div class="jquery-validation-error small form-text invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <div class="input-group-append" data-target="#datetimepicker-tanam"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end content --}}
    @push('sc')
        <script>
            const dataWilayah = @json($wilayah);
            const dataForm = @json($dataForm);
            const editMode = {{ !empty($edit) ? 'true' : 'false' }};

            const formData = {
                provinsi: "{{ old('provinsi') ?? (isset($edit) && $edit ? $lahan->alamat_parts[4] : '') }}",
                kota: "{{ old('kota') ?? (isset($edit) && $edit ? $lahan->alamat_parts[3] : '') }}",
                kecamatan: "{{ old('kecamatan') ?? (isset($edit) && $edit ? $lahan->alamat_parts[2] : '') }}",
                desa: "{{ old('desa') ?? (isset($edit) && $edit ? $lahan->alamat_parts[1] : '') }}",
                varietas: "{{ old('varietas') ?? (isset($edit) && $edit ? $lahan->varietas : '') }}",
                kb: "{{ old('kb') ?? (isset($edit) && $edit ? $lahan->kb : '') }}",
                musim: "{{ old('musim') ?? (isset($edit) && $edit ? $lahan->musim : '') }}",
                // lanjutkan sesuai kebutuhan...
            };
        </script>
        <script type="text/javascript" src="{{ asset('js/regis_lahan.js') }}"></script>
    @endpush
</x-layout>
