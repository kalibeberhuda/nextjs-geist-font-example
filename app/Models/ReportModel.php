<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportModel extends Model
{
    public function getSavingsSummary()
    {
        // Aggregate savings data for summary
        $builder = $this->db->table('savings_accounts');
        $builder->select('type, COUNT(*) as account_count, SUM(balance) as total_balance');
        $builder->groupBy('type');
        return $builder->get()->getResultArray();
    }

    public function getLoanPortfolio()
    {
        // Aggregate loan data for portfolio
        $builder = $this->db->table('loans');
        $builder->select('status, COUNT(*) as loan_count, SUM(amount) as total_amount');
        $builder->groupBy('status');
        return $builder->get()->getResultArray();
    }

    public function getTransactionHistory()
    {
        // Get all savings and loan transactions (simplified)
        $builder = $this->db->table('savings_transactions');
        $builder->select('*');
        $savingsTransactions = $builder->get()->getResultArray();

        $builder = $this->db->table('loan_repayments');
        $builder->select('*');
        $loanRepayments = $builder->get()->getResultArray();

        return [
            'savings' => $savingsTransactions,
            'loans' => $loanRepayments,
        ];
    }

    public function generateExcelReport()
    {
        // Use PHPSpreadsheet to generate Excel report
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Example: Write savings summary to sheet
        $summary = $this->getSavingsSummary();
        $sheet->setCellValue('A1', 'Account Type');
        $sheet->setCellValue('B1', 'Number of Accounts');
        $sheet->setCellValue('C1', 'Total Balance');

        $row = 2;
        foreach ($summary as $data) {
            $sheet->setCellValue('A' . $row, $data['type']);
            $sheet->setCellValue('B' . $row, $data['account_count']);
            $sheet->setCellValue('C' . $row, $data['total_balance']);
            $row++;
        }

        // Return spreadsheet object for controller to output
        return $spreadsheet;
    }

    public function generatePDFReport()
    {
        // Use TCPDF or similar library to generate PDF report
        $pdf = new \TCPDF();
        $pdf->AddPage();

        $summary = $this->getSavingsSummary();
        $html = '<h1>Savings Summary</h1><table border="1" cellpadding="4"><tr><th>Account Type</th><th>Number of Accounts</th><th>Total Balance</th></tr>';

        foreach ($summary as $data) {
            $html .= '<tr><td>' . $data['type'] . '</td><td>' . $data['account_count'] . '</td><td>' . $data['total_balance'] . '</td></tr>';
        }
        $html .= '</table>';

        $pdf->writeHTML($html, true, false, true, false, '');
        return $pdf;
    }
}
