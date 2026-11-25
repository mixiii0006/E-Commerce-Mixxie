<div>
    <section class="relative overflow-hidden border-b border-white/[0.06]">
        <p class="pointer-events-none absolute -bottom-10 right-0 select-none font-gothic text-[14rem] leading-none text-white/[0.03] md:text-[20rem]" aria-hidden="true">Wardrobe</p>
        <div class="container-x relative py-14 md:py-20">
            <nav class="eyebrow flex items-center gap-2"><a wire:navigate href="/" class="hover:text-ember-300">Home</a><span>/</span><span class="text-bone">Categories</span></nav>
            <div class="mt-6 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                <h1 class="heading-xl text-6xl md:text-8xl">Categories</h1>
                <p class="max-w-sm text-sm text-bone-500">Six departments, one aesthetic. Pick where to start.</p>
            </div>
        </div>
    </section>

    <section class="container-x py-12">
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($categories as $i => $category)
                <a wire:navigate href="/products?selected_categories[0]={{ $category->id }}" wire:key="{{ $category->id }}"
                   class="group relative flex aspect-[4/5] animate-rise flex-col overflow-hidden rounded-3xl {{ $i % 4 === 1 ? 'bg-ember' : 'bg-bone-100' }}"
                   style="animation-delay: {{ $i * 70 }}ms">
                    <img src="{{ url('storage', $category->image) }}" alt="{{ $category->name }}" loading="lazy"
                         class="absolute inset-x-0 top-6 mx-auto h-[62%] w-[80%] object-contain mix-blend-multiply transition duration-700 group-hover:-translate-y-2 group-hover:scale-105">
                    <div class="relative mt-auto flex items-end justify-between p-7">
                        <div>
                            <p class="font-display text-sm text-ink-950/50">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</p>
                            <h2 class="heading-xl mt-2 text-4xl text-ink-950">{{ $category->name }}</h2>
                            <p class="mt-2 text-xs font-semibold uppercase tracking-widest2 text-ink-950/60">{{ $category->products_count }} pieces</p>
                        </div>
                        <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-ink-950 text-bone transition duration-300 group-hover:rotate-[-45deg]">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
</div>
