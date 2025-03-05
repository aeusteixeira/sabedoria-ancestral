<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Alchemy;
use App\Models\AlchemyType;
use App\Models\Comment;
use App\Models\DayOfWeek;
use App\Models\Element;
use App\Models\Herb;
use App\Models\Moon;
use App\Models\Planet;
use App\Models\Temperature;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebsiteController extends Controller
{

    public function index()
    {
        $seo = $this->generateSeo(
            'Sabedoria Ancestral',
            'Conecte-se com a natureza e com o universo',
            ['sabedoria', 'ancestral', 'natureza', 'universo', 'ervas', 'planetas', 'astrologia'],
            'website.index'
        );

        $herbs = Herb::all();
        $alchemies = Alchemy::orderBy('created_at', 'desc')->limit(3)->get();

        return view('website.pages.index', [
            'seo' => $seo,
            'herbs' => $herbs,
            'alchemies' => $alchemies
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

}
