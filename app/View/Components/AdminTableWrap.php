<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AdminTableWrap extends Component
{
    public function __construct(
        public readonly string $title        = '',
        public readonly string $rightLabel   = '',
        public readonly string $rightUrl     = '',
    ) {}

    public function render(): View
    {
        return view('components.admin-table-wrap');
    }
}
