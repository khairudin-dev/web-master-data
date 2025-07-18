<x-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:head_link>
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('pemantauan lapang') }}">Pemantauan</a></li>
        <li class="breadcrumb-item"><a href="{{ route('input pemantauan lapang') }}">Input Hasil Pemantauan</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }} Blok : {{ $lahan->no_blok }}</li>
    </x-slot:head_link>

    {{-- start content --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Input Data Hasil Pemantauan</h5>
                    <h6 class="card-subtitle text-muted">Inputkan hasil pemantauan untuk Blok {{ $lahan->no_blok }}</h6>
                </div>
                <div class="card-body">
                    {{-- seklias data --}}
                    <div class="m-sm-1 m-md-2">
                        <div class="row mb-4">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="text-muted mb-2">Nomor Blok</div>
                                        <strong>{{ $lahan->no_blok }}</strong>
                                    </div>
                                    <div class="col-6 text-right mb-2">
                                        <div class="text-muted">Nomor Induk Sertifikat</div>
                                        <strong>
                                            {{ $lahan->lapang }}
                                        </strong>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 text-center mb-2">
                                        <div class="text-muted mb-2">Foto Label</div>
                                        <img id="preview-label" class=""
                                            style="max-height:230px; max-width: 100%; margin: auto; "
                                            src="{{ asset('/label/' . $lahan->i_label) }}" alt="Unsplash">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 text-center mb-2">
                                        <div class="text-muted mb-2">Lokasi Lahan</div>
                                        <img id="preview-label" class=""
                                            style="max-height:230px; max-width: 100%; margin: auto; "
                                            src="{{ asset('/lokasi/' . $lahan->lokasi) }}" alt="Unsplash">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
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
                                            <td>Luas Lahan Awal</td>
                                            <td>:</td>
                                            <td class="text-right">{{ $lahan->luas . ' ha' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Luas Lahan Akhir</td>
                                            <td>:</td>
                                            <td class="text-right">{{ $lahan->luas_akhir . ' ha' }}</td>
                                        </tr>
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
                                            <td>Tanggal Semai</td>
                                            <td>: </td>
                                            <td class="text-right">
                                                {{ \Carbon\Carbon::parse($lahan->semai)->format('d/m/Y') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Tanam</td>
                                            <td>: </td>
                                            <td class="text-right">
                                                {{ \Carbon\Carbon::parse($lahan->tanam)->format('d/m/Y') }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- pendahuluan --}}
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Input Pemeriksaan Pendahuluan</h5>
                                </div>
                                <div class="card-body">
                                    <form id="pendahuluan_f"
                                        action="{{ route('post pendahuluan', ['s' => $lahan->id]) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="form-group">
                                            <label for="k_p">Keterangan Hasil Pemeriksaan</label>
                                            <textarea class="form-control @error('k_p') is-invalid @enderror" id="k_p" name="k_p"
                                                placeholder="Keterangan hasil pemantauan...">{{ old('k_p', $lahan->k_pendahuluan) }}</textarea>
                                            @error('k_p')
                                                <div class="jquery-validation-error small form-text invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-row">
                                            <!-- Kolom Kiri -->
                                            <div class="col-md-6">
                                                <label for="pendahuluan">Bukti Pemeriksaan</label>
                                                <div class="text-center mb-4">
                                                    <img id="preview-pendahuluan" class=""
                                                        style="max-width: 100%; max-height:230px; {{ empty($lahan->i_pendahuluan) ? 'display: none;' : '' }} margin: auto; "
                                                        @if (!empty($lahan->i_pendahuluan)) src="{{ asset('/pendahuluan/' . $lahan->i_pendahuluan) }}" @endif
                                                        alt="Unsplash">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="file"
                                                        class="form-control-file validation-file @error('pendahuluan') is-invalid @enderror"id="pendahuluan"
                                                        name="pendahuluan" accept="image/*">
                                                    @error('pendahuluan')
                                                        <div
                                                            class="jquery-validation-error small form-text invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="tg_p" class="form-label">Tanggal Pemeriksaan</label>
                                                    <div class="input-group date" id="datetimepicker-tg_p"
                                                        data-target-input="nearest">
                                                        <input type="text"
                                                            class="form-control datetimepicker-input @error('tg_p') is-invalid @enderror"
                                                            value="{{ old('tg_p', !empty($lahan->tg_pendahuluan) ? \Carbon\Carbon::parse($lahan->tg_pendahuluan)->format('d/m/Y') : '') }}"
                                                            data-toggle="datetimepicker"
                                                            data-target="#datetimepicker-tg_p" id="tg_p"
                                                            name="tg_p" data-mask="00/00/0000" />
                                                        @error('tg_p')
                                                            <div
                                                                class="jquery-validation-error small form-text invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                        <div class="input-group-append"
                                                            data-target="#datetimepicker-tg_p"
                                                            data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="s_p">Lahan Spoting (ha)</label>
                                                    <input type="number"
                                                        class="form-control @error('s_p') is-invalid @enderror"
                                                        value="{{ old('s_p', !empty($lahan->s_pendahuluan) ? $lahan->s_pendahuluan : '') }}"
                                                        id="s_p" name="s_p"
                                                        placeholder="Luas Lahan spotimg...">
                                                    @error('s_p')
                                                        <div
                                                            class="jquery-validation-error small form-text invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-4">
                                                <label for="h_pendahuluan">Dokumen Hasil</label>
                                            </div>
                                            <div class="col-lg-3 col-4 text-right text-md-left">
                                                <button type="button" id="btn-preview-h_p"
                                                    class="btn btn-outline-info btn-sm"
                                                    style="{{ empty($lahan->h_pendahuluan) ? 'display: none;' : '' }}"
                                                    data-toggle="modal"
                                                    data-doc="{{ asset('pendahuluan/' . $lahan->h_pendahuluan ?? '') }}"
                                                    data-target="#modalPreviewFile">
                                                    <i class="align-middle fas fa-fw fa-eye"></i> Lihat File
                                                </button>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input type="file" id="h_pendahuluan" name="h_pendahuluan"
                                                        class="form-control-file validation-file @error('h_pendahuluan') is-invalid @enderror"
                                                        value="{{ old('h_pendahuluan') }}"
                                                        accept="application/pdf, image/*">
                                                    @error('h_pendahuluan')
                                                        <div
                                                            class="jquery-validation-error small form-text invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- pl 1 --}}
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Input Pemeriksaan Fase Vegetatif</h5>
                                </div>
                                <div class="card-body">
                                    <form id="pl1_f" action="{{ route('post pl1', ['s' => $lahan->id]) }}"
                                        method="POST" enctype="multipart/form-data">
                                        <fieldset {{ !$lahan->tg_pendahuluan ? 'disabled' : '' }}>
                                            @csrf
                                            @method('put')

                                            <div class="form-group">
                                                <label for="k_pl1">Keterangan Hasil Pemeriksaan</label>
                                                <textarea class="form-control @error('k_pl1') is-invalid @enderror" id="k_pl1" name="k_pl1"
                                                    placeholder="Keterangan hasil pemantauan...">{{ old('k_pl1', $lahan->k_pl1) }}</textarea>
                                                @error('k_pl1')
                                                    <div class="jquery-validation-error small form-text invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-row">
                                                <!-- Kolom Kiri -->
                                                <div class="col-md-6">
                                                    <label for="pl1">Bukti Pemeriksaan</label>
                                                    <div class="text-center mb-4">
                                                        <img id="preview-pl1" class=""
                                                            style="max-width: 100%; max-height:230px; {{ empty($lahan->i_pl1) ? 'display: none;' : '' }} margin: auto; "
                                                            @if (!empty($lahan->i_pl1)) src="{{ asset('/pl1/' . $lahan->i_pl1) }}" @endif
                                                            alt="Unsplash">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="file"
                                                            class="form-control-file validation-file @error('pl1') is-invalid @enderror"id="pl1"
                                                            name="pl1" accept="image/*">
                                                        @error('pl1')
                                                            <div
                                                                class="jquery-validation-error small form-text invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tg_pl1" class="form-label">Tanggal
                                                            Pemeriksaan</label>
                                                        <div class="input-group date" id="datetimepicker-tg_pl1"
                                                            data-target-input="nearest">
                                                            <input type="text"
                                                                class="form-control datetimepicker-input @error('tg_pl1') is-invalid @enderror"
                                                                value="{{ old('tg_pl1', !empty($lahan->tg_pl1) ? \Carbon\Carbon::parse($lahan->tg_pl1)->format('d/m/Y') : '') }}"
                                                                data-toggle="datetimepicker"
                                                                data-target="#datetimepicker-tg_pl1" id="tg_pl1"
                                                                name="tg_pl1" data-mask="00/00/0000" />
                                                            @error('tg_pl1')
                                                                <div
                                                                    class="jquery-validation-error small form-text invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                            <div class="input-group-append"
                                                                data-target="#datetimepicker-tg_pl1"
                                                                data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i
                                                                        class="fa fa-calendar"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="s_pl1">Lahan Spoting (ha)</label>
                                                        <input type="number"
                                                            class="form-control @error('s_pl1') is-invalid @enderror"
                                                            value="{{ old('s_pl1', !empty($lahan->s_pl1) ? $lahan->s_pl1 : '') }}"
                                                            id="s_pl1" name="s_pl1"
                                                            placeholder="Luas Lahan spotimg...">
                                                        @error('s_pl1')
                                                            <div
                                                                class="jquery-validation-error small form-text invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-4">
                                                    <label for="h_pl1">Dokumen Hasil</label>
                                                </div>
                                                <div class="col-lg-3 col-4 text-right text-md-left">
                                                    <button type="button" id="btn-preview-h_pl1"
                                                        class="btn btn-outline-info btn-sm"
                                                        style="{{ empty($lahan->h_pl1) ? 'display: none;' : '' }}"
                                                        data-toggle="modal"
                                                        data-doc="{{ asset('pl1/' . $lahan->h_pl1 ?? '') }}"
                                                        data-target="#modalPreviewFile">
                                                        <i class="align-middle fas fa-fw fa-eye"></i> Lihat File
                                                    </button>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <input type="file" id="h_pl1" name="h_pl1"
                                                            class="form-control-file validation-file @error('h_pl1') is-invalid @enderror"
                                                            value="{{ old('h_pl1') }}"
                                                            accept="application/pdf, image/*">
                                                        @error('h_pl1')
                                                            <div
                                                                class="jquery-validation-error small form-text invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>

                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </fieldset>

                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- pl 2 --}}
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Input Pemeriksaan Fase Generatif</h5>
                                </div>
                                <div class="card-body">
                                    <form id="pl2_f" action="{{ route('post pl2', ['s' => $lahan->id]) }}"
                                        method="POST" enctype="multipart/form-data">
                                        <fieldset {{ !$lahan->tg_pl1 ? 'disabled' : '' }}>
                                            @csrf
                                            @method('put')

                                            <div class="form-group">
                                                <label for="k_pl2">Keterangan Hasil Pemeriksaan</label>
                                                <textarea class="form-control @error('k_pl2') is-invalid @enderror" id="k_pl2" name="k_pl2"
                                                    placeholder="Keterangan hasil pemantauan...">{{ old('k_pl2', $lahan->k_pl2) }}</textarea>
                                                @error('k_pl2')
                                                    <div class="jquery-validation-error small form-text invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-row">
                                                <!-- Kolom Kiri -->
                                                <div class="col-md-6">
                                                    <label for="pl2">Bukti Pemeriksaan</label>
                                                    <div class="text-center mb-4">
                                                        <img id="preview-pl2" class=""
                                                            style="max-width: 100%; max-height:230px; {{ empty($lahan->i_pl2) ? 'display: none;' : '' }} margin: auto; "
                                                            @if (!empty($lahan->i_pl2)) src="{{ asset('/pl2/' . $lahan->i_pl2) }}" @endif
                                                            alt="Unsplash">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="file"
                                                            class="form-control-file validation-file @error('pl2') is-invalid @enderror"id="pl2"
                                                            name="pl2" accept="image/*">
                                                        @error('pl2')
                                                            <div
                                                                class="jquery-validation-error small form-text invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tg_pl2" class="form-label">Tanggal
                                                            Pemeriksaan</label>
                                                        <div class="input-group date" id="datetimepicker-tg_pl2"
                                                            data-target-input="nearest">
                                                            <input type="text"
                                                                class="form-control datetimepicker-input @error('tg_pl2') is-invalid @enderror"
                                                                value="{{ old('tg_pl2', !empty($lahan->tg_pl2) ? \Carbon\Carbon::parse($lahan->tg_pl2)->format('d/m/Y') : '') }}"
                                                                data-toggle="datetimepicker"
                                                                data-target="#datetimepicker-tg_pl2" id="tg_pl2"
                                                                name="tg_pl2" data-mask="00/00/0000" />
                                                            @error('tg_pl2')
                                                                <div
                                                                    class="jquery-validation-error small form-text invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                            <div class="input-group-append"
                                                                data-target="#datetimepicker-tg_pl2"
                                                                data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i
                                                                        class="fa fa-calendar"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="s_pl2">Lahan Spoting (ha)</label>
                                                        <input type="number"
                                                            class="form-control @error('s_pl2') is-invalid @enderror"
                                                            value="{{ old('s_pl2', !empty($lahan->s_pl2) ? $lahan->s_pl2 : '') }}"
                                                            id="s_pl2" name="s_pl2"
                                                            placeholder="Luas Lahan spotimg...">
                                                        @error('s_pl2')
                                                            <div
                                                                class="jquery-validation-error small form-text invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-4">
                                                    <label for="h_pl2">Dokumen Hasil</label>
                                                </div>
                                                <div class="col-lg-3 col-4 text-right text-md-left">
                                                    <button type="button" id="btn-preview-h_pl2"
                                                        class="btn btn-outline-info btn-sm"
                                                        style="{{ empty($lahan->h_pl2) ? 'display: none;' : '' }}"
                                                        data-toggle="modal"
                                                        data-doc="{{ asset('pl2/' . $lahan->h_pl2 ?? '') }}"
                                                        data-target="#modalPreviewFile">
                                                        <i class="align-middle fas fa-fw fa-eye"></i> Lihat File
                                                    </button>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <input type="file" id="h_pl2" name="h_pl2"
                                                            class="form-control-file validation-file @error('h_pl2') is-invalid @enderror"
                                                            value="{{ old('h_pl2') }}"
                                                            accept="application/pdf, image/*">
                                                        @error('h_pl2')
                                                            <div
                                                                class="jquery-validation-error small form-text invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </fieldset>

                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- pl 3 --}}
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Input Pemeriksaan Fase Masak</h5>
                                </div>
                                <div class="card-body">
                                    <form id="pl3_f" action="{{ route('post pl3', ['s' => $lahan->id]) }}"
                                        method="POST" enctype="multipart/form-data">
                                        <fieldset {{ !$lahan->tg_pl2 ? 'disabled' : '' }}>
                                            @csrf
                                            @method('put')

                                            <div class="form-group">
                                                <label for="k_pl3">Keterangan Hasil Pemeriksaan</label>
                                                <textarea class="form-control @error('k_pl3') is-invalid @enderror" id="k_pl3" name="k_pl3"
                                                    placeholder="Keterangan hasil pemantauan...">{{ old('k_pl3', $lahan->k_pl3) }}</textarea>
                                                @error('k_pl3')
                                                    <div class="jquery-validation-error small form-text invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-row">
                                                <!-- Kolom Kiri -->
                                                <div class="col-md-6">
                                                    <label for="pl3">Bukti Pemeriksaan</label>
                                                    <div class="text-center mb-4">
                                                        <img id="preview-pl3" class=""
                                                            style="max-width: 100%; max-height:230px; {{ empty($lahan->i_pl3) ? 'display: none;' : '' }} margin: auto; "
                                                            @if (!empty($lahan->i_pl3)) src="{{ asset('/pl3/' . $lahan->i_pl3) }}" @endif
                                                            alt="Unsplash">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="file"
                                                            class="form-control-file validation-file @error('pl3') is-invalid @enderror"id="pl3"
                                                            name="pl3" accept="image/*">
                                                        @error('pl3')
                                                            <div
                                                                class="jquery-validation-error small form-text invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tg_pl3" class="form-label">Tanggal
                                                            Pemeriksaan</label>
                                                        <div class="input-group date" id="datetimepicker-tg_pl3"
                                                            data-target-input="nearest">
                                                            <input type="text"
                                                                class="form-control datetimepicker-input @error('tg_pl3') is-invalid @enderror"
                                                                value="{{ old('tg_p32', !empty($lahan->tg_pl3) ? \Carbon\Carbon::parse($lahan->tg_pl2)->format('d/m/Y') : '') }}"
                                                                data-toggle="datetimepicker"
                                                                data-target="#datetimepicker-tg_pl3" id="tg_pl3"
                                                                name="tg_pl3" data-mask="00/00/0000" />
                                                            @error('tg_pl3')
                                                                <div
                                                                    class="jquery-validation-error small form-text invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                            <div class="input-group-append"
                                                                data-target="#datetimepicker-tg_pl3"
                                                                data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i
                                                                        class="fa fa-calendar"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="s_pl3">Lahan Spoting (ha)</label>
                                                        <input type="number"
                                                            class="form-control @error('s_pl3') is-invalid @enderror"
                                                            value="{{ old('s_pl3', !empty($lahan->s_pl3) ? $lahan->s_pl3 : '') }}"
                                                            id="s_pl3" name="s_pl3"
                                                            placeholder="Luas Lahan spotimg...">
                                                        @error('s_pl3')
                                                            <div
                                                                class="jquery-validation-error small form-text invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-4">
                                                    <label for="h_pl3">Dokumen Hasil</label>
                                                </div>
                                                <div class="col-lg-3 col-4 text-right text-md-left">
                                                    <button type="button" id="btn-preview-h_pl3"
                                                        class="btn btn-outline-info btn-sm"
                                                        style="{{ empty($lahan->h_pl3) ? 'display: none;' : '' }}"
                                                        data-toggle="modal"
                                                        data-doc="{{ asset('pl3/' . $lahan->h_pl3 ?? '') }}"
                                                        data-target="#modalPreviewFile">
                                                        <i class="align-middle fas fa-fw fa-eye"></i> Lihat File
                                                    </button>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <input type="file" id="h_pl3" name="h_pl3"
                                                            class="form-control-file validation-file @error('h_pl3') is-invalid @enderror"
                                                            value="{{ old('h_pl3') }}"
                                                            accept="application/pdf, image/*">
                                                        @error('h_pl3')
                                                            <div
                                                                class="jquery-validation-error small form-text invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                        <label for="tk">Taksasi</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="number"
                                                            class="form-control @error('tk') is-invalid @enderror"
                                                            value="{{ old('tk', !empty($lahan->taksasi) ? $lahan->taksasi : '') }}"
                                                            id="tk" name="tk"
                                                            placeholder="Input taksasi...">
                                                        @error('tk')
                                                            <div
                                                                class="jquery-validation-error small form-text invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>

                                                </div>

                                            </div>

                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </fieldset>

                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Modal modalPreviewFile -->

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
                        <iframe id="iframePreviewFile" style="width: 100%; height: 500px;" frameborder="0"></iframe>
                    </div>
                    <div class="modal-footer"id="footer-body-detailahan">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- end content --}}
        @push('sc')
            <script>
                const imgCheck_p = {{ empty($lahan->i_pendahuluan) ? 'true' : 'false' }};
                const imgCheck_pl1 = {{ empty($lahan->i_pl1) ? 'true' : 'false' }};
                const imgCheck_pl2 = {{ empty($lahan->i_pl2) ? 'true' : 'false' }};
                const imgCheck_pl3 = {{ empty($lahan->i_pl3) ? 'true' : 'false' }};
                const tanam = "{{ \Carbon\Carbon::parse($lahan->tanam)->format('d/m/Y') }}"
                const tg_p =
                    "{{ !empty($lahan->tg_pendahuluan) ? \Carbon\Carbon::parse($lahan->tg_pendahuluan)->format('d/m/Y') : '' }}";
                const tg_pl1 = "{{ !empty($lahan->tg_pl1) ? \Carbon\Carbon::parse($lahan->tg_pl1)->format('d/m/Y') : '' }}";
                const tg_pl2 = "{{ !empty($lahan->tg_pl2) ? \Carbon\Carbon::parse($lahan->tg_pl2)->format('d/m/Y') : '' }}";
                const tg_pl3 = "{{ !empty($lahan->tg_pl3) ? \Carbon\Carbon::parse($lahan->tg_pl3)->format('d/m/Y') : '' }}";
            </script>
            <script type="text/javascript" src="{{ asset('js/pdf-lib.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/pemantauan.js') }}"></script>
        @endpush
</x-layout>
