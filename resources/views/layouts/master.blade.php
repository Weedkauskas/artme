<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="<?php echo asset('css/app.css')?>" type="text/css">

    @include('parts.styles')
</head>
<!-- END: Head-->

<body>

<div class="logo"></div>

<!--  main content -->
@yield('content')

{{-- vendor scripts and page scripts included --}}
@include('parts.scripts')

</body>

</html>
