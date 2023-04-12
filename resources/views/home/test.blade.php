@extends('front.layout.app')
@section('content')
<section id="heroBanner">
    <div class="owl-carousel owl-heroSlider">


        <div class="owlItem" style="background-image:url({{ asset('front/img/crousel1.jpg') }})">
            <div class="bannerCaption">
              <div class="container">
                <div class="row justify-content-lg-end">
                  <div class="col-sm-12 col-md-8 col-lg-5 ">

                    {{-- <h1 style="color:{{ $colorSection['scoreboard']["header_color"] }};">We Love<span class="#textColor">Football</span></h1> --}}
                    <h1 style="">About us</h1>

                    <p style="">This is about </p>
                    <div class="booking mt-5">
                      <button type="button" class="btn btn-primary  btn-lg" style="">SUBSCRIBE</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="owlItem" style="background-image:url({{ asset('front/img/crousel3.jpg') }})">



    </div>
  </section>

  <!-- matchBoard with header -->




  <style type="text/css">
    #heroBanner .btn-primary:before {
     background-color: <?php echo $colorSection['scoreboard']["button_color"] ?>;
   }
   #heroBanner .btn-primary:after {
     background-color: <?php echo $colorSection['scoreboard']["button_color"] ?>;
   }
   #heroBanner .owl-nav button span {
     background-color: <?php echo $colorSection['scoreboard']["button_color"] ?>;
   }
   #heroBanner .owl-nav button.owl-prev span:after {
     background: <?php echo $colorSection['scoreboard']["button_color"] ?>;
   }
   #heroBanner .owl-nav button.owl-next span:after {
     background: <?php echo $colorSection['scoreboard']["button_color"] ?>;
   }
   #matchBoard .team-vs .secondBoard:before {
     background: <?php echo $colorSection['scoreboard']["button_color"] ?>;
 }

  #nextmatchBoard .matchTable .teamVs {
      background-color:<?php echo $colorSection['leaderboard']["button_color"] ?>;;
  }
  #nextmatchBoard .matchTable {
      background-color: <?php echo $colorSection['leaderboard']["bg_color"] ?>;
      border-top: <?php echo $colorSection['leaderboard']["button_color"] ?>;
  }
  #nextmatchBoard .matchTime a {
      color: <?php echo $colorSection['leaderboard']["text_color"] ?>;
  }

  #nextmatchBoard .table-primary {
    --bs-table-bg: <?php echo $colorSection['leaderboard']["button_color"] ?>;
  }

  #nextmatchBoard .table-striped>tbody>tr:nth-of-type(odd)>* {
    color: <?php echo $colorSection['leaderboard']["text_color"] ?>;
  }
  #nextmatchBoard .table-dark {
    color: <?php echo $colorSection['leaderboard']["text_color"] ?>;
  }

  #nextmatchBoard .table-primary {
    color: <?php echo $colorSection['leaderboard']["text_color"] ?>;
  }

 /* #nextmatchBoard .table>:not(caption)>*>* {
    background-color: <?php echo $colorSection['leaderboard']["bg_color"] ?>;
  }*/



  #videoBoard h2:before {
    background: <?php echo $colorSection['video']["button_color"] ?>;
}

  #videoBoard .owl-nav button span {
    background-color: <?php echo $colorSection['video']["button_color"] ?>;
  }

  #videoBoard .owl-nav button.owl-prev span:after {
      background: <?php echo $colorSection['video']["button_color"] ?>;
  }
  #videoBoard .owl-nav button.owl-next span:after {
      background: <?php echo $colorSection['video']["button_color"] ?>;
  }
  #newsPart h2:before {
      background: <?php echo $colorSection['news']["button_color"] ?>;
  }

  #newsPart .owl-nav button span {
  background-color: <?php echo $colorSection['news']["button_color"] ?>;
  }

  #newsPart .owl-nav button.owl-prev span:after {
      background: <?php echo $colorSection['news']["button_color"] ?>;
  }
  #newsPart .owl-nav button.owl-next span:after {
      background: <?php echo $colorSection['news']["button_color"] ?>;
  }
  #newsPart .newsBanner .newsItemText {
    color: <?php echo $colorSection['news']["text_color"] ?>;

  }

   </style>
  @endsection
