<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
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
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            #join-session{
                margin-top:25px;
                padding: 25px;
                border: 2px solid black;
                border-radius: 20px;
            }

            .join-form{
                font-size:20px;
                font-weight:500;
            }
            /*.disclaimer-text{
                margin-bottom:3px;
            }*/
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Welcome To Delphi
                </div>

                <div class="links">
                    <a href="{{ route('about') }}">About Delphi</a>
                    @guest
                        <a href="{{ route('login') }}">{{ __('Login') }}</a>
                        <a href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                </div>

                
                <form id="join-session" action="{{ route('check') }}" method="POST">

                    <div class="join-form">
                        <div class="disclaimer-text"><strong>No reason to sign up! Start voting now:</strong> </div>
                        <br />
                        Enter Join Code: 
                        <input type="text" name="code" required>
                        <input type="submit" value="Submit">
                        @if ( !empty($errorMessage))
                            <p class="error-message"> @if($errorMessage == '1') Code does not exist! Please try another. @else You suck. @endif</p>
                        @endif
                    </div>

                </form
            </div>
        </div>
    </body>
</html>
