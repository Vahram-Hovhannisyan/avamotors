@props(['color' => 'blue', 'label' => ''])

@php
    $classes = match($color) {
        'green'  => 'badge-green',
        'orange' => 'badge-orange',
        'red'    => 'badge-red',
        'purple' => 'badge-purple',
        'muted'  => 'badge-muted',
        default  => 'badge-blue',
    };
@endphp

<span class="badge {{ $classes }}">{{ $label ?: $slot }}</span>
