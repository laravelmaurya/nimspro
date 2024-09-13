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
                    Notifications
                  <i class="right fas fa-angle-left"></i>
              </p>
              </a>
              {{-- END LEVEL 1 --}}
              {{-- LEVEL 2 --}}
              <ul class="nav nav-treeview">                            
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        Admissions
                          <i class="right fas fa-angle-left"></i>
                      </p>
                      </a>
                      {{-- LEVEL 3 --}}
                      <ul class="nav nav-treeview">
                        @can('tender-list')
                        <li class="nav-item">
                          <a href="{{route('admissions.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Admissions</p>
                          </a>
                        </li>
                        @endcan  
                        
                        @can('tender-list')
                        <li class="nav-item">
                          <a href="{{route('admissions.list-archive')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Archive</p>
                          </a>
                        </li>
                        @endcan                                              
                      </ul>
                      {{-- END LEVEL 3 --}}
                  </li>              
              </ul>
              {{-- END LEVEL 2 --}}
              {{-- LEVEL 2 --}}
              <ul class="nav nav-treeview">                            
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        Examination(Exit)
                          <i class="right fas fa-angle-left"></i>
                      </p>
                      </a>
                      {{-- LEVEL 3 --}}
                      <ul class="nav nav-treeview">
                        @can('tender-list')
                        <li class="nav-item">
                          <a href="{{route('examinations.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Examination(Exit)</p>
                          </a>
                        </li>
                        @endcan  
                       
                        @can('tender-list')
                        <li class="nav-item">
                          <a href="{{route('examinations.list-archive')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Archive</p>
                          </a>
                        </li>
                        @endcan                                              
                      </ul>
                      {{-- END LEVEL 3 --}}
                  </li>              
              </ul>
              {{-- END LEVEL 2 --}}
              {{-- LEVEL 2 --}}
              <ul class="nav nav-treeview">                            
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        Recruitment
                          <i class="right fas fa-angle-left"></i>
                      </p>
                      </a>
                      {{-- LEVEL 3 --}}
                      <ul class="nav nav-treeview">
                        @can('tender-list')
                        <li class="nav-item">
                          <a href="{{route('recruitments.index')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Recruitment</p>
                          </a>
                        </li>
                        @endcan  
                       
                        @can('tender-list')
                        <li class="nav-item">
                          <a href="{{route('recruitments.list-archive')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Archive</p>
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

                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Dean
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  {{-- LEVEL 3 --}}
                  <ul class="nav nav-treeview">
                    @can('permission-create')
                    <li class="nav-item">
                      <a href="javascript:void(0);" class="editBtn2 nav-link" data-title="About Dean" data-cardtitle="About Dean" data-modalstype="Show" data-te="dean" data-id="about">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>About Dean</p>
                      </a>
                    </li> 
                    @endcan 
                    @can('permission-create')
                    <li class="nav-item">
                      <a href="javascript:void(0);" class="editBtn2 nav-link" data-title="Overview" data-cardtitle="Overview" data-modalstype="Show" data-te="dean" data-id="office">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Overview</p>
                      </a>
                    </li> 
                    @endcan 
                    @can('permission-create')
                    <li class="nav-item">
                      <a href="javascript:void(0);" class="editBtn2 nav-link" data-title="Ex-Dean" data-cardtitle="Ex-Dean" data-modalstype="Show" data-te="dean" data-id="exdean">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Ex-Dean</p>
                      </a>
                    </li> 
                    @endcan                                          
                  </ul>
                  {{-- END LEVEL 3 --}}
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Executive Registrar
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  {{-- LEVEL 3 --}}
                  <ul class="nav nav-treeview">
                    @can('permission-create')
                    <li class="nav-item">
                      <a href="javascript:void(0);" class="editBtn2 nav-link" data-title="About Executive Registrar" data-cardtitle="About Executive Registrar" data-modalstype="Show" data-te="executive_registrar" data-id="about">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>About Executive Registrar</p>
                      </a>
                    </li> 
                    @endcan 
                    @can('permission-create')
                    <li class="nav-item">
                      <a href="javascript:void(0);" class="editBtn2 nav-link" data-title="Overview" data-cardtitle="Overview" data-modalstype="Show" data-te="executive_registrar" data-id="office">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Overview</p>
                      </a>
                    </li> 
                    @endcan 
                    @can('permission-create')
                    <li class="nav-item">
                      <a href="javascript:void(0);" class="editBtn2 nav-link" data-title="Ex-Executive Registrar" data-cardtitle="Ex-Executive Registrar" data-modalstype="Show" data-te="executive_registrar" data-id="ex_executive_registrar">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Ex-Executive Registrars</p>
                      </a>
                    </li> 
                    @endcan                                          
                  </ul>
                  {{-- END LEVEL 3 --}}
                  
                  
                </li>
                  {{-- END LEVEL 3 --}}
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Medical Superintendent
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  {{-- LEVEL 3 --}}
                  <ul class="nav nav-treeview">
                    @can('permission-create')
                    <li class="nav-item">
                      <a href="javascript:void(0);" class="editBtn2 nav-link" data-title="About Medical Superintendent" data-cardtitle="About Medical Superintendent" data-modalstype="Show" data-te="medical_superintendent" data-id="about">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>About Executive Registrar</p>
                      </a>
                    </li> 
                    @endcan 
                    @can('permission-create')
                    <li class="nav-item">
                      <a href="javascript:void(0);" class="editBtn2 nav-link" data-title="Overview" data-cardtitle="Overview" data-modalstype="Show" data-te="medical_superintendent" data-id="office">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Overview</p>
                      </a>
                    </li> 
                    @endcan 
                    @can('permission-create')
                    <li class="nav-item">
                      <a href="javascript:void(0);" class="editBtn2 nav-link" data-title="Ex-Medical Superintendent" data-cardtitle="Ex-Medical Superintendent" data-modalstype="Show" data-te="medical_superintendent" data-id="exms">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Ex-Medical Superintendent</p>
                      </a>
                    </li> 
                    @endcan                                          
                  </ul>
                  {{-- END LEVEL 3 --}}
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    NIMS Act 1989
                      <i class="right fas fa-angle-left"></i>
                  </p>
                  </a>
                  {{-- LEVEL 3 --}}
                  <ul class="nav nav-treeview">
                  @can('permission-create')
                  <li class="nav-item">
                      <a href="javascript:void(0);" class="ShowModalFileUpload nav-link" data-title="Document - NIMS ACT 1989" data-cardtitle="Document  - NIMS ACT 1989" data-modalstype="Show" data-te="research_documents" data-id="act">
                      <i class="fas fa-pencil-alt nav-icon"></i>
                      <p> View / Edit</p>
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
            
            @can('permissions-menu')
            <li class="nav-item">
              {{-- LEVEL 1 --}}
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  Hospital Services
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              {{-- END LEVEL 1 --}}
               {{-- LEVEL 2 --}}
              <ul class="nav nav-treeview">
                @can('permission-list')
                <li class="nav-item">
                  <a href="javascript:void(0);" class="editBtn2 nav-link" data-title="Emergency Services" data-cardtitle="Emergency Services" data-modalstype="Show" data-te="emergency" data-id="hos_eme" >
                    <i class="far fa-circle nav-icon"></i>
                    <p>Emergency Services</p>
                  </a>
                </li>
                @endcan                                                  
                @can('permission-list')
                <li class="nav-item">
                  <a href="javascript:void(0);"  id="morningService" class="nav-link" data-title="Morning Out Patient Services" data-cardtitle="Morning Out Patient Services" data-modalstype="Show" data-te="hospital_services" data-id="morning_service_pendingmenu" >
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pending Morning Out Patient Services</p>
                  </a>
                </li>
                @endcan                                                  
                @can('permission-list')
                <li class="nav-item">
                  <a href="javascript:void(0);"  id="morningService" class="nav-link" data-title="Morning Out Patient Services" data-cardtitle="Morning Out Patient Services" data-modalstype="Show" data-te="hospital_services" data-id="morning_service_pendingmenu" >
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pending Evening Out Patient Services (Special Clinics)</p>
                  </a>
                </li>
                @endcan   
                @can('permission-list')
                <li class="nav-item">
                  <a href="javascript:void(0);"  class="editBtn2 nav-link" data-title="In Patient Services" data-cardtitle="In Patient Services" data-modalstype="Show" data-te="hospital_services" data-id="in_patient" >
                    <i class="far fa-circle nav-icon"></i>
                    <p>In Patient Services</p>
                  </a>
                </li>
                @endcan                                                   
                @can('permission-list')
                <li class="nav-item">
                  <a href="javascript:void(0);"  class="editBtn2 nav-link" data-title="Holidays during the Year @php echo date('Y') @endphp" data-cardtitle="Holidays during the Year @php echo date('Y')@endphp " data-modalstype="Show" data-te="hospital_services" data-id="general_holidays" >
                    <i class="far fa-circle nav-icon"></i>
                    <p>General Holidays (OP/ OT)</p>
                  </a>
                </li>
                @endcan                                                   
                @can('permission-list')
                <li class="nav-item">
                  <a href="javascript:void(0);"  class="editBtn2 nav-link" data-title="Mobile Numbers" data-cardtitle="Mobile Numbers" data-modalstype="Show" data-te="hospital_services" data-id="mobile_numbers" >
                    <i class="far fa-circle nav-icon"></i>
                    <p>Internal Phone Numbers</p>
                  </a>
                </li>
                @endcan                                                   
                @can('permission-list')
                <li class="nav-item">
                  <a href="javascript:void(0);"  class="editBtn2 nav-link" data-title="Mobile Numbers" data-cardtitle="Mobile Numbers" data-modalstype="Show" data-te="hospital_services" data-id="pendingmenu" >
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pending Bed Availability</p>
                  </a>
                </li>
                @endcan                                                   
                @can('permission-list')
                <li class="nav-item">
                  <a href="javascript:void(0);"  class="editBtn2 nav-link" data-title="Master Health Checkup" data-cardtitle="Master Health Checkup" data-modalstype="Show" data-te="master_health" data-id="master" >
                    <i class="far fa-circle nav-icon"></i>
                    <p>Master Health Checkup</p>
                  </a>
                </li>
                @endcan                                                   
              </ul>
               {{-- END LEVEL 2 --}}
            </li>
            @endcan 
            @can('permissions-menu')
              <li class="nav-item">
                  {{-- LEVEL 1 --}}
                  <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-circle"></i>
                  <p>
                    Academic
                      <i class="right fas fa-angle-left"></i>
                  </p>
                  </a>
                  {{-- END LEVEL 1 --}}
                  {{-- LEVEL 2 --}}
                  <ul class="nav nav-treeview">                                    
                      <li class="nav-item">
                          <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>
                            Academic Section
                              <i class="right fas fa-angle-left"></i>
                          </p>
                          </a>
                          {{-- LEVEL 3 --}}
                          <ul class="nav nav-treeview">
                          @can('permission-create')
                          <li class="nav-item">
                              <a href="javascript:void(0);" class="editBtn2 nav-link" data-title="Academic Section I" data-cardtitle="Academic Section I" data-modalstype="Show" data-te="academicsection" data-id="academicsection1">
                              <i class="far fa-dot-circle nav-icon"></i>
                              <p>About Academic Activities</p>
                              </a>
                          </li> 
                          @endcan 
                          @can('permission-create')
                          <li class="nav-item">
                              <a href="javascript:void(0);" class="editBtn2 nav-link" data-title="Academic Section II" data-cardtitle="Academic Section II" data-modalstype="Show" data-te="academicsection" data-id="academicsection2">
                              <i class="far fa-dot-circle nav-icon"></i>
                              <p>Academic Section II</p>
                              </a>
                          </li> 
                          @endcan                                               
                          </ul>
                          {{-- END LEVEL 3 --}}
                      </li>                  
                  </ul>
                  {{-- END LEVEL 2 --}}
                  {{-- LEVEL 2 --}}
                  <ul class="nav nav-treeview">                                    
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                          Courses Offered
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                                      {{-- END LEVEL 1 --}}
                {{-- LEVEL 2 --}}
                <ul class="nav nav-treeview">                                    
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                          Medical
                          <i class="right fas fa-angle-left"></i>
                      </p>
                      </a>
                      {{-- LEVEL 3 --}}
                      <ul class="nav nav-treeview">
                      @can('permission-create')
                      <li class="nav-item">
                          <a href="javascript:void(0);" class="editBtn2 nav-link" data-title="Broad Speciality MD / MS Courses (Post MBBS)" data-cardtitle="Broad Speciality MD / MS Courses (Post MBBS)" data-modalstype="Show" data-te="academic" data-id="medical_broadspeciality">
                          <i class="far fa-dot-circle nav-icon"></i>
                          <p>Broad Speciality MD / MS</p>
                          </a>
                      </li> 
                      @endcan 
                      @can('permission-create')
                      <li class="nav-item">
                          <a href="javascript:void(0);" class="editBtn2 nav-link" data-title="Broad Speciality DNB Courses" data-cardtitle="Broad Speciality DNB Courses" data-modalstype="Show" data-te="emergency" data-id="broadspeciality_dnb">
                          <i class="far fa-dot-circle nav-icon"></i>
                          <p>Broad Speciality (DNB)</p>
                          </a>
                      </li> 
                      @endcan                                                                     
                      @can('permission-create')
                      <li class="nav-item">
                          <a href="javascript:void(0);" class="editBtn2 nav-link" data-title="Super Speciality D.M. / M.Ch Courses" data-cardtitle="Super Speciality D.M. / M.Ch Courses" data-modalstype="Show" data-te="academic" data-id="medical_superspeciality">
                          <i class="far fa-dot-circle nav-icon"></i>
                          <p>Super Speciality (DM/ MCh)</p>
                          </a>
                      </li> 
                      @endcan                                                                     
                      @can('permission-create')
                      <li class="nav-item">
                          <a href="javascript:void(0);" class="editBtn2 nav-link" data-title="Super Speciality DNB Courses" data-cardtitle="Super Speciality DNB Courses" data-modalstype="Show" data-te="emergency" data-id="superspeciality_dnb">
                          <i class="far fa-dot-circle nav-icon"></i>
                          <p>Super Speciality (DNB)</p>
                          </a>
                      </li> 
                      @endcan                                                                     
                      @can('permission-create')
                      <li class="nav-item">
                          <a href="javascript:void(0);" class="editBtn2 nav-link" data-title="Post Graduate Diploma in Clinical Research (Part Time)" data-cardtitle="Post Graduate Diploma in Clinical Research (Part Time)" data-modalstype="Show" data-te="academic" data-id="medical_pgdiploma">
                          <i class="far fa-dot-circle nav-icon"></i>
                          <p>PG Diploma in Clinical Research (Part time)</p>
                          </a>
                      </li> 
                      @endcan                                                                     
                      </ul>
                      {{-- END LEVEL 3 --}}
                  </li>                  
              </ul>
              {{-- END LEVEL 2 --}}
                      {{-- LEVEL 2 --}}
                      <ul class="nav nav-treeview">                                    
                      <li class="nav-item">
                          <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>
                              Nursing
                              <i class="right fas fa-angle-left"></i>
                          </p>
                          </a>
                          {{-- LEVEL 3 --}}
                          <ul class="nav nav-treeview">
                          @can('permission-create')
                          <li class="nav-item">
                              <a href="javascript:void(0);" class="editBtn2 nav-link" data-title="Bachelor of Science (Nursing)" data-cardtitle="Bachelor of Science (Nursing)" data-modalstype="Show" data-te="academic" data-id="nursing_bsc">
                              <i class="far fa-dot-circle nav-icon"></i>
                              <p>Bachelor of Science (B.Sc.) Nursing</p>
                              </a>
                          </li> 
                          @endcan 
                          @can('permission-create')
                          <li class="nav-item">
                              <a href="javascript:void(0);" class="editBtn2 nav-link" data-title="Master of Science(Nursing)" data-cardtitle="Master of Science(Nursing)" data-modalstype="Show" data-te="academic" data-id="nursing_msc">
                              <i class="far fa-dot-circle nav-icon"></i>
                              <p>Master of Science (M.Sc.) Nursing</p>
                              </a>
                          </li> 
                          @endcan                                                                                                                                                                
                          </ul>
                          {{-- END LEVEL 3 --}}
                      </li>                  
                      </ul>
                       {{-- END LEVEL 2 --}}
                        {{-- LEVEL 2 --}}
               <ul class="nav nav-treeview">                                    
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Physiotherapy
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    {{-- LEVEL 3 --}}
                    <ul class="nav nav-treeview">
                    @can('permission-create')
                    <li class="nav-item">
                        <a href="javascript:void(0);" class="editBtn2 nav-link" data-title="Bachelor of Physiotherapy (BPT)" data-cardtitle="Bachelor of Physiotherapy (BPT)" data-modalstype="Show" data-te="academic" data-id="physiotherapy_bpt">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Bachelor of Physiotherapy (BPT)</p>
                        </a>
                    </li> 
                    @endcan 
                    @can('permission-create')
                    <li class="nav-item">
                        <a href="javascript:void(0);" class="editBtn2 nav-link" data-title="Master of Physiotherapy (MPT)" data-cardtitle="Master of Physiotherapy (MPT)" data-modalstype="Show" data-te="academic" data-id="physiotherapy_mpt">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Master of Physiotherapy (MPT)</p>
                        </a>
                    </li> 
                    @endcan                                                                                                                                                                
                    </ul>
                    {{-- END LEVEL 3 --}}
                </li>                  
               </ul>
               {{-- END LEVEL 2 --}}
               {{-- LEVEL 2 --}}
               <ul class="nav nav-treeview">                                    
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Hospital Mangement
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    {{-- LEVEL 3 --}}
                    <ul class="nav nav-treeview">
                    @can('permission-create')
                    <li class="nav-item">
                        <a href="javascript:void(0);" class="editBtn2 nav-link" data-title="Bachelor of Physiotherapy (BPT)" data-cardtitle="Bachelor of Physiotherapy (BPT)" data-modalstype="Show" data-te="academic" data-id="hospital_mhm">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Master in Hospital Management (MHM)</p>
                        </a>
                    </li> 
                    @endcan                                                                                                                                                                                    
                    @can('permission-create')
                    <li class="nav-item">
                        <a href="javascript:void(0);" class="editBtn2 nav-link" data-title="Bachelor of Physiotherapy (BPT)" data-cardtitle="Bachelor of Physiotherapy (BPT)" data-modalstype="Show" data-te="academic" data-id="hospital_mhm">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Paramedical</p>
                        </a>
                    </li> 
                    @endcan                                                                                                                                                                                    
                    </ul>
                    {{-- END LEVEL 3 --}}
                </li>                  
               </ul>
               {{-- END LEVEL 2 --}}
               {{-- LEVEL 2 --}}
               <ul class="nav nav-treeview">                                    
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Paramedical
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    {{-- LEVEL 3 --}}
                    <ul class="nav nav-treeview">                                                                                                                                                                                                      
                    @can('permission-create')
                    <li class="nav-item">
                        <a href="javascript:void(0);" class="editBtn2 nav-link" data-title="Post Graduate Diploma in Para Medical Courses" data-cardtitle="Post Graduate Diploma in Para Medical Courses" data-modalstype="Show" data-te="academic" data-id="paramedical_pg">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>PG Diploma</p>
                        </a>
                    </li> 
                    @endcan                                                                                                                                                                                    
                    </ul>
                    {{-- END LEVEL 3 --}}
                </li>                  
               </ul>
               {{-- END LEVEL 2 --}}
                  </li>
                  
                    @can('permissions-menu')
                    <li class="nav-item">
                      {{-- LEVEL 1 --}}
                      <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            Physiotherapy
                          <i class="right fas fa-angle-left"></i>
                        </p>
                      </a>
                      {{-- END LEVEL 1 --}}
                        {{-- LEVEL 2 --}}
                      <ul class="nav nav-treeview">
                        @can('permission-list')
                        <li class="nav-item">
                          <a href="javascript:void(0);"  class="editBtn2 nav-link" data-title="Department of Physiotherapy" data-cardtitle="Department of Physiotherapy" data-modalstype="Show" data-te="academic" data-id="physiotherapy_staff" >
                            <i class="far fa-circle nav-icon"></i>
                            <p>Faculty & Other Staff</p>
                          </a>
                        </li>
                        @endcan                                                  
                        @can('permission-list')
                        <li class="nav-item">
                          <a href="javascript:void(0);"  class="editBtn2 nav-link" data-title="Department of Physiotheraphy - Activities" data-cardtitle="Department of Physiotheraphy - Activities" data-modalstype="Show" data-te="academic_1" data-id="physiotherapy_activities" >
                            <i class="far fa-circle nav-icon"></i>
                            <p>Activities</p>
                          </a>
                        </li>
                        @endcan                                                  
                      </ul>
                        {{-- END LEVEL 2 --}}
                    </li>
                    @endcan
                    @can('permissions-menu')
                    <li class="nav-item">
                      {{-- LEVEL 1 --}}
                      <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                          College of Nursing
                          <i class="right fas fa-angle-left"></i>
                        </p>
                      </a>
                      {{-- END LEVEL 1 --}}
                        {{-- LEVEL 2 --}}
                      <ul class="nav nav-treeview">
                        @can('permission-list')
                        <li class="nav-item">
                          <a href="javascript:void(0);"  class="editBtn2 nav-link" data-title="College of Nursing - Faculty & Other Staff" data-cardtitle="College of Nursing - Faculty & Other Staff" data-modalstype="Show" data-te="academic_1" data-id="nursing_staff" >
                            <i class="far fa-circle nav-icon"></i>
                            <p>Faculty & Other Staff</p>
                          </a>
                        </li>
                        @endcan                                                  
                        @can('permission-list')
                        <li class="nav-item">
                          <a href="javascript:void(0);"  class="editBtn2 nav-link" data-title="College of Nursing - Activities" data-cardtitle="College of Nursing - Activities" data-modalstype="Show" data-te="academic_1" data-id="nursing_activities" >
                            <i class="far fa-circle nav-icon"></i>
                            <p>Activities</p>
                          </a>
                        </li>
                        @endcan                                                  
                      </ul>
                        {{-- END LEVEL 2 --}}
                    </li>
                    @endcan
                    @can('permissions-menu')
                    <li class="nav-item">
                      {{-- LEVEL 1 --}}
                      <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                          Academic Programs
                          <i class="right fas fa-angle-left"></i>
                        </p>
                      </a>
                      {{-- END LEVEL 1 --}}
                        {{-- LEVEL 2 --}}
                      <ul class="nav nav-treeview">
                        @can('permission-list')
                        <li class="nav-item">
                          <a href="javascript:void(0);"  class="editBtn2 nav-link" data-title="The Learning Center Programmes January to December" data-cardtitle="The Learning Center Programmes January to December" data-modalstype="Show" data-te="academic_ap" data-id="AP_nlcp" >
                            <i class="far fa-circle nav-icon"></i>
                            <p>NIMS Learning Center Programmes</p>
                          </a>
                        </li>
                        @endcan                                                  
                        @can('permission-list')
                        <li class="nav-item">
                          <a href="javascript:void(0);"  class="editBtn2 nav-link" data-title="Clinical Infectious Diseases Conference" data-cardtitle="Clinical Infectious Diseases Conference" data-modalstype="Show" data-te="academic_ap" data-id="AP_cidc" >
                            <i class="far fa-circle nav-icon"></i>
                            <p>Clinical Infectious Diseases Conference</p>
                          </a>
                        </li>
                        @endcan                                                  
                        @can('permission-list')
                        <li class="nav-item">
                          <a href="javascript:void(0);"  class="editBtn2 nav-link" data-title="Clinical Meeting" data-cardtitle="Clinical Meeting" data-modalstype="Show" data-te="academic_ap" data-id="AP_cm" >
                            <i class="far fa-circle nav-icon"></i>
                            <p>Clinical Meeting</p>
                          </a>
                        </li>
                        @endcan                                                  
                        @can('permission-list')
                        <li class="nav-item">
                          <a href="javascript:void(0);"  class="editBtn2 nav-link" data-title="Medical Audit" data-cardtitle="Medical Audit" data-modalstype="Show" data-te="academic_ap" data-id="AP_ma" >
                            <i class="far fa-circle nav-icon"></i>
                            <p>Medical Audit</p>
                          </a>
                        </li>
                        @endcan                                                  
                        @can('permission-list')
                        <li class="nav-item">
                          <a href="javascript:void(0);"  class="editBtn2 nav-link" data-title="Research Forum" data-cardtitle="Research Forum" data-modalstype="Show" data-te="academic_ap" data-id="AP_rf" >
                            <i class="far fa-circle nav-icon"></i>
                            <p>Research Forum</p>
                          </a>
                        </li>
                        @endcan                                                  
                        @can('permission-list')
                        <li class="nav-item">
                          <a href="javascript:void(0);"  class="editBtn2 nav-link" data-title="Post Graduate Quiz" data-cardtitle="Post Graduate Quiz" data-modalstype="Show" data-te="academic_ap" data-id="AP_pgq" >
                            <i class="far fa-circle nav-icon"></i>
                            <p>Post Graduate Quiz </p>
                          </a>
                        </li>
                        @endcan                                                  
                        @can('permission-list')
                        <li class="nav-item">
                          <a href="javascript:void(0);"  class="editBtn2 nav-link" data-title="Morality Audit with Case Discussion" data-cardtitle="Morality Audit with Case Discussion" data-modalstype="Show" data-te="academic_ap" data-id="AP_macd" >
                            <i class="far fa-circle nav-icon"></i>
                            <p>Mortality Audit with Case Discussion</p>
                          </a>
                        </li>
                        @endcan                                                  
                        @can('permission-list')
                        <li class="nav-item">
                          <a href="javascript:void(0);"  class="editBtn2 nav-link" data-title="CPC / Autopsy Conference" data-cardtitle="CPC / Autopsy Conference" data-modalstype="Show" data-te="academic_ap" data-id="AP_cac" >
                            <i class="far fa-circle nav-icon"></i>
                            <p>CPC / Autopsy Conference</p>
                          </a>
                        </li>
                        @endcan                                                  
                        @can('permission-list')
                        <li class="nav-item">
                          <a href="javascript:void(0);"  class="editBtn2 nav-link" data-title="Clinical Debates" data-cardtitle="Clinical Debates" data-modalstype="Show" data-te="academic_ap" data-id="AP_cd" >
                            <i class="far fa-circle nav-icon"></i>
                            <p>Clinical Debates</p>
                          </a>
                        </li>
                        @endcan                                                  
                        @can('permission-list')
                        <li class="nav-item">
                          <a href="javascript:void(0);"  class="editBtn2 nav-link" data-title="Guest Lectures" data-cardtitle="Guest Lectures" data-modalstype="Show" data-te="home" data-id="guest_lecture" >
                            <i class="far fa-circle nav-icon"></i>
                            <p>Guest Lectures</p>
                          </a>
                        </li>
                        @endcan                                                                          
                      </ul>
                        {{-- END LEVEL 2 --}}
                    </li>
                    @endcan
                    @can('permissions-menu')
                    <li class="nav-item">
                      {{-- LEVEL 1 --}}
                      <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                          Library
                          <i class="right fas fa-angle-left"></i>
                        </p>
                      </a>
                      {{-- END LEVEL 1 --}}
                        {{-- LEVEL 2 --}}
                      <ul class="nav nav-treeview">
                        @can('permission-list')
                        <li class="nav-item">
                          <a href="javascript:void(0);"  class="editBtn2 nav-link" data-title="Library" data-cardtitle="Library" data-modalstype="Show" data-te="academic_1" data-id="library_doctor" >
                            <i class="far fa-circle nav-icon"></i>
                            <p>Doctors</p>
                          </a>
                        </li>
                        @endcan                                                                                                                                                   
                        @can('permission-list')
                        <li class="nav-item">
                          <a href="javascript:void(0);"  class="editBtn2 nav-link" data-title="Nursing & Physiotherapy" data-cardtitle="Nursing & Physiotherapy" data-modalstype="Show" data-te="academic_1" data-id="library_nursing" >
                            <i class="far fa-circle nav-icon"></i>
                            <p>Nursing & Physiotherapy</p>
                          </a>
                        </li>
                        @endcan                                                                                                                                                   
                      </ul>
                        {{-- END LEVEL 2 --}}
                    </li>
                    @endcan
                    @can('permissions-menu')
                    <li class="nav-item">
                      <a href="javascript:void(0);"  class="editBtn2 nav-link" data-title="Annual Reports" data-cardtitle="Annual Reports" data-modalstype="Show" data-te="home" data-id="annualreports" >
                        <i class="far fa-circle nav-icon"></i>
                        <p>Annual Reports</p>
                      </a>
                    </li>
                    @endcan
                    @can('permissions-menu')
                    <li class="nav-item">
                      <a href="javascript:void(0);"  class="editBtn2 nav-link" data-title="NIMS Proceedings" data-cardtitle="NIMS Proceedings" data-modalstype="Show" data-te="home" data-id="nims_proceedings" >
                        <i class="far fa-circle nav-icon"></i>
                        <p>NIMS Proceedings</p>
                      </a>
                    </li>
                    @endcan
                    
              </ul>
              {{-- END LEVEL 2 --}}                  
              </li>
              @endcan 
            
              @can('permissions-menu')
                    <li class="nav-item">
                      {{-- LEVEL 1 --}}
                      <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                          Library
                          <i class="right fas fa-angle-left"></i>
                        </p>
                      </a>
                      {{-- END LEVEL 1 --}}
                        {{-- LEVEL 2 --}}
                      <ul class="nav nav-treeview">
                        @can('permission-list')
                        <li class="nav-item">
                          <a href="javascript:void(0);"  class="editBtn2 nav-link" data-title="Library" data-cardtitle="Library" data-modalstype="Show" data-te="academic_1" data-id="library_doctor" >
                            <i class="far fa-circle nav-icon"></i>
                            <p>Doctors</p>
                          </a>
                        </li>
                        @endcan                                                                                                                                                   
                        @can('permission-list')
                        <li class="nav-item">
                          <a href="javascript:void(0);"  class="editBtn2 nav-link" data-title="Nursing & Physiotherapy" data-cardtitle="Nursing & Physiotherapy" data-modalstype="Show" data-te="academic_1" data-id="library_nursing" >
                            <i class="far fa-circle nav-icon"></i>
                            <p>Nursing & Physiotherapy</p>
                          </a>
                        </li>
                        @endcan                                                                                                                                                   
                      </ul>
                        {{-- END LEVEL 2 --}}
                    </li>
                    @endcan
                    @can('permissions-menu')
                    <li class="nav-item">
                        {{-- LEVEL 1 --}}
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            Research
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                        {{-- END LEVEL 1 --}}
                        {{-- LEVEL 2 --}}
                        <ul class="nav nav-treeview">
                        @can('permission-list')
                        <li class="nav-item">
                            <a href="javascript:void(0);"  class="editBtn2 nav-link" data-title="Academic Section I" data-cardtitle="Academic Section I" data-modalstype="Show" data-te="academicsection" data-id="academicsection1" >
                            <i class="far fa-circle nav-icon"></i>
                            <p>Sponsored Research Cell </p>
                            </a>
                        </li>
                        @endcan   
                        
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                              Guidelines
                                <i class="right fas fa-angle-left"></i>
                            </p>
                            </a>
                            {{-- LEVEL 3 --}}
                            <ul class="nav nav-treeview">
                            @can('permission-create')
                            <li class="nav-item">
                                <a href="javascript:void(0);" class="ShowModalFileUpload nav-link" data-title="Document -Guidelines" data-cardtitle="Document  - Guidelines" data-modalstype="Show" data-te="research_documents" data-id="guideline">
                                <i class="fas fa-pencil-alt nav-icon"></i>
                                <p> View / Edit</p>
                                </a>
                            </li> 
                            @endcan                                                                                                            
                            </ul>
                            {{-- END LEVEL 3 --}}
                        </li>
                        
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>
                            General Information 
                              <i class="right fas fa-angle-left"></i>
                          </p>
                          </a>
                          {{-- LEVEL 3 --}}
                          <ul class="nav nav-treeview">                         
                          @can('permission-create')
                          <li class="nav-item">
                              <a href="javascript:void(0);" class="ShowModalFileUpload nav-link" data-title="Document  - General Information" data-cardtitle="Document  - General Information" data-modalstype="Show" data-te="research_documents" data-id="general_information">
                              <i class="fas fa-pencil-alt nav-icon"></i>
                              <p> View / Edit</p>
                              </a>
                          </li> 
                          @endcan                                                                              
                          </ul>
                          {{-- END LEVEL 3 --}}
                        </li>

                        <li class="nav-item">
                          <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>
                            Working Manual  
                              <i class="right fas fa-angle-left"></i>
                          </p>
                          </a>
                          {{-- LEVEL 3 --}}
                          <ul class="nav nav-treeview">                         
                          @can('permission-create')
                          <li class="nav-item">
                              <a href="javascript:void(0);" class="ShowModalFileUpload nav-link" data-title="Document  - Working Manual" data-cardtitle="Document  - Working Manual" data-modalstype="Show" data-te="research_documents" data-id="working_manual">
                              <i class="fas fa-pencil-alt nav-icon"></i>
                              <p> View / Edit</p>
                              </a>
                          </li> 
                          @endcan                                                                              
                          </ul>
                          {{-- END LEVEL 3 --}}
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>
                            Clinical Research Council (CRC )   
                              <i class="right fas fa-angle-left"></i>
                          </p>
                          </a>
                          {{-- LEVEL 3 --}}
                          <ul class="nav nav-treeview">                         
                          @can('permission-create')
                          <li class="nav-item">
                              <a href="javascript:void(0);" class="ShowModalFileUpload nav-link" data-title="Document  - Clinical Research Council (CRC )" data-cardtitle="Document  - Clinical Research Council (CRC )" data-modalstype="Show" data-te="research_documents" data-id="crc">
                              <i class="fas fa-pencil-alt nav-icon"></i>
                              <p> View / Edit</p>
                              </a>
                          </li> 
                          @endcan                                                                              
                          </ul>
                          {{-- END LEVEL 3 --}}
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>
                            Clinical Research Council (CRC) - Form C     
                              <i class="right fas fa-angle-left"></i>
                          </p>
                          </a>
                          {{-- LEVEL 3 --}}
                          <ul class="nav nav-treeview">                         
                          @can('permission-create')
                          <li class="nav-item">
                              <a href="javascript:void(0);" class="ShowModalFileUpload nav-link" data-title="Document  - Clinical Research Council (CRC) - Form C" data-cardtitle="Document  - Clinical Research Council (CRC) - Form C" data-modalstype="Show" data-te="research_documents" data-id="crc_form">
                              <i class="fas fa-pencil-alt nav-icon"></i>
                              <p> View / Edit</p>
                              </a>
                          </li> 
                          @endcan                                                                              
                          </ul>
                          {{-- END LEVEL 3 --}}
                        </li>
                         @can('permission-create')
                         <li class="nav-item">
                            <a href="javascript:void(0);"  class="editBtn2 nav-link" data-title="Members of NIMS Institutional Ethics Committee (IEC-NIMS)" data-cardtitle="Members of NIMS Institutional Ethics Committee (IEC-NIMS)" data-modalstype="Show" data-te="research" data-id="IEC" >
                            <i class="far fa-circle nav-icon"></i>
                            <p>Members of NIMS Institutional Ethics Committee (IEC-NIMS)</p>
                            </a>
                         </li> 
                        @endcan
                        @can('permission-create')
                         <li class="nav-item">
                            <a href="javascript:void(0);"  class="editBtn2 nav-link" data-title="Data & Safety Monitoring Board (DSMB)" data-cardtitle="Data & Safety Monitoring Board (DSMB)" data-modalstype="Show" data-te="research" data-id="DSMB" >
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data & Safety Monitoring Board (DSMB)</p>
                            </a>
                         </li> 
                        @endcan
                        @can('permission-create')
                         <li class="nav-item">
                            <a href="javascript:void(0);"  class="editBtn2 nav-link" data-title="Ethics Sub Committee for Graduate Students (ESGS)" data-cardtitle="Ethics Sub Committee for Graduate Students (ESGS)" data-modalstype="Show" data-te="research" data-id="ESGS" >
                            <i class="far fa-circle nav-icon"></i>
                            <p>Ethics Sub Committee for Graduate Students (ESGS)</p>
                            </a>
                         </li> 
                        @endcan

                        <li class="nav-item">
                          <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>
                            Guidelines for Course Curriculam
                              <i class="right fas fa-angle-left"></i>
                          </p>
                          </a>
                          {{-- LEVEL 3 --}}
                          <ul class="nav nav-treeview">
                          @can('permission-create')
                          <li class="nav-item">
                              <a href="javascript:void(0);" class="ShowModalFileUpload nav-link" data-title="Document -Guidelines" data-cardtitle="Document  - Guidelines" data-modalstype="Show" data-te="research_documents" data-id="guideline_course">
                              <i class="fas fa-pencil-alt nav-icon"></i>
                              <p> View / Edit</p>
                              </a>
                          </li> 
                          @endcan                                                                                                            
                          </ul>
                          {{-- END LEVEL 3 --}}
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>
                            Ph.D Admission Programme Guidelines
                              <i class="right fas fa-angle-left"></i>
                          </p>
                          </a>
                          {{-- LEVEL 3 --}}
                          <ul class="nav nav-treeview">
                          @can('permission-create')
                          <li class="nav-item">
                              <a href="javascript:void(0);" class="ShowModalFileUpload nav-link" data-title="Document -Guidelines" data-cardtitle="Document  - Guidelines" data-modalstype="Show" data-te="research_documents" data-id="phd_admission_guideline">
                              <i class="fas fa-pencil-alt nav-icon"></i>
                              <p> View / Edit</p>
                              </a>
                          </li> 
                          @endcan                                                                                                            
                          </ul>
                          {{-- END LEVEL 3 --}}
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>
                            Workshop on writing for Resea- rchers and Publishing Skills 
                              <i class="right fas fa-angle-left"></i>
                          </p>
                          </a>
                          {{-- LEVEL 3 --}}
                          <ul class="nav nav-treeview">
                          @can('permission-create')
                          <li class="nav-item">
                              <a href="javascript:void(0);" class="ShowModalFileUpload nav-link" data-title="Document -Guidelines" data-cardtitle="Document  - Guidelines" data-modalstype="Show" data-te="research_documents" data-id="workshop">
                              <i class="fas fa-pencil-alt nav-icon"></i>
                              <p> View / Edit</p>
                              </a>
                          </li> 
                          @endcan                                                                                                            
                          </ul>
                          {{-- END LEVEL 3 --}}
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>
                            Council for Clinical Research & Education - Application Form 
                              <i class="right fas fa-angle-left"></i>
                          </p>
                          </a>
                          {{-- LEVEL 3 --}}
                          <ul class="nav nav-treeview">
                          @can('permission-create')
                          <li class="nav-item">
                              <a href="javascript:void(0);" class="ShowModalFileUpload nav-link" data-title="Document -Guidelines" data-cardtitle="Document  - Guidelines" data-modalstype="Show" data-te="research_documents" data-id="clinical_research">
                              <i class="fas fa-pencil-alt nav-icon"></i>
                              <p> View / Edit</p>
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
                   
                    @can('tender-menu')
                        <li class="nav-item has-treeview">
                          <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                              Latest
                              <i class="fas fa-angle-left right"></i>
                              <span class="badge badge-info right">6</span>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">
                            @can('tender-list')
                            <li class="nav-item">
                              <a href="{{route('latests.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Latest</p>
                              </a>
                            </li>
                            @endcan 
                            
                            @can('tender-list')
                            <li class="nav-item">
                              <a href="{{route('latests.list-archive')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Archive</p>
                              </a>
                            </li>
                            @endcan                             
                          </ul>
                        </li>  
                  @endcan
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>