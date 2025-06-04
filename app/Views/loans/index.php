<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Loans - Cooperative System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h3 class="mb-4">My Loans</h3>
        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if(isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <table id="loansTable" class="table table-striped">
            <thead>
                <tr>
                    <th>Amount</th>
                    <th>Interest Rate (%)</th>
                    <th>Term (months)</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($loans as $loan): ?>
                <tr>
                    <td><?= number_format($loan['amount'], 2) ?></td>
                    <td><?= esc($loan['interest_rate']) ?></td>
                    <td><?= esc($loan['term']) ?></td>
                    <td><?= esc($loan['status']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="mt-3">
            <a href="/loans/apply" class="btn btn-primary">Apply for Loan</a>
            <a href="/dashboard" class="btn btn-secondary ms-2">Back to Dashboard</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loansTable').DataTable();
        });
    </script>
</body>
</html>
