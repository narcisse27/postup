<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        #page{
            width: 210mm;
            height: 17mm;
            padding-left: 35mm;
            padding-right: 25mm;
            padding-bottom: 25mm;
            font-size: 12pt!important;
        }
        #sender{
            width: 150mm;
            height: 25mm;
        }
        #sender-data{
            width: 85mm;
        }
        #current-data {
            width: 65mm;
            height: 25mm;
        }
        #recipient-wraper{
            width: 65mm;
            height: 30mm;
            margin-left: 85mm;
        }
        #recipient-data{

        }
        #letter-object{
            width: 150mm;
            height: 15mm;
        }
        #letter-content{
            width: 150mm;
            height: auto;
            /*background-color: #a6e1ec;*/
        }
        #fantom-content{
            height: 0px;
            width: 0px;
        }
        #annexes-wrapper{
            width: 150mm;
            height: auto;
            position: fixed;
            bottom: 20mm;
            margin-bottom: 10mm;
        }

    </style>
</head>
<body>
<div id="page">
    <div id="sender">
        <p id="sender-data">
            {{ $user->firstname }} {{ $user->lastname }} <br>
            {{ $user->adresse }} <br>
            {{ $user->npa }} {{ $user->city }}
            @yield('sender')
        </p>
        <p id="current-data">
            {{ $user->city }} , le {{ date('d M Y') }}
        </p>
    </div>
    <div id="recipient-wraper">
        <p id="recipient-data">
            Titre du destinataire <br>
            Prénom Nom du destinataire <br>
            Adresse <br>
            NPA Localité
        </p>
    </div>
    <div id="letter-object">
        <p>{{ $data->object }}</p>
    </div>
    <div id="letter-content">
            {!!   $data->content  !!}
    </div>
    @if($appendices)
    <div id="annexes-wrapper">
        <strong>Annexes : </strong>
        <ul>
            @foreach($appendices as $appendice)
            <li>{{ $appendice->name }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div></div>
</div>
</body>
</html>
