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
                        Dashboard
                    </h2>
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
                                        @foreach ($upcoming as $week => $weakData)
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
                                                                </div>
                                                                <div class="versis">
                                                                    <h5>VS</h5>

                                                                </div>
                                                                <div class="teamOne">
                                                                    <img src="{{ asset('storage/images/team_logo/' . $team->second_team_id->logo) }}"
                                                                        alt="" class="img-fluid">

                                                                    <div style="min-width:200px">{{ $team->second_team_id->name }}
                                                                    </div>
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
