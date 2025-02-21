<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Mostra todos os usuários cadastrados.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse {
        try {
            $users = User::orderBy('id', 'DESC')->paginate(5);
    
            return response()->json([
                'status' => true,
                'users' => $users,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Falha ao buscar usuários.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Mostra um usuário específico.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse {
        return response()->json([
            'status' => true,
            'user' => $user
        ], 200);
    }

    /**
     * Cria um novo usuário.
     *
     * <b>POST /api/users</b>
     *
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function store(UserRequest $request): JsonResponse {
        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
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

    /**
     * Atualiza um usuário existente.
     *
     * <b>PUT /api/users/{user}</b>
     *
     * @param UserRequest $request
     * @param User $user
     * @return JsonResponse
     */

    public function update(UserRequest $request, User $user): JsonResponse {
        DB::beginTransaction();

        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->has('password') ? Hash::make($request->password) : $user->password,
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

    /**
     * Deleta um usuário existente.
     *
     * <b>DELETE /api/users/{user}</b>
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse {
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
