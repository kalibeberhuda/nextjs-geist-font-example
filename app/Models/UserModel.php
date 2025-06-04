<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'email',
        'password_hash',
        'role',
        'google_id',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function getUserByGoogleId($googleId)
    {
        return $this->where('google_id', $googleId)->first();
    }
}
