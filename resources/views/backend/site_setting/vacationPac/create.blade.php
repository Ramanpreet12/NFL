@extends('../layout/' . $layout)

@section('subhead')
    <title>NFL | Vacation</title>
@endsection

@section('subcontent')
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
            <h2 class="font-medium text-base mr-auto">Add Vacation Pac </h2>
            <a href="{{route('vacation.index')}}"><button class="btn btn-primary">Back</button></a>

        </div>
        <form action="{{route('vacation.store')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div id="horizontal-form" class="p-5">
                <div class="preview  mr-5">
                    <div class="form-inline">
                        <label for="title" class="font-medium form-label sm:w-60">Title <span class="text-danger">*</span></label>
                        <input id="title" type="text" class="form-control" placeholder="Vacation Pac title" name="title" value="{{old('title')}}">
                    </div>
                    <div class="form-inline mt-2">
                        <label for="" class="font-medium form-label sm:w-60"></label>
                        @error('title')<p class="text-danger">{{$message}}</p> @enderror
                    </div>


                    <div class="form-inline mt-5">
                        <label for="image_video" class="font-medium form-label sm:w-60">Image / Video <span class="text-danger">*</span></label>
                        <input id="image_video" type="file" class="form-control" placeholder="Vacation Pac Image / Video " name="image_video">

                    </div>
                    <div class="form-inline mt-2">
                        <label for="" class="font-medium form-label sm:w-60"></label>
                        @error('image_video')<p class="text-danger">{{$message}}</p> @enderror
                    </div>

                    <div class="form-inline mt-5">
                        <label for="serial" class="font-medium form-label sm:w-60">Serial <span class="text-danger">*</span></label>
                        <input id="serial" type="number" class="form-control" placeholder="Vacation Serial" name="serial" value="{{old('serial')}}">
                    </div>
                    <div class="form-inline mt-2">
                        <label for="" class="font-medium form-label sm:w-60"></label>
                        @error('serial')<p class="text-danger">{{$message}}</p> @enderror
                    </div>

                    <div class="form-inline mt-5 mt-2">
                        <label for="status" class="font-medium form-label sm:w-60">Status <span class="text-danger">*</span></label>
                        <select class="form-control" id="status" name="status">

                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="form-inline mt-2">
                        <label for="" class="font-medium form-label sm:w-60"></label>
                        @error('status')<p class="text-danger">{{$message}}</p> @enderror
                    </div>

                    {{-- @if (!empty($general->logo))
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

                    @endif --}}




                    {{-- <div class="form-inline mt-5">
                        <label for="logo" class="font-medium form-label sm:w-60"></label>
                        <img src="{{asset('public/images/general/'.$general->favicon)}}" alt="" height="50px" width="100px">

                    </div> --}}


                </div>

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
