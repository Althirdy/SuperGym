<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>GymBilog</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">

    {{-- Style --}}
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/ajax.js','resources/js/Qr.js'])

</head>

<body class="font-[Roboto] bg-[#F8F9FE] relative ">
    @include('Dashboard_Comp.Sidebar')









    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script type="text/javascript" src="{{ url('js/JsQrSCanner/jsqrscanner.nocache.js') }}"></script>
    <script>
        // Define global JavaScript variables containing session data
        var count_member_log = {!! json_encode(session('count_member_log')) !!};
        var count_daily_log = {!! json_encode(session('count_daily_log')) !!};
    </script>

</body>

</html>
