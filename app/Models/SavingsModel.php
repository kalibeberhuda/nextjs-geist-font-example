<?php

namespace App\Models;

use CodeIgniter\Model;

class SavingsModel extends Model
{
    protected $table = 'savings_accounts';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'member_id',
        'type',
        'balance',
        'interest_rate',
        'created_at',
        'updated_at',
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
