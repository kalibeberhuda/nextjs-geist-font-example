<?php

namespace Tests\Unit;

use CodeIgniter\Test\CIUnitTestCase;
use App\Models\UserModel;

class AuthTest extends CIUnitTestCase
{
    protected $userModel;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userModel = new UserModel();
    }

    public function testUserCanBeFoundByEmail()
    {
        $email = 'test@example.com';
        $user = $this->userModel->getUserByEmail($email);
        $this->assertIsArray($user);
        $this->assertArrayHasKey('email', $user);
        $this->assertEquals($email, $user['email']);
    }

    public function testPasswordVerification()
    {
        $email = 'test@example.com';
        $user = $this->userModel->getUserByEmail($email);
        $password = 'password123';
        $this->assertTrue(password_verify($password, $user['password_hash']));
    }
}
