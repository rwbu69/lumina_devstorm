<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12" style="display: flex; justify-content: center;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="width: 100%; max-width: 500px;">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); border: 1px solid #e2e8f0;">
                <div class="p-6 text-gray-900" style="padding: 30px; text-align: center;">
                    
                    <p style="font-size: 14px; color: #10b981; font-weight: 600; margin-bottom: 8px;">✓ {{ __("You're logged in!") }}</p>
                    
                    <div style="margin-top: 15px; padding: 20px; background-color: #f8fafc; border-radius: 8px; border: 1px dashed #cbd5e1;">
                        <h3 style="font-size: 16px; font-weight: 700; color: #1e293b; margin-bottom: 5px;">Simulasi Pembayaran Buku</h3>
                        <p style="font-size: 12px; color: #64748b; margin-bottom: 15px;">Klik tombol di bawah untuk melihat rincian pemesanan sebelum pembayaran.</p>
                        
                        <a href="{{ route('checkout') }}" style="display: block; text-decoration: none; text-align: center; background-color: #1e40af; color: white; padding: 12px 24px; border-radius: 6px; font-weight: 600; font-size: 14px; cursor: pointer; transition: background 0.2s; box-shadow: 0 4px 6px -1px rgba(30, 64, 175, 0.2);">
                            Bayar Sekarang
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>