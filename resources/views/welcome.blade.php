<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Stallions</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                background: url(../image/entertainment.jpg) no-repeat !important;
                background-size: cover;
                color: black;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
                
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
                color: rgba(68, 68, 68, 0.918);
            }

            .links > a {
                color: rgb(170, 90, 58);
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .links > a:hover {
                color: rgba(80, 80, 80, 0.918);
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}" style="color: white;">Home</a>
                    @else
                        <a href="{{ route('login') }}" style="color: white;">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" style="color: white;">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div>
                    <img src="/logo/icon-yel.png" style="width:150px;">
                 </div>
                <div style="font-weight: lighter; font-size:40px; color:white; padding-bottom:20px;">
                    stallions
                </div>
                
                <div class="title m-b-md pt-10">
                    One Place, All Events
                </div>
                
                <div class="links">
                    <a href="/event">Browse Events</a>
                    <a href="#">About Us</a>
                    <a href="#">Documentation</a>
                    <a href="#">How It Works</a>
                </div>
            </div>
        </div>
    </body>
</html>
