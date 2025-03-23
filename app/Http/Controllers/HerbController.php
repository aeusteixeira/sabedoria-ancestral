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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        // Upload da imagem, se fornecida
        $imagePath = $request->file('image')
        ? $request->file('image')->store('alchemies', 'public')
        : null;
        $herb = Herb::create([
            'name' => $request->name,
            'description' => $request->description,
            'history_origin' => $request->history_origin,
            'magical_uses' => $request->magical_uses,
            'biological_uses' => $request->biological_uses,
            'precautions' => $request->precautions,
            'image' => $imagePath,
            'planet_regent_id' => $request->planet_regent_id,
            'element_regent_id' => $request->element_regent_id,
            'temperature_regent_id' => $request->temperature_regent_id,
            'user_id' => Auth::id(),
        ]);

        $herb->chakras()->sync($request->chakras);
        return redirect()->route('website.herb.show', ['slug' => $herb->slug])->with('success', 'Alquimia criada com sucesso!');
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
    public function edit($slug)
    {
        $herb = Herb::where('slug', $slug)->firstOrFail();
        $temperatures = Temperature::all();
        $planets = Planet::all();
        $elements = Element::all();
        $chakras = Chakra::all();

        $seo = $this->generateSeo(
            'Editar erva',
            'Atualize as informações da erva cadastrada',
            ['editar', 'erva'],
            'website.herb.edit',
            $slug
        );

        return view('website.ervas.edit', [
            'seo' => $seo,
            'herb' => $herb,
            'temperatures' => $temperatures,
            'planets' => $planets,
            'elements' => $elements,
            'chakras' => $chakras
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHerbRequest $request)
    {
        $herb = Herb::where('id', $request->id)->firstOrFail();
        // Se houver uma nova imagem, armazena e remove a antiga
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('alchemies', 'public');

            // Remove a imagem antiga, se existir
            if ($herb->image) {
                Storage::disk('public')->delete($herb->image);
            }

            // Atualiza o campo de imagem do modelo
            $herb->image = $imagePath;
        }

        // Atualiza os dados da erva (exceto chakras)
        $herb->update($request->except('chakras', 'image'));

        // 🔄 Verifica se o ID da erva está disponível antes do sync
        if (!$herb->id) {
            return back()->with('error', 'Erro ao atualizar a erva. Tente novamente.');
        }

        // 🔄 Sincroniza os chakras corretamente
        if ($request->has('chakras')) {
            $herb->chakras()->sync($request->chakras);
        } else {
            $herb->chakras()->detach(); // Remove todos os chakras caso nenhum seja selecionado
        }

        return redirect()->route('website.herb.show', ['slug' => $herb->slug])
            ->with('success', 'Erva atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $herb = Herb::where('id', $request->id)->firstOrFail();
        $herb->delete();
        return redirect()->route('website.herb.index')->with('success', 'Alquimia excluida com sucesso!');
    }
}
