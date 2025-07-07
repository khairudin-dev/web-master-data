<x-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:head_link>
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('panen') }}">Panen</a></li>
        <li class="breadcrumb-item"><a href="{{ route('input panen') }}">Input Hasil panen</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }} Blok : {{ $lahan->no_blok }}</li>
    </x-slot:head_link>

    {{-- start content --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Input Data Hasil Panen</h5>
                    <h6 class="card-subtitle text-muted">Inputkan hasil panen Blok {{ $lahan->no_blok }}</h6>
                </div>
                <div class="card-body">
                    {{-- seklias data --}}
                    <div class="m-sm-1 m-md-2">
                        <div class="row mb-4">
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="text-muted mb-2">Nomor Blok</div>
                                        <strong>{{ $lahan->no_blok }}</strong>
                                    </div>
                                    <div class="col-6 text-right mb-2">
                                        <div class="text-muted">Nomor Lapang</div>
                                        <strong>
                                            {{ $lahan->lapang }}
                                        </strong>
                                    </div>
                                    <div class="col-12">
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
                                                    <td>Luas Awal</td>
                                                    <td>:</td>
                                                    <td class="text-right">{{ $lahan->luas . ' ha' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Luas Akhir / Lahan Lulus</td>
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
                                    <!-- <div class="col-12 text-center mb-2">
                                        <div class="text-muted mb-2">Foto Label</div>
                                        <img id="preview-label" class=""
                                            style="max-height:230px; max-width: 100%; margin: auto; "
                                            src="{{ asset('/label/' . $lahan->i_label) }}" alt="Unsplash">
                                    </div> -->
                                </div>
                            </div>
                            <div class="col-md-7">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-lg">
                                            <td>Umur Padi</td>
                                            <td>:</td>
                                            <td class="text-right" id="umur">
                                                {{ $lahan->umur_padi ? $lahan->umur_padi ." hari" : '--' }}
                                            </td>
                                        </tr>
                                        <tr class="text-lg">
                                            <td>Tonase</td>
                                            <td>:</td>
                                            <td class="text-right" id="tonase">
                                                {{ $lahan->tonase_sertifikat ? $lahan->tonase_sertifikat : '--' }}
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                                <hr class="bg-primary">
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
                                                    <div class="input-group-append" data-target="#datetimepicker-panen"
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
                                                    value="{{ old('tk', !empty($lahan->taksasi) ? $lahan->taksasi : '') }}"
                                                    id="tk" name="tk" placeholder="Input taksasi...">
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
                            </div>
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
                const z = moment('{{ \Carbon\Carbon::parse($lahan->tg_pl3)->format('d/m/Y') }}', 'DD/MM/YYYY');
            </script>
            <script type="text/javascript" src="{{ asset('js/panen.js') }}"></script>
        @endpush
</x-layout>
