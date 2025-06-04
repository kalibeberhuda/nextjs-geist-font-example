<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use Config\Services;

class Auth extends Controller
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = Services::session();
    }

    public function login()
    {
        helper(['form']);
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email'    => 'required|valid_email',
                'password' => 'required|min_length[6]|max_length[255]',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');

                $user = $this->userModel->getUserByEmail($email);

                if ($user) {
                    if (password_verify($password, $user['password_hash'])) {
                        $this->setUserSession($user);
                        return redirect()->to('/dashboard');
                    } else {
                        $data['error'] = 'Incorrect password.';
                    }
                } else {
                    $data['error'] = 'Email not found.';
                }
            }
        }

        echo view('auth/login', $data);
    }

    private function setUserSession($user)
    {
        $data = [
            'id'       => $user['id'],
            'email'    => $user['email'],
            'role'     => $user['role'],
            'isLoggedIn' => true,
        ];

        $this->session->set($data);
        return true;
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/auth/login');
    }

    public function googleLogin()
    {
        $googleConfig = config('GoogleOAuth');
        $client = new \Google_Client();
        $client->setClientId($googleConfig->clientID);
        $client->setClientSecret($googleConfig->clientSecret);
        $client->setRedirectUri($googleConfig->redirectUri);
        $client->addScope($googleConfig->scopes);

        $authUrl = $client->createAuthUrl();
        return redirect()->to($authUrl);
    }

    public function googleCallback()
    {
        $googleConfig = config('GoogleOAuth');
        $client = new \Google_Client();
        $client->setClientId($googleConfig->clientID);
        $client->setClientSecret($googleConfig->clientSecret);
        $client->setRedirectUri($googleConfig->redirectUri);

        if (!$this->request->getGet('code')) {
            return redirect()->to('/auth/login');
        }

        $token = $client->fetchAccessTokenWithAuthCode($this->request->getGet('code'));

        if (isset($token['error'])) {
            return redirect()->to('/auth/login');
        }

        $client->setAccessToken($token['access_token']);
        $oauth = new \Google_Service_Oauth2($client);
        $googleUser = $oauth->userinfo->get();

        $userModel = new UserModel();
        $user = $userModel->getUserByGoogleId($googleUser->id);

        if (!$user) {
            // Register new user
            $newUserData = [
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'role' => 'member',
                'password_hash' => null,
            ];
            $userModel->insert($newUserData);
            $user = $userModel->getUserByGoogleId($googleUser->id);
        }

        $this->setUserSession($user);
        return redirect()->to('/dashboard');
    }

    public function forgotPassword()
    {
        helper(['form']);
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => 'required|valid_email',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $email = $this->request->getPost('email');
                $user = $this->userModel->getUserByEmail($email);

                if ($user) {
                    // Generate password reset token and send email (implementation placeholder)
                    $data['success'] = 'Password reset link has been sent to your email.';
                } else {
                    $data['error'] = 'Email not found.';
                }
            }
        }

        echo view('auth/forgot_password', $data);
    }

    public function resetPassword($token = null)
    {
        helper(['form']);
        $data = ['token' => $token];

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'password' => 'required|min_length[6]|max_length[255]',
                'password_confirm' => 'matches[password]',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                // Verify token and update password (implementation placeholder)
                $data['success'] = 'Password has been reset successfully.';
            }
        }

        echo view('auth/reset_password', $data);
    }
}
