@extends('admin.layout')

@section('content')

@php
    // ===============================
    // DUMMY STATISTIK (UBAH DI SINI)
    // ===============================
    $stats = [
        [
            'title' => 'Total Pustaka',
            'value' => 4 ,
            'icon'  => 'fas fa-book',
            'color' => 'primary',
            'tooltip' => 'Jumlah total koleksi pustaka'
        ],
        [
            'title' => 'Total Pengarang',
            'value' => 4,
            'icon'  => 'fas fa-pen-nib',
            'color' => 'success',
            'tooltip' => 'Jumlah pengarang terdaftar'
        ],
        [
            'title' => 'Total Transaksi',
            'value' => 3,
            'icon'  => 'fas fa-exchange-alt',
            'color' => 'warning',
            'tooltip' => 'Total transaksi peminjaman'
        ],
        [
            'title' => 'Total Anggota',
            'value' => 7,
            'icon'  => 'fas fa-users',
            'color' => 'info',
            'tooltip' => 'Jumlah anggota aktif'
        ],
    ];
@endphp

<div class="container-fluid mt-4">

    <!-- STAT CARD -->
    <div class="row g-4 mb-4">
        @foreach ($stats as $stat)
        <div class="col-xl-3 col-md-6">
            <div class="stat-card neo {{ $stat['color'] }}"
                 data-bs-toggle="tooltip"
                 title="{{ $stat['tooltip'] }}">
                <div class="content">
                    <div class="icon-box">
                        <i class="{{ $stat['icon'] }}"></i>
                    </div>
                    <div class="text">
                        <span>{{ $stat['title'] }}</span>
                        <h3>{{ $stat['value'] }}</h3>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- CHART -->
    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="chart-card">
                <h5>Statistik Perpustakaan</h5>
                <canvas id="barChart"></canvas>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="chart-card">
                <h5>Distribusi Data</h5>
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>

</div>

<style>
/* ===== CARD ===== */
.stat-card.neo {
    height: 130px;
    border-radius: 22px;
    padding: 22px;
    color: #fff;
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(14px);
    box-shadow: 0 20px 50px rgba(0,0,0,.2);
    transition: all .4s ease;
}

.stat-card.neo::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at top right, rgba(255,255,255,.35), transparent 55%);
    opacity: .8;
}

.stat-card.neo:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 35px 80px rgba(0,0,0,.35);
}

/* ===== CONTENT ===== */
.content {
    position: relative;
    z-index: 1;
    display: flex;
    align-items: center;
    height: 100%;
}

/* ===== ICON ===== */
.icon-box {
    width: 62px;
    height: 62px;
    border-radius: 18px;
    display: grid;
    place-items: center;
    font-size: 28px;
    background: rgba(255,255,255,.25);
    box-shadow: inset 0 0 20px rgba(255,255,255,.2);
    transition: all .35s ease;
}

.stat-card:hover .icon-box {
    transform: rotate(-5deg) scale(1.12);
}

/* ===== TEXT ===== */
.text {
    margin-left: 16px;
}

.text span {
    font-size: 13px;
    opacity: .9;
}

.text h3 {
    margin: 2px 0 0;
    font-weight: 800;
    font-size: 30px;
}

/* ===== COLORS ===== */
.primary { background: linear-gradient(135deg,#4f46e5,#1e1b4b); }
.success { background: linear-gradient(135deg,#22c55e,#14532d); }
.warning { background: linear-gradient(135deg,#fbbf24,#92400e); }
.info    { background: linear-gradient(135deg,#06b6d4,#164e63); }

/* ===== CHART CARD ===== */
.chart-card {
    background: #fff;
    border-radius: 20px;
    padding: 24px;
    box-shadow: 0 20px 40px rgba(0,0,0,.08);
}

.chart-card h5 {
    font-weight: 700;
    margin-bottom: 16px;
}

/* ===== MOBILE ===== */
@media (max-width:768px) {
    .stat-card.neo {
        height: auto;
    }
}
</style>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // Bootstrap Tooltip
    if (typeof bootstrap !== 'undefined') {
        [...document.querySelectorAll('[data-bs-toggle="tooltip"]')]
            .map(el => new bootstrap.Tooltip(el));
    }

    // ===============================
    // DATA DUMMY DARI BLADE
    // ===============================
    const labels = @json(array_column($stats, 'title'));
    const values = @json(array_column($stats, 'value'));

    // BAR CHART
    const barCtx = document.getElementById('barChart');
    if (barCtx) {
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah',
                    data: values,
                    backgroundColor: [
                        '#4f46e5',
                        '#22c55e',
                        '#fbbf24',
                        '#06b6d4'
                    ],
                    borderRadius: 10
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                }
            }
        });
    }

    // PIE / DOUGHNUT CHART
    const pieCtx = document.getElementById('pieChart');
    if (pieCtx) {
        new Chart(pieCtx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: values,
                    backgroundColor: [
                        '#4f46e5',
                        '#22c55e',
                        '#fbbf24',
                        '#06b6d4'
                    ]
                }]
            },
            options: {
                responsive: true,
                cutout: '65%'
            }
        });
    }

});
</script>


@endsection
