<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContactButton extends Component
{
    public $type;
    public $info;

    /**
     * Criar uma nova instância do componente.
     */
    public function __construct($type, $info)
    {
        $this->type = $type;
        $this->info = $info;
    }

    /**
     * Retorna a URL correspondente ao tipo de contato.
     */
    public function getUrl()
    {
        switch ($this->type) {
            case 'whatsapp':
                return "https://wa.me/" . preg_replace('/\D/', '', $this->info);
            case 'telefone':
                return "tel:" . preg_replace('/\D/', '', $this->info);
            case 'email':
                return "mailto:" . $this->info;
            case 'instagram':
                return "https://instagram.com/" . str_replace('@', '', $this->info);
            case 'telegram':
                return "https://t.me/" . str_replace('@', '', $this->info);
            case 'facebook':
            case 'link':
                return $this->info;
            default:
                return "#";
        }
    }

    /**
     * Retorna a classe CSS do botão.
     */
    public function getButtonClass()
    {
        return match ($this->type) {
            'whatsapp' => 'btn-success',
            'telefone' => 'btn-info',
            'email' => 'btn-dark',
            'instagram' => 'btn-warning',
            'telegram' => 'btn-primary',
            'facebook' => 'btn-primary',
            'link' => 'btn-secondary',
            default => 'btn-secondary',
        };
    }

    /**
     * Retorna o ícone FontAwesome correspondente.
     */
    public function getIcon()
    {
        return match ($this->type) {
            'whatsapp' => 'fa-brands fa-whatsapp',
            'telefone' => 'fa-solid fa-phone',
            'email' => 'fa-solid fa-envelope',
            'instagram' => 'fa-brands fa-instagram',
            'telegram' => 'fa-brands fa-telegram',
            'facebook' => 'fa-brands fa-facebook',
            'link' => 'fa-solid fa-link',
            default => 'fa-solid fa-circle-question',
        };
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.contact-button');
    }
}
