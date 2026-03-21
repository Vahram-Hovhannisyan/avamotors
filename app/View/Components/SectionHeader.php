<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class SectionHeader extends Component
{
    public function __construct(
        public readonly string  $title,
        public readonly string  $linkUrl   = '',
        public readonly string  $linkLabel = 'Смотреть все →',
    ) {}

    public function render(): View
    {
        return view('components.section-header');
    }
}
