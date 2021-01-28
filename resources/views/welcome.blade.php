<!doctype html>

<html lang="{{ app()->getLocale() }}">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- from the original code -->
        <!-- CSRF Token -->
        <meta property="og:title" content="Prokakis Ebos-SG App 2020" /> 
        <meta property="og:url" content="https://app-prokakis.com/" /> 
        <meta property="og:site_name" content="Prokakis"/> 
        <meta property="og:image" content="https://app-prokakis.com/public/img-resources/ProKakisNewLogo.png" /> 
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

                height: 100%;

                margin: 0;

            }



            .full-height {

                /*height: 100vh;*/

            }



            .flex-center {

                align-items: center;

                /*display: flex;*/

                justify-content: center;

                bottom: 150px;

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
                margin-bottom: 130px;
                margin-top: -85px;
            }


            @media only screen and (max-width: 426px) {
                .content_text{
                   font-size: 40px;
                   padding: 42px;
                  font-weight: lighter;
                }

                .content_text2{
                   font-size: 30px;
                   font-weight: bolder;
                   bottom: 0;
                   margin-left: 90px;
                   margin-top: -30px;
                }

                .content_copyright{
                    font-size: 20px;
                    margin-left: 
                }

                #logo{
                    width: 70%;
                }

                .back_url{
                    font-size: 14px;
                    /*position: fixed;*/
                    /*margin-left: 80px;*/
                    margin-top: 50px
                }

            }


            @media screen and (min-width: 768px){
                .welcome{
                    margin-top: 235px;
                }
                .content_text{
                      /*padding: 15px;*/
                    font-size: 70px;
        
                }

                 .content_text2{
                   font-size: 50px;
                   font-weight: bolder;
                   bottom: 0;
                   margin-left: 160px;
                   margin-top: -30px;
                }



                .content_copyright{
                    font-size: 35px;
                }


                #logo{
                    width: 30%;
                }

                .back_url{
                    text-align: center;
                    font-size: 14px;
                    position: absolute;
                    margin-left: 30em;
                    margin-top: -5em
                }
            }

     /* Add a black background color to the top navigation */
            .topnav {
              background-color: #1a4275;
              overflow: hidden;
            }

            /* Style the links inside the navigation bar */
            .topnav a {
              float: right;
              color: #f2f2f2;
              text-align: center;
              padding: 14px 16px;
              text-decoration: none;
              font-size: 17px;
            }

            /* Change the color of links on hover */
            .topnav a:hover {
              background-color: #ddd;
              color: black;
            }

            /* Add a color to the active/current link */
            .topnav a.active {
              background-color: #4CAF50;
              color: white;
            }

    #intro {
        height: 100%;
    }

    .hero-image {

          background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("{{ asset('public/banner/hero.png') }}");
          height: 300px;

          background-position: left;
          background-repeat: no-repeat;
          background-size: cover;
          position: relative;

    }

    @media (max-width: 767px)  {


        .hero-image {
            height: 147px;
            margin-top: 235px;
        }

        .m-b-md{
            margin-bottom: 0px;
        }

        .content_text{
            padding: 0px;
        }
            }

        </style>

    </head>

    <body>


            @if (Route::has('login'))

                <div class="topnav links">

                    @auth

                        <a href="{{ url('/home') }}"> >> PROKAKIS APP Dashboard</a>

                    @else

                        <a href="{{ route('login') }}">Login</a>

                        <a href="{{ route('register') }}">Register</a>

                    @endauth

                </div>

            @endif

        <div class="flex-center position-ref full-height">


            <div class="content">
                <div class="title m-b-md">

                    <div class="content_text welcome">
                        <div class="hero-image">
                          <div class="hero-text">
                &nbsp;
                          </div>
                        </div>
                    </div>
                    <div>
                      <img src="https://app-prokakis.com/public/img-resources/ProKakisNewLogo.png" alt="Prokakis" id="logo" width="200px"> 

                        <div class="content_text2">
                            Ebos-SG 
                            <div class="content_copyright">
                                App <?php echo date("Y");?>
                            </div>
                        </div>
                  </div >
                </div>
                <div class="back_url">
                   <a href="https://prokakis.com/" style="text-decoration: none;"><b> >> Back to main website</b></a>
                </div>
            </div>

        </div>

    </body>

</html>

