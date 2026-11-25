@props(['title', 'subtitle' => null, 'word' => 'Welcome'])
<div class="container-x py-10 md:py-14">
    <div class="grid overflow-hidden rounded-[2rem] border border-white/[0.07] bg-ink-900 lg:grid-cols-2">
        {{-- Visual side --}}
        <div class="relative hidden min-h-[640px] overflow-hidden bg-ink-950 lg:block">
            <div class="absolute left-1/2 top-1/2 h-[70%] w-[70%] -translate-x-1/2 -translate-y-1/2 animate-glow rounded-full bg-ember/40 blur-[110px]"></div>
            <p class="pointer-events-none absolute inset-x-0 top-[16%] select-none text-center font-gothic text-[9rem] leading-none text-bone/90" aria-hidden="true">{{ $word }}</p>
            <div class="absolute inset-x-0 bottom-0 flex h-[85%] justify-center">
                <img src="/image/foto1.png" alt="" class="h-full w-auto animate-float object-contain object-bottom drop-shadow-[0_30px_60px_rgba(0,0,0,.8)]">
            </div>
            <div class="absolute bottom-8 left-8 right-8 flex items-end justify-between">
                <p class="font-display text-lg uppercase leading-snug tracking-wider text-bone">Dress<br>after dark.</p>
                <p class="eyebrow">MixxStore &middot; 2026</p>
            </div>
        </div>

        {{-- Form side --}}
        <div class="flex items-center px-6 py-14 sm:px-14">
            <div class="mx-auto w-full max-w-md animate-rise">
                <h1 class="heading-xl text-5xl md:text-6xl">{{ $title }}</h1>
                @if ($subtitle)
                    <p class="mt-4 text-sm text-bone-400">{{ $subtitle }}</p>
                @endif
                <div class="mt-10">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>
