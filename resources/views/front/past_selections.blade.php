@extends('front.layout.app')
@section('content')


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
                        Past Selections
                    </h2>
                    <br>
                    <h6 style="color:{{ $colorSection['leaderboard']['header_color'] }};">
                      Season : {{$season_name}}
                    </h6>


                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-dark table-striped  tableBoard">
                                    <thead>
                                        <tr class="table-primary">
                                            {{-- <th>S no.</th> --}}

                                            <th scope="col">Match</th>
                                            <th scope="col">Win</th>
                                            <th scope="col">Loss</th>
                                            <th scope="col">My Pick</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Time</th>
                                            <th scope="col">Points</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($past_selections as $week => $weakData)

                                        <tr>

                                            <td style="color: #db9a29;font-weight:bold;">Week : {{ $week }}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                            @foreach ($weakData as $weaks => $team)
{{-- {{dd($team)}} --}}
                                                @if ($week == $team->fweek)

                                                    <tr>
                                                        {{-- <td>1</td> --}}

                                                        <td>
                                                            <div
                                                                class="fixureMatch d-flex align-items-center justify-content-center">
                                                                <div class="teamOne">
                                                                    <img src="{{ asset('storage/images/team_logo/' . $team->first_logo) }}"
                                                                        alt="" class="img-fluid">

                                                                    <div style="min-width:200px">{{ $team->first_name }}
                                                                    </div>
                                                                </div>
                                                                <div class="versis">
                                                                    <h5>VS</h5>

                                                                </div>
                                                                <div class="teamOne">
                                                                    <img src="{{ asset('storage/images/team_logo/' . $team->second_logo) }}"
                                                                        alt="" class="img-fluid">

                                                                    <div style="min-width:200px">{{ $team->second_name }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        {{-- <td>{{ get_team_logo($team->team_win) }}{{ get_team_name($team->team_win) }}
                                                        </td> --}}

                                                        <td>
                                                            <div class="teamOne">
                                                            <img src="{{ asset('storage/images/team_logo/' .get_team_logo($team->team_win) ) }}"
                                                                alt="" class="img-fluid">

                                                            <div style="min-width:200px">{{ get_team_name($team->team_win) }}</div>
                                                        </div>
                                                        </td>
                                                        <td>
                                                            <div class="teamOne">
                                                            <img src="{{ asset('storage/images/team_logo/' .get_team_logo($team->team_loss) ) }}"
                                                                alt="" class="img-fluid">

                                                            <div style="min-width:200px">{{ get_team_name($team->team_loss) }}</div>
                                                        </div>
                                                        </td>

                                                        {{-- <td>{{ get_team_name($team->team_loss) }}
                                                        </td> --}}

                                                        <td>
                                                            <div class="teamOne">
                                                                <img src="{{ asset('storage/images/team_logo/' .$team->tlogo) }}"
                                                                    alt="" class="img-fluid">

                                                                <div style="min-width:200px">{{ $team->user_team }}</div>
                                                            </div>
                                                        </td>

                                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $team->fdate)->format('M d , Y') }}
                                                        </td>
                                                        @if($team->ftime == '12:00:00' && $team->ftime_zone = 'am')
                                                        <td>TBD</td>
                                                        @else
                                                        <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $team->ftime)->format('H:i') }} {{ ucfirst($team->tformat )}} ET
                                                        </td>
                                                        @endif
                                                        {{-- <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $team->ftime)->format('H:i') }}{{ $team->tformat }}
                                                        </td> --}}
                                                        <td>{{ ($team->user_point) }}
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
