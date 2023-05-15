@extends('front.layout.app')
@section('content')
<section id="nextmatchBoard"
    style="background-image:url({{ asset('front/img/football-2-bg.jpg') }});color:{{ $colorSection['leaderboard']['text_color'] }};">
    <div class="container text-center">
        <div class="row">

            <div class="col-sm-12">
                <div class="leaderBoard">
                    <h2 style="color:{{ $colorSection['leaderboard']['header_color'] }};">
                        Player's Roster
                    </h2>
                    <br>
                    <h4>
                             <span class="alphabets">A</span> / <span class="alphabets">B</span> /
                             <span class="alphabets">C</span> / <span class="alphabets">D</span> /
                             <span class="alphabets">E</span> / <span class="alphabets">F</span> /
                             <span class="alphabets">G</span> / <span class="alphabets">H</span> /
                             <span class="alphabets">I</span> / <span class="alphabets">J</span> /
                             <span class="alphabets">K</span> / <span class="alphabets">L</span> /
                             <span class="alphabets">M</span> / <span class="alphabets">N</span> /
                             <span class="alphabets">O</span> / <span class="alphabets">P</span> /
                             <span class="alphabets">Q</span> / <span class="alphabets">R</span> /
                             <span class="alphabets">S</span> / <span class="alphabets">T</span> /
                             <span class="alphabets">U</span> / <span class="alphabets">V</span> /
                             <span class="alphabets">W</span> / <span class="alphabets">X</span> /
                             <span class="alphabets">Y</span> / <span class="alphabets">Z</span>
                    </h4>
                    <div class="loader d-none">
                        <img height="100px" width="100px" src="{{ asset('front/img/orange_circles.gif') }}" alt="loader">
                    </div>
                    <div class="tabletwo">

                        <div class="table-responsive" id="rosterTable">
                            <table class="table table-dark table-striped  tableBoard" id="roaster-table">
                                <thead>
                                    <tr class="table-primary">
                                        <th scope="col" class="teamNumber">Region</th>
                                        <th scope="col" class="teamNumber">N.</th>
                                        <th scope="col" colspan="2" class="text-start"> Players</th>
                                        <th scope="col">W</th>
                                        <th scope="col">L</th>
                                        <th scope="col">PTS</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider" id="table-data">
                                    @php
                                    $count = 1;
                                 @endphp
                                    @foreach ($roster_data as $regions => $teams)

                                        @foreach ($teams as $i => $value)
                                            <td>{{$regions}}</td>
                                            <td>{{ $count++ }}</td>
                                            <td class="teamLogo">
                                                <img src="{{ asset('storage/images/team_logo/' . $value->logo) }}"
                                                     alt="" class="img-fluid">
                                            </td>

                                            <td class="teamName">
                                                <span>{{ $value->name ?? '' }}</span>
                                            </td>
                                            <td>{{ $value->win ?? '' }}</td>
                                            <td>{{ $value->loss ?? '' }}</td>
                                            <td>{{ $value->points ?? '' }}</td>
                                        </tr>
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


</section>
@endsection

@section('script')
<script>
    $('.alphabets').on('click',function() {
        $(".loader").removeClass('d-none');
        let letter = $(this).text();
let getURL =window.location.pathname;
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
                path:path,
            },
            success: function(data) {
               // console.log(data)
                $(".loader").addClass('d-none');
                $("#roaster-table").removeClass('d-none');

               if(data.roster_data.length != 0){
                JSON.stringify(data)
                let entries = Object.entries(data.roster_data)
                let count = 1;
                trHTML = '';
                entries.map(([key, val] = entry) => {
                    val.forEach(element => {
                        console.log(element.id)
                        let log_image ="{{ asset('storage/images/team_logo/') }}" + "/" +element.logo;
                        trHTML += '<tr><td>' + key + '</td>';
                        trHTML += '<td>' + count +'</td>';
                        trHTML += '<td class="teamLogo">' + '<img src=' + log_image +' alt="" class="img-fluid">' +'</td>';
                        trHTML +='<td  class="teamName">' + element.name +'</td>';
                        trHTML +='<td>' + element.win + '</td>';
                        trHTML +='<td>' + element.loss +'</td>';
                        trHTML +='<td>' + element.pts + '</td></tr>';
                        count++;
                    });
                });
                $('#table-data').html(trHTML);
               }else{
                $('#table-data').html('<tr><td colspan="7"><h1>No Data Found</h1></tr></td>');
               }
            }
        });
    });
</script>
@endsection
