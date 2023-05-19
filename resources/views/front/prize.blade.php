@extends('front.layout.app')
@section('content')
<section id="aboutBanner" style="background-image:url(front/img/new_banner_2.jpg)">
    <div class="container">
        <div class="row">
            <div class="col">
            </div>
        </div>
    </div>
</section>

<section id="prizePart">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12">
                <h2>Prizes</h2>
            </div>
        </div>
        <div class="prizeShow">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-6">
                        <img src="front/img/winn.webp" class="img-fluid" alt="...">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h3 class="card-title">5 Days Thailand Tour</h3>
                            <p class="card-text">Prize money at the FIFA World Cup is distributed according to
                                performance, with Argentina receiving a handsome payout of 42 million U.S. dollars
                                for winning the 2022 tournament.</p>
                            <div class="prize d-flex">
                                <span><i class="fa-solid fa-trophy"></i> Indian Super League</span>
                                <span><i class="fa-solid fa-calendar-days"></i> DECEMBER 19, 2016</span>
                                <!-- <p class="card-text"><small class="text-muted">DECEMBER 19, 2016</small></p>              -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="prizeShow">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-6">
                        <div class="card-body">
                            <h3 class="card-title">Singapore Holiday Package</h3>
                            <p class="card-text">Prize money at the FIFA World Cup is distributed according to
                                performance, with Argentina receiving a handsome payout of 42 million U.S. dollars
                                for winning the 2022 tournament.</p>
                            <div class="prize d-flex">
                                <span><i class="fa-solid fa-trophy"></i> Indian Super League</span>
                                <span><i class="fa-solid fa-calendar-days"></i> DECEMBER 19, 2016</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="front/img/winn2.jpg" class="img-fluid" alt="...">
                    </div>
                </div>
            </div>
        </div>

        <div class="prizeShow">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-6">
                        <img src="front/img/winn3.webp" class="img-fluid" alt="...">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h3 class="card-title">World Tour</h3>
                            <p class="card-text">Prize money at the FIFA World Cup is distributed according to
                                performance, with Argentina receiving a handsome payout of 42 million U.S. dollars
                                for winning the 2022 tournament.</p>
                            <div class="prize d-flex">
                                <span><i class="fa-solid fa-trophy"></i> Indian Super League</span>
                                <span><i class="fa-solid fa-calendar-days"></i> DECEMBER 19, 2016</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection