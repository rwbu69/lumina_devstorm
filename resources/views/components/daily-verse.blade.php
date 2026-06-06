@props(['verse'])

<section class="py-12 md:py-16 my-8 bg-gradient-to-br from-lumina-blue/5 to-transparent rounded-[3rem] border border-lumina-blue/10">
    <div class="text-center text-lumina-blue px-6">
        <div class="uppercase text-xs md:text-sm font-bold tracking-[0.2em] mb-4 text-lumina-blue/70">Ayat Harian</div>

        <div class="mx-auto max-w-4xl">
            <div class="text-2xl md:text-4xl font-serif font-medium italic leading-relaxed text-slate-800">"{{ $verse['teks'] }}"</div>
            <div class="text-sm md:text-base mt-6 font-semibold tracking-wide">— {{ $verse['kitab'] }}</div>
        </div>
    </div>
</section>
