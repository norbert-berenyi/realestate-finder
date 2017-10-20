<!doctype html>
<html lang="{{ app()->getLocale() }}">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Better Ingatlan.com</title>

        <link rel="stylesheet" href="/css/bulma.css" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    </head>

    <body>

        <nav class="navbar is-dark has-shadow" role="navigation" aria-label="main navigation" id="navbar">

            <div class="container">

                <div class="navbar-brand">

                    <a class="navbar-item" href="{{ url('/') }}">

                        <strong>Ingatlan<span class="has-text-primary">.com</span> improved</strong>

                    </a>

                    <span class="navbar-burger" :class="{'is-active':mobileMenu}" @click="mobileMenu = !mobileMenu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>

                </div> <!-- end of .navbar-brand -->

                <div class="navbar-menu" :class="{'is-active':mobileMenu}">

                    <div class="navbar-end">

                        @guest

                            <a class="navbar-item {{ url()->current() == url('login') ? 'is-active' : '' }}" href="{{ url('login') }}">
                                <span class="icon">
                                    <i class="fa fa-sign-in" aria-hidden="true"></i>
                                </span>
                                <span>Login</span>
                            </a>

                        @endif

                        @auth

                            <a class="navbar-item {{ url()->current() == url('unseen') ? 'is-active' : '' }}" href="{{ url('unseen') }}">
                                <span class="icon">
                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                </span>
                                <span>New adverts</span>
                            </a>

                            <a class="navbar-item {{ url()->current() == url('seen') ? 'is-active' : '' }}" href="{{ url('seen') }}">
                                <span class="icon">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </span>
                                <span>Seen adverts</span>
                            </a>

                            <a class="navbar-item {{ url()->current() == url('promising') ? 'is-active' : '' }}" href="{{ url('promising') }}">
                                <span class="icon">
                                    <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                </span>
                                <span>Liked by me</span>
                            </a>

                            <a href="{{ route('logout') }}" class="navbar-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="icon">
                                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                                </span>
                                <span>Logout</span>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>

                        @endif

                    </div>
                    
                </div>
                
            </div> <!-- end of .container -->

        </nav> <!-- end of .navbar -->

        <div id="app">

            @yield('content')

        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.4.2/vue.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.16.2/axios.min.js"></script>

        <script>
            var navbar = new Vue({
                el: '#navbar',

                data:
                {
                    mobileMenu: false,
                }
            });
        </script>

        @yield('js')

    </body>

</html>
