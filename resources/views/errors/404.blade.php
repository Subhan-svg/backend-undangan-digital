@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')
@section('content')
<div class="container text-center py-5">
    <h1 class="display-1">404</h1>
    <h2 class="mb-4">Page Not Found</h2>
    <p class="mb-4">Sorry, the page you are looking for is not available or has been moved.</p>
    <a href="{{ url('/dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
</div>
@endsection 