@extends('front.layout.app')
@section('content')
    <section id="matchFixture">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Match Fixture</h2>
                </div>

            </div>

            {{-- <div class="col-4">
                <form action="">
                    <div>
                        <select name="" id="" class="form-control">
                            <option value="">select Season</option>
                            @foreach ($fixtures as $seasons => $item)
                                <option value="">{{ $seasons }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <select name="" id="" class="form-control">
                            @foreach ($fixtures as $seasons => $item)
                                <option value="">{{ $seasons }}</option>
                            @endforeach
                            <option value="">select Week</option>
                        </select>
                    </div>
                </form>
            </div> --}}

            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="table-dark">
                                    {{-- <th scope="col" class="rollPlay">FRIDAY, SEPTEMBER 16TH</th> --}}
                                    <th scope="col">Match</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fixtures as $seasons => $weakData)
                                @foreach ($weakData as $weaks => $teamData)
                                @foreach ($teamData as  $team)
                                <tr>
                                    {{-- <th scope="row" class="rollPlay">week 1 of 18</th> --}}
                                    {{-- <th scope="row" class="rollPlay"></th> --}}
                                    <td>
                                        <div class="fixureMatch d-flex align-items-center justify-content-center">
                                            <div class="teamOne">
                                                <img src="{{asset('storage/images/team_logo/'.$team->firstTeamLogo)}}" alt="" class="img-fluid">
                                                {{-- <p>{{$team->firstTeamName}}</p> --}}
                                                <div style="min-width:200px">{{$team->firstTeamName}}</div>
                                            </div>
                                            <div class="versis">
                                                <h5>VS</h5>

                                            </div>
                                            <div class="teamOne">
                                                <img src="{{asset('storage/images/team_logo/'.$team->secondTeamLogo)}}" alt="" class="img-fluid">
                                                {{-- <p>{{$team->secondTeamName}}</p> --}}
                                                <div style="min-width:200px">{{$team->secondTeamName}}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $team->date)->format('M d , Y')}}</td>
                                    <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $team->time)->format('H:i')}}{{$team->time_zone}}</td>


                                </tr>

                                @endforeach
                                @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



        </div>
    </section>
@endsection
