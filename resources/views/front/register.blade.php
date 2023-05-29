@extends('front.layout.app')
@section('content')
    <style>
        label.error {
            color: red;
        }
    </style>
    <section id="signupForm">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <div class="formStart">
                        <div class="logoImage text-center">
                            <a class="" href="{{ url('/') }}">
                                @if (!empty($general->logo))
                                    <img src="{{ asset('storage/images/general/' . $general->logo) }}" alt=""
                                        height="100px" width="120px" class="img-fluid">
                                @else
                                    <img src="{{ asset('front/img/football picks.png') }}" alt="" class="img-fluid">
                                @endif
                            </a>
                        </div>
                        <h2>Sign Up</h2>
                        <div class="inputsForm">
                            <form id="register_form" action="{{ route('new_reg') }}" method="POST" >
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <label for="fname" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="fname" name="fname"
                                            placeholder="John" value="{{ old('fname') }}">
                                        @error('fname')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class=" col-sm-6 mb-3">
                                        <label for="birthday" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" id="birthday" name="birthday"
                                            value="{{ old('birthday') }}">
                                        @error('birthday')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class=" col-sm-6 mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                                        <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" placeholder="john@gmail.com"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password"
                                            id="exampleInputPassword1" placeholder="**********" autocomplete="off">
                                        @error('password')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            id="password_confirmation" placeholder="**********">
                                        @error('password_confirmation')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label for="phone" class="form-label">Mobile No.</label>
                                        <input type="tel" class="form-control" id="phone" name="phone"
                                            placeholder="0123456789" value="{{ old('phone') }}">
                                        @error('phone')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror

                                        <p class="text-danger hide" id="valid-msg"></p>
                                        <p class="text-danger hide" id="error-msg"></p>

                                        {{-- <span id="valid-msg" class="hide"></span>
                                        <span id="error-msg" class="hide"></span> --}}

                                    </div>

                                </div>
                                <!-- <a type="submit" name="submit" class="btn btn-primary">Sign Up
                                  </a> -->
                                <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        var input = document.querySelector("#phone");
        errorMsg = document.querySelector("#error-msg"),
            validMsg = document.querySelector("#valid-msg");
        var errorMap = ["Invalid number", "Invalid country code", "Phone number is Too short", "Phone number is Too long", "Invalid number"];
        var intl = window.intlTelInput(input, {
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.1.6/js/utils.js"
        });
        var reset = function() {
            input.classList.remove("error");
            errorMsg.innerHTML = "";
            errorMsg.classList.add("hide");
            validMsg.classList.add("hide");
        };
        input.addEventListener('blur', function() {
            reset();
            if (input.value.trim()) {

                if (intl.isValidNumber()) {
                    validMsg.classList.remove("hide");

                } else {
                    input.classList.add("error");
                    var errorCode = intl.getValidationError();
                    errorMsg.innerHTML = errorMap[errorCode];
                    errorMsg.classList.remove("hide");

                }
            }
        });
        input.addEventListener('change', reset);
        input.addEventListener('keyup', reset);

    </script>
@endsection
