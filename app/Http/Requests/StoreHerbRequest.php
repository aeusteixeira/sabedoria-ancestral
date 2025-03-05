<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHerbRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Permite que qualquer usuário autenticado submeta a requisição
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:herbs,name',
            'description' => 'required|string|min:20',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // Imagem opcional, mas se existir deve ser válida
            'temperature_regent_id' => 'required|exists:temperatures,id',
            'planet_regent_id' => 'required|exists:planets,id',
            'element_regent_id' => 'required|exists:elements,id',
            'chakras' => 'required|array|min:1', // Pelo menos um chakra precisa ser selecionado
            'chakras.*' => 'exists:chakras,id', // Cada chakra enviado deve existir na tabela chakras
        ];
    }

    /**
     * Mensagens de erro personalizadas para cada validação.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O nome da erva é obrigatório.',
            'name.unique' => 'Já existe uma erva com este nome.',
            'name.max' => 'O nome da erva não pode ter mais de 255 caracteres.',

            'description.required' => 'A descrição é obrigatória.',
            'description.min' => 'A descrição deve ter pelo menos 20 caracteres.',

            'image.image' => 'O arquivo enviado deve ser uma imagem.',
            'image.mimes' => 'A imagem deve estar no formato JPG, JPEG, PNG ou WEBP.',
            'image.max' => 'O tamanho máximo da imagem é 2MB.',

            'temperature_id.required' => 'A temperatura da erva é obrigatória.',
            'temperature_id.exists' => 'A temperatura selecionada não é válida.',

            'planet_regent_id.required' => 'O planeta regente é obrigatório.',
            'planet_regent_id.exists' => 'O planeta selecionado não é válido.',

            'element_regent_id.required' => 'O elemento regente é obrigatório.',
            'element_regent_id.exists' => 'O elemento selecionado não é válido.',

            'chakras.required' => 'Selecione pelo menos um chakra associado.',
            'chakras.array' => 'O campo de chakras deve ser uma lista válida.',
            'chakras.*.exists' => 'Um dos chakras selecionados não é válido.',
        ];
    }
}
