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

        .btn.pickTeam {
            line-height: 20px;
            display: flex;
            align-items: center;
            margin-left: auto;
        }

        .btn.pickTeam .bi-check {
            font-size: 28px;
            color: rgb(0, 128, 55);
            line-height: 27px;
            display: inline-flex;

        }

        .btn.pickTeam .bi-check[class*=" bi-"]::before {
            line-height: 20px;
        }

        #nextmatchBoard .table-dark tr td.tdTeamBtnCheck {
            text-align: right;
            padding-right: 30px;
            width: 170px;
        }

        .week {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .week .week-data {
            padding: 3px 10px;
            background-color: #fff;
            border-radius: 3px;
            margin: 0 5px;
            color: #111;
        }
        .week .week-data.activeWeek {
            background-color: #db9a29;
        }

        @media (min-width: 768px) {
            .tablePickTeam {
                padding-right: 30px;
            }
        }
    </style>

    <section id="nextmatchBoard"
        style="background-image:url({{ asset('front/img/football-2-bg.jpg') }});color:{{ $colorSection['leaderboard']['text_color'] }};">
        <div class="container-fluid text-center">
            <div class="row">

                <div class="col-sm-12">
                    <h2 style="color:{{ $colorSection['leaderboard']['header_color'] }};">
                        Pick a Team
                    </h2>

                    <div class="leaderBoard">

                        <br>

                        <div class="loader d-none">
                            <img height="100px" width="100px" src="{{ asset('front/img/orange_circles.gif') }}"
                                alt="loader">
                        </div>
                    </div>
                </div>

                {{-- <div class="col-sm-4 col-md-3">
                    <div class="aSidebar">
                        <div class="aSidebarCard">
                            <h4><span>SideBar</span></h4>
                            <ul class="sidebarLink">
                                <li><a href="#">Dashboard</a></li>
                                <li><a href="#">User profile</a></li>
                                <li><a href="#">Dashboard</a></li>
                                <li><a href="#">Dashboard</a></li>
                            </ul>


                        </div>
                    </div>

                </div> --}}
                @include('front.layout.sidebar')
                <div class="col-sm-10 col-md-9">
                    @if (Session::has('success'))
                        <span class="alert alert-success">{{ Session::get('success') }}</span>
                    @endif
                    <div class="tablePickTeam">
                        {{-- <div class="table-responsive" id="rosterTable">

                            <table class="table table-dark table-striped  tableBoard" id="roaster-table">

                                <thead>
                                    <tr class="table-primary">
                                        <th scope="col"> </th>
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col" colspan="2" class="">Teams</th>
                                        <th scope="col" class="text-center">W</th>
                                        <th scope="col" class="text-center">L</th>
                                        <th scope="col" class="text-center">PTS</th>
                                        <th scope="col" class="text-center teamBtnCheck"> </th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">

                                    @foreach ($fixture as $fix)
                                        <tr>

                                            <td class="teamLogo">
                                                <img src="{{ asset('storage/images/team_logo/' . $fix->first_team_id->logo) }}"
                                                    alt="" class="img-fluid">
                                            </td>
                                            <td class="teamName">
                                                <span>{{ $fix->first_team_id->name }}</span>
                                            </td>
                                            <td>{{ $team->win }}</td>
                                            <td>{{ $fix->first_team_id->name}}</td>
                                             <td>{{ $team->pts }}</td>

                                             <td class="tdTeamBtnCheck">
                                                <button type="submit" name="submit"
                                                    class="btn pickTeam c-{{ $team->id }}"
                                                    season-id="{{ $fixture->season_id }}" week="{{ $fixture->week }}"
                                                    team-id={{ $team->id }} data={{ Auth::user()->id }}>Pick
                                                </button>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div> --}}
                        <div class="table-responsive" bis_skin_checked="1" id="rosterTable">
                            <table class="table table-dark table-striped  tableBoard" id="roaster-table">
                                <thead>
                                    <tr class="table-primary">
                                        <th scope="col">Match</th>
                                        <th scope="col">Week</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fixture as $fix)
                                        <tr>
                                            <td>
                                                <div class="fixureMatch d-flex align-items-center justify-content-center"
                                                    bis_skin_checked="1">
                                                    <div class="versis check" bis_skin_checked="1">
                                                        <input type="checkbox" name="" id="">

                                                    </div>
                                                    <div class="teamOne" bis_skin_checked="1">
                                                        <img src="{{ asset('storage/images/team_logo/' . $fix->first_team_id->logo) }}"
                                                            alt="" class="img-fluid">

                                                        <div style="min-width:200px" bis_skin_checked="1">
                                                            {{ ucwords($fix->first_team_id->name) }}</div>
                                                    </div>
                                                    <div class="versis check" bis_skin_checked="1">
                                                        <input type="checkbox" name="" id="">

                                                    </div>
                                                    <div class="teamOne" bis_skin_checked="1">
                                                        <img src="{{ asset('storage/images/team_logo/' . $fix->second_team_id->logo) }}"
                                                            alt="" class="img-fluid">

                                                        <div style="min-width:200px" bis_skin_checked="1">
                                                            {{ ucwords($fix->second_team_id->name) }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $fix->week }}</td>
                                            <td>{{ date('j F, Y', strtotime($fix->date)) }}</td>
                                            <td>{{ date('H : i s', strtotime($fix->time)) }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>
                            <div class="week">
                                @foreach ($fixture as $k=>$week)
                                    <div class="week-data @if($k==0)activeWeek @endif" data="{{$k+1}}">{{ $k+1 }}</div>
                                @endforeach

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

@section('script')
    <script>
        $('.check input:checkbox').click(function() {
            $('.check input:checkbox').not(this).prop('checked', false);
        })
        $('.pickTeam').click(function() {
            //first check user is subscribed or not
            let user_id = $(this).attr('data');
            let team_id = $(this).attr('team-id');
            let season_id = $(this).attr('season-id');
            let week = $(this).attr('week');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'post',
                url: '/pickTeam',
                data: {
                    id: user_id,
                    season_id: season_id,
                },
                success: function(response) {
                    //console.log(response);
                    if (response.status == false && response.plan == '') {
                        swal({
                                title: `Subscribe first to pick the team`,
                                text: "",
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                            })
                            .then((willDelete) => {
                                if (willDelete) {
                                    window.location.href = "{{ route('payment') }}";
                                }
                            });
                    } else if (response.status == false && response.plan == 'expired') {
                        swal({
                                title: `Your Plan is Expired pay first`,
                                text: "",
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                            })
                            .then((willDelete) => {
                                if (willDelete) {
                                    window.location.href = "{{ route('payment') }}";
                                }
                            });
                    } else {
                        $.ajax({
                            method: 'post',
                            url: '/selectTeam',
                            data: {
                                user_id: user_id,
                                team_id: team_id,
                                season_id: season_id,
                                week: week
                            },
                            success: function(response) {
                                console.log(response);
                                if (response.status == 200 && response.select ==
                                    'already') {
                                    swal({
                                        title: `Team is already selected for week ${week}`,
                                        text: "",
                                        icon: "warning",
                                        buttons: true,
                                        dangerMode: true,
                                    })
                                } else if (response.status == 200 && response.select ==
                                    '') {
                                    window.location.href = "{{ route('dashboard') }}";
                                } else {
                                    window.location.href = "{{ route('teams') }}";
                                }
                            }
                        });
                    }
                }
            });
        });
        $('.week-data').click(function() {
            let week = $(this).attr('data');
            $('.week-data').removeClass('activeWeek');
            $(this).addClass('activeWeek');
            $.ajax({
                method: 'get',
                url: '/Allfixtures/' + week,
                success: function(response) {
                    console.log(response);
                }
            });
        });
    </script>
@endsection
