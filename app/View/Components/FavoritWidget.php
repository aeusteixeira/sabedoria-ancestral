<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FavoritWidget extends Component
{
    public $favorits;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->favorits = [];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.favorit-widget', [
            'favorits' => $this->favorits,
        ]);
    }
}
