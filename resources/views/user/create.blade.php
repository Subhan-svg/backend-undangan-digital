@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Add User</h1>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Roles</label>
                        <div class="row">
                            @foreach($roles as $role)
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input role-radio" type="radio" name="roles[]" value="{{ $role->name }}" id="role-{{ $role->id }}" {{ old('roles') && in_array($role->name, old('roles')) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="role-{{ $role->id }}">{{ $role->name }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @error('roles')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Create User</button>
                    <a href="{{ route('user') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    // Data permission per role dari backend
    const rolePermissions = @json($roles->mapWithKeys(function($role) {
        return [$role->name => $role->permissions->pluck('name')];
    }));

    function updatePermissionsByRoles() {
        // Ambil role yang dipilih
        let checkedRoles = [];
        $('.role-radio:checked').each(function() {
            checkedRoles.push($(this).val());
        });
        // Kumpulkan semua permission dari role terpilih
        let perms = new Set();
        checkedRoles.forEach(function(role) {
            (rolePermissions[role] || []).forEach(function(perm) {
                perms.add(perm);
            });
        });
        // Centang permission yang sesuai
        $('.permission-checkbox').each(function() {
            if (perms.has($(this).val())) {
                $(this).prop('checked', true);
            }
        });
    }

    $(function() {
        $('.role-radio').on('change', function() {
            updatePermissionsByRoles();
        });
    });
</script>
@endpush 