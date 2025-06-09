<x-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:head_link>
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('lahan') }}">Lahan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Registrasi Lahan Baru</li>
    </x-slot:head_link>

    {{-- start content --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Data Lahan Baru</h5>
                    <h6 class="card-subtitle text-muted">Registrasikan lahan baru</h6>
                </div>
                <div class="card-body">
                    <form id="form_regis" action="{{ route('post regis lahan') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="blok">No. Blok</label>
                                <input type="text" class="form-control @error('blok') is-invalid @enderror"
                                    value="{{ old('blok', isset($edit) && $edit ? $lahan->no_blok : '') }}"
                                    id="blok" name="blok" placeholder="Nomor blok baru...">
                                <span class="font-13 text-muted">Contoh: BMI S 9999</span>
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
                            <div class="col-md-6">
                                <div class="form-group">
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
                                <div class="form-group">
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
                            </div>
                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <img id="preview-label" class=""
                                    style="max-height:230px; {{ empty($edit) ? 'display: none;' : '' }} margin: auto; "
                                    @if (!empty($edit)) src="{{ asset('/label/' . $lahan->i_label) }}" @endif
                                    alt="Unsplash">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lokasi">Lokasi Lahan</label>
                            <div class="form-group">
                                <label class="custom-control custom-checkbox m-0">
                                    <input type="checkbox" class="custom-control-input"
                                        {{ old('sm_dg') == 'on' ? 'checked' : '' }} id="sm_dg" name="sm_dg">
                                    <span class="custom-control-label">Sama dengan alamat Pemilik</span>
                                </label>
                            </div>
                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror"
                                value="{{ old('lokasi', isset($edit) && $edit ? $lahan->lokasi_parts[0] : '') }}"
                                id="lokasi" name="lokasi" placeholder="Lokasi lahan...">
                            @error('lokasi')
                                <div class="jquery-validation-error small form-text invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="l_provinsi">Provinsi</label>
                                <select id="l_provinsi" name="l_provinsi"
                                    class="form-control select2 @error('l_provinsi') is-invalid @enderror"
                                    data-toggle="select2">
                                    <option></option>
                                </select>
                                @error('l_provinsi')
                                    <div class="jquery-validation-error small form-text invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="form-group col-md-6">
                                <label for="l_kota">Kota / Kabupaten</label>
                                <select id="l_kota" name="l_kota"
                                    class="form-control select2 @error('l_kota') is-invalid @enderror"
                                    data-toggle="select2">
                                    <option></option>
                                </select>
                                @error('l_kota')
                                    <div class="jquery-validation-error small form-text invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="l_kecamatan">Kecamatan</label>
                                <select id="l_kecamatan" name="l_kecamatan"
                                    class="form-control select2 @error('l_kecamatan') is-invalid @enderror"
                                    data-toggle="select2">
                                    <option></option>
                                </select>
                                @error('l_kecamatan')
                                    <div class="jquery-validation-error small form-text invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="l_desa">Desa / Kelurahan</label>
                                <select id="l_desa" name="l_desa"
                                    class="form-control select2 @error('l_desa') is-invalid @enderror"
                                    data-toggle="select2">
                                    <option></option>
                                </select>
                                @error('l_desa')
                                    <div class="jquery-validation-error small form-text invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

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
                                <label for="luas">Luas Lahan {ha}</label>
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
            window.flashMessage = {
                success: @json(session('success')),
                error: @json(session('error'))
            };
            const dataWilayah = @json($wilayah);
            const dataForm = @json($dataForm);
            const editMode = {{ !empty($edit) ? 'false' : 'true' }};

            const formData = {
                provinsi: "{{ old('provinsi') ?? (isset($edit) && $edit ? $lahan->alamat_parts[4] : '') }}",
                kota: "{{ old('kota') ?? (isset($edit) && $edit ? $lahan->alamat_parts[3] : '') }}",
                kecamatan: "{{ old('kecamatan') ?? (isset($edit) && $edit ? $lahan->alamat_parts[2] : '') }}",
                desa: "{{ old('desa') ?? (isset($edit) && $edit ? $lahan->alamat_parts[1] : '') }}",
                l_provinsi: "{{ old('l_provinsi') ?? (isset($edit) && $edit ? $lahan->lokasi_parts[4] : '') }}",
                l_kota: "{{ old('l_kota') ?? (isset($edit) && $edit ? $lahan->lokasi_parts[3] : '') }}",
                l_kecamatan: "{{ old('l_kecamatan') ?? (isset($edit) && $edit ? $lahan->lokasi_parts[2] : '') }}",
                l_desa: "{{ old('l_desa') ?? (isset($edit) && $edit ? $lahan->lokasi_parts[1] : '') }}",
                varietas: "{{ old('varietas') ?? (isset($edit) && $edit ? $lahan->varietas : '') }}",
                kb: "{{ old('kb') ?? (isset($edit) && $edit ? $lahan->kb : '') }}",
                musim: "{{ old('musim') ?? (isset($edit) && $edit ? $lahan->musim : '') }}",
                // lanjutkan sesuai kebutuhan...
            };
        </script>
        <script type="text/javascript" src="{{ asset('js/regis_lahan.js') }}"></script>
    @endpush
</x-layout>
