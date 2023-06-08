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
                        {{-- <div class="col-12">
                            <div class="tablePickTeam">
                                <div class="table-responsive" id="rosterTable">

                                    <table class="table table-dark table-striped  tableBoard" id="roaster-table">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col" colspan="2">Teams</th>
                                                <th></th>
                                                <th></th>
                                                <th>Week</th>
                                                <th scope="col">Points</th>

                                            </tr>
                                        </thead>
                                        <tbody class="table-group-divider">

                                            @if ($user)
                                            @foreach ($user as $item)
                                            <tr>
                                                <td class="teamLogo">
                                                    <img src="{{ asset('storage/images/team_logo/' . $item->logo) }}"
                                                        alt="" class="img-fluid">
                                                </td>
                                                <td class="teamName">
                                                    <span>{{ ucwords($item->name) }}</span>
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ $item->week }}</td>
                                                <td>{{ $item->points }}</td>
                                            </tr>
                                            @endforeach

                                            @else
                                                <tr>
                                                    <td colspan="5">
                                                        <span>No Data Found</span>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-12">
                            <table class="table table-dark table-striped  tableBoard" id="roaster-table">
                                <thead>
                                    <tr class="table-primary">
                                        <th scope="col">Sno.</th>
                                        <th scope="col">Intended Id</th>
                                        <th scope="col">Season</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Payed At</th>
                                        <th scope="col">Time Before</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">

                                    @if ($payment)
                                        @foreach ($payment as $key => $item)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $item->payment }}</td>
                                                <td>{{ $item->season->season_name }}</td>
                                                <td>{{ $item->status }}</td>
                                                <td class="text-center">{{ \Carbon\Carbon::parse( $item->created_at)->format('j F, Y') }}</td>
                                                <td>{{ $item->created_date }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4">No Payment is Found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {!! $payment->links() !!}
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
        $('.alphabets').on('click', function() {
            $(".loader").removeClass('d-none');
            let letter = $(this).text();
            let getURL = window.location.pathname;
            let path = getURL.split('/')[2];
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var htmlOutput = '';
            $.ajax({
                type: 'POST',
                url: '/alphabets',
                data: {
                    letters: letter,
                    path: path,
                },
                success: function(data) {
                    // console.log(data)
                    $(".loader").addClass('d-none');
                    $("#roaster-table").removeClass('d-none');

                    if (data.roster_data.length != 0) {
                        JSON.stringify(data)
                        let entries = Object.entries(data.roster_data)
                        let count = 1;
                        trHTML = '';
                        entries.map(([key, val] = entry) => {
                            val.forEach(element => {
                                console.log(element.id)
                                let log_image =
                                    "{{ asset('storage/images/team_logo/') }}" + "/" +
                                    element.logo;
                                trHTML += '<tr><td>' + key + '</td>';
                                trHTML += '<td>' + count + '</td>';
                                trHTML += '<td class="teamLogo">' + '<img src=' +
                                    log_image + ' alt="" class="img-fluid">' + '</td>';
                                trHTML += '<td  class="teamName">' + element.name +
                                    '</td>';
                                trHTML += '<td>' + element.win + '</td>';
                                trHTML += '<td>' + element.loss + '</td>';
                                trHTML += '<td>' + element.pts + '</td></tr>';
                                count++;
                            });
                        });
                        $('#table-data').html(trHTML);
                    } else {
                        $('#table-data').html('<tr><td colspan="7"><h1>No Data Found</h1></tr></td>');
                    }
                }
            });
        });
    </script>
@endsection
