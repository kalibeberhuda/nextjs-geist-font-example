<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LoanModel;
use App\Models\LoanRepaymentModel;
use Config\Services;

class Loans extends Controller
{
    protected $loanModel;
    protected $repaymentModel;
    protected $session;

    public function __construct()
    {
        $this->loanModel = new LoanModel();
        $this->repaymentModel = new LoanRepaymentModel();
        $this->session = Services::session();
    }

    public function index()
    {
        // List loans for logged-in member
        $memberId = $this->session->get('id');
        $data['loans'] = $this->loanModel->where('member_id', $memberId)->findAll();
        echo view('loans/index', $data);
    }

    public function apply()
    {
        helper(['form']);
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'amount' => 'required|decimal|greater_than[0]',
                'term' => 'required|integer|greater_than[0]',
                'interest_rate' => 'required|decimal|greater_than[0]',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $newLoan = [
                    'member_id' => $this->session->get('id'),
                    'amount' => $this->request->getPost('amount'),
                    'interest_rate' => $this->request->getPost('interest_rate'),
                    'term' => $this->request->getPost('term'),
                    'status' => 'pending',
                ];

                $this->loanModel->save($newLoan);
                $this->session->setFlashdata('success', 'Loan application submitted. Awaiting approval.');
                return redirect()->to('/loans/apply');
            }
        }

        echo view('loans/apply', $data);
    }

    public function approve($loanId)
    {
        // Only admin/staff can approve loans - check role here (not implemented yet)
        $loan = $this->loanModel->find($loanId);
        if ($loan) {
            $loan['status'] = 'approved';
            $this->loanModel->save($loan);
            $this->session->setFlashdata('success', 'Loan approved successfully.');
        } else {
            $this->session->setFlashdata('error', 'Loan not found.');
        }
        return redirect()->to('/admin/loans');
    }
}
