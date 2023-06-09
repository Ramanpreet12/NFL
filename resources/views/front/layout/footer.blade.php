<footer id="footerPart">
    <div class="container">
      <div class="row">
        <div class="col-sm-4 mb-3">
          <a class="footerLogo" href="{{route('home')}}">

            @if (!empty($general->logo))
            <img src="{{asset('storage/images/general/'.$general->logo)}}" alt="" class="img-fluid" height="100px" width="200px">
           @else
            <img src="{{ asset('front/img/NFL-small.png') }}" alt="" class="img-fluid">
          @endif
          </a>

          <div class="contactDetail">
            <div class="contactUs d-flex">
              <div class="iconitem">
                <i class="fa-solid fa-location-dot"></i>
              </div>
              <div class="inputText">
                <span>{{$general->footer_address}}</span>
              </div>
            </div>
            <div class="contactUs d-flex">
              <div class="iconitem">
                <i class="fa-solid fa-mobile"></i>
              </div>
              <div class="inputText">
                <span>{{$general->footer_contact}}</span>
              </div>
            </div>
            <div class="contactUs d-flex">
              <div class="iconitem">
                <i class="fa-solid fa-fax"></i>
              </div>
              <div class="inputText">
                <span>{{$general->footer_contact2}}</span>
              </div>
            </div>
            <div class="contactUs d-flex">
              <div class="iconitem">
                <i class="fa-solid fa-envelope"></i>
              </div>
              <div class="inputText">
                <span>{{$general->email}}</span>
              </div>
            </div>
          </div>

        </div>
        <div class="col-sm-4 mb-3">
          <div class="headerPart">
            <h4 style="color:{{ $colorSection['footer']["header_color"] }};" >QUICK LINKS</h4>
          </div>
          <ul class="footerlist">
            @foreach ($mainMenus as $menuMenu)
                    <li>
                        <a @if ($menuMenu->url) href="<?php echo url($menuMenu->url); ?>" @else href="javascript:void(0)" @endif>
                            {{ $menuMenu->title }}</a>

                        {{-- @if ($check_submenu != '')
                            <div class="dropdown-menu megaMenu" x-placement="bottom-start"
                                style="position: absolute; background-color:{{ $colorSection['navbar']['bg_color'] }};">
                                <div class="container">
                                    <div class="row">
                                        <ul class="navbar-nav dropList">
                                            @foreach ($subMenus as $subMenu)
                                                @if ($subMenu->parent_id == $menuMenu->id)
                                                    <li class="nav-item"> <a class="dropdown-item"
                                                            href="{{ $subMenu->url }}">{{ $subMenu->title }}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif --}}
                    </li>
                @endforeach

            {{-- <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Match Result</a></li>
            <li><a href="#">Match Fixture</a></li>
            <li><a href="#">Contact us</a></li> --}}
          </ul>
        </div>
        <div class="col-sm-4 mb-3">
          <div class="headerPart">
            <h4 style="color:{{ $colorSection['footer']["header_color"] }};" >SIGN UP FOR EMAIL ALERT</h4>
          </div>
          <p>{{$general->footer_content}}</p>
          <div class="formInput">
            <input type="email" name="EMAIL" placeholder="Your email address" required="">
            <button type="button" class="btn btn-primary  btn-lg" style="">Submit</button>
          </div>

        </div>
      </div>
      <hr>
      <div class="footerDown">
        <div class="row">
          <div class="col-sm-6">
            <p>NFL design © 2023. All Rights Reserved.
            </p>
          </div>
          <div class="col-sm-6">
            <div class="footerIcon">
              <a href=""> <i class="fa-brands fa-facebook-f"></i></a>
              <a href=""> <i class="fa-brands fa-twitter"></i></a>
              <a href=""> <i class="fa-brands fa-square-instagram"></i></a>
              <a href=""><i class="fa-brands fa-google-plus-g"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>






  <!-- owl script -->
  <script src="{{ asset('front/js/jquery.min.js') }}"></script>
  <script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>
  <script src="https://kit.fontawesome.com/58d36e6221.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
  <script src="{{ asset('dist/js/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('dist/js/custom.js') }}"></script>
  <!-- intl-tel-input -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.1.6/js/intlTelInput.js"></script>

  <script>
    $(document).ready(function () {
      $(".owl-carousel").owlCarousel();
    });

    $(".owl-heroSlider").owlCarousel({

      loop: true,
      items: 1,
      margin: 0,
      dots: false,
      autoplay: true,
      nav: true,
      dots: false,
    });

    $(".owl-testimonial").owlCarousel({

loop: true,
items: 1,
margin: 30,
dots: false,
autoplay: true,
nav: true,
dots: false,
responsive: {
        300: {
          items: 1,
        },
        600: {
          items: 2,
        },
        992: {
          items: 3,
        },
      },
});

    $(".owl-videoslider").owlCarousel({

      loop: true,
      margin: 20,
      dots: false,
      autoplay: true,
      nav: false,
      responsive: {
        300: {
          items: 1,
        },
        600: {
          items: 2,
        },
        992: {
          items: 3,
        },
      },
    });
  </script>
  <!-- video player js -->
  <script>
    const video = document.getElementById("video");
    const circlePlayButton = document.getElementById("circle-play-b");

    function togglePlay() {
      if (video.paused || video.ended) {
        video.play();
      } else {
        video.pause();
      }
    }

    circlePlayButton.addEventListener("click", togglePlay);
    video.addEventListener("playing", function () {
      circlePlayButton.style.opacity = 0;
    });
    video.addEventListener("pause", function () {
      circlePlayButton.style.opacity = 1;
    });

  </script>

  <!-- bootstrap script -->
  <script src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
  <style type="text/css">
    #footerPart {
        background-color:<?php echo $colorSection['footer']["bg_color"] ?>;
        color: <?php echo $colorSection['footer']["text_color"] ?>;
    }
    #footerPart .footerlist li a {
    color: <?php echo $colorSection['footer']["text_color"] ?>;
    }
    #footerPart .headerPart h4 {
    color: <?php echo $colorSection['footer']["text_color"] ?>;
    }
    #footerPart .btn-primary:before {
    background-color:<?php echo $colorSection['footer']["button_color"] ?>;
    }
    #footerPart .btn-primary:after {
        background-color: <?php echo $colorSection['footer']["button_color"] ?>;
    }
    #footerPart .footerDown .footerIcon a {
    color: <?php echo $colorSection['footer']["text_color"] ?>;
    }
    #footerPart .btn-primary {
    --bs-btn-color:<?php echo $colorSection['footer']["text_color"] ?>;
    }
</style>
@yield('script')
<script>
  $('.icon-click').on('click', function(){
  var temp = $(this).attr('id');
  temp     = temp.split('-');
  var name = temp[0];
  var val  = temp[1];

  var prv  = $('#'+name).val();
      $('#'+name).val(val);
      $('#rating_1').val(val);

  for(i = 1; i <= prv; i++){
    $('#'+name+'-'+i).removeClass('text-warning');
    $('#'+name+'-'+i).addClass('text-secondary');
  }
  for(i = 1; i <= val; i++){
    $('#'+name+'-'+i).removeClass('text-secondary');
    $('#'+name+'-'+i).addClass('text-warning');
  }
})
</script>
<script>
  $("#reviewForm").submit(function(e){

   var rating =  $("#rating").val();
  e.preventDefault();
  if (rating == '') {
    $("#rating_empty_msg").html('Rating is required');
  }

  $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
  $.ajax({
      type : 'POST',
      data: $("#reviewForm").serialize(),
      url : 'reviews',
      success : function(data){
       // console.log(data);
           $("#reviews_success_modal").modal("show");
           $("#addReviewModal").modal("hide");
           location.reload();
           $("#reviewForm")[0].reset();
           $('.icon-click').removeClass('text-warning');
        //    $("#rating_empty_msg").html('');
      }
  });
  return false;
});
</script>
