<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersController extends Controller
{

    public function index(Request $request){
        if($request->isJson()){
            return User::all();
        }else {
            return response()->json(['Error'=>'Unauthorized'], 401, []);
        }
    }

    public function createUser(Request $request){
        if($request->isJson()){
            $data = $this->validate($request, [
                'name'=> 'required|max:255',
                'username' => 'required',
                'email' => 'required',
                'password' => 'required'
            ]);

            $user = User::Create([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'api_token' => Str::random(60)
            ]);

            return response()->json($user, 201);
        }else {
            return response()->json(['Error'=>'Unauthorized'], 401, []);
        }
    }

    public function updateUser(Request $request, $id){
        if($request->isJson()){

            try {

                $data = $this->validate($request, [
                    'name'=> 'required|max:255',
                    'username' => 'required',
                    'email' => 'required',
                    'password' => 'required'
                ]);

                $user = User::findOrFail($id);

                $user->name = $data['name'];
                $user->username = $data['username'];
                $user->email = $data['email'];
                $user->password = $data['password'];
                $user->save();

                return response()->json($user, 200);

            } catch(ModelNotFoundException $e){
                return response()->json(['Error'=>'No content'], 406);
            }
        }else {
            return response()->json(['Error'=>'Unauthorized'], 401, []);
        }
    }

    public function deleteUser(Request $request, $id){
        if($request->isJson()){
            try{
                $user = User::findOrFail($id);
                $user->delete();
                return response()->json($user, 200);
            }catch(ModelNotFoundException $e) {
                return response()->json(['Error'=>' Not content'], 406);
            }
        }else {
            return response()->json(['Error'=>'Unauthorized'], 401, []);
        }
    }

    public function getUser(Request $request, $id){
        if($request->isJson()){
            try{
                $user = User::findOrFail($id);
                return response()->json($user, 200);
            }catch(ModelNotFoundException $e) {
                return response()->json(['Error'=>' Not content'], 406);
            }
        }else {
            return response()->json(['Error'=>'Unauthorized'], 401, []);
        }
    }



}
