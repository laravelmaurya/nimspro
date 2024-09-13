<section>
    <div class="container-fluid p-1 text-center fw-bold" id="top-bar">
      <div class="row">
        <div class="col-md-4 col-sm-12">
          <a class="text-white text-decoration-none float-md-start">Date: 06-08-2024 15:16:40</a>
        </div>
        <div class="col-md-4 col-sm-12">
          <a class="text-white text-decoration-none">Last Updated: 06-Aug-2024 13:59:42</a>
        </div>
        <div class="col-md-4 col-sm-12 "> 
          <div class="d-inline-flex float-md-end">
            <a class="text-white text-decoration-none" href="https://email.gov.in" target="blank" onclick="alert('You will be redirected to another website')"><span class="far fa-envelope" aria-hidden="true"></span> WebMail </a>  
            <a class="text-white text-decoration-none" href="{{route('login')}}"> | Login</a> 
          </div>                   
        </div>
      </div>
    </div>
  
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-1 col-md-3 col-sm-12 text-center">  
          <a class="navbar-brand" href="{{config('app.url')}}">
            <img src="{{ url($addPublic.'img/nims-logo.jpg') }}" alt="NIMS Logo" style="width: 90px;">
          </a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 text-center">  
          <div class="logo-text theme-color">
            <p class="mt-3 fw-bolder h4">Nizam's Institute of Medical Sciences</p>
            <p class="mt-2 mx-5 h6">(A University Established Under State Act)</p>
            <p class="mt-2 fw-bolder h4">Hyderabad - 500082, Telangana, India</p>
          </div>
        </div>
        <div class="col-lg-8 col-md-12 col-sm-12">
          <nav class="navbar navbar-expand-md mt-4">
            <div class="container-fluid">
              <a class="navbar-brand d-lg-none" href="#"><i class="fas fa-home"></i></a>
              <button class="navbar-toggler mx-md-auto" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse mt-1" id="collapsibleNavbar">
                <ul class="navbar-nav mx-auto">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold text-white" href="#" role="button" data-bs-toggle="dropdown">Administration</a>
                    <ul class="dropdown-menu theme-bg-color">
                      <li>                       

                        <form id="governing-council" action="{{ route('dynamic-four.tab-page') }}" method="POST">
                          @csrf
                      
                          <input type="hidden" name="te" value="aboutus">
                          <input type="hidden" name="id" value="governmentc">                                                  
                          <input type="hidden" name="title" value="Members of Governing Council">                                                                             
                          <!-- Other input fields for the form -->
                          
                          <a onclick="dynamicForm('executive-board')" class="nav-link dropdown-item text-white fw-semibold">Governing Council</a>
                        </form>                     
                      </li>
                      <li><hr class="dropdown-divider"></li>
                      <li>
                       
                        <form id="executive-board" action="{{ route('dynamic-four.tab-page') }}" method="POST">
                          @csrf
                      
                          <input type="hidden" name="te" value="aboutus">
                          <input type="hidden" name="id" value="ex_board">                                                  
                          <input type="hidden" name="title" value="Members of Executive Board">                                                                             
                          <!-- Other input fields for the form -->
                          
                          <a onclick="dynamicForm('executive-board')" class="nav-link dropdown-item text-white fw-semibold">Executive Board</a>
                        </form>
                      </li>
                      
                      <li><hr class="dropdown-divider"></li>
                      <li>
                        
                        <form id="finance-committee" action="{{ route('dynamic-four.tab-page') }}" method="POST">
                          @csrf
                      
                          <input type="hidden" name="te" value="aboutus">
                          <input type="hidden" name="id" value="finance">                                                  
                          <input type="hidden" name="title" value="Members of Finance Committee">                                                                             
                          <!-- Other input fields for the form -->
                          
                          <a onclick="dynamicForm('finance-committee')" class="nav-link dropdown-item text-white fw-semibold">Finance Committee</a>
                        </form>
                      </li>
                      <li><hr class="dropdown-divider"></li>
                      <li>
                        
                        <form id="academic-council" action="{{ route('dynamic-four.tab-page') }}" method="POST">
                          @csrf
                      
                          <input type="hidden" name="te" value="aboutus">
                          <input type="hidden" name="id" value="acadamiccouncil">                                                  
                          <input type="hidden" name="title" value="Members of Academic Council">                                                                             
                          <!-- Other input fields for the form -->
                          
                          <a onclick="dynamicForm('academic-council')" class="nav-link dropdown-item text-white fw-semibold">Academic Council</a>
                        </form>   
                      </li>
                      <li><hr class="dropdown-divider"></li>                      
                      <li>

                        <form id="director1" action="{{ route('dynamic-four.tab-page') }}" method="POST">
                          @csrf
                      
                          <input type="hidden" name="te" value="director">
                          <input type="hidden" name="id" value="about">                          
                          <input type="hidden" name="id2" value="office">                          
                          <input type="hidden" name="id3" value="exdirector">                          
                          <input type="hidden" name="title" value="About Director">                         
                          <input type="hidden" name="title2" value="Overview">
                          <input type="hidden" name="title3" value="Ex-Director">                          
                          <!-- Other input fields for the form -->
                      
                          <a onclick="dynamicForm('director1')" class="nav-link dropdown-item text-white fw-semibold">Director</a>
                        </form>   
                      </li>
                      <li><hr class="dropdown-divider"></li>
                      <li>
                                                
                        <form id="dean1" action="{{ route('dynamic-four.tab-page') }}" method="POST">
                          @csrf
                      
                          <input type="hidden" name="te" value="dean">
                          <input type="hidden" name="id" value="about">                          
                          <input type="hidden" name="id2" value="office">                          
                          <input type="hidden" name="id3" value="exdean">                          
                          <input type="hidden" name="title" value="About Dean">                         
                          <input type="hidden" name="title2" value="Overview">
                          <input type="hidden" name="title3" value="Ex-Deans">                          
                          <!-- Other input fields for the form -->
                      
                          <a onclick="dynamicForm('dean1')" class="nav-link dropdown-item text-white fw-semibold">Dean</a>
                        </form>   
                      </li>
                      <li><hr class="dropdown-divider"></li>
                      <li>
                        
                        <form id="executive-registrar" action="{{ route('dynamic-four.tab-page') }}" method="POST">
                          @csrf
                      
                          <input type="hidden" name="te" value="executive_registrar">
                          <input type="hidden" name="id" value="about">                          
                          <input type="hidden" name="id2" value="office">                          
                          <input type="hidden" name="id3" value="ex_executive_registrar">                          
                          <input type="hidden" name="title" value="About Executive Registrar">                         
                          <input type="hidden" name="title2" value="Overview">
                          <input type="hidden" name="title3" value="Ex-Executive Registrars">                          
                          <!-- Other input fields for the form -->
                      
                          <a onclick="dynamicForm('executive-registrar')" class="nav-link dropdown-item text-white fw-semibold">Executive Registrar</a>
                        </form>   
                      </li>
                      <li><hr class="dropdown-divider"></li>
                      <li>                       
                        <form id="medical-superintendent" action="{{ route('dynamic-four.tab-page') }}" method="POST">
                          @csrf
                      
                          <input type="hidden" name="te" value="medical_superintendent">
                          <input type="hidden" name="id" value="about">                          
                          <input type="hidden" name="id2" value="office">                          
                          <input type="hidden" name="id3" value="exms">                          
                          <input type="hidden" name="title" value="About Medical Superintendent">                         
                          <input type="hidden" name="title2" value="Overview">
                          <input type="hidden" name="title3" value="Ex-Medical Superintendents">                          
                          <!-- Other input fields for the form -->
                      
                          <a onclick="dynamicForm('medical-superintendent')" class="nav-link dropdown-item text-white fw-semibold">Medical Superintendent</a>
                        </form>   
                      </li>
                      <li><hr class="dropdown-divider"></li>
                      <li>
                        <div class="d-inline-flex">
                          <a class="nav-link dropdown-item text-white fw-semibold" href="javascript:void(0)" download onclick="downloadImage('research_documents','research_id',1,'act')">NIMS Act 1989 &nbsp;<img src="{{url($addPublic.'img/download-arrow.png')}}"  height="16" width="12" >                        
                          </a> 
                          &nbsp;
                          <a class="nav-link dropdown-item text-white fw-semibold" href="javascript:void(0)" onclick="viewImage('research_documents','research_id',1,'act','NIMS Act 1989')">
                            <img src="{{url($addPublic.'img/view-doc.png')}}"  height="16" width="12" >                          
                          </a>
                        </div>                        
                      </li>
                      <li><hr class="dropdown-divider"></li>
                    </ul>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold text-white" href="#" role="button" data-bs-toggle="dropdown">Hospital Services</a>
                    <ul class="dropdown-menu theme-bg-color">
                      <li><a class="nav-link dropdown-item text-white fw-semibold" href="#">Departments</a></li>
                      <li>
                        <form id="emergency-services" action="{{ route('dynamic-four.tab-page') }}" method="POST">
                          @csrf
                      
                          <input type="hidden" name="te" value="emergency">
                          <input type="hidden" name="id" value="hos_eme">                          
                          <input type="hidden" name="title" value="Emergency Services">
                                                    
                          <!-- Other input fields for the form -->
                      
                          <a onclick="dynamicForm('emergency-services')" class="nav-link dropdown-item text-white fw-semibold">Emergency Services</a>
                        </form>                        
                      </li>                      
                      <li>
                         
                        <form class="" id="morning-out-patient-services" action="{{ route('dynamic-four.tab-page') }}" method="POST">
                          @csrf
                      
                          <input type="hidden" name="te" value="hospital_services">
                          <input type="hidden" name="id" value="morning_service">
                          <input type="hidden" name="id2" value="millennium">
                          <input type="hidden" name="id3" value="miscellaneous">
                          <input type="hidden" name="id4" value="specialityb">
                          <input type="hidden" name="title" value="Morning Services - Out Patient Department (OPD Block)">
                          <input type="hidden" name="title2" value="Morning Services - Millennium Block">
                          <input type="hidden" name="title3" value="Emergency & Physiotherapy Block">
                          <input type="hidden" name="title4" value="Morning Services - Speciality">
                      
                          <!-- Other input fields for the form -->
                      
                          <a onclick="dynamicForm('morning-out-patient-services')" class="nav-link dropdown-item text-white fw-semibold">Morning Out Patient Services</a>
                        </form>

                      </li>
                      <li>
                         
                        <form class="" id="evening-out-patient-services-special-clinics" action="{{ route('dynamic-four.tab-page') }}" method="POST">
                          @csrf
                      
                          <input type="hidden" name="te" value="hospital_services">
                          <input type="hidden" name="id" value="evening_service">
                          <input type="hidden" name="id2" value="nurology">
                          <input type="hidden" name="id3" value="cardiology">
                         
                          <input type="hidden" name="title" value="Evening Special Clinic - Out Patient Department(OPD Block)">
                          <input type="hidden" name="title2" value="Evening Special Clinic - Millennium Block">
                          <input type="hidden" name="title3" value="Evening Special Clinic - Specialty Block">
                        
                      
                          <!-- Other input fields for the form -->
                      
                          <a onclick="dynamicForm('evening-out-patient-services-special-clinics')" class="nav-link dropdown-item text-white fw-semibold">Evening Out Patient Services (Special Clinics)</a>
                        </form>

                      </li>
                      <li>
                         
                        <form class="" id="in-patient-services" action="{{ route('dynamic-four.tab-page') }}" method="POST">
                          @csrf
                      
                          <input type="hidden" name="te" value="hospital_services">
                          <input type="hidden" name="id" value="in_patient">                          
                          <input type="hidden" name="title" value="In Patient Services">
                          
                      
                          <!-- Other input fields for the form -->
                      
                          <a onclick="dynamicForm('in-patient-services')" class="nav-link dropdown-item text-white fw-semibold">In Patient ervices</a>
                        </form>
                      </li>                                          
                      <li class="dropdown-submenu theme-bg-color ">
                        <a class="test nav-link dropdown-toggle text-white fw-semibold" tabindex="-1" href="#">Investigations Available</a>
                        <ul class="dropdown-menu theme-bg-color">
                          <li>
                            <form id="all-tests" action="{{ route('all-tests.page') }}" method="POST">
                              @csrf                                                           
                              <!-- Other input fields for the form -->
                              {{-- <a class="nav-link text-white fw-semibold mx-3" tabindex="-1" href="#">All Tests</a> --}}
                              <a onclick="dynamicForm('all-tests')" class="nav-link dropdown-item text-white fw-semibold">All Tests</a>
                            </form>   
             
                          </li>
                          <li>
                            <form id="depw-test-view" action="{{ route('depw-test-view.page') }}" method="POST">
                              @csrf                                                           
                              <!-- Other input fields for the form -->
                              {{-- <a class="nav-link text-white fw-semibold mx-3" tabindex="-1" href="#">All Tests</a> --}}
                              <a onclick="dynamicForm('depw-test-view')" class="nav-link dropdown-item text-white fw-semibold">Department Wise Tests</a>
                            </form>   
                          </li>                              
                        </ul>
                      </li>
                      <li>
                        <form id="general-holidays-op-ot" action="{{ route('dynamic-four.tab-page') }}" method="POST">
                          @csrf                          
                          <input type="hidden" name="te" value="hospital_services">
                          <input type="hidden" name="id" value="general_holidays">                          
                          <input type="hidden" name="title" value="Holidays during the Year <?php echo date('Y');?>">                                                                                                    
                          <a onclick="dynamicForm('general-holidays-op-ot')" class="nav-link dropdown-item text-white fw-semibold">General Holidays (OP/ OT)</a>
                        </form>                        
                      </li>
                      <li>
                        <form id="hs-internal-phone-no" action="{{ route('hs-internal-phone-no.page') }}" method="POST">
                          @csrf                                                                               
                          <a onclick="dynamicForm('hs-internal-phone-no')" class="nav-link dropdown-item text-white fw-semibold">Internal Phone Numbers</a>
                        </form>            
                      </li>                                                    
                      <li>
                        <form id="patient-view" action="{{ route('patient-view.page') }}" method="POST">
                          @csrf                                                                               
                          <a onclick="dynamicForm('patient-view')" class="nav-link dropdown-item text-white fw-semibold">Hospital Statistics</a>
                        </form>            
                      </li>
                      <li>
                        <form id="master-health-checkup" action="{{ route('dynamic-four.tab-page') }}" method="POST">
                          @csrf                          
                          <input type="hidden" name="te" value="master_health">
                          <input type="hidden" name="id" value="master">                          
                          <input type="hidden" name="title" value="Holidays during the Year <?php echo date('Y');?>">                                                                                                    
                          <a onclick="dynamicForm('master-health-checkup')" class="nav-link dropdown-item text-white fw-semibold">Master Health Checkup</a>
                        </form>                        
                      </li>                                                    
                    </ul>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold text-white" href="#" role="button" data-bs-toggle="dropdown">Academic</a>
                    <ul class="dropdown-menu theme-bg-color">                                                     
                      <li class="dropdown-submenu theme-bg-color ">
                        <a class="test nav-link dropdown-toggle text-white fw-semibold" tabindex="-1" href="#">Academic Section</a>
                          <ul class="dropdown-menu theme-bg-color">
                            <li class="dropdown-submenu theme-bg-color ">
                              <a class="test nav-link dropdown-toggle text-white fw-semibold" tabindex="-1" href="#">Academic Section I</a>
                                <ul class="dropdown-menu theme-bg-color">
                                  <li class="dropdown-submenu theme-bg-color ">
                                    <a class="test nav-link dropdown-toggle text-white fw-semibold" tabindex="-1" href="#">Students Admission</a>
                                      <ul class="dropdown-menu theme-bg-color">                                        
                                          <li>
                                            <div class="d-inline-flex">
                                              <a class="nav-link dropdown-item text-white fw-semibold" href="javascript:void(0)" download onclick="downloadImageByPath('/public/frontend/academic/2014_BS_SS_Details.pdf','2014_BS_SS_Details.pdf')">2014 &nbsp;<img src="{{url($addPublic.'img/download-arrow.png')}}"  height="16" width="12" ></a>
                                              &nbsp;
                                              <a class="nav-link dropdown-item text-white fw-semibold" href="javascript:void(0)" onclick="viewImageByPah('/public/frontend/academic/2014_BS_SS_Details.pdf','2014_BS_SS_Details.pdf','2014')">
                                                <img src="{{url($addPublic.'img/view-doc.png')}}"  height="16" width="12">                          
                                              </a>
                                            </div>
                                          </li>                  
                                          <li>
                                            <div class="d-inline-flex">
                                                <a class="nav-link dropdown-item text-white fw-semibold" href="javascript:void(0)" download onclick="downloadImageByPath('/public/frontend/academic/2015_BS_SS_Details.pdf','2015_BS_SS_Details.pdf',)">2015 &nbsp;<img src="{{url($addPublic.'img/download-arrow.png')}}"  height="16" width="12"></a>
                                                &nbsp;
                                                <a class="nav-link dropdown-item text-white fw-semibold" href="javascript:void(0)" onclick="viewImageByPah('/public/frontend/academic/2015_BS_SS_Details.pdf','2015_BS_SS_Details.pdf','2015')">
                                                <img src="{{url($addPublic.'img/view-doc.png')}}"  height="16" width="12">
                                                </a>
                                            </div>
                                          </li>                  
                                          <li>
                                            <div class="d-inline-flex">
                                            <a class="nav-link dropdown-item text-white fw-semibold" href="javascript:void(0)" download onclick="downloadImageByPath('/public/frontend/academic/2016_BS_SS_Details.pdf','2016_BS_SS_Details.pdf',)">2016 &nbsp;<img src="{{url($addPublic.'img/download-arrow.png')}}"  height="16" width="12"></a>
                                            &nbsp;
                                              <a class="nav-link dropdown-item text-white fw-semibold" href="javascript:void(0)" onclick="viewImageByPah('/public/frontend/academic/2016_BS_SS_Details.pdf','2016_BS_SS_Details','2016')">
                                              <img src="{{url($addPublic.'img/view-doc.png')}}"  height="16" width="12">
                                              </a>
                                            </div>
                                          </li>                  
                                          <li class="dropdown-submenu theme-bg-color ">
                                            <a class="test nav-link dropdown-toggle text-white fw-semibold" tabindex="-1" href="#">MCI Courses</a>
                                            <ul class="dropdown-menu theme-bg-color">
                                              <li>                                                
                                                  <a href="{{ route('mci-list-bs') }}"  class="nav-link dropdown-item text-white fw-semibold">Broad Speciality</a>                                               
                                              </li>
                                              <li>                                                                                               
                                                  <a href="{{ route('mci-list-ss') }}" class="nav-link dropdown-item text-white fw-semibold">Super Speciality</a>                                        
                                              </li>                                                                            
                                            </ul>
                                          </li>
                                          <li>                                                                                               
                                              <a href="javascript:void(0)" class="nav-link dropdown-item text-white fw-semibold">MCI Students List </a>                     
                                          </li>                             
                                          <li>                                                                                               
                                              <a href="{{ route('mci-count-students') }}" class="nav-link dropdown-item text-white fw-semibold">MCI Students Summary</a>                    
                                          </li>                             
                                      </ul>
                                      <a class="test nav-link text-white fw-semibold" tabindex="-1" href="#">About Academic Activities</a>
                                  </li>                              
                                </ul>
                                <a class="test nav-link text-white fw-semibold" tabindex="-1" href="#">Academic Section II</a>
                            </li>
                            <li>
                              <form id="depw-test-view" action="{{ route('depw-test-view.page') }}" method="POST">
                                @csrf                                                           
                                <!-- Other input fields for the form -->
                                {{-- <a class="nav-link text-white fw-semibold mx-3" tabindex="-1" href="#">All Tests</a> --}}
                                <a onclick="dynamicForm('depw-test-view')" class="nav-link dropdown-item text-white fw-semibold">Department Wise Tests</a>
                              </form>   
                            </li>                              
                          </ul>
                      </li>
                      <li>
                        <form id="general-holidays-op-ot" action="{{ route('dynamic-four.tab-page') }}" method="POST">
                          @csrf                          
                          <input type="hidden" name="te" value="hospital_services">
                          <input type="hidden" name="id" value="general_holidays">                          
                          <input type="hidden" name="title" value="Holidays during the Year <?php echo date('Y');?>">                                                                                                    
                          <a onclick="dynamicForm('general-holidays-op-ot')" class="nav-link dropdown-item text-white fw-semibold">General Holidays (OP/ OT)</a>
                        </form>                        
                      </li>                                                   
                    </ul>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold text-white" href="#" role="button" data-bs-toggle="dropdown">Research</a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Link</a></li>
                      <li><a class="dropdown-item" href="#">Another link</a></li>
                      <li><a class="dropdown-item" href="#">A third link</a></li>
                    </ul>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold text-white" href="#" role="button" data-bs-toggle="dropdown">Notifications</a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Link</a></li>
                      <li><a class="dropdown-item" href="#">Another link</a></li>
                      <li><a class="dropdown-item" href="#">A third link</a></li>
                    </ul>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold text-white" href="#" role="button" data-bs-toggle="dropdown">NMC</a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Link</a></li>
                      <li><a class="dropdown-item" href="#">Another link</a></li>
                      <li><a class="dropdown-item" href="#">A third link</a></li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link fw-semibold text-white" href="#">Calendar-Events</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link fw-semibold text-white" href="#">Contact Us</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold text-white" href="#" role="button" data-bs-toggle="dropdown">Feedback</a>
                    {{-- <button class="btn btn-default dropdown-toggle" type="button" data-bs-toggle="dropdown">Tutorials
                      <span class="caret"></span></button> --}}
                    <ul class="dropdown-menu theme-bg-color">
                
                        <li class="dropdown-submenu theme-bg-color ">
                          <a class="test nav-link dropdown-toggle text-white fw-semibold mx-2" tabindex="-1" href="#">New dropdown <span class="caret"></span></a>
                          <ul class="dropdown-menu theme-bg-color">
                            <li><a class="nav-link text-white fw-semibold mx-3" tabindex="-1" href="#">2nd level dropdown</a></li>
                            <li><a class="nav-link text-white fw-semibold mx-3" tabindex="-1" href="#">2nd level dropdown</a></li>
                            <li class="dropdown-submenu theme-bg-color">
                              <a class="test nav-link dropdown-toggle text-white fw-semibold mx-3" href="#">Another dropdown <span class="caret"></span></a>
                              <ul class="dropdown-menu theme-bg-color">
                                <li><a class="nav-link text-white fw-semibold mx-3" href="#">3rd level dropdown</a></li>
                                <li><a class="nav-link text-white fw-semibold mx-3" href="#">3rd level dropdown</a></li>
                              </ul>
                            </li>
                          </ul>
                        </li>
                       
                      <li><a class="dropdown-item nav-link text-white fw-semibold mx-2" href="#">Another link</a></li>
                      <li><a class="dropdown-item nav-link text-white fw-semibold mx-2" href="#">A third link</a></li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link fw-semibold text-white" href="#">RTI ACT</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
        </div>
      </div>
  
      @include('frontend.partials.header-icon')

    </div>
  </section>