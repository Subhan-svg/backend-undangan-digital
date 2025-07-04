@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Add Permission</h1>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('permission.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="guard_name" class="form-label">Guard Name</label>
                        <input type="text" class="form-control" id="guard_name" name="guard_name" value="web" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('permission') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 