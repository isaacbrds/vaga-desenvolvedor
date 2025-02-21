<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index(){
        try {
            $users = User::orderBy('id', 'DESC')->paginate(5);
    
            return response()->json([
                'status' => true,
                'users' => $users,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch users.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function show(User $user){
        $user = User::find($user);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'user' => $user
        ], 200);
    }

    public function store(UserRequest $request){
        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);
            DB::commit();
            return response()->json([
                'status' => true,
                'user' => $user,
                'message' => 'Usuário cadastrado com sucesso'
            ], 201);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Usuário não cadastrado'
            ], 400);
        }
    }

    public function update(UserRequest $request, User $user){
        DB::beginTransaction();

        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);
            DB::commit();
            return response()->json([
                'status' => true,
                'user' => $user,
                'message' => 'Usuário atualizado com sucesso'
            ], 200);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Usuário não atualizado'
            ], 400);
        }
    }

    public function destroy(User $user){
        try {
            $user->delete();
            return response()->json([
                'status' => true,
                'message' => 'Usuário deletado com sucesso'
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'Usuário nao deletado'
            ], 400);
        }
    }
}
