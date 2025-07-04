@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Service</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <a href="{{ route('service') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back </a>
            </div>
        </div>

        <div class="card-body">
            <form id="service-form" action="{{ route('service.store') }}" 
                method="POST" 
                enctype="multipart/form-data"
                onsubmit="confirmSubmit('service-form', 'Add Services?', 'Make sure all services data is correct')">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{ old('title') }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi Service Website</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                        name="description" rows="3">{{ old('description') }}</textarea>
                    <small class="text-muted">Deskripsi untuk layanan service website anda</small>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                       id="image" name="image" onchange="previewImage(this, 'service-image-preview')">
                    <div class="mt-2">
                        <img id="service-image-preview" src="#" alt="Preview Service Image" class="img-thumbnail" style="max-height: 200px; display: none;">
                    </div>
                    <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB. Direkomendasikan ukuran 1920x1080 pixel</small>
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save
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