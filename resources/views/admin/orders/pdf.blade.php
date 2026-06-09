<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pesanan Lumina Media</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.5;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #1a4fd9;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            color: #1a4fd9;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0 0;
            color: #666;
        }
        .meta {
            margin-bottom: 20px;
        }
        .meta table {
            width: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
            color: #1a4fd9;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
        }
        .status {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-pending { background-color: #fff3cd; color: #856404; }
        .status-verified { background-color: #d4edda; color: #155724; }
        .status-cancelled { background-color: #f8d7da; color: #721c24; }
        .text-right { text-align: right; }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #999;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Lumina Media</h1>
        <p>Laporan Transaksi Pesanan</p>
    </div>

    <div class="meta">
        <table>
            <tr>
                <td><strong>Tanggal Cetak:</strong> {{ now()->format('d F Y H:i') }}</td>
                <td class="text-right"><strong>Total Pesanan:</strong> {{ $orders->count() }}</td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pembeli</th>
                <th>Tanggal Pesan</th>
                <th>Status</th>
                <th class="text-right">Total Bayar</th>
            </tr>
        </thead>
        <tbody>
            @php $totalRevenue = 0; @endphp
            @foreach($orders as $order)
                @php if($order->status == 'verified') $totalRevenue += $order->total_tagihan; @endphp
                <tr>
                    <td>#LM-{{ str_pad((string)$order->id, 8, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $order->user->nama }}</td>
                    <td>{{ $order->tanggal_pesan->format('d M Y') }}</td>
                    <td>
                        <span class="status status-{{ $order->status }}">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="text-right">Rp {{ number_format($order->total_tagihan, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-right"><strong>Total Pendapatan (Terverifikasi):</strong></td>
                <td class="text-right"><strong>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        Dicetak otomatis oleh Sistem Admin Lumina Media &bull; {{ now()->year }}
    </div>
</body>
</html>
