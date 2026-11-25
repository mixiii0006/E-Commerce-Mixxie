<div>
    {{-- Page header --}}
    <section class="relative overflow-hidden border-b border-white/[0.06]">
        <p class="pointer-events-none absolute -bottom-10 right-0 select-none font-gothic text-[14rem] leading-none text-white/[0.03] md:text-[20rem]" aria-hidden="true">Collection</p>
        <div class="container-x relative py-14 md:py-20">
            <nav class="eyebrow flex items-center gap-2"><a wire:navigate href="/" class="hover:text-ember-300">Home</a><span>/</span><span class="text-bone">Shop</span></nav>
            <div class="mt-6 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                <h1 class="heading-xl text-6xl md:text-8xl">The collection</h1>
                <p class="text-sm text-bone-500"><span class="font-display text-2xl text-ember-400">{{ $products->total() }}</span> pieces found</p>
            </div>
        </div>
    </section>

    <section class="container-x py-12">
        <div class="grid gap-10 lg:grid-cols-[280px_1fr]">
            {{-- Filters --}}
            <aside class="space-y-4 lg:sticky lg:top-24 lg:self-start">
                <div class="panel p-6">
                    <h2 class="eyebrow text-bone">Categories</h2>
                    <ul class="mt-5 space-y-3">
                        @foreach ($categories as $category)
                            <li wire:key="c-{{ $category->id }}">
                                <label for="{{ $category->slug }}" class="group flex cursor-pointer items-center gap-3 text-sm text-bone-300 hover:text-white">
                                    <input type="checkbox" wire:model.live="selected_categories" id="{{ $category->slug }}" value="{{ $category->id }}" class="check">
                                    {{ $category->name }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="panel p-6">
                    <h2 class="eyebrow text-bone">Brand</h2>
                    <ul class="mt-5 space-y-3">
                        @foreach ($brands as $brand)
                            <li wire:key="b-{{ $brand->id }}">
                                <label for="{{ $brand->slug }}" class="flex cursor-pointer items-center gap-3 text-sm text-bone-300 hover:text-white">
                                    <input type="checkbox" wire:model.live="selected_brands" id="{{ $brand->slug }}" value="{{ $brand->id }}" class="check">
                                    {{ $brand->name }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="panel p-6">
                    <h2 class="eyebrow text-bone">Status</h2>
                    <ul class="mt-5 space-y-3">
                        <li>
                            <label for="featured" class="flex cursor-pointer items-center gap-3 text-sm text-bone-300 hover:text-white">
                                <input type="checkbox" id="featured" wire:model.live="featured" value="1" class="check">
                                Featured
                            </label>
                        </li>
                        <li>
                            <label for="on_sale" class="flex cursor-pointer items-center gap-3 text-sm text-bone-300 hover:text-white">
                                <input type="checkbox" id="on_sale" wire:model.live="on_sale" value="1" class="check">
                                On sale
                            </label>
                        </li>
                    </ul>
                </div>

                <div class="panel p-6">
                    <div class="flex items-center justify-between">
                        <h2 class="eyebrow text-bone">Max price</h2>
                        <span class="font-display text-lg text-ember-400">{{ Number::currency($price_range) }}</span>
                    </div>
                    <input type="range" wire:model.live="price_range" class="mt-5 h-1 w-full cursor-pointer appearance-none rounded-full bg-white/10 accent-ember" max="1000" value="500" step="10">
                    <div class="mt-3 flex justify-between text-xs text-bone-500">
                        <span>{{ Number::currency(10) }}</span>
                        <span>{{ Number::currency(1000) }}</span>
                    </div>
                </div>
            </aside>

            {{-- Grid --}}
            <div>
                <div class="mb-8 flex items-center justify-between gap-4 border-b border-white/[0.06] pb-5">
                    <p class="hidden text-xs uppercase tracking-widest2 text-bone-500 sm:block">
                        <span wire:loading.remove>Page {{ $products->currentPage() }} of {{ max($products->lastPage(), 1) }}</span>
                        <span wire:loading class="text-ember-300">Summoning&hellip;</span>
                    </p>
                    <label class="flex items-center gap-3 text-xs uppercase tracking-widest2 text-bone-500">
                        Sort
                        <select wire:model.live="sort" class="cursor-pointer rounded-full border border-white/10 bg-ink-900 py-2 pe-9 ps-4 text-xs font-semibold uppercase tracking-wider text-bone focus:border-ember focus:ring-ember/30">
                            <option value="latest">Latest</option>
                            <option value="price">Price: low to high</option>
                        </select>
                    </label>
                </div>

                <div class="grid grid-cols-2 gap-x-5 gap-y-10 transition-opacity xl:grid-cols-3" wire:loading.class="opacity-50">
                    @forelse ($products as $i => $product)
                        <x-product-card :product="$product" wire:key="p-{{ $product->id }}" class="animate-rise" style="animation-delay: {{ $i * 50 }}ms" />
                    @empty
                        <div class="col-span-full flex flex-col items-center rounded-3xl border border-dashed border-white/10 px-6 py-24 text-center">
                            <p class="font-gothic text-6xl text-ember-400">Nothing here</p>
                            <p class="mt-4 text-sm text-bone-500">No pieces match these filters. Try loosening them.</p>
                            <a wire:navigate href="/products" class="btn-ghost mt-8">Reset filters</a>
                        </div>
                    @endforelse
                </div>

                <div class="mt-14">
                    {{ $products->links('livewire.partials.pagination') }}
                </div>
            </div>
        </div>
    </section>
</div>
