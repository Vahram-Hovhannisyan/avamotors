@props(['product', 'quantity' => 1, 'size' => 'sm', 'label' => 'В корзину', 'fullWidth' => false])

@php
    $disabled = $product->quantity === 0;
    $sizeClass = match($size) {
        'lg'    => 'padding:0.65rem 1.5rem; font-size:0.82rem;',
        'md'    => 'padding:0.5rem 1rem; font-size:0.75rem;',
        default => 'padding:0.4rem 0.8rem; font-size:0.7rem;',
    };
    $widthStyle = $fullWidth ? 'width:100%;' : '';
@endphp

@push('styles')
    <style>
        .add-btn {
            background: var(--brand);
            color: #fff;
            border: none;
            font-family: var(--font-body);
            letter-spacing: 0.07em;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.2s, opacity 0.2s;
            white-space: nowrap;
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
        }

        .add-btn:hover:not(:disabled) { background: var(--brand-dk); }

        .add-btn:disabled {
            background: var(--surface2);
            color: var(--muted);
            border: 1px solid var(--border);
            cursor: not-allowed;
            opacity: 0.8;
        }

        /* Состояние "добавлено" */
        .add-btn.added {
            background: #48bb78;
            pointer-events: none;
        }
    </style>
@endpush

<form method="POST" action="{{ route('cart.add') }}"
      style="{{ $fullWidth ? 'width:100%;' : '' }}"
      onsubmit="handleAddToCart(event, this)">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="hidden" name="quantity"   value="{{ $quantity }}">
    <button type="submit"
            class="add-btn"
            style="{{ $sizeClass }} {{ $widthStyle }}"
        {{ $disabled ? 'disabled' : '' }}>
        {{ $disabled ? 'Нет в наличии' : $label }}
    </button>
</form>

@once
    @push('scripts')
        <script>
            function handleAddToCart(e, form) {
                e.preventDefault();
                const btn = form.querySelector('.add-btn');
                const originalText = btn.textContent.trim();

                fetch(form.action, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': form.querySelector('[name=_token]').value },
                    body: new FormData(form),
                })
                    .then(r => r.ok ? r.json() : Promise.reject())
                    .then(() => {
                        btn.textContent = '✓ Добавлено';
                        btn.classList.add('added');

                        // Обновить счётчик корзины если есть
                        fetch('{{ route('cart.count') }}')
                            .then(r => r.json())
                            .then(data => {
                                document.querySelectorAll('.cart-count').forEach(el => {
                                    el.textContent = data.count;
                                });
                            }).catch(() => {});

                        setTimeout(() => {
                            btn.textContent = originalText;
                            btn.classList.remove('added');
                        }, 2000);
                    })
                    .catch(() => {
                        // Fallback — обычный сабмит
                        form.submit();
                    });
            }
        </script>
    @endpush
@endonce
