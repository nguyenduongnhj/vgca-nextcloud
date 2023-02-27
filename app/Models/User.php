<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *   schema="CreateUserSchema",
 *   description="Create User schema",
 *   @OA\Property(property="user_id or id", type="string", description="User uid của nextcloud", example="acca7421-d920-4751-b227-a21ef604f655 or 1,2,3", nullable=false),
 *   @OA\Property(property="token_type", type="string", description="Loại token", example="Safenet EToken 5510", nullable=false),
 *   @OA\Property(property="token_name", type="string", description="Tên Token", example="Token BCY", nullable=false),
 *   @OA\Property(property="public_key", type="string", description="Public Key", example="", nullable=false),
 *   @OA\Property(property="x509_cert", type="string", description="X509 certificate", example="", nullable=false),
 *   @OA\Property(property="thumbprint", type="string", description="X509 certificate", example="", nullable=false),
 *   @OA\Property(property="publicKeyNoXGCA_XML", type="string", description="X509 certificate", example="", nullable=false),
 *   @OA\Property(property="publicKeyNoXGCA_Base64", type="string", description="X509 certificate", example="", nullable=false),
 *   @OA\Property(property="note", type="string", description="Ghi chú", example="", nullable=true),
 * )
 */
/**
 * @OA\Schema(
 *   schema="UpdateUserSchema",
 *   description="Update User schema",
 *   @OA\Property(property="token_type", type="string", description="Loại token", example="Safenet EToken 5510", nullable=true),
 *   @OA\Property(property="token_name", type="string", description="Tên Token", example="Token BCY", nullable=true),
 *   @OA\Property(property="public_key", type="string", description="Public Key", example="", nullable=true),
 *   @OA\Property(property="x509_cert", type="string", description="X509 certificate", example="", nullable=true),
 *   @OA\Property(property="thumbprint", type="string", description="X509 certificate", example="", nullable=true),
 *   @OA\Property(property="publicKeyNoXGCA_XML", type="string", description="X509 certificate", example="", nullable=true),
 *   @OA\Property(property="publicKeyNoXGCA_Base64", type="string", description="X509 certificate", example="", nullable=true),
 *   @OA\Property(property="note", type="string", description="Ghi chú", example="", nullable=true),
 * )
 */

/**
 * @OA\Schema(
 *   schema="UserSchema",
 *   description="User schema",
 *   @OA\Property(property="id", type="integer", description="Primary key", example="1", nullable=false),
 *   @OA\Property(property="user_id", type="string", description="User uid của nextcloud", example="acca7421-d920-4751-b227-a21ef604f655", nullable=false),
 *   @OA\Property(property="token_type", type="string", description="Loại token", example="Safenet EToken 5510", nullable=false),
 *   @OA\Property(property="token_name", type="string", description="Tên Token", example="Token BCY", nullable=false),
 *   @OA\Property(property="public_key", type="string", description="Public Key", example="", nullable=false),
 *   @OA\Property(property="x509_cert", type="string", description="X509 certificate", example="", nullable=false),
 *   @OA\Property(property="publicKeyNoXGCA_XML", type="string", description="X509 certificate", example="", nullable=false),
 *   @OA\Property(property="publicKeyNoXGCA_Base64", type="string", description="X509 certificate", example="", nullable=false),
 *   @OA\Property(property="thumbprint", type="string", description="X509 certificate", example="", nullable=false),
 *   @OA\Property(property="note", type="string", description="Ghi chú", example="", nullable=true),
 * )
 */
class User extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'token_type', 'token_name', 'public_key', 'x509_cert', 'note', 'thumbprint', 'publicKeyNoXGCA_XML', 'publicKeyNoXGCA_Base64'];
}
