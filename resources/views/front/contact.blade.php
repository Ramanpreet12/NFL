@extends('front.layout.app')
@section('content')
    <style>
        .input-error {
            color: #ff5555;
        }
        .input-success {
            color: green;
        }
        .error{
            color:#ff5555;
        }
    </style>
    <section id="contactPart">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12">
                    <h2>Contacts</h2>
                </div>
            </div>
            <div class="contactDetail">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-8">
                        <h5>Monday to Friday (except bank holidays) 9:30 AM to 5:00 PM.</h5>
                        <p>A matchday service is provided for all Home fixtures when the switchboard is open from 09.30am
                            until 20 minutes after the end of the game. Please call the above number for all matchday
                            issuesrem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ultricies auctor dignissim.
                            Etiam eget auctor lectus, id scelerisque risus.</p>
                        <div class="imagesBoth">
                            <div class="row mt-3">
                                <div class="col-sm-6">
                                    <img src="img/contacts-1.jpg" alt="" class="img-fluid">
                                    <div class="socialIcon d-flex mb-3">
                                        <h5>Follow Us:</h5>
                                        <i class="fa-brands fa-facebook-f"></i>
                                        <i class="fa-brands fa-instagram"></i>
                                        <i class="fa-brands fa-youtube"></i>
                                        <i class="fa-brands fa-twitter"></i>
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <h4>Head Office</h4>
                                    <div class="contactUs d-flex">
                                        <div class="iconitem">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </div>
                                        <div class="inputText">
                                            <span>USA, California 20, First Avenue, California</span>
                                        </div>
                                    </div>

                                    <div class="contactUs d-flex">
                                        <div class="iconitem">
                                            <i class="fa-solid fa-mobile"></i>
                                        </div>
                                        <div class="inputText">
                                            <span>+7 888 71 140 30 20</span>
                                        </div>
                                    </div>

                                    <div class="contactUs d-flex">
                                        <div class="iconitem">
                                            <i class="fa-solid fa-fax"></i>
                                        </div>
                                        <div class="inputText">
                                            <span>+7 888 71 140 30 20</span>
                                        </div>
                                    </div>
                                    <div class="contactUs d-flex">
                                        <div class="iconitem">
                                            <i class="fa-solid fa-envelope"></i>
                                        </div>
                                        <div class="inputText">
                                            <span>info@stylemixthemes.com</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8 col-md-6 col-lg-4">
                        <div class="contactForm">
                            <h4>CLUB ENQUIRIES</h4>
                            @if (Session::has('success'))
                                <span class="input-success">{{ session()->get('success', 'Request is send successfully'); }}</span>
                            @endif
                            @if (Session::has('error'))
                            <span class="input-error">{{ session()->get('error', 'Something went wrong'); }}</span>
                            @endif
                            <form id="contactForm" method="post" action="{{ route('contact_us') }}">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" class="form-control" value="{{ old('subject') }}" id="subject" name="subject"
                                        placeholder="Subject">
                                    @error('subject')
                                        <div class="input-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Name" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="input-error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" name="email" id="email"
                                        aria-describedby="emailHelp" placeholder="E-mail" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="input-error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <textarea id="message" class="form-control" name="message" rows="4" cols="50" placeholder="Message"> {{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="input-error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <input type="hidden" name="g-capcha" id="g-capcha">
                                @error('g-capcha')
                                        <div class="input-error">Invalid capcha</div>
                                    @enderror
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render={{env('CAPCHA_SITE_KEY')}}"></script>
    <script>
        var key = "{{env('CAPCHA_SITE_KEY')}}";
           grecaptcha.ready(function() {
      grecaptcha.execute(key,
      {
        action: '{{route('contact_us')}}'
        }
        ).then(function(token) {
            if(token){
                document.getElementById('g-capcha').value = token;
            }else{
                document.getElementById('g-capcha').after('<span class="error">Invalid capcha</span>');
            }
      });
  });
        $('form[id="contactForm"]').validate({
            rules: {
                subject: 'required',
                name: 'required',
                email: {
                    required: true,
                    email: true,
                },
            },
            messages: {
                subject: 'This field is required',
                name: 'This field is required',
                email: 'Enter a valid email',
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
@endsection