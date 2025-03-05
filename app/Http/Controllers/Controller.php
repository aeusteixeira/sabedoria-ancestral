<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

        /**
     * Gera dinamicamente as informações de SEO para cada página.
     */
    protected function generateSeo($title, $description, $keywords, $routeName, $slug = null)
    {
        return [
            'title' => $title,
            'description' => $description,
            'keywords' => implode(', ', $keywords),
            'title_for_tag' => $title . ' | Sabedoria Ancestral',
            'og' => [
                'title' => $title,
                'description' => $description,
                'image' => asset('images/seo/' . str_replace(' ', '-', strtolower($title)) . '.jpg'),
                'url' => $slug
                    ? route($routeName, $routeName === 'website.profile.index' ? ['username' => $slug] : ['slug' => $slug], false)
                    : route($routeName, [], false),
            ],
        ];
    }


}
