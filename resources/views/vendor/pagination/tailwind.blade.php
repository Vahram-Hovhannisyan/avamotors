@if ($paginator->hasPages())
    <nav class="avce-pagination" aria-label="Навигация по страницам">
        <div class="avce-pagination-info">
            @if(method_exists($paginator, 'firstItem') && $paginator->firstItem())
                Показано {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }}
                из {{ $paginator->total() }}
            @endif
        </div>

        <div class="avce-pagination-pages">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span class="avce-page-btn disabled" aria-disabled="true">‹</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="avce-page-btn" rel="prev" aria-label="Предыдущая">‹</a>
            @endif

            {{-- Page numbers --}}
            @foreach ($elements as $element)

                {{-- Dots --}}
                @if (is_string($element))
                    <span class="avce-page-btn dots">…</span>
                @endif

                {{-- Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="avce-page-btn active" aria-current="page">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="avce-page-btn">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif

            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="avce-page-btn" rel="next" aria-label="Следующая">›</a>
            @else
                <span class="avce-page-btn disabled" aria-disabled="true">›</span>
            @endif

        </div>
    </nav>

    <style>
        .avce-pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
            flex-wrap: wrap;
            gap: 0.8rem;
        }

        .avce-pagination-info {
            font-size: 0.78rem;
            color: var(--muted);
        }

        .avce-pagination-pages {
            display: flex;
            gap: 3px;
            flex-wrap: wrap;
        }

        .avce-page-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 34px;
            height: 34px;
            padding: 0 0.5rem;
            font-size: 0.82rem;
            font-family: var(--font-body);
            background: var(--surface);
            border: 1px solid var(--border);
            color: var(--muted);
            text-decoration: none;
            transition: all 0.15s;
            cursor: pointer;
            user-select: none;
        }

        a.avce-page-btn:hover {
            background: var(--surface2);
            border-color: var(--brand);
            color: var(--brand);
        }

        .avce-page-btn.active {
            background: var(--brand);
            border-color: var(--brand);
            color: #fff;
            font-weight: 600;
            cursor: default;
        }

        .avce-page-btn.disabled {
            opacity: 0.35;
            cursor: default;
            pointer-events: none;
        }

        .avce-page-btn.dots {
            border-color: transparent;
            background: transparent;
            cursor: default;
            color: var(--muted);
        }
    </style>
@endif
