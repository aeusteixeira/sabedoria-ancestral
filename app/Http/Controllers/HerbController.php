<?php

namespace App\Http\Controllers;

use App\Models\Herb;
use App\Http\Requests\StoreHerbRequest;
use App\Http\Requests\UpdateHerbRequest;
use App\Models\Chakra;
use App\Models\Element;
use App\Models\Planet;
use App\Models\Temperature;
use Illuminate\Http\Request;

class HerbController extends Controller
{
    public function index(Request $request)
    {
        $seo = $this->generateSeo(
            '🌿 Catálogo de Ervas Mágicas',
            'As ervas possuem energias únicas que podem ser utilizadas em rituais, feitiços e práticas espirituais.
            Explore este guia e descubra como incorporá-las em sua jornada mística.',
            ['ervas', 'magia natural', 'cura', 'rituais'],
            'website.herb.index'
        );

        // Puxa os dados para preencher os selects
        $planets = Planet::all();
        $temperatures = Temperature::all();
        $elements = Element::all();

        // Inicia a query base
        $query = Herb::query();

        // Filtro por nome
        if ($request->filled('searchName')) {
            $query->where('name', 'LIKE', '%' . $request->searchName . '%');
        }

        // Filtro por tipo (morna, fria, quente)
        if ($request->filled('typeSelect')) {
            $query->whereHas('temperature', function ($q) use ($request) {
                $q->where('id', $request->typeSelect);
            });
        }

        // Filtro por planeta regente
        if ($request->filled('planetSelect')) {
            $query->whereHas('planet', function ($q) use ($request) {
                $q->where('id', $request->planetSelect);
            });
        }

        // Filtro por elemento
        if ($request->filled('elementSelect')) {
            $query->whereHas('element', function ($q) use ($request) {
                $q->where('id', $request->elementSelect);
            });
        }

        // Obtém os resultados filtrados
        $herbs = $query->paginate(12); // Paginação para evitar carregamento excessivo

        return view('website.ervas.index', [
            'seo' => $seo,
            'herbs' => $herbs,
            'planets' => $planets,
            'temperatures' => $temperatures,
            'elements' => $elements
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $temperatures = Temperature::all();
        $planets = Planet::all();
        $elements = Element::all();
        $chakras = Chakra::all();

        $seo = $this->generateSeo(
            'Nova erva',
            'Crie uma nova erva com as informações abaixo',
            ['nova', 'erva'],
            'website.herb.create'
        );

        return view('website.ervas.create', [
            'seo' => $seo,
            'temperatures' => $temperatures,
            'planets' => $planets,
            'elements' => $elements,
            'chakras' => $chakras
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHerbRequest $request)
    {
        $herb = new Herb($request->all());
        $herb->save();
        $herb->chakras()->sync($request->chakras);
        return redirect()->route('website.herb.show', ['slug' => $herb->slug]);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $herb = Herb::where('slug', $slug)->firstOrFail();

        $herb->load('alchemies');
        $seo = $this->generateSeo(
            $herb->name,
            'Saiba mais sobre a erva ' . $herb->name . ', suas propriedades magicas, curativas e o como usar no seu dia a dia',
            [$herb->slug],
            'website.herb.show',
            $slug
        );

        return view('website.ervas.show', [
            'herb' => $herb,
            'seo' => $seo
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Herb $herb)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHerbRequest $request, Herb $herb)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Herb $herb)
    {
        //
    }
}
