@push('css')
<link rel="stylesheet" href="{{ asset('front/css/custom.css') }}">
@endpush


<div class="col-sm-3 col-md-2">
    <div class="aSidebar">
        <div class="aSidebarCard">
            <h4><span><a href="{{route('dashboard')}}" style="text-decoration:none; color:#333">Dashboard</a></span></h4>
            <ul class="sidebarLink">
                <li><a href="{{route('teams')}}">Team Pick</a></li>
                <li><a href="{{ route('userHistory') }}">Past Selections</a></li>
                <li><a href="{{ route('userPayment') }}">Payments</a></li>
                <li><a href="{{ route('upcomingMatches') }}">Upcoming Matches</a></li>
            </ul>


        </div>
    </div>

</div>
