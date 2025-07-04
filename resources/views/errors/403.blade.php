@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')
@section('content')
<div class="container text-center py-5">
    <h1 class="display-1">403</h1>
    <h2 class="mb-4">Access Denied</h2>
    <p class="mb-4">You do not have permission to access this page.</p>
    <a href="{{ url('/dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
</div>
@endsection 