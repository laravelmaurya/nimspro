 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4" >
    <!-- Brand Logo -->
     <a href="index3.html" class="brand-link">
      <img src="{{ url($addPublic.'dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ ucfirst(Auth::user()->nims_wp_user_name) }}</span>
    </a> 

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url($addPublic.'/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->nims_wp_user_email }}</a>
          <a href="{{route('signout')}}" class="d-block">logout</a>
        </div>        
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
             <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                
              </p>
            </a>
          </li>
          @can('users-menu')
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Users
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('user-list')
              <li class="nav-item">
                <a href="{{route('users.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Users</p>
                </a>
              </li>
              @endcan 
              @can('user-create')
              <li class="nav-item">
                <a href="{{route('users.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create</p>
                </a>
              </li> 
              @endcan             
            </ul>
          </li>
          @endcan 
          @can('roles-menu')
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Roles
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('role-list')
              <li class="nav-item">
                <a href="{{route('roles.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Roles</p>
                </a>
              </li>
              @endcan 
              @can('role-create')
              <li class="nav-item">
                <a href="{{route('roles.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create</p>
                </a>
              </li> 
              @endcan             
            </ul>
          </li>
          @endcan   
          @can('permissions-menu')
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Permission
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('permission-list')
              <li class="nav-item">
                <a href="{{route('permissions.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Permission</p>
                </a>
              </li>
              @endcan 
              @can('permission-create')
              <li class="nav-item">
                <a href="{{route('permissions.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create</p>
                </a>
              </li> 
              @endcan              
            </ul>
          </li>  
          @endcan        
          @can('settings-menu')
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Settings
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('setting-list')
              <li class="nav-item">
                <a href="{{route('permissions.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Permission</p>
                </a>
              </li>
              @endcan 
              @can('setting-create')
              <li class="nav-item">
                <a href="{{route('permissions.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create</p>
                </a>
              </li> 
              @endcan              
            </ul>
          </li>  
          @endcan 
          @can('tender-menu')
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Tenders
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('tender-list')
              <li class="nav-item">
                <a href="{{route('tenders.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Tender</p>
                </a>
              </li>
              @endcan 
              @can('tender-create')
              <li class="nav-item">                          
                <a href="javacript::void(0)" class="getTenderNumber nav-link" data-toggle="modal" data-target="#create-Corrigendum-modal">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Corrigendum for Tender</p>
                </a>
              </li> 
              @endcan
              @can('tender-list')
              <li class="nav-item">
                <a href="{{route('tenders.list-archive')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Archive</p>
                </a>
              </li>
              @endcan                             
            </ul>
          </li>  
          @endcan                             
          @can('permissions-menu')
            <li class="nav-item">
              {{-- LEVEL 1 --}}
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  Administration
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              {{-- END LEVEL 1 --}}
               {{-- LEVEL 2 --}}
              <ul class="nav nav-treeview">
                @can('permission-list')
                <li class="nav-item">
                  <a href="javascript:void(0);"  class="editBtn2 nav-link" data-title="Members of Governing Council" data-cardtitle="Members of Governing Council" data-modalstype="Show" data-te="aboutus" data-id="governmentc" >
                    <i class="far fa-circle nav-icon"></i>
                    <p>Governing Council</p>
                  </a>
                </li>
                @endcan   

                @can('permission-create')
                <li class="nav-item">
                  <a href="javascript:void(0);" class="editBtn2 nav-link" data-title="Members of Executive Board" data-cardtitle="Members of Executive Board" data-modalstype="Show" data-te="aboutus" data-id="ex_board">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Executive Board</p>
                  </a>
                </li> 
                @endcan   

                @can('permission-create')
                <li class="nav-item">
                  <a href="javascript:void(0);" class="editBtn2 nav-link" data-title="Members of Finance Committee" data-cardtitle="Members of Finance Committee" data-modalstype="Show" data-te="aboutus" data-id="finance">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Finance Committee</p>
                  </a>
                </li> 
                @endcan

                @can('permission-create')
                <li class="nav-item">
                  <a href="javascript:void(0);" class="editBtn2 nav-link" data-title="Members of Academic Council" data-cardtitle="Members of Academic Council" data-modalstype="Show" data-te="aboutus" data-id="acadamiccouncil">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Academic Council</p>
                  </a>
                </li> 
                @endcan

                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Director
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  {{-- LEVEL 3 --}}
                  <ul class="nav nav-treeview">
                    @can('permission-create')
                    <li class="nav-item">
                      <a href="javascript:void(0);" class="editBtn2 nav-link" data-title="About Director" data-cardtitle="About Director" data-modalstype="Show" data-te="director" data-id="about">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>About Director</p>
                      </a>
                    </li> 
                    @endcan 
                    @can('permission-create')
                    <li class="nav-item">
                      <a href="javascript:void(0);" class="editBtn2 nav-link" data-title="Overview" data-cardtitle="Overview" data-modalstype="Show" data-te="director" data-id="office">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Overview</p>
                      </a>
                    </li> 
                    @endcan 
                    @can('permission-create')
                    <li class="nav-item">
                      <a href="javascript:void(0);" class="editBtn2 nav-link" data-title="Ex-Directors" data-cardtitle="Ex-Directors" data-modalstype="Show" data-te="director" data-id="exdirector">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Ex-Directors</p>
                      </a>
                    </li> 
                    @endcan 
                                     
                  </ul>
                  {{-- END LEVEL 3 --}}
                </li>
                
              </ul>
               {{-- END LEVEL 2 --}}
            </li>
            @endcan                               
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>