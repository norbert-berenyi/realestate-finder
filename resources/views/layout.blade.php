<!doctype html>
<html lang="{{ app()->getLocale() }}">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Better Ingatlan.com</title>

        <link rel="stylesheet" href="/css/bulma.css" />

    </head>

    <body>

        <nav class="navbar is-white has-shadow" role="navigation" aria-label="main navigation" id="navbar">

            <div class="container">

                <div class="navbar-brand">

                    <a class="navbar-item" href="http://bulma.io">

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

                        <a class="navbar-item {{ url()->current() == url('unseen') ? 'is-active' : '' }}" href="{{ url('unseen') }}">
                            New adverts
                        </a>

                        <a class="navbar-item {{ url()->current() == url('seen') ? 'is-active' : '' }}" href="{{ url('seen') }}">
                            Seen adverts
                        </a>

                        <a class="navbar-item {{ url()->current() == url('promising') ? 'is-active' : '' }}" href="{{ url('promising') }}">
                            Promising adverts
                        </a>

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
