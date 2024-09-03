<?php namespace App\Controllers;

use App\Models\LoanModel;

class LoanController extends BaseController
{
    protected $loanModel;

    public function __construct()
    {
        $this->loanModel = new LoanModel();
    }

    public function index()
    {
        helper(['form']);
        $data = [];
        return view('loan',$data);
    }

    public function process()
    {
        $userId = session()->get('user_id');
        $amount = $this->request->getPost('amount');
        $interestRate = 5.0;  
        $monthlyPayment = $amount * ($interestRate / 100) / 12;  
        $dueDate = date('Y-m-d', strtotime('+12 months'));  

        // Créer le prêt
        $loanData = [
            'user_id' => $userId,
            'amount' => $amount,
            'interest_rate' => $interestRate,
            'monthly_payment' => $monthlyPayment,
            'due_date' => $dueDate,
            'status' => 'pending' 
        ];
        $this->loanModel->createLoan($loanData);

        return redirect()->to('/bc');
    }
}
