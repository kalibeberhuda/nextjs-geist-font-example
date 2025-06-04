<?php

namespace App\Models;

use CodeIgniter\Model;

class SavingsTransactionModel extends Model
{
    protected $table = 'savings_transactions';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'savings_account_id',
        'type',
        'amount',
        'date',
        'created_at',
        'updated_at',
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
