<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Register extends Controller
{
    public function index()
    {
        // Inclure le helper de formulaire
        helper(['form']);
        $data = [];
        echo view('register', $data);
    }

    public function save()
    {
        // Inclure le helper de formulaire
        helper(['form']);
        
        // Définir les règles de validation du formulaire
        $rules = [
            'name'         => 'required|min_length[3]|max_length[20]',
            'email'        => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.user_email]',
            'password'     => 'required|min_length[6]|max_length[200]',
            'confpassword' => 'matches[password]'
        ];

        if ($this->validate($rules)) {
            $model = new UserModel();
            $data = [
                'user_name'     => $this->request->getVar('name'),
                'user_email'    => $this->request->getVar('email'),
                'user_password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'balance'       => 0.00  // Balance initiale de 0 Ariary
            ];
            $model->save($data);
            // Rediriger vers la page de dépôt initial
            return redirect()->to('/bc')->with('msg', 'Registration successful. Please make your initial deposit.');
        } else {
            $data['validation'] = $this->validator;
            echo view('register', $data);
        }
    }
}
