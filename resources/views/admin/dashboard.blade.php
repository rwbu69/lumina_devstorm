<x-admin.layout :title="'Lumina Media - Dashboard Admin'">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2 fw-bold text-primary mb-1" style="font-family: 'Playfair Display', serif;">Halaman Utama</h1>
            <p class="text-muted mb-0">Selamat datang kembali, Administrator.</p>
        </div>
        <button type="button" class="btn btn-white bg-white border rounded-3 px-3 py-2 shadow-sm d-flex align-items-center gap-2">
            <i class="bi bi-calendar3 text-muted"></i>
            <span class="fw-medium">{{ now()->translatedFormat('F Y') }}</span>
        </button>
    </div>

    {{-- KPI Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="text-uppercase fw-bold text-muted ls-wide" style="font-size: 0.7rem;">Total Penjualan</div>
                        <div class="p-1 px-2 rounded-2" style="background-color: #E8F0FE; color: #1a4fd9; font-size: 0.8rem;">
                            <i class="bi bi-credit-card"></i>
                        </div>
                    </div>
                    <div class="fs-4 fw-bold text-dark mb-1">
                        Rp {{ number_format($totalPenjualan, 0, ',', '.') }}
                    </div>
                    <div style="font-size: 0.75rem;">
                        @if($penjualanGrowth >= 0)
                            <span class="text-success fw-bold">+{{ $penjualanGrowth }}%</span>
                        @else
                            <span class="text-danger fw-bold">{{ $penjualanGrowth }}%</span>
                        @endif
                        <span class="text-muted"> vs bulan lalu</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="text-uppercase fw-bold text-muted ls-wide" style="font-size: 0.7rem;">Pengguna Aktif</div>
                        <div class="p-1 px-2 rounded-2" style="background-color: #E8F0FE; color: #1a4fd9; font-size: 0.8rem;">
                            <i class="bi bi-person-check"></i>
                        </div>
                    </div>
                    <div class="fs-4 fw-bold text-dark mb-1">
                        {{ number_format($totalPengguna, 0, ',', '.') }}
                    </div>
                    <div style="font-size: 0.75rem;">
                        @if($penggunaGrowth >= 0)
                            <span class="text-success fw-bold">+{{ $penggunaGrowth }}%</span>
                        @else
                            <span class="text-danger fw-bold">{{ $penggunaGrowth }}%</span>
                        @endif
                        <span class="text-muted"> vs bulan lalu</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="text-uppercase fw-bold text-muted ls-wide" style="font-size: 0.7rem;">Total Buku</div>
                        <div class="p-1 px-2 rounded-2" style="background-color: #E8F0FE; color: #1a4fd9; font-size: 0.8rem;">
                            <i class="bi bi-journal-bookmark"></i>
                        </div>
                    </div>
                    <div class="fs-4 fw-bold text-dark mb-1">
                        {{ number_format($totalBuku, 0, ',', '.') }}
                    </div>
                    <div style="font-size: 0.75rem;">
                        <span class="text-muted">judul tersedia di katalog</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart Section --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4 bg-white">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
                <div>
                    <h5 class="fw-bold text-dark mb-1">Pendapatan Bulanan</h5>
                    <p class="text-muted small mb-0">Analisis pendapatan 6 bulan terakhir dari transaksi berhasil</p>
                </div>
                <div class="text-end">
                    <div class="text-uppercase fw-bold text-muted ls-wide mb-0" style="font-size: 0.7rem;">Total Pendapatan</div>
                    <div class="fs-4 fw-bold text-primary">
                        Rp {{ number_format($totalInventaris, 0, ',', '.') }}
                    </div>
                </div>
            </div>

            <div style="height: 200px; position: relative;">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>

    {{-- Recent Activities --}}
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold text-dark mb-0">Aktivitas Terkini</h5>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-primary btn-sm px-3 rounded-3 shadow-sm fw-bold">Lihat Semua</a>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead style="background-color: #F9FAFB;">
                        <tr>
                            <th class="px-4 py-3 text-uppercase fw-bold text-muted border-0" style="font-size: 0.7rem;">Pelanggan</th>
                            <th class="px-4 py-3 text-uppercase fw-bold text-muted border-0" style="font-size: 0.7rem;">Buku</th>
                            <th class="px-4 py-3 text-uppercase fw-bold text-muted border-0 text-center" style="font-size: 0.7rem;">Status</th>
                            <th class="px-4 py-3 text-uppercase fw-bold text-muted border-0 text-end" style="font-size: 0.7rem;">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                            @php $firstItem = $order->orderDetails->first(); @endphp
                            <tr class="border-bottom">
                                <td class="px-4 py-3 fw-bold text-dark" style="font-size: 0.85rem;">
                                    {{ $order->user->nama }}
                                </td>
                                <td class="px-4 py-3 text-muted" style="font-size: 0.85rem;">
                                    {{ $firstItem ? $firstItem->book->judul : '-' }}
                                    @if($order->orderDetails->count() > 1)
                                        <span class="text-muted" style="font-size: 0.75rem;">(+{{ $order->orderDetails->count() - 1 }})</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <x-badge :status="$order->status" />
                                </td>
                                <td class="px-4 py-3 text-end fw-bold" style="font-size: 0.85rem;">
                                    Rp {{ number_format($order->total_tagihan, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-4 text-center text-muted small">
                                    Belum ada aktivitas transaksi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const labels  = @json($monthLabels);
            const data    = @json($monthlyRevenue);

            const ctx = document.getElementById('revenueChart').getContext('2d');

            const gradient = ctx.createLinearGradient(0, 0, 0, 200);
            gradient.addColorStop(0, 'rgba(26, 79, 217, 0.2)');
            gradient.addColorStop(1, 'rgba(26, 79, 217, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Pendapatan',
                        data: data,
                        borderColor: '#1a4fd9',
                        backgroundColor: gradient,
                        borderWidth: 2.5,
                        pointBackgroundColor: '#1a4fd9',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        fill: true,
                        tension: 0.4,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1a4fd9',
                            titleFont: { size: 12 },
                            bodyFont: { size: 13 },
                            callbacks: {
                                label: function(ctx) {
                                    const val = ctx.parsed.y;
                                    return ' Rp ' + val.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: { font: { size: 11 }, color: '#9CA3AF' }
                        },
                        y: {
                            grid: { color: '#F3F4F6', lineWidth: 1 },
                            ticks: {
                                font: { size: 11 },
                                color: '#9CA3AF',
                                callback: function(val) {
                                    if (val >= 1000000) return 'Rp ' + (val / 1000000).toFixed(1) + ' Jt';
                                    if (val >= 1000)    return 'Rp ' + (val / 1000).toFixed(0)   + ' Rb';
                                    return 'Rp ' + val;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
    @endpush
</x-admin.layout>
