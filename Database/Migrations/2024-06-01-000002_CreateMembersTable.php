<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMembersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'full_name'   => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'unique'     => true,
            ],
            'phone'       => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
            ],
            'password_hash' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'membership_tier' => [
                'type'       => 'ENUM',
                'constraint' => ['basic', 'silver', 'gold', 'platinum'],
                'default'    => 'basic',
            ],
            'status'      => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected'],
                'default'    => 'pending',
            ],
            'kyc_documents' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'created_at'  => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'updated_at'  => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('members');
    }

    public function down()
    {
        $this->forge->dropTable('members');
    }
}
