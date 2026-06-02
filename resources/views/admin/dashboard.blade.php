<x-admin.layout :title="'Lumina Media - Dashboard Admin'">
    @push('styles')
        <style>
            .dashboard-shell {
                
                border-radius: 20px;
                padding: 16px;
            }

            .dashboard-panel,
            .dashboard-graph,
            .dashboard-table-card {
                border: 1px solid rgba(15, 23, 42, .08);
                border-radius: 20px;
                background: rgba(255, 255, 255, .92);
                box-shadow: 0 14px 28px rgba(15, 23, 42, .05);
            }

            .dashboard-title {
                margin: 0;
                color: #1a4fd9;
                font-size: 1.75rem;
                font-weight: 800;
                line-height: 1.05;
                letter-spacing: -.03em;
            }

            .dashboard-subtitle {
                margin-top: .4rem;
                color: #1a4fd9 !important;
                font-size: 0.95rem;
                font-weight: 500;
            }

            .dashboard-date-btn {
                min-height: 44px;
                border-radius: 999px;
                padding-inline: 1rem;
                box-shadow: 0 10px 20px rgba(21, 89, 199, .12);
            }

            .dashboard-kpi-icon {
                width: 42px;
                height: 42px;
                border-radius: 12px;
                display: grid;
                place-items: center;
                background: rgba(21, 89, 199, .10);
                color: #1559c7;
                flex: 0 0 auto;
            }

            .dashboard-kpi-label {
                color: rgba(17, 24, 39, .52);
                font-size: .76rem;
                font-weight: 700;
                letter-spacing: .08em;
                text-transform: uppercase;
            }

            .dashboard-kpi-value {
                margin-top: .65rem;
                font-size: clamp(1.85rem, 3vw, 2.25rem);
                font-weight: 800;
                line-height: 1;
                letter-spacing: -.04em;
                color: #111827;
            }

            .dashboard-kpi-note {
                margin-top: .45rem;
            }

            .dashboard-graph {
                overflow: hidden;
            }

            .dashboard-graph-head {
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
                gap: 1rem;
                flex-wrap: wrap;
            }

            .dashboard-graph-title {
                margin: 0;
                color: #111827;
                font-size: 1.05rem;
                font-weight: 800;
            }

            .dashboard-graph-subtitle {
                margin-top: .3rem;
                color: rgba(17, 24, 39, .58);
                font-size: .92rem;
            }

            .dashboard-graph-summary {
                text-align: right;
            }

            .dashboard-graph-label {
                color: rgba(17, 24, 39, .52);
                font-size: .76rem;
                font-weight: 700;
                letter-spacing: .08em;
                text-transform: uppercase;
            }

            .dashboard-graph-value {
                margin-top: .2rem;
                color: #1559c7;
                font-size: clamp(1.35rem, 2vw, 1.8rem);
                font-weight: 800;
                letter-spacing: -.04em;
            }

            .dashboard-graph-area {
                min-height: 260px;
                display: grid;
                align-items: end;
                padding-top: 1.4rem;
            }

            .dashboard-graph-plot {
                display: grid;
                grid-template-columns: repeat(6, minmax(0, 1fr));
                gap: .9rem;
                align-items: end;
            }

            .dashboard-block-column {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: end;
                gap: .65rem;
            }

            .dashboard-block-stack {
                width: 100%;
                max-width: 76px;
                display: grid;
                grid-template-rows: repeat(5, 1fr);
                gap: .28rem;
                padding: .3rem;
                border-radius: 18px;
                background: rgba(21, 89, 199, .05);
                min-height: 220px;
            }

            .dashboard-block {
                aspect-ratio: 1 / 1;
                border-radius: 11px;
                background: rgba(21, 89, 199, .08);
                border: 1px solid rgba(21, 89, 199, .12);
                transition: transform .2s ease, background-color .2s ease, box-shadow .2s ease;
            }

            .dashboard-block.is-active {
                background: linear-gradient(180deg, #1559c7 0%, #5b8df4 100%);
                border-color: transparent;
                box-shadow: 0 10px 18px rgba(21, 89, 199, .22);
            }

            .dashboard-block-column:hover .dashboard-block.is-active {
                transform: translateY(-2px);
            }

            .dashboard-block-label {
                color: rgba(17, 24, 39, .72);
                font-size: .82rem;
                font-weight: 700;
            }

            .dashboard-block-amount {
                color: rgba(17, 24, 39, .55);
                font-size: .76rem;
            }

            .dashboard-table-card .card-header {
                padding: 14px 16px 10px;
            }

            .dashboard-table-card .table-responsive {
                overflow-x: auto;
                overflow-y: hidden;
                -webkit-overflow-scrolling: touch;
            }

            .dashboard-table-card .table {
                min-width: 860px;
                margin-bottom: 0;
                table-layout: fixed;
            }

            .dashboard-table-card .table thead th,
            .dashboard-table-card .table tbody td {
                text-align: center;
                vertical-align: middle;
            }

            .dashboard-table-card .table thead th:first-child,
            .dashboard-table-card .table tbody td:first-child {
                text-align: center;
            }

            .dashboard-table-card .table thead th {
                color: rgba(17, 24, 39, .52);
                font-size: .75rem;
                letter-spacing: .08em;
                padding-top: 14px;
                padding-bottom: 14px;
            }

            .dashboard-table-card .table tbody td {
                padding-top: 16px;
                padding-bottom: 16px;
                border-color: rgba(15, 23, 42, .05);
            }

            .dashboard-table-card tbody tr:hover {
                background: rgba(13, 110, 253, .02);
            }

            .dashboard-muted {
                color: rgba(17, 24, 39, .58);
            }

            .dashboard-scroll-hint {
                display: none;
                align-items: center;
                gap: .5rem;
                margin-top: .5rem;
                color: rgba(17, 24, 39, .58);
                font-size: .82rem;
            }

            @media (max-width: 991.98px) {
                .dashboard-shell {
                    border-radius: 20px;
                    padding: 14px;
                }

                .dashboard-graph-summary {
                    text-align: left;
                }

                .dashboard-scroll-hint {
                    display: inline-flex;
                }
            }

            @media (max-width: 767.98px) {
                .dashboard-graph-plot {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }

                .dashboard-table-card .card-header,
                .dashboard-table-card .table thead th,
                .dashboard-table-card .table tbody td {
                    padding-inline: 14px;
                }
            }
        </style>
    @endpush

    <div class="dashboard-shell">
        <x-admin.section-header
            :title="$pageTitle"
            subtitle="Selamat datang kembali, Administrator."
        >
            <button type="button" class="btn btn-light border dashboard-date-btn">
                <i class="bi bi-calendar3 me-2"></i>
                {{ $periodLabel }}
            </button>
        </x-admin.section-header>

        <div class="mt-4"></div>

        <div class="row g-3 g-xl-4">
            @foreach ($metrics as $metric)
                <div class="col-12 col-md-6 col-xl-4">
                    <x-admin.card class="dashboard-panel h-100">
                        <div class="d-flex align-items-start justify-content-between gap-3">
                            <div>
                                <div class="dashboard-kpi-label">{{ $metric['label'] }}</div>
                                <div class="dashboard-kpi-value">{{ $metric['value'] }}</div>
                                <div class="dashboard-kpi-note small text-{{ $metric['trend']['tone'] }}">
                                    {{ $metric['trend']['label'] }} <span class="dashboard-muted">{{ $metric['trend']['note'] }}</span>
                                </div>
                            </div>

                            <div class="dashboard-kpi-icon">
                                <i class="bi {{ $metric['icon'] }}"></i>
                            </div>
                        </div>
                    </x-admin.card>
                </div>
            @endforeach
        </div>

        <div class="mt-4"></div>

        <x-admin.card :no-body="true" class="dashboard-graph p-4 p-lg-5">
            <div class="dashboard-graph-head">
                <div>
                    <h2 class="dashboard-graph-title">Pendapatan Bulanan</h2>
                    <div class="dashboard-graph-subtitle">Analisis pendapatan 6 bulan terakhir</div>
                </div>

                <div class="dashboard-graph-summary">
                    <div class="dashboard-graph-label">Total Inventaris</div>
                    <div class="dashboard-graph-value">{{ $inventoryValue }}</div>
                </div>
            </div>

            <div class="dashboard-graph-area" style="height: 350px;">
                <canvas id="revenueChart"></canvas>
            </div>
        </x-admin.card>

        <div class="mt-4"></div>

        <x-admin.table :headers="['Pelanggan', 'Buku', 'Status', 'Jumlah']" class="dashboard-table-card">
            <x-slot:header>
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 text-center text-sm-start">
                    <div>
                        <div class="fw-bold text-dark">Aktivitas Terkini</div>
                        <div class="small dashboard-muted">Transaksi terbaru yang masuk ke sistem</div>
                    </div>

                    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary rounded-3">Lihat Semua</a>
                </div>
                <div class="dashboard-scroll-hint">
                    <i class="bi bi-arrow-left-right"></i>
                    Geser kiri kanan untuk melihat kolom lain.
                </div>
            </x-slot:header>

            @forelse ($recentActivities as $activity)
                <tr>
                    <td>
                        <div class="fw-semibold">{{ $activity['customer'] }}</div>
                        <div class="small dashboard-muted">{{ $activity['dateLabel'] }}</div>
                    </td>
                    <td>
                        <div class="fw-semibold">{{ $activity['bookSummary'] }}</div>
                        <div class="small dashboard-muted">
                            {{ $activity['bookCount'] }} buku @if (! empty($activity['paymentLabel'])) • {{ $activity['paymentLabel'] }} @endif
                        </div>
                    </td>
                    <td><x-badge :status="$activity['status']" class="d-inline-flex" /></td>
                    <td class="fw-semibold">{{ $activity['amount'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="py-5">
                        <div class="text-center">
                            <div class="fw-semibold">Data belum tersedia</div>
                            <div class="dashboard-muted small">Belum ada aktivitas transaksi yang dapat ditampilkan.</div>
                        </div>
                    </td>
                </tr>
            @endforelse
        </x-admin.table>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 0, 350);
        gradient.addColorStop(0, 'rgba(26, 79, 217, 0.2)');
        gradient.addColorStop(1, 'rgba(26, 79, 217, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: {!! json_encode($chartData) !!},
                    borderColor: '#1a4fd9',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#1a4fd9',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0,0,0,0.05)',
                            drawBorder: false,
                        },
                        ticks: {
                            callback: function(value) {
                                if (value >= 1000000) {
                                    return 'Rp ' + (value / 1000000) + ' Jt';
                                } else if (value >= 1000) {
                                    return 'Rp ' + (value / 1000) + ' Rb';
                                }
                                return 'Rp ' + value;
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false,
                        }
                    }
                }
            }
        });
    </script>
    @endpush
</x-admin.layout>
