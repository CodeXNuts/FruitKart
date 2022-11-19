<x-seller.app-layout>
    <x-slot name="addOnCss">
        <link rel="stylesheet" href="{{ asset('buyer/css/seller-list.css') }}">
    </x-slot>
    <div class="container">
        <div class="main-body">

            <!-- Breadcrumb -->
           @include('layouts.buyer.nav-sec')
            <!-- /Breadcrumb -->

            <x-buyer.seller-list-sec />

        </div>
    </div>
    <x-slot name="addOnJs"></x-slot>
</x-seller.app-layout>
