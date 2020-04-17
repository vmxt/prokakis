<!doctype html>

<html lang="{{ app()->getLocale() }}">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- from the original code -->
        <!-- CSRF Token -->
        <meta property="og:title" content="Prokakis Ebos-SG App 2020" /> 
        <meta property="og:url" content="https://app.prokakis.com/" /> 
        <meta property="og:site_name" content="Prokakis"/> 
        <meta property="og:image" content="https://app.prokakis.com/public/img-resources/ProKakisNewLogo.png" /> 
        <meta property="og:type" content="website" /> 
        <meta property="og:description" content="1st Platform to Buy / Sell / Invest / Source Fund and Market Business Online with KYB Due Diligence done all in one place to safeguard your business." />
        <!-- end from the original code -->

        <meta content="Uncover Your Hidden Business Opportunities, Protect yourself from Fraudulent Partners,Safe and Secure Business Opportunities, On-Going Business Intelligence Assessment, Form New Partnerships for Growth, Minimise Infiltration of Criminal Syndicates" name="description" />

        <meta content="Ebos-SG App 2020" name="author" />



        <title>Prokakis Welcome Page</title>



        <!-- Fonts -->

        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">



        <!-- Styles -->

        <style>

            html, body {

                background-color: #fff;

                color: #636b6f;

                font-family: 'Raleway', sans-serif;

                font-weight: 100;

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

                font-size: 12px;

                font-weight: 600;

                letter-spacing: .1rem;

                text-decoration: none;

                text-transform: uppercase;

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

                        <a href="{{ url('/home') }}"> >> PROKAKIS APP Dashboard</a>

                    @else

                        <a href="{{ route('login') }}">Login</a>

                        <a href="{{ route('register') }}">Register</a>

                    @endauth

                </div>

            @endif



            <div class="content">


                <div class="title m-b-md">





                 Welcome to <br /> <img src="https://app.prokakis.com/public/img-resources/ProKakisNewLogo.png" alt="Prokakis" id="logo" width="200px"> <br /> Ebos-SG App 2020

                </div>
 <br />
                   <a href="https://prokakis.com/" style="text-decoration: none;"><b> >> Back to main website</b></a>




               

            </div>

        </div>

    </body>

</html>

