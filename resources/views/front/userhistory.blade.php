@extends('front.layout.app')
@section('content')
    <style>
        .aSidebarCard {
            background-color: #fff;
            border-radius: 7px;
            padding: 20px 0;
            color: #333;
        }

        .aSidebarCard {
            text-align: left;
        }

        .aSidebarCard h4 {
            font-size: 20px;
            margin-bottom: 25px;
            padding: 0 20px;
        }

        .aSidebarCard h4>span {
            border-bottom: 3px solid #db9a29;
            padding-bottom: 3px;
            display: inline-block;
        }

        ul.sidebarLink {
            list-style: none;
            padding: 0px;
            border-top: 1px solid #eee;
            margin-bottom: 0;
        }

        ul.sidebarLink li+li {
            border-top: 1px solid #eee;
        }

        ul.sidebarLink li a {
            padding: 8px 20px;
            display: block;
            text-decoration: none;
            color: #333;
            position: relative;
            z-index: 1;
        }

        ul.sidebarLink li a:hover {
            color: #fff;
        }

        ul.sidebarLink li a:before {
            left: 0;
            position: absolute;
            content: "";
            background-color: #db9a29;
            top: 0;
            z-index: -1;
            height: 100%;
            transition: 0.5s;
            min-width: 0;
            opacity: 0;
        }

        ul.sidebarLink li a:hover:before {
            min-width: calc(100% + 0px);
            opacity: 1;
        }



        @media (min-width: 768px) {
            .tablePickTeam {
                padding-right: 30px;
            }
        }
    </style>

    <section id="nextmatchBoard"
        style="background-image:url({{ asset('front/img/football-2-bg.jpg') }});color:{{ $colorSection['leaderboard']['text_color'] }};">
        <div class="fluid-container text-center">
            <div class="row">
                <div class="col-sm-12">
                    <div class="leaderBoard">
                        <br>
                        <div class="loader d-none">
                            <img height="100px" width="100px" src="{{ asset('front/img/orange_circles.gif') }}"
                                alt="loader">
                        </div>
                    </div>
                </div>
                @include('front.layout.sidebar')
                <div class="col-sm-8 col-md-9">
                    <h2 style="color:{{ $colorSection['leaderboard']['header_color'] }};">
                        Dashboard
                    </h2>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-dark table-striped  tableBoard">
                                    <thead>
                                        <tr class="table-primary">
                                            <th scope="col">Season</th>
                                            <th scope="col">Match</th>
                                            <th scope="col">Win</th>
                                            <th scope="col">Loss</th>
                                            <th scope="col">My Pick</th>
                                            <th scope="col">Points</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($history))
                                            @foreach ($history as $his)
                                                <tr>
                                                    <td>{{$his->season_name}}</td>
                                                    <td>
                                                        <div
                                                            class="fixureMatch d-flex align-items-center justify-content-center">
                                                            <div class="teamOne">
                                                                <img src="{{ asset('storage/images/team_logo/' . $his->first_logo) }}"
                                                                    alt="" class="img-fluid">

                                                                <div style="min-width:200px">
                                                                    {{ $his->first_name }}
                                                                </div>
                                                            </div>
                                                            <div class="versis">
                                                                <h5>VS</h5>

                                                            </div>
                                                            <div class="teamOne">
                                                                <img src="{{ asset('storage/images/team_logo/' .$his->second_logo) }}"
                                                                    alt="" class="img-fluid">

                                                                <div style="min-width:200px">
                                                                    {{ $his->second_name }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>{{ get_team_name($his->team_win) }}
                                                    </td>
                                                    <td>{{ get_team_name($his->team_loss) }}
                                                    </td>
                                                    <td>{{ $his->user_team }}
                                                    </td>
                                                    <td>{{ $his->user_point }}
                                                    </td>


                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
@endsection