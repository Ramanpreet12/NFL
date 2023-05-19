@extends('front.layout.app')
@section('content')
    <!-- mainheader -->

    {{-- <section id="matchResult">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Match Result</h2>

            </div>
        </div>
        @forelse ($get_match_results as $season =>  $weeks)

        @foreach ($weeks as $week => $teams)

        @foreach ($teams as $team)


        <div class="resultSection">
            <div class="row">
                <div class="col-12">
                    <div class="seasonWeek d-flex">
                        <h5>Season : {{$season}}</h5>
                        <span>week {{$week}} of 18 </span>

                    </div>
                </div>
            </div>
            <div class="matchShow">
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-auto"> <img src="img/blue.png" alt="" class="img-fluid"> </div>
                            <div class="col text-end">
                                <h3 class="firstTeam">
                                     @if ($team->win == $team->first_team)
                                    {{$team->t1_name}}
                                    @elseif ($team->win == $team->second_team)
                                    {{$team->t2_name}}
                                    @endif
                                </h3>
                            </div>
                            <div class="col-auto text-center resultArt">

                                <div class="numberBack ">
                                    @if ($team->win == $team->first_team)
                                        {{$team->team1_win}}
                                    @elseif ($team->win == $team->second_team)
                                    {{$team->team2_win}}
                                    @endif
                                </div>
                                <span class="winColor">Win</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-auto text-center  resultArt">
                                <div class="numberBack  yellowNumber">
                                    @if ($team->loss == $team->first_team)
                                    {{$team->team1_win}}
                                @elseif ($team->loss == $team->second_team)
                                {{$team->team2_win}}
                                @endif

                                </div>
                                <span class="lossColor">Loss</span>
                            </div>
                            <div class="col">
                                <h3 class="secondTeam">
                                    @if ($team->loss == $team->first_team)
                                    {{$team->t1_name}}
                                    @elseif ($team->loss == $team->second_team)
                                    {{$team->t2_name}}
                                    @endif
                                </h3>
                            </div>
                            <div class="col-auto">
                                <img src="img/purple.png" alt="" class="img-fluid purpleImg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="timeFixture text-center">
                <span>{{ \Carbon\Carbon::parse($team->date)->format('j F, Y') }}&nbsp;
                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $team->time)->format('g:i') }}
                    {{ ucfirst($team->time_zone) }}</span>
            </div>
        </div>

        @endforeach
        @endforeach
        @empty
            <div class="timeFixture text-center">
                <span>NO Match Result Found</span>
            </div>
        </div>
        @endforelse
    </div>
</section> --}}



    <section id="matchResult">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Match Result</h2>
                        <h5>Season : {{$season_name}}</h5>

                </div>
            </div>

            @foreach ($get_match_results as $week => $weakData)

            <div class="row">
                <div class="col-12">
                    <div class="seasonWeek d-flex">
                        <h5></h5>
                        <span>week {{$week}} of 18 </span>

                    </div>
                </div>
            </div>

            @foreach ($weakData as $weeks => $team)

                 @if ($week == $team->week)


            <div class="matchDetail">
                <div class="row">
                    <div class="col-md-5">
                        <div class="teamResult">
                            <div class="teamInfo">
                                <div class="result-content">
                                    <h4><span>{{$team->win_name}}</span></h4>
                                    <p class="loseResult">WIN</p>
                                </div>
                            </div>
                            <div class="teamLogo">
                                {{-- <img src="{{asset('storage/images/team_logo/'.$team->t2_logo)}}" alt="" class="img-fluid teamlogoImg"> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="result-count">
                            <div class="count_number">
                                <span class="win-Team">
                                    @if ($team->win ==  $team->first_team_id->id)
                                       {{$team->first_team_id->win}}
                                       @elseif ($team->win == $team->second_team_id->id)

                                       {{$team->second_team_id->win}}
                                       @elseif ($team->win == null)
                                       {{'0'}}

                                    @endif
                                </span>
                                <span>-</span>
                                <span class="lose-Team">
                                    @if ($team->loss ==  $team->first_team_id->id)
                                       {{$team->first_team_id->win}}
                                       @elseif ($team->loss == $team->second_team_id->id)
                                       {{$team->second_team_id->win}}

                                    @endif
                                    @if ($team->loss==null)
                                        {{'0'}}
                                    @endif
                                </span>
                            </div>
                            <p>{{ \Carbon\Carbon::parse($team->date)->format('j F, Y') }}&nbsp;</p>
                              <p>  {{ \Carbon\Carbon::createFromFormat('H:i:s', $team->time)->format('g:i') }}
                                {{ ucfirst($team->time_zone) }}</p>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="teamResult resultDetail">

                            <div class="teamLogo">
                                {{-- <img src="{{asset('storage/images/team_logo/'.$team->t2_logo)}}" alt="" class="img-fluid teamlogoImg"> --}}
                            </div>
                            <div class="teamInfo">
                                <div class="result-content">
                                    <h4><span>{{$team->loss_name}}</span></h4>
                                    <p class="loseResult">LOSE</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
                 @endforeach
            @endforeach

        </div>
    </section>




    <style>
        .matchDetail {
            background-color: #e2e1e1;
            padding: 20px;
            margin-bottom: 40px;
        }

        .teamResult {
            display: flex;
            background-image: url(https://nfl.kloudexpert.com/front/img/resultBoard.png-11.png);
            background-size: 83% 100%;
            background-repeat: no-repeat;
            background-position: top left;
            justify-content: space-between;
            margin-bottom: 40px;
        }

        .resultDetail {
            background-image: url(https://nfl.kloudexpert.com/front/img/resultBoard.png);
            background-size: 83% 100%;
            background-position: top right;
        }

        .teamInfo {
            padding: 15px 40px 15px 44px;
            text-align: right;
            min-height: 163px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex: 1 0 0;
        }

        .resultDetail .teamInfo {
            padding: 26px 26px 38px 40px;
            text-align: left;
        }

        .teamInfo .loseResult {
            color: #da9a29;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 0;
        }

        .teamInfo .finalNumber {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.7)
        }

        .teamInfo h4 {
            margin-bottom: 10px;
        }

        .teamInfo h4 span {
            color: rgba(255, 255, 255, 0.7);
            position: relative;
            margin-bottom: 10px;
        }

        .teamInfo h4 span:after {
            position: absolute;
            content: '';
            width: 50%;
            right: 0;
            height: 3px;
            background-color: #da9a29;
            top: 100%;
        }

        .resultDetail .teamInfo h4 span:after {
            left: 0;
        }

        .teamLogo {
            position: relative;
            flex: 0 0 170px;
            z-index: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 163px;
        }

        .teamLogo:before {
            background-image: url(https://nfl.kloudexpert.com/front/img/resultlogo.png);
            background-size: 100%;
            background-repeat: no-repeat;
            background-position: top left;
            padding: 40px;
            content: "";
            left: -20px;
            position: absolute;
            top: -10px;
            /* width: 100%; */
            right: -20px;
            z-index: -1;
            bottom: -69px;
        }

        .teamlogoImg {
            width: 100px;
        }

        .count_number {
            display: flex;
            font-size: 90px;
            color: #06083b;
            font-weight: 700;
            padding: 0 5px;
            line-height: 90px;
            justify-content: center;
            margin-bottom: 30px
        }

        .result-count {
            text-align: center;
        }




        @media only screen and (min-width: 320px) and (max-width: 767px) {
            .teamInfo {
                padding: 15px 21px 15px 40px;
                justify-content: left;
                min-height: inherit;
            }

            .teamLogo {
                flex: 0 0 100px;
                min-height: inherit;
                padding: 0 15px;
            }

            .teamLogo:before {
                display: none;
            }

            .teamResult {
                background-size: 100% 100%;
                margin-bottom: 15px;
                max-width: 400px;
                margin-left: auto;
                margin-right: auto;
            }

            .resultDetail .teamInfo {
                padding: 15px 14px 15px 21px;
            }

            .count_number {
                font-size: 56px;
                margin-bottom: 12px;
                line-height: 56px;
            }
        }

        @media only screen and (min-width: 768px) and (max-width: 991px) {
            .count_number {
                font-size: 50px;
                line-height: 50px;
            }

            .teamResult {
                background-size: 100% 100%;
            }

            .teamInfo {
                padding: 15px 0px 15px 20px;
                justify-content: right;
            }

            .teamLogo {
                flex: 0 0 80px;
                padding: 0 15px;
            }

            .resultDetail .teamInfo {
                padding: 13px 20px 0px 0px;
            }

            .teamLogo:before {
                display: none;
            }
        }

        @media only screen and (min-width: 991px) and (max-width: 1199px) {
            .teamLogo:before {
                display: none;
            }

            .teamResult {
                background-size: 100% 100%;
            }

            .teamInfo {
                padding: 15px 0px 15px 40px;
                justify-content: right;
            }

            .resultDetail .teamInfo {
                padding: 26px 71px 38px 0px;
            }

            .teamLogo {
                flex: 0 0 100px;
                padding: 0 15px;
            }



        }
    </style>
@endsection
