@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Add Role</h1>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('role.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="guard_name" class="form-label">Guard Name</label>
                        <input type="text" class="form-control" id="guard_name" name="guard_name" value="web" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Permissions</label>
                        <div class="row">
                            @foreach($permissions as $permission)
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="perm-{{ $permission->id }}">
                                        <label class="form-check-label" for="perm-{{ $permission->id }}">{{ $permission->name }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('role') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 