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

                    <div class="tablePickTeam">
                        <div class="table-responsive" id="rosterTable">

                            <table class="table table-dark table-striped  tableBoard" id="roaster-table">

                                <thead>
                                    <tr class="table-primary">
                                        {{-- <th scope="col"> </th> --}}
                                        <th scope="col" colspan="2" class="">Teams</th>
                                        <th scope="col" class="text-center">W</th>
                                        <th scope="col" class="text-center">L</th>
                                        <th scope="col" class="text-center">PTS</th>
                                        <th scope="col" class="text-center"> </th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">

                                    @foreach ($get_teams as $team)
                                        <tr>
                                            {{-- <th scope="row" rowspan="3">North</th> --}}
                                            {{-- <td></td> --}}
                                            <td class="teamLogo">
                                                <img src="{{ asset('storage/images/team_logo/' . $team->logo) }}"
                                                    alt="" class="img-fluid">
                                            </td>
                                            <td class="teamName">
                                                <span>{{ $team->name }}</span>
                                            </td>
                                            <td>{{ $team->win }}</td>
                                            <td>{{ $team->loss }}</td>
                                            <td>{{ $team->pts }}</td>

                                            <td>

                                                {{-- <form action="{{ route('pickTeam') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" value="{{ $team->name }}" name="team_name">
                                                    <button type="submit" name="submit" class="btn">Pick</button>
                                                </form> --}}

                                                <button type="submit" name="submit"
                                                    class="btn pickTeam c-{{ $team->id }}" team-id={{ $team->id }}
                                                    data={{ Auth::user()->id }}>Pick</button>
                                            </td>
                                        </tr>
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
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modal Header</h4>
                    </div>
                    <div class="modal-body">
                        <p>Some text in the modal.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>


        //pick team


        $('.pickTeam').click(function() {
            //first check user is subscribed or not
            let user_id = $(this).attr('data');
            let team_id = $(this).attr('team-id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: 'post',
                url: '/pickTeam',
                data: {
                    id: user_id
                },
                success: function(response) {
                    if (response.status == false) {
                        swal({
                                title: `Subscribe first to pick the team`,
                                text: "",
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                            })
                            .then((willDelete) => {
                                if (willDelete) {
                                    window.location.href="{{route('payment')}}";
                                }
                            });
                    } else {
                        $(".c-" + team_id).text('Team Picked').css('color', 'green');

                    }
                }
            });
        });
    </script>
@endsection
