@php
    $scrollTo = $scrollTo ?? 'body';
    $scrollSnippet = $scrollTo !== false
        ? "(\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()"
        : '';
    $pageName = $paginator->getPageName();
    $base = 'inline-flex h-10 min-w-10 items-center justify-center rounded-full px-3 text-sm font-medium transition';
@endphp
<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination" class="flex flex-col items-center justify-between gap-4 sm:flex-row">
            <p class="text-xs uppercase tracking-widest2 text-bone-500">
                Showing <span class="text-bone">{{ $paginator->firstItem() }}&ndash;{{ $paginator->lastItem() }}</span> of <span class="text-bone">{{ $paginator->total() }}</span>
            </p>

            <div class="flex items-center gap-1.5">
                @if ($paginator->onFirstPage())
                    <span class="{{ $base }} border border-white/5 text-bone-500/40" aria-disabled="true">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
                    </span>
                @else
                    <button type="button" wire:click="previousPage('{{ $pageName }}')" x-on:click="{{ $scrollSnippet }}" wire:loading.attr="disabled" class="{{ $base }} border border-white/10 text-bone hover:border-ember hover:text-white" aria-label="Previous">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
                    </button>
                @endif

                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="{{ $base }} text-bone-500">{{ $element }}</span>
                    @endif
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            <span wire:key="paginator-{{ $pageName }}-page{{ $page }}">
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page" class="{{ $base }} bg-ember text-white">{{ $page }}</span>
                                @else
                                    <button type="button" wire:click="gotoPage({{ $page }}, '{{ $pageName }}')" x-on:click="{{ $scrollSnippet }}" class="{{ $base }} text-bone-300 hover:bg-white/5 hover:text-white">{{ $page }}</button>
                                @endif
                            </span>
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <button type="button" wire:click="nextPage('{{ $pageName }}')" x-on:click="{{ $scrollSnippet }}" wire:loading.attr="disabled" class="{{ $base }} border border-white/10 text-bone hover:border-ember hover:text-white" aria-label="Next">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="m9 18 6-6-6-6"/></svg>
                    </button>
                @else
                    <span class="{{ $base }} border border-white/5 text-bone-500/40" aria-disabled="true">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="m9 18 6-6-6-6"/></svg>
                    </span>
                @endif
            </div>
        </nav>
    @endif
</div>
