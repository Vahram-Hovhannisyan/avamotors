@props(['title' => '', 'rightLabel' => '', 'rightUrl' => ''])

<div class="table-wrap">
    @if($title || $rightUrl)
        <div class="table-header">
            <span class="table-header-title">{{ $title }}</span>
            @if($rightUrl)
                <a href="{{ $rightUrl }}"
                   style="font-size:0.78rem; color:var(--brand); text-decoration:none;">
                    {{ $rightLabel }}
                </a>
            @elseif($rightLabel)
                <span style="font-size:0.78rem; color:var(--muted);">{{ $rightLabel }}</span>
            @endif
        </div>
    @endif
    {{ $slot }}
</div>
