<?php

namespace App\Http\Controllers;

use App\Models\Herb;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    /**
     * Gera dinamicamente as informações de SEO para cada página.
     */
    private function generateSeo($title, $description, $keywords, $routeName, $slug = null)
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
                'url' => $slug ? route($routeName, ['slug' => $slug], false) : route($routeName, [], false), // ✅ Verifica se há slug antes de passar
            ],
        ];
    }


    public function index()
    {
        $seo = $this->generateSeo(
            'Sabedoria Ancestral',
            'Conecte-se com a natureza e com o universo',
            ['sabedoria', 'ancestral', 'natureza', 'universo', 'ervas', 'planetas', 'astrologia'],
            'website.index'
        );

        return view('website.pages.index', compact('seo'));
    }

    public function horaPlanetaria()
    {
        $seo = $this->generateSeo(
            'Hora Planetária',
            'Descubra qual é a hora planetária do dia',
            ['hora planetária', 'astrologia', 'planetas', 'sabedoria ancestral'],
            'website.hora-planetaria'
        );

        return view('website.tools.hora-planetaria', compact('seo'));
    }

    public function calendarioLunar()
    {
        $seo = $this->generateSeo(
            'Calendário Lunar',
            'Saiba as fases da Lua e sua influência energética',
            ['calendário lunar', 'fases da lua', 'energia cósmica'],
            'website.calendario-lunar'
        );

        return view('website.tools.calendario-lunar', compact('seo'));
    }

    public function planetas()
    {
        $seo = $this->generateSeo(
            'Planetas e Astrologia',
            'Explore a influência dos planetas na sua vida',
            ['planetas', 'astrologia', 'esoterismo', 'mapa astral'],
            'website.planetas'
        );

        return view('website.tools.planetas', compact('seo'));
    }

    public function ervas()
    {
        $seo = $this->generateSeo(
            'Ervas e Magia Natural',
            'Descubra os segredos das ervas para cura e magia',
            ['ervas', 'magia natural', 'cura', 'rituais'],
            'website.ervas'
        );

        $herbs = Herb::all();

        return view('website.ervas.index', [
            'seo' => $seo,
            'herbs' => $herbs
        ]);
    }

    public function erva($slug)
    {
        $herb = Herb::where('slug', $slug)->firstOrFail();

        $herb->load('alchemies');
        $seo = $this->generateSeo(
            $herb->name,
            'Saiba mais sobre a erva ' . $herb->name . ', suas propriedades magicas, curativas e o como usar no seu dia a dia',
            [$herb->slug],
            'website.erva',
            $slug
        );

        return view('website.ervas.show', compact('herb', 'seo'));
    }


    public function sobre()
    {
        $seo = $this->generateSeo(
            'Sobre Nós',
            'Conheça mais sobre o projeto Sabedoria Ancestral',
            ['sobre', 'história', 'missão', 'sabedoria ancestral'],
            'website.sobre'
        );

        return view('website.pages.sobre', compact('seo'));
    }
}
