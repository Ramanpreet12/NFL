@extends('../layout/' . $layout)

@section('subhead')
    <title>NFL | General</title>
@endsection

@section('subcontent')
    {{-- <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Add General</h2>
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
            <form action="" method="post">
                @csrf
                <div class="intro-y box p-5">


                    <div class="mt-3">
                        <label for="week" class="form-label"><strong>Week</strong> </label>
                        <div class="input-group">
                            <input id="week" type="text" class="form-control" placeholder="week"
                                aria-describedby="input-group-1" name="week">
                        </div>
                        @error('week') <p class="text-danger">{{$message}}</p> @enderror
                    </div>
                    <div class="mt-3">
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
                    </div>
                    <div class="text-left mt-5">
                        <button type="submit" class="btn btn-primary w-24">Save</button>
                        <button type="reset" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                    </div>
                </div>
            </form>
            <!-- END: Form Layout -->
        </div>
    </div> --}}

    <div class="intro-y box mt-5">
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

        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">General Setting</h2>
            {{-- <div class="form-check form-switch w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                <label class="form-check-label ml-0" for="show-example-7">Show example code</label>
                <input id="show-example-7" data-target="#horizontal-form" class="show-code form-check-input mr-0 ml-3" type="checkbox">
            </div> --}}
        </div>
        <form action="{{route('admin/general')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div id="horizontal-form" class="p-5">
                <div class="preview">
                    <div class="form-inline">
                        <label for="name" class="font-medium form-label sm:w-60">Name</label>
                        <input id="name" type="text" class="form-control" placeholder="Name" name="name" value="{{$general->name}}">
                    </div>
                    <div class="form-inline mt-5">
                        <label for="email" class="font-medium form-label sm:w-60">Email</label>
                        <input id="email" type="text" class="form-control" placeholder="example@gmail.com" name="email" value="{{$general->email}}">
                    </div>
                    <div class="form-inline mt-5">
                        <label for="homepage_title" class="font-medium form-label sm:w-60">Homepage Banner Title</label>
                        <input id="homepage_title" type="text" class="form-control" name="homepage_title" value="{{$general->homepage_subtitle}}"
                            placeholder="Homepage banner title" >
                    </div>
                    <div class="form-inline mt-5">
                        <label for="homepage_subtitle" class="font-medium form-label sm:w-60">Homepage Banner
                            Subtitle</label>
                        <input id="homepage_subtitle" type="text" class="form-control" name="homepage_subtitle" value="{{$general->homepage_title}}"
                            placeholder="Homepage banner subtitle">
                    </div>
                    <div class="form-inline mt-5">
                        <label for="logo" class="font-medium form-label sm:w-60">Logo</label>
                        <input id="logo" type="file" class="form-control" placeholder="Website Logo" name="logo">
                        <input id="logo" type="hidden" class="form-control" placeholder="Website Logo" name="current_logo" value="{{$general->logo}}">

                    </div>

                    @if (!empty($general->logo))
                        <div class="form-inline mt-5">
                            <label for="logo" class="font-medium form-label sm:w-60"></label>
                            <img src="{{asset('storage/images/general/'.$general->logo)}}" alt="" height="50px" width="100px">
                        </div>

                    @else
                        <div class="form-inline mt-5">
                            <label for="logo" class="font-medium form-label sm:w-60"></label>
                            <img alt="Admin Image" class="rounded-full" height="50px" width="100px"
                            src="{{asset('dist/images/dummy_image.webp')}}">
                        </div>

                    @endif

                    {{-- <div class="form-inline mt-5">
                        <label for="logo" class="font-medium form-label sm:w-60"></label>
                        <img src="{{asset('public/images/general/'.$general->logo)}}" alt="" height="50px" width="100px">

                    </div> --}}


                    <div class="form-inline mt-5">
                        <label for="favicon" class="font-medium form-label sm:w-60">Favicon</label>
                        <input id="favicon" type="file" class="form-control" placeholder="Favicon" name="favicon">
                        <input id="favicon" type="hidden" class="form-control" placeholder="Favicon" name="current_favicon" value="{{$general->favicon}}">

                    </div>

                    @if (!empty($general->favicon))
                        <div class="form-inline mt-5">
                            <label for="logo" class="font-medium form-label sm:w-60"></label>
                            <img src="{{asset('storage/images/general/'.$general->favicon)}}" alt="" height="50px" width="100px">
                        </div>

                    @else
                        <div class="form-inline mt-5">
                            <label for="logo" class="font-medium form-label sm:w-60"></label>
                            <img alt="Admin Image" class="rounded-full" height="50px" width="100px"
                            src="{{asset('dist/images/dummy_image.webp')}}">
                        </div>

                    @endif


                    {{-- <div class="form-inline mt-5">
                        <label for="logo" class="font-medium form-label sm:w-60"></label>
                        <img src="{{asset('public/images/general/'.$general->favicon)}}" alt="" height="50px" width="100px">

                    </div> --}}


                    <div class="form-inline mt-5">
                        <label for="footer_contact" class="font-medium form-label sm:w-60">Footer contact</label>
                        <input id="footer_contact" type="text" class="form-control" placeholder="Contact" name="footer_contact" value="{{$general->footer_contact}}">
                    </div>
                    <div class="form-inline mt-5">
                        <label for="footer_address" class="font-medium form-label sm:w-60">Footer Address</label>

                        <textarea name="footer_address" id="footer_address" cols="20" rows="5" placeholder="Address" >{{$general->footer_address}}</textarea>
                    </div>



                    {{-- <div class="sm:ml-20 sm:pl-5 mt-5">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div> --}}


                </div>

                {{-- <div class="source-code hidden">
                <button data-target="#copy-horizontal-form" class="copy-code btn py-1 px-2 btn-outline-secondary">
                    <i data-feather="file" class="w-4 h-4 mr-2"></i> Copy example code
                </button>
                <div class="overflow-y-auto mt-3 rounded-md">
                    <pre id="copy-horizontal-form" class="source-preview">
                        <code class="text-xs p-0 rounded-md html pl-5 pt-8 pb-4 -mb-10 -mt-10">
                            {{ \Hp::formatCode('
                                <div class="form-inline">
                                    <label for="horizontal-form-1" class="form-label sm:w-20">Email</label>
                                    <input id="horizontal-form-1" type="text" class="form-control" placeholder="example@gmail.com">
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="horizontal-form-2" class="form-label sm:w-20">Password</label>
                                    <input id="horizontal-form-2" type="password" class="form-control" placeholder="secret">
                                </div>
                                <div class="form-check sm:ml-20 sm:pl-5 mt-5">
                                    <input id="horizontal-form-3" class="form-check-input" type="checkbox" value="">
                                    <label class="form-check-label" for="horizontal-form-3">Remember me</label>
                                </div>
                                <div class="sm:ml-20 sm:pl-5 mt-5">
                                    <button class="btn btn-primary">Login</button>
                                </div>
                            ') }}
                        </code>
                    </pre>
                </div>
            </div> --}}

                <br><br>


                <div
                    class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                </div>
                <div class="text-right mt-5">
                    <button type="submit" class="btn btn-primary w-24">Save</button>
                    <button type="reset" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script src="{{ mix('dist/js/ckeditor-classic.js') }}"></script>
@endsection
