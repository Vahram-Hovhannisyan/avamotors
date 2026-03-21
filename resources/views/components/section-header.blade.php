@props(['title', 'linkUrl' => '', 'linkLabel' => 'Смотреть все →'])

<div class="section-hd">
    <h2 class="section-hd-title">{{ $title }}</h2>
    @if($linkUrl)
        <a href="{{ $linkUrl }}" class="section-hd-link">{{ $linkLabel }}</a>
    @endif
</div>
