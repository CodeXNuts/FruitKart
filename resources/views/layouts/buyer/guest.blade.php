<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FruitKart') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    @include('layouts.common.common-css')
    {{ $addOnCss }}
</head>

<body>
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>
    @include('layouts.common.common-js')
    {{ $addOnJs }}

    {{-- Show common toast notification --}}
    @if (session()->has('success'))
        <script type="text/javascript">
            Toast.fire({
                icon: 'success',
                title: "{!! session('success') !!}"
            })
        </script>
    @endif
    @if (session()->has('fail'))
        <script type="text/javascript">
            Toast.fire({
                icon: 'error',
                title: "{!! session('fail') !!}"
            })
        </script>
    @endif
</body>

</html>
