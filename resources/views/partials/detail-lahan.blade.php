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
        <div class="col-md-6">
            <div class="text-muted">Alamat Pemilik</div>
            <strong>
                {{ $lahan->alamat_parts[0] }}
            </strong>
            <p>
                {{ $lahan->alamat_parts[1] }}<br>
                {{ 'Kecamatan ' . $lahan->alamat_parts[2] }}<br>
                {{ $lahan->alamat_parts[3] }}<br>
                {{ 'Provinsi ' . $lahan->alamat_parts[4] }}<br>
            </p>
        </div>
        <div class="col-md-6 text-md-right">
            <div class="text-muted">Lokasi Lahan</div>
            <strong>
                {{ $lahan->lokasi_parts[0] }}
            </strong>
            <p>
                {{ $lahan->lokasi_parts[1] }}<br>
                {{ 'Kecamatan ' . $lahan->lokasi_parts[2] }}<br>
                {{ $lahan->lokasi_parts[3] }}<br>
                {{ 'Provinsi ' . $lahan->lokasi_parts[4] }}<br>
            </p>
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
        <a href="{{ route('edit lahan', ['s'=> $lahan->id]) }}" class="btn btn-outline-primary"><i class="mr-1 fas fa-fw fa-pencil-alt"></i>
            Edit Data
        </a>
    </div>
</div>
