@props(['verse'])

<section class="py-4 py-lg-5">
    <div class="text-center text-primary" style="color: var(--lm-primary); font-family: 'Playfair Display', serif;">
        <div class="text-uppercase small fw-semibold mb-2">AYAT HARIAN</div>

        <div class="mx-auto" style="max-width: 820px;">
            <div class="fw-semibold">"{{ $verse['teks'] }}"</div>
            <div class="small mt-3">— {{ $verse['kitab'] }}</div>
        </div>
    </div>
</section>
