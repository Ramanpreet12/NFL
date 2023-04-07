<nav class="navbar navbar-expand-lg" style="background-color:{{ $colorSection['header']["bg_color"] }};">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.html">

                    @if (!empty($general->logo))
                            <img src="{{asset('storage/images/general/'.$general->logo)}}" alt="" height="50px" width="100px">
                    @else
                            <img src="{{ asset('front/img/football picks.png') }}" alt="" class="img-fluid">
                    @endif



      {{-- <img src="{{ asset('front/img/football picks.png') }}" alt="" class="img-fluid"> --}}
      </a>
      <div class="loginbtn">
        <a href="{{ url('admin/login') }}" class="btn btn-primary" style="color:{{ $colorSection['header']["text_color"] }};" type="submit">log in
        </a>
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto me-auto  mb-2 mb-lg-0">
          {{-- <li class="nav-item dropdown" style="background-color:{{ $colorSection['header']["button_color"] }};"> --}}
            {{-- @foreach ($mainMenus as $menuMenu)

            <li class="nav-item  dropdown ">
                <a class="nav-link  @if($menuMenu->parent_id != $menuMenu->id ) dropdown-toggle @endif " href="#" style="color:{{ $colorSection['header']["text_color"] }}; background-color:{{ $colorSection['header']["button_color"] }};" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                     {{$menuMenu->title}}
                </a>
                <div class="dropdown-menu megaMenu" x-placement="bottom-start" style="position: absolute; background-color:{{ $colorSection['navbar']["bg_color"] }};" >
                  <div class="container">
                    <div class="row">
                      <ul class="navbar-nav dropList">
                        @foreach ($subMenus as $subMenu)
                        @if ($subMenu->parent_id == $menuMenu->id)
                            <li class="nav-item"> <a class="dropdown-item" href="#">{{$subMenu->title}}</a></li>
                        @endif
                        @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
              </li>
            @endforeach --}}

            @foreach ($mainMenus as $menuMenu)

            <li class="nav-item  dropdown">
                {{-- @if ($loop->first)

                <a class="nav-link {{ get_menus($menuMenu->id) }} show" href="#"  role="button" data-bs-toggle="dropdown" aria-expanded="true">
                    {{$menuMenu->title}}
               </a>
            @endif --}}

                <a class="nav-link {{ get_menus($menuMenu->id) }} @if($loop->first) show @else '' @endif" href="#"  role="button" data-bs-toggle={{ get_menus_bar($menuMenu->id) }} aria-expanded="false">
                     {{$menuMenu->title}}
                </a>
                <div class="dropdown-menu megaMenu @if($loop->first) show  @else '' @endif" x-placement="bottom-start" style="position: absolute; background-color:{{ $colorSection['navbar']["bg_color"] }};" >
                  <div class="container">
                    <div class="row">
                      <ul class="navbar-nav dropList">
                        @foreach ($subMenus as $subMenu)

                        @if ($subMenu->parent_id == $menuMenu->id)
                            <li class="nav-item"> <a class="dropdown-item" href="#">{{$subMenu->title}}</a></li>

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

    </div>
  </nav>
  <style type="text/css">
  .navbar .navbar-collapse .navbar-nav .dropdown .dropdown-menu a {
    background-color: <?php echo $colorSection['navbar']["button_color"] ?>;
    color: <?php echo $colorSection['navbar']["text_color"] ?>;
}

 .btn-primary:before {
    background-color: <?php echo $colorSection['header']["button_color"] ?>;
}
 .btn-primary:after {
    background-color: <?php echo $colorSection['header']["button_color"] ?>;
}
    </style>
