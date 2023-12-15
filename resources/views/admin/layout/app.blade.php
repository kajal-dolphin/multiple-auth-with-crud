<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layout.head')
</head>

<body class="hold-transition sidebar-mini layout-fixed hold-transition dark-mode layout-navbar-fixed layout-footer-fixed" >
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" alt="AdminLTELogo" height="60" width="60" src="{{ asset('dist/img/AdminLTELogo.png')}}">
        </div>

        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" alt="AdminLTELogo" height="60" width="60" src="{{ asset('dist/img/AdminLTELogo.png')}}">
        </div>

        <!-- Navbar -->
        @include('admin.layout.header')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('admin.layout.sidebaar')

        <!-- Content Wrapper. Contains page content -->
        @yield('content')
    </div>
    <!-- ./wrapper -->

    @include('admin.layout.foot')
</body>

</html>