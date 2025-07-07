<div class="m-sm-1 m-md-2">
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="text-muted">Nomor Blok</div>
            <strong>{{ $lahan->no_blok }}</strong>
            @if ($lahan->lapang != '')
                <div class="text-muted">Nomor Lapang</div>
                <strong>
                    {{ $lahan->lapang }}
                </strong>
            @endif
        </div>
        <div class="col-md-6 text-md-right">
            <div class="text-muted">Nama Koordinator</div>
            <strong>{{ $lahan->nama }}</strong>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="text-muted">Alamat Koordinator</div>
            <strong>
                {{ $lahan->alamat }}
            </strong>
        </div>
        <div class="col-md-12 text-center">
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
                <td>Label Sumber</td>
                <td>:</td>
                <td class="text-right">{{ $lahan->label_sumber }}</td>
            </tr>
            <tr>
                <td>Musim Tanam</td>
                <td>:</td>
                <td class="text-right">{{ $lahan->musim }}</td>
            </tr>
            <tr>
                <td>Tanggal Semai</td>
                <td>: </td>
                <td class="text-right">{{ \Carbon\Carbon::parse($lahan->semai)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td>Tanggal Tanam</td>
                <td>: </td>
                <td class="text-right">{{ \Carbon\Carbon::parse($lahan->tanam)->format('d/m/Y') }}</td>
            </tr>
        </tbody>
    </table>
    <div class="row mb-4">
        <div class="col-md-12 text-center">
            <div class="text-muted">Foto Label</div>
            <img id="preview-label" class="" style="max-height:230px; max-width: 100%; margin: auto; "
                src="{{ asset('/label/' . $lahan->i_label) }}" alt="Unsplash">
        </div>
        <div class="col-md-12 text-center">
            <div class="text-muted">Dokumen Permohonan</div>
            <iframe id="preview-pdf" style="width: 100%; height: 500px;"
                frameborder="0"
                src="{{ asset('/permohonan/' . $lahan->permohonan) }}"></iframe>

        </div>
    </div>

    @if (auth()->user()->role == 'produksi' or auth()->user()->role == 'superadmin')
        <div class="text-center">
            <a href="{{ route('edit lahan', ['s' => $lahan->id]) }}" class="btn btn-outline-primary"><i
                    class="mr-1 fas fa-fw fa-pencil-alt"></i>
                Edit Data
            </a>
        </div>
    @endif
</div>
