<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{route('dashboard')}}">Dashboard</a></li>
            @switch(request()->path())
              @case("dashboard")
                </ol>
                <h6 class="font-weight-bolder mb-0">Dashboard</h6>
                @break
              @case("dashboard/bills")
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Danh sách hóa đơn</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Danh sách hóa đơn</h6>
                @break
              @case("dashboard/bill/add")
                <li class="breadcrumb-item text-sm text-dark" aria-current="page">
                  <a class="opacity-5 text-dark" href="{{route('bills')}}">Danh sách hóa đơn</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Thêm hóa đơn</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Thêm hóa đơn</h6>
                @break
              @case("dashboard/bill/1/edit")
                <li class="breadcrumb-item text-sm text-dark" aria-current="page">
                  <a class="opacity-5 text-dark" href="{{route('bills')}}">Danh sách hóa đơn</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Sửa hóa đơn</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Sửa hóa đơn</h6>
                @break
              @case("dashboard/analysis")
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Test API</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Test API</h6>
                @break
              @default   
            @endswitch
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Type here...">
            </div>
          </div>
          <ul class="navbar-nav justify-content-end">
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">{{$user->name}}</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="text-center">
                  <a class="" href="{{route('logout')}}">Logout</a>
                </li>
              </ul>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link p-0 text-body" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->