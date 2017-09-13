<script src="{{ asset('js/getheight.js') }}"></script>
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/wot.png')}}" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One|Muli" rel="stylesheet"> 
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/jquery-1.11.0.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.leanModal.min.js') }}"></script>
    {{-- <link href="{{ asset('fonts')}}" rel="stylesheet"> --}}
    @yield('pagestyle')
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}"><span><img style="width:25px;height:25px" src="{{ asset('images/wot.png')}}"></span>
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                    @if(Auth::check())
                        @if (Auth::user()->level===2)
                                <li><a href="/pages">View users</a></li>
                                @endif
                        @if (Auth::user()->level>0)
                                <li><a href="/create">Create Event</a></li>
                                @endif
                    @endif
                    
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        
                        @else
                        <li class="dropdown" id="markasread" onclick="markNotificationAsRead()">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i style="top:4px" class="fa fa-globe fa-2x"></i><span style="background-color:#ff3333;position:relative;top:-5px;left:-10px" class="badge">{{ App\Notifyme::CountNoti()}}</span>
                        </a>
                        <ul style="min-width:300px" class="dropdown-menu notification" role="menu">
                        @if(App\Notifyme::CountNoti() > 0)
                        <?php   $notes = DB::table('users')
                                    ->leftJoin('notifymes','users.id','=','notifymes.user_id')
                                    ->where('user_id', Auth::user()->id)
                                    ->get();
                        ?>
                            
                                @foreach($notes as $note)
                                <?php $cards = App\Card::where('id', $note->card_id)->get();?>
                                @foreach($cards as $card)
                                <?php
                                $dateinput = $card->date_start; 
                                $datestart = \Carbon\Carbon::createFromFormat( 'Y-m-d' , $dateinput );
                                ?>
                                @if( $datestart->isTomorrow(\Carbon\Carbon::now()))
                                <li style="padding:0 20px 5px 20px"><p style="margin:1px">Event <a href="/cards/{{ $note->card_id }}">{{ $card->title}}</a> starts tomorrow</p></li>
                                <hr>
                                @elseif( $datestart->isToday(\Carbon\Carbon::now()))
                                <li style="padding:0 20px 5px 20px"><p style="margin:1px">Event <a href="/cards/{{ $note->card_id }}">{{ $card->title}}</a> starts today at {{ date('H:i A', strtotime($card->sunrise))}}</p></li>
                                <hr>
                                @else
                                @endif
                                @endforeach
                                @endforeach
                        @else
                                <li style="padding:0 20px 5px 20px"><p style="margin:1px">No notifications</li>
                                 @endif
                        </ul>
                        </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                   <img class="img-badge" src="{{asset('photos/'.Auth::user()->image)}}">  <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('MyCards',['id'=>Auth::user()->id])}}">My Event</a></li>
                                <li><a href="{{ route('Profile',['id'=>Auth::user()->id])}}">My Profile</a></li>
                                <li><a href="{{ route('EditMyProfile',['id'=>Auth::user()->id])}}">Edit Profile</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
        </nav>
        @yield('content')
    </div>
    
    @include('layouts.footer')
    <!-- Scripts -->
    <script src="{{ asset('js/main.js') }}"></script>
    {{-- <script type="text/javascript"  src="{{ asset('js/app.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/bootstrap.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/bootstrap.js') }}"></script> --}}
    
    <!-- page specific scripts -->
    @yield('pagescripts')
</body>
</html>
