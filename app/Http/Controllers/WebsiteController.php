<?php

namespace App\Http\Controllers;

use App\Models\Alchemy;
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
            '⏳ Hora Planetária do Dia',
            'A hora planetária é uma técnica antiga que divide o dia e a noite em períodos regidos por planetas. Cada hora é associada a um planeta, que influencia a energia do momento. Descubra as horas planetárias de hoje e amanhã para o seu local.',
            ['hora planetária', 'astrologia', 'planetas', 'sabedoria ancestral'],
            'website.hora-planetaria'
        );

        return view('website.tools.hora-planetaria', compact('seo'));
    }

    public function calendarioLunar()
    {
        $seo = $this->generateSeo(
            '🌙 Calendário Lunar',
            'O calendário lunar é uma ferramenta antiga utilizada para acompanhar as fases da Lua ao longo do mês. Cada fase
        lunar possui significados e energias específicas que podem ser aproveitadas em rituais, feitiços e práticas
        espirituais. Descubra as fases da Lua deste mês e como utilizá-las em seus trabalhos mágicos.',
            ['calendário lunar', 'fases da lua', 'energia cósmica'],
            'website.calendario-lunar'
        );

        return view('website.tools.calendario-lunar', compact('seo'));
    }

    public function planetas()
    {
        $seo = $this->generateSeo(
            '🪐 Planetas e suas correspondências Mágicas',
            'Os planetas do sistema solar possuem influências mágicas e energéticas que podem ser utilizadas em rituais e
            práticas espirituais. Cada planeta rege aspectos específicos da vida e da personalidade, e compreender suas
            correspondências é essencial para a realização de feitiços e magias. Neste guia, exploramos os planetas e suas
            associações mágicas, bem como rituais e práticas relacionadas a cada um deles.',
            ['planetas', 'astrologia', 'esoterismo', 'mapa astral'],
            'website.planetas'
        );

        return view('website.tools.planetas', compact('seo'));
    }

    public function ervas()
    {
        $seo = $this->generateSeo(
            '🌿 Catálogo de Ervas Mágicas',
            'As ervas possuem energias únicas que podem ser utilizadas em rituais, feitiços e práticas espirituais. 
            Explore este guia e descubra como incorporá-las em sua jornada mística.',
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

    public function alquimias()
    {
        $seo = $this->generateSeo(
            '🔮 Catálogo de Alquimias e Magia Natural',
            'As alquimias combinam ervas, cristais, planetas e fases lunares para potencializar feitiços e práticas espirituais. Descubra combinações mágicas que ampliam a energia dos rituais.',
            ['alquimias', 'magia natural', 'cura', 'rituais', 'ervas'],
            'website.alquimias'
        );

        $alchemies = Alchemy::all();

        return view('website.alquimia.index', [
            'seo' => $seo,
            'alchemies' => $alchemies
        ]);
    }

    public function alquimia($slug)
    {
        $alchemy = Alchemy::where('slug', $slug)->firstOrFail();

        $seo = $this->generateSeo(
            $alchemy->name,
            'Saiba mais sobre a erva ' . $alchemy->name . ', suas propriedades magicas, curativas e o como usar no seu dia a dia',
            [$alchemy->slug],
            'website.erva',
            $slug
        );

        return view('website.alquimia.show', [
            'alchemy' => $alchemy,
            'seo' => $seo
        ]);
    }

    public function sobre()
    {
        $seo = $this->generateSeo(
            '📜 Sobre nós',
            'Conheça mais sobre o projeto Sabedoria Ancestral',
            ['sobre', 'história', 'missão', 'sabedoria ancestral'],
            'website.sobre'
        );

        return view('website.pages.sobre', compact('seo'));
    }
}
