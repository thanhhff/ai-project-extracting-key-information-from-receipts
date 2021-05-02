<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-left ms-3" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute right-0 top-0 d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="{{route('home')}}">
        <img src="{{asset('./assets/favicon.png')}}" class="navbar-brand-img h-100 w-15" alt="...">
        <span class="ms-1 font-weight-bold">Manager Systems</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{request()->is('dashboard') ? 'active' : ''}}" href="{{route('dashboard')}}">
            <i class="fas fa-chart-pie"></i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{request()->is('dashboard/bills') 
            || request()->is('dashboard/bill/add') || request()->is('dashboard/bill/*/edit') ? 'active' : ''}}" href="{{route('bills')}}">
            <i class="fa fa-receipt"></i>
            <span class="nav-link-text ms-1">Danh sách hóa đơn</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{request()->is('dashboard/analysis') ? 'active' : ''}}" href="{{route('analysis')}}">
            <i class="fas fa-paperclip"></i>
            <span class="nav-link-text ms-1">Test api</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>