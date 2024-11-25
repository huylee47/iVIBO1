<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\LoginService;

class LoginController extends Controller
{
    private $loginService;
    public function __construct(LoginService $loginService){
        $this->loginService = $loginService;
    }
    public function login(Request $request){
        return $this->loginService->login($request);
    }
}
