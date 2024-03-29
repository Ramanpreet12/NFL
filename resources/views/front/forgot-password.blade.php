@extends('front.layout.app')
@section('content')
    <style>
        label.error {
            color: red;
        }
    </style>
    <section id="loginForm">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-8 col-lg-6 col-md-8">
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
                    @if (session()->has('error'))
                        <div class="alert alert-danger show flex items-center mb-2 alert_messages" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-check2-circle" viewBox="0 0 16 16">
                                <path
                                    d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                                <path
                                    d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                            </svg>
                            &nbsp; {{ session()->get('error') }}
                        </div>
                    @endif

                    <div class="formStart">
                        <div class="logoImage text-center">
                            <a class="navbar-brand" href="#">
                                <img src="img/NFL-small.png" alt="" class="img-fluid"> </a>
                        </div>
                        <h2>Forget Password</h2>
                        <div class="inputsForm">
                            <form method="post" action="{{ route('forget_password') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Enter Email address</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        aria-describedby="emailHelp" placeholder="johndoe@gamil.com">
                                </div>
                           @error('email')
                                <span style="color:red;">{{$message}}</span>
                           @enderror

                                <div class="checkButton d-flex">
                                    <a href="{{route('login')}}">
                                        Cancel
                                      </a>
                                    <button type="submit" name="submit" class="btn btn-primary">Continue</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
