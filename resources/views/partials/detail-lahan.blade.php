<div class="m-sm-1 m-md-2">
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="text-muted">Nama Pemilik</div>
            <strong>{{ $lahan->nama }}</strong>
        </div>
        <div class="col-md-6 text-md-right">
            <div class="text-muted">Nomor Blok</div>
            <strong>{{ $lahan->no_blok }}</strong>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-13">
            <div class="text-muted">Alamat Pemilik</div>
            <strong>
                {{ $lahan->alamat }}
            </strong>
        </div>
        <div class="col-md-12 text-md-center">
            <div class="text-muted">Lokasi Lahan</div>
            <img id="preview-label" class="" style="max-height:230px; max-width: 100%; margin: auto; "
                src="{{ asset('/lokasi/' . $lahan->lokasi) }}" alt="Unsplash">
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
                <td>Luas Lahan</td>
                <td>:</td>
                <td class="text-right">{{ $lahan->luas . ' ha' }}</td>
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
                <td>Label Sumber;</td>
                <td>:</td>
                <td class="text-right">{{ $lahan->label_sumber }}</td>
            </tr>
            <tr>
                <td>Musim Tanam;</td>
                <td>:</td>
                <td class="text-right">{{ $lahan->musim }}</td>
            </tr>
            <tr>
                <td>Tgl. Semai;</td>
                <td>: </td>
                <td class="text-right">{{ \Carbon\Carbon::parse($lahan->semai)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td>Tgl. Tanam;</td>
                <td>: </td>
                <td class="text-right">{{ \Carbon\Carbon::parse($lahan->tanam)->format('d/m/Y') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="text-center">
        <p class="text-sm">
            <strong>Foto Label</strong>
        </p>
        <img id="preview-label" class="" style="max-height:230px; margin: auto; "
            src="{{ asset('/label/' . $lahan->i_label) }}" alt="Unsplash">
        <hr class="my-4" />

        @php
            // $role ="qc";
        @endphp
        @if (isset($role) && $role == 'qc')
            <form id="form_regis"
                action="{{ isset($edit) && $edit ? route('update regis lahan', ['s' => $lahan->id]) : route('post regis lahan') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-row">
                    <div class="form-group col-md-9">
                        <label for="blok">No. Blok</label>
                        <input type="text" class="form-control @error('blok') is-invalid @enderror"
                            value="{{ old('blok', isset($edit) && $edit ? $lahan->no_blok : '') }}" id="blok"
                            name="blok" placeholder="Nomor blok baru...">
                        @error('blok')
                            <div class="jquery-validation-error small form-text invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>
                    <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        @else
            <a href="{{ route('edit lahan', ['s' => $lahan->id]) }}" class="btn btn-outline-primary"><i
                    class="mr-1 fas fa-fw fa-pencil-alt"></i>
                Edit Data
            </a>
        @endif
    </div>
</div>
