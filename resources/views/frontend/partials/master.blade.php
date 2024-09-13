<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Font Awesome -->
  @php 
     $addPublic = config('app.url').'public/frontend/';
     $onlyPublic = 'public';
   @endphp

 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{asset($addPublic.'bootstrap-5.3.3-dist/css/bootstrap.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset($addPublic.'bootstrap-5.3.3-dist/css/baguetteBox.min.css')}}" />
  <link rel="stylesheet" href="{{asset($addPublic.'bootstrap-5.3.3-dist/css/compact-gallery.css')}}">
  <link rel="stylesheet" href="{{asset($addPublic.'bootstrap-5.3.3-dist/css/fontawesome-free/css/all.min.css')}}">
  <script src="{{asset($addPublic.'bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js')}}"></script>
<!-- Select2 -->
<link rel="stylesheet" href="{{asset($addPublic.'../plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset($addPublic.'../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

<!-- DataTables -->
<link rel="stylesheet" href="{{asset($addPublic.'../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset($addPublic.'../plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script>
    const base_url = '<?php echo url("")  ?>';
    // var base_url = urlPublic + 'public/';
  </script>

 
  <?php 
  date_default_timezone_set('Asia/Kolkata');  
  $banner = $addPublic.'img/banner1.jpg';
  ?>
   
   <?php 

   ?>
 @stack('style')
 <style>
  /* Make the body and html fill the entire page */
  html, body {
      height: 100%;
      margin: 0;
  }

  /* Flex container for the entire page */
  .footer-wrapper {
      display: flex;
      flex-direction: column;
      padding-top:8% 
  }

</style>

<style>

        .blink_me {
            height: auto;
            animation: blink 1s infinite; /* 1s duration, infinite loop */
        }

        /* Keyframes for blinking effect */
        @keyframes blink {
            0% { opacity: 1; }   /* Image fully visible */
            50% { opacity: 0; }  /* Image invisible */
            100% { opacity: 1; } /* Image fully visible again */
        }

.landing-banner-section-small-dev, .landing-banner-section {
  background:url("{{ asset($banner) }}") no-repeat bottom/cover;
  height: 470px;
  margin-bottom: 52px;
  padding-top: 0;
}
</style>

<style>
  .container {
  /* width: 35em; */
  height: 8em;
  margin: 1em auto;
  overflow: hidden;
  background: white;
  position: relative;
  box-sizing: border-box;
}

.marquee {
  top: 6em;
  position: relative;
  box-sizing: border-box;
  animation: marquee 15s linear infinite;
}

.marquee:hover {
  animation-play-state: paused;
}

/* Make it move! */
@keyframes marquee {
  0%   { top:   8em }
  100% { top: -11em }
}


</style>
<style>
  @media screen and (max-width: 480px) {
    logo-text {
      background-color: lightgreen;
    }
    #scrollToTopBtn{
      margin-bottom: 65px;
    }
  }


  .left-card, .right-card{
    width: 50%;
  }
  </style>
<style>
 
  @media screen and (max-width: 992px) {
    .left-card, .right-card{
    width: 100%;
  }
  /* .eight-card{
    margin-top: 62%;
  } */
  }
  
  </style>

  <style>
    @media screen and (min-width: 776px) {
  /* .eight-card{
    margin-top: 64%;
  } */
  .landing-banner-section-small-dev{
    all: unset;
  }
  }
  </style>
<style>
 
  @media screen and (max-width: 776px) {
  /* .eight-card{
    margin-top: 64%;
  } */
  .landing-banner-section{
    all: unset;
  }
  }
  
  .nav-item{
    background: #036CC5;
    margin: 2px;
    border-radius: 1px;
  }
  </style>
<style>
 
  .list-group-item{
    padding: 1.5px;
    border-top-left-radius: unset;
    border-top-right-radius: unset;
  }
  </style>
  <style>
    #top-bar {
      background-color: #036CC5;
      color: white;
    }
    .justify-text {
      text-align: justify;
    }
    .nav-link {
      white-space: nowrap;
    }
    .navbar-nav {
      flex-wrap: wrap;
    }

    .theme-bg-color{
      background-color: #036CC5;
    }
    .theme-color{
      color: #036CC5;
    }

     .eight-card .card{
    height: 100%;
  }
  </style>

<style>

/* .footer {
  background-color: #036CC5;
  color: white;
  padding: 20px 0;
}
.footer a {
  color: white;
  text-decoration: none;
} */
.footer a:hover {
  text-decoration: underline;
}
.footer .social-icons a {
  margin: 0 10px;
}
.footer-bottom {
  background-color: #036CC5;
  padding: 10px 0;
  color: white;
}

.footer-card{
  height: 93%
}
</style>
<style>
 .nav-item a:hover {
    background-color: #024279;
    color: white;
  }
</style>
<style>
#scrollToTopBtn {
    display: none; /* Hidden by default */
    position: fixed; /* Fixed/sticky position */
    bottom: 20px; /* Place the button at the bottom of the page */
    right: 30px; /* Place the button 30px from the right */
    z-index: 99; /* Make sure it does not overlap */
    border: none; /* Remove borders */
    outline: none; /* Remove outline */
    background-color: #036CC5; /* Set a background color */
    color: white; /* Text color */
    cursor: pointer; /* Add a mouse pointer on hover */
    padding: 15px; /* Some padding */
    border-radius: 10px; /* Rounded corners */
    font-size: 18px; /* Increase font size */
}

#scrollToTopBtn:hover {
background-color: #024a80; /* Add a dark-grey background on hover */
}

</style>
<style>
  .dropdown-submenu {
    position: relative;
  }
  
  .dropdown-submenu .dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -1px;
  }

 .dropdown-submenu {
    position: relative;
  }
  
  .dropdown-submenu .dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -1px;
  }


  @media screen and (max-width: 768px) {
    .dropdown-submenu {
    position: static;
    /* margin-left: 2%; */
  }

  .dropdown-menu a {
    padding-left: 1%;
    padding-right: 1%;
  }

}
</style>
<style>
    .table td{
      padding: 0px;
    }
    th{
      width: auto% !important;
    }
    .th-serial-no, .th-image,.th-status,.th-action{width:5%}
    .th-created-at,.th-published-on,.th-start-date,.th-end-date{width:9%}

    table.dataTable tbody tr:hover {
      background-color:#007bff !important;
      color:#fff;
      font-weight: bold;
    }

</style>
</head>
<body>
@include('frontend.partials.top-bar-and-navbar')
  @if(url()->current() ==  url('/') )
      @include('frontend.partials.banner-section')
      @include('frontend.partials.section-part')
  @endif
@yield('content')
@include('frontend.partials.image-modals')
@include('frontend.partials.footer')

<!-- jQuery -->
<script src="{{asset($addPublic.'../plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset($addPublic.'../plugins/jquery-ui/jquery-ui.min.js')}}"></script>

<script src="{{asset($addPublic.'bootstrap-5.3.3-dist/js/baguetteBox.min.js')}}"></script>

<!-- Select2 -->
<script src="{{asset($addPublic.'../plugins/select2/js/select2.full.min.js')}}"></script>
<script  src="{{asset($addPublic.'../js/ckeditor/ckeditor.js')}}"></script>


<!-- DataTables -->
<script src="{{asset($addPublic.'../plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset($addPublic.'../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset($addPublic.'../plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset($addPublic.'../plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<!-- DataTables  & Plugins -->
<script src="{{asset($addPublic.'../plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset($addPublic.'../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset($addPublic.'../plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset($addPublic.'../plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset($addPublic.'../plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset($addPublic.'../plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset($addPublic.'../plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset($addPublic.'../plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset($addPublic.'../plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset($addPublic.'../plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset($addPublic.'../plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset($addPublic.'../plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script>
    baguetteBox.run('.compact-gallery', { animation: 'slideIn'});
</script>


<script>
// Get the button
let mybutton = document.getElementById("scrollToTopBtn");


// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {
  scrollFunction();
};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
    mybutton.style.border = "2px solid white";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
mybutton.onclick = function() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
};
</script>
<script>
   // Replace all elements with the 'editor' class with CKEditor
   document.querySelectorAll('.ckeditor_frontend').forEach(function(element) {
        CKEDITOR.replace(element, {
            readOnly: true , // Set CKEditor to read-only mode
            height: 1000,
 
        });
    });
</script>

<script>
  $(document).ready(function(){
    $('.dropdown-submenu a.test').on("click", function(e){
      alert();
      $(this).next('ul').toggle();
      e.stopPropagation();
      e.preventDefault();
    });
  });
  </script>
{{-- <script>
  // Initialize CKEditor in read-only mode and hide the toolbar
  CKEDITOR.replace('editor', {
      readOnly: true,
      toolbar: [], // Hide the toolbar
      removePlugins: 'resize',
      height: 300
  });

  editor.setReadOnly(true); // Switch back to read-only mode
          editor.ui.space('top').setStyle('display', 'none'); // Hide the toolbar
          this.textContent = 'Edit Content'; // Reset button text
</script> --}}
<script>
  $.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
</script>



<script>
  function sync(){

    // alert("Submitted");
    var number = document.getElementById("number");
      var numbertwo = document.getElementById("numbertwo");
      // numbertwo.value= Base64.encode(number.value);
      numbertwo.value= Base64.encode(number.value);
      console.log(number.value + '     ' +numbertwo.value);
      var title = document.getElementById("title");
      var titletwo = document.getElementById("titletwo");
      // titletwo.value= Base64.encode(title.value); 
      titletwo.value= Base64.encode(title.value); 
      console.log('         '+title.value+'              '+titletwo.value);

      var start_date = document.getElementById("start_date");
      var datepicker_s = document.getElementById("datepicker_s");
      datepicker_s.value= Base64.encode(start_date.value); 

      var end_date = document.getElementById("end_date");
      var datepicker_e = document.getElementById("datepicker_e");
      
      datepicker_e.value= Base64.encode(end_date.value); 
      console.log('         '+start_date.value+'              '+datepicker_s.value);
      console.log('         '+end_date.value+'              '+datepicker_e.value);

      var notes = CKEDITOR.instances.notes.getData();

      console.log(notes);
      // $("#notes1").val(Base64.encode(notes));
      $("#notes1").val(notes);

      // alert(notes)
      // e.preventDefault();
    // $('form').submit();
  }

</script>
<script>
  function modalCorrigendum(id){
    alert(id)
    $('#create-admissions-associate-modal').modal('show');
  }
  function dynamicForm(form_id){

    $('#'+form_id).submit(); 
  }

  

</script>


<script type="text/javascript">
$(document).ready(function(){

  $(".datetimepicker").each(function () {
      $(this).datetimepicker();
  });
  });
  
</script>
<script type="text/javascript">
  $(function() {
  var date = new Date();
  var currentMonth = date.getMonth();
  var currentDate = date.getDate();
  var currentYear = date.getFullYear();
  $('.datepicker').datepicker({
    minDate: -7,dateFormat: 'dd/mm/yy'
  
  
  });
  });
  </script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  });
</script>
<script>
$(document).ready(function() {
  function fetch_data(query = '', page = 1, sort_by = '', sort_direction = 'asc') {
    $.ajax({
      url: "{{ route('tenders.index') }}",
      method: 'Get',
      data: { search: query, page: page, sort_by: sort_by, sort_direction: sort_direction },
      success: function(data) {
        $('#tender-table').html(data.data);
        $('#pagination-links').html(data.links);
      }
    });
  }

  $('#table_search').on('keyup', function() {
    var query = $(this).val();
    fetch_data(query);
  });

  $(document).on('click', '.pagination a', function(event) {
    event.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    var query = $('#table_search').val();
    var sort_by = $('.sort.active').data('sort');
    var sort_direction = $('.sort.active').data('direction') || 'asc';
    fetch_data(query, page, sort_by, sort_direction);
  });

  $(document).on('click', '.sort', function(event) {
    event.preventDefault();
    var sort_by = $(this).data('sort');
    var direction = $(this).data('direction') === 'asc' ? 'desc' : 'asc';
    
    $('.sort').removeClass('active');
    $(this).addClass('active').data('direction', direction);
    var query = $('#table_search').val();
    fetch_data(query, 1, sort_by, direction);
  });
});
</script>
<script>
  function downloadImageByPath(modifiedUrl,suggestFileName) {
    var modifiedUrl = modifiedUrl;
    var suggestFileName = suggestFileName;
      // console.log('modifiedUrl = ' + modifiedUrl + ' suggestFileName =' +suggestFileName);
      //  alert('Downloading image');
      // Create an anchor element
      var anchor = document.createElement("a");

      // Set the href attribute to the image path
      anchor.href = base_url + modifiedUrl;

      // Set the download attribute to suggest a filename for the download
      anchor.download = 'downloaded_'+suggestFileName;

      // Simulate a click event on the anchor element
      var clickEvent = new MouseEvent("click", {
        view: window,
        bubbles: true,
        cancelable: false
      });
      anchor.dispatchEvent(clickEvent);
 }
 </script>
 <script>
  function viewImageByPah(modifiedUrl,suggestFileName,title) {

      console.log('modifiedUrl = ' + modifiedUrl, 'suggestFileName =' +suggestFileName,'title'+title);
      //  alert('Downloading image');
      $('#show-image-title').text(title);
      // Set the href attribute to the image path
      imageUrl = base_url+modifiedUrl;
      $('#image-modal').modal('show');
      $('#image_modal_img').attr('src', imageUrl);
      $('.modal').modal('hide');
 }
 </script>
<script>
  function downloadImage(te,id,val,id2) {

// alert(te+' '+id);
    var url = "{{ route('downloadImage.page', [':te', ':id',':val',':id2']) }}";
        url = url.replace(':te', te);
        url = url.replace(':id', id);
        url = url.replace(':val', val);
        url = url.replace(':id2', id2);


    $.ajax({
            url: url,
            method: 'GET',
            success: function (data) 
            {
              const myJSON1 = JSON.stringify(data.nims_research_id);
              console.log('response =' + myJSON1);
                
              // Log the entire data object to see its structure
                console.log('Response data:', data);
                // alert('Response data:', data);
                var imagePath = data.nims_research_id	;
                var modifiedUrl = imagePath.replace('public', '/public/storage');
                // alert(myJSON1);
                var suggestFileName = modifiedUrl.split("/").pop();
                 console.log('modifiedUrl = ' + modifiedUrl, 'suggestFileName =' +suggestFileName);
                //  alert('Downloading image');
            
                 // Create an anchor element
                 var anchor = document.createElement("a");
              
                 // Set the href attribute to the image path
                 anchor.href = base_url+modifiedUrl;
              
                 // Set the download attribute to suggest a filename for the download
                 anchor.download = "downloaded_"+suggestFileName;
              
                 // Simulate a click event on the anchor element
                 var clickEvent = new MouseEvent("click", {
                   view: window,
                   bubbles: true,
                   cancelable: false
                 });
                 anchor.dispatchEvent(clickEvent);
            },
            error: function (xhr, status, error) {          
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').remove();
                    var response = xhr;
                    // console.error('Error:', response);
                    if (response.status === 422 || response.status === 400) {
                      console.error('Error:', response);
                        if (response.status === 400) {
                            window.location.href = response.responseJSON.redirect + '=' + response.responseJSON.errorTamperingValue;
                        }
                        var errors = response.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            var input = $('[name=' + key + ']');
                            input.addClass('is-invalid');
                            input.closest('.form-group').append('<span class="invalid-feedback d-inline">' + value[0] + '</span>');
                        });
                    } else {
                        alert('An error occurred. Please try again.');
                    }
              }                                   
            });

 
 }
 </script>
<script>
  function viewImage(te,id,val,id2,title) {

// alert(te+' '+id);
    var url = "{{ route('downloadImage.page', [':te', ':id',':val',':id2']) }}";
        url = url.replace(':te', te);
        url = url.replace(':id', id);
        url = url.replace(':val', val);
        url = url.replace(':id2', id2);


    $.ajax({
            url: url,
            method: 'GET',
            success: function (data) 
            {
              const myJSON1 = JSON.stringify(data.nims_research_id);
              console.log('response =' + myJSON1);
                
              // Log the entire data object to see its structure
                console.log('Response data:', data);
                // alert('Response data:', data);
                var imagePath = data.nims_research_id	;
                var modifiedUrl = imagePath.replace('public', '/public/storage');
                // alert(myJSON1);
                var suggestFileName = modifiedUrl.split("/").pop();
                 console.log('modifiedUrl = ' + modifiedUrl, 'suggestFileName =' +suggestFileName);
                //  alert('Downloading image');

                $('#show-image-title').text(title);
                 // Set the href attribute to the image path
                 imageUrl = base_url+modifiedUrl;
                $('#image-modal').modal('show');
                $('#image_modal_img').attr('src', imageUrl);
                $('.modal').modal('hide');
                
            },
            error: function (xhr, status, error) {          
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').remove();
                    var response = xhr;
                    // console.error('Error:', response);
                    if (response.status === 422 || response.status === 400) {
                      console.error('Error:', response);
                        if (response.status === 400) {
                            window.location.href = response.responseJSON.redirect + '=' + response.responseJSON.errorTamperingValue;
                        }
                        var errors = response.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            var input = $('[name=' + key + ']');
                            input.addClass('is-invalid');
                            input.closest('.form-group').append('<span class="invalid-feedback d-inline">' + value[0] + '</span>');
                        });
                    } else {
                        alert('An error occurred. Please try again.');
                    }
              }                                   
            });
 }
 </script>

<script>
$("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })
</script>

<script>
 var Base64 = {
    // private property
    _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",

    // public method for encoding
    encode: function (input) {
        var output = "";
        var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
        var i = 0;

        input = Base64._utf8_encode(input);

        while (i < input.length) {
            chr1 = input.charCodeAt(i++);
            chr2 = input.charCodeAt(i++);
            chr3 = input.charCodeAt(i++);

            enc1 = chr1 >> 2;
            enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
            enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
            enc4 = chr3 & 63;

            if (isNaN(chr2)) {
                enc3 = enc4 = 64;
            } else if (isNaN(chr3)) {
                enc4 = 64;
            }

            output = output +
                Base64._keyStr.charAt(enc1) + Base64._keyStr.charAt(enc2) +
                Base64._keyStr.charAt(enc3) + Base64._keyStr.charAt(enc4);
        }

        return output;
    },

    // public method for decoding
    decode: function (input) {
        var output = "";
        var chr1, chr2, chr3;
        var enc1, enc2, enc3, enc4;
        var i = 0;

        input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

        while (i < input.length) {
            enc1 = Base64._keyStr.indexOf(input.charAt(i++));
            enc2 = Base64._keyStr.indexOf(input.charAt(i++));
            enc3 = Base64._keyStr.indexOf(input.charAt(i++));
            enc4 = Base64._keyStr.indexOf(input.charAt(i++));

            chr1 = (enc1 << 2) | (enc2 >> 4);
            chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
            chr3 = ((enc3 & 3) << 6) | enc4;

            output = output + String.fromCharCode(chr1);

            if (enc3 != 64) {
                output = output + String.fromCharCode(chr2);
            }
            if (enc4 != 64) {
                output = output + String.fromCharCode(chr3);
            }
        }

        output = Base64._utf8_decode(output);

        return output;
    },

    // private method for UTF-8 encoding
    _utf8_encode: function (string) {
        // string = string.replace(/\r\n/g, "\n");
        string = string.toString().replace(/\r\n/g, "\n");
        var utftext = "";

        for (var n = 0; n < string.length; n++) {
            var c = string.charCodeAt(n);

            if (c < 128) {
                utftext += String.fromCharCode(c);
            } else if ((c > 127) && (c < 2048)) {
                utftext += String.fromCharCode((c >> 6) | 192);
                utftext += String.fromCharCode((c & 63) | 128);
            } else {
                utftext += String.fromCharCode((c >> 12) | 224);
                utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                utftext += String.fromCharCode((c & 63) | 128);
            }
        }

        return utftext;
    },

    // private method for UTF-8 decoding
    _utf8_decode: function (utftext) {
        var string = "";
        var i = 0;
        var c = 0, c1 = 0, c2 = 0, c3 = 0;

        while (i < utftext.length) {
            c = utftext.charCodeAt(i);

            if (c < 128) {
                string += String.fromCharCode(c);
                i++;
            } else if ((c > 191) && (c < 224)) {
                c2 = utftext.charCodeAt(i + 1);
                string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                i += 2;
            } else {
                c2 = utftext.charCodeAt(i + 1);
                c3 = utftext.charCodeAt(i + 2);
                string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                i += 3;
            }
        }

        return string;
    }
}

</script>
@if ($message = session('success'))
<script>
  var message = "<?php echo json_encode($message); ?>";
  toastr.success(message)
</script>
@elseif ($message = session('error'))
<script>
  var message = "<?php echo json_encode($message); ?>";
  toastr.error(message)
</script>
@endif

<script>
  function redirectToCurrentPage() {
    window.location.reload();
}  
</script>


@stack('scripts')
</body>
</html>
