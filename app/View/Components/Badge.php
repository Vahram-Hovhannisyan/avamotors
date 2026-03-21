<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Badge extends Component
{
    /**
     * @param string $color  green|orange|red|blue|purple|muted
     * @param string $label  Text to display
     */
    public function __construct(
        public readonly string $color = 'blue',
        public readonly string $label = '',
    ) {}

    public function render(): View
    {
        return view('components.badge');
    }
}
