<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'type' => 'required|in:presencial,online',
            'contact_info' => 'required|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'O campo título é obrigatório.',
            'description.required' => 'O campo descrição é obrigatório.',
            'price.numeric' => 'O campo preço deve ser numérico.',
            'type.required' => 'O campo tipo é obrigatório.',
            'type.in' => 'O campo tipo deve ser presencial ou online.',
            'contact_info.required' => 'O campo informações de contato é obrigatório.',
            'city.required' => 'O campo cidade é obrigatório.',
            'state.required' => 'O campo estado é obrigatório.',
            'image.image' => 'O campo imagem deve ser uma imagem.',
            'image.mimes' => 'O campo imagem deve ser uma imagem JPEG, PNG, JPG ou GIF.',
            'image.max' => 'O campo imagem deve ter no máximo 2MB.',
        ];
    }
}
