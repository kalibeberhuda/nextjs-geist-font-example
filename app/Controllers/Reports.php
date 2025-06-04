<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ReportModel;
use Config\Services;

class Reports extends Controller
{
    protected $reportModel;
    protected $session;

    public function __construct()
    {
        $this->reportModel = new ReportModel();
        $this->session = Services::session();
    }

    public function savingsSummary()
    {
        $data['summary'] = $this->reportModel->getSavingsSummary();
        echo view('reports/savings_summary', $data);
    }

    public function loanPortfolio()
    {
        $data['portfolio'] = $this->reportModel->getLoanPortfolio();
        echo view('reports/loan_portfolio', $data);
    }

    public function transactionHistory()
    {
        $data['transactions'] = $this->reportModel->getTransactionHistory();
        echo view('reports/transaction_history', $data);
    }

    public function exportExcel()
    {
        $spreadsheet = $this->reportModel->generateExcelReport();

        // Redirect output to client browser
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="savings_summary.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function exportPDF()
    {
        $pdf = $this->reportModel->generatePDFReport();

        // Output PDF to browser
        $pdf->Output('savings_summary.pdf', 'I');
        exit;
    }
}
