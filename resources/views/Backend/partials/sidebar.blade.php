<ul class="navbar-nav bg-gradient-custom sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ URL::to('/dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-database"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SP Dempster Shafer</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ $navLink == 'dashboard' ? 'active' : '' }}">
        <a class="nav-link" href="{{ URL::to('/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master Data
    </div>

    <!-- Nav Item - Data Penyakit -->
    <li class="nav-item {{ $navLink == 'data-penyakit' ? 'active' : '' }}">
        <a class="nav-link" href="{{ URL::to('/data-penyakit') }}">
            <i class="fas fa-virus"></i>
            <span>Data Penyakit</span></a>
    </li>

    <!-- Nav Item - Data Gejala -->
    <li class="nav-item {{ $navLink == 'data-gejala' ? 'active' : '' }}">
        <a class="nav-link" href="{{ URL::to('/data-gejala') }}">
            <i class="fas fa-notes-medical"></i>
            <span>Data Gejala</span></a>
    </li>

    <!-- Nav Item - Data Basis Pengetahuan -->
    <li class="nav-item {{ $navLink == 'data-basis-pengetahuan' ? 'active' : '' }}">
        <a class="nav-link" href="{{ URL::to('/data-basis-pengetahuan') }}">
            <i class="fas fa-laptop-medical"></i>
            <span>Data Basis Pengetahuan</span></a>
    </li>

    <!-- Nav Item - Data Riwayat -->
    <li class="nav-item {{ $navLink == 'data-riwayat' ? 'active' : '' }}">
        <a class="nav-link" href="{{ URL::to('/data-riwayat') }}">
            <i class="fas fa-history"></i>
            <span>Data Riwayat</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
