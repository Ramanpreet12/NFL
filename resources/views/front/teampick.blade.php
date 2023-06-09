@extends('front.layout.app')
@section('content')
    <section id="nextmatchBoard"
        style="background-image:url({{ asset('front/img/football-2-bg.jpg') }});color:{{ $colorSection['leaderboard']['text_color'] }};">
        <div class="container-fluid">
            <div class="row">

                    <div class="leaderBoard d-none">
                        <div class="loader">
                            <img height="100px" width="100px" src="{{ asset('front/img/orange_circles.gif') }}"
                                alt="loader">
                        </div>
                    </div>

                @include('front.layout.sidebar')
                <div class="col-sm-8 col-md-9">
                    <h2 class="mb-3 text-center" style="color:{{ $colorSection['leaderboard']['header_color'] }};">
                        Pick The Team
                    </h2>

                    <div class="headerMenu row">
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
                    <div class="col">
                        <h5 class="seasonFixed" style="color:#fff" id="">Season: {{ $c_season->season_name ?? '' }}
                        </h5>
                    </div>
                    <div class="col">
                        {{-- @if (Request::url() == config('app.url') . '/fixtures/weeks') --}}
                            @foreach ($fixtures as $week => $data)
                                <h5 style="color:#fff" id="set_week" class="seasonFixed selectWeekPart">Week :
                                    {{ $week }}</h5>
                            @endforeach
                        {{-- @endif --}}
                    </div>
                    <div class="fixtureForms col">
                        <form action="{{ url('teams') }}" method="get" class="seasonFixed formSpacing">
                            <div class="inner_form">
                                @csrf
                                <label for=""
                                    style="color:#fff; margin-right:10px; font-weight:800; font-size: 20px; font-family: 'Oxanium', 'cursive';">Seasons:
                                </label>
                                <select class="form-control" name="seasons" id="seasons">
                                    {{-- <option value="">{{$c_season->season_name ?? ''}}</option> --}}
                                    {{-- <input type="text" name="" value=""> --}}
                                    {{-- <option value="">select </option> --}}
                                    @foreach ($get_all_seasons as $season)
                                        <option value="{{ $season->id ?? ''}}"
                                            {{ $c_season->id == $season->id ? 'selected' : '' }}>
                                            {{ $season->season_name }}</option>
                                    @endforeach
                                    <i class="fa-solid fa-angle-down"></i>
                                </select>
                            </div>
                        </form>
                    </div>
                    {{-- for weeks --}}
                    <div class=" col">
                        <form action="{{ url('teams') }}" method="get" class="seasonFixed ">
                            <div class="inner_form">
                                @csrf
                                <input type="hidden" value="{{ $c_season->id ?? '' }}" name="season_id">
                                <label for=""
                                    style="color:#fff; margin-right:10px; font-weight:800; font-size: 20px; font-family: 'Oxanium', 'cursive';">Weeks:
                                </label>
                                <select class="form-control" name="weeks" id="weeks">
                                    @for ($i = 1; $i <= 18; $i++)
                                        <option value="{{ $i }}"
                                            @php if( request()->query('weeks') == $i){ echo "selected"; } @endphp>Week
                                            {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </form>
                    </div>
                    </div>



                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-dark table-striped text-center  tableBoard">
                                    <thead>
                                        <tr class="table-primary">
                                        <th scope="col" colspan="3">Match</th>
                                    <th scope="col" class="matchFColDate">Date</th>
                                    <th scope="col" class="matchFColTime">Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fixtures as $week => $weakData)
                                            <tr>
                                                <td style="color: #db9a29;font-weight:bold;" colspan="3">Week : {{ $week }}</td>
                                                <td class="matchFColDate"></td>
                                                <td class="matchFColTime"></td>
                                            </tr>
                                            @foreach ($weakData as $weaks => $team)
                                                @if ($week == $team->week)
                                                    <tr>
                                                        <td>
                                                                    <img src="{{ asset('storage/images/team_logo/' . $team->first_team_id->logo) }}"
                                                                        alt="" class="img-fluid">

                                                                    <div style="">
                                                                        {{ $team->first_team_id->name }}
                                                                    </div>

                                                                    @if (\Carbon\Carbon::now() > $team->season->ending  )
                                                                  {{""}}

                                                                    @else
                                                                    <button data-bs-toggle="modal" data-bs-target="#selectTeam"
                                                                    style="background:none;  border:none; color:#212529"
                                                                    class="btn btn-primary my-4 team_name" fixture_id={{ $team->id }}
                                                                    team_id={{ $team->first_team_id->id }}
                                                                    season_id={{ $team->season_id }}
                                                                    week={{ $team->week }}
                                                                    teamName={{ $team->first_team_id->name }}
                                                                    fixture_date={{ $team->date }}
                                                                    fixture_time={{ \Carbon\Carbon::createFromFormat('H:i:s', $team->time)->format('H:i') }}{{ $team->time_zone }}>

                                                                    Pick Team
                                                                </button>
                                                                @endif
                                                                    </td>
                                                                    <td>
                                                                        <div class="versis"> <h5>VS</h5> </div>

                                                                        <div class="d-md-none">
    <span class="matchFixtureDate" data-title="Date"> {{ \Carbon\Carbon::createFromFormat('Y-m-d', $team->date)->format('M d , Y') }}</span>
    <span class="matchFixtureTime"  data-title="Time">{{ \Carbon\Carbon::createFromFormat('H:i:s', $team->time)->format('H:i') }}{{ $team->time_zone }}</span>
                                                 </div>
                                                                </td>
                                                                <td>
                                                                    <img src="{{ asset('storage/images/team_logo/' . $team->second_team_id->logo) }}"
                                                                        alt="" class="img-fluid">

                                                                    <div style="">
                                                                        {{ $team->second_team_id->name }}
                                                                    </div>
                                                                    @if (\Carbon\Carbon::now() > $team->season->ending  )
                                                                  {{""}}

                                                                    @else
                                                                    <button data-bs-toggle="modal" data-bs-target="#selectTeam"
                                                                    class="btn btn-primary my-4 team_name"
                                                                    style="background:none;  border:none; color:#212529"
                                                                    fixture_id={{ $team->id }}
                                                                    team_id={{ $team->second_team_id->id }}
                                                                    season_id={{ $team->season_id }}
                                                                    week={{ $team->week }}
                                                                    teamName={{ $team->second_team_id->name }}
                                                                    fixture_date={{ $team->date }}
                                                                    fixture_time={{ \Carbon\Carbon::createFromFormat('H:i:s', $team->time)->format('H:i') }}{{ $team->time_zone }}>

                                                                    Pick Team
                                                                </button>
                                                                @endif
                                                                </td>
                                                        </td>

                                                        <td class="matchFColDate">  <span class="matchFixtureDate">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $team->date)->format('M d , Y') }}</span> </td>
                                                        <td class="matchFColTime"><span class="matchFixtureTime">{{ \Carbon\Carbon::createFromFormat('H:i:s', $team->time)->format('H:i') }}{{ $team->time_zone }}</span> </td>
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
            <div class="modal-body" id="expire_season_msg">fgdf
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
                    url: '/dashboard_team_pick',
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
                $('#SeasonExpireModal #expire_season_msg').html('<p style="color:red"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2"> <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"> </polygon> <line x1="12" y1="8" x2="12" y2="12"></line> <line x1="12" y1="16" x2="12.01" y2="16"></line>  </svg> <span style="color:red" >Season has been expired </span></p>' );
            });
        });
    </script>
@endsection
