@extends('front.layout.app')
@section('content')
    <style>
        .hide-table {
            display: none;
        }
    </style>
    <section class="standing-content-info" id="standingSection">

        <div class="container paddings-mini">

            <h1 class="text-center">Standings</h1>
            <br><br>
            <div class="row">
                <div class="container text-center mb-5">
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
                </div>
                {{-- <div class="mb-5  col-md-3 d-flex justify-content-between align-items-center">
                    <div>
                        <p>Season</p>
                    </div>
                    <div>
                        <select name="" id="" class="form-control" style="width:180px">
                            <option value="">2021</option>
                            <option value="">2022</option>
                            <option value="">2023</option>

                        </select>
                    </div>
                </div> --}}
                <div class="col-lg-12">

                    @if ($roster_data)
                        @foreach ($roster_data as $regions => $players)
                            <table
                                class="mb-5 table roaster-table table-striped table-responsive table-hover result-point table-{{ $regions }} @if (empty($players)) hide-table @endif">
                                <thead class="point-table-head">
                                    <tr>
                                        <th class="text-left">No</th>
                                        <th class="text-left">Region : {{ $regions }}</th>
                                        <th class="text-center"> Win</th>
                                        <th class="text-center">Loss</th>

                                        <th class="text-center">PTS</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center table-data tbody-{{ $regions }}">
                                    @php
                                        $count = '';
                                    @endphp

                                    @if (!empty($players))
                                        @foreach ($players as $i => $value)
                                            <tr>
                                                <td class="text-left number">{{ ++$count }} </td>
                                                <td class="text-left">
                                                    <img src="{{ asset('storage/images/team_logo/' . $value['team_logo']) }}"
                                                        alt="Colombia"><span>{{ $value['user_name'] ?? '' }}</span>
                                                </td>
                                                <td>{{ $value['user_points']['win'] ?? '' }}</td>
                                                <td>{{ $value['user_points']['loss'] ?? '' }}</td>
                                                <td>{{ $value['user_points']['win'] ?? '' }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>No DAta</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>


                        @endforeach
                    @endif


                    <section id="pageNotFound" class="no_data_found" @if ($roster_data == 0) style="display: block;" @else  style="display: none;"  @endif>
                        <div class="container">
                            <div class="row justify-content-center text-center">
                                <div class="col-auto">
                                    <div class="notFoundImg">
                                        <img src="{{asset('front/img/soccerFootball.png')}}" alt="">
                                    </div>
                                    <h3>No Data Found</h3>

                                    <a href="{{ route('home') }}" class="btn btn-primary">Go to Home</a>
                                </div>
                            </div>
                        </div>
                    </section>
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
                beforeSend: function() {
                    $('.tbody-East').html('');
                    $('.tbody-West').html('');
                    $('.tbody-North').html('');
                    $('.tbody-South').html('');
                    $('.tbody-Overseas').html('');
                    $('.tbody-Mid-west').html('');

                },
                data: {
                    letters: letter,
                    path: path,
                },
                success: function(data) {
                    // console.log(data)
                    $(".loader").addClass('d-none');
                    $(".roaster-table").removeClass('d-none');
                    if (data.roster_data != 'error') {
                        $('.no_data_found').css('display','none');
                        // alert(data);

                        let entries = Object.entries(data.roster_data)





                        let count = 1;
                        let east = '';
                        let west = '';
                        let north = '';
                        let south = '';
                        let midwest = '';
                        let overseas = '';
                        let noData = '';

                        entries.map(([key, val] = entry) => {
                            if ( typeof val === 'object' && !Array.isArray(val) && val !== null) {
                               let data =  Object.values(val);
                            }else{
                                let data = val;
                            }

                            console.log(data);



                            //   val.forEach(element => {
                            //     console.log(element);

                            //     //     console.log('fgjfjfgfg',element);

                            //     // let trHTML = ''
                            //     // let log_image =
                            //     //     "{{ asset('storage/images/team_logo/') }}" + "/" +
                            //     //     element.logo;
                            //     // trHTML += '<tr>';
                            //     // trHTML += '<td class="text-left number">' + count +
                            //     //     '</td>';
                            //     // trHTML += '<td class="text-left">' + '<img src="' +
                            //     //     log_image + '" alt="" class="img-fluid">' + element
                            //     //     .name + '</td>';
                            //     // trHTML += '<td>' + element.win + '</td>';
                            //     // trHTML += '<td>' + element.loss + '</td>';
                            //     // trHTML += '<td>' + element.points + '</td></tr>';

                            //     // switch (element.region) {
                            //     //     case 'North':
                            //     //         north += trHTML;
                            //     //         break;

                            //     //     case 'East':
                            //     //         east += trHTML;
                            //     //         console.log(east);
                            //     //         break;


                            //     //     case 'South':
                            //     //         south += trHTML;
                            //     //         break;

                            //     //     case 'West':
                            //     //         west += trHTML;
                            //     //         break;

                            //     //     case 'Mid-West':
                            //     //         midwest += trHTML;
                            //     //         break;

                            //     //     case 'Overseas':
                            //     //         overseas += trHTML;
                            //     //         break;

                            //     //     default:
                            //     //         noData += '';


                            //     // }
                            //     // count++;



                            // });


                        });



                        if (east != '') {

                            $('.tbody-East').html(east);
                            $('.table-East').removeClass('hide-table');

                        } else {
                            $('.table-East').addClass('hide-table');


                        }



                        if (west != '') {
                            $('.tbody-West').html(west);
                            $('.table-West').removeClass('hide-table');

                        } else {
                            $('.table-West').addClass('hide-table');
                        }

                        if (north != '') {
                            $('.tbody-North').html(north);
                            $('.table-North').removeClass('hide-table');

                        } else {
                            $('.table-North').addClass('hide-table');
                        }

                        if (south != '') {
                            $('.tbody-South').html(south);
                            $('.table-South').removeClass('hide-table');

                        } else {
                            $('.table-South').addClass('hide-table');
                        }

                        if (midwest != '') {
                            $('.tbody-Midwest').html(midwest);
                            $('.table-Midwest').removeClass('hide-table');

                        } else {
                            $('.table-Midwest').addClass('hide-table');
                        }

                        if (overseas != '') {
                            $('.tbody-Overseas').html(overseas);
                            $('.table-Overseas').removeClass('hide-table');

                        } else {
                            $('.table-Overseas').addClass('hide-table');
                        }

                    }else{
                        $('.table-East').addClass('hide-table');
$('.table-West').addClass('hide-table');
$('.table-North').addClass('hide-table');
$('.table-South').addClass('hide-table');
$('.table-Midwest').addClass('hide-table');
$('.table-Overseas').addClass('hide-table');

$('.no_data_found').css('display','block');
                    }
                }
            });
        });
    </script>
@endsection
