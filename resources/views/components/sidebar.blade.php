<nav id="sidebar" class="sidebar">
    <a class="sidebar-brand" href="/">
        <svg>
            <use xlink:href="#ion-ios-pulse-strong"></use>
        </svg>
        Spark
    </a>
    <div class="sidebar-content">
        <div class="sidebar-user">
            {{-- <img src="img/avatars/avatar.jpg" class="img-fluid rounded-circle mb-2" alt="Linda Miller" /> --}}
            <div class="font-weight-bold">{{ auth()->user()->name }}</div>
            <small>{{ auth()->user()->role }}</small>
        </div>

        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a class="sidebar-link" href="/">
                    <i class="align-middle mr-2 fas fa-fw fa-home"></i> <span class="align-middle">Dashboards</span>

                </a>
            </li>
            @if (auth()->user()->role == 'produksi')
                <li class="sidebar-header">
                    Kelola Data (Produksi)
                </li>
                <li class="sidebar-item">
                    <a href="#Lahan" data-toggle="collapse" class="sidebar-link collapsed">
                        <i class="align-middle mr-2 fas fa-fw fa-file"></i> <span class="align-middle">Lahan</span>
                    </a>
                    <ul id="Lahan" class="sidebar-dropdown list-unstyled collapse" data-parent="#sidebar">
                        <li class="sidebar-item"><a class="sidebar-link" href="{{ route('regis lahan') }}">Registrasi
                                Lahan</a>
                        </li>
                        <li class="sidebar-item"><a class="sidebar-link" href="{{ route('lahan') }}">Daftar Lahan</a>
                        </li>
                    </ul>
                </li>
            @endif

            @if (auth()->user()->role == 'qc')
                <li class="sidebar-header">
                    Kelola Data
                </li>
                <li class="sidebar-item">
                    <a href="#pages" data-toggle="collapse" class="sidebar-link collapsed">
                        <i class="align-middle mr-2 fas fa-fw fa-file"></i> <span class="align-middle">Lahan</span>
                    </a>
                    <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-parent="#sidebar">
                        <li class="sidebar-item"><a class="sidebar-link" href="{{ route('regis lapang') }}">Registrasi
                                No.
                                Lapangan</a>
                        </li>
                        <li class="sidebar-item"><a class="sidebar-link" href="{{ route('lapang') }}"">Daftar No.
                                Lapangan</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#Pemantauan" data-toggle="collapse" class="sidebar-link collapsed">
                        <i class="align-middle mr-2 fas fa-fw fa-file"></i> <span class="align-middle">Pemantauan</span>
                    </a>
                    <ul id="Pemantauan" class="sidebar-dropdown list-unstyled collapse" data-parent="#sidebar">
                        <li class="sidebar-item"><a class="sidebar-link" href="pages-settings.html">Input Hasil
                                Pemantauan</a>
                        </li>
                        <li class="sidebar-item"><a class="sidebar-link" href="pages-clients.html">Daftar Hasil
                                Pemantauan</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#Panen" data-toggle="collapse" class="sidebar-link collapsed">
                        <i class="align-middle mr-2 fas fa-fw fa-file"></i> <span class="align-middle">Panen</span>
                    </a>
                    <ul id="Panen" class="sidebar-dropdown list-unstyled collapse" data-parent="#sidebar">
                        <li class="sidebar-item"><a class="sidebar-link" href="pages-settings.html">Input Hasil
                                Panen</a>
                        </li>
                        <li class="sidebar-item"><a class="sidebar-link" href="pages-clients.html">Daftar Hasil
                                Panen</a>
                        </li>
                    </ul>
                </li>
            @endif

            @if (auth()->user()->role == 'procesing')
                <li class="sidebar-header">
                    Kelola Data (Prosesing)
                </li>
                <li class="sidebar-item">
                    <a href="#Proses" data-toggle="collapse" class="sidebar-link collapsed">
                        <i class="align-middle mr-2 fas fa-fw fa-file"></i> <span class="align-middle">Prosesing</span>
                    </a>
                    <ul id="Proses" class="sidebar-dropdown list-unstyled collapse" data-parent="#sidebar">
                        <li class="sidebar-item"><a class="sidebar-link" href="pages-settings.html">Input Hasil
                                Proses</a>
                        </li>
                        <li class="sidebar-item"><a class="sidebar-link" href="pages-clients.html">Daftar Hasil
                                Proses</a>
                        </li>
                    </ul>
                </li>
            @endif
            @if (auth()->user()->role == 'analis')
                <li class="sidebar-header">
                    Kelola Data (Analis)
                </li>
                <li class="sidebar-item">
                    <a href="#Laboratorium" data-toggle="collapse" class="sidebar-link collapsed">
                        <i class="align-middle mr-2 fas fa-fw fa-file"></i> <span class="align-middle">Uji
                            Laboratorium</span>
                    </a>
                    <ul id="Laboratorium" class="sidebar-dropdown list-unstyled collapse" data-parent="#sidebar">
                        <li class="sidebar-item"><a class="sidebar-link" href="pages-settings.html">Input Hasil
                                Uji</a>
                        </li>
                        <li class="sidebar-item"><a class="sidebar-link" href="pages-clients.html">Daftar Hasil
                                Uji</a>
                        </li>
                    </ul>
                </li>
            @endif


            @if (auth()->user()->role == 'marketing')
                <li class="sidebar-header">
                    Kelola Data (Marketing)
                </li>
                <li class="sidebar-item">
                    <a href="#Distribusi" data-toggle="collapse" class="sidebar-link collapsed">
                        <i class="align-middle mr-2 fas fa-fw fa-file"></i> <span class="align-middle">Distribusi
                            Benih</span>
                    </a>
                    <ul id="Distribusi" class="sidebar-dropdown list-unstyled collapse" data-parent="#sidebar">
                        <li class="sidebar-item"><a class="sidebar-link" href="pages-settings.html">Input
                                Distribusi</a>
                        </li>
                        <li class="sidebar-item"><a class="sidebar-link" href="pages-clients.html">Daftar
                                Distribusi</a>
                        </li>
                    </ul>
                </li>
            @endif

        </ul>
    </div>
</nav>
