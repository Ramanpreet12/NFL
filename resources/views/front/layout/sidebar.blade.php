@push('css')
<link rel="stylesheet" href="{{ asset('front/css/custom.css') }}">
@endpush


<div class="col-sm-3 col-md-2">
    <div class="aSidebar">
        <div class="aSidebarCard">
            <h4><span><a href="{{route('dashboard')}}" style="text-decoration:none;">Dashboard</a></span></h4>
            <ul class="sidebarLink">
                <li><a href="{{route('teams')}}">Team Pick</a></li>
                <li><a href="{{ route('my_selections') }}">My Selections</a></li>
                <li><a href="{{ route('my_results') }}">My Results</a></li>
                <li><a href="{{ route('past_selections') }}">Past Selections</a></li>
                <li><a href="{{ route('userPayment') }}">Payments</a></li>
                <li><a href="{{ route('upcomingMatches') }}">Upcoming Matches</a></li>
                <li><a href="{{ route('settings') }}">Settings</a></li>
                <li><a href="{{ route('update-password') }}">Change Password </a></li>
            </ul>


        </div>
    </div>

</div>
