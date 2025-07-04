@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>About</h1>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <form id="about-form"
            @if ($aboutcount > 0)
                action="{{ route('about.update', $about->slug) }}" 
            @else
                action="{{ route('about.store') }}" 
            @endif
            method="POST" 
            enctype="multipart/form-data" 
            onsubmit="confirmSubmit('about-form', 'Update About?', 'Make sure all about data is correct')">
            @csrf
            
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                       id="title" name="title" value="{{ old('title', $aboutcount > 0 ? $about->title : '') }}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          name="description">{{ old('description', $aboutcount > 0 ? $about->description : '') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                @if ($aboutcount > 0)
                    @if($about->image)
                        <div class="mb-2">
                            <img src="{{ asset($about->image) }}" alt="Logo" class="img-thumbnail" style="max-height: 100px">
                        </div>
                    @endif
                @endif
                <input type="file" class="form-control @error('image') is-invalid @enderror" 
                       id="image" name="image" onchange="previewImage(this, 'image-preview')">
                <div class="mt-2">
                    <img id="image-preview" src="#" alt="Preview Logo" class="img-thumbnail" style="max-height: 100px; display: none;">
                </div>
                <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB</small>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan Pengaturan
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