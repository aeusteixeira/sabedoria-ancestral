<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HeaderPage extends Component
{
    public $complement;
    public $title;
    public $description;
    public $id;

    /**
     * Create a new component instance.
     */
    public function __construct($title, $description, $complement = null, $id = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->complement = $complement;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header-page', [
            'title' => $this->title,
            'description' => $this->description,
            'complement' => $this->complement,
            'id' => $this->id
        ]);
    }
}
