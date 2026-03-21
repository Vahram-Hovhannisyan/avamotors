@php
    $depthClass = match(true) {
        $depth === 0 => 'cat-row-root',
        $depth === 1 => 'cat-row-child',
        $depth === 2 => 'cat-row-grandchild',
        default      => 'cat-row-deep',
    };
@endphp

<tr class="data-table-row {{ $depthClass }}">
    <td>
        @if($depth > 0)
            <span class="cat-connector">
                <span class="cat-name-text cat-child">{{ $category->name }}</span>
            </span>
        @else
            <span class="cat-name-text">{{ $category->name }}</span>
        @endif
        <span class="cat-slug-badge">{{ $category->slug }}</span>
    </td>
    <td>
        <span class="badge-count">{{ $category->products_count ?? 0 }}</span>
    </td>
    <td style="color:var(--muted); font-size:0.78rem;">
        {{ $category->children->count() ?: '—' }}
    </td>
    <td style="white-space:nowrap;">
        <a href="{{ route('admin.categories.edit', $category) }}" class="action-link">Ред.</a>
        <a href="{{ route('catalog.category', $category->slug) }}" target="_blank" class="action-link">↗</a>
        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
              style="display:inline"
              onsubmit="return confirm('Удалить категорию «{{ $category->name }}»?')">
            @csrf @method('DELETE')
            <button type="submit" class="del-btn">Удалить</button>
        </form>
    </td>
</tr>

{{-- Recursive: render children --}}
@foreach($category->children as $child)
    @include('admin.categories._tree_row', [
        'category' => $child,
        'depth'    => $depth + 1,
    ])
@endforeach
