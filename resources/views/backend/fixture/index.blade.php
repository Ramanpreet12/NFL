@extends('../layout/' . $layout)

@section('subhead')
    <title>NFL | Fixture</title>
@endsection

@section('subcontent')
    {{-- <h2 class="intro-y text-lg font-medium mt-10">Banners Management</h2> --}}
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
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">


        <h2 class="text-lg font-medium mr-auto">Fixture Management</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <a class="btn btn-primary shadow-md mr-2" href="{{route('admin/add_fixtures')}}" id="add_fixture">Add New Fixture</a>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6 mt-5 p-5 bg-white mb-5">
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2" id="banner_table">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="text-center whitespace-nowrap">Season</th>
                        <th class="text-center whitespace-nowrap"></th>
                        <th class="text-center whitespace-nowrap">Team One</th>
                        <th class="text-center whitespace-nowrap"></th>
                        <th class="text-center whitespace-nowrap" >Team Two</th>

                        <th class="text-center whitespace-nowrap">Week </th>
                        <th class="text-center whitespace-nowrap">Date </th>
                        <th class="text-center whitespace-nowrap">Time </th>
                        <th class="text-center whitespace-nowrap">Created At  </th>
                        <th class="text-center whitespace-nowrap">Updated At </th>
                        <th class="text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @if ($fixtures->isNotEmpty())


                    @forelse ($fixtures as $fixture)

                        <tr class="intro-x">
                            <td>
                                <div class="text-slate-500 font-medium whitespace-nowrap mx-4"> {{$fixture->season->season_name ?? ''}} </div>

                            </td>
                            <td class="">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit zoom-in">
                                        @if (!empty($fixture->first_team_id->logo))
                                        <img src="{{asset('storage/images/team_logo/'.$fixture->first_team_id->logo)}}" alt="" height="50px" width="100px" class="rounded-full">
                                        @else
                                                <img src="{{asset('dist/images/no-image.png')}}" alt="" class="img-fluid rounded-full">
                                        @endif
                                    </div>

                                </div>
                            </td>
                            <td class="text-center">{{ $fixture->first_team_id->name }}</td>
                            <td class="">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit zoom-in">
                                        @if (!empty($fixture->second_team_id->logo))
                                        <img src="{{asset('storage/images/team_logo/'.$fixture->second_team_id->logo)}}" alt="" height="50px" width="100px" class="rounded-full">
                                        @else
                                                <img src="{{asset('dist/images/no-image.png')}}" alt="" class="img-fluid rounded-full">
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">{{ $fixture->second_team_id->name }}</td>
                            <td class="text-center">{{ $fixture->week }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($fixture->date)->format('j F, Y') }}</td>
                            <td class="text-center"> {{ \Carbon\Carbon::createFromFormat('H:i:s', $fixture->time)->format('g:i') }} {{ ucfirst($fixture->time_zone) }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($fixture->created_at)->format('j F, Y') }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($fixture->updated_at)->format('j F, Y') }}</td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href="{{ url('admin/edit_fixture/'.$fixture->id) }}">
                                        <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit
                                    </a>
                                    <a class="flex items-center mr-3" href="{{ url('admin/fixtures/'.$fixture->id) }}" onclick="return confirm('{{ __('Are you sure you want to delete?') }}')">
                                        <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete
                                    </a>
                                    {{-- <form action="{{ route('banner.destroy', $fixture->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                            <button class="btn btn-danger show_sweetalert" type="submit" data-toggle="tooltip">  <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete</button>
                                      </form> --}}
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="text-center">No Records found</td>

                        </tr>
                    @endforelse
                    @endif
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->

        <!-- END: Pagination -->
    </div>
    <!-- BEGIN: Delete Confirmation Modal -->
    <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-feather="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">Are you sure?</div>
                        <div class="text-slate-500 mt-2">Do you really want to delete these records? <br>This process
                            cannot be undone.</div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <button type="button" data-tw-dismiss="modal"
                            class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                        <button type="button" class="btn btn-danger w-24">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Delete Confirmation Modal -->

@endsection



   @section('script')
   <script>
    $(function() {
      $('#banner_table').DataTable();
    });
   </script>
   @endsection
