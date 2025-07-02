@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')
    <div class="container">
        <h1 class="mb-4">About</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="card-title">About</h4>
                <a href="{{ route('about') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>Back</a>
            </div>
        </div>

        <div class="card-body">
            <form id="about-form"
                action="{{ route('about.store') }}" 
                method="POST" 
                enctype="multipart/form-data" 
                onsubmit="confirmSubmit('about-form', 'Update Abouts?', 'Make sure all settings data is correct')">
                @csrf
                
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                        id="title" name="title">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                            id="description" name="description" rows="3"></textarea>
                    <small class="text-muted">Deskripsi tentang website anda</small>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                        id="image" name="image" onchange="previewImage(this, 'about-image-preview')">
                    <div class="mt-2">
                        <img id="about-image-preview" src="#" alt="Preview About Image" class="img-thumbnail" style="max-height: 100px; display: none;">
                    </div>
                    <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>Save
                </button>
            </form>    
        </div>
    </div>
@endsection

@push('js')
<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '#';
        preview.style.display = 'none';
    }
}
</script>
@endpush 