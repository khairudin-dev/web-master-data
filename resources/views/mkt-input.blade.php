<x-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:head_link>
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('mkt') }}">Data Distribusi</a></li>
        <li class="breadcrumb-item"><a href="{{ route('input marketing') }}">Input data ditribuasi</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }} Blok : {{ $lahan->no_blok }}</li>
    </x-slot:head_link>

    {{-- start content --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Input Data Distribusi</h5>
                    <h6 class="card-subtitle text-muted">Inputkan hasil pendistribusian {{ $lahan->no_blok }}</h6>
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
                                                    <td>Varietas</td>
                                                    <td>:</td>
                                                    <td class="text-right">{{ $lahan->varietas}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Kelas Benih</td>
                                                    <td>:</td>
                                                    <td class="text-right">{{ $lahan->kb }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Tanam</td>
                                                    <td>:</td>
                                                    <td class="text-right">
                                                        {{ \Carbon\Carbon::parse($lahan->tanam)->format('d/m/Y') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Panen</td>
                                                    <td>:</td>
                                                    <td class="text-right">
                                                        {{ \Carbon\Carbon::parse($lahan->panen)->format('d/m/Y') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tonase Sertifikat</td>
                                                    <td>:</td>
                                                    <td class="text-right">{{ $lahan->tonase_sertifikat . ' Kg' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Nomor Sertifikat</td>
                                                    <td>:</td>
                                                    <td class="text-right">{{ $lahan->no_sertifikat . ' ha' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Kadaluarsa</td>
                                                    <td>:</td>
                                                    <td class="text-right">
                                                        {{ \Carbon\Carbon::parse($lahan->tg_kadaluarsa)->format('d/m/Y') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>QTY Label</td>
                                                    <td>:</td>
                                                    <td class="text-right">{{ $lahan->label }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Nomor Seri</td>
                                                    <td>:</td>
                                                    <td class="text-right">{{ $lahan->seri_label }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Stok</td>
                                                    <td>:</td>
                                                    <td class="text-right" id="stok">{{ $lahan->stok . ' Kg' }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <hr class="bg-primary">
                                <form id="mkt_f" action="{{ route('post marketing', ['s' => $lahan->id]) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')

                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="bantuan">Ditribusi benih bantuan</label>
                                                <input type="text"
                                                    class="form-control @error('bantuan') is-invalid @enderror"
                                                    value="{{ old('bantuan', !empty($lahan->bantuan) ? $lahan->bantuan : '') }}"
                                                    id="bantuan" name="bantuan" placeholder="Penerima bantuan...">
                                                @error('bantuan')
                                                    <div class="jquery-validation-error small form-text invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tb">Tonase</label>
                                                <input type="number"
                                                    class="form-control @error('tb') is-invalid @enderror"
                                                    value="{{ old('tb', !empty($lahan->t_bantuan) ? $lahan->t_bantuan : '') }}"
                                                    id="tb" name="tb" placeholder="Jumlah bantuan...">
                                                @error('tb')
                                                    <div class="jquery-validation-error small form-text invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="market">Ditribusi benih free market</label>
                                                <input type="text"
                                                    class="form-control @error('market') is-invalid @enderror"
                                                    value="{{ old('market', !empty($lahan->market) ? $lahan->market : '') }}"
                                                    id="market" name="market" placeholder="Penerima market...">
                                                @error('market')
                                                    <div class="jquery-validation-error small form-text invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tm">Tonase</label>
                                                <input type="number"
                                                    class="form-control @error('tm') is-invalid @enderror"
                                                    value="{{ old('tm', !empty($lahan->t_market) ? $lahan->t_market : '') }}"
                                                    id="tm" name="tm" placeholder="Jumlah bantuan...">
                                                @error('tm')
                                                    <div class="jquery-validation-error small form-text invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="penangkaran">Penangkaran</label>
                                                <input type="text"
                                                    class="form-control @error('penangkaran') is-invalid @enderror"
                                                    value="{{ old('penangkaran', !empty($lahan->penangkaran) ? $lahan->penangkaran : '') }}"
                                                    id="penangkaran" name="penangkaran"
                                                    placeholder="Penerima penangkaran...">
                                                @error('penangkaran')
                                                    <div class="jquery-validation-error small form-text invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tp">Tonase</label>
                                                <input type="number"
                                                    class="form-control @error('tp') is-invalid @enderror"
                                                    value="{{ old('tp', !empty($lahan->t_penangkaran) ? $lahan->t_penangkaran : '') }}"
                                                    id="tp" name="tp" placeholder="Jumlah bantuan...">
                                                @error('tp')
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
                // const x = moment('{{ \Carbon\Carbon::parse($lahan->semai)->format('d/m/Y') }}', 'DD/MM/YYYY');
                // const y = {{ $lahan->luas_akhir }}
                const z = {{ $lahan->tonase_sertifikat }}
            </script>
            <script type="text/javascript" src="{{ asset('js/marketing.js') }}"></script>
        @endpush
</x-layout>
