<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLoansTables extends Migration
{
    public function up()
    {
        // Create loans table
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
            'amount'      => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'interest_rate' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
            ],
            'term'        => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'status'      => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected', 'paid'],
                'default'    => 'pending',
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
        $this->forge->createTable('loans');

        // Create loan_repayments table
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'loan_id'     => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'amount'      => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'due_date'    => [
                'type'       => 'DATE',
            ],
            'paid_date'   => [
                'type'       => 'DATE',
                'null'       => true,
            ],
            'status'      => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'paid', 'late'],
                'default'    => 'pending',
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
        $this->forge->addForeignKey('loan_id', 'loans', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('loan_repayments');
    }

    public function down()
    {
        $this->forge->dropTable('loan_repayments');
        $this->forge->dropTable('loans');
    }
}
