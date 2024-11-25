<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="keyword" content="">
<link rel="icon" href="" type="image/x-icon"> 
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<link rel="stylesheet" href="{{ asset('assets/cssbundle/dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/cssbundle/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/cssbundle/bootstrapdatepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/avio-style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/rating/rating.css') }}">
<link rel="stylesheet" href="{{ asset('assets/summernote/summernote-lite.min.css') }}">
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<script src="{{ asset('/assets/js/plugins.js') }}"></script>
<style>
    .error{
        color:red;
    }
</style>
</head>