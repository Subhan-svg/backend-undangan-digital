@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 fw-bold display-6">Dashboard</h1>
    <div class="mb-4">
        <p class="fs-5">Selamat Datang, <span class="fw-semibold text-primary">{{ Auth::user()->name }}</span>!</p>
    </div>
    <div class="row g-4 mb-5">
        <div class="col-12 col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width:56px; height:56px;">
                        <i class="fa fa-users text-primary fs-3"></i>
                    </div>
                    <div>
                        <div class="h3 mb-0">123</div>
                        <div class="text-secondary">Total User</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width:56px; height:56px;">
                        <i class="fa fa-cogs text-success fs-3"></i>
                    </div>
                    <div>
                        <div class="h3 mb-0">5</div>
                        <div class="text-secondary">Pengaturan</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width:56px; height:56px;">
                        <i class="fa fa-star text-warning fs-3"></i>
                    </div>
                    <div>
                        <div class="h3 mb-0">10</div>
                        <div class="text-secondary">Fitur Lain</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Chart Section -->
    <div class="card mb-5">
        <div class="card-header bg-white fw-bold">Statistik User Bulanan</div>
        <div class="card-body">
            <canvas id="userChart" height="100"></canvas>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <img src="https://undraw.co/api/illustrations/undraw_celebration_0jvk.svg" alt="Welcome Illustration" class="img-fluid" style="max-width:320px;">
    </div>
</div>
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('userChart').getContext('2d');
    const userChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'User Baru',
                data: [12, 19, 8, 15, 10, 14, 20, 18, 9, 13, 17, 11],
                backgroundColor: 'rgba(99, 102, 241, 0.7)',
                borderColor: 'rgba(99, 102, 241, 1)',
                borderWidth: 1,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 5 }
                }
            }
        }
    });
</script>
@endsection 