<?php

namespace App\Models;

use CodeIgniter\Model;

class LoanRepaymentModel extends Model
{
    protected $table = 'loan_repayments';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'loan_id',
        'amount',
        'due_date',
        'paid_date',
        'status',
        'created_at',
        'updated_at',
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
