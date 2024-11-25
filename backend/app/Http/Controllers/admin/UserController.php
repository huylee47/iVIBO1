<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Service\UserService;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService){
        $this->userService = $userService;
    }
    public function index(){
        return  $this->userService->index();
    }
    public function store(UserRequest $request){
        return  $this->userService->store($request);
    }
    public function show($id){
        return  $this->userService->show($id);
    }
    public function update(UserRequest $request ,$id){
        return  $this->userService->update($request, $id);
    }
    public function destroy($id){
        return  $this->userService->destroy($id);
    }
}
