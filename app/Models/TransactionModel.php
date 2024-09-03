<?php namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transactions';
    protected $allowedFields = ['user_id', 'type', 'amount', 'date'];

    public function createTransaction($data)
    {
        return $this->insert($data);
    }
}
