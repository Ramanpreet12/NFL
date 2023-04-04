@extends('../layout/' . $layout)

@section('subhead')
    <title>NFL | Season</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Add Season</h2>
        @if (session()->has('success'))
            <div class="alert alert-success show flex items-center mb-2 alert_messages" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                    class="bi bi-check2-circle" viewBox="0 0 16 16">
                    <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                    <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                </svg>
                &nbsp; {{ session()->get('success') }}
            </div>
        @endif
        @if (session('message_error'))
            <div class="alert alert-danger-soft show flex items-center mb-2 alert_messages" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-alert-octagon w-6 h-6 mr-2">
                    <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                {{ session('message_error') }}
            </div>
        @endif
    </div>
    <div class="grid grid-cols-6 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- BEGIN: Form Layout -->
            <form action="{{ route('season.store') }}" method="post">
                @csrf
                <div class="intro-y box p-5">

                    <div class="mt-3">
                        <label for="name" class="form-label">Name</label>
                        <div class="input-group">
                            <input id="name" type="text" class="form-control" placeholder="Season Name"
                                aria-describedby="input-group-1" name="name">
                        </div>
                        @error('name') <p class="text-danger">{{$message}}</p> @enderror
                    </div>

                    <div class="mt-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <div class="input-group">
                            <input id="start_date" type="date" class="form-control" placeholder="Season Start Date"
                                aria-describedby="input-group-1" name="start_date">
                        </div>
                        @error('start_date') <p class="text-danger">{{$message}}</p> @enderror
                    </div>
                    <div class="mt-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <div class="input-group">
                            <input id="end_date" type="date" class="form-control" placeholder="Season End Date"
                                aria-describedby="input-group-1" name="end_date">
                        </div>
                        @error('end_date') <p class="text-danger">{{$message}}</p> @enderror
                    </div>

                    {{-- <div class="mt-3">
                        <label class="form-label">Date & Time</label>
                        <div class="sm:grid grid-cols-2 gap-2">
                            <div class="input-group">
                                <div id="date" class="input-group-text">Date</div>
                                <input type="date" class="form-control" placeholder="Date" aria-describedby="date"
                                    name="date">
                            </div>
                            <div class="input-group mt-2 sm:mt-0 relative">
                                <div id="time" class="input-group-text">Time</div>
                                <input type="time" class="form-control" placeholder="Time" aria-describedby="time"
                                    name="time">

                                <select class="form-select w-full" id="time_zone" name="time_zone">
                                    <option value="">--select--</option>
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                        </div>
                        <div class="sm:grid grid-cols-2 gap-2">
                            <div>@error('date') <p class="text-danger">{{$message}}</p> @enderror</div>
                            <div class="sm:grid grid-cols-2 gap-2">
                                @error('time') <p class="text-danger">{{$message}}</p> @enderror
                                @error('time_zone') <p class="ml-5 text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>
                    </div> --}}
                    <div class="text-left mt-5">
                        <button type="submit" class="btn btn-primary w-24">Save</button>
                        <button type="reset" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                    </div>
                </div>
            </form>
            <!-- END: Form Layout -->
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ mix('dist/js/ckeditor-classic.js') }}"></script>
@endsection
