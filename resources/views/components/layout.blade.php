<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Data Tani - CV. BENTHANY</title>

    <!-- PICK ONE OF THE STYLES BELOW -->
    <link href="{{ asset('css/modern.css') }}" rel="stylesheet">

    <!-- Global site tag (gtag.js) - Google Analytics -->
</head>

<body>
    <div class="splash active">
        <div class="splash-icon"></div>
    </div>

    <div class="wrapper">
        {{-- start sidebar --}}
        <x-sidebar></x-sidebar>
        {{-- end sidebar --}}

        <div class="main">
            {{-- start navbar --}}
            <x-navbar></x-navbar>
            {{-- end navbar --}}

            {{-- start content --}}
            <main class="content">
                <div class="container-fluid">

                    {{-- start header content --}}
                    <x-header>
                        <x-slot:title>{{ $title }}</x-slot:title>
                        <x-slot:head_link>{{ $head_link }}</x-slot:head_link>
                    </x-header>
                    {{-- end header content --}}

                    {{-- start content --}}
                    {{ $slot }}
                    {{-- end content --}}

                </div>
            </main>
            {{-- end content --}}


            {{-- start footer --}}
            <x-footer></x-footer>
            {{-- end footer --}}

        </div>

    </div>
    <div class="modal fade" id="detailahan" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" id="header-body-detailahan">
                    <h5 class="modal-title" id="title_blok">Lahan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body m-3" id="modal-body-detailahan">
                </div>
                <div class="modal-footer"id="footer-body-detailahan">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <svg width="0" height="0" style="position:absolute">
        <defs>
            <symbol viewBox="0 0 512 512" id="ion-ios-pulse-strong">
                <path
                    d="M448 273.001c-21.27 0-39.296 13.999-45.596 32.999h-38.857l-28.361-85.417a15.999 15.999 0 0 0-15.183-10.956c-.112 0-.224 0-.335.004a15.997 15.997 0 0 0-15.049 11.588l-44.484 155.262-52.353-314.108C206.535 54.893 200.333 48 192 48s-13.693 5.776-15.525 13.135L115.496 306H16v31.999h112c7.348 0 13.75-5.003 15.525-12.134l45.368-182.177 51.324 307.94c1.229 7.377 7.397 11.92 14.864 12.344.308.018.614.028.919.028 7.097 0 13.406-3.701 15.381-10.594l49.744-173.617 15.689 47.252A16.001 16.001 0 0 0 352 337.999h51.108C409.973 355.999 427.477 369 448 369c26.511 0 48-22.492 48-49 0-26.509-21.489-46.999-48-46.999z">
                </path>
            </symbol>
        </defs>
    </svg>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        window.flashMessage = {
            success: @json(session('success')),
            error: @json(session('error'))
        };
    </script>
    <script type="text/javascript" src="{{ asset('js/detail.js') }}"></script>
    @stack('sc')
</body>


</html>
