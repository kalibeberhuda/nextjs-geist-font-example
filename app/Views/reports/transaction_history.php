<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Transaction History - Cooperative System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h3 class="mb-4">Transaction History</h3>
        <h5>Savings Transactions</h5>
        <table id="savingsTransactions" class="table table-striped">
            <thead>
                <tr>
                    <th>Account ID</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($transactions['savings'] as $tx): ?>
                <tr>
                    <td><?= esc($tx['savings_account_id']) ?></td>
                    <td><?= esc($tx['type']) ?></td>
                    <td><?= number_format($tx['amount'], 2) ?></td>
                    <td><?= esc($tx['date']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h5 class="mt-5">Loan Repayments</h5>
        <table id="loanRepayments" class="table table-striped">
            <thead>
                <tr>
                    <th>Loan ID</th>
                    <th>Amount</th>
                    <th>Due Date</th>
                    <th>Paid Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($transactions['loans'] as $repayment): ?>
                <tr>
                    <td><?= esc($repayment['loan_id']) ?></td>
                    <td><?= number_format($repayment['amount'], 2) ?></td>
                    <td><?= esc($repayment['due_date']) ?></td>
                    <td><?= esc($repayment['paid_date']) ?></td>
                    <td><?= esc($repayment['status']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="/reports" class="btn btn-secondary mt-3">Back to Reports</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#savingsTransactions').DataTable();
            $('#loanRepayments').DataTable();
        });
    </script>
</body>
</html>
