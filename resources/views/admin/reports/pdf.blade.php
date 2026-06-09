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
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Lumina Media</h1>
        <p>Laporan Penjualan Resmi</p>
    </div>

    <div class="meta">
        <table>
            <tr>
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
            </tr>
        </table>
    </div>

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
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        &copy; {{ date('Y') }} Lumina Media Dashboard. Seluruh hak cipta dilindungi undang-undang.
    </div>
</body>
</html>
