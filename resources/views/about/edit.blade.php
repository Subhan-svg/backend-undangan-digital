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
                action="{{ route('about.update', $about->slug)}}" 
                method="POST" 
                enctype="multipart/form-data" 
                onsubmit="confirmSubmit('about-form', 'Update Abouts?', 'Make sure all settings data is correct')">
                @csrf
                
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                        id="title" name="title" value="{{ old('title', $about['title']) }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                            id="description" name="description" rows="3">{{ old('description', $about['description']) }}</textarea>
                    <small class="text-muted">Deskripsi tentang website anda</small>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                        id="image" name="image" onchange="previewImage(this, 'about-image-preview', 'old-image-preview')">
                    @if($about->image)
                        <div class="mb-2 mt-2" id="old-image-preview">
                            <img src="{{ asset($about->image) }}" alt="About Image" class="img-thumbnail" style="max-height: 200px">
                        </div>
                    @endif
                    <div class="mt-2">
                        <img id="about-image-preview" src="#" alt="Preview About Image" class="img-thumbnail" style="max-height: 200px; display: none;">
                    </div>
                    <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>Update
                </button>
            </form>    
        </div>
    </div>
@endsection

@push('js')
<script>
function previewImage(input, previewId, oldimageId) {
    const preview = document.getElementById(previewId);
    const oldimage = document.getElementById(oldimageId);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            
            if (oldimage){
                oldimage.style.display = 'none';
            }
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '#';
        preview.style.display = 'none';
    }
}
</script>
@endpush 