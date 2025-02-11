<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\UserService;
use App\Http\Requests\Auth\RequestLogin;
use App\Http\Requests\Auth\RequestRegister;

class UsersController extends Controller
{
  protected $userService;

  public function __construct(UserService $userService)
  {
    $this->userService = $userService;
  }

  public function login(RequestLogin $request)
  {
    try {
      return $this->userService->loginCreateToken($request);
    } catch (\Throwable $th) {
      return response()->json(['error' => $th->getMessage()], 400);
    }
  }

  public function register(RequestRegister $request)
  {
    try {
      return $this->userService->register($request);
    } catch (\Throwable $th) {
      return response()->json(['error' => $th->getMessage()], 400);
    }
  }
}
