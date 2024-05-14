@extends('layout.layout')
@section('title','Home')
@section('content')
<div class="vh-80 d-flex justify-content-center align-items-center"><h2>Welcome Back {{ Auth::user()->name }}</h2></div>
@endsection

