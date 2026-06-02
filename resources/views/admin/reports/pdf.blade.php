<<<<<<< HEAD
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            font-size: 11px;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #1a4fd9;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #1a4fd9;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0 0;
            color: #666;
            font-size: 12px;
        }
        .meta {
            margin-bottom: 20px;
        }
        .meta table {
            width: 100%;
        }
        .meta td {
            padding: 2px 0;
        }
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table.data-table th {
            background-color: #f8fafc;
            color: #475569;
            text-transform: uppercase;
            font-size: 10px;
            font-weight: bold;
            padding: 10px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }
        table.data-table td {
            padding: 10px;
            border-bottom: 1px solid #f1f5f9;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .bold { font-weight: bold; }
        .text-primary { color: #1a4fd9; }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 9px;
            color: #94a3b8;
        }
        .badge {
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: bold;
            display: inline-block;
=======
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <style>
        @page {
            margin: 110px 36px 70px 36px;
        }

        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 11px;
            color: #1f2937;
        }

        .header {
            position: fixed;
            top: -82px;
            left: 0;
            right: 0;
            height: 72px;
            border-bottom: 2px solid #0d6efd;
        }

        .brand {
            font-size: 13px;
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .title {
            font-size: 22px;
            font-weight: bold;
            color: #0d6efd;
            margin: 0;
        }

        .subtle {
            color: #6b7280;
        }

        .meta {
            margin-top: 14px;
            margin-bottom: 14px;
            padding: 12px 14px;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
        }

        .meta table {
            width: 100%;
            border-collapse: collapse;
        }

        .meta td {
            padding: 2px 0;
            vertical-align: top;
        }

        table.report {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #d1d5db;
        }

        table.report th {
            background: #0d6efd;
            color: #ffffff;
            text-align: left;
            padding: 9px 8px;
            font-size: 10px;
            border: 1px solid #0b5ed7;
        }

        table.report td {
            border: 1px solid #d1d5db;
            padding: 8px;
            vertical-align: top;
        }

        table.report tr:nth-child(even) td {
            background: #f9fafb;
        }

        .footer {
            position: fixed;
            bottom: -42px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #6b7280;
            border-top: 1px solid #d1d5db;
            padding-top: 8px;
>>>>>>> e71cd57c4ed2d881c38b83c8049cbc5c9463f208
        }
    </style>
</head>
<body>
    <div class="header">
<<<<<<< HEAD
        <h1>Lumina Media</h1>
        <p>Laporan Penjualan Resmi</p>
=======
        <div class="title">Laporan Penjualan</div>
        <div class="subtle">Tanggal export: {{ $exportedAt->translatedFormat('d F Y H:i') }}</div>
>>>>>>> e71cd57c4ed2d881c38b83c8049cbc5c9463f208
    </div>

    <div class="meta">
        <table>
            <tr>
<<<<<<< HEAD
                <td width="50%">
                    <span class="bold">Judul Laporan:</span> {{ $title }}
                </td>
                <td width="50%" class="text-right">
                    <span class="bold">Tanggal Cetak:</span> {{ $date }}
                </td>
            </tr>
            <tr>
                <td>
                    <span class="bold">Total Transaksi:</span> {{ $orders->count() }}
                </td>
                <td class="text-right">
                    <span class="bold">Total Pendapatan (Sukses):</span> Rp {{ number_format($orders->where('status', 'verified')->sum('total_tagihan'), 0, ',', '.') }}
                </td>
=======
                <td width="170"><strong>Periode Laporan</strong></td>
                <td>:</td>
                <td>
                    {{ $filters['tanggal_awal'] ? \Illuminate\Support\Carbon::parse($filters['tanggal_awal'])->translatedFormat('d F Y') : 'Semua tanggal' }}
                    s/d
                    {{ $filters['tanggal_akhir'] ? \Illuminate\Support\Carbon::parse($filters['tanggal_akhir'])->translatedFormat('d F Y') : 'Semua tanggal' }}
                </td>
            </tr>
            <tr>
                <td><strong>Metode Pembayaran</strong></td>
                <td>:</td>
                <td>{{ $filters['metode_pembayaran'] ? \Illuminate\Support\Str::headline(str_replace('_', ' ', $filters['metode_pembayaran'])) : 'Semua metode' }}</td>
            </tr>
            <tr>
                <td><strong>Total Data</strong></td>
                <td>:</td>
                <td>{{ $reports->count() }} transaksi</td>
>>>>>>> e71cd57c4ed2d881c38b83c8049cbc5c9463f208
            </tr>
        </table>
    </div>

<<<<<<< HEAD
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 15%;">Order ID</th>
                <th style="width: 12%;">Tanggal</th>
                <th style="width: 20%;">Pelanggan</th>
                <th style="width: 28%;">Produk</th>
                <th style="width: 15%; text-align: right;">Jumlah</th>
                <th style="width: 10%; text-align: center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td class="bold text-primary" style="white-space: nowrap;">#ORD-{{ str_pad((string)$order->id, 8, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $order->tanggal_pesan->format('d M Y') }}</td>
                    <td>{{ $order->user->nama }}</td>
                    <td>
                        @php $firstItem = $order->orderDetails->first(); @endphp
                        {{ $firstItem ? $firstItem->book->judul : '-' }}
                        @if($order->orderDetails->count() > 1)
                            (+{{ $order->orderDetails->count() - 1 }})
                        @endif
                    </td>
                    <td class="text-right bold" style="white-space: nowrap;">
                        Rp {{ number_format($order->total_tagihan, 0, ',', '.') }}
                    </td>
                    <td class="text-center" style="white-space: nowrap;">
                        @if($order->status == 'verified')
                            SUKSES
                        @elseif($order->status == 'cancelled')
                            DIBATALKAN
                        @else
                            {{ strtoupper($order->status) }}
                        @endif
                    </td>
=======
    <table class="report">
        <thead>
            <tr>
                <th width="50">ID</th>
                <th width="120">Nama Pelanggan</th>
                <th>Produk yang Dibeli</th>
                <th width="60">Jumlah</th>
                <th width="90">Total Harga</th>
                <th width="95">Metode Pembayaran</th>
                <th width="105">Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
                <tr>
                    <td>#{{ $report['id_penjualan'] }}</td>
                    <td>{{ $report['nama_pelanggan'] }}</td>
                    <td>{{ $report['produk'] ?: '-' }}</td>
                    <td>{{ $report['jumlah_barang'] }}</td>
                    <td>Rp {{ number_format($report['total_harga'], 0, ',', '.') }}</td>
                    <td>{{ \Illuminate\Support\Str::headline(str_replace('_', ' ', $report['metode_pembayaran'])) }}</td>
                    <td>{{ $report['tanggal_transaksi']->translatedFormat('d M Y, H:i') }}</td>
>>>>>>> e71cd57c4ed2d881c38b83c8049cbc5c9463f208
                </tr>
            @endforeach
        </tbody>
    </table>

<<<<<<< HEAD
    <div class="footer">
        &copy; {{ date('Y') }} Lumina Media Dashboard. Seluruh hak cipta dilindungi undang-undang.
    </div>
</body>
</html>
=======
    <div class="footer">Halaman dicetak otomatis oleh sistem.</div>

    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->getFont('DejaVu Sans', 'normal');
            $pdf->page_text(650, 560, 'Halaman {PAGE_NUM} dari {PAGE_COUNT}', $font, 9, array(107, 114, 128));
        }
    </script>
</body>
</html>
>>>>>>> e71cd57c4ed2d881c38b83c8049cbc5c9463f208
