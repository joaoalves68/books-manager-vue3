<?php

namespace App\Services;

use App\Models\Authors;
use App\Http\Requests\RequestAuthor;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\RequestUser;
use App\Models\User;

class UserService
{
  public function loginCreateToken(RequestUser $request)
  {
    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
      throw ValidationException::withMessages([
        'error' => ['As credenciais fornecidas estão incorretas.'],
      ]);
    }

    return response()->json([
      'token' => $user->createToken('auth_token')->plainTextToken
    ]);
  }
}
