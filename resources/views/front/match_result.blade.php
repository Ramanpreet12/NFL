@extends('front.layout.app')
@section('content')
    <!-- mainheader -->


    <section id="matchResult">
    <section id="resultLeaderboard">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Match Results By Regions</h2>
                    {{-- <h3>Season :ffd</h3> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="seasonWeek d-flex">
                        <h5></h5>
                        <h5>Season : {{$season_name}}</h5>
                    </div>
                </div>
            </div>

            @foreach ($get_total_points as $total_points)<hr>
            <h5>Region : {{$total_points->region_name}}</h5>

            <div class="row justify-content-center mb-5">
                <div class="col-lg-7 col-md-12">
                    <div class="modrenFixture">
                        <div class="fixtureLogo">
                            <div class="fixtureLogoIntro">
                                <img src="https://nfl.kloudexpert.com/front/img/trophyImg.png" alt=""
                                    class="img-fluid">
                            </div>
                        </div>
                        <div class="fixtureContent">
                            <h4>Scores</h4>
                            <span>{{$total_points->Userpoints}}</span>
                        </div>
                        <div class="fixtureLogo fixtureRight">
                            <div class="fixtureLogoIntro">
                                <img src="https://nfl.kloudexpert.com/front/img/trophyImg.png" alt=""
                                    class="img-fluid">
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            @endforeach
        </div>


        </div>
    </section>
    </section>
@endsection
