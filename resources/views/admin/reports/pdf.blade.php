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
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Laporan Penjualan</div>
        <div class="subtle">Tanggal export: {{ $exportedAt->translatedFormat('d F Y H:i') }}</div>
    </div>

    <div class="meta">
        <table>
            <tr>
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
            </tr>
        </table>
    </div>

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
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">Halaman dicetak otomatis oleh sistem.</div>

    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->getFont('DejaVu Sans', 'normal');
            $pdf->page_text(650, 560, 'Halaman {PAGE_NUM} dari {PAGE_COUNT}', $font, 9, array(107, 114, 128));
        }
    </script>
</body>
</html>