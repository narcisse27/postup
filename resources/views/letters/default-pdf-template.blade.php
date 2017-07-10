<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        #page{
            width: 210mm;
            height: 297mm;
            padding-left: 35mm;
            padding-right: 25mm;
            padding-bottom: 25mm;
            font-size: 12pt!important;
        }
        #sender{
            width: 150mm;
            height: 25mm;
            background-color: #0a6ebd;
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
            background-color: red;
        }
        #recipient-data{

        }
        #letter-object{
            width: 150mm;
            height: 15mm;
            background-color: #2ab27b;
        }
        #letter-content{
            float: left;
            width: 150mm;
            height: 60mm;
            background-color: #a6e1ec;
        }
        p {
            width: 100%;
            height: auto;
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
    </div>
</div>
</body>
</html>
