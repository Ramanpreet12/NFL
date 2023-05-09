@extends('front.layout.app')
@section('content')
  <!-- mainheader -->
  <section id="aboutBanner" style="background-image:url(front/img/new_banner_2.jpg)">
    <div class="container">
        <div class="row">
            <div class="col">
            </div>
        </div>
    </div>
</section>

<section id="arenaCrousel">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2>Arena</h4>
                    <div class="owl-carousel owl-heroSlider">
                        <div class="owlItem">
                            <img src="front/img/arenaOne.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="owlItem">
                            <img src="front/img/arenaTwo.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="owlItem">
                            <img src="front/img/arenaThree.webp" alt="" class="img-fluid">
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>
<section id="locationBox">
    <div class="container">
        <div class="loacationChart">
          <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="locationInfo">
                    <div class="loactionAddress d-flex">
                        <i class="fa-solid fa-location-dot"></i>
                        <h5>Loaction</h5>
                        <p>20 First Avenue, San Jose, California 95101, United States</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="locationInfo">
                    <div class="loactionAddress d-flex">
                        <i class="fa-solid fa-laptop"></i>
                        <h5>Capacity</h5>
                        <p> 93.607</p>
                    </div>
                </div>
                <hr>
                <div class="locationInfo">
                    <div class="loactionAddress d-flex">
                        <i class="fa-solid fa-inbox"></i>
                        <h5>Surface</h5>
                        <p> Natural grass</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="locationInfo">
                    <div class="loactionAddress d-flex">
                        <i class="fa-solid fa-calendar"></i>
                        <h5>Opened</h5>
                        <p>May 1, 1983</p>
                    </div>
                </div>
                <hr>
                <div class="locationInfo">
                    <div class="loactionAddress d-flex">
                        <i class="fa-solid fa-republican"></i>
                        <h5>Renovated</h5>
                        <p>1993, 1995, 2011</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<section id="abouttexting">
<div class="container">
<div class="aboutText">
    <div class="row">
        <div class="col-sm-6">
            <p>Football, also called association football or soccer, game in which two teams of
                11 players, using any part of their bodies except their hands and arms, try to
                maneuver the ball into the opposing team’s goal. Only the goalkeeper is
                permitted to handle the ball and may do so only within the penalty area
                surrounding the goal. The team that scores more goals wins.

                Football is the world’s most popular ball game in numbers of participants and
                spectators. Simple in its principal rules and essential equipment, the sport can
                be played almost anywhere, from official football playing fields (pitches) to
                gymnasiums, streets, school playgrounds, parks, or beaches. </p>
        </div>
        <div class="col-sm-6">
            <p>Modern football originated in Britain in the 19th century. Since before medieval
                times, “folk football” games had been played in towns and villages according to
                local customs and with a minimum of rules. combined with a history of legal
                prohibitions against particularly violent and destructive forms of folk football
                to undermine the game’s status from the early 19th century onward. However,
                football was taken up as a winter game between residence houses at public
                (independent) schools such as Winchester, Charterhouse, and Eton. </p>
        </div>
    </div>
</div>
</div>
</section>
@endsection
