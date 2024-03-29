@extends('../layout/base')

@section('body')

    <body class="py-5">
        @yield('content')
        @include('../layout/components/dark-mode-switcher')
        @include('../layout/components/main-color-switcher')

        <!-- BEGIN: JS Assets-->
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBG7gNHAhDzgYmq4-EHvM4bqW1DNj2UCuk&libraries=places">
        </script>
        <script src="{{ mix('dist/js/app.js') }}"></script>
        <script src="{{ asset('dist/js/jquery.min.js') }}"></script>
        <script src="{{ asset('dist/js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('dist/js/custom.js') }}"></script>
        {{-- <script src="{{ asset('dist/js/sweetalert.min.js') }}"></script> --}}

        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
        {{-- jquery dattables  --}}
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

        <script src="{{asset('dist/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('dist/js/jquery.dataTables.min.js')}}"></script>

            {{-- <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script> --}}



        <script src="{{{ URL::asset('js/jquery.dataTables.bootstrap.min.js')}}}"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>

        {{-- date time picker --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>
        <script type="text/javascript" src="{{ asset('dist/js/datetimepicker.js') }}"></script>
        <!-- END: JS Assets-->

        @yield('script')

    </body>
@endsection
