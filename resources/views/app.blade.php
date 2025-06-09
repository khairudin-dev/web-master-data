<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:head_link>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
    </x-slot:head_link>

    {{-- start content --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Empty card</h5>
                </div>
                <div class="card-body">
                    <div class="my-5">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
    {{-- end content --}}
</x-layout>
