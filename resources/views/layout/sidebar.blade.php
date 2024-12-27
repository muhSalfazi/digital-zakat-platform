<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            {{-- <i class="bi bi-envelope-paper"></i> --}}
            <img src="{{ asset('img/masjid.png') }}" class="img-fluid" alt="masjid"style="max-width: 100px;">

        </div>
        <div class="sidebar-brand-text mx-1">Sistem Zakat</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @if (Auth::user()->role == 'admin')
        <!-- role admin -->
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
    @endif

    @if (Auth::user()->role == 'amil')
        <!-- role amil -->
        <li class="nav-item active">
            <a class="nav-link" href="">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master
    </div>

    @if (Auth::check() && Auth::user()->role == 'admin')
        <!-- role admin -->
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('admin.amil') }}">
                <i class="bi bi-person"></i>
                <span>Amil</span>
            </a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('admin.kategori.index') }}">
                <i class="bi bi-archive"></i>
                <span>Kategori</span>
            </a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('admin.masjid.index') }}">
                <i class="bi bi-buildings-fill"></i>
                <span>Masjid</span>
            </a>
        </li>
    @endif


    @if (Auth::user()->role == 'amil')
        <!-- role amil -->
        <li class="nav-item active">
            <a class="nav-link" href="pembayaran-zakat.html">
                <i class="bi bi-person"></i>
                <span>Pembayaran Zakat</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="muzakki.html">
                <i class="bi bi-person"></i>
                <span>Muzakki</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="penyaluran-zakat.html">
                <i class="bi bi-person"></i>
                <span>Penyaluran Zakat</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="mustahik.html">
                <i class="bi bi-person"></i>
                <span>Mustahik</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="zakat.html">
                <i class="bi bi-person"></i>
                <span>Zakat</span></a>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
