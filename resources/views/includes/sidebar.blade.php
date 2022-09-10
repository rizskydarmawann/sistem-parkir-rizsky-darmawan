<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
    <div class="sidebar-brand-text mx-3">
      Sistem Parkir
    </div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
 @if (auth()->user()->status == 'petugas' || auth()->user()->status == 'admin')
       <li class="nav-item">
    <a class="nav-link" href="/dashboard">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  @endif

  @if (auth()->user()->status == 'petugas')

  <li class="nav-item">
    <a class="nav-link" href="/kendaraanmasuk">
      <i class="fas fa-fw fa-car "></i>
      <span>Kendaraan Masuk</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/kendaraankeluar">
      <i class="fas fa-fw fa-truck"></i>
      <span>List Pakrkir</span></a>
  </li>

  @endif

  @if (auth()->user()->status == 'admin')
  <li class="nav-item">
    <a class="nav-link" href="/laporan">
      <i class="fas fa-fw fa-address-book"></i>
      <span>Laporan</span></a>
  </li>
  @endif



  <hr class="sidebar-divider">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->
