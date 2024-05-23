<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{route('dasboard.view')}}" class="brand-link">
    <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="{{config('app.name', 'RoyalApps Demo') }}"
      class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">{{config('app.name', 'RoyalApps Demo') }}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        {{-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> --}}
      </div>
      <div class="info">
        <a href="#" class="d-block">
          {{Str::ucfirst((Session::get('user')["first_name"]." ".Session::get('user')["last_name"]))??""}}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item menu-open">
          <a href="{{route('dasboard.view')}}" class="nav-link active">

            <p>
              Dashboard

            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a class="nav-link ">
            <p>
              Author
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item ">
              <a href="{{route('list.author')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>List</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a class="nav-link ">
            <p>
              Book
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('create.book')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Create</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>