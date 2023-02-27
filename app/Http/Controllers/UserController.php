<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class UserController extends Controller
{
    /**
     * @OA\Post (
     *     path="/api/users",
     *     tags={"users"},
     *     operationId="createUser",
     *     description="Lưu user và thông tin chứng thực của user (public key, x509 certificate)",
     *     @OA\Response(
     *          response=200,
     *          description="Trả về user",
     *          @OA\JsonContent(ref="#/components/schemas/UserSchema")
     *      ),
     *     @OA\RequestBody(
     *          description="Create user object",
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/CreateUserSchema")
     *     )
     * )
     */
    protected function create(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = User::create($request->all());
        return response()->json($user, 200);
    }

    /**
     * @OA\Get(
     *     path="/api/users/{user_id}/public-key",
     *     tags={"users"},
     *     description="User uid",
     *     @OA\Parameter(
     *          name="user_id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              example="acca7421-d920-4751-b227-a21ef604f655",
     *          )
     *     ),
     *     @OA\Response(response=200, description="Trả về public key")
     * )
     */
    protected function getPublicKey(string $user_id): \Illuminate\Http\JsonResponse
    {
        try {
            $user = User::where('user_id', $user_id)->firstOrFail();
        } catch (Throwable $e) {
            report($e);
            return response()->json([
                'error' => 'User Uid không tồn tại'
            ], 404);
        }

        return response()->json($user->public_key, 200);
    }

    /**
     * @OA\Get(
     *     path="/api/v2/users/{id}/public-key",
     *     tags={"users v2"},
     *     description="User uid",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              example="1",
     *          )
     *     ),
     *     @OA\Response(response=200, description="Trả về public key")
     * )
     */
    protected function getPublicKeyById(string $id): \Illuminate\Http\JsonResponse
    {
        try {
            $user = User::where('id', $id)->firstOrFail();
        } catch (Throwable $e) {
            report($e);
            return response()->json([
                'error' => 'id không tồn tại'
            ], 404);
        }

        return response()->json($user->public_key, 200);
    }



    // protected function get(string $user_id): \Illuminate\Http\JsonResponse
    // {
    //     try {
    //         $user = User::where('user_id', $user_id)->firstOrFail();
    //     } catch (Throwable $e) {
    //         report($e);
    //         return response()->json([
    //             'error' => 'User Uid không tồn tại'
    //         ], 404);
    //     }

    //     return response()->json($user, 200);
    // }

    /**
     * @OA\Get(
     *     path="/api/users/{user_id}",
     *     tags={"users"},
     *     description="User uid",
     *     @OA\Parameter(
     *          name="user_id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              example="acca7421-d920-4751-b227-a21ef604f655",
     *          )
     *     ),
     *     @OA\Response(response=200, description="Trả về user token")
     * )
     */
    protected function get(string $user_id): \Illuminate\Http\JsonResponse
    {
        try {
            $user = User::where('user_id', $user_id)->firstOrFail();
        } catch (Throwable $e) {
            report($e);
            return response()->json([
                'error' => 'User Uid không tồn tại'
            ], 404);
        }

        return response()->json($user, 200);
    }

    /**
     * @OA\Get(
     *     path="/api/v2/users/{id}",
     *     tags={"users v2"},
     *     description="User uid",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              example="1",
     *          )
     *     ),
     *     @OA\Response(response=200, description="Trả về user token")
     * )
     */
    protected function getById(string $id): \Illuminate\Http\JsonResponse
    {
        try {
            $user = User::where('id', $id)->firstOrFail();
        } catch (Throwable $e) {
            report($e);
            return response()->json([
                'error' => 'User Uid không tồn tại'
            ], 404);
        }

        return response()->json($user, 200);
    }

    /**
     * @OA\Post (
     *     path="/api/users/verify-signature",
     *     tags={"users"},
     *     description="User",
     *     @OA\Response(response=200, description="Trả về true hoặc false thể hiện signutare có hợp lệ hay không"),
     *     @OA\RequestBody(
     *          description="Create user object",
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/VerifySignatureBody")
     *     )
     * )
     */
    /**
     * @OA\Schema(
     *   schema="VerifySignatureBody",
     *   description="Verify Signature Body",
     *   @OA\Property(property="user_id", type="string", description="User uid của nextcloud", example="acca7421-d920-4751-b227-a21ef604f655", nullable=false),
     *   @OA\Property(property="signature", type="string", description="Loại token", example="", nullable=false),
     * )
     */
    protected function verifySignature(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = User::firstWhere('user_id', $request->input('user_id'));

        if ($user == null) {
            return response()->json(false, 200);
        }

        return response()->json(true, 200);
    }

    /**
     * @OA\Post (
     *     path="/api/v2/users/verify-signature",
     *     tags={"users v2"},
     *     description="User",
     *     @OA\Response(response=200, description="Trả về true hoặc false thể hiện signutare có hợp lệ hay không"),
     *     @OA\RequestBody(
     *          description="Create user object",
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/VerifySignatureBody_v2")
     *     )
     * )
     */
     /**
     * @OA\Schema(
     *   schema="VerifySignatureBody_v2",
     *   description="Verify Signature Body",
     *   @OA\Property(property="id", type="string", description="id của user", example="1", nullable=false),
     *   @OA\Property(property="signature", type="string", description="Loại token", example="", nullable=false),
     * )
     */
    protected function verifySignatureById(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = User::firstWhere('id', $request->input('id'));

        if ($user == null) {
            return response()->json(false, 200);
        }

        return response()->json(true, 200);
    }

    /**
     * @OA\Put (
     *     path="/api/users/{user_id}",
     *     tags={"users"},
     *     operationId="updateUser",
     *     description="Cập nhật thông tin của User",
     *     @OA\Parameter(
     *          name="user_id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              example="acca7421-d920-4751-b227-a21ef604f655",
     *          )
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Trả về true hoặc false thể hiện thao tác thành công hay không"
     *      ),
     *     @OA\RequestBody(
     *          description="Update user object",
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateUserSchema")
     *     )
     * )
     */
    protected function update(Request $request, string $user_id): \Illuminate\Http\JsonResponse
    {
        $user = User::where('user_id', $user_id)->firstOrFail();
        $user->update($request->all());

        return response()->json($user, 200);
    }

    /**
     * @OA\Put (
     *     path="/api/v2/users/{id}",
     *     tags={"users v2"},
     *     operationId="updateUser",
     *     description="Cập nhật thông tin của User",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              example="1",
     *          )
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Trả về true hoặc false thể hiện thao tác thành công hay không"
     *      ),
     *     @OA\RequestBody(
     *          description="Update user object",
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateUserSchema")
     *     )
     * )
     */
    protected function updateById(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        $user = User::where('id', $id)->firstOrFail();
        $user->update($request->all());

        return response()->json($user, 200);
    }

    /**
     * @OA\Delete (
     *     path="/api/users/{user_id}",
     *     tags={"users"},
     *     operationId="deleteUser",
     *     description="Xoá user",
     *     @OA\Parameter(
     *          name="user_id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              example="acca7421-d920-4751-b227-a21ef604f655",
     *          )
     *     ),
     *     @OA\Response(
     *          response=204,
     *          description="No content"
     *      ),
     * )
     */
    protected function delete(string $user_id): \Illuminate\Http\JsonResponse
    {
        $user = User::where('user_id', $user_id)->firstOrFail();
        $user->delete();

        return response()->json(true, 204);
    }

    /**
     * @OA\Delete (
     *     path="/api/v2/users/{id}",
     *     tags={"users v2"},
     *     operationId="deleteUser",
     *     description="Xoá user",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              example="1",
     *          )
     *     ),
     *     @OA\Response(
     *          response=204,
     *          description="No content"
     *      ),
     * )
     */
    protected function deleteById(string $id): \Illuminate\Http\JsonResponse
    {
        $user = User::where('id', $id)->firstOrFail();
        $user->delete();

        return response()->json(true, 204);
    }

    /**
     * @OA\Get(
     *     path="/api/users",
     *     tags={"users"},
     *     description="User uid",
     *     @OA\Response(response=200, description="Trả về list user tokens")
     * )
     */
    protected function list(): JsonResponse
    {
        return response()->json(User::all(), 200);
    }

    protected function findByThumbprint(string $thumbprint): JsonResponse
    {
        $user = User::firstWhere('thumbprint', $thumbprint);

        if ($user)
        {
            return response()->json($user, 200);
        }

        return response()->json(null, 404);
    }
}
