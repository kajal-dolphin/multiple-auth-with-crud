<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container-fluid d-flex align-items-center justify-content-between">

        <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">

            <h1>Laravel</h1>
            <span>.</span>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="index.html#hero" class="active">Home</a></li>
                <li><a href="index.html#about">About</a></li>
                <li><a href="index.html#services">Services</a></li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="index.html#contact">Contact</a></li>
            </ul>

            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
        @if(Auth::guard('user')->check())
            <a class="btn-getstarted" href="{{ route('user.logout')}}">Logout</a>
        @else
            <a class="btn-getstarted" href="{{ route('user.show.login.page')}}">Login Here</a>
        @endif
    </div>
</header>