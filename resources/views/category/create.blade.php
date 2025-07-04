@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1> Category</h1>
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
            <a href="{{ route('category')}}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>Back</a>
          </div>
        </div>
    
        <div class="card-body">
            <form id="category-form"
            action="{{ route('category.store') }}" 
            method="POST" 
            enctype="multipart/form-data" 
            onsubmit="confirmSubmit('category-form', 'Update Category?', 'Make sure all category data is correct')">
            @csrf
            
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                       id="title" name="title">
                @error('title')
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