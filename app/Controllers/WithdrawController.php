<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\TransactionModel;

class WithDrawController extends BaseController
{
    public function index()
    {

        helper(['form']);
        $data = [];
        echo view('withdraw', $data);
    }

    public function process()
    {

        helper(['form']);    
        $rules = [
            'withdraw_amount' => 'required|numeric|greater_than[0]' 
        ];

        if ($this->validate($rules)) {
            $model = new UserModel();
            $userId = session()->get('user_id'); 
            $withdrawAmount = $this->request->getVar('withdraw_amount');

            // Trouver l'utilisateur
            $user = $model->find($userId);

            // Vérifier que l'utilisateur a suffisamment de solde pour le retrait
            if ($user['balance'] >= $withdrawAmount) {
                // Mettre à jour le solde
                $user['balance'] -= $withdrawAmount;
                $model->save($user);

                // Enregistrer la transaction dans la table des transactions
                $transactionModel = new \App\Models\TransactionModel();
                $transactionModel->save([
                    'user_id' => $userId,
                    'type'    => 'withdrawal',
                    'amount'  => $withdrawAmount
                ]);

                
                return redirect()->to('/bc')->with('msg', 'Withdrawal successful.');
            } else {
                
                return redirect()->back()->with('error', 'Insufficient balance for this withdrawal.');
            }
        } else {
            $data['validation'] = $this->validator;
            echo view('withdraw', $data);
        }
    }
}
