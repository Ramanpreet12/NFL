@extends('front.layout.app')
@section('content')
<section id="heroBanner">
    <div class="owl-carousel owl-heroSlider">
        @forelse ($banners as $banner)
        <div class="owlItem" style="background-image:url({{ asset('storage/images/banners/'.$banner->image) }})">
            <div class="bannerCaption">
              <div class="container">
                <div class="row justify-content-lg-end">
                  <div class="col-sm-12 col-md-8 col-lg-5 ">

                    {{-- <h1 style="color:{{ $colorSection['scoreboard']["header_color"] }};">We Love<span class="#textColor">Football</span></h1> --}}
                    <h1 style="color:{{ $colorSection['scoreboard']["header_color"] }};">{{$general->homepage_title}}</h1>

                    <p style="color:{{ $colorSection['scoreboard']["text_color"] }};">{{$general->homepage_subtitle}}</p>
                    <div class="booking mt-5">
                      <button type="button" class="btn btn-primary  btn-lg" style="color:{{ $colorSection['scoreboard']["text_color"] }};">SUBSCRIBE</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @empty
        <div class="owlItem" style="background-image:url({{ asset('front/img/crousel1.jpg') }})">
            <div class="bannerCaption">
              <div class="container">
                <div class="row justify-content-lg-end">
                  <div class="col-sm-12 col-md-8 col-lg-5 ">

                    {{-- <h1 style="color:{{ $colorSection['scoreboard']["header_color"] }};">We Love<span class="#textColor">Football</span></h1> --}}
                    <h1 style="color:{{ $colorSection['scoreboard']["header_color"] }};">{{$general->homepage_title}}</h1>

                    <p style="color:{{ $colorSection['scoreboard']["text_color"] }};">{{$general->homepage_subtitle}}</p>
                    <div class="booking mt-5">
                      <button type="button" class="btn btn-primary  btn-lg" style="color:{{ $colorSection['scoreboard']["text_color"] }};">SUBSCRIBE</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="owlItem" style="background-image:url({{ asset('front/img/crousel3.jpg') }})">
        <div class="bannerCaption">
          <div class="container">
            <div class="row justify-content-lg-end">
              <div class="col-sm-12 col-md-8 col-lg-5 ">
                <h1 style="color:{{ $colorSection['scoreboard']["text_color"] }};">We Love<span class="#textColor">Football</span></h1>
                <p style="color:{{ $colorSection['scoreboard']["text_color"] }};">Don't walk through life just playing football. Don't walk through life just being an athlete.
                  Athletics will fade.</p>
                <div class="booking mt-5">
                  <button type="button" class="btn btn-primary  btn-lg">SUBSCRIBE</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

        @endforelse


    </div>
  </section>

  <!-- matchBoard with header -->


@foreach ($team_results as $team_result)


  <section id="matchBoard" style="color:{{ $colorSection['scoreboard']["text_color"] }};">
    <div class="container text-center">
      <div class="row g-0 team-vs">
        <span class="score">{{$team_result->team1_score}}-{{$team_result->team2_score}}</span>
        <div class="col-sm-6" >
          <div class="firstBoard boardItem" style="background-color:{{ $colorSection['scoreboard']["bg_color"] }};">
            <div class="boardItem-inner">
              {{-- <img src="{{ asset('front/img/AZ-Cardinals 1.png') }}" alt="" class="img-fluid"> --}}
              @if ($team_result)
              <img src="{{ asset('storage/images/team_logo/'.$team_result->team_result_id1->logo) }}" alt="" class="img-fluid">
              @else
              <img src="{{ asset('front/img/AZ-Cardinals 1.png') }}" alt="" class="img-fluid">
              @endif

              <h3>{{$team_result->team1_id ?  $team_result->team_result_id1->name : ''}}</h3>
              <h4>{{($team_result->team1_score >  $team_result->team2_score ? 'Win' : 'Loss')}}</h4>

            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="secondBoard boardItem" style="background-color:{{ $colorSection['scoreboard']["bg_color"] }};">
            <div class="boardItem-inner">
              {{-- <img src="{{ asset('front/img/Philly-Eagles.png') }}" alt="" class="img-fluid"> --}}
              @if ($team_result)
              <img src="{{ asset('storage/images/team_logo/'.$team_result->team_result_id2->logo) }}" alt="" class="img-fluid">
              @else
              <img src="{{ asset('front/img/Philly-Eagles.png') }}" alt="" class="img-fluid">
              @endif
              {{-- <h3>Philly-Eagles</h3> --}}
              <h3>{{$team_result->team2_id ?  $team_result->team_result_id2->name : ''}}</h3>
              <h4>{{($team_result->team2_score >  $team_result->team1_score ? 'Win' : 'Loss')}}</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endforeach


  <section id="nextmatchBoard" style="background-image:url({{ asset('front/img/football-2-bg.jpg') }});color:{{ $colorSection['leaderboard']["text_color"] }};">
    <div class="container text-center">
      <div class="row">
        <div class="col-sm-6 col-md-5">
          <div class="upcomingMatchBlock">
            <h2 style="color:{{ $colorSection['leaderboard']["header_color"] }};" >UPCOMING MATCHES</h2>
            @foreach ($upcoming_matches as $upcoming_match)
            <div class="tabletwo">
                <div class="matchTable align-items-center justify-content-center">
                  <div class="firstTeam">
                    @if ($upcoming_match)
                    <img src="{{ asset('storage/images/team_logo/'.$upcoming_match->first_team_id->logo) }}" alt="" class="img-fluid">
                    @else
                    <img src="{{ asset('front/img/Bears 1.png') }}" alt="" class="img-fluid">
                    @endif

                    {{-- <h5>Bears <span>(win)</span></h5> --}}
                    <h5>{{$upcoming_match->first_team_id->name ? $upcoming_match->first_team_id->name : ''}}</h5>
                  </div>
                  <div class="teamVs">
                    <h5>VS</h5>
                  </div>
                  <div class="secondTeam">
                    @if ($upcoming_match)
                    <img src="{{ asset('storage/images/team_logo/'.$upcoming_match->second_team_id->logo) }}" alt="" class="img-fluid">
                    @else
                    <img src="{{ asset('front/img/Vikings.png') }}" alt="" class="img-fluid">
                    @endif


                    {{-- <h5>Vikings <span>(loss)</span></h5> --}}
                    <h5>{{$upcoming_match->second_team_id->name ? $upcoming_match->second_team_id->name : ''}}</h5>
                  </div>
                </div>
                <div class="matchTime">
                  {{-- <span>20 March 2023 19:00</span> --}}

                  <span> {{ \Carbon\Carbon::parse($upcoming_match->date)->format('j F, Y') }} {{ \Carbon\Carbon::createFromFormat('H:i:s', $upcoming_match->time)->format('g:i') }} {{ucfirst($upcoming_match->time_zone)}}</span>
                  <a href="#">View More</a>
                </div>
              </div>
            @endforeach
{{--
            <div class="tabletwo">
              <div class="matchTable align-items-center justify-content-center">
                <div class="firstTeam">
                  <img src="{{ asset('front/img/SF-49ers 1.png') }}" alt="" class="img-fluid">
                  <h5>SF-49ers <span>(win)</span></h5>
                </div>
                <div class="teamVs">
                  <h5>VS</h5>
                </div>
                <div class="secondTeam">
                  <img src="{{ asset('front/img/Packers 1.png') }}" alt="" class="img-fluid">
                  <h5>Packers <span>(loss)</span></h5>
                </div>
              </div>
              <div class="matchTime">
                <span>20 March 2023 20:00</span>
                <a href="#">View More</a>
              </div>
            </div>

            <div class="tabletwo">
              <div class="matchTable align-items-center justify-content-center">
                <div class="firstTeam">
                  <img src="{{ asset('front/img/SF-49ers 1.png') }}" alt="" class="img-fluid">
                  <h5>SF-49ers <span>(win)</span></h5>
                </div>
                <div class="teamVs">
                  <h5>VS</h5>
                </div>
                <div class="secondTeam">
                  <img src="{{ asset('front/img/Packers 1.png') }}" alt="" class="img-fluid">
                  <h5>Packers <span>(loss)</span></h5>
                </div>
              </div>
              <div class="matchTime">
                <span>20 March 2023 20:00</span>
                <a href="#">View More</a>
              </div>
            </div>

            <div class="tabletwo">
              <div class="matchTable align-items-center justify-content-center">
                <div class="firstTeam">
                  <img src="{{ asset('front/img/SF-49ers 1.png') }}" alt="" class="img-fluid">
                  <h5>SF-49ers <span>(win)</span></h5>
                </div>
                <div class="teamVs">
                  <h5>VS</h5>
                </div>
                <div class="secondTeam">
                  <img src="{{ asset('front/img/Packers 1.png') }}" alt="" class="img-fluid">
                  <h5>Packers <span>(loss)</span></h5>
                </div>
              </div>
              <div class="matchTime">
                <span>20 March 2023 20:00</span>
                <a href="#">View More</a>
              </div>
            </div> --}}


          </div>
        </div>
        <div class="col-sm-6 col-md-7">
          <div class="leaderBoard">
            <h2 style="color:{{ $colorSection['leaderboard']["header_color"] }};" >LEADERBOARD</h2>

            <div class="tabletwo">
              <div class="table-responsive">
                <table class="table table-dark table-striped  tableBoard" style="background-color:{{ $colorSection['leaderboard']["bg_color"] }};color:{{ $colorSection['leaderboard']["text_color"] }};">
                  <thead>
                    <tr class="table-primary" >
                      <th scope="col" class="teamNumber">Region</th>
                      {{-- <th scope="col" class="teamNumber">N.</th> --}}
                      <th scope="col" class="teamNumber">Logo</th>
                      <th scope="col" class="text-start"> Players</th>
                      <th scope="col">W</th>
                      <th scope="col">L</th>
                      <th scope="col">PTS</th>
                    </tr>
                  </thead>
                  <tbody class="table-group-divider">
                    @foreach ($leaderboards as $leaderboard)
                    <tr>
                        <td scope="row">{{$leaderboard->region}}</td>
                        {{-- <td>1</td> --}}
                        <td class="teamLogo ">
                            @if ($leaderboard)
                            <img src="{{ asset('storage/images/team_logo/'.$leaderboard->teams->logo) }}" alt="" class="img-fluid">
                            @else
                            <img src="{{ asset('front/img/SF-49ers 1.png') }}" alt="" class="img-fluid">
                            @endif

                        </td>
                        <td class="teamName">
                          <span>{{$leaderboard->teams->name}}</span>
                        </td>


                        <td>{{$leaderboard->win}}</td>
                        <td>{{$leaderboard->loss}}</td>
                        <td>{{$leaderboard->pts}}</td>
                      </tr>
                    @endforeach

                    {{-- <tr>
                      <td>2</td>
                      <td class="teamLogo">
                         <img src="{{ asset('front/img/Bears 1.png') }}" alt="" class="img-fluid">
                      </td>
                      <td class="teamName">
                        <span>Oliver</span>
                      </td>

                      <td>12</td>
                      <td>3</td>
                      <td>26</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td class="teamLogo">
                         <img src="{{ asset('front/img/Packers 1.png') }}" alt="" class="img-fluid">
                      </td>
                      <td class="teamName">
                        <span>William</span>
                      </td>
                      <td>10</td>
                      <td>3</td>
                      <td>24</td>
                    </tr>
                    <tr>
                      <th scope="row" rowspan="3">West</th>
                      <td>1</td>
                      <td class="teamLogo ">
                       <img src="{{ asset('front/img/SF-49ers 1.png') }}" alt="" class="img-fluid">
                      </td>
                      <td class="teamName">
                        <span>Elijah</span>
                      </td>


                      <td>14</td>
                      <td>1</td>
                      <td>28</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td class="teamLogo">
                         <img src="{{ asset('front/img/Bears 1.png') }}" alt="" class="img-fluid">
                      </td>
                      <td class="teamName">
                        <span>Demon</span>
                      </td>

                      <td>12</td>
                      <td>3</td>
                      <td>26</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td class="teamLogo">
                         <img src="{{ asset('front/img/Packers 1.png') }}" alt="" class="img-fluid">
                      </td>
                      <td class="teamName">
                        <span>Stefan</span>
                      </td>
                      <td>10</td>
                      <td>3</td>
                      <td>24</td>
                    </tr>
                    <tr>
                      <th scope="row" rowspan="3">West</th>
                      <td>1</td>
                      <td class="teamLogo ">
                       <img src="{{ asset('front/img/SF-49ers 1.png') }}" alt="" class="img-fluid">
                      </td>
                      <td class="teamName">
                        <span>Alaric</span>
                      </td>


                      <td>14</td>
                      <td>1</td>
                      <td>28</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td class="teamLogo">
                         <img src="{{ asset('front/img/Bears 1.png') }}" alt="" class="img-fluid">
                      </td>
                      <td class="teamName">
                        <span>Geremy</span>
                      </td>

                      <td>12</td>
                      <td>3</td>
                      <td>26</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td class="teamLogo">
                         <img src="{{ asset('front/img/Packers 1.png') }}" alt="" class="img-fluid">
                      </td>
                      <td class="teamName">
                        <span>Mat</span>
                      </td>
                      <td>10</td>
                      <td>3</td>
                      <td>24</td>
                    </tr>
                    <tr>
                      <th scope="row" rowspan="3">Mid-West</th>
                      <td>1</td>
                      <td class="teamLogo ">
                       <img src="{{ asset('front/img/SF-49ers 1.png') }}" alt="" class="img-fluid">
                      </td>
                      <td class="teamName">
                        <span>James</span>
                      </td>


                      <td>14</td>
                      <td>1</td>
                      <td>28</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td class="teamLogo">
                         <img src="{{ asset('front/img/Bears 1.png') }}" alt="" class="img-fluid">
                      </td>
                      <td class="teamName">
                        <span>Lucas</span>
                      </td>

                      <td>12</td>
                      <td>3</td>
                      <td>26</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td class="teamLogo">
                         <img src="{{ asset('front/img/Packers 1.png') }}" alt="" class="img-fluid">
                      </td>
                      <td class="teamName">
                        <span>Mason</span>
                      </td>
                      <td>10</td>
                      <td>3</td>
                      <td>24</td>
                    </tr>
                    <tr>
                      <th scope="row" rowspan="3">South</th>
                      <td>1</td>
                      <td class="teamLogo ">
                       <img src="{{ asset('front/img/SF-49ers 1.png') }}" alt="" class="img-fluid">
                      </td>
                      <td class="teamName">
                        <span>Ethan</span>
                      </td>


                      <td>14</td>
                      <td>1</td>
                      <td>28</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td class="teamLogo">
                         <img src="{{ asset('front/img/Bears 1.png') }}" alt="" class="img-fluid">
                      </td>
                      <td class="teamName">
                        <span>Paul</span>
                      </td>

                      <td>12</td>
                      <td>3</td>
                      <td>26</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td class="teamLogo">
                         <img src="{{ asset('front/img/Packers 1.png') }}" alt="" class="img-fluid">
                      </td>
                      <td class="teamName">
                        <span>Ian</span>
                      </td>
                      <td>10</td>
                      <td>3</td>
                      <td>24</td>
                    </tr> --}}
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="videoBoard" style="background-color:{{ $colorSection['video']["bg_color"] }};">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2 style="color:{{ $colorSection['video']["header_color"] }};">VIDEOS</h2>
          <div class="owl-carousel owl-videoslider">
            <div class="item">
              <div class="video-container" id="video-container">
                <video controls id="video" preload="metadata" poster="{{ asset('front/img/poster 1.png') }}">
                  <source src="{{ asset('front/img/GAMEDAY PICKS (KANSAS CITY CHIEFS) (1).mp4') }}" type="video/mp4">
                </video>

                <div class="play-button-wrapper">
                  <div title="Play video" class="play-gif" id="circle-play-b">
                    <!-- SVG Play Button -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
                      <path d="M40 0a40 40 0 1040 40A40 40 0 0040 0zM26 61.56V18.44L64 40z" />
                    </svg>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="video-container" id="video-container">
                <video controls id="video" preload="metadata" poster="{{ asset('front/img/poster2.png') }}">
                  <source src="{{ asset('front/img/GAMEDAY PICKS (PHILADELPHIA EAGLES).mp4') }}" type="video/mp4">
                </video>

                <div class="play-button-wrapper">
                  <div title="Play video" class="play-gif" id="circle-play-b">
                    <!-- SVG Play Button -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
                      <path d="M40 0a40 40 0 1040 40A40 40 0 0040 0zM26 61.56V18.44L64 40z" />
                    </svg>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="video-container" id="video-container">
                <video controls id="video" preload="metadata" poster="{{ asset('front/img/poster3.png') }}">
                  <source src="{{ asset('front/img/GAMEDAY PICKS VACATION GETAWAY 4 SUBSCRIBERS.mp4') }}" type="video/mp4">
                </video>

                <div class="play-button-wrapper">
                  <div title="Play video" class="play-gif" id="circle-play-b">
                    <!-- SVG Play Button -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
                      <path d="M40 0a40 40 0 1040 40A40 40 0 0040 0zM26 61.56V18.44L64 40z" />
                    </svg>
                  </div>
                </div>
              </div>
            </div>
            <div class="item">
              <div class="video-container" id="video-container">
                <video controls id="video" preload="metadata" poster="{{ asset('front/img/poster4.png') }}">
                  <source src="{{ asset('front/img/2023 NFL GAMEDAY PICKS by VETs (1) (1).mp4') }}" type="video/mp4">
                </video>

                <div class="play-button-wrapper">
                  <div title="Play video" class="play-gif" id="circle-play-b">
                    <!-- SVG Play Button -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
                      <path d="M40 0a40 40 0 1040 40A40 40 0 0040 0zM26 61.56V18.44L64 40z" />
                    </svg>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- newssection -->
  <section id="newsPart" style="background-color:{{ $colorSection['news']["bg_color"] }};">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2 style="color:{{ $colorSection['news']["header_color"] }};">NEWS</h2>
          <div class="owl-carousel owl-videoslider owl-theme mt-10">
            <div class="newsBanner">
              <div class="mainImage">
                <img src="{{ asset('front/img/newsimg_1.jpg') }}" alt="" class="img-fluid">
              </div>
              <div class="newsItemText">
                <div class="itemTextinner">
                  <h6>Romolu to stay at Real Nadrid?</h6>
                  <div class="newsimgText d-flex align-items-center">
                    <div class="imgRound me-3">
                      <img src="{{ asset('front/img/person_1.jpg') }}" alt="" class="img-fluid">
                    </div>
                    <div class="textItem">
                      <h6>Mellissa Allison</h6>
                      <span>May 19, 2020 • Sports</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="newsBanner">
              <div class="mainImage">
                <img src="{{ asset('front/img/newsimg_2.jpg') }}" alt="" class="img-fluid">
              </div>
              <div class="newsItemText">
                <div class="itemTextinner">
                  <h6>Romolu to stay at Real Nadrid?</h6>
                  <div class="newsimgText d-flex align-items-center">
                    <div class="imgRound me-3">
                      <img src="{{ asset('front/img/person_1.jpg') }}" alt="" class="img-fluid">
                    </div>
                    <div class="textItem">
                      <h6>Mellissa Allison</h6>
                      <span>May 19, 2020 • Sports</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="newsBanner">
              <div class="mainImage">
                <img src="{{ asset('front/img/newsimg_3.jpg') }}" alt="" class="img-fluid">
              </div>
              <div class="newsItemText">
                <div class="itemTextinner">
                  <h6>Romolu to stay at Real Nadrid?</h6>
                  <div class="newsimgText d-flex align-items-center">
                    <div class="imgRound me-3">
                      <img src="{{ asset('front/img/person_1.jpg') }}" alt="" class="img-fluid">
                    </div>
                    <div class="textItem">
                      <h6>Mellissa Allison</h6>
                      <span>May 19, 2020 • Sports</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
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
