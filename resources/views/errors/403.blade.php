@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')
@section('content')
<div class="container text-center py-5">
    <h1 class="display-1">403</h1>
    <h2 class="mb-4">Akses Ditolak</h2>
    <p class="mb-4">Kamu tidak memiliki izin untuk mengakses halaman ini.</p>
    <a href="{{ url('/') }}" class="btn btn-primary">Kembali ke Beranda</a>
</div>
@endsection 