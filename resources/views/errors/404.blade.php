@extends('layouts.app')
@section('content')
<div class="container text-center py-5">
    <h1 class="display-1">404</h1>
    <h2 class="mb-4">Halaman Tidak Ditemukan</h2>
    <p class="mb-4">Maaf, halaman yang kamu cari tidak tersedia atau sudah dipindahkan.</p>
    <a href="{{ url('/') }}" class="btn btn-primary">Kembali ke Beranda</a>
</div>
@endsection 