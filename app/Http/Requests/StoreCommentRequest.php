<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (Auth::guest()) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //dd($this->all());
        return [
            'content' => 'required|string|max:1000',
            'rating' => 'nullable|integer|min:1|max:5',
            'alchemy_id' => 'required|exists:alchemies,id',
            'parent_id' => 'nullable|exists:comments,id',
        ];
    }
}
