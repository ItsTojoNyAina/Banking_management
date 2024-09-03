<?php namespace App\Models;

use CodeIgniter\Model;

class LoanModel extends Model
{
    protected $table = 'loans';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'amount', 'interest_rate', 'monthly_payment', 'due_date', 'status'];

    public function createLoan($data)
    {
        return $this->insert($data);
    }

    public function getLoansByUser($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }
}
