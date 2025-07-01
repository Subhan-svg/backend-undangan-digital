@extends('layouts.app')

@push('css')
    @include('layouts.partials.css')
    <style>
        body {
            background: linear-gradient(135deg, #6366f1 0%, #7f53ff 100%);
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }
        /* SVG Bubble Ornaments */
        .bubble-bg {
            position: absolute;
            z-index: 0;
            pointer-events: none;
        }
        .bubble1 { top: -80px; left: -80px; width: 300px; opacity: 0.25; }
        .bubble2 { bottom: -100px; right: -100px; width: 350px; opacity: 0.18; }
        .bubble3 { top: 60%; left: -120px; width: 200px; opacity: 0.13; }
        .bubble4 { bottom: 10%; right: 10%; width: 120px; opacity: 0.10; }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 1;
        }
        .login-card {
            border-radius: 2rem;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.25);
            background: rgba(255,255,255,0.18);
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
            border: 1.5px solid rgba(255,255,255,0.25);
            padding: 2.5rem 2rem 2rem 2rem;
            width: 100%;
            max-width: 410px;
            animation: slideFadeIn 0.8s cubic-bezier(.68,-0.55,.27,1.55);
            position: relative;
        }
        @keyframes slideFadeIn {
            0% { opacity: 0; transform: translateY(-40px) scale(0.95); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }
        .login-logo {
            display: flex;
            justify-content: center;
            margin-bottom: 1.2rem;
        }
        .login-logo img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            box-shadow: 0 4px 16px rgba(99,102,241,0.12);
            background: linear-gradient(135deg, #6366f1 0%, #7f53ff 100%);
            padding: 10px;
        }
        .login-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            color: #4f46e5;
            margin-bottom: 0.5rem;
            text-align: center;
            letter-spacing: 0.5px;
        }
        .login-tagline {
            text-align: center;
            color: #ffffff;
            font-size: 1.05rem;
            margin-bottom: 1.5rem;
            font-weight: 500;
            letter-spacing: 0.1px;
        }
        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            opacity: 1;
            transform: scale(.85) translateY(-1.5rem) translateX(.15rem);
            color: #6366f1;
        }
        .form-floating > label {
            transition: all 0.2s;
            opacity: 0.7;
            color: #64748b;
        }
        .form-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.10);
        }
        .btn-primary {
            background: linear-gradient(90deg, #6366f1 0%, #7f53ff 100%);
            border: none;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: background 0.2s, box-shadow 0.2s, transform 0.1s;
            box-shadow: 0 2px 8px rgba(99,102,241,0.10);
        }
        .btn-primary:hover, .btn-primary:focus {
            background: linear-gradient(90deg, #7f53ff 0%, #6366f1 100%);
            box-shadow: 0 4px 16px rgba(99,102,241,0.18);
            transform: translateY(-2px) scale(1.03);
        }
        .show-hide {
            cursor: pointer;
            color: #64748b;
            transition: color 0.2s;
        }
        .show-hide:hover {
            color: #6366f1;
        }
        .form-error {
            color: #ef4444;
            font-size: 0.95rem;
            margin-top: 0.25rem;
            animation: shake 0.3s;
        }
        @keyframes shake {
            10%, 90% { transform: translateX(-2px); }
            20%, 80% { transform: translateX(4px); }
            30%, 50%, 70% { transform: translateX(-8px); }
            40%, 60% { transform: translateX(8px); }
        }
    </style>
@endpush

@section('content')
<!-- SVG Bubble Background -->
<svg class="bubble-bg bubble1" viewBox="0 0 400 400" fill="none"><circle cx="200" cy="200" r="200" fill="#fff"/></svg>
<svg class="bubble-bg bubble2" viewBox="0 0 400 400" fill="none"><circle cx="200" cy="200" r="200" fill="#fff"/></svg>
<svg class="bubble-bg bubble3" viewBox="0 0 200 200" fill="none"><circle cx="100" cy="100" r="100" fill="#fff"/></svg>
<svg class="bubble-bg bubble4" viewBox="0 0 120 120" fill="none"><circle cx="60" cy="60" r="60" fill="#fff"/></svg>

<div class="login-container">
    <div class="login-card animate__animated animate__fadeInDown">
        <div class="login-logo">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Login Illustration">
        </div>
        <h2 class="login-title">Login</h2>
        <div class="login-tagline">Selamat datang kembali! <br> Silakan login untuk mengelola undangan digital Anda.</div>
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach(session('error') as $error)
                    <p>{{ $error }}</p>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form method="POST" action="{{ route('login.post') }}" id="loginForm" autocomplete="off" novalidate>
            @csrf
            <div class="form-floating mb-3 position-relative">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required autofocus>
                <label for="email">Email</label>
                <div class="form-error" id="emailError" style="display:none;"></div>
            </div>
            <div class="form-floating mb-3 position-relative">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <label for="password">Password</label>
                <span class="position-absolute top-50 end-0 translate-middle-y pe-3 show-hide" id="togglePassword" tabindex="0" title="Tampilkan/Sembunyikan Password">
                    <i class="fas fa-eye" id="eyeIcon"></i>
                </span>
            </div>
            <div class="d-grid mb-2">
                <button type="submit" class="btn btn-primary btn-lg" id="loginBtn">Login</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
    @include('layouts.partials.js')
    <script>
        // Show/hide password
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
            eyeIcon.classList.toggle('fa-eye');
            eyeIcon.classList.toggle('fa-eye-slash');
        });
        togglePassword.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') togglePassword.click();
        });

        // Email validation
        const emailInput = document.getElementById('email');
        const emailError = document.getElementById('emailError');
        emailInput.addEventListener('input', function() {
            const email = emailInput.value;
            if (email && !/^\S+@\S+\.\S+$/.test(email)) {
                emailError.textContent = 'Format email tidak valid';
                emailError.style.display = 'block';
            } else {
                emailError.textContent = '';
                emailError.style.display = 'none';
            }
        });

        // Form submit validation
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            if (emailInput.value && !/^\S+@\S+\.\S+$/.test(emailInput.value)) {
                emailError.textContent = 'Format email tidak valid';
                emailError.style.display = 'block';
                emailInput.focus();
                e.preventDefault();
            }
        });
    </script>
@endpush

@push('styles')
@endpush
