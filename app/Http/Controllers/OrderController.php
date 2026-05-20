<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class OrderController extends Controller
{
    // Tugas Pertama Kamu (TIDAK DIHAPUS)
    public function show(Order $order): Response
    {
        return response('OrderController@show order_id='.$order->id.' (TODO)', 200);
    }

    // Menangani form saat tombol "Konfirmasi Pembayaran" diklik, lalu dilempar ke halaman sukses
    public function store(Request $request): RedirectResponse
    {
        return redirect()->route('payment.success');
    }

    // --- TAMBAHAN KODE BARU UNTUK HALAMAN VIEW ---

    // Menampilkan halaman Rincian Pemesanan (Checkout)
    public function checkout(): View
    {
        return view('checkout');
    }

    // Menampilkan halaman Sukses Pembayaran
    public function success(): View
    {
        return view('payment-success');
    }
}