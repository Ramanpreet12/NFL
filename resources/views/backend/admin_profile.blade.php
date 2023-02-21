@extends('../layout/' . $layout)

@section('subhead')
    <title>NFL | Update Profile </title>
@endsection

@section('subcontent')
    @if (session()->has('success'))
        <div class="alert alert-success show flex items-center mb-2 alert_messages" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check2-circle"
                viewBox="0 0 16 16">
                <path
                    d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                <path
                    d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
            </svg>
            &nbsp; {{ session()->get('success') }}
        </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger-soft show flex items-center mb-2 alert_messages" role="alert">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-octagon w-6 h-6 mr-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                {{session('error')}}
    </div>
@endif

    <div class="intro-y flex items-center mt-8">

        <h2 class="text-lg font-medium mr-auto">Update Profile</h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Profile Menu -->
        <div class="col-span-12 lg:col-span-4 2xl:col-span-3 flex lg:block flex-col-reverse">
            <div class="intro-y box mt-5">
                <div class="relative flex items-center p-5">
                    <div class="w-12 h-12 image-fit">
                        @if (!empty(Auth::user()->photo))
                        <img alt="Admin Image" class="rounded-full"
                        src="{{asset('storage/admin_profile_photo/'. Auth::user()->photo) }}">
                        @else
                        <img alt="Admin Image" class="rounded-full"
                        src="{{asset('storage/admin_profile_photo/dummy_image.webp')}}">
                        @endif

                    </div>
                    <div class="ml-4 mr-auto">
                        <div class="font-medium text-base">{{ Auth::user()->name }}</div>
                        <div class="text-slate-500">{{ Auth::user()->role_as == 0 ? 'Admin' : '' }}</div>
                    </div>

                </div>
                <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                    <a class="flex items-center text-primary font-medium" href="">
                        <i data-feather="activity" class="w-4 h-4 mr-2"></i> Personal Information
                    </a>
                    {{-- <a class="flex items-center mt-5" href="">
                        <i data-feather="box" class="w-4 h-4 mr-2"></i> Account Settings
                    </a> --}}
                    <a class="flex items-center mt-5" href="{{route('admin/password')}}">
                        <i data-feather="lock" class="w-4 h-4 mr-2"></i> Change Password
                    </a>
                    {{-- <a class="flex items-center mt-5" href="">
                        <i data-feather="settings" class="w-4 h-4 mr-2"></i> User Settings
                    </a> --}}
                </div>
                {{-- <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                    <a class="flex items-center" href="">
                        <i data-feather="activity" class="w-4 h-4 mr-2"></i> Email Settings
                    </a>
                    <a class="flex items-center mt-5" href="">
                        <i data-feather="box" class="w-4 h-4 mr-2"></i> Saved Credit Cards
                    </a>
                    <a class="flex items-center mt-5" href="">
                        <i data-feather="lock" class="w-4 h-4 mr-2"></i> Social Networks
                    </a>
                    <a class="flex items-center mt-5" href="">
                        <i data-feather="settings" class="w-4 h-4 mr-2"></i> Tax Information
                    </a>
                </div> --}}
                {{-- <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400 flex">
                    <button type="button" class="btn btn-primary py-1 px-2">New Group</button>
                    <button type="button" class="btn btn-outline-secondary py-1 px-2 ml-auto">New Quick Link</button>
                </div> --}}
            </div>
        </div>
        <!-- END: Profile Menu -->
        <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">

                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">Display Information</h2>
                </div>
                <form id="admin_profile_form" action="{{ route('admin/profile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="p-5">
                        <div class="flex flex-col-reverse xl:flex-row flex-col">
                            <div class="flex-1 mt-6 xl:mt-0">
                                <div class="grid grid-cols-12 gap-x-5">
                                    <div class="col-span-12 2xl:col-span-6">
                                        <div>
                                            <label for="update-profile-form-4" class="form-label">Email</label>
                                            <input id="update-profile-form-4" name="email" type="email"
                                                class="form-control" placeholder="Input email"
                                                value="{{ Auth::user()->email }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-span-12 2xl:col-span-6">
                                        <div class="mt-3">
                                            <label for="update-profile-form-1" class="form-label"> Name <span class="text-danger">*</span></label>
                                            <input id="update-profile-form-1" name="name" type="text"
                                                class="form-control" placeholder="Input name"
                                                value="{{ Auth::user()->name }}">
                                        </div>
                                        @error('name')
                                            <p class="text-danger py-1">{{ $message }}</p>
                                        @enderror
                                        <div class="mt-3">
                                            <label for="update-profile-form-4" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                            <input id="update-profile-form-4" name="phone_number" type="text"
                                                class="form-control" placeholder="Input phone"
                                                value="{{ Auth::user()->phone_number }}">

                                        </div>
                                        @error('phone_number')
                                            <p class="text-danger py-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    {{-- <div class="col-span-12">
                                    <div class="mt-3">
                                        <label for="update-profile-form-5" class="form-label">Address</label>
                                        <textarea id="update-profile-form-5" class="form-control" placeholder="Adress">10 Anson Road, International Plaza, #10-11, 079903 Singapore, Singapore</textarea>
                                    </div>
                                </div> --}}
                                </div>
                            </div>
                            <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                                <div
                                    class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                    <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                         @if (!empty(Auth::user()->photo))
                                         <img class="rounded-md" alt="Admin Image" src="{{asset('storage/admin_profile_photo/'. Auth::user()->photo) }}">
                                         @else
                                         <img class="rounded-md" alt="Admin Image" src="{{asset('storage/admin_profile_photo/dummy_image.webp')}}">
                                         {{-- src="{{  asset('dist/images/' . $fakers[0]['photos'][0]) }}"> --}}
                                         @endif

                                        {{-- <div title="Remove this profile photo?"
                                            class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2">
                                            <i data-feather="x" class="w-4 h-4"></i>
                                        </div> --}}
                                    </div>
                                    <div class="mx-auto cursor-pointer relative mt-5">
                                        <input type="file" name="photo" class="w-full h-full top-0 left-0 absolute opacity-0">
                                        <input type="hidden" value="{{Auth::user()->photo}}" name="current_photo">
                                        <button type="button" class="btn btn-primary w-full">Change Photo</button>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary w-20 mt-3">Update</button>
                    </div>
                </form>
            </div>
            <!-- END: Display Information -->
            <!-- BEGIN: Personal Information -->
            {{-- <div class="intro-y box mt-5">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">Personal Information</h2>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-12 gap-x-5">
                        <div class="col-span-12 xl:col-span-6">
                            <div>
                                <label for="update-profile-form-6" class="form-label">Email</label>
                                <input id="update-profile-form-6" type="text" class="form-control" placeholder="Input text" value="{{ $fakers[0]['users'][0]['email'] }}" disabled>
                            </div>
                            <div class="mt-3">
                                <label for="update-profile-form-7" class="form-label">Name</label>
                                <input id="update-profile-form-7" type="text" class="form-control" placeholder="Input text" value="{{ $fakers[0]['users'][0]['name'] }}" disabled>
                            </div>
                            <div class="mt-3">
                                <label for="update-profile-form-8" class="form-label">ID Type</label>
                                <select id="update-profile-form-8" class="form-select">
                                    <option>IC</option>
                                    <option>FIN</option>
                                    <option>Passport</option>
                                </select>
                            </div>
                            <div class="mt-3">
                                <label for="update-profile-form-9" class="form-label">ID Number</label>
                                <input id="update-profile-form-9" type="text" class="form-control" placeholder="Input text" value="357821204950001">
                            </div>
                        </div>
                        <div class="col-span-12 xl:col-span-6">
                            <div class="mt-3 xl:mt-0">
                                <label for="update-profile-form-10" class="form-label">Phone Number</label>
                                <input id="update-profile-form-10" type="text" class="form-control" placeholder="Input text" value="65570828">
                            </div>
                            <div class="mt-3">
                                <label for="update-profile-form-11" class="form-label">Address</label>
                                <input id="update-profile-form-11" type="text" class="form-control" placeholder="Input text" value="10 Anson Road, International Plaza, #10-11, 079903 Singapore, Singapore">
                            </div>
                            <div class="mt-3">
                                <label for="update-profile-form-12" class="form-label">Bank Name</label>
                                <select id="update-profile-form-12" data-search="true" class="tom-select w-full">
                                    <option value="1">SBI - STATE BANK OF INDIA</option>
                                    <option value="1">CITI BANK - CITI BANK</option>
                                </select>
                            </div>
                            <div class="mt-3">
                                <label for="update-profile-form-13" class="form-label">Bank Account</label>
                                <input id="update-profile-form-13" type="text" class="form-control" placeholder="Input text" value="DBS Current 011-903573-0">
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="button" class="btn btn-primary w-20 mr-auto">Save</button>
                        <a href="" class="text-danger flex items-center">
                            <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete Account
                        </a>
                    </div>
                </div>
            </div> --}}
            <!-- END: Personal Information -->
        </div>
    </div>

@endsection
