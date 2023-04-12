@extends('../layout/' . $layout)

@section('subhead')
    <title>NFL | General</title>
@endsection
@section('subcontent')
    <div class="intro-y box mt-5">
        @if (session()->has('success'))
            <div class="alert alert-success show flex items-center alert_messages mb-5" role="alert">
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
        </div>
        <form action="{{route('admin/general_post')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div id="horizontal-form" class="p-5">
                <div class="preview">
                    <div class="form-inline">
                        <label for="name" class="font-medium form-label sm:w-60">Name<span class="text-danger">*</span></label>
                        <input id="name" type="text" class="form-control" placeholder="Name" name="name" value="{{$general->name}}">

                    </div>
                    <div class="form-inline">
                        <label for="" class="font-medium form-label sm:w-60"> </label>
                        @error('name')<p class="text-danger">{{$message}}</p> @enderror
                    </div>

                    <div class="form-inline mt-5">
                        <label for="email" class="font-medium form-label sm:w-60">Email <span class="text-danger">*</span></label>
                        <input id="email" type="text" class="form-control" placeholder="example@gmail.com" name="email" value="{{$general->email}}">
                    </div>
                    <div class="form-inline">
                        <label for="" class="font-medium form-label sm:w-60"></label>
                        @error('email')<p class="text-danger">{{$message}}</p> @enderror
                    </div>

                    <div class="form-inline mt-5">
                        <label for="homepage_title" class="font-medium form-label sm:w-60">Homepage Banner Title <span class="text-danger">*</span></label>
                        <input id="homepage_title" type="text" class="form-control" name="homepage_title" value="{{$general->homepage_title}}"
                            placeholder="Homepage banner title" >
                    </div>
                    <div class="form-inline">
                        <label for="" class="font-medium form-label sm:w-60"></label>
                        @error('homepage_title')<p class="text-danger">{{$message}}</p> @enderror
                    </div>

                    <div class="form-inline mt-5">
                        <label for="homepage_subtitle" class="font-medium form-label sm:w-60">Homepage Banner
                            Subtitle <span class="text-danger">*</span></label>
                        <input id="homepage_subtitle" type="text" class="form-control" name="homepage_subtitle" value="{{$general->homepage_subtitle}}"
                            placeholder="Homepage banner subtitle">
                    </div>
                    <div class="form-inline">
                        <label for="" class="font-medium form-label sm:w-60"></label>
                        @error('homepage_subtitle')<p class="text-danger">{{$message}}</p> @enderror
                    </div>

                    <div class="form-inline mt-5">
                        <label for="logo" class="font-medium form-label sm:w-60">Logo <span class="text-danger">*</span></label>
                        <input id="logo" type="file" class="form-control" placeholder="Website Logo" name="logo">
                    </div>
                    <div class="form-inline">
                        <label for="" class="font-medium form-label sm:w-60"></label>
                        @error('logo')<p class="text-danger">{{$message}}</p> @enderror
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
                            src="{{asset('dist/images/no-image.png')}}">
                        </div>
                    @endif

                    <div class="form-inline mt-5">
                        <label for="favicon" class="font-medium form-label sm:w-60">Favicon <span class="text-danger">*</span></label>
                        <input id="favicon" type="file" class="form-control" placeholder="Favicon" name="favicon">
                    </div>

                    <div class="form-inline">
                        <label for="" class="font-medium form-label sm:w-60"></label>
                        @error('favicon')<p class="text-danger">{{$message}}</p> @enderror
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
                            src="{{asset('dist/images/no-image.png')}}">
                        </div>
                    @endif

                    <div class="form-inline mt-5">
                        <label for="footer_contact" class="font-medium form-label sm:w-60">Footer contact <span class="text-danger">*</span></label>
                        <input id="footer_contact" type="text" class="form-control" placeholder="Contact" name="footer_contact" value="{{$general->footer_contact}}">
                    </div>
                    <div class="form-inline">
                        <label for="" class="font-medium form-label sm:w-60"></label>
                        @error('footer_contact')<p class="text-danger">{{$message}}</p> @enderror
                    </div>

                    <div class="form-inline mt-5">
                        <label for="footer_address" class="font-medium form-label sm:w-60">Footer Address <span class="text-danger">*</span></label>
                        <textarea name="footer_address" id="footer_address" cols="20" rows="5" placeholder="Address" >{{$general->footer_address}}</textarea>
                    </div>
                    <div class="form-inline">
                        <label for="" class="font-medium form-label sm:w-60"></label>
                        @error('footer_address')<p class="text-danger">{{$message}}</p> @enderror
                    </div>

                    <div class="form-inline mt-5">
                        <label for="footer_content" class="font-medium form-label sm:w-60">Footer Content <span class="text-danger">*</span></label>
                        <textarea name="footer_content" id="footer_content" cols="20" rows="5" placeholder="Content" >{{$general->footer_content}}</textarea>
                    </div>
                    <div class="form-inline">
                        <label for="" class="font-medium form-label sm:w-60"></label>
                        @error('footer_content')<p class="text-danger">{{$message}}</p> @enderror
                    </div>
                </div>
                <br><br>
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                </div>
                <div class="text-right mt-5">
                    <button type="submit" class="btn btn-primary w-24">Update</button>
                    <button type="reset" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script src="{{ mix('dist/js/ckeditor-classic.js') }}"></script>
@endsection
