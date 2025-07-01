@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard</h1>
    
    <p>Selamat datang, {{ Auth::user()->name }}!</p>
</div>
@endsection 