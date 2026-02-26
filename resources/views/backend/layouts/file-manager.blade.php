@extends('backend.layouts.master')
@section('title','KHAYRAT || Gestionnaire de fichiers')
@section('main-content')
    <div class="container-fluid">
        <iframe src="/laravel-filemanager?type=image" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
    </div>
@endsection