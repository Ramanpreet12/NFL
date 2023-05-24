@extends('front.layout.app')
@section('content')
    <section id="matchFixture">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <h2>Match Fixture</h2>
                        <h5 style="color:#444" id="">Season : {{ $c_season->season_name }} </h5>

                        @if (Request::url() == 'http://localhost:8000/fixtures/weeks')
                            @foreach ($fixtures as $week => $data)
                                <h5 style="color:#444" id="set_week">Week : {{ $week }}</h5>
                            @endforeach
                        @endif

                        <form action="{{ route('fixtures') }}" method="post">
                            @csrf
                            <label for="" style="color:#444">Seasons : </label>
                            <select name="seasons" id="seasons">
                                <option value="">select</option>
                                @foreach ($get_seasons as $season)
                                    <option value="{{ $season->id }}">{{ $season->season_name }}</option>
                                @endforeach

                            </select>
                        </form>
                        {{-- for weeks --}}
                        <form action="{{ route('fixtures/weeks') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $c_season->id }}" name="season_id">
                            <label for="" style="color:#444">Weeks : </label>
                            <select name="weeks" id="weeks">
                                {{-- <option value="">{{$c_season->season_name ?? ''}}</option> --}}
                                <option value="">select</option>
                                <option value="1">Week 1</option>
                                <option value="2">Week 2</option>
                                <option value="3">Week 3</option>
                                <option value="4">Week 4</option>
                                <option value="5">Week 5</option>
                                <option value="6">Week 6</option>
                                <option value="7">Week 7</option>
                                <option value="8">Week 8</option>
                                <option value="9">Week 9</option>
                                <option value="10">Week 10</option>
                                <option value="11">Week 11</option>
                                <option value="12">Week 12</option>
                                <option value="13">Week 13</option>
                                <option value="14">Week 14</option>
                                <option value="15">Week 15</option>
                                <option value="16">Week 16</option>
                                <option value="17">Week 17</option>
                                <option value="18">Week 18</option>


                            </select>
                        </form>
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
                        <div class="alert alert-danger show flex items-center mb-2 alert_messages text-center" role="alert" style="display:none;" id="login_msg_div">
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

                        <div class="alert alert-danger show flex items-center mb-2 alert_messages text-center" role="alert" style="display:none;" id="dashboard_msg_div">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2">
                                <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2">
                                </polygon>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                           <span>Go to <a href="{{ route('dashboard') }}">dashboard</a>  to pick the team  . </span>

                        </div>

                        <div class="alert alert-danger show flex items-center mb-2 alert_messages text-center" role="alert" style="display:none;" id="payment_msg_div">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2">
                                <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2">
                                </polygon>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                           <span>Please <a href="{{ route('payment') }}">subcribe</a> first to continue </span>

                        </div>

                        <div class="alert alert-success show flex items-center mb-2 alert_messages text-center" role="alert" style="display:none;" id="msg_div">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2">
                                <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2">
                                </polygon>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                           <span></span>

                        </div>




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
                                                    {{-- {{dd($team)}} --}}
                                                    <div
                                                        class="fixureMatch d-flex align-items-center justify-content-center">
                                                        <div class="teamOne">

                                                            <button data-bs-toggle="modal" data-bs-target="#selectTeam" style="background:none;  border:none; color:#212529"
                                                            class="team_name" fixture_id = {{$team->id}} team_id = {{$team->first_team_id->id}}
                                                            season_id = {{$team->season_id}} week = {{$team->week}} teamName = {{$team->first_team_id->name}}
                                                            fixture_date = {{ $team->date}} fixture_time = {{ \Carbon\Carbon::createFromFormat('H:i:s', $team->time)->format('H:i') }}{{ $team->time_zone }}>
                                                                <img src="{{ asset('storage/images/team_logo/' . $team->first_team_id->logo) }}"
                                                                    alt="" class="img-fluid">

                                                                <div style="min-width:200px">
                                                                    {{ $team->first_team_id->name }}
                                                                </div>
                                                                {{-- <input type="text" value="{{$team->id}}">
                                                                <input type="text" value="{{$team->id}}"> --}}
                                                            </button>

                                                        </div>
                                                        <div class="versis">
                                                            <h5>VS</h5>

                                                        </div>
                                                        <div class="teamOne hover-zoom">
                                                            <button data-bs-toggle="modal" data-bs-target="#selectTeam"  class="team_name" style="background:none;  border:none; color:#212529"
                                                            fixture_id = {{$team->id}} team_id = {{$team->second_team_id->id}}
                                                            season_id = {{$team->season_id}} week = {{$team->week}} teamName = {{$team->second_team_id->name}}
                                                            fixture_date = {{ $team->date }} fixture_time = {{ \Carbon\Carbon::createFromFormat('H:i:s', $team->time)->format('H:i') }}{{ $team->time_zone }}>
                                                                <img src="{{ asset('storage/images/team_logo/' . $team->second_team_id->logo) }}"
                                                                    alt="" class="img-fluid">

                                                                <div style="min-width:200px">
                                                                    {{ $team->second_team_id->name }}
                                                                </div>

                                                            </button>
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

<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
  </button> --}}

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
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary pr-4" data-bs-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
  </div>

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
                let teamName  = $(this).attr('teamName');
                let fixture_date  = $(this).attr('fixture_date');
                let fixture_time  = $(this).attr('fixture_time');
                let week = $(this).attr('week');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '/check_user',
                    data: {
                        season_id : season_id ,
                        fixture_id : fixture_id ,
                        team_id : team_id ,
                        week : week

                    },
                    success: function(resp) {
                        if (resp.status == false) {
                        //    $('#login_msg_div').show();
                        $('#teamSelectedMsg').html('<p style="color:red"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2"> <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"> </polygon> <line x1="12" y1="8" x2="12" y2="12"></line> <line x1="12" y1="16" x2="12.01" y2="16"></line>  </svg> <span> Please <a href="{{ route('login') }}" style="color:red">login</a> first to continue . </span></p>');


                        }
                        if (resp.message == 'subscribe') {
                            // $('#payment_msg_div').show();
                            $('#login_msg_div').hide();
                            $('#teamSelectedMsg').html('<p style="color:red"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2"> <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"> </polygon> <line x1="12" y1="8" x2="12" y2="12"></line> <line x1="12" y1="16" x2="12.01" y2="16"></line>  </svg> <span> Please <a href="{{ route('payment') }}" style="color:red">subscribe</a> to select the team . It will cost you $100 . </span></p>');


                        }

                        if (resp.message == 'update') {
                            // $('#msg_div').show();
                            $('#teamSelectedMsg').html('You have selected <span style="color:#06083B">' + teamName + '</span> for the fixture on <span style="color:#06083B">' + fixture_date + '</span> at <span style="color:#06083B">' + fixture_time + '</span>');
                            // $('#teamSelectedMsg').html('<p><svg style="color: rgb(0, 255, 0);" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16"> <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" fill="#00ff00"></path> <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" fill="#00ff00"></path> </svg><span>You have selected ' + teamName + ' for the fixture on ' + fixture_date + ' at ' + fixture_time '</span></p>');
                        }

                        if (resp.message == 'added') {
                            // $('#msg_div').show();
                            $('#teamSelectedMsg').html('You have selected <span style="color:#06083B;">' + teamName + '</span> for the fixture on <span style="color:#06083B">' + fixture_date + '</span> at <span style="color:#06083B">' + fixture_time + '</span>');
                        }


                    },
                    // error: function(resp) {
                    //     if(resp.status == true){
                    //         window.location.href = 'http://127.0.0.1:8000/dashboard';
                    //     }
                    // }
                })




            });
        });
    </script>
@endsection
