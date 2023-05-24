@extends('front.layout.app')
@section('content')
<section id="successForm">
    <div class="container ">
        <div class="row">
            <div class="col-sm-8 mx-auto">
                 <div class="successPage">
                    <i class="fa-solid fa-check"></i>
                    <h2>Payment Successfully</h2>
                    <p>We've received your request ,  we'll be in touch shortly!</p>
                 </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('script')
<script>
    let URL = "{{ route('teams') }}";
    setTimeout(function(){window.location=URL }, 3000);
    </script>
@endsection

