@php
    $links = [
        ['/', 'Home', request()->is('/')],
        ['/categories', 'Categories', request()->is('categories')],
        ['/products', 'Shop', request()->is('products*')],
    ];
@endphp
<header id="site-nav" class="group/nav sticky top-0 z-50 w-full border-b border-white/[0.06] bg-ink-950/75 backdrop-blur-xl transition-colors [&.is-scrolled]:bg-ink-950/95">
    <nav class="container-x" aria-label="Global">
        <div class="relative md:flex md:h-[72px] md:items-center md:justify-between">
            <div class="flex h-16 items-center justify-between md:h-auto">
                <a wire:navigate href="/" class="group flex items-baseline gap-1" aria-label="MixxStore home">
                    <span class="font-gothic text-[30px] leading-none text-bone transition group-hover:text-ember">Mixx</span>
                    <span class="font-display text-lg uppercase tracking-[0.2em] text-bone-400">Store</span>
                </a>
                <div class="flex items-center gap-2 md:hidden">
                    <a wire:navigate href="/cart" class="relative btn-icon h-10 w-10" aria-label="Cart">
                        <svg class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007Z"/></svg>
                        <span class="absolute -right-1 -top-1 flex h-5 min-w-5 items-center justify-center rounded-full bg-ember px-1 text-[10px] font-bold text-white">{{ $total_count }}</span>
                    </a>
                    <button type="button" class="hs-collapse-toggle btn-icon h-10 w-10" data-hs-collapse="#navbar-collapse" aria-controls="navbar-collapse" aria-label="Toggle navigation">
                        <svg class="hs-collapse-open:hidden h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 7h16M4 12h16M4 17h10"/></svg>
                        <svg class="hs-collapse-open:block hidden h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>

            <div id="navbar-collapse" class="hs-collapse hidden basis-full grow overflow-hidden transition-all duration-300 md:block">
                <div class="flex flex-col gap-1 pb-5 md:flex-row md:items-center md:justify-end md:gap-2 md:pb-0">
                    @foreach ($links as [$href, $label, $active])
                        <a wire:navigate href="{{ $href }}"
                           class="relative rounded-full px-4 py-2.5 text-xs font-semibold uppercase tracking-widest2 transition {{ $active ? 'text-white' : 'text-bone-400 hover:text-white' }}">
                            {{ $label }}
                            @if ($active)
                                <span class="absolute inset-x-4 -bottom-px hidden h-px bg-ember md:block"></span>
                            @endif
                        </a>
                    @endforeach

                    <span class="mx-3 hidden h-6 w-px bg-white/10 md:block"></span>

                    <a wire:navigate href="/cart"
                       class="hidden items-center gap-2 rounded-full border border-white/10 py-2 pe-2 ps-4 text-xs font-semibold uppercase tracking-widest2 transition hover:border-ember md:inline-flex {{ request()->is('cart') ? 'text-white border-ember' : 'text-bone-300' }}">
                        Cart
                        <span class="flex h-6 min-w-6 items-center justify-center rounded-full bg-ember px-1.5 text-[11px] font-bold tracking-normal text-white">{{ $total_count }}</span>
                    </a>

                    @guest
                        <a wire:navigate href="/login" class="btn-light mt-2 px-5 py-2.5 text-xs md:ms-2 md:mt-0">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            Log in
                        </a>
                    @endguest

                    @auth
                        <div class="hs-dropdown relative mt-2 [--adaptive:none] [--strategy:static] md:ms-2 md:mt-0 md:[--strategy:fixed] md:[--trigger:hover]">
                            <button type="button" class="hs-dropdown-toggle flex w-full items-center gap-2.5 rounded-full border border-white/10 py-1.5 pe-3 ps-1.5 text-sm text-bone transition hover:border-ember">
                                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-ember font-display text-sm text-white">{{ strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}</span>
                                <span class="max-w-[9rem] truncate font-medium">{{ auth()->user()->name }}</span>
                                <svg class="ms-auto h-4 w-4 text-bone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>
                            </button>
                            <div class="hs-dropdown-menu z-10 mt-2 hidden min-w-52 rounded-2xl border border-white/10 bg-ink-850 p-2 opacity-0 shadow-2xl transition-[opacity,margin] duration-150 before:absolute before:-top-4 before:start-0 before:h-4 before:w-full hs-dropdown-open:opacity-100">
                                <a wire:navigate href="/my-orders" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-bone-300 hover:bg-white/5 hover:text-white">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M20 7 12 3 4 7m16 0-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                    My Orders
                                </a>
                                <a href="/logout" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-bone-300 hover:bg-white/5 hover:text-ember-300">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4M10 17l5-5-5-5M15 12H3"/></svg>
                                    Logout
                                </a>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>
