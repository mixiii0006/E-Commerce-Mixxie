<footer class="relative mt-24 overflow-hidden border-t border-white/[0.06] bg-ink-950">
    {{-- Trust bar --}}
    <div class="border-b border-white/[0.06]">
        <div class="container-x grid grid-cols-2 divide-white/[0.06] lg:grid-cols-4 lg:divide-x">
            @foreach ([
                ['Free shipping', 'On orders over $100', 'M3 7h11v8H3zM14 10h4l3 3v2h-7M6.5 18a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Zm11 0a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z'],
                ['14-day returns', 'No questions asked', 'M3 12a9 9 0 1 0 3-6.7L3 8m0-5v5h5'],
                ['Authentic pieces', 'Sourced from the houses', 'M12 3 4 7v5c0 4.5 3.4 8.3 8 9 4.6-.7 8-4.5 8-9V7l-8-4Zm-3 9 2 2 4-4'],
                ['Secure checkout', 'Card via Stripe or COD', 'M5 11h14v10H5zM8 11V7a4 4 0 1 1 8 0v4'],
            ] as [$title, $sub, $icon])
                <div class="flex items-center gap-4 px-2 py-7 lg:px-8">
                    <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full border border-white/10 text-ember-400">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $icon }}"/></svg>
                    </span>
                    <div>
                        <p class="text-sm font-semibold text-bone">{{ $title }}</p>
                        <p class="text-xs text-bone-500">{{ $sub }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container-x grid gap-12 py-16 lg:grid-cols-12">
        <div class="lg:col-span-4">
            <a wire:navigate href="/" class="flex items-baseline gap-1">
                <span class="font-gothic text-4xl text-bone">Mixx</span>
                <span class="font-display text-xl uppercase tracking-[0.2em] text-bone-400">Store</span>
            </a>
            <p class="mt-5 max-w-sm text-sm leading-relaxed text-bone-500">
                Gothic, punk and Victorian-inspired fashion for those who dress after dark. Clothing, footwear and jewelry, curated from independent houses.
            </p>
            <div class="mt-6 flex gap-2">
                <a href="https://github.com/mixiii0006" target="_blank" rel="noopener" class="btn-icon h-10 w-10" aria-label="GitHub">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 16 16"><path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z"/></svg>
                </a>
                <a href="#" class="btn-icon h-10 w-10" aria-label="Instagram">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r=".6" fill="currentColor"/></svg>
                </a>
                <a href="#" class="btn-icon h-10 w-10" aria-label="TikTok">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M16.6 5.8A4.3 4.3 0 0 1 15.5 3h-3.1v12.4a2.6 2.6 0 1 1-2.6-2.6c.3 0 .5 0 .8.1V9.7a5.7 5.7 0 1 0 4.9 5.7V9.1a7.3 7.3 0 0 0 4.3 1.4V7.4a4.3 4.3 0 0 1-3.2-1.6Z"/></svg>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-8 sm:grid-cols-3 lg:col-span-5">
            @foreach ([
                'Shop' => [['/products', 'All products'], ['/categories', 'Categories'], ['/products?featured=1', 'Featured'], ['/products?on_sale=1', 'On sale']],
                'Account' => [['/login', 'Sign in'], ['/register', 'Create account'], ['/my-orders', 'My orders'], ['/cart', 'Cart']],
                'House' => [['#', 'About'], ['#', 'Journal'], ['#', 'Size guide'], ['#', 'Contact']],
            ] as $heading => $items)
                <div>
                    <h4 class="eyebrow mb-5 text-bone">{{ $heading }}</h4>
                    <ul class="space-y-3 text-sm">
                        @foreach ($items as [$href, $label])
                            <li><a @if ($href !== '#') wire:navigate @endif href="{{ $href }}" class="text-bone-500 transition hover:text-ember-300">{{ $label }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <div class="lg:col-span-3">
            <h4 class="eyebrow mb-5 text-bone">Join the coven</h4>
            <p class="text-sm text-bone-500">Early access to drops and members-only pricing.</p>
            <a wire:navigate href="/register" class="btn-primary mt-5 w-full">Become a member</a>
        </div>
    </div>

    {{-- Oversized wordmark --}}
    <div class="pointer-events-none select-none overflow-hidden" aria-hidden="true">
        <p class="-mb-[0.22em] whitespace-nowrap text-center font-gothic text-[22vw] leading-[0.8] text-ember/90">MixxStore</p>
    </div>

    <div class="relative border-t border-white/[0.06] bg-ink-950">
        <div class="container-x flex flex-col items-center justify-between gap-2 py-5 text-xs text-bone-500 sm:flex-row">
            <p>&copy; {{ date('Y') }} MixxStore. All rights reserved.</p>
            <p>Built with Laravel, Livewire &amp; Filament</p>
        </div>
    </div>
</footer>
