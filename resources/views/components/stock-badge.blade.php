@props(['product', 'status', 'label'])

@push('styles')
    <style>
        .product-stock {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.68rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: #48bb78;
        }

        .product-stock::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #48bb78;
            flex-shrink: 0;
        }

        .product-stock.low {
            color: #ed8936;
        }

        .product-stock.low::before {
            background: #ed8936;
        }

        .product-stock.none {
            color: var(--muted);
        }

        .product-stock.none::before {
            background: var(--border);
        }
    </style>
@endpush

<div class="product-stock {{ $status === 'low' ? 'low' : ($status === 'out' ? 'none' : '') }}">
    {{ $label }}
</div>
