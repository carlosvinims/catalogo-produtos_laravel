<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class ProductRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
         $specieId = $this->route('specie')?->id;
        return [
            'name' => ['required','string','min:3','max:150'],
            'category_id'=> ['required','exists:categories,id'],
            'price' => ['required','numeric','min:0.01'],
            'stock' => ['required','numeric','min:0'],
            'description' => ['required','string','min:10'],
            'image' => ['nullable','mimes:jpeg,png,jpg,webp','max:2048'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    #[Override]
    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.min'      => 'O camoi nome deve ter no minímo 3 caracteres.',
            'category_id.required'   => 'A categoria é obrigatória.',
            'price.required'         => 'O campo preço é obrigatório.',
            'stock.required' => 'O campo preço é obrigatório.',
            'description.required' => 'O campo descrição é obrigatório.',
        ];
    }
}
