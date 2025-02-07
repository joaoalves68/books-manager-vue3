<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RequestRegister extends FormRequest
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
      'name' => 'required|min:3',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|min:6',
      'password_confirm' => 'required|same:password'
    ];
  }

  public function messages()
  {
    return [
      'name.required' => 'O nome é obrigatório.',
      'name.min' => 'O nome precisa ter no mínimo 3 caracteres.',

      'email.required' => 'O e-mail é obrigatório.',
      'email.email' => 'O e-mail precisa ser válido.',
      'email.unique' => 'O e-mail já está em uso.',

      'password.required' => 'A senha é obrigatória.',
      'password.min' => 'A senha precisa ter no mínimo 6 caracteres.',

      'password_confirm.required' => 'A confirmação da senha é obrigatória.',
      'password_confirm.same' => 'As senhas não coincidem.',
    ];
  }
}
