<?php

namespace App\Services;

use App\Models\Authors;
use App\Http\Requests\RequestAuthor;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\Auth\RequestLogin;
use App\Http\Requests\Auth\RequestRegister;
use App\Models\User;

class UserService
{
  protected function verifyCredentials(string $email, string $password)
  {
    $user = User::where('email', $email)->first();
    if($user && Hash::check($password, $user->password)){
      return $user;
    }

    return false;
  }

  public function loginCreateToken(RequestLogin $request)
  {
    $user = $this->verifyCredentials($request->email, $request->password);
    if (!$user) {
      throw ValidationException::withMessages([
        'error' => ['As credenciais fornecidas estão incorretas.'],
      ]);
    }

    return response()->json([
      'token' => $user->createToken('auth_token')->plainTextToken
    ]);
  }

  public function login(RequestLogin $request)
  {
    $user = $this->verifyCredentials($request->email, $request->password);
    if($user) {
      Auth::login($user);
    }

    return $user;
  }

  public function register(RequestRegister $request)
  {
    $user = User::create($request->validated());
    Auth::login($user);
  }
}
