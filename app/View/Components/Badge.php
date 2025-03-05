<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Badge extends Component
{
    public $content;
    public $colorBackground;
    public $colorText;
    public $icon;

    /**
     * Create a new component instance.
     */
    public function __construct($content, $colorBackground, $colorText, $icon)
    {
        $this->content = $content;
        $this->colorBackground = $colorBackground;
        $this->colorText = $colorText;
        if($icon) {
            $this->content = $icon . ' ' . $this->content;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.badge', [
            'content' => $this->content,
            'colorBackground' => $this->colorBackground,
            'colorText' => $this->colorText,
        ]);
    }
}
