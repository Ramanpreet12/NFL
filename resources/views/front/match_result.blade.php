@extends('front.layout.app')
@section('content')
    <!-- mainheader -->


        <section id="resultLeaderboard">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>{{$get_match_results_details->page_heading ? $get_match_results_details->page_heading : 'Match Results By Regions'}}</h2>

                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="seasonWeek d-flex">

                            <h5>{{$get_match_results_details->selected_season_heading ? $get_match_results_details->selected_season_heading : 'Selected Season'}} : {{ $season_name }}</h5>
                            <h6>{{$get_match_results_details->total_player_heading ? $get_match_results_details->total_player_heading : 'Total Players'}} : {{$total_players}}</h6>

                            <form action="{{ url('match-result/') }}" method="post" id="matchResultForm">
                                @csrf
                                <div class="inner_form d-flex align-items-center ">

                                    <div> <label for=""
                                            style="color:#444; margin-right:10px; font-weight:600;">{{$get_match_results_details->select_season_heading ? $get_match_results_details->select_season_heading : 'Select Season'}}:
                                        </label></div>

                                    <div> <select class="form-control" name="seasons" id="seasons">
                                            {{-- <option value="">{{$c_season->season_name ?? ''}}</option> --}}
                                            {{-- <input type="text" name="" value=""> --}}
                                            {{-- <option value="">select </option> --}}
                                            @foreach ($get_all_seasons as $season)
                                                <option
                                                    value="{{ $season->id }} "{{ $c_season->id == $season->id ? 'selected' : '' }}>
                                                    {{ $season->season_name }}</option>
                                            @endforeach
                                            <i class="fa-solid fa-angle-down"></i>
                                        </select></div>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                @foreach ($total_win_loss as $key =>  $total_points)
                    <hr>
                    <div class="fixtureContentPart">
                     <h5>{{$get_match_results_details->region_heading ? $get_match_results_details->region_heading : 'Region'}} : {{ $key  }} </h5>

                    <div class="row justify-content-center mb-5">
                        <div class="col-lg-7 col-md-12">
                            <div class="modrenFixture">
                                <div class="fixtureLogo">
                                    <div class="fixtureLogoIntro">
                                        <h3 style="font-size:0.95rem;">{{$get_match_results_details->players_total_win ? $get_match_results_details->players_total_win : 'Players Total WIN'}}</h3>
                                      <span class="scoreMatch">{{ $total_points['win']}}</span>

                                    </div>
                                </div>
                                <div class="fixtureContent">
                                    <span class="contentImg">
                                    <img src="{{ asset('front/img/trophyImg.png') }}" alt="" class="img-fluid">
                                </span>
                                </div>
                                <div class="fixtureLogo fixtureRight">
                                    <div class="fixtureLogoIntro">
                                        <h3  style="font-size:0.95rem;"> {{$get_match_results_details->players_total_loss ? $get_match_results_details->players_total_loss : 'Players Total LOSS'}}</h3>
                                        <span class="scoreMatch">{{ $total_points['loss']}}</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                 </div>
                {{-- @empty
                    <section id="pageNotFound" class="no_data_found">
                        <hr>
                        <div class="container">
                            <div class="row justify-content-center text-center">
                                <div class="col-auto">
                                    <div class="notFoundImg">
                                        <img src="https://nfl.kloudexpert.com/front/img/soccerFootball.png" alt="">
                                        <img src="{{ asset('front/img/soccerFootball.png') }}" alt="" class="img-fluid">
                                    </div>
                                    <h3>No Data Found</h3>

                                    <a href="{{ route('home') }}" class="btn btn-primary">Go to Home</a>
                                </div>
                            </div>
                        </div>
                    </section>--}}
            @endforeach
            </div>


            </div>
        </section>

@endsection
@section('script')
    <script type="text/javascript">
        jQuery(function() {
            jQuery('#seasons').change(function() {
                this.form.submit();

            });
        });
        // $("#matchResultForm").submit(function(e) {
        //     e.preventDefault();
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        //     $.ajax({
        //         type: 'POST',
        //         data: $("#matchResultForm").serialize(),
        //         url: 'match-result',
        //         success: function(data) {
        //             console.log(data);


        //         }
        //     });
        //     return false;
        // });
    </script>
@endsection
