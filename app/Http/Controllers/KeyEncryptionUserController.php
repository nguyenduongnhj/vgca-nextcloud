<?php

namespace App\Http\Controllers;

use App\Models\KeyEncryptionUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class KeyEncryptionUserController extends Controller
{
    /**
     * @OA\Post (
     *     path="/api/key-encryption",
     *     tags={"keyEncryption"},
     *     operationId="createKeyEncrytion",
     *     description="Lưu key encrytion đối với mỗi user và room",
     *     @OA\Response(
     *          response=200,
     *          description="Trả về  key encrytion",
     *          @OA\JsonContent(ref="#/components/schemas/KeyEncryptionSchema")
     *      ),
     *     @OA\RequestBody(
     *          description="Create user object",
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/CreateKeyEncryptionSchema")
     *     )
     * )
     */
    protected function create(Request $request): \Illuminate\Http\JsonResponse
    {
        $keyEncrytion = KeyEncryptionUser::insert($request->input('data'));
        return response()->json($keyEncrytion, 200);
    }

    /**
     * @OA\Get(
     *     path="/api/key-encryption",
     *     tags={"keyEncryption"},
     *     description="User uid",
     *     @OA\Response(response=200, description="Trả về  tất cả key encrytion")
     * )
     */
    protected function list(): JsonResponse
    {
        return response()->json(KeyEncryptionUser::all(), 200);
    }

    /**
     * @OA\Get(
     *     path="/api/key-encryption/rooms/{room_id}",
     *     tags={"keyEncryption"},
     *     description="room uid",
     *     @OA\Parameter(
     *          name="room_id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              example="acca7421-d920-4751-b227-a21ef604f655",
     *          )
     *     ),
     *     @OA\Response(response=200, description="Trả về  tất cả key encrytion của 1 room")
     * )
     */
    protected function getByRoomId(string $room_id): \Illuminate\Http\JsonResponse
    {
        try {
            $user = KeyEncryptionUser::where('room_id', $room_id)->get();
        } catch (Throwable $e) {
            report($e);
            return response()->json([
                'error' => 'Room Uid không tồn tại'
            ], 404);
        }

        return response()->json($user, 200);
    }

    /**
     * @OA\Get(
     *     path="/api/key-encryption/rooms/{room_id}/users/{user_id}",
     *     tags={"keyEncryption"},
     *     description="get detail key encrytion by room uid and user uid",
     *     @OA\Parameter(
     *          name="room_id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              example="acca7421-d920-4751-b227-a21ef604f655",
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="user_id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              example="acca7421-d920-4751-b227-a21ef604f655",
     *          )
     *     ),
     *     @OA\Response(response=200, description="Trả về  key encrytion của 1 user trong room")
     * )
     */
    protected function getByUserId(string $room_id, string $user_id): \Illuminate\Http\JsonResponse
    {
        try {
            $user = KeyEncryptionUser::where(['room_id' => $room_id, 'user_id' => $user_id])->firstOrFail();
        } catch (Throwable $e) {
            report($e);
            return response()->json([
                'error' => 'Room Uid hoặc User Uid không tồn tại'
            ], 404);
        }

        return response()->json($user, 200);
    }

    /**
     * @OA\Put (
     *     path="/api/key-encryption",
     *     tags={"keyEncryption"},
     *     operationId="updateKeyEncrytion",
     *     description="Cập nhật thông tin key encrytion",
     *     @OA\Response(
     *          response=200,
     *          description="Trả về true hoặc false thể hiện thao tác thành công hay không"
     *      ),
     *     @OA\RequestBody(
     *          description="Update user object",
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateKeyEncryptionSchema")
     *     )
     * )
     */
    protected function update(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            foreach ($request->input('data') as $record) {
                
                $recordUpdate = KeyEnCryptionUser::where(['room_id' => $record['room_id'], 'user_id' => $record['user_id']])->firstOrFail();
                $recordUpdate->update($record);
            }
            
            return response()->json(true, 200);
        } catch (Throwable $e) {
            report($e);
            return response()->json([
                'error' => 'Room Uid hoặc User Uid không tồn tại'
            ], 404);
        }
    }

    /**
     * @OA\Delete (
     *     path="/api/key-encryption/rooms/{room_id}/users/{user_id}",
     *     tags={"keyEncryption"},
     *     operationId="deleteKey",
     *     description="Xoá Key",
     *     @OA\Parameter(
     *          name="room_id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              example="acca7421-d920-4751-b227-a21ef604f655",
     *          )
     *     ),
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
    protected function deleteByUserId(string $room_id, string $user_id): \Illuminate\Http\JsonResponse
    {
        try {
            $user = KeyEncryptionUser::where(['user_id' => $user_id, 'room_id' => $room_id])->firstOrFail();
            $user->delete();
        } catch (Throwable $e) {
            report($e);
            return response()->json([
                'error' => 'Room Uid hoặc User Uid không tồn tại',
                'e' => $e
            ], 404);
        }

        return response()->json(true, 204);
    }

    /**
     * @OA\Delete (
     *     path="/api/key-encryption/rooms/{room_id}",
     *     tags={"keyEncryption"},
     *     operationId="deleteAllKey",
     *     description="Xoá tất cả Key của 1 room",
     *     @OA\Parameter(
     *          name="room_id",
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
    protected function deleteByRoomId(string $room_id): \Illuminate\Http\JsonResponse
    {
        try {
            $user = KeyEncryptionUser::where('room_id', $room_id)->delete();
        } catch (Throwable $e) {
            report($e);
            return response()->json([
                'error' => 'Room Uid không tồn tại'
            ], 404);
        }

        return response()->json(true, 204);
    }
}
