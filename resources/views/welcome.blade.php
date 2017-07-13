<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>post'up</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/landing/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/css/fill.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/css/custom.css') }}">

</head>
<body>
<div class="col-lg-12 navigation">
    <nav class="navbar navbar-inverse ">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><strong>Post</strong>'up</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <form class="navbar-form navbar-right">
                @if (Route::has('login'))
                    <!--<div class="top-right links">-->
                        @if (Auth::check())
                            <a href="{{ url('/desk') }}">Bureau</a>
                        @else
                            <a href="{{ url('/register') }}">s'inscrire</a> /
                            <a href="{{ url('/login') }}">se connecter</a>
                        @endif
                    <!--</div>-->
                    @endif
                </form>
            </div>
            <!--/.navbar-collapse -->
        </div>
    </nav>
</div>
<div class="col-lg-12 first-section landing-section">
    <div class="row">
        <div class="col-lg-6 contenu">
            <div class="decoration_un" style="
                font-size: 32px;
                font-weight: 300;
                width: auto;
                -webkit-background-clip: text;
                background: linear-gradient(90deg,rgb(255,199,23),rgb(255,58,140));
                background: -webkit-linear-gradient(90deg,rgb(255,199,23),rgb(255,58,140)); /* For Safari 5.1 to 6.0 */
                background: -o-linear-gradient(90deg,rgb(255,199,23),rgb(255,58,140)); /* For Opera 11.1 to 12.0 */
                background: -moz-linear-gradient(90deg,rgb(255,199,23),rgb(255,58,140)); /* For Firefox 3.6 to 15 */
                background: linear-gradient(90deg,rgb(255,199,23),rgb(255,58,140)); /* Standard syntax (must be last) */
                background-size: contain;
                ">
                <span >
                    <strong>Post</strong>'up ! <br>
                    Optimiser vos recherches d'emplois, <br>
                    en automatisant vos offres spontanées !
                </span>
            </div>
            <div id="bloc_text">
                <h4><strong>Editez, gérez, expédiez</strong> un dossier de candidature <strong>rapidement</strong></br></h4>
                <h4 class="testez">Tester notre application et<strong> profiter gratuitement d'un large choix d'adresses</strong> ciblés par domaine d'activité et région</h4>
            </div>
            </br>
            <button href="{ url('/login') }}" class="bttn-fill bttn-lg bttn-primary">tester tout de suite</button>
            <div class="col-lg 6 seconnecter">
                <a href="{{ url('/login') }}" class="seconnecter"> se connecter <img src="{{ asset('assets/landing/img/postup_login_img.svg') }}" style="width:3.4%;height:3.4%;"/>  </a>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div id="scene" style="height: 50%; padding-top: 100%; position: relative; top:50px;">
                <img id="landing-desktop-parallax" style="position: absolute; bottom: 100px; right: 10%; -webkit-filter: drop-shadow(1px 1px 2px #222);filter: drop-shadow(1px 1px 2px #222); " src="{{ asset('assets/landing/img/landing-desktop.png') }}" alt="" class="img img-responsive">
                <img id="landing-cloud-parallax" style="position: absolute; bottom: 0;right: 0" src="{{ asset('assets/landing/img/landing-cloud-illustration.png') }}" alt="" class="img img-responsive">
        </div>
    </div>
</div>

<div class="col-lg-12 conteneur_un">
    <div class="col-lg-4 contenu_un">
        <h2><strong> Ok et comment ca marche ?</strong></h2>
        <h3>C’est simple, une fois avoir paramétré votre compte, il vous faut créer un modèle </br>(un page A4)  sur lequel vous allez pouvoir écrire ou importer une lettre de motivation. </h3>
        </br>
        <h5>- modèle de adapté à vos recherches</h5>
        <h5>- gestion de vos dossier de candidature simplifiés</h5>
    </div>
    <div class="col-lg12">
    </div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/TweenMax.min.js"></script>
<script src="{{ asset('assets/landing/js/jquery-parallax.js') }}"></script>
<script>
    $( document ).mousemove( function( e ) {
        //$( '#landing-cloud-parallax' ).parallax( -70, e );
        $( '#landing-desktop-parallax' ).parallax( 50 , e );
    });
</script>
<script type="text/javascript">
    window.$crisp=[];window.CRISP_WEBSITE_ID="6325e890-727c-4921-afb4-e86fd74839b2";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();
</script>

</html>
