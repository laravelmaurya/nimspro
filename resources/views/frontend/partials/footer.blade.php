<div class="footer-wrapper">
  <div class="content">
      <footer class="footer">
        <div class="container-fluid">
          @include('frontend.partials.header-icon')
        </div>
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-2 col-sm-12 text-center">  
              <a class="navbar-brand" href="#">
                <img class="mt-md-5 mt-sm-4" src="{{ url($addPublic.'img/nims-logo.jpg')}}" alt="NIMS Logo" style="width: 90px;">
              </a>
            </div>
            <div class="col-md-3 col-sm-12">
              <div class="card mt-2 mb-2 footer-card shadow-lg">
                <div class="card-body">
                  <h5 class="border p-1 theme-bg-color text-white"><i class='fas fa-address-card'></i> Contact Us</h5>
                    <p>
                      Punjagutta, Hyderabad, Telangana, India <br>
            
                      Phone No. +91-40-23489000,+91-40-23396552 <br>
            
                      Phone No. +91-40-23489244,+91-40-23489245 <br>
            
                      Pin Code: 500082
                    </p>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-12">
              <div class="card mt-2 mb-2 footer-card shadow-lg">
                <div class="card-body">
              <h5 class="border p-1 theme-bg-color text-white">Statistics</h5>
              <div>
                  <span>Webportal Visitor's:</span>
                  <span class="text-danger fw-bold">1500</span>
              </div>
            </div>
            </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <div class="card mt-2 mb-2 footer-card shadow-lg">
                <div class="card-body">
                <h5 class="border p-1 theme-bg-color text-white"><i class="fas fa-link" aria-hidden="true"></i>
                Useful Links</h5>
                <p class="card-text h5 ">
                  <a class="text-dark" target="_blank" href="http://aarogyasri.telangana.gov.in" onclick="alert('You will be redirect to another website')">http://aarogyasri.telangana.gov.in</a> 
                </p>
                <p class="card-text h5">
                    <a class="text-dark" target="_blank" href="http://www.cghs.nic.in" onclick="alert('You will be redirect to another website')">http://www.cghs.nic.in</a>
                </p>
                <p class="card-text h5">
                    <a class="text-dark" target="_blank" href="http://www.medicalnewstoday.com" onclick="alert('You will be redirect to another website')">http://www.medicalnewstoday.com</a> 
                </p>
                <p class="card-text h5">
                    <a class="text-dark" target="_blank" href="http://ors.gov.in/copp/" onclick="alert('You will be redirect to another website')">http://ors.gov.in/copp/</a>
                </p>
                <p class="card-text h5">
                    <a class="text-dark" target="_blank" href="http://www.nad.gov.in" onclick="alert('You will be redirect to another website')">http://www.nad.gov.in</a>
                </p>
            </div>
          </div>
          </div>
          </div>
        </div>
      </footer>
      <div class="footer-bottom text-center text-uppercase">                         
          <a class="text-white text-decoration-none fw-bold" href="#">Copyright © 2014 NIMS All rights reserved.</a> <span>|</span>
          <a class="text-white text-decoration-none fw-bold" href="#">NIMS Disclaimer</a> <span>|</span>
          <a class="text-white text-decoration-none fw-bold" target="_blank" href="http://www.cdac.in">Designed & Developed By C-DAC - Noida</a> |
          <a  class="text-white text-decoration-none fw-bold" href="#"><?php //echo "Last Updated: ".date("d-M-Y H:i:s",filemtime("errorlog/audit_trail.log"));?></a>
      </div>
      <button id="scrollToTopBtn" title="Go to top"><i class="fas fa-arrow-up"></i></button>
   </div>
</div>