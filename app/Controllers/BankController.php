<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\TransactionModel;
use App\Models\LoanModel;

class BankController extends BaseController
{
    protected $userModel;
    protected $transactionModel;
    protected $loanModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->transactionModel = new TransactionModel();
        $this->loanModel = new LoanModel();
    }

    public function index()
    {
        $userId = session()->get('user_id');

        if (!$userId) {
            return redirect()->to('/')->with('error', 'User not logged in.');
        }

        $userInfo = $this->userModel->find($userId);
    
        if (!$userInfo) {
            return redirect()->to('/')->with('error', 'User not found.');
        }
    
        $loans = $this->loanModel->getLoansByUser($userId);

        return view('home', ['userInfo' => $userInfo, 'loans' => $loans]);


    }

   
}
