<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MemberModel;
use App\Models\ReportModel;
use App\Models\AuditLogModel;
use Config\Services;

class Admin extends Controller
{
    protected $memberModel;
    protected $reportModel;
    protected $auditLogModel;
    protected $session;

    public function __construct()
    {
        $this->memberModel = new MemberModel();
        $this->reportModel = new ReportModel();
        $this->auditLogModel = new AuditLogModel();
        $this->session = Services::session();
    }

    public function membersOverview()
    {
        $data['members'] = $this->memberModel->findAll();
        echo view('admin/members_overview', $data);
    }

    public function financialSummary()
    {
        $data['savingsSummary'] = $this->reportModel->getSavingsSummary();
        $data['loanPortfolio'] = $this->reportModel->getLoanPortfolio();
        echo view('admin/financial_summary', $data);
    }

    public function systemConfig()
    {
        // Placeholder for system configuration management
        echo view('admin/system_config');
    }

    public function auditLogs()
    {
        $data['logs'] = $this->auditLogModel->findAll();
        echo view('admin/audit_logs', $data);
    }
}
