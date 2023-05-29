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
                    @if (session()->has('success'))
                    <div class="alert alert-success show flex items-center mb-2 alert_messages" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-check2-circle" viewBox="0 0 16 16">
                            <path
                                d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                            <path
                                d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                        </svg>
                        &nbsp; {{ session()->get('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger show flex items-center mb-2" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2">
                            <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2">
                            </polygon>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                        {{ session('error') }}
                        <a href="{{ route('payment') }}">Click here to Pay</a>
                    </div>
                @endif
                @if (session('select-error'))
                <div class="alert alert-danger show flex items-center mb-2 alert_messages" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2">
                        <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2">
                        </polygon>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    {{ session('select-error') }}
                </div>
            @endif
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-dark table-striped  tableBoard">
                                    <thead>
                                        <tr class="table-primary">
                                            <th scope="col">Match</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fixture as $week => $weakData)
                                        <tr>
                                            <td style="color: #db9a29;font-weight:bold;">Week : {{ $week }}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                            @foreach ($weakData as $weaks => $team)
                                                @if ($week == $team->week)

                                                    <tr>
                                                        <td>
                                                            <div
                                                                class="fixureMatch d-flex align-items-center justify-content-center">
                                                                <div class="teamOne">
                                                                    <img src="{{ asset('storage/images/team_logo/' . $team->first_team_id->logo) }}"
                                                                        alt="" class="img-fluid">

                                                                    <div style="min-width:200px">{{ $team->first_team_id->name }}
                                                                    </div>
                                                                    <form action="{{ route('pickTeam') }}" method="post">
                                                                        @csrf
                                                                        <input type="hidden" name="team"
                                                                            value="{{ $team->first_team_id->id }}">
                                                                        <input type="hidden" name="season" value="{{ $team->season_id }}">
                                                                        <input type="hidden" name="week" value="{{ $week }}">
                                                                        <input type="hidden" name="date" value="{{ $team->date }}">
                                                                        <input type="hidden" name="fixture" value="{{ $team->id }}">
                                                                        <button type="submit" class="btn btn-primary my-4">@if(isSelected( $team->season_id, $week,$team->first_team_id->id  )) Picked @else Pick Team @endif</button>
                                                                    </form>
                                                                </div>
                                                                <div class="versis mx-5">
                                                                    <h5>VS</h5>

                                                                </div>
                                                                <div class="teamOne">
                                                                    <img src="{{ asset('storage/images/team_logo/' . $team->second_team_id->logo) }}"
                                                                        alt="" class="img-fluid">

                                                                    <div style="min-width:200px">{{ $team->second_team_id->name }}
                                                                    </div>
                                                                    <form action="{{ route('pickTeam') }}" method="post">
                                                                        @csrf
                                                                        <input type="hidden" name="team"
                                                                            value="{{ $team->second_team_id->id }}">
                                                                        <input type="hidden" name="season"
                                                                            value="{{ $team->season_id }}">
                                                                        <input type="hidden" name="week"
                                                                            value="{{ $week }}">
                                                                        <input type="hidden" name="date"
                                                                            value="{{ $team->date }}">
                                                                            <input type="hidden" name="fixture"
                                                                            value="{{ $team->id }}">
                                                                        <button type="submit" class="btn btn-primary my-4">@if(isSelected( $team->season_id, $week,$team->second_team_id->id  )) Picked @else Pick Team @endif </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $team->date)->format('M d , Y') }}
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $team->time)->format('H:i') }}{{ $team->time_zone }}
                                                        </td>


                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
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
