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

              <div style="color:{{$general->footer_add_color}};">
                <span>{{$general->footer_address ? $general->footer_address : '
                    3024 North Ashland Avenue, Unit # 578905 Chicago, IL 60657' }}</span>
              </div>
            </div>
            <div class="contactUs d-flex">
              <div class="iconitem">
                <i class="fa-solid fa-mobile"></i>
              </div>
              <div style="color:{{$general->footer_contact_color}};">
                <span>{{$general->footer_contact ? $general->footer_contact :'+7 888 71 140 30 20'}}</span>
              </div>
            </div>
            <div class="contactUs d-flex">
              <div class="iconitem">
                <i class="fa-solid fa-fax"></i>
              </div>
              <div style="color:{{$general->other_contact_color}};">
                <span>{{$general->footer_contact2 ? $general->footer_contact2 : '+7 888 71 140 30 20'}}</span>
              </div>
            </div>
            <div class="contactUs d-flex">
              <div class="iconitem">
                <i class="fa-solid fa-envelope"></i>
              </div>
              <div style="color:{{$general->email_color}};">
                <span>{{$general->email ? $general->email : '
                    nfl@stylemixthemes.com'}}</span>
              </div>
            </div>

            <div class="contactUs d-flex">
              <div class="iconitem">
                <i class="fa-solid fa-globe"></i>
              </div>
              <div>
                @if (($general->footer_affliated_text) && ($general->footer_affliated_link))
                    <span><a href="{{$general->footer_affliated_link}}" style="color:{{$general->footer_afilated_color}}; text-decoration:none;">{{$general->footer_affliated_text}}</a></span>
                @endif
              </div>
            </div>

            <div class="contactUs d-flex">
                <div class="iconitem">
                    {{-- <i class="fa-sharp fa-solid fa-file-shield"></i> --}}
                    <i class="fa-sharp fa-solid fa-shield"></i>
                </div>
                <div>
                      <span><a href="{{route('privacy')}}" style="color:{{$general->privacy_policy_color}}; text-decoration:none;">{{$general->privacy_policy ? $general->privacy_policy : 'Privacy Policy'}}</a></span>
                </div>
            </div>


            @if (($general->santa_game_store) && ($general->santa_game_store_link))
            <div class="contactUs d-flex">
                <div class="iconitem">
                  <i class="fa-solid fa-globe"></i>
                </div>
                <div><span><a href="{{$general->santa_game_store_link}}" style="color:{{$general->santa_game_store_color}}; text-decoration:none;">{{$general->santa_game_store}}</a></span>
                </div>
              </div>
              @endif
          </div>

        </div>
        <div class="col-sm-4 mb-3">
          <div class="headerPart">
            <h4 style="color:{{ $colorSection['footer']["header_color"] }};" >QUICK LINKS</h4>
          </div>
          <ul class="footerlist">
            @foreach ($mainMenus as $menuMenu)
              <li><a @if ($menuMenu->url) href="<?php echo url($menuMenu->url); ?>" @else href="javascript:void(0)" @endif>
                      {{ $menuMenu->title }}</a>
                </li>
            @endforeach
          </ul>
        </div>
        <div class="col-sm-4 mb-3">
          <div class="headerPart">
            <h4 style="color:{{ $colorSection['footer']["header_color"] }};" > {{$general->footer_content_head ? $general->footer_content_head : 'SIGN UP FOR EMAIL ALERT'}}</h4>
          </div>
          <p style="color:{{$general->footer_content_color}};">{{$general->footer_content ? $general->footer_content : ''}}</p>
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

            <p> {{$general->footer_bar ? $general->footer_bar : 'GAMEDAY PICKS, LLC © 2023. All Rights Reserved'}}</p>

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

// front reviews form validation
$('#reviewForm').validate({
  rules: {
    username: { required: true },
    email: { required: true, email: true },
    comment: { required: true },
    rating: { required: true },

  },
  messages: {
    username: { required: "Name is required", },
    email: { required: "Email is required", },
    comment: { required: "Comment is required", },
    rating: { required: "Rating is required", },

  }
});


//for rating stars on reviews popup
$('.icon-click').on('click', function () {
  var temp = $(this).attr('id');
  temp = temp.split('-');
  var name = temp[0];
  var val = temp[1];

  var prv = $('#' + name).val();
  $('#' + name).val(val);
  $('#rating_1').val(val);

  for (i = 1; i <= prv; i++) {
    $('#' + name + '-' + i).removeClass('text-warning');
    $('#' + name + '-' + i).addClass('text-secondary');
  }
  for (i = 1; i <= val; i++) {
    $('#' + name + '-' + i).removeClass('text-secondary');
    $('#' + name + '-' + i).addClass('text-warning');
  }
});


//submit the reviews form with ajax
$("#reviewForm").submit(function (e) {
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
    type: 'POST',
    data: $("#reviewForm").serialize(),
    url: 'reviews',
    success: function (data) {
      // console.log(data);
      $("#reviews_success_modal").modal("show");
      $("#addReviewModal").modal("hide");
 location.reload();
      $("#reviewForm")[0].reset();
      $('.icon-click').removeClass('text-warning');
    }
  });
  return false;
});
</script>
