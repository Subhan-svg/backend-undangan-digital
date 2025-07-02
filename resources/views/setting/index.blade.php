@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Website Settings</h1>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <form id="setting-form"
            action="{{ route('setting.update') }}" 
            method="POST" 
            enctype="multipart/form-data" 
            onsubmit="confirmSubmit('setting-form', 'Update Settings?', 'Make sure all settings data is correct')">
            @csrf
            
            <div class="mb-3">
                <label for="site_name" class="form-label">Nama Website</label>
                <input type="text" class="form-control @error('site_name') is-invalid @enderror" 
                       id="site_name" name="site_name" value="{{ old('site_name', $settings['site_name']) }}">
                @error('site_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="site_email" class="form-label">Email Website</label>
                <input type="email" class="form-control @error('site_email') is-invalid @enderror" 
                       id="site_email" name="site_email" value="{{ old('site_email', $settings['site_email']) }}">
                @error('site_email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="site_description" class="form-label">Deskripsi Website</label>
                <textarea class="form-control @error('site_description') is-invalid @enderror" 
                          id="site_description" name="site_description" rows="3">{{ old('site_description', $settings['site_description']) }}</textarea>
                <small class="text-muted">Deskripsi singkat tentang website Anda</small>
                @error('site_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="site_phone" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control @error('site_phone') is-invalid @enderror" 
                       id="site_phone" name="site_phone" value="{{ old('site_phone', $settings['site_phone']) }}">
                @error('site_phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="site_address" class="form-label">Alamat</label>
                <textarea class="form-control @error('site_address') is-invalid @enderror" 
                          name="site_address">{{ old('site_address', $settings['site_address']) }}</textarea>
                @error('site_address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="site_maps" class="form-label">Google Maps Embed URL</label>
                <input type="text" class="form-control @error('site_maps') is-invalid @enderror" 
                       id="site_maps" name="site_maps" value="{{ old('site_maps', $settings['site_maps']) }}">
                <small class="text-muted">Masukkan URL embed Google Maps (contoh: https://www.google.com/maps/embed?pb=...)</small>
                @error('site_maps')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            @if($settings['site_maps'])
            <div class="mb-3">
                <label class="form-label">Preview Maps</label>
                <div class="ratio ratio-16x9">
                    <iframe src="{{ $settings['site_maps'] }}" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            @endif

            <div class="mb-3">
                <label for="site_logo" class="form-label">Logo Website</label>
                @if($settings['site_logo'])
                    <div class="mb-2">
                        <img src="{{ asset($settings['site_logo']) }}" alt="Logo" class="img-thumbnail" style="max-height: 100px">
                    </div>
                @endif
                <input type="file" class="form-control @error('site_logo') is-invalid @enderror" 
                       id="site_logo" name="site_logo" onchange="previewImage(this, 'logo-preview')">
                <div class="mt-2">
                    <img id="logo-preview" src="#" alt="Preview Logo" class="img-thumbnail" style="max-height: 100px; display: none;">
                </div>
                <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB</small>
                @error('site_logo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="site_favicon" class="form-label">Favicon Website</label>
                @if($settings['site_favicon'])
                    <div class="mb-2">
                        <img src="{{ asset($settings['site_favicon']) }}" alt="Favicon" class="img-thumbnail" style="max-height: 32px">
                    </div>
                @endif
                <input type="file" class="form-control @error('site_favicon') is-invalid @enderror" 
                       id="site_favicon" name="site_favicon" onchange="previewImage(this, 'favicon-preview')">
                <div class="mt-2">
                    <img id="favicon-preview" src="#" alt="Preview Favicon" class="img-thumbnail" style="max-height: 32px; display: none;">
                </div>
                <small class="text-muted">Format: ICO, PNG. Maksimal 1MB</small>
                @error('site_favicon')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="site_header" class="form-label">Header Gambar Halaman</label>
                @if($settings['site_header'])
                    <div class="mb-2">
                        <img src="{{ asset($settings['site_header']) }}" alt="Page Header" class="img-thumbnail" style="max-height: 200px">
                    </div>
                @endif
                <input type="file" class="form-control @error('site_header') is-invalid @enderror" 
                       id="site_header" name="site_header" onchange="previewImage(this, 'header-preview')">
                <div class="mt-2">
                    <img id="header-preview" src="#" alt="Preview Header" class="img-thumbnail" style="max-height: 200px; display: none;">
                </div>
                <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB. Direkomendasikan ukuran 1920x300 pixel</small>
                @error('site_header')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="site_background_1" class="form-label">Background Gambar 1</label>
                @if($settings['site_background_1'])
                    <div class="mb-2">
                        <img src="{{ asset($settings['site_background_1']) }}" alt="Background 1" class="img-thumbnail" style="max-height: 200px">
                    </div>
                @endif
                <input type="file" class="form-control @error('site_background_1') is-invalid @enderror" 
                       id="site_background_1" name="site_background_1" onchange="previewImage(this, 'bg1-preview')">
                <div class="mt-2">
                    <img id="bg1-preview" src="#" alt="Preview Background 1" class="img-thumbnail" style="max-height: 200px; display: none;">
                </div>
                <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB. Direkomendasikan ukuran 1920x1080 pixel</small>
                @error('site_background_1')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="site_background_2" class="form-label">Background Gambar 2</label>
                @if($settings['site_background_2'])
                    <div class="mb-2">
                        <img src="{{ asset($settings['site_background_2']) }}" alt="Background 2" class="img-thumbnail" style="max-height: 200px">
                    </div>
                @endif
                <input type="file" class="form-control @error('site_background_2') is-invalid @enderror" 
                       id="site_background_2" name="site_background_2" onchange="previewImage(this, 'bg2-preview')">
                <div class="mt-2">
                    <img id="bg2-preview" src="#" alt="Preview Background 2" class="img-thumbnail" style="max-height: 200px; display: none;">
                </div>
                <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB. Direkomendasikan ukuran 1920x1080 pixel</small>
                @error('site_background_2')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <h4 class="mt-4 mb-3">Social Media</h4>

            <div class="mb-3">
                <label for="site_facebook" class="form-label">Facebook URL</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fab fa-facebook"></i></span>
                    <input type="url" class="form-control @error('site_facebook') is-invalid @enderror" 
                           id="site_facebook" name="site_facebook" value="{{ old('site_facebook', $settings['site_facebook']) }}"
                           placeholder="https://facebook.com/your-page">
                    @error('site_facebook')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="site_twitter" class="form-label">Twitter URL</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fab fa-twitter"></i></span>
                    <input type="url" class="form-control @error('site_twitter') is-invalid @enderror" 
                           id="site_twitter" name="site_twitter" value="{{ old('site_twitter', $settings['site_twitter']) }}"
                           placeholder="https://twitter.com/your-handle">
                    @error('site_twitter')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="site_tiktok" class="form-label">Tiktok URL</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fab fa-tiktok"></i></span>
                    <input type="url" class="form-control @error('site_tiktok') is-invalid @enderror" 
                           id="site_tiktok" name="site_tiktok" value="{{ old('site_tiktok', $settings['site_tiktok']) }}"
                           placeholder="https://tiktok.com/your-handle">
                    @error('site_tiktok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="site_instagram" class="form-label">Instagram URL</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                    <input type="url" class="form-control @error('site_instagram') is-invalid @enderror" 
                           id="site_instagram" name="site_instagram" value="{{ old('site_instagram', $settings['site_instagram']) }}"
                           placeholder="https://instagram.com/your-handle">
                    @error('site_instagram')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="site_youtube" class="form-label">YouTube URL</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fab fa-youtube"></i></span>
                    <input type="url" class="form-control @error('site_youtube') is-invalid @enderror" 
                           id="site_youtube" name="site_youtube" value="{{ old('site_youtube', $settings['site_youtube']) }}"
                           placeholder="https://youtube.com/c/your-channel">
                    @error('site_youtube')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="site_linkedin" class="form-label">LinkedIn URL</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fab fa-linkedin"></i></span>
                    <input type="url" class="form-control @error('site_linkedin') is-invalid @enderror" 
                           id="site_linkedin" name="site_linkedin" value="{{ old('site_linkedin', $settings['site_linkedin']) }}"
                           placeholder="https://linkedin.com/company/your-company">
                    @error('site_linkedin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- <h4 class="mt-4 mb-3">Site Titles & Subtitles</h4>

            @for ($i = 1; $i <= 15; $i++)
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="site_title_{{ $i }}" class="form-label">Site Title {{ $i }}</label>
                        <input type="text" class="form-control @error('site_title_'.$i) is-invalid @enderror" 
                               id="site_title_{{ $i }}" name="site_title_{{ $i }}" 
                               value="{{ old('site_title_'.$i, $settings['site_title_'.$i]) }}">
                        @error('site_title_'.$i)
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="site_subtitle_{{ $i }}" class="form-label">Site Subtitle {{ $i }}</label>
                        <input type="text" class="form-control @error('site_subtitle_'.$i) is-invalid @enderror" 
                               id="site_subtitle_{{ $i }}" name="site_subtitle_{{ $i }}" 
                               value="{{ old('site_subtitle_'.$i, $settings['site_subtitle_'.$i]) }}">
                        @error('site_subtitle_'.$i)
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            @endfor

            <h4 class="mt-4 mb-3">Site Buttons</h4>

            @for ($i = 1; $i <= 15; $i++)
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="site_button_text_{{ $i }}" class="form-label">Button Text {{ $i }}</label>
                        <input type="text" class="form-control @error('site_button_text_'.$i) is-invalid @enderror" 
                               id="site_button_text_{{ $i }}" name="site_button_text_{{ $i }}" 
                               value="{{ old('site_button_text_'.$i, $settings['site_button_text_'.$i]) }}"
                               placeholder="Enter button text">
                        @error('site_button_text_'.$i)
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="site_button_link_{{ $i }}" class="form-label">Button Link {{ $i }}</label>
                        <input type="url" class="form-control @error('site_button_link_'.$i) is-invalid @enderror" 
                               id="site_button_link_{{ $i }}" name="site_button_link_{{ $i }}" 
                               value="{{ old('site_button_link_'.$i, $settings['site_button_link_'.$i]) }}"
                               placeholder="https://example.com">
                        @error('site_button_link_'.$i)
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            @endfor --}}

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