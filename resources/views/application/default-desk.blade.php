<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>postup desk</title>
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap-side-navbar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('css/tags.css') }}">
</head>
<body>
<input type="hidden" name="userKey" id="userKey" value="{{Auth::user()->api_token}}">
{{ csrf_field() }}
<div id="app">
  <router-view></router-view>
</div>
</div>
<script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js') }}"></script>
<script src="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js') }}"></script>
<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
<script src="{{ asset('js/ck-shared-toolbar.js') }}"></script>
<script src=" {{ asset('js/richcombo.js') }}"></script>
<script src="{{ asset('js/postup-automatisator.js') }}"></script>
<script src="{{ asset('js/sidenavbar.js') }}"></script>
<style  src="{{ asset('js/tags.js') }}"></style><!-- mailer tags lib -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.6.4/jquery.tinymce.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script>

</script>
</body>
</html>
