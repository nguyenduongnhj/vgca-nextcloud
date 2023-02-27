<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *   schema="CreateKeyEncryptionSchema",
 *   description="Create Key Encryption User schema",
 *   @OA\Property(
 *      property="data",
 *      type="array",
 *      @OA\Items(
 *          @OA\Property(property="user_id", type="string", description="User uid của nextcloud", example="acca7421-d920-4751-b227-a21ef604f655", nullable=false),
 *          @OA\Property(property="room_id", type="string", description="Room uid", example="acca7421-d920-4751-b227-a21ef604f655", nullable=false),
 *          @OA\Property(property="key_encryption", type="string", description="key encryption", example="", nullable=false),
 *      ),
 *   ),
 * )
 */

 /**
 * @OA\Schema(
 *   schema="KeyEncryptionSchema",
 *   description="Key Encryption schema",
 *   @OA\Property(property="user_id", type="string", description="User uid của nextcloud", example="acca7421-d920-4751-b227-a21ef604f655", nullable=false),
 *   @OA\Property(property="room_id", type="string", description="Room uid", example="acca7421-d920-4751-b227-a21ef604f655", nullable=false),
 *   @OA\Property(property="key_encryption", type="string", description="key encryption", example="", nullable=false),
 * )
 */

 /**
 * @OA\Schema(
 *   schema="UpdateKeyEncryptionSchema",
 *   description="Update Key Encryption User schema",
 *   @OA\Property(
 *      property="data",
 *      type="array",
 *      @OA\Items(
 *          @OA\Property(property="user_id", type="string", description="User uid của nextcloud", example="acca7421-d920-4751-b227-a21ef604f655", nullable=false),
 *          @OA\Property(property="room_id", type="string", description="Room uid", example="acca7421-d920-4751-b227-a21ef604f655", nullable=false),
 *          @OA\Property(property="key_encryption", type="string", description="key encryption", example="", nullable=false),
 *      ),
 *   ),
 * )
 */

class KeyEncryptionUser extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'room_id', 'key_encryption'];
}
