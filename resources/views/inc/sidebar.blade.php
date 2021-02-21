<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <span class="brand-text font-weight-light">{{config('app.name', 'Blog')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image text-white">
                <i class="fas fa-user-circle fa-2x mt-2 img-circle elevation-2" alt="User Image"></i>
            </div>
            <div class="info">
                @if(Auth::user() != null)
                    <a href="{{ route('dashboard') }}" class="d-block">
                        {{Auth::user()->name}}
                    </a>
                    <small class="text-white"><i class="fas fa-circle text-success"></i>&nbsp;Online</small>
                @endif
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2 sidebarmenu">
            @if(Auth::user()->type==1)
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">MAIN NAVIGATION</li>
                <li class="nav-item">
                    <router-link to="/dashboard" class="nav-link">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>Dashboard</p>
                    </router-link>
                </li> 
                <li class="nav-item">
                    <router-link to="/posts" class="nav-link">
                      <i class="nav-icon fas fa-blog"></i>
                      <p>Posts</p>
                    </router-link>
                </li> 
                <li class="nav-item">
                    <router-link to="/users" class="nav-link">
                      <i class="nav-icon fas fa-users"></i>
                      <p>Users</p>
                    </router-link>
                </li> 
                <li class="nav-item">
                    <router-link to="/feedbacks" class="nav-link">
                      <i class="nav-icon fas fa-envelope"></i>
                      <p>Messages</p>
                    </router-link>
                </li> 

                <li class="nav-header">APPLICATION SETTINGS</li>
                <li class="nav-item">
                  <a href="{{ route('logout') }}" class="nav-link"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="nav-icon fas fa-power-off"></i>
                    <p>Logout</p></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>                   
                </li>           
            </ul>
            @else 
                <script type="text/javascript">
                    window.location = "{{ url('/home') }}";//here double curly bracket
                </script>
            @endif
        </nav>
        <!-- /.Sidebar Menu -->

    </div>
    <!-- /.Sidebar -->
    
</aside>
<!-- ./Main Sidebar Container -->
