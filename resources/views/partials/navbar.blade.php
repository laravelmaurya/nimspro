<!-- Navbar with Menu Bar and Logo, Organization Name Hidden on Mobile -->
<nav class="main-header navbar navbar-expand-lg navbar-light bg-white">
  <div class="container-fluid">
      <div class="row w-100">
          <!-- Left-side Menu Bar -->
          <div class="col-2 d-flex align-items-center">
              <a class="nav-link mb-auto" data-widget="pushmenu" href="#" role="button">
                  <i class="fas fa-bars"></i>
              </a>
          </div>

          <!-- Centered Logo and Organization Name (Hidden on Mobile) -->
          <div class="col-8 text-center d-flex justify-content-center align-items-center">
              <a class="navbar-brand d-flex align-items-center ml-4" href="{{config('app.url')}}">
                  <img src="{{ url($addPublic.'frontend/img/nims-logo.jpg') }}" alt="NIMS Logo" style="width: 60px;" class="img-fluid mr-2">
                  <div class="text-center theme-color d-none d-lg-block">
                      <h5 class="m-0 font-weight-bolder">Nizam's Institute of Medical Sciences</h5>
                      <h6 class="m-0 font-weight-light">(A University Established Under State Act)</h6>
                      <h5 class="m-0 font-weight-bolder">Hyderabad - 500082, Telangana, India</h5>
                  </div>
              </a>
          </div>

          <!-- Optional right-side controls -->
          <div class="col-2"></div>
      </div>
  </div>
</nav>
