@extends('admin.layouts.default-admin-layout')

@section('content')

    <h1>Importer entreprises depuis fichier excell</h1>
    <div class="input-group">
   <span class="input-group-btn">
     <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
       <i class="fa fa-picture-o"></i> Choose
     </a>
   </span>
        <input id="thumbnail" class="form-control" type="text" name="filepath">
    </div>
    <img id="holder" style="margin-top:15px;max-height:100px;">
    <hr>
    <button>Importer</button>
@endsection

@section('scripts')
    <script src="/vendor/laravel-filemanager/js/lfm.js"></script>
    <script>
        $('#lfm').filemanager('file');
    </script>

@endsection