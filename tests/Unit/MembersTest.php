<?php

namespace Tests\Unit;

use CodeIgniter\Test\CIUnitTestCase;
use App\Models\MemberModel;

class MembersTest extends CIUnitTestCase
{
    protected $memberModel;

    protected function setUp(): void
    {
        parent::setUp();
        $this->memberModel = new MemberModel();
    }

    public function testMemberRegistration()
    {
        $data = [
            'full_name' => 'Test User',
            'email' => 'testuser@example.com',
            'phone' => '1234567890',
            'password_hash' => password_hash('password123', PASSWORD_DEFAULT),
            'membership_tier' => 'basic',
            'status' => 'pending',
            'kyc_documents' => null,
        ];

        $this->memberModel->save($data);
        $member = $this->memberModel->where('email', 'testuser@example.com')->first();

        $this->assertNotNull($member);
        $this->assertEquals('Test User', $member['full_name']);
        $this->assertEquals('pending', $member['status']);
    }
}
