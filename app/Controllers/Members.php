<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MemberModel;
use Config\Services;

class Members extends Controller
{
    protected $memberModel;
    protected $session;

    public function __construct()
    {
        $this->memberModel = new MemberModel();
        $this->session = Services::session();
    }

    public function register()
    {
        helper(['form']);
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'full_name' => 'required|min_length[3]|max_length[255]',
                'email' => 'required|valid_email|is_unique[members.email]',
                'phone' => 'required|min_length[10]|max_length[15]',
                'password' => 'required|min_length[6]|max_length[255]',
                'password_confirm' => 'matches[password]',
                'kyc_document' => 'uploaded[kyc_document]|max_size[kyc_document,2048]|ext_in[kyc_document,pdf,jpg,jpeg,png]',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $file = $this->request->getFile('kyc_document');
                if ($file->isValid() && !$file->hasMoved()) {
                    // Validate MIME type for security
                    $allowedMimeTypes = ['application/pdf', 'image/jpeg', 'image/png'];
                    if (!in_array($file->getMimeType(), $allowedMimeTypes)) {
                        $data['error'] = 'Invalid file type for KYC document.';
                        echo view('members/register', $data);
                        return;
                    }
                    $newName = $file->getRandomName();
                    $file->move(WRITEPATH . 'uploads/kyc', $newName);
                } else {
                    $newName = null;
                }

                $newMember = [
                    'full_name' => $this->request->getPost('full_name'),
                    'email' => $this->request->getPost('email'),
                    'phone' => $this->request->getPost('phone'),
                    'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'membership_tier' => 'basic',
                    'status' => 'pending',
                    'kyc_documents' => $newName,
                ];

                $this->memberModel->save($newMember);
                $this->session->setFlashdata('success', 'Registration successful. Awaiting approval.');
                return redirect()->to('/members/register');
            }
        }

        echo view('members/register', $data);
    }

    public function approve($memberId)
    {
        // Only admin/staff can approve members - check role here (not implemented yet)
        $member = $this->memberModel->find($memberId);
        if ($member) {
            $member['status'] = 'approved';
            $this->memberModel->save($member);
            $this->session->setFlashdata('success', 'Member approved successfully.');
        } else {
            $this->session->setFlashdata('error', 'Member not found.');
        }
        return redirect()->to('/admin/members');
    }
}
