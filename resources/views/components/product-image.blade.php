@props(['product', 'hasImage', 'src', 'size' => 'md'])

@php
    $svgSizes = ['sm' => 40, 'md' => 56, 'lg' => 80];
    $svgSize  = $svgSizes[$size] ?? 56;

    $heights  = ['sm' => '130px', 'md' => '180px', 'lg' => '240px'];
    $height   = $heights[$size] ?? '180px';
@endphp

@push('styles')
    <style>
        .product-img {
            width: 100%;
            height: v-bind(height);
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--surface2);
            border-bottom: 1px solid var(--border);
            overflow: hidden;
            flex-shrink: 0;
        }

        .product-img img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 0.75rem;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-img img {
            transform: scale(1.04);
        }

        .product-img svg {
            opacity: 0.5;
        }
    </style>
@endpush

<div class="product-img" style="height: {{ $height }}">
    @if($hasImage)
        <img src="{{ $src }}"
             alt="{{ $product->name }}"
             loading="lazy">
    @else
        <svg viewBox="0 0 80 80" width="{{ $svgSize }}" height="{{ $svgSize }}" fill="none"
             xmlns="http://www.w3.org/2000/svg">
            <rect width="80" height="80" fill="var(--surface2)"/>
            <path d="M16 56 L28 34 L42 48 L52 38 L64 56 Z" fill="var(--border)"/>
            <circle cx="28" cy="26" r="7" fill="var(--border)"/>
        </svg>
    @endif
</div>
