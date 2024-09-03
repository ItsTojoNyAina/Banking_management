<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Deposit extends Controller
{
    public function index()
    {
     
        helper(['form']);
        $data = [];
        echo view('deposit', $data);
    }

    public function process()
    {

        helper(['form']);
        
     
        $rules = [
            'deposit_amount' => 'required|numeric|greater_than_equal_to[10000]' 
        ];

        if ($this->validate($rules)) {
            $model = new UserModel();
            $userId = session()->get('user_id'); 
            $depositAmount = $this->request->getVar('deposit_amount');

            
            $user = $model->find($userId);
            $user['balance'] += $depositAmount;
            $model->save($user);

            // Enregistrer la transaction dans la table des transactions
            $transactionModel = new \App\Models\TransactionModel();
            $transactionModel->save([
                'user_id' => $userId,
                'type'    => 'deposit',
                'amount'  => $depositAmount
            ]);

            // Rediriger vers la page de gestion du compte
            return redirect()->to('/bc')->with('msg', 'Initial deposit successful. Your account is now active.');
        } else {
            $data['validation'] = $this->validator;
            echo view('deposit', $data);
        }
    }
}
