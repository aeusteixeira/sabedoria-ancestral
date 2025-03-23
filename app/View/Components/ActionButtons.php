<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ActionButtons extends Component
{
    public $editRoute;
    public $deleteRoute;
    public $itemId;
    public $showEdit;
    public $showDelete;
    public $showShare;

    /**
     * Criar uma nova instância do componente.
     */
    public function __construct($editRoute = null, $deleteRoute = null, $shareRoute = null, $itemId, $showEdit = true, $showDelete = true, $showShare = true)
    {
        $this->editRoute = $editRoute;
        $this->deleteRoute = $deleteRoute;
        $this->shareRoute = $shareRoute;
        $this->itemId = $itemId;
        $this->showEdit = $showEdit;
        $this->showDelete = $showDelete;
        $this->showShare = $showShare;
    }

    /**
     * Retornar a view do componente.
     */
    public function render()
    {
        return view('components.action-buttons');
    }
}
