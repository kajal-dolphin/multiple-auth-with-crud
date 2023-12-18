<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layout.head')
</head>

<body class="hold-transition sidebar-mini layout-fixed hold-transition layout-navbar-fixed layout-footer-fixed" >
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" alt="AdminLTELogo" height="60" width="60" src="{{ asset('dist/img/AdminLTELogo.png')}}">
        </div>

        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" alt="AdminLTELogo" height="60" width="60" src="{{ asset('dist/img/AdminLTELogo.png')}}">
        </div>
        @include('admin.layout.header')
        @include('admin.layout.sidebaar')
        @yield('content')
    </div>
</body>
    @include('admin.layout.foot')
    @yield('scripts')
</html>
