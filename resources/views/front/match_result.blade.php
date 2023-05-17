@extends('front.layout.app')
@section('content')
<!-- mainheader -->

<section id="matchResult">
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
                        {{-- <span>week 1 of 18 </span> --}}
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
                                {{-- <div class="numberBack ">{{$team->win == $team->first_team ? $team->team1_win : 'yy'}}</div> --}}
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
        <div class="resultSection">
            {{-- <div class="row">
                <div class="col-12">
                    <div class="seasonWeek d-flex">
                        <h5>Indian Super League</h5>
                        <span>week 1 of 18 </span>
                    </div>
                </div>
            </div> --}}
            <div class="matchShow">
                {{-- <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-auto"> <img src="img/blue.png" alt="" class="img-fluid"> </div>
                            <div class="col text-end">
                                <h3 class="firstTeam">SEAHAWKS</h3>
                            </div>
                            <div class="col-auto text-center resultArt">
                                <div class="numberBack ">4</div>
                                <span class="winColor">Win</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-auto text-center  resultArt">
                                <div class="numberBack  yellowNumber">2</div>
                                <span class="lossColor">Loss</span>
                            </div>
                            <div class="col">
                                <h3 class="secondTeam">SPARTANS</h3>
                            </div>
                            <div class="col-auto">
                                <img src="img/purple.png" alt="" class="img-fluid purpleImg">
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="timeFixture text-center">
                <span>NO Match Result Found</span>
            </div>
        </div>

        @endforelse

        {{-- <div class="resultSection">
            <div class="row">
                <div class="col-12">
                    <div class="seasonWeek text-end">
                        <span>week 2 of 18 </span>
                    </div>
                </div>
            </div>
            <div class="matchShow">
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-auto"> <img src="img/blue.png" alt="" class="img-fluid"> </div>
                            <div class="col text-end">
                                <h3 class="firstTeam">SEAHAWKS</h3>
                            </div>
                            <div class="col-auto text-center resultArt">
                                <div class="numberBack ">3</div>
                                <span class="winColor">Win</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-auto text-center  resultArt">
                                <div class="numberBack  yellowNumber">1</div>
                                <span class="lossColor">Loss</span>
                            </div>
                            <div class="col">
                                <h3 class="secondTeam">SPARTANS</h3>
                            </div>
                            <div class="col-auto">
                                <img src="img/purple.png" alt="" class="img-fluid purpleImg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="timeFixture text-center">
                <span>20 March 2022</span>
            </div>
        </div>
        <div class="resultSection">
            <div class="row">
                <div class="col-12">
                    <div class="seasonWeek text-end">
                        <span>week 3 of 18 </span>
                    </div>
                </div>
            </div>
            <div class="matchShow">
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-auto"> <img src="img/blue.png" alt="" class="img-fluid"> </div>
                            <div class="col text-end">
                                <h3 class="firstTeam">SEAHAWKS</h3>
                            </div>
                            <div class="col-auto text-center resultArt">
                                <div class="numberBack ">5</div>
                                <span class="winColor">Win</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-auto text-center  resultArt">
                                <div class="numberBack  yellowNumber">3</div>
                                <span class="lossColor">Loss</span>
                            </div>
                            <div class="col">
                                <h3 class="secondTeam">SPARTANS</h3>
                            </div>
                            <div class="col-auto">
                                <img src="img/purple.png" alt="" class="img-fluid purpleImg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="timeFixture text-center">
                <span> March 20,2022</span>
            </div>
        </div>

        <div class="resultSection">
            <div class="row">
                <div class="col-12">
                    <div class="seasonWeek text-end">
                        <span>week 4 of 18 </span>
                    </div>
                </div>
            </div>
            <div class="matchShow">
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-auto"> <img src="img/blue.png" alt="" class="img-fluid"> </div>
                            <div class="col text-end">
                                <h3 class="firstTeam">SEAHAWKS</h3>
                            </div>
                            <div class="col-auto text-center resultArt">
                                <div class="numberBack ">2</div>
                                <span class="winColor">Win</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-auto text-center  resultArt">
                                <div class="numberBack  yellowNumber">1</div>
                                <span class="lossColor">Loss</span>
                            </div>
                            <div class="col">
                                <h3 class="secondTeam">SPARTANS</h3>
                            </div>
                            <div class="col-auto">
                                <img src="img/purple.png" alt="" class="img-fluid purpleImg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="timeFixture text-center">
                <span>September 25, 2015</span>
            </div>
        </div> --}}
    </div>
</section>

@endsection
