@extends('front.layout.app')
@section('content')
    <section id="matchFixture">
        <div class="container">
            <div class="row">
                <div class="col-12">
                            <h2>Match Fixture</h2>
                            <h5 style="color:#444">Season : {{ $season_name }}</h5>
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

                                    {{-- <th scope="col" class="rollPlay">Week</th> --}}
                                    <th scope="col">Match</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fixtures as $week => $weakData)

                                    <tr>
                                        <td style="color: #db9a29;font-weight:bold;">Week : {{ $week }}</td>
                                        <td></td>
                                        <td></td>
                                        {{-- <td></td> --}}
                                    </tr>
                                    @foreach ($weakData as $weeks => $team)

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
                                        @endif
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
