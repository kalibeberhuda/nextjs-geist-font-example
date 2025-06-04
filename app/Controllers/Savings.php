<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\SavingsModel;
use App\Models\SavingsTransactionModel;
use Config\Services;

class Savings extends Controller
{
    protected $savingsModel;
    protected $transactionModel;
    protected $session;

    public function __construct()
    {
        $this->savingsModel = new SavingsModel();
        $this->transactionModel = new SavingsTransactionModel();
        $this->session = Services::session();
    }

    public function index()
    {
        // List savings accounts for logged-in member
        $memberId = $this->session->get('id');
        $data['accounts'] = $this->savingsModel->where('member_id', $memberId)->findAll();
        echo view('savings/index', $data);
    }

    public function deposit($accountId)
    {
        helper(['form']);
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'amount' => 'required|decimal|greater_than[0]',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $amount = $this->request->getPost('amount');
                $account = $this->savingsModel->find($accountId);

                if ($account) {
                    $account->balance += $amount;
                    $this->savingsModel->save($account);

                    $transaction = [
                        'savings_account_id' => $accountId,
                        'type' => 'deposit',
                        'amount' => $amount,
                        'date' => date('Y-m-d H:i:s'),
                    ];
                    $this->transactionModel->save($transaction);

                    $this->session->setFlashdata('success', 'Deposit successful.');
                    return redirect()->to('/savings');
                } else {
                    $data['error'] = 'Account not found.';
                }
            }
        }

        echo view('savings/deposit', $data);
    }

    public function withdraw($accountId)
    {
        helper(['form']);
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'amount' => 'required|decimal|greater_than[0]',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $amount = $this->request->getPost('amount');
                $account = $this->savingsModel->find($accountId);

                if ($account) {
                    if ($account->balance >= $amount) {
                        $account->balance -= $amount;
                        $this->savingsModel->save($account);

                        $transaction = [
                            'savings_account_id' => $accountId,
                            'type' => 'withdrawal',
                            'amount' => $amount,
                            'date' => date('Y-m-d H:i:s'),
                        ];
                        $this->transactionModel->save($transaction);

                        $this->session->setFlashdata('success', 'Withdrawal successful.');
                        return redirect()->to('/savings');
                    } else {
                        $data['error'] = 'Insufficient balance.';
                    }
                } else {
                    $data['error'] = 'Account not found.';
                }
            }
        }

        echo view('savings/withdraw', $data);
    }
}
