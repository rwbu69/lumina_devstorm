<x-admin.layout :title="'Lumina Media - Dashboard Admin'">
    <x-admin.section-header
        title="Halaman Utama"
        subtitle="Selamat datang kembali, Administrator."
    >
        <button type="button" class="btn btn-light border rounded-3">
            <i class="bi bi-calendar3 me-2"></i>
            Oktober 2023
        </button>
    </x-admin.section-header>

    <div class="mt-4"></div>

    <div class="row g-3 g-lg-4">
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card lm-card rounded-4 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <div class="text-uppercase small lm-muted fw-semibold">Total Penjualan</div>
                            <div class="mt-2 fs-4 fw-bold">Rp 12.450.000</div>
                            <div class="small text-success mt-1">+12,5% <span class="lm-muted">vs bulan lalu</span></div>
                        </div>
                        <div class="lm-kpi-icon">
                            <i class="bi bi-credit-card"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3">
            <div class="card lm-card rounded-4 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <div class="text-uppercase small lm-muted fw-semibold">Pengguna Aktif</div>
                            <div class="mt-2 fs-4 fw-bold">1.284</div>
                            <div class="small text-success mt-1">+5,2% <span class="lm-muted">vs bulan lalu</span></div>
                        </div>
                        <div class="lm-kpi-icon">
                            <i class="bi bi-person-check"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3">
            <div class="card lm-card rounded-4 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <div class="text-uppercase small lm-muted fw-semibold">Total Buku</div>
                            <div class="mt-2 fs-4 fw-bold">452</div>
                            <div class="small text-success mt-1">+2,1% <span class="lm-muted">stok baru tersedia</span></div>
                        </div>
                        <div class="lm-kpi-icon">
                            <i class="bi bi-journal-bookmark"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3">
            <div class="card lm-card rounded-4 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <div class="text-uppercase small lm-muted fw-semibold">Pengembalian</div>
                            <div class="mt-2 fs-4 fw-bold">3</div>
                            <div class="small text-danger mt-1">-0,8% <span class="lm-muted">dibanding pekan lalu</span></div>
                        </div>
                        <div class="lm-kpi-icon">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="lm-chart p-4 p-lg-5">
                <div class="d-flex align-items-start justify-content-between flex-wrap gap-3">
                    <div>
                        <div class="fw-bold">Pendapatan Bulanan</div>
                        <div class="small lm-muted">Analisis pendapatan 6 bulan terakhir</div>
                    </div>
                    <div class="text-end">
                        <div class="text-uppercase small lm-muted fw-semibold">Total Inventaris</div>
                        <div class="fs-5 fw-bold text-primary">Rp 48.200.000</div>
                    </div>
                </div>

                <div class="mt-4" style="height:230px; border:1px dashed rgba(0,0,0,.15); border-radius:14px; display:grid; place-items:center; background:rgba(255,255,255,.7);">
                    <div class="text-center">
                        <div class="fw-semibold">Grafik belum dihubungkan</div>
                        <div class="small lm-muted">Siapkan integrasi Chart.js / ApexCharts saat data laporan sudah siap</div>
                    </div>
                </div>

                <div class="d-flex justify-content-between small lm-muted mt-4 px-1">
                    <span>Jan</span><span>Feb</span><span>Mar</span><span>Apr</span><span>Mei</span><span>Jun</span>
                </div>
            </div>
        </div>

        <div class="col-12">
            <x-table :headers="['Pelanggan', 'Buku', 'Status', 'Jumlah']">
                <x-slot:header>
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                        <div class="fw-bold">Aktivitas Terkini</div>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-primary rounded-3">Lihat Semua</a>
                    </div>
                </x-slot:header>

                <tr>
                    <td class="fw-semibold">Budi Santoso</td>
                    <td class="text-secondary">Filosofi Teras</td>
                    <td><x-badge status="Selesai" /></td>
                    <td class="text-end fw-semibold">Rp 98.000</td>
                </tr>
                <tr>
                    <td class="fw-semibold">Siti Aminah</td>
                    <td class="text-secondary">Laskar Pelangi</td>
                    <td><x-badge status="Proses" /></td>
                    <td class="text-end fw-semibold">Rp 85.000</td>
                </tr>
                <tr>
                    <td class="fw-semibold">Andi Wijaya</td>
                    <td class="text-secondary">Bumi Manusia</td>
                    <td><x-badge status="Selesai" /></td>
                    <td class="text-end fw-semibold">Rp 120.000</td>
                </tr>
                <tr>
                    <td class="fw-semibold">Rina Kurnia</td>
                    <td class="text-secondary">Dasar-Dasar Laravel 11</td>
                    <td><x-badge status="Dibatalkan" /></td>
                    <td class="text-end fw-semibold">Rp 150.000</td>
                </tr>
            </x-table>
        </div>
    </div>
</x-admin.layout>
