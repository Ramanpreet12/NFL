@extends('front.layout.app')
@section('content')
    <section id="matchFixture">
        <div class="container mt-4">
            <div class="row">

                <div class="col-12">
                    <h2>Match Fixture</h2>

                    <div class="headerMenu row">
                        <div class="col">
                            <h5 class="seasonFixed" style="color:#444" id="">Season: {{ $c_season->season_name ?? '' }}
                            </h5>
                        </div>
                        <div class="col">
                            {{-- @if (Request::url() == config('app.url') . '/fixtures/weeks') --}}
                                @foreach ($fixtures as $week => $data)
                                    <h5 style="color:#444" id="set_week" class="seasonFixed selectWeekPart">Week :
                                        {{ $week }}</h5>
                                @endforeach
                            {{-- @endif --}}
                        </div>
                        <div class="fixtureForms col">
                            <form action="{{ url('fixtures') }}" method="get" class="seasonFixed formSpacing">
                                <div class="inner_form">
                                    @csrf
                                    <label for=""
                                        style="color:#444; margin-right:10px; font-weight:800; font-size: 20px; font-family: 'Oxanium', 'cursive';">Seasons:
                                    </label>
                                    @if ($get_all_seasons->isNotEmpty())
                                    <select class="form-control" name="seasons" id="seasons">
                                        {{-- <option value="">{{$c_season->season_name ?? ''}}</option> --}}
                                        {{-- <input type="text" name="" value=""> --}}
                                        {{-- <option value="">select </option> --}}

                                        @foreach ($get_all_seasons as $season)
                                        <option value="{{ $season->id ?? '' }}"
                                            {{ $c_season->id == $season->id ? 'selected' : '' }}>
                                            {{ $season->season_name }}</option>
                                        @endforeach

                                        <i class="fa-solid fa-angle-down"></i>
                                    </select>
                                    @endif
                                </div>
                            </form>
                        </div>
                        {{-- for weeks --}}
                        <div class=" col">
                            <form action="{{ url('fixtures') }}" method="get" class="seasonFixed ">
                                <div class="inner_form">
                                    @csrf
                                    <input type="hidden" value="{{ $c_season->id ?? '' }}" name="season_id">
                                    <label for=""
                                        style="color:#444; margin-right:10px; font-weight:800; font-size: 20px; font-family: 'Oxanium', 'cursive';">Weeks:
                                    </label>
                                    @if ($get_all_seasons->isNotEmpty())
                                    <select class="form-control" name="weeks" id="weeks">
                                        @for ($i = 1; $i <= 18; $i++)
                                            <option value="{{ $i }}"
                                                @php if( request()->query('weeks') == $i){ echo "selected"; } @endphp>Week
                                                {{ $i }}</option>
                                        @endfor
                                    </select>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
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
                        <div class="alert alert-danger show flex items-center mb-2 alert_messages text-center"
                            role="alert" style="display:none;" id="login_msg_div">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2">
                                <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2">
                                </polygon>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                            <span>Login first to select the team . </span>
                            <a href="{{ route('login') }}">Click here to login</a>
                        </div>
                        @if ($fixtures->isNotEmpty())
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
                                                                @if (\Carbon\Carbon::now() > $team->season->ending  )
                                                                <button data-bs-toggle="modal" data-bs-target="#SeasonExpireModal"
                                                                    style="background:none;  border:none; color:#212529"
                                                                    class="expire_season_msg" >

                                                                    <img src="{{ asset('storage/images/team_logo/' . $team->first_team_id->logo) }}"
                                                                        alt="" class="img-fluid">

                                                                    <div style="min-width:200px">
                                                                        {{ $team->first_team_id->name }}
                                                                    </div>
                                                                </button>
                                                                @else

                                                                <button data-bs-toggle="modal" data-bs-target="#selectTeam"
                                                                    style="background:none;  border:none; color:#212529"
                                                                    class="team_name" fixture_id={{ $team->id }}
                                                                    team_id={{ $team->first_team_id->id }}
                                                                    season_id={{ $team->season_id }}
                                                                    week={{ $team->week }}
                                                                    teamName={{ $team->first_team_id->name }}
                                                                    fixture_date={{ $team->date }}
                                                                    fixture_time={{ \Carbon\Carbon::createFromFormat('H:i:s', $team->time)->format('H:i') }}{{ $team->time_zone }}>
                                                                    <img src="{{ asset('storage/images/team_logo/' . $team->first_team_id->logo) }}"
                                                                        alt="" class="img-fluid">

                                                                    <div style="min-width:200px">
                                                                        {{ $team->first_team_id->name }}
                                                                    </div>
                                                                </button>
                                                                @endif
                                                            </div>
                                                            <div class="versis">
                                                                <h5>VS</h5>

                                                            </div>
                                                            <div class="teamOne">
                                                                @if (\Carbon\Carbon::now() > $team->season->ending  )
                                                                <button data-bs-toggle="modal" data-bs-target="#SeasonExpireModal"
                                                                    style="background:none;  border:none; color:#212529"
                                                                    class="expire_season_msg" >

                                                                    <img src="{{ asset('storage/images/team_logo/' . $team->second_team_id->logo) }}"
                                                                    alt="" class="img-fluid">

                                                                <div style="min-width:200px">
                                                                    {{ $team->second_team_id->name }}
                                                                </div>
                                                                </button>
                                                                @else
                                                                <button data-bs-toggle="modal" data-bs-target="#selectTeam"
                                                                    class="team_name"
                                                                    style="background:none;  border:none; color:#212529"
                                                                    fixture_id={{ $team->id }}
                                                                    team_id={{ $team->second_team_id->id }}
                                                                    season_id={{ $team->season_id }}
                                                                    week={{ $team->week }}
                                                                    teamName={{ $team->second_team_id->name }}
                                                                    fixture_date={{ $team->date }}
                                                                    fixture_time={{ \Carbon\Carbon::createFromFormat('H:i:s', $team->time)->format('H:i') }}{{ $team->time_zone }}>
                                                                    <img src="{{ asset('storage/images/team_logo/' . $team->second_team_id->logo) }}"
                                                                        alt="" class="img-fluid">

                                                                    <div style="min-width:200px">
                                                                        {{ $team->second_team_id->name }}
                                                                    </div>
                                                                </button>
                                                                @endif
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
                        @else
                            <hr style="color:#888;">
                            <section id="pageNotFound" class="no_data_found">

                                <div class="container">
                                    <div class="row justify-content-center text-center">
                                        <div class="col-auto">
                                            <div class="notFoundImg">
                                                {{-- <img src="https://nfl.kloudexpert.com/front/img/soccerFootball.png" alt=""> --}}
                                                <img src="{{ asset('front/img/soccerFootball.png') }}" alt="">
                                            </div>
                                            <h3>No Data Found</h3>

                                            <a href="{{ route('home') }}" class="btn btn-primary">Go to Home</a>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

          <!-- Modal -->
<div class="modal fade" id="selectTeam" tabindex="-1" aria-labelledby="selectTeamLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="teamSelectedMsg">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary pr-4" data-bs-dismiss="modal">Close</button>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="SeasonExpireModal" tabindex="-1" aria-labelledby="selectTeamLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="expire_season_msg">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary pr-4" data-bs-dismiss="modal">Close</button>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>


@endsection



@section('script')
    <script type="text/javascript">
        jQuery(function() {
            jQuery('#seasons').change(function() {
                this.form.submit();
            });

            jQuery('#weeks').change(function() {
                this.form.submit();
            });

            $('.team_name').click(function() {
                let season_id = $(this).attr('season_id');
                let fixture_id = $(this).attr('fixture_id');
                let team_id = $(this).attr('team_id');
                let teamName = $(this).attr('teamName');
                let fixture_date = $(this).attr('fixture_date');
                let fixture_time = $(this).attr('fixture_time');
                let week = $(this).attr('week');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    // url: '/check_user',
                    url: '/fixture_team_pick',
                    data: {
                        season_id: season_id,
                        fixture_id: fixture_id,
                        team_id: team_id,
                        week: week
                    },
                    success: function(resp) {
                        if (resp.message == 'login') {
                            $('#selectTeam #teamSelectedMsg').html(
                                '<p style="color:red"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2"> <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"> </polygon> <line x1="12" y1="8" x2="12" y2="12"></line> <line x1="12" y1="16" x2="12.01" y2="16"></line>  </svg> <span> Please <a href="{{ route('login') }}" style="color:red">login</a> first to continue . </span></p>'
                                );
                        }
                        if (resp.message == 'subscribe') {
                            $('#login_msg_div').hide();
                            $('#selectTeam #teamSelectedMsg').html(
                                '<p style="color:red"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2"> <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"> </polygon> <line x1="12" y1="8" x2="12" y2="12"></line> <line x1="12" y1="16" x2="12.01" y2="16"></line>  </svg> <span> Please <a href="{{ route('payment') }}" style="color:red">subscribe</a> to pick the teams . It will cost you $100 . </span></p>'
                                );
                        }
                        if (resp.message == 'update') {
                            $('#selectTeam #teamSelectedMsg').html(
                                'You have selected <span style="color:#06083B">' +
                                teamName +
                                '</span> for the week  <span style="color:#06083B"> ' +
                                week + ' </span> on <span style="color:#06083B">' +
                                fixture_date + '</span> at <span style="color:#06083B">' +
                                fixture_time + '</span>');
                        }
                        if (resp.message == 'added') {
                            $('#selectTeam #teamSelectedMsg').html(
                                'You have selected <span style="color:#06083B;">' +
                                teamName +
                                '</span> for the week <span style="color:#06083B"> ' +
                                week + ' </span> on <span style="color:#06083B">' +
                                fixture_date + '</span> at <span style="color:#06083B">' +
                                fixture_time + '</span>');
                        }
                        if (resp.message == 'Time_id_over') {
                            $('#selectTeam #teamSelectedMsg').html(
                                '<p style="color:red"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2"> <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"> </polygon> <line x1="12" y1="8" x2="12" y2="12"></line> <line x1="12" y1="16" x2="12.01" y2="16"></line>  </svg> <span> Your time is over to pick the team  as you can pick the team till Thursaday 12:00 am . You will receive loss for this week  </span></p>'
                                );
                        }

                    },
                })
            });

            $('.expire_season_msg').click(function(){
                $('#SeasonExpireModal #expire_season_msg').html(
                                '<p style="color:red"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2"> <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"> </polygon> <line x1="12" y1="8" x2="12" y2="12"></line> <line x1="12" y1="16" x2="12.01" y2="16"></line>  </svg> <span style="color:red" >Season has been expired </span></p>'
                                );
            });

        });
    </script>
@endsection
<style>
    .inner_form {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .headerMenu {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
</style>
