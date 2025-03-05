<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Alchemy;
use App\Http\Requests\StoreAlchemyRequest;
use App\Http\Requests\UpdateAlchemyRequest;
use App\Models\AlchemyType;
use App\Models\Comment;
use App\Models\DayOfWeek;
use App\Models\Herb;
use App\Models\Hour;
use App\Models\Moon;
use App\Models\Stone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlchemyController extends Controller
{
    public function index(Request $request)
    {
        $seo = $this->generateSeo(
            '🔮 Catálogo de Alquimias e Magia Natural',
            'As alquimias combinam ervas, cristais, planetas e fases lunares para potencializar feitiços e práticas espirituais. Descubra combinações mágicas que ampliam a energia dos rituais.',
            ['alquimias', 'magia natural', 'cura', 'rituais', 'ervas'],
            'website.alchemy.index'
        );

        // Puxa os dados para preencher os selects
        $alquemyTypes = AlchemyType::all();
        $moons = Moon::all();
        $days = DayOfWeek::all();

        // Inicia a query base
        $query = Alchemy::query();

        // Filtro por nome da alquimia
        if ($request->filled('searchAlchemy')) {
            $query->where('name', 'LIKE', '%' . $request->searchAlchemy . '%');
        }

        // Filtro por tipo de alquimia
        if ($request->filled('alchemyTypeSelect')) {
            $query->where('alchemy_type_id', $request->alchemyTypeSelect);
        }

        // Filtro por fase da lua
        if ($request->filled('moonPhaseSelect')) {
            $query->where('moon_id', $request->moonPhaseSelect);
        }

        // Filtro por dia da semana
        if ($request->filled('dayOfWeekSelect')) {
            $query->where('day_of_week_id', $request->dayOfWeekSelect);
        }

        // Obtém os resultados filtrados
        $alchemies = $query->paginate(12); // Paginação para evitar carregamento excessivo

        return view('website.alquimia.index', [
            'seo' => $seo,
            'alchemies' => $alchemies,
            'alquemyTypes' => $alquemyTypes,
            'moons' => $moons,
            'days' => $days
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $seo = $this->generateSeo(
            'Criar Alquimia',
            'Crie sua alquimia e compartilhe com a comunidade',
            ['criar', 'alquimia'],
            'website.alchemy.create'
        );

        return view('website.alquimia.create', [
            'seo' => $seo,
            'alchemyTypes' => AlchemyType::all(),
            'moons' => Moon::all(),
            'days' => DayOfWeek::all(),
            'hours' => Hour::all(),
            'herbs' => Herb::all(),
            'stones' => Stone::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAlchemyRequest $request)
    {
        // Upload da imagem, se fornecida
        $imagePath = $request->file('image')
            ? $request->file('image')->store('alchemies', 'public')
            : null;

        // Cria a alquimia
        $alchemy = Alchemy::create([
            'name' => $request->name,
            'image' => $imagePath,
            'alchemy_type_id' => $request->alchemy_type_id,
            'description' => $request->description,
            'preparation_method' => $request->preparation_method,
            'precautions' => $request->precautions,
            'moon_id' => $request->moon_id,
            'day_of_week_id' => $request->day_of_week_id,
            'hour_id' => $request->hour_id,
            'user_id' => Auth::id(),
        ]);

        // Relacionamentos Many-to-Many
        if ($request->has('herbs')) {
            $alchemy->herbs()->sync($request->herbs);
        }
        if ($request->has('stones')) {
            $alchemy->stones()->sync($request->stones);
        }
        if ($request->has('elements')) {
            $alchemy->elements()->sync($request->elements);
        }

        return redirect()->route('website.alchemy.show', ['slug' => $alchemy->slug])->with('success', 'Alquimia criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $alchemy = Alchemy::where('slug', $slug)->firstOrFail();

        $seo = $this->generateSeo(
            $alchemy->name,
            'Veja como fazer ' . $alchemy->name . ', suas propriedades magicas, curativas e o como usar no seu dia a dia',
            [$alchemy->slug],
            'website.alchemy.show',
            $slug
        );

        return view('website.alquimia.show', [
            'alchemy' => $alchemy,
            'seo' => $seo
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alchemy $alchemy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAlchemyRequest $request, Alchemy $alchemy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alchemy $alchemy)
    {
        //
    }

    public function comment(StoreCommentRequest $request)
    {
        Comment::create([
            'user_id' => Auth::user()->id,
            'alchemy_id' => $request->alchemy_id, // ID da alquimia associada
            'content' => $request->content, // Texto do comentário
            'rating' => $request->rating, // Avaliação por estrelas
            'parent_id' => $request->parent_id, // Se for uma resposta, associa ao comentário original
        ]);

        return back()->with('success', 'Comentário enviado com sucesso!');
    }
}
