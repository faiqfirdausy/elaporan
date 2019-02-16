<ul class="sidebar-menu tree" data-widget="tree">
  <li class="header">MENU UTAMA</li>
  <li class="treeview">
    <a href="#">
      <i class="fa fa-dashboard"></i> <span>Unggah Laporan</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{ url('laporan/bulanan') }}"><i class="fa fa-circle-o"></i> Bulanan</a></li>
      <li><a href="{{ url('laporan/triwulan') }}"><i class="fa fa-circle-o"></i> Triwulan</a></li>
      <li><a href="{{ url('laporan/semester') }}"><i class="fa fa-circle-o"></i> Semester</a></li>
      <li><a href="{{ url('laporan/tahunan') }}"><i class="fa fa-circle-o"></i> Tahunan</a></li>
      <li><a href="{{ url('laporan/situasional') }}"><i class="fa fa-circle-o"></i> Situasional</a></li>
    </ul>
  </li>
    <li>
    <a href="{{url('laporan/revisi')}}">
      <i class="fa fa-users"></i> <span>Revisi</span>
    </a>
  </li>

  <li>
    <a href="{{url('/user')}}">
      <i class="fa fa-users"></i> <span>Daftar User</span>
    </a>
  </li>
  <li>
    <a href="pages/calendar.html">
      <i class="fa fa-users"></i> <span>WBBK</span>
    </a>
  </li>
</ul>