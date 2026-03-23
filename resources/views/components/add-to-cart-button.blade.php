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

<form method="POST" action="{{ route('cart.add') }}"
      class="add-to-cart-form"
      data-product-id="{{ $product->id }}">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="hidden" name="quantity" value="{{ $quantity }}">
    <button type="submit" class="add-btn" style="{{ $sizeClass }} {{ $widthStyle }}" {{ $disabled ? 'disabled' : '' }}>
        {{ $label }}
    </button>
</form>
