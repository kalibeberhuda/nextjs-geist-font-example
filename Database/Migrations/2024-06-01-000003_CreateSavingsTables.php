<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSavingsTables extends Migration
{
    public function up()
    {
        // Create savings_accounts table
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'member_id'   => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'type'        => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'balance'     => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0.00,
            ],
            'interest_rate' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'default'    => 0.00,
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
        $this->forge->addForeignKey('member_id', 'members', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('savings_accounts');

        // Create savings_transactions table
        $this->forge->addField([
            'id'                 => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'savings_account_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'type'               => [
                'type'       => 'ENUM',
                'constraint' => ['deposit', 'withdrawal'],
            ],
            'amount'             => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'date'               => [
                'type'       => 'DATETIME',
            ],
            'created_at'         => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'updated_at'         => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('savings_account_id', 'savings_accounts', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('savings_transactions');
    }

    public function down()
    {
        $this->forge->dropTable('savings_transactions');
        $this->forge->dropTable('savings_accounts');
    }
}
