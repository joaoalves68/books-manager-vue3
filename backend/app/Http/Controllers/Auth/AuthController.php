<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Services\UserService;
use App\Http\Requests\Auth\RequestLogin;
use App\Http\Requests\Auth\RequestRegister;
use App\Models\User;

class AuthController extends Controller
{
  protected $userService;

  public function __construct(UserService $userService)
  {
    $this->userService = $userService;
  }

  public function showLogin()
  {
    if(Auth::check()){
      return redirect()->route('dashboard');
    }

    return view('auth.login');
  }

  public function showRegister()
  {
    if(Auth::check()){
      return redirect()->route('dashboard');
    }

    return view('auth.register');
  }

  public function login(RequestLogin $request)
  {
    if($this->userService->login($request)){
      return redirect()->route('dashboard')->with('success', 'Login realizado com sucesso!');
    }

    return back()->withErrors(['error' => 'As credenciais fornecidas estão incorretas.']);
  }

  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
  }

  public function register(RequestRegister $request)
  {
    $this->userService->register($request);

    return redirect()->route('dashboard');
  }
}
