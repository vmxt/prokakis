@extends('layouts.app2')
@section('styles')

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
    <link rel="stylesgeet" href="https://rawgit.com/creativetimofficial/material-kit/master/assets/css/material-kit.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
@endsection

@section('modal')
   @foreach($businessNewsOpportunity as $key => $newsOpportunityDetails)
    <div class="modal fade " id="content_business_modal{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="ContentBusinessNews" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ContentBusinessNews">{{ $newsOpportunityDetails->business_title }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p class="card-text p-1">{!! $newsOpportunityDetails->content_business !!}</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-raised btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    @endforeach
@endsection

@section('content')
   <style type="text/css">
       html *{
    -webkit-font-smoothing: antialiased;
}

.h6, h6 {
    font-size: .75rem !important;
    font-weight: 500;
    font-family: Roboto,Helvetica,Arial,sans-serif;
    line-height: 1.5em;
    text-transform: uppercase;
}

.name h6 {
    margin-top: 10px;
    margin-bottom: 10px;
}

.navbar {
    border: 0;
    border-radius: 3px;
    padding: .625rem 0;
    margin-bottom: 20px;
    color: #555;
    background-color: #fff!important;
    box-shadow: 0 4px 18px 0 rgba(0,0,0,.12), 0 7px 10px -5px rgba(0,0,0,.15) !important;
    z-index: 1000 !important;
    transition: all 150ms ease 0s;
    
}

.navbar.navbar-transparent {
    z-index: 1030;
    background-color: transparent!important;
    box-shadow: none !important;
    padding-top: 25px;
    color: #fff;
}

.navbar .navbar-brand {
    position: relative;
    color: inherit;
    height: 50px;
    font-size: 1.125rem;
    line-height: 30px;
    padding: .625rem 0;
    font-weight: 300;
    -webkit-font-smoothing: antialiased;
}

.navbar .navbar-nav .nav-item .nav-link:not(.btn) .material-icons {
    margin-top: -7px;
    top: 3px;
    position: relative;
    margin-right: 3px;
}

.navbar .navbar-nav .nav-item .nav-link .material-icons {
    font-size: 1.25rem;
    max-width: 24px;
    margin-top: -1.1em;
}

.navbar .navbar-nav .nav-item .nav-link .fa, .navbar .navbar-nav .nav-item .nav-link .material-icons {
    font-size: 1.25rem;
    max-width: 24px;
    margin-top: 0px;
}

.navbar .navbar-nav .nav-item .nav-link {
    position: relative;
    color: inherit;
    padding: .9375rem;
    font-weight: 400;
    font-size: 12px;
    border-radius: 3px;
    line-height: 20px;
}

a .material-icons {
    vertical-align: middle;
}

.fixed-top {
    position: fixed;
    z-index: 1030;
    left: 0;
    right: 0;
}

.profile-page .page-header {
    height: 380px;
    background-position:center;
}

.page-header {
    height: 100vh;
    background-size: cover;
    margin: 0;
    padding: 0;
    border: 0;
    display: flex;
    align-items: center;
}

.header-filter:after, .header-filter:before {
    position: absolute;
    z-index: 1;
    width: 100%;
    height: 100%;
    display: block;
    left: 0;
    top: 0;
    content: "";
}

.header-filter::before {
    background: rgba(0,0,0,.5);
}

.main-raised {
    margin: -60px 30px 0;
    border-radius: 6px;
    box-shadow: 0 16px 24px 2px rgba(0,0,0,.14), 0 6px 30px 5px rgba(0,0,0,.12), 0 8px 10px -5px rgba(0,0,0,.2);
}

.main {
    background: #FFF;
    position: relative;
    z-index: 3;
}

.profile-page .profile {
    text-align: center;
}

.profile-page .profile img {
    max-width: 260px;
    width: 100%;
    margin: 0 auto;
    -webkit-transform: translate3d(0,-50%,0);
    -moz-transform: translate3d(0,-50%,0);
    -o-transform: translate3d(0,-50%,0);
    -ms-transform: translate3d(0,-50%,0);
    transform: translate3d(0,-50%,0);
}

.img-raised {
    box-shadow: 0 5px 15px -8px rgba(0,0,0,.24), 0 8px 10px -5px rgba(0,0,0,.2);
}

.rounded-circle {
    border-radius: 50%!important;
}

.img-fluid, .img-thumbnail {
    max-width: 100%;
    height: auto;
}

.title {
    margin-top: 30px;
    margin-bottom: 25px;
    min-height: 32px;
    color: #3C4858;
    font-weight: 700;
    font-family: "Roboto Slab","Times New Roman",serif;
}

.profile-page .description {
    margin: 1.071rem auto 0;
    max-width: 600px;
    color: #999;
    font-weight: 300;
}

p {
    font-size: 14px;
    margin: 0 0 10px;
}

.profile-page .profile-tabs {
    margin-top: 5rem;
}

.nav-pills, .nav-tabs {
    border: 0;
    border-radius: 3px;
    padding: 0 15px;
}

.nav .nav-item {
    position: relative;
    margin: 0 2px;
}

.nav-pills.nav-pills-icons .nav-item .nav-link {
    border-radius: 4px;
}

.nav-pills .nav-item .nav-link.active {
    color: #fff;
    background-color: #009688;
    box-shadow: 0 5px 20px 0 rgba(0,0,0,.2), 0 13px 24px -11px rgba(156,39,176,.6);
}

.nav-pills .nav-item .nav-link {
    line-height: 24px;
    font-size: 12px;
    font-weight: 500;
    min-width: 100px;
    color: #555;
    transition: all .3s;
    border-radius: 30px;
    padding: 10px 15px;
    text-align: center;
}

.nav-pills .nav-item .nav-link:not(.active):hover {
    background-color: rgba(200,200,200,.2);
}


.nav-pills .nav-item i {
    display: block;
    font-size: 30px;
    padding: 15px 0;
}

.tab-space {
    padding: 20px 0 50px;
}

.profile-page .gallery {
    margin-top: 3.213rem;
    padding-bottom: 50px;
}

.profile-page .gallery img {
    width: 100%;
    margin-bottom: 2.142rem;
}

.profile-page .profile .name{
    margin-top: -80px;
}

img.rounded {
    border-radius: 6px!important;
}

.tab-content>.active {
    display: block;
}

/*buttons*/
.btn {
    position: relative;
    padding: 12px 30px;
    margin: .3125rem 1px;
    font-size: .75rem;
    font-weight: 400;
    line-height: 1.428571;
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 0;
    border: 0;
    border-radius: .2rem;
    outline: 0;
    transition: box-shadow .2s cubic-bezier(.4,0,1,1),background-color .2s cubic-bezier(.4,0,.2,1);
    will-change: box-shadow,transform;
}

.btn.btn-just-icon {
    font-size: 20px;
    height: 41px;
    min-width: 41px;
    width: 41px;
    padding: 0;
    overflow: hidden;
    position: relative;
    line-height: 41px;
}

.btn.btn-just-icon fa{
    margin-top: 0;
    position: absolute;
    width: 100%;
    transform: none;
    left: 0;
    top: 0;
    height: 100%;
    line-height: 41px;
    font-size: 20px;
}
.btn.btn-link{
    background-color: transparent;
    color: #999;
}

/* dropdown */




.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    float: left;
    min-width: 11rem !important;
    margin: .125rem 0 0;
    font-size: 1rem;
    color: #212529;
    text-align: left;
    background-color: #fff;
    background-clip: padding-box;
    border-radius: .25rem;
    transition: transform .3s cubic-bezier(.4,0,.2,1),opacity .2s cubic-bezier(.4,0,.2,1);
}

.dropdown-menu.show{
    transition: transform .3s cubic-bezier(.4,0,.2,1),opacity .2s cubic-bezier(.4,0,.2,1);
}


.dropdown-menu .dropdown-item:focus, .dropdown-menu .dropdown-item:hover, .dropdown-menu a:active, .dropdown-menu a:focus, .dropdown-menu a:hover {
    box-shadow: 0 4px 20px 0 rgba(0,0,0,.14), 0 7px 10px -5px rgba(156,39,176,.4);
    background-color: #9c27b0;
    color: #FFF;
}
.show .dropdown-toggle:after {
    transform: rotate(180deg);
}

.dropdown-toggle:after {
    will-change: transform;
    transition: transform .15s linear;
}


.dropdown-menu .dropdown-item, .dropdown-menu li>a {
    position: relative;
    width: auto;
    display: flex;
    flex-flow: nowrap;
    align-items: center;
    color: #333;
    font-weight: 400;
    text-decoration: none;
    font-size: .8125rem;
    border-radius: .125rem;
    margin: 0 .3125rem;
    transition: all .15s linear;
    min-width: 7rem;
    padding: 0.625rem 1.25rem;
    min-height: 1rem !important;
    overflow: hidden;
    line-height: 1.428571;
    text-overflow: ellipsis;
    word-wrap: break-word;
}

.dropdown-menu.dropdown-with-icons .dropdown-item {
    padding: .75rem 1.25rem .75rem .75rem;
}

.dropdown-menu.dropdown-with-icons .dropdown-item .material-icons {
    vertical-align: middle;
    font-size: 24px;
    position: relative;
    margin-top: -4px;
    top: 1px;
    margin-right: 12px;
    opacity: .5;
}

/* footer */

footer{
    margin-top: 10px;
    color: #555;
    padding: 25px;
    font-weight: 300;
    
}
.footer p{
    margin-bottom: 0;
    font-size: 14px;
    margin: 0 0 10px;
    font-weight: 300;
}
footer p a{
    color: #555;
    font-weight: 400;
}

footer p a:hover {
    color: #9f26aa;
    text-decoration: none;
}

.profile-content{
    padding-bottom: 250px;
}


   </style>


<div class="profile-page">
    <nav class="navbar navbar-color-on-scroll navbar-transparent    fixed-top  navbar-expand-lg "  color-on-scroll="100"  id="sectionsNav">
        <div class="container">

        </div>
    </nav>
    
    <div class="page-header header-filter" data-parallax="true" style="background-image:url('{{ asset('public/banner/') }}/<?php echo $profileCoverPhoto; ?>');"></div>
    <div class="main main-raised">
        <div class="profile-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 ml-auto mr-auto">
                       <div class="profile">
                            <div class="avatar">
                                <img src="{{ asset('public/images/') }}/<?php echo $profileAvatar; ?>" alt="Circle Image" class="img-raised rounded-circle img-fluid">
                            </div>
                            <div class="name">
                                <h3 class="title"><?php echo substr($brand_slogan[0], 0, 60); ?></h3>
                                <h6 class="title"><?php echo substr($brand_slogan[1], 0, 70); ?></h6>
                          
                                <!-- <a href="#pablo" class="btn btn-just-icon btn-link btn-facebook"><i class="fa fa-facebook"></i></a> -->
                                <a href="<?php echo $companyProfile->company_website; ?>"><?php echo $companyProfile->company_website; ?></a>
                                <h6>Social Media Accounts</h6>
                                <a href="<?php echo $companyProfile->facebook; ?>" class="btn btn-just-icon btn-link btn-facebook"><i class="fa fa-facebook"></i></a>
                                <a href="<?php echo $companyProfile->twitter; ?>" class="btn btn-just-icon btn-link btn-twitter"><i class="fa fa-twitter"></i></a>
                              <!--   <a href="<?php echo $companyProfile->company_website; ?>" class="btn btn-just-icon btn-link btn-pinterest"><i class="fa fa-pinterest"></i></a> -->
                                <a href="<?php echo $companyProfile->linkedin; ?>" class="btn btn-just-icon btn-link btn-linkedin"><i class="fa fa-linkedin"></i></a>
                                <a href="<?php echo $companyProfile->instagram; ?>" class="btn btn-just-icon btn-link btn-instagram"><i class="fa fa-instagram"></i></a>
                                <a href="<?= $companyProfile->company_email; ?>" class="btn btn-just-icon btn-link btn-envelope"><i class="fa fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
              
                <div class="row">
                    @foreach($businessNewsOpportunity as $key => $newsOpportunityDetails)
                    <div class="col-md-4 ml-auto mr-auto  " >
                        <div class="profile-tabs" style="height: 90%">
                            <div class="card bg-light h-100" >
                            @if($newsOpportunityDetails->feature_image)
                                <img width="300px" height="200px" class="card-img-top" src="{{ asset('public/company/feature_images/') }}/{{ $newsOpportunityDetails->feature_image }}" alt="Card image cap">
                            @else
                                <img width="300px" height="200px" class="card-img-top" src="{{ asset('public/banner/') }}/{{ $profileCoverPhoto }}" alt="Card image cap">
                            @endif
                              
                              <div class="card-body " >
                                <h5 class="card-title"><strong>{{ $newsOpportunityDetails->business_title }}</strong></h5>
                              </div>
                              <div class="card-footer card bg-light ">
                          
                                   <button type="button" class="btn btn-raised btn-info " data-toggle="modal" data-target="#content_business_modal{{ $key }}">
                                    Read More
                                    </button>
                       
{{--                                 <a class="btn btn-raised btn-primary  d-sm-none d-md-none" data-toggle="collapse" href="#content_business_{{ $key }}" role="button" aria-expanded="false" aria-controls="content_business" >Read More2</a> --}}
                              </div>
                     
{{--                                 <div class="collapse  d-sm-none d-md-none" id="content_business_{{ $key }}">
                                    <div class="card-body card bg-light" >
                                        <p class="card-text p-1">{!! $newsOpportunityDetails->content_business !!}</p>
                                    </div>
                                   <div class="card" >
                                        <a class="btn btn-raised btn-primary " data-toggle="collapse" href="#content_business_{{ $key }}" role="button" aria-expanded="false" aria-controls="content_business" >Hide</a>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
    <footer class="footer text-center ">
    </footer>
  
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
  <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>


   

</div>

<style type="text/css">
    @media screen and (max-width:320px) {
        .business_content h1{
            color: red;
            padding-left: 0px !important;
        }
    }
</style>

<script type="text/javascript">
    var big_image;

$(document).ready(function() {
  BrowserDetect.init();

  // Init Material scripts for buttons ripples, inputs animations etc, more info on the next link https://github.com/FezVrasta/bootstrap-material-design#materialjs
  $('div').bootstrapMaterialDesign();

  window_width = $(window).width();

  $navbar = $('.navbar[color-on-scroll]');
  scroll_distance = $navbar.attr('color-on-scroll') || 500;

  $navbar_collapse = $('.navbar').find('.navbar-collapse');

  //  Activate the Tooltips
  $('[data-toggle="tooltip"], [rel="tooltip"]').tooltip();

  // Activate Popovers
  $('[data-toggle="popover"]').popover();

  if ($('.navbar-color-on-scroll').length != 0) {
    $(window).on('scroll', materialKit.checkScrollForTransparentNavbar);
  }

  materialKit.checkScrollForTransparentNavbar();

  if (window_width >= 768) {
    big_image = $('.page-header[data-parallax="true"]');
    if (big_image.length != 0) {
      $(window).on('scroll', materialKit.checkScrollForParallax);
    }

  }


});

$(document).on('click', '.navbar-toggler', function() {
  $toggle = $(this);

  if (materialKit.misc.navbar_menu_visible == 1) {
    $('html').removeClass('nav-open');
    materialKit.misc.navbar_menu_visible = 0;
    $('#bodyClick').remove();
    setTimeout(function() {
      $toggle.removeClass('toggled');
    }, 550);

    $('html').removeClass('nav-open-absolute');
  } else {
    setTimeout(function() {
      $toggle.addClass('toggled');
    }, 580);


    div = '<div id="bodyClick"></div>';
    $(div).appendTo("div").click(function() {
      $('html').removeClass('nav-open');

      if ($('nav').hasClass('navbar-absolute')) {
        $('html').removeClass('nav-open-absolute');
      }
      materialKit.misc.navbar_menu_visible = 0;
      $('#bodyClick').remove();
      setTimeout(function() {
        $toggle.removeClass('toggled');
      }, 550);
    });

    if ($('nav').hasClass('navbar-absolute')) {
      $('html').addClass('nav-open-absolute');
    }

    $('html').addClass('nav-open');
    materialKit.misc.navbar_menu_visible = 1;
  }
});

materialKit = {
  misc: {
    navbar_menu_visible: 0,
    window_width: 0,
    transparent: true,
    fixedTop: false,
    navbar_initialized: false,
    isWindow: document.documentMode || /Edge/.test(navigator.userAgent)
  },

  initFormExtendedDatetimepickers: function() {
    $('.datetimepicker').datetimepicker({
      icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-screenshot',
        clear: 'fa fa-trash',
        close: 'fa fa-remove'
      }
    });
  },

  initSliders: function() {
    // Sliders for demo purpose
    var slider = document.getElementById('sliderRegular');

    noUiSlider.create(slider, {
      start: 40,
      connect: [true, false],
      range: {
        min: 0,
        max: 100
      }
    });

    var slider2 = document.getElementById('sliderDouble');

    noUiSlider.create(slider2, {
      start: [20, 60],
      connect: true,
      range: {
        min: 0,
        max: 100
      }
    });
  },

  checkScrollForParallax: function() {
    oVal = ($(window).scrollTop() / 3);
    big_image.css({
      'transform': 'translate3d(0,' + oVal + 'px,0)',
      '-webkit-transform': 'translate3d(0,' + oVal + 'px,0)',
      '-ms-transform': 'translate3d(0,' + oVal + 'px,0)',
      '-o-transform': 'translate3d(0,' + oVal + 'px,0)'
    });
  },

  checkScrollForTransparentNavbar: debounce(function() {
    if ($(document).scrollTop() > scroll_distance) {
      if (materialKit.misc.transparent) {
        materialKit.misc.transparent = false;
        $('.navbar-color-on-scroll').removeClass('navbar-transparent');
      }
    } else {
      if (!materialKit.misc.transparent) {
        materialKit.misc.transparent = true;
        $('.navbar-color-on-scroll').addClass('navbar-transparent');
      }
    }
  }, 17)
};

// Returns a function, that, as long as it continues to be invoked, will not
// be triggered. The function will be called after it stops being called for
// N milliseconds. If `immediate` is passed, trigger the function on the
// leading edge, instead of the trailing.

function debounce(func, wait, immediate) {
  var timeout;
  return function() {
    var context = this,
      args = arguments;
    clearTimeout(timeout);
    timeout = setTimeout(function() {
      timeout = null;
      if (!immediate) func.apply(context, args);
    }, wait);
    if (immediate && !timeout) func.apply(context, args);
  };
};

var BrowserDetect = {
  init: function() {
    this.browser = this.searchString(this.dataBrowser) || "Other";
    this.version = this.searchVersion(navigator.userAgent) || this.searchVersion(navigator.appVersion) || "Unknown";
  },
  searchString: function(data) {
    for (var i = 0; i < data.length; i++) {
      var dataString = data[i].string;
      this.versionSearchString = data[i].subString;

      if (dataString.indexOf(data[i].subString) !== -1) {
        return data[i].identity;
      }
    }
  },
  searchVersion: function(dataString) {
    var index = dataString.indexOf(this.versionSearchString);
    if (index === -1) {
      return;
    }

    var rv = dataString.indexOf("rv:");
    if (this.versionSearchString === "Trident" && rv !== -1) {
      return parseFloat(dataString.substring(rv + 3));
    } else {
      return parseFloat(dataString.substring(index + this.versionSearchString.length + 1));
    }
  },

  dataBrowser: [{
      string: navigator.userAgent,
      subString: "Chrome",
      identity: "Chrome"
    },
    {
      string: navigator.userAgent,
      subString: "MSIE",
      identity: "Explorer"
    },
    {
      string: navigator.userAgent,
      subString: "Trident",
      identity: "Explorer"
    },
    {
      string: navigator.userAgent,
      subString: "Firefox",
      identity: "Firefox"
    },
    {
      string: navigator.userAgent,
      subString: "Safari",
      identity: "Safari"
    },
    {
      string: navigator.userAgent,
      subString: "Opera",
      identity: "Opera"
    }
  ]

};
</script>

@endsection

@section('javascript')
    <!-- bootstrap 4.1 -->


    {{-- <script src="{{asset('public/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script> --}}

{{--     <script src="{{asset('public/assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script> --}}

@endsection







