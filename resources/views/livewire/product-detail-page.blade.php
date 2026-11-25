<div>
    <section class="container-x py-10 md:py-14">
        <nav class="eyebrow flex flex-wrap items-center gap-2">
            <a wire:navigate href="/" class="hover:text-ember-300">Home</a><span>/</span>
            <a wire:navigate href="/products" class="hover:text-ember-300">Shop</a><span>/</span>
            @if ($product->category)
                <a wire:navigate href="/products?selected_categories[0]={{ $product->category->id }}" class="hover:text-ember-300">{{ $product->category->name }}</a><span>/</span>
            @endif
            <span class="text-bone">{{ $product->name }}</span>
        </nav>

        <div class="mt-8 grid gap-10 lg:grid-cols-[1.1fr_1fr] lg:gap-16">
            {{-- Gallery --}}
            <div x-data="{ mainImage: '{{ url('storage', $product->images[0]) }}' }" class="animate-rise">
                <div class="tile aspect-square lg:aspect-[5/5]">
                    <img x-bind:src="mainImage" alt="{{ $product->name }}" class="blend absolute inset-0 h-full w-full object-contain p-10 transition duration-500 md:p-16">
                    <div class="absolute left-5 top-5 flex gap-2">
                        @if ($product->on_sale) <span class="badge bg-ember text-white">Sale</span> @endif
                        @if ($product->is_featured) <span class="badge bg-ink-950 text-bone">Featured</span> @endif
                    </div>
                </div>
                <div class="mt-4 grid grid-cols-4 gap-3">
                    @foreach ($product->images as $image)
                        <button type="button" x-on:click="mainImage='{{ url('storage', $image) }}'"
                                class="tile aspect-square ring-2 ring-transparent ring-offset-2 ring-offset-ink-950 transition hover:ring-ember/60"
                                x-bind:class="mainImage === '{{ url('storage', $image) }}' && '!ring-ember'">
                            <img src="{{ url('storage', $image) }}" alt="{{ $product->name }}" class="blend absolute inset-0 h-full w-full object-contain p-3">
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Info --}}
            <div class="animate-rise [animation-delay:.1s] lg:pt-6">
                <p class="eyebrow text-ember-400">{{ $product->brand?->name }}</p>
                <h1 class="heading-xl mt-4 text-5xl md:text-6xl">{{ $product->name }}</h1>

                <div class="mt-6 flex items-center gap-4">
                    <p class="font-display text-4xl text-bone">{{ Number::currency($product->price) }}</p>
                    @if ($product->in_stock)
                        <span class="badge border border-emerald-400/30 bg-emerald-400/10 text-emerald-300">In stock</span>
                    @else
                        <span class="badge border border-white/10 text-bone-500">Sold out</span>
                    @endif
                </div>

                <p class="mt-8 max-w-lg text-[15px] leading-relaxed text-bone-400">{{ $product->description }}</p>

                <div class="mt-10 flex flex-wrap items-center gap-4">
                    <div class="flex items-center rounded-full border border-white/10 p-1">
                        <button wire:click="decreaseQty" class="flex h-11 w-11 items-center justify-center rounded-full text-xl text-bone-300 transition hover:bg-white/5 hover:text-white" aria-label="Decrease">&minus;</button>
                        <input type="number" wire:model="quantity" readonly class="w-12 border-0 bg-transparent p-0 text-center font-display text-lg text-bone focus:ring-0">
                        <button wire:click="increaseQty" class="flex h-11 w-11 items-center justify-center rounded-full text-xl text-bone-300 transition hover:bg-white/5 hover:text-white" aria-label="Increase">+</button>
                    </div>
                    <button wire:click="addToCart({{ $product->id }})" @disabled(! $product->in_stock) class="btn-primary flex-1 py-4 sm:flex-none sm:px-12">
                        <span wire:loading.remove wire:target="addToCart({{ $product->id }})">{{ $product->in_stock ? 'Add to cart' : 'Sold out' }}</span>
                        <span wire:loading wire:target="addToCart({{ $product->id }})">Adding&hellip;</span>
                    </button>
                </div>

                <dl class="mt-12 divide-y divide-white/[0.06] border-y border-white/[0.06] text-sm">
                    @foreach ([
                        ['Category', $product->category?->name ?? '—'],
                        ['House', $product->brand?->name ?? '—'],
                        ['Shipping', 'Free, ships within 48 hours'],
                        ['Returns', '14 days, no questions asked'],
                    ] as [$k, $v])
                        <div class="flex justify-between py-4">
                            <dt class="text-bone-500">{{ $k }}</dt>
                            <dd class="font-medium text-bone">{{ $v }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>
        </div>
    </section>

    @if ($related->isNotEmpty())
        <section class="container-x pt-16">
            <div class="flex items-end justify-between">
                <div>
                    <p class="eyebrow">Complete the look</p>
                    <h2 class="heading-xl mt-3 text-4xl md:text-6xl">You may also like</h2>
                </div>
                <a wire:navigate href="/products?selected_categories[0]={{ $product->category_id }}" class="link-arrow hidden sm:inline-flex">View all <span aria-hidden="true">&rarr;</span></a>
            </div>
            <div class="mt-10 grid grid-cols-2 gap-x-5 gap-y-10 lg:grid-cols-4">
                @foreach ($related as $item)
                    <x-product-card :product="$item" :cart="false" wire:key="rel-{{ $item->id }}" />
                @endforeach
            </div>
        </section>
    @endif
</div>
