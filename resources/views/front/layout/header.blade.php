<nav class="navbar navbar-expand-lg" style="background-color:{{ $colorSection['header']['bg_color'] }};">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">

            @if (!empty($general->logo))
                <img src="{{ asset('storage/images/general/' . $general->logo) }}" alt="" height="50px"
                    width="100px">
            @else
                <img src="{{ asset('front/img/football picks.png') }}" alt="" class="img-fluid">
            @endif
        </a>

        @if (Auth::guest())
        <div class="loginbtn">
            <a href="{{ url('login') }}" class="btn btn-primary"
            style="color:{{ $colorSection['header']['text_color'] }};" type="submit">log in
        </a>
        </div>
        @else

            {{-- <a href="{{ route('logout') }}" class="btn btn-primary">Logout</a> --}}
            <div class="loginbtn userDropdown dropdown">
              <a href="" class="dropdown-toggle" style="color:{{ $colorSection['header']["text_color"] }}; text-decoration: none;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name }} &nbsp;<i class="fa-solid fa-user"></i>
              </a>
              <ul class="dropdown-menu">
               <br>
          <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
          <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
        </ul>
            </div>

    @endif




        {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto me-auto  mb-2 mb-lg-0">



                <li class="nav-item  dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Logout</a>
                    <div class="dropdown-menu megaMenu" x-placement="bottom-start"
                        style="position: absolute; background-color:{{ $colorSection['navbar']['bg_color'] }};">
                        <div class="container">
                            <div class="row">
                                <ul class="navbar-nav dropList">

                                    <li class="nav-item"> <a class="dropdown-item" href="#">Logout</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div> --}}



        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto me-auto  mb-2 mb-lg-0">

                @foreach ($mainMenus as $menuMenu)
                    <li class="nav-item  dropdown">
                        <a class="nav-link {{ get_main_menus($menuMenu->id) }}" href="{{ $menuMenu->url }}" role="button"
                            data-bs-toggle={{ get_main_submenus($menuMenu->id) }} aria-expanded="false">
                            {{ $menuMenu->title }}</a>
                        <div class="dropdown-menu megaMenu" x-placement="bottom-start"
                            style="position: absolute; background-color:{{ $colorSection['navbar']['bg_color'] }};">
                            <div class="container">
                                <div class="row">
                                    <ul class="navbar-nav dropList">
                                        @foreach ($subMenus as $subMenu)
                                            @if ($subMenu->parent_id == $menuMenu->id)
                                                <li class="nav-item"> <a class="dropdown-item"
                                                        href="{{ $subMenu->url }}">{{ $subMenu->title }}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach



                {{-- <li class="nav-item">
            <a class="nav-link" style="color:{{ $colorSection['header']["text_color"] }};" href="#">About Us
              <span class="navHoverEffect"> </span>
            </a>
          </li> --}}
                {{-- <li class="nav-item">
            <a class="nav-link" style="color:{{ $colorSection['header']["text_color"] }};"  href="#">Match Result
              <span class="navHoverEffect"> </span>
            </a>
          </li> --}}
                {{-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" style="color:{{ $colorSection['header']["text_color"] }};" href="#"  role="button" data-bs-toggle="dropdown" aria-expanded="false">Match Fixture
              <span class="navHoverEffect"> </span>
            </a>
            <div class="dropdown-menu megaMenu" x-placement="bottom-start" style="position: absolute; background-color:{{ $colorSection['navbar']["bg_color"] }};" >
                <div class="container">
                  <div class="row">
                    <ul class="navbar-nav dropList">
                      <li class="nav-item"> <a class="dropdown-item" href="#">NFL </a></li>
                      <li class="nav-item"> <a class="dropdown-item" href="#"> Results</a></li>
                      <li class="nav-item"><a class="dropdown-item" href="#">Gameday Player's Standing</a></li>
                      <div class="dropdown-divider"></div>
                      <li class="nav-item"> <a class="dropdown-item" href="#">Playoffs</a></li>
                      <li class="nav-item"> <a class="dropdown-item" href="#"> Superbowl</a></li>
                    </ul>
                  </div>
                </div>
              </div>
          </li>
          <li class="nav-item" >
            <a class="nav-link" style="color:{{ $colorSection['header']["text_color"] }};" href="#">Prize
              <span class="navHoverEffect"> </span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="color:{{ $colorSection['header']["text_color"] }};" href="#">Contact Us
              <span class="navHoverEffect"> </span>
            </a>
          </li> --}}
            </ul>

        </div>

        {{-- @if (Auth::guest())
            <div class="loginbtn">
                <a href="{{ url('login') }}" class="btn btn-primary"
                style="color:{{ $colorSection['header']['text_color'] }};" type="submit">log in
            </a>
            </div>
            @else
                {{ Auth::user()->name }}
                <a href="{{ route('logout') }}" class="btn btn-primary">Logout</a>
        @endif --}}
    </div>
</nav>
<style type="text/css">
    .navbar .navbar-collapse .navbar-nav .dropdown .dropdown-menu a {
        background-color: <?php echo $colorSection['navbar']['button_color']; ?>;
        color: <?php echo $colorSection['navbar']['text_color']; ?>;
    }

    .btn-primary:before {
        background-color: <?php echo $colorSection['header']['button_color']; ?>;
    }

    .btn-primary:after {
        background-color: <?php echo $colorSection['header']['button_color']; ?>;
    }
</style>


{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
   $(document).ready(function(){
    $('.nav-item a:first').addClass('show');
    $('.nav-item .megaMenu:first').addClass('show');
//   $('ul li a').click(function(){
//    let $li =  $(this).toggleClass('show');
//    $('li a').not($li).removeClass('show');

//     // $('.nav-item a:first').removeClass('show');
//     // $('.nav-item .megaMenu:first').removeClass('show');

// });
});
</script> --}}
