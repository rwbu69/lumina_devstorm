<x-admin.layout :title="'Lumina Media - Dashboard Admin'">
    <div class="bg-[#FDFBF7] min-h-full">
        <x-admin.section-header :title="$pageTitle" subtitle="Selamat datang kembali, Administrator.">
            <button type="button"
                class="inline-flex items-center justify-center bg-white border border-slate-200 text-slate-700 px-4 py-2.5 rounded-full font-semibold shadow-sm hover:bg-slate-50 hover:border-slate-300 transition-all text-sm">
                <x-heroicon-o-calendar class="mr-2 text-lumina-blue size-5" />
                {{ $periodLabel }}
            </button>
        </x-admin.section-header>

        <div class="mt-8"></div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
            @foreach ($metrics as $metric)
                <x-admin.card class="h-full">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <div class="text-[0.7rem] font-bold text-slate-500 uppercase tracking-wider mb-2">
                                {{ $metric['label'] }}</div>
                            <div class="text-2xl font-bold text-slate-800 mb-2">{{ $metric['value'] }}</div>
                            <div
                                class="text-xs font-semibold @if ($metric['trend']['tone'] == 'success') text-emerald-600 @elseif($metric['trend']['tone'] == 'danger') text-rose-600 @else text-slate-500 @endif">
                                {{ $metric['trend']['label'] }} <span
                                    class="text-slate-400 font-medium">{{ $metric['trend']['note'] }}</span>
                            </div>
                        </div>


                    </div>
                </x-admin.card>
            @endforeach
        </div>

        <div class="mt-8"></div>

        <x-admin.card :no-body="true" class="p-6 lg:p-8">
            <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 mb-8">
                <div>
                    <h2 class="text-xl font-bold text-slate-800 mb-1">Pendapatan Bulanan</h2>
                    <div class="text-sm text-slate-500">Analisis pendapatan 6 bulan terakhir</div>
                </div>

                <div class="sm:text-right">
                    <div class="text-[0.7rem] font-bold text-slate-500 uppercase tracking-wider mb-1">Total Inventaris
                    </div>
                    <div class="text-2xl font-bold text-lumina-blue">{{ $inventoryValue }}</div>
                </div>
            </div>

            <div class="w-full h-[350px] relative">
                <canvas id="revenueChart"></canvas>
            </div>
        </x-admin.card>

        <div class="mt-8"></div>

        <x-admin.table :headers="['Pelanggan', 'Buku', 'Status', 'Jumlah']">
            <x-slot:header>
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <div class="font-bold text-slate-800 text-lg">Aktivitas Terkini</div>
                        <div class="text-sm text-slate-500 mt-1">Transaksi terbaru yang masuk ke sistem</div>
                    </div>

                    <a href="{{ route('admin.orders.index') }}"
                        class="inline-flex items-center justify-center bg-lumina-blue hover:bg-blue-800 text-white px-5 py-2.5 rounded-xl font-bold text-sm shadow-sm transition-all">Lihat
                        Semua</a>
                </div>
                <div class="flex items-center gap-2 mt-3 text-xs text-slate-400 sm:hidden">
                    <x-heroicon-o-arrows-right-left class="size-5" />
                    Geser kiri kanan untuk melihat tabel.
                </div>
            </x-slot:header>

            @forelse ($recentActivities as $activity)
                <tr class="hover:bg-slate-50/50 transition-colors group">
                    <td class="px-6 py-4">
                        <div class="font-semibold text-slate-800 group-hover:text-lumina-blue transition-colors">
                            {{ $activity['customer'] }}</div>
                        <div class="text-xs text-slate-500 mt-1">{{ $activity['dateLabel'] }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-semibold text-slate-700 truncate max-w-xs">{{ $activity['bookSummary'] }}</div>
                        <div class="text-xs text-slate-500 mt-1">
                            {{ $activity['bookCount'] }} buku @if (!empty($activity['paymentLabel']))
                                • {{ $activity['paymentLabel'] }}
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <x-badge :status="$activity['status']" />
                    </td>
                    <td class="px-6 py-4 font-bold text-slate-800">
                        {{ $activity['amount'] }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-12">
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                <x-heroicon-o-receipt-percent class="size-10 text-slate-300" />
                            </div>
                            <div class="font-bold text-slate-800 text-lg mb-1">Data belum tersedia</div>
                            <div class="text-slate-500 text-sm">Belum ada aktivitas transaksi yang dapat ditampilkan.
                            </div>
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
                            backgroundColor: '#1e293b',
                            padding: 12,
                            titleFont: {
                                size: 13,
                                family: "'Inter', sans-serif"
                            },
                            bodyFont: {
                                size: 14,
                                family: "'Inter', sans-serif",
                                weight: 'bold'
                            },
                            cornerRadius: 8,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += new Intl.NumberFormat('id-ID', {
                                            style: 'currency',
                                            currency: 'IDR',
                                            minimumFractionDigits: 0
                                        }).format(context.parsed.y);
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
                                color: 'rgba(0,0,0,0.04)',
                                drawBorder: false,
                            },
                            ticks: {
                                font: {
                                    family: "'Inter', sans-serif",
                                    size: 11
                                },
                                color: '#64748b',
                                callback: function(value) {
                                    return new Intl.NumberFormat('id-ID', {
                                        style: 'currency',
                                        currency: 'IDR',
                                        minimumFractionDigits: 0
                                    }).format(value);
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false,
                            },
                            ticks: {
                                font: {
                                    family: "'Inter', sans-serif",
                                    size: 12
                                },
                                color: '#64748b'
                            }
                        }
                    }
                }
            });
        </script>
    @endpush
</x-admin.layout>
