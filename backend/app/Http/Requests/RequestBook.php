<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestBook extends FormRequest
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
      'title' => 'required|string|max:255|min:3',
      'description' => 'required|string',
      'published_at' => 'required|date|before_or_equal:today',
      'author_id' => 'required|exists:authors,id',
      'cover' => 'image|mimes:jpg,png,jpeg|max:2048'
    ];
  }

  public function messages()
  {
    return [
      'title.required' => 'O título é obrigatório.',
      'title.string' => 'O título deve ser uma string válida.',
      'title.max' => 'O título não pode ter mais de 255 caracteres.',
      'title.min' => 'O título não pode ter menos de 3 caracteres.',

      'description.required' => 'A descrição é obrigatória.',
      'description.string' => 'A descrição deve ser uma string válida.',

      'published_at.required' => 'A data de publicação é obrigatória.',
      'published_at.date' => 'A data de publicação deve ser uma data válida.',
      'published_at.before_or_equal' => 'A data de publicação não pode ser uma data futura.',

      'author_id.required' => 'O autor é obrigatório.',
      'author_id.exists' => 'O autor informado não existe.',

      'cover.image' => 'A capa do livro precisa ser uma imagem.',
      'cover.mimes' => 'A capa do livro precisa ser jpg ou png.',
      'cover.max' => 'A capa do livro não pode ser maior do que 2mb.',
    ];
  }
}
