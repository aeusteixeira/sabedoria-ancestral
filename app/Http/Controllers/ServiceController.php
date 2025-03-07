<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $seo = $this->generateSeo(
            'Criar Servico',
            'Adicione o seu serviço esoterico e adquira novos clientes',
            ['criar', 'servico'],
            'website.service.create'
        );

        return view('website.service.create', [
            'seo' => $seo,
        ]);
    }

    public function store(StoreServiceRequest $request)
    {
        $data = $request->validated(); // Pegando apenas os dados validados
        $data['user_id'] = Auth::id();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $request->file('image')->store('services', 'public'); // Salva a imagem na pasta "storage/app/public/services"
            $data['image'] = $path;
        }

        $service = Service::create($data);

        return redirect()->route('website.service.show', ['slug' => $service->slug])
                         ->with('success', 'Serviço cadastrado com sucesso!');
    }

    public function comment(Request $request, $slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        $service->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
        ]);
        return redirect()->route('website.service.show', ['slug' => $service->slug]);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();

        // O SEO do serviço deve ser estruturado com base no nome do serviço
        $seo = $this->generateSeo(
            $service->title,
            $service->description,
            [$service->slug],
            'website.service.show',
            $slug
        );

        return view('website.service.show', [
            'service' => $service,
            'seo' => $seo
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        //
    }
}
