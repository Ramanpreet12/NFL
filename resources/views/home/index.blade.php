@extends('front.layout.app')
@section('content')
    <section id="heroBanner">
        <div class="owl-carousel owl-heroSlider">
            @forelse ($banners as $banner)
                <div class="owlItem" style="background-image:url({{ asset('storage/images/banners/' . $banner->image) }})">
                    <div class="bannerCaption">
                        <div class="container">
                            <div class="row justify-content-lg-end">
                                <div class="col-sm-12 col-md-8 col-lg-5 ">

                                    {{-- <h1 style="color:{{ $colorSection['scoreboard']["header_color"] }};">We Love<span class="#textColor">Football</span></h1> --}}
                                    <h1 style="color:{{ $colorSection['scoreboard']['header_color'] }};">
                                        {{ $general->homepage_title }}</h1>

                                    <p style="color:{{ $colorSection['scoreboard']['text_color'] }};">
                                        {{ $general->homepage_subtitle }}</p>
                                    <div class="booking mt-5">
                                        <a href="{{ route('register') }}">
                                            <button type="button" class="btn btn-primary  btn-lg"
                                                style="color:{{ $colorSection['scoreboard']['text_color'] }};">SUBSCRIBE</button>
                                        </a>

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
                                    <h1 style="color:{{ $colorSection['scoreboard']['header_color'] }};">
                                        {{ $general->homepage_title }}</h1>

                                    <p style="color:{{ $colorSection['scoreboard']['text_color'] }};">
                                        {{ $general->homepage_subtitle }}</p>
                                    <div class="booking mt-5">
                                        <button type="button" class="btn btn-primary  btn-lg"
                                            style="color:{{ $colorSection['scoreboard']['text_color'] }};">SUBSCRIBE</button>
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
                                    <h1 style="color:{{ $colorSection['scoreboard']['text_color'] }};">We Love<span
                                            class="#textColor">Football</span></h1>
                                    <p style="color:{{ $colorSection['scoreboard']['text_color'] }};">Don't walk through
                                        life just playing football. Don't walk through life just being an athlete.
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


    {{-- @foreach ($team_results as $team_result)
        <section id="matchBoard" style="color:{{ $colorSection['scoreboard']['text_color'] }};">
            <div class="container text-center">
                <div class="row g-0 team-vs">
                    <span class="score">{{ $team_result->team1_score }}-{{ $team_result->team2_score }}</span>
                    <div class="col-sm-6">
                        <div class="firstBoard boardItem"
                            style="background-color:{{ $colorSection['scoreboard']['bg_color'] }};">
                            <div class="boardItem-inner">
                                @if ($team_result)
                                    <img src="{{ asset('storage/images/team_logo/' . $team_result->team_result_id1->logo) }}"
                                        alt="" class="img-fluid">
                                @else
                                    <img src="{{ asset('front/img/AZ-Cardinals 1.png') }}" alt=""
                                        class="img-fluid">
                                @endif

                                <h3>{{ $team_result->team1_id ? $team_result->team_result_id1->name : '' }}</h3>
                                <h4>{{ $team_result->team1_score > $team_result->team2_score ? 'Win' : 'Loss' }}</h4>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="secondBoard boardItem"
                            style="background-color:{{ $colorSection['scoreboard']['bg_color'] }};">
                            <div class="boardItem-inner">
                                @if ($team_result)
                                    <img src="{{ asset('storage/images/team_logo/' . $team_result->team_result_id2->logo) }}"
                                        alt="" class="img-fluid">
                                @else
                                    <img src="{{ asset('front/img/Philly-Eagles.png') }}" alt="" class="img-fluid">
                                @endif
                                <h3>{{ $team_result->team2_id ? $team_result->team_result_id2->name : '' }}</h3>
                                <h4>{{ $team_result->team2_score > $team_result->team1_score ? 'Win' : 'Loss' }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach --}}


    <section id="nextmatchBoard"
        style="background-image:url({{ asset('front/img/football-2-bg.jpg') }});color:{{ $colorSection['leaderboard']['text_color'] }};">
        <div class="container text-center">
            <div class="row">
                <div class="col-sm-6 col-md-5">
                    <div class="upcomingMatchBlock">
                        <h2 style="color:{{ $colorSection['leaderboard']['header_color'] }};">
                            @if (!empty($fixtureHeading->value))
                                {{ $fixtureHeading->value }}
                            @else
                                UPCOMING MATCHES
                            @endif

                        </h2>
                        {{-- {{dd($upcoming_matches)}} --}}
                        @foreach ($upcoming_matches as $upcoming_match)
                            <div class="tabletwo">
                                <div class="matchTable align-items-center justify-content-center">
                                    <div class="firstTeam">
                                        {{-- @if ($upcoming_match)
                                            <img src="{{ asset('storage/images/team_logo/' . $upcoming_match->first_team_id->logo ?? '') }}"
                                                alt="" class="img-fluid">
                                        @else
                                            <img src="{{ asset('front/img/Bears 1.png') }}" alt=""
                                                class="img-fluid">
                                        @endif --}}

                                        {{-- <h5>Bears <span>(win)</span></h5> --}}
                                        <h5>{{ $upcoming_match->first_team_id->name ? $upcoming_match->first_team_id->name : '' }}
                                        </h5>
                                    </div>
                                    <div class="teamVs">
                                        <h5>VS</h5>
                                    </div>
                                    <div class="secondTeam">
                                        @if ($upcoming_match)
                                            <img src="{{ asset('storage/images/team_logo/' . $upcoming_match->second_team_id->logo) }}"
                                                alt="" class="img-fluid">
                                        @else
                                            <img src="{{ asset('front/img/Vikings.png') }}" alt=""
                                                class="img-fluid">
                                        @endif


                                        {{-- <h5>Vikings <span>(loss)</span></h5> --}}
                                        <h5>{{ $upcoming_match->second_team_id->name ? $upcoming_match->second_team_id->name : '' }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="matchTime">
                                    {{-- <span>20 March 2023 19:00</span> --}}

                                    <span> {{ \Carbon\Carbon::parse($upcoming_match->date)->format('j F, Y') }}
                                        {{ \Carbon\Carbon::createFromFormat('H:i:s', $upcoming_match->time)->format('g:i') }}
                                        {{ ucfirst($upcoming_match->time_zone) }}</span>
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
                        <h2 style="color:{{ $colorSection['leaderboard']['header_color'] }};">
                            @if (!empty($leaderboardHeading->value))
                                {{ $leaderboardHeading->value }}
                            @else
                                LEADERBOARD
                            @endif
                        </h2>

                        {{-- <div class="tabletwo">
              <div class="table-responsive">
                <table class="table table-dark table-striped  tableBoard" style="background-color:{{ $colorSection['leaderboard']["bg_color"] }};color:{{ $colorSection['leaderboard']["text_color"] }};">
                  <thead>
                    <tr class="table-primary" >
                      <th scope="col" class="teamNumber">Region</th>
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
                  </tbody>
                </table>
              </div>
            </div> --}}

                        <div class="tabletwo">
                            <div class="table-responsive">
                                <table class="table table-dark table-striped  tableBoard">
                                    <thead>
                                        <tr class="table-primary">
                                            <th scope="col" class="teamNumber">Region</th>
                                            <th scope="col" class="teamNumber">N.</th>
                                            <th scope="col" colspan="2" class="text-start"> Players</th>
                                            <th scope="col">W</th>
                                            <th scope="col">L</th>
                                            <th scope="col">PTS</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @foreach ($get_regions as $regions => $teams)
                                            @foreach (array_values($teams[0]['teams']) as $i => $value)
                                                {{-- @php
                                                echo "<pre>";
                                                    // print_r($teams['0']['teams']);
                                                    // die();
                                                echo count($teams['0']['teams']);
                                                die();


                                            @endphp --}}
                                                {{-- @if (count($teams['0']['teams']) <= 3)
                                                {{'<=3'}}
                                            @else
                                                {{'>3'}}
                                            @endif --}}
                                                @if ($loop->iteration == 4)
                                                @break;
                                            @endif
                                            <tr>
                                                @if ($i === 0)
                                                    {{-- <th scope="row" rowspan="3">{{$regions}}</th> --}}
                                                    <th scope="row"
                                                        @if (count($teams['0']['teams']) <= 3) rowspan="{{ count($teams['0']['teams']) }}"
                                                    @else
                                                        rowspan="3" @endif>
                                                        {{ $regions }}</th>
                                                @endif
                                                <td>{{ ++$i }}</td>
                                                <td class="teamLogo">
                                                    <img src="{{ asset('storage/images/team_logo/' . $value['logo']) }}"
                                                        alt="" class="img-fluid">
                                                </td>

                                                <td class="teamName">
                                                    {{-- <span>{{ ucfirst($value['player_name']['0']->name ?? '') }}</span> --}}
                                                </td>
                                                <td>{{ $value['win'] }}</td>
                                                <td>{{ $value['loss'] }}</td>
                                                <td>{{ $value['pts'] }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>


                                {{-- <tbody class="table-group-divider">
                                        <tr>
                                          <th scope="row" rowspan="3">North</th>
                                          <td>1</td>
                                          <td class="teamLogo ">
                                           <img src="img/SF-49ers 1.png" alt="" class="img-fluid">
                                          </td>
                                          <td class="teamName">
                                            <span>Liam</span>
                                          </td>


                                          <td>14</td>
                                          <td>1</td>
                                          <td>28</td>
                                        </tr>
                                        <tr>
                                          <td>2</td>
                                          <td class="teamLogo">
                                             <img src="img/Bears 1.png" alt="" class="img-fluid">
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
                                             <img src="img/Packers 1.png" alt="" class="img-fluid">
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
                                           <img src="img/SF-49ers 1.png" alt="" class="img-fluid">
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
                                             <img src="img/Bears 1.png" alt="" class="img-fluid">
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
                                             <img src="img/Packers 1.png" alt="" class="img-fluid">
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
                                           <img src="img/SF-49ers 1.png" alt="" class="img-fluid">
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
                                             <img src="img/Bears 1.png" alt="" class="img-fluid">
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
                                             <img src="img/Packers 1.png" alt="" class="img-fluid">
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
                                           <img src="img/SF-49ers 1.png" alt="" class="img-fluid">
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
                                             <img src="img/Bears 1.png" alt="" class="img-fluid">
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
                                             <img src="img/Packers 1.png" alt="" class="img-fluid">
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
                                           <img src="img/SF-49ers 1.png" alt="" class="img-fluid">
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
                                             <img src="img/Bears 1.png" alt="" class="img-fluid">
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
                                             <img src="img/Packers 1.png" alt="" class="img-fluid">
                                          </td>
                                          <td class="teamName">
                                            <span>Ian</span>
                                          </td>
                                          <td>10</td>
                                          <td>3</td>
                                          <td>24</td>
                                        </tr>
                                    </tbody> --}}
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


</section>

{{-- player roster section --}}


<section id="nextmatchBoard"
    style="background-image:url({{ asset('front/img/football-2-bg.jpg') }});color:{{ $colorSection['leaderboard']['text_color'] }};">
    <div class="container text-center">
        <div class="row">

            <div class="col-sm-12">
                <div class="leaderBoard">
                    <h2 style="color:{{ $colorSection['leaderboard']['header_color'] }};">
                        Player's Roster

                        {{-- @if (!empty($leaderboardHeading->value))
                        {{ $leaderboardHeading->value }}
                    @else
                        Player's Roster
                    @endif --}}
                    </h2>
                    <br>
                    <h3>
                             {{-- <span class="alphabets">A</span> / <span class="alphabets">B</span> /
                             <span class="alphabets">C</span> / <span class="alphabets">D</span> /
                             <span class="alphabets">E</span> / <span class="alphabets">F</span> /
                             <span class="alphabets">G</span> / <span class="alphabets">H</span> /
                             <span class="alphabets">I</span> / <span class="alphabets">J</span> /
                             <span class="alphabets">K</span> / <span class="alphabets">L</span> /
                             <span class="alphabets">M</span> / <span class="alphabets">N</span> /
                             <span class="alphabets">O</span> / <span class="alphabets">P</span> /
                             <span class="alphabets">Q</span> / <span class="alphabets">R</span> /
                             <span class="alphabets">S</span> / <span class="alphabets">T</span> /
                             <span class="alphabets">U</span> / <span class="alphabets">V</span> /
                             <span class="alphabets">W</span> / <span class="alphabets">X</span> /
                             <span class="alphabets">Y</span> / <span class="alphabets">Z</span> --}}

                           <a href="{{url('player_roster/A')}}">A</a> /
                           <a href="{{url('player_roster/B')}}">B</a> /
                           <a href="{{url('player_roster/C')}}">C</a> /
                           <a href="{{url('player_roster/D')}}">D</a> /
                           <a href="{{url('player_roster/E')}}">E</a> /
                           <a href="{{url('player_roster/F')}}">F</a> /
                           <a href="{{url('player_roster/G')}}">G</a> /
                           <a href="{{url('player_roster/H')}}">H</a> /
                           <a href="{{url('player_roster/I')}}">I</a> /
                           <a href="{{url('player_roster/J')}}">J</a> /
                           <a href="{{url('player_roster/K')}}">K</a> /
                           <a href="{{url('player_roster/L')}}">L</a> /
                           <a href="{{url('player_roster/M')}}">M</a> /
                           <a href="{{url('player_roster/N')}}">N</a> /



                    </h3>
                    <div class="loader d-none">
                        <img height="100px" width="100px" src="{{ asset('front/img/orange_circles.gif') }}" alt="loader">
                    </div>
                    <div class="tabletwo">

                        <div class="table-responsive">
                            <table class="table table-dark table-striped  tableBoard d-none" id="roaster-table">
                                <thead>
                                    <tr class="table-primary">
                                        <th scope="col" class="teamNumber">Region</th>
                                        <th scope="col" class="teamNumber">N.</th>
                                        <th scope="col" colspan="2" class="text-start"> Players</th>
                                        <th scope="col">W</th>
                                        <th scope="col">L</th>
                                        <th scope="col">PTS</th>
                                    </tr>
                                </thead>



                                <tbody class="table-group-divider" id="table-data">
                                    {{-- <tr>
                                  <th scope="row" rowspan="3">North</th>
                                  <td>1</td>
                                  <td class="teamLogo ">
                                   <img src="front/img/SF-49ers 1.png" alt="" class="img-fluid">
                                  </td>
                                  <td class="teamName">
                                    <span>Liam</span>
                                  </td>


                                  <td>14</td>
                                  <td>1</td>
                                  <td>28</td>
                                </tr>
                                <tr>
                                  <td>2</td>
                                  <td class="teamLogo">
                                     <img src="front/img/Bears 1.png" alt="" class="img-fluid">
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
                                     <img src="front/img/Packers 1.png" alt="" class="img-fluid">
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
                                   <img src="front/img/SF-49ers 1.png" alt="" class="img-fluid">
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
                                     <img src="front/img/Bears 1.png" alt="" class="img-fluid">
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
                                     <img src="front/img/Packers 1.png" alt="" class="img-fluid">
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
                                   <img src="front/img/SF-49ers 1.png" alt="" class="img-fluid">
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
                                     <img src="front/img/Bears 1.png" alt="" class="img-fluid">
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
                                     <img src="front/img/Packers 1.png" alt="" class="img-fluid">
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
                                   <img src="front/img/SF-49ers 1.png" alt="" class="img-fluid">
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
                                     <img src="front/img/Bears 1.png" alt="" class="img-fluid">
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
                                     <img src="front/img/Packers 1.png" alt="" class="img-fluid">
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
                                   <img src="front/img/SF-49ers 1.png" alt="" class="img-fluid">
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
                                     <img src="front/img/Bears 1.png" alt="" class="img-fluid">
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
                                     <img src="front/img/Packers 1.png" alt="" class="img-fluid">
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

{{-- <section id="videoBoard" style="background-color:{{ $colorSection['video']["bg_color"] }};">
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
  </section> --}}


<section id="videoBoard" style="background-color:{{ $colorSection['video']['bg_color'] }};">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 style="color:{{ $colorSection['video']['header_color'] }};">
                    @if (!empty($videosHeading->value))
                        {{ $videosHeading->value }}
                    @else
                        VIDEOS
                    @endif
                </h2>
                <div class="owl-carousel owl-videoslider">
                    @if (!empty($vacations))
                        @foreach ($vacations as $vacation)
                            <div class="item">
                                <div class="video-container" id="video-container">
                                    @php
                                    $get_imageName = $vacation->image_video;

                                   $get_extension =  explode('.' , $get_imageName);
                                   $ext = end($get_extension)
                                @endphp
                                @if (($ext == 'jpg')||($ext == 'jpeg')||($ext == 'png')||($ext == 'svg')||($ext == 'webp'))
                                   <img src="{{asset('storage/images/vacation/'.$vacation->image_video)}}" alt="" height="100%" width="100%">
                                @else
                                <video controls id="video" preload="metadata"
                                        poster="{{ asset('front/img/poster 1.png') }}">
                                        <source src="{{ asset('storage/images/vacation' . $vacation->image_video) }}"
                                            type="video/mp4">
                                    </video>
                                @endif
                                    <div class="play-button-wrapper">
                                        <div title="Play video" class="play-gif" id="circle-play-b">
                                            <!-- SVG Play Button -->
                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
                                                <path
                                                    d="M40 0a40 40 0 1040 40A40 40 0 0040 0zM26 61.56V18.44L64 40z" />
                                            </svg> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- newssection -->
<section id="newsPart" style="background-color:{{ $colorSection['news']['bg_color'] }};">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 style="color:{{ $colorSection['news']['header_color'] }};">

                    @if (!empty($newsHeading->value))
                        {{ $newsHeading->value }}
                    @else
                        NEWS
                    @endif

                </h2>
                <div class="owl-carousel owl-videoslider owl-theme mt-10">
                    @if (!empty($news))
                        @foreach ($news as $news_item)
                            <div class="newsBanner">
                                <div class="mainImage">
                                    <img src="{{ asset('storage/images/news/' . $news_item->image) }}" alt=""
                                        class="img-fluid">
                                </div>
                                <div class="newsItemText">
                                    <div class="itemTextinner">
                                        <h6>{{ $news_item->title }}</h6>
                                        <div class="newsimgText d-flex align-items-center">
                                            <div class="imgRound me-3">
                                                <img src="{{ asset('storage/images/news/' . $news_item->image) }}"
                                                    alt="" class="img-fluid">
                                            </div>
                                            <div class="textItem">
                                                <h6>{{ $news_item->header }}</h6>
                                                <span>{!! $news_item->description !!}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>

<style type="text/css">
    #heroBanner .btn-primary:before {
        background-color: <?php echo $colorSection['scoreboard']['button_color']; ?>;
    }

    #heroBanner .btn-primary:after {
        background-color: <?php echo $colorSection['scoreboard']['button_color']; ?>;
    }

    #heroBanner .owl-nav button span {
        background-color: <?php echo $colorSection['scoreboard']['button_color']; ?>;
    }

    #heroBanner .owl-nav button.owl-prev span:after {
        background: <?php echo $colorSection['scoreboard']['button_color']; ?>;
    }

    #heroBanner .owl-nav button.owl-next span:after {
        background: <?php echo $colorSection['scoreboard']['button_color']; ?>;
    }

    #matchBoard .team-vs .secondBoard:before {
        background: <?php echo $colorSection['scoreboard']['button_color']; ?>;
    }

    #nextmatchBoard .matchTable .teamVs {
        background-color: <?php echo $colorSection['leaderboard']['button_color']; ?>;
        ;
    }

    #nextmatchBoard .matchTable {
        background-color: <?php echo $colorSection['leaderboard']['bg_color']; ?>;
        border-top: <?php echo $colorSection['leaderboard']['button_color']; ?>;
    }

    #nextmatchBoard .matchTime a {
        color: <?php echo $colorSection['leaderboard']['text_color']; ?>;
    }

    #nextmatchBoard .table-primary {
        --bs-table-bg: <?php echo $colorSection['leaderboard']['button_color']; ?>;
    }

    #nextmatchBoard .table-striped>tbody>tr:nth-of-type(odd)>* {
        color: <?php echo $colorSection['leaderboard']['text_color']; ?>;
    }

    #nextmatchBoard .table-dark {
        color: <?php echo $colorSection['leaderboard']['text_color']; ?>;
    }

    #nextmatchBoard .table-primary {
        color: <?php echo $colorSection['leaderboard']['text_color']; ?>;
    }

    /* #nextmatchBoard .table>:not(caption)>*>* {
        background-color: <?php echo $colorSection['leaderboard']['bg_color']; ?>;
      }*/



    #videoBoard h2:before {
        background: <?php echo $colorSection['video']['button_color']; ?>;
    }

    #videoBoard .owl-nav button span {
        background-color: <?php echo $colorSection['video']['button_color']; ?>;
    }

    #videoBoard .owl-nav button.owl-prev span:after {
        background: <?php echo $colorSection['video']['button_color']; ?>;
    }

    #videoBoard .owl-nav button.owl-next span:after {
        background: <?php echo $colorSection['video']['button_color']; ?>;
    }

    #newsPart h2:before {
        background: <?php echo $colorSection['news']['button_color']; ?>;
    }

    #newsPart .owl-nav button span {
        background-color: <?php echo $colorSection['news']['button_color']; ?>;
    }

    #newsPart .owl-nav button.owl-prev span:after {
        background: <?php echo $colorSection['news']['button_color']; ?>;
    }

    #newsPart .owl-nav button.owl-next span:after {
        background: <?php echo $colorSection['news']['button_color']; ?>;
    }

    #newsPart .newsBanner .newsItemText {
        color: <?php echo $colorSection['news']['text_color']; ?>;

    }
</style>

@endsection
@section('script')
<script>
    $('.alphabets').on('click',function() {
        $(".loader").removeClass('d-none');
        let letter = $(this).text();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var htmlOutput = '';
        $.ajax({
            type: 'POST',
            url: '/alphabets',
            data: {
                letters: letter
            },
            success: function(data) {
                $(".loader").addClass('d-none');
                $("#roaster-table").removeClass('d-none');
               if(data.roster_data.length != 0){
                JSON.stringify(data)
                let entries = Object.entries(data.roster_data)
                let count = 1;
                trHTML = '';
                entries.map(([key, val] = entry) => {
                    val.forEach(element => {
                        console.log(element)
                        let log_image =
                            "{{ asset('storage/images/team_logo/') }}" + "/" +
                            element.logo;
                        trHTML += '<tr><td>' + key + '</td>';
                        trHTML += '<td>' + count +'</td>';
                        trHTML += '<td class="teamLogo">' + '<img src=' + log_image +' alt="" class="img-fluid">' +'</td>';
                        trHTML +='<td  class="teamName">' + element.name +'</td>';
                        trHTML +='<td>' + element.win + '</td>';
                        trHTML +='<td>' + element.loss +'</td>';
                        trHTML +='<td>' + element.pts + '</td></tr>';
                        count++;
                    });
                });
                $('#table-data').html(trHTML);
               }else{
                $('#table-data').html('<tr><td colspan="7"><h1>No Data Found</h1></tr></td>');
               }


            }
        });
    });
</script>
@endsection
