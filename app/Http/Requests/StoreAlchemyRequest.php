<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAlchemyRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta ação.
     */
    public function authorize(): bool
    {
        return auth()->check(); // Apenas usuários logados podem criar alquimias
    }

    /**
     * Define as regras de validação para a criação de alquimias.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:alchemies,name',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'alchemy_type_id' => 'required|exists:alchemy_types,id',
            'description' => 'required|string',
            'preparation_method' => 'required|string',
            'precautions' => 'nullable|string',
            'moon_id' => 'nullable|exists:moons,id',
            'day_of_week_id' => 'nullable|exists:day_of_weeks,id',
            'hour_id' => 'nullable|exists:hours,id',
            'herbs' => 'nullable|array',
            'herbs.*' => 'exists:herbs,id',
            'stones' => 'nullable|array',
            'stones.*' => 'exists:stones,id',
            'elements' => 'nullable|array',
            'elements.*' => 'exists:elements,id',
        ];
    }

    /**
     * Define mensagens de erro personalizadas.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O nome da alquimia é obrigatório.',
            'name.unique' => 'Já existe uma alquimia com esse nome.',
            'image.image' => 'O arquivo deve ser uma imagem.',
            'alchemy_type_id.required' => 'Selecione um tipo de alquimia.',
            'description.required' => 'A descrição é obrigatória.',
            'preparation_method.required' => 'O método de preparo é obrigatório.',
            'moon_id.exists' => 'Selecione uma fase lunar válida.',
            'day_of_week_id.exists' => 'Selecione um dia da semana válido.',
            'hour_id.exists' => 'Selecione uma hora planetária válida.',
        ];
    }
}
