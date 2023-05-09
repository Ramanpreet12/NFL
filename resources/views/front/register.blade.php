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
                        <a class="navbar-brand" href="#">
                             <img src="front/img/NFL-small.png" alt="" class="img-fluid"> </a>
                        </div>
                <h2>Sign Up</h2>
                <div class="inputsForm">
                    <form id="register_form" action = "{{route('new_reg')}}" method="POST"  >
                        @csrf
                         <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label for="fname" class="form-label">Name</label>
                            <input type="text" class="form-control" id="fname" name="fname" placeholder="John" value="{{old('fname')}}">
                            @error('fname')<p class="text-danger">{{$message}}</p> @enderror
                          </div>
                          <div class=" col-sm-6 mb-3">
                            <label for="birthday" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" value="{{old('birthday')}}">
                            @error('birthday')<p class="text-danger">{{$message}}</p> @enderror
                          </div>
                        </div>
                        <div class="row">
                            <div class=" col-sm-6 mb-3">
                              <label for="exampleInputEmail1" class="form-label">Email address</label>
                              <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="john@gamil.com" value="{{old('email')}}">
                              @error('email')<p class="text-danger">{{$message}}</p> @enderror
                            </div>
                            <div class="col-sm-6 mb-3">
                              <label for="exampleInputPassword1" class="form-label">Password</label>
                              <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="**********" autocomplete="off">
                              @error('password')<p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6 mb-3">
                            <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="**********">
                            @error('password_confirmation')<p class="text-danger">{{$message}}</p> @enderror
                          </div>
                          <div class="col-sm-6 mb-3">
                            <label for="phone" class="form-label">Mobile No.</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="0123456789"  value="{{old('phone')}}">
                            @error('phone')<p class="text-danger">{{$message}}</p> @enderror
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
