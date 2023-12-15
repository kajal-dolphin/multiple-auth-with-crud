<!DOCTYPE html>
<html lang="en">
    <head>
        @include('front.layout.head')
    </head>

    <body class="index-page" data-bs-spy="scroll" data-bs-target="#navmenu">
        @yield('content')
        @include('front.layout.foot')
    </body>
</html>