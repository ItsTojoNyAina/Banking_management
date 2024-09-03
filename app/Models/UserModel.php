<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['user_name', 'user_email', 'user_password', 'balance'];

    public function getUserInfo($userId)
    {
        return $this->asArray()->where(['user_id' => $userId])->first();
    }

    public function updateBalance($userId, $newBalance)
    {
        return $this->update($userId, ['balance' => $newBalance]);
    }
}
