<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestAuthor extends FormRequest
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
      'name' => 'required|string|max:255|min:3',
      'state' => 'required|string|max:255|min:3',
    ];
  }

  public function messages()
  {
    return [
      'name.required' => 'O nome é obrigatório.',
      'name.string' => 'O nome deve ser uma string válida.',
      'name.max' => 'O nome não pode ter mais de 255 caracteres.',
      'name.min' => 'O nome não pode ter menos de 3 caracteres.',

      'state.required' => 'O estado é obrigatório.',
      'state.string' => 'O estado deve ser uma string válida.',
      'state.max' => 'O estado não pode ter mais de 255 caracteres.',
      'state.min' => 'O estado não pode ter menos de 3 caracteres.',
    ];
  }
}
