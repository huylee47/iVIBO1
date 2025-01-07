<?php

namespace App\Service;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService{
    public function index(){
        $users = User::with('role:id,role_name', 'status:id,status_name')->get();
        $formattedUsers = $users->map(function($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'address' => $user->address,
                'phone_number' => $user->phone_number,
                'role_name' => $user->role ? $user->role->role_name : null,
                'status_name' => $user->status ? $user->status->status_name : null,
                'limit_remaining' => $user->limit_remaining,
            ];
        });
    
        return response()->json($formattedUsers, 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    
    public function store(UserRequest $request){
        $user = User::create([
            'name' => $request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'avatar'=>$request->avatar,
            'address'=>$request->address,
            'phone_number'=>$request->phone_number,
            'role_id'=>$request->role_id,
            'status_id'=>$request->status_id,
            'limit_remaining'=>10,
            'password'=>bcrypt($request->password) ,         
        ]);
        return response()->json($user,200,[],JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    
    public function show($id){
        $user = User::with('role:id,role_name','status:id,status_name')->findOrFail($id);
        return response()->json([
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'address' => $user->address,
                'phone_number' => $user->phone_number,
                'role_name' => $user->role ? $user->role->role_name : null,
                'status_name' => $user->status ? $user->status->status_name : null,
                'limit_remaining' => $user->limit_remaining,
            ]);
    }
    public function showUID(){
        $user = Auth::user();
        $id = $user->id;
        $UID = $this->show($id);
        return response()->json($UID,200,[],JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    public function update(UserRequest $request , $id){
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->avatar = $request->avatar;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->role_id = $request->role_id;
        $user->status_id = $request->status_id;
        $user->save();
        return response()->json($user);
    }
    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        return response()->json(['message'=>'User deleted successfully']);
    }

}