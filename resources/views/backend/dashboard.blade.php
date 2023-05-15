@extends('../layout/' . $layout)

@section('subhead')
    <title>NFL | Dashboard</title>
@endsection

@section('subcontent')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 2xl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: General Report -->
                <div class="col-span-12 mt-8">
                    {{-- @if (session('message_success'))
                    <div class="alert alert-success-soft show flex items-center mb-2 message_success_alert" role="alert">
                        <i data-feather="\check-square\" class="w-4 h-4 mr-2\"></i> {{session('message_success')}}
                    </div>
                    @endif --}}

                    @if (session()->has('message_success'))
                    <div class="alert alert-success show flex items-center mb-2 alert_messages" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check2-circle"
                            viewBox="0 0 16 16">
                            <path
                                d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                            <path
                                d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                        </svg>
                        &nbsp; {{ session()->get('message_success') }}
                    </div>
                @endif
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Dashboard</h2>
                        <a href="" class="ml-auto flex items-center text-primary">
                            <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
                        </a>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <div class="text-base text-slate-500 mt-1">Total Payments </div>
                                        <div class="ml-auto">
                                            <i data-feather="dollar-sign" class="report-box__icon text-pending"></i>
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6 mb-6">{{$get_total_amount}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <div class="text-base text-slate-500 mt-1">Total Seasons </div>
                                        <div class="ml-auto">
                                            <i data-feather="cloud" class="report-box__icon text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6 mb-6">{{$total_season_count}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">


                                <div class="box p-5">
                                    <div class="flex">
                                        <div class="text-base text-slate-500 mt-1">Total Users </div>
                                        <div class="ml-auto">
                                            <i data-feather="user" class="report-box__icon text-success"></i>
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6 mb-6">{{$total_user_count}}</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: General Report -->

                 <!-- BEGIN: Users -->
                 <div class="col-span-12 xl:col-span-6 mt-6">
                    <div class="intro-y block sm:flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5 mb-5">Users</h2>
                    </div>
                    <div class="col-span-12 sm:col-span-6 2xl:col-span-3 intro-y">
                        <div class="box p-5 zoom-in">
                            <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                                <table class="table table-report sm:mt-2">
                                    <thead>
                                        <tr>
                                            <th class="whitespace-nowrap">IMAGES</th>
                                            <th class="whitespace-nowrap"> NAME</th>
                                            <th class="text-center whitespace-nowrap">STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($get_users  as $user)
                                            <tr class="intro-x">
                                                <td class="">
                                                    <div class="flex">
                                                        <div class="w-10 h-10 image-fit zoom-in">
                                                            @if ($user->photo)
                                                            <img alt="" class="tooltip rounded-full" src="" title="">
                                                            @else
                                                            <img alt="" class="tooltip rounded-full" src="" title="">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="" class="font-medium whitespace-nowrap">{{ $user->name }}</a>
                                                    <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5"></div>
                                                </td>

                                                <td class="w-40">
                                                    @if ($user->subscribed == 1 )
                                                    <div class="flex items-center justify-center text-success">
                                                        <i data-feather="check-square" class="w-4 h-4 mr-2"></i>{{'Paid'}}
                                                    </div>
                                                    @else
                                                    <div class="flex items-center justify-center text-danger">
                                                        <i data-feather="alert-circle" class="w-4 h-4 mr-2"></i> {{'Unpaid' }}
                                                    </div>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- END: Users  -->
                <!-- BEGIN: Upcoming Matches -->
                <div class="col-span-12 xl:col-span-6 mt-6">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Upcoming Matches</h2>
                    </div>
                    <div class="mt-5">
                        @foreach ($get_upcoming_matches as $upcoming_match)
                            <div class="intro-y">
                                <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                                    {{-- <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden">

                                        <img alt="" src="{{ asset('storage/images/team_logo/'.$upcoming_match->first_team_id->logo) }}">
                                    </div>
                                    <div class="ml-4 mr-auto">
                                        <div class="font-medium">{{ $upcoming_match->first_team_id->name }}</div>
                                        <div class="text-slate-500 text-xs mt-0.5">ghg</div>
                                    </div> --}}

                                    <div style="margin-right: 100px;">
                                        <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden">
                                            <img alt="" src="{{ asset('storage/images/team_logo/'.$upcoming_match->first_team_id->logo) }}">
                                        </div>
                                        <div class="font-medium"  style="word-wrap: break-word">{{ $upcoming_match->first_team_id->name }}</div>
                                    </div>
                                    <div class="">
                                        <div class="text-center py-1 px-4 rounded-full text-xs bg-success text-white cursor-pointer font-medium">Vs</div>
                                        <p class="text-slate-500 text-xs mt-0.5">{{ \Carbon\Carbon::parse($upcoming_match->date)->format('j F, Y') }}</p>
                                           <p class="text-slate-500 text-xs mt-0.5"> {{ \Carbon\Carbon::createFromFormat('H:i:s', $upcoming_match->time)->format('g:i') }}
                                            {{ ucfirst($upcoming_match->time_zone) }}</p>
                                    </div>


                                    <div style="margin-left: 100px">
                                        <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden">
                                            <img alt="" src="{{ asset('storage/images/team_logo/'.$upcoming_match->second_team_id->logo) }}">
                                        </div>
                                        <div class="font-medium" style="word-wrap: break-word">{{ $upcoming_match->second_team_id->name }}</div>
                                    </div>

                                    {{-- <div class="py-1 px-2 rounded-full text-xs bg-success text-white cursor-pointer font-medium">137 Sales</div> --}}
                                </div>
                            </div>
                        @endforeach
                        <a href="{{route('admin/fixtures')}}" class="intro-y w-full block text-center rounded-md py-4 border border-dotted border-slate-400 dark:border-darkmode-300 text-slate-500">View More</a>
                    </div>
                </div>
                <!-- END: Weekly Best Sellers -->

                <!-- BEGIN: Weekly Top Products -->
                {{-- <div class="col-span-12 mt-6">
                    <div class="intro-y block sm:flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Weekly Top Products</h2>
                        <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                            <button class="btn box flex items-center text-slate-600 dark:text-slate-300">
                                <i data-feather="file-text" class="hidden sm:block w-4 h-4 mr-2"></i> Export to Excel
                            </button>
                            <button class="ml-3 btn box flex items-center text-slate-600 dark:text-slate-300">
                                <i data-feather="file-text" class="hidden sm:block w-4 h-4 mr-2"></i> Export to PDF
                            </button>
                        </div>
                    </div>
                    <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                        <table class="table table-report sm:mt-2">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">IMAGES</th>
                                    <th class="whitespace-nowrap">PRODUCT NAME</th>
                                    <th class="text-center whitespace-nowrap">STOCK</th>
                                    <th class="text-center whitespace-nowrap">STATUS</th>
                                    <th class="text-center whitespace-nowrap">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (array_slice($fakers, 0, 4) as $faker)
                                    <tr class="intro-x">
                                        <td class="w-40">
                                            <div class="flex">
                                                <div class="w-10 h-10 image-fit zoom-in">
                                                    <img alt="Rubick Tailwind HTML Admin Template" class="tooltip rounded-full" src="{{ asset('dist/images/' . $faker['images'][0]) }}" title="Uploaded at {{ $faker['dates'][0] }}">
                                                </div>
                                                <div class="w-10 h-10 image-fit zoom-in -ml-5">
                                                    <img alt="Rubick Tailwind HTML Admin Template" class="tooltip rounded-full" src="{{ asset('dist/images/' . $faker['images'][1]) }}" title="Uploaded at {{ $faker['dates'][1] }}">
                                                </div>
                                                <div class="w-10 h-10 image-fit zoom-in -ml-5">
                                                    <img alt="Rubick Tailwind HTML Admin Template" class="tooltip rounded-full" src="{{ asset('dist/images/' . $faker['images'][2]) }}" title="Uploaded at {{ $faker['dates'][2] }}">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="" class="font-medium whitespace-nowrap">{{ $faker['products'][0]['name'] }}</a>
                                            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{ $faker['products'][0]['category'] }}</div>
                                        </td>
                                        <td class="text-center">{{ $faker['stocks'][0] }}</td>
                                        <td class="w-40">
                                            <div class="flex items-center justify-center {{ $faker['true_false'][0] ? 'text-success' : 'text-danger' }}">
                                                <i data-feather="check-square" class="w-4 h-4 mr-2"></i> {{ $faker['true_false'][0] ? 'Active' : 'Inactive' }}
                                            </div>
                                        </td>
                                        <td class="table-report__action w-56">
                                            <div class="flex justify-center items-center">
                                                <a class="flex items-center mr-3" href="">
                                                    <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit
                                                </a>
                                                <a class="flex items-center text-danger" href="">
                                                    <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="intro-y flex flex-wrap sm:flex-row sm:flex-nowrap items-center mt-3">
                        <nav class="w-full sm:w-auto sm:mr-auto">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="w-4 h-4" data-feather="chevrons-left"></i>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="w-4 h-4" data-feather="chevron-left"></i>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">...</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">...</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="w-4 h-4" data-feather="chevron-right"></i>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="w-4 h-4" data-feather="chevrons-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <select class="w-20 form-select box mt-3 sm:mt-0">
                            <option>10</option>
                            <option>25</option>
                            <option>35</option>
                            <option>50</option>
                        </select>
                    </div>
                </div> --}}
                <!-- END: Weekly Top Products -->
            </div>
        </div>

    </div>
@endsection

@section('script')
<script>
    // alert('hello');
    $(document).ready(function(){
    $(".message_success_alert").delay(3000).slideUp(300);
});
</script>
@endsection
