<div>
    {{-- ============ HERO ============ --}}
    <section class="relative isolate overflow-hidden bg-ink-950">
        {{-- glow + grid --}}
        <div class="pointer-events-none absolute inset-0 -z-10">
            <div class="absolute left-1/2 top-[55%] h-[70vmin] w-[70vmin] -translate-x-1/2 -translate-y-1/2 animate-glow rounded-full bg-ember/40 blur-[120px]"></div>
            <div class="absolute inset-0 opacity-[0.07] [background-image:linear-gradient(to_right,#ece6dc_1px,transparent_1px)] [background-size:calc(100%/6)_100%]"></div>
        </div>

        <div class="relative mx-auto flex h-[calc(100svh-72px)] min-h-[640px] max-h-[880px] max-w-[110rem] flex-col">
            {{-- top row --}}
            <div class="container-x relative z-30 flex items-start justify-between pt-8 lg:pt-12">
                <div class="animate-rise">
                    <p class="eyebrow text-ember-400">New collection &mdash; 2026</p>
                    <p class="mt-4 font-display text-base uppercase leading-snug tracking-wider text-bone sm:text-lg">
                        Darkness is worn.<br>Style is earned.<br>Legends are made.
                    </p>
                    <span class="mt-4 block h-px w-10 bg-bone/40"></span>
                </div>
                <div class="hidden animate-rise text-right [animation-delay:.15s] md:block">
                    <p class="eyebrow">Gothic &middot; Punk &middot; Victorian</p>
                    <p class="mt-3 font-gothic text-3xl text-bone/80">Est. 2024</p>
                </div>
            </div>

            {{-- giant word, solid behind the statue --}}
            <div class="pointer-events-none absolute inset-x-0 top-[30%] z-0 select-none text-center md:top-[24%]" aria-hidden="true">
                <p class="heading-xl animate-rise whitespace-nowrap text-[25vw] text-bone/95 [animation-delay:.1s] md:text-[19vw] 2xl:text-[17rem]">Shadows</p>
            </div>

            {{-- statue --}}
            <div class="pointer-events-none absolute inset-x-0 bottom-0 z-10 flex h-[62%] justify-center md:h-[92%]">
                <img src="/image/foto3.png" alt="Angel statue"
                     class="h-full w-auto animate-float object-contain object-bottom drop-shadow-[0_30px_60px_rgba(0,0,0,.8)]">
            </div>

            {{-- outline copy of the word, in front of the statue --}}
            <div class="pointer-events-none absolute inset-x-0 top-[30%] z-20 select-none text-center md:top-[24%]" aria-hidden="true">
                <p class="heading-xl stroke-text animate-rise whitespace-nowrap text-[25vw] [animation-delay:.1s] md:text-[19vw] 2xl:text-[17rem]">Shadows</p>
            </div>

            {{-- painted clouds over the bottom edge: blurred, faded top; bottom melts into the page --}}
            <div class="pointer-events-none absolute inset-x-0 bottom-0 z-[25] clouds-mask h-[max(20vw,190px)] overflow-hidden" aria-hidden="true">
                <div class="clouds-pan absolute inset-y-0 -left-[4%] w-[108%]">
                    {{-- soft copy shows through at the top --}}
                    <img src="/image/hero-clouds.jpg" alt="" class="absolute inset-0 h-full w-full scale-105 object-cover object-bottom blur-md">
                    {{-- sharp copy takes over towards the bottom --}}
                    <img src="/image/hero-clouds.jpg" alt="" class="absolute inset-0 h-full w-full object-cover object-bottom [mask-image:linear-gradient(to_bottom,transparent_15%,#000_60%)]">
                </div>
                {{-- dim the bright sky at the top so it reads as glow, not a band --}}
                <div class="absolute inset-x-0 top-0 h-[45%] bg-gradient-to-b from-ink-950/60 via-ink-950/20 to-transparent"></div>
                {{-- darker left & right edges --}}
                <div class="absolute inset-0 bg-[linear-gradient(to_right,#09090a_0%,rgba(9,9,10,.75)_14%,transparent_38%,transparent_62%,rgba(9,9,10,.75)_86%,#09090a_100%)]"></div>
                <div class="absolute inset-x-0 bottom-0 h-[14%] bg-gradient-to-t from-ink-950 to-transparent"></div>
            </div>

            {{-- mobile: darken behind the copy --}}
            <div class="pointer-events-none absolute inset-x-0 bottom-0 z-20 h-[55%] bg-gradient-to-t from-ink-950 via-ink-950/85 to-transparent md:hidden"></div>

            {{-- bottom row --}}
            <div class="container-x relative z-30 mt-auto flex flex-col gap-6 pb-8 md:flex-row md:items-end md:justify-between lg:pb-12">
                <div class="max-w-sm animate-rise [animation-delay:.25s]">
                    <p class="text-sm leading-relaxed text-bone-300">
                        Clothing, boots and jewelry for those who dress after dark &mdash; curated from eight independent gothic houses.
                    </p>
                    <div class="mt-6 flex flex-wrap gap-3">
                        <a wire:navigate href="/products" class="btn-primary">
                            Shop collection
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                        </a>
                        <a wire:navigate href="/categories" class="btn-ghost bg-ink-950/40 backdrop-blur">Categories</a>
                    </div>
                </div>

                <div class="panel flex animate-rise items-center gap-6 px-6 py-5 [animation-delay:.35s]">
                    <div>
                        <p class="font-display text-3xl text-bone">{{ $stats['products'] }}</p>
                        <p class="text-[10px] uppercase tracking-widest2 text-bone-500">Pieces</p>
                    </div>
                    <span class="h-10 w-px bg-white/10"></span>
                    <div>
                        <p class="font-display text-3xl text-bone">{{ $brands->count() }}</p>
                        <p class="text-[10px] uppercase tracking-widest2 text-bone-500">Houses</p>
                    </div>
                    <span class="h-10 w-px bg-white/10"></span>
                    <div>
                        <p class="font-display text-3xl text-ember-400">{{ $categories->count() }}</p>
                        <p class="text-[10px] uppercase tracking-widest2 text-bone-500">Categories</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ BEST SELLERS ============ --}}
    <section class="container-x pt-24" x-data>
        <div data-reveal class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="eyebrow"><span class="text-ember-400">01</span> &mdash; Most wanted</p>
                <h2 class="heading-xl mt-3 text-5xl md:text-7xl">Best sellers</h2>
            </div>
            <div class="flex items-center gap-3">
                <a wire:navigate href="/products?featured=1" class="link-arrow me-3">View all <span aria-hidden="true">&rarr;</span></a>
                <button type="button" class="btn-icon" x-on:click="$refs.track.scrollBy({left: -340, behavior: 'smooth'})" aria-label="Previous">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
                </button>
                <button type="button" class="btn-icon" x-on:click="$refs.track.scrollBy({left: 340, behavior: 'smooth'})" aria-label="Next">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="m9 18 6-6-6-6"/></svg>
                </button>
            </div>
        </div>

        <div data-reveal class="no-scrollbar mt-6 flex gap-2 overflow-x-auto" style="--d:100ms">
            <a wire:navigate href="/products" class="chip border-ember bg-ember text-white">All</a>
            @foreach ($categories as $category)
                <a wire:navigate href="/products?selected_categories[0]={{ $category->id }}" class="chip" wire:key="chip-{{ $category->id }}">{{ $category->name }}</a>
            @endforeach
        </div>

        <div x-ref="track" data-reveal class="no-scrollbar -mx-4 mt-10 flex snap-x snap-mandatory gap-5 overflow-x-auto px-4 pb-4 sm:-mx-6 sm:px-6 lg:-mx-10 lg:px-10" style="--d:200ms">
            @foreach ($featured as $product)
                <x-product-card :product="$product" wire:key="feat-{{ $product->id }}" class="w-[78%] shrink-0 snap-start sm:w-[300px]" />
            @endforeach
        </div>
    </section>

    {{-- ============ CATEGORY BENTO ============ --}}
    <section class="container-x pt-28">
        <div data-reveal class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="eyebrow"><span class="text-ember-400">02</span> &mdash; The wardrobe</p>
                <h2 class="heading-xl mt-3 text-5xl md:text-7xl">Shop by category</h2>
            </div>
            <p class="max-w-sm text-sm text-bone-500">From stompers to chokers &mdash; everything you need to build the look, head to toe.</p>
        </div>

        @php
            $spans = ['lg:col-span-4 lg:row-span-1', 'lg:col-span-2', 'lg:col-span-2', 'lg:col-span-4', 'lg:col-span-3', 'lg:col-span-3'];
        @endphp
        <div class="mt-12 grid auto-rows-[260px] gap-4 sm:grid-cols-2 lg:grid-cols-6 lg:auto-rows-[300px]">
            @foreach ($categories as $i => $category)
                @php $accent = $i === 1 || $i === 4; @endphp
                <a wire:navigate href="/products?selected_categories[0]={{ $category->id }}" wire:key="cat-{{ $category->id }}"
                   data-reveal style="--d:{{ ($i % 3) * 90 }}ms"
                   class="group relative flex overflow-hidden rounded-3xl {{ $accent ? 'bg-ember' : 'bg-bone-100' }} {{ $spans[$i] ?? 'lg:col-span-2' }}">
                    <div class="relative z-10 flex flex-col justify-between p-7">
                        <span class="font-display text-sm {{ $accent ? 'text-ink-950/60' : 'text-ink-950/40' }}">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <div>
                            <h3 class="heading-xl max-w-[10ch] text-4xl text-ink-950 md:text-5xl">{{ $category->name }}</h3>
                            <p class="mt-3 text-xs font-semibold uppercase tracking-widest2 {{ $accent ? 'text-ink-950/70' : 'text-ink-950/50' }}">{{ $category->products_count }} pieces</p>
                        </div>
                    </div>
                    <img src="{{ url('storage', $category->image) }}" alt="{{ $category->name }}" loading="lazy"
                         class="absolute -right-4 bottom-0 h-[88%] w-[60%] object-contain object-bottom mix-blend-multiply transition duration-700 group-hover:-translate-y-2 group-hover:scale-105">
                    <span class="absolute bottom-6 right-6 z-10 flex h-11 w-11 items-center justify-center rounded-full bg-ink-950 text-bone transition duration-300 group-hover:rotate-[-45deg] group-hover:bg-white group-hover:text-ink-950">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                    </span>
                </a>
            @endforeach
        </div>
    </section>

    {{-- ============ EDITORIAL BANNER ============ --}}
    <section class="relative mt-28 overflow-hidden bg-ink-900">
        <p class="pointer-events-none absolute -right-10 top-1/2 -translate-y-1/2 select-none font-gothic text-[34vw] leading-none text-white/[0.03]" aria-hidden="true">Noir</p>
        <div class="container-x relative grid items-center gap-10 lg:grid-cols-2">
            <div data-reveal class="py-20 lg:py-32">
                <p class="eyebrow text-ember-400">The story</p>
                <h2 class="heading-xl mt-5 text-6xl md:text-8xl">Darkness.<br>Elegance.<br><span class="text-ember">Rebellion.</span></h2>
                <p class="mt-8 max-w-md text-sm leading-relaxed text-bone-400">
                    MixxStore started as a love letter to subculture &mdash; the lace, the leather, the silver. Every piece is chosen to be worn loud, mixed freely and kept for years.
                </p>
                <div class="mt-10 flex flex-wrap gap-3">
                    <a wire:navigate href="/products" class="btn-light">Discover the collection</a>
                    <a wire:navigate href="/products?on_sale=1" class="btn-ghost">Shop the sale</a>
                </div>
            </div>
            <div data-reveal class="relative flex h-[460px] items-end justify-center lg:h-[640px]" style="--d:150ms">
                <div class="absolute bottom-0 left-1/2 h-[80%] w-[80%] -translate-x-1/2 rounded-t-full bg-gradient-to-t from-ember/50 via-ember/10 to-transparent"></div>
                <img src="/image/pngegg%20(13).png" alt="Gothic look" loading="lazy" class="relative h-full w-auto object-contain object-bottom [mask-image:radial-gradient(ellipse_62%_70%_at_50%_42%,#000_55%,transparent_100%)]">
            </div>
        </div>
    </section>

    {{-- ============ ON SALE ============ --}}
    @if ($onSale->isNotEmpty())
        <section class="container-x pt-28">
            <div data-reveal class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                <div>
                    <p class="eyebrow"><span class="text-ember-400">03</span> &mdash; Marked down</p>
                    <h2 class="heading-xl mt-3 text-5xl md:text-7xl">Last call</h2>
                </div>
                <a wire:navigate href="/products?on_sale=1" class="link-arrow">See every sale piece <span aria-hidden="true">&rarr;</span></a>
            </div>
            <div class="mt-12 grid grid-cols-2 gap-x-5 gap-y-10 lg:grid-cols-4">
                @foreach ($onSale as $i => $product)
                    <div data-reveal style="--d:{{ $i * 80 }}ms" wire:key="sale-{{ $product->id }}">
                        <x-product-card :product="$product" />
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    {{-- ============ BRANDS ============ --}}
    <section class="container-x pt-28">
        <div data-reveal class="text-center">
            <p class="eyebrow"><span class="text-ember-400">04</span> &mdash; The houses</p>
            <h2 class="heading-xl mt-3 text-5xl md:text-7xl">Our brands</h2>
        </div>
        <div class="mt-12 grid grid-cols-2 gap-px overflow-hidden rounded-3xl border border-white/[0.07] bg-white/[0.07] sm:grid-cols-4">
            @foreach ($brands as $i => $brand)
                <a wire:navigate href="/products?selected_brands[0]={{ $brand->id }}" wire:key="brand-{{ $brand->id }}"
                   data-reveal style="--d:{{ ($i % 4) * 70 }}ms"
                   class="group relative flex aspect-[4/3] flex-col items-center justify-center gap-5 bg-ink-900 p-6 transition duration-500 hover:bg-ink-800">
                    <img src="{{ url('storage', $brand->image) }}" alt="{{ $brand->name }}" loading="lazy"
                         class="h-16 w-auto max-w-[60%] object-contain opacity-70 grayscale transition duration-500 group-hover:scale-110 group-hover:opacity-100 md:h-20">
                    <p class="text-[11px] font-semibold uppercase tracking-widest2 text-bone-500 transition group-hover:text-ember-300">{{ $brand->name }}</p>
                    <span class="absolute inset-x-0 bottom-0 h-0.5 origin-left scale-x-0 bg-ember transition duration-500 group-hover:scale-x-100"></span>
                </a>
            @endforeach
        </div>
    </section>

    {{-- ============ CRAFT FEATURES ============ --}}
    <section class="container-x pt-28">
        <div data-reveal class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="eyebrow"><span class="text-ember-400">05</span> &mdash; Made for the night</p>
                <h2 class="heading-xl mt-3 text-5xl md:text-7xl">Crafted to last</h2>
            </div>
        </div>
        <div class="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ([
                ['Hand-finished hardware', 'Buckles, studs and chains in solid metal that will not flake or tarnish.', 'M12 2v4m0 12v4M4.9 4.9l2.8 2.8m8.6 8.6 2.8 2.8M2 12h4m12 0h4M4.9 19.1l2.8-2.8m8.6-8.6 2.8-2.8M12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8Z'],
                ['Vegan leather options', 'Soft, matte faux leathers that break in like the real thing.', 'M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.5 19 2c1 2 2 4.2 2 8 0 5.5-4.8 10-10 10Zm0 0c0-4 2-7 6-9'],
                ['Inclusive sizing', 'Most pieces from XS to 4XL, with size notes on every product.', 'M21 3 3 21M21 3h-6m6 0v6M3 21h6m-6 0v-6'],
                ['Ships in 48 hours', 'Packed in black, shipped with JNE, J&T, SiCepat or Ninja.', 'M3 7h11v8H3zM14 10h4l3 3v2h-7M6.5 18a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Zm11 0a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z'],
            ] as $i => [$title, $text, $icon])
                <div data-reveal style="--d:{{ $i * 80 }}ms" class="panel group p-7 transition duration-500 hover:-translate-y-1 hover:border-ember/40">
                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-ember/10 text-ember-400 transition group-hover:bg-ember group-hover:text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $icon }}"/></svg>
                    </span>
                    <h3 class="mt-8 font-display text-xl uppercase tracking-wide text-bone">{{ $title }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-bone-500">{{ $text }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ============ TESTIMONIALS ============ --}}
    <section class="container-x pt-28">
        <div data-reveal class="text-center">
            <p class="eyebrow"><span class="text-ember-400">06</span> &mdash; Reviews</p>
            <h2 class="mt-3 font-gothic text-6xl text-bone md:text-8xl">Whispers of the coven</h2>
        </div>
        <div class="mt-14 grid gap-4 md:grid-cols-3">
            @foreach ([
                ['Ayu Lestari', 'Jakarta', 'The chain combat boots are unreal. Heavy, solid, and still comfortable after a full day at a gig. Packaging was gorgeous too.', 'Chain Strap Combat Boots'],
                ['Rizky Pratama', 'Bandung', 'Finally a store that gets the aesthetic. The serpent pendant looks even better in person and arrived in two days.', 'Serpent Pendant Necklace'],
                ['Nadia Putri', 'Surabaya', 'Ordered the lavender corset in my real size and it fits perfectly. The size notes on the product page actually help.', 'Lavender Pinstripe Corset'],
            ] as $i => [$name, $city, $quote, $item])
                <figure data-reveal style="--d:{{ $i * 100 }}ms" class="panel flex flex-col p-8 {{ $i === 1 ? 'md:-translate-y-6 border-ember/30' : '' }}">
                    <div class="flex gap-1 text-ember-400">
                        @for ($s = 0; $s < 5; $s++)
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.05 2.93c.3-.92 1.6-.92 1.9 0l1.3 4a1 1 0 0 0 .95.69h4.2c.97 0 1.37 1.24.59 1.8l-3.4 2.47a1 1 0 0 0-.36 1.12l1.3 4c.3.92-.76 1.69-1.54 1.12l-3.4-2.47a1 1 0 0 0-1.18 0l-3.4 2.47c-.78.57-1.84-.2-1.54-1.12l1.3-4a1 1 0 0 0-.36-1.12L2.03 9.42c-.78-.56-.38-1.8.59-1.8h4.2a1 1 0 0 0 .95-.69l1.3-4Z"/></svg>
                        @endfor
                    </div>
                    <blockquote class="mt-6 flex-1 text-[15px] leading-relaxed text-bone-300">&ldquo;{{ $quote }}&rdquo;</blockquote>
                    <figcaption class="mt-8 flex items-center gap-3 border-t border-white/[0.07] pt-6">
                        <span class="flex h-11 w-11 items-center justify-center rounded-full bg-gradient-to-br from-ember to-ember-700 font-display text-lg text-white">{{ mb_substr($name, 0, 1) }}</span>
                        <div>
                            <p class="text-sm font-semibold text-bone">{{ $name }}</p>
                            <p class="text-xs text-bone-500">{{ $city }} &middot; bought {{ $item }}</p>
                        </div>
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </section>

    {{-- ============ MEMBERSHIP ============ --}}
    <section class="container-x pt-28">
        <div data-reveal class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-ember via-ember-600 to-ember-700 p-8 md:p-14">
            <p class="pointer-events-none absolute -bottom-16 -right-6 select-none font-gothic text-[16rem] leading-none text-ink-950/15" aria-hidden="true">Coven</p>
            <div class="relative grid items-center gap-12 lg:grid-cols-[auto_1fr_auto]">
                {{-- member card --}}
                <div class="mx-auto w-[300px] -rotate-6 rounded-2xl bg-ink-950 p-6 shadow-[0_30px_60px_-15px_rgba(0,0,0,.7)] transition duration-700 hover:rotate-0">
                    <div class="flex items-start justify-between">
                        <span class="font-gothic text-3xl text-bone">Mixx</span>
                        <span class="h-8 w-10 rounded-md bg-gradient-to-br from-bone-300 to-bone-500"></span>
                    </div>
                    <p class="mt-10 font-display text-2xl uppercase tracking-[0.2em] text-ember-400">Coven member</p>
                    <div class="mt-4 flex justify-between text-[10px] uppercase tracking-widest2 text-bone-500">
                        <span>No. 0013</span><span>Since 2026</span>
                    </div>
                </div>

                <div class="text-center lg:text-left">
                    <h2 class="heading-xl text-5xl text-white md:text-6xl">Join the coven</h2>
                    <p class="mt-4 max-w-lg text-sm text-white/80 max-lg:mx-auto">Create an account for early access to drops, members-only pricing and order tracking in one place.</p>
                    <div class="mt-8 flex flex-wrap justify-center gap-x-8 gap-y-3 text-xs font-semibold uppercase tracking-wider text-white lg:justify-start">
                        <span>&#10022; 5% back on orders</span>
                        <span>&#10022; Early access</span>
                        <span>&#10022; Birthday gift</span>
                    </div>
                </div>

                <a wire:navigate href="/register" class="btn mx-auto bg-ink-950 px-8 py-4 text-white hover:-translate-y-0.5 hover:bg-black">Become a member</a>
            </div>
        </div>
    </section>
</div>
