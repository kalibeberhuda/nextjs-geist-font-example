<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Savings Accounts - Cooperative System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h3 class="mb-4">My Savings Accounts</h3>
        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if(isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <table id="savingsTable" class="table table-striped">
            <thead>
                <tr>
                    <th>Account Type</th>
                    <th>Balance</th>
                    <th>Interest Rate (%)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($accounts as $account): ?>
                <tr>
                    <td><?= esc($account['type']) ?></td>
                    <td><?= number_format($account['balance'], 2) ?></td>
                    <td><?= esc($account['interest_rate']) ?></td>
                    <td>
                        <a href="/savings/deposit/<?= $account['id'] ?>" class="btn btn-sm btn-success">Deposit</a>
                        <a href="/savings/withdraw/<?= $account['id'] ?>" class="btn btn-sm btn-danger">Withdraw</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="mt-3">
            <a href="/dashboard" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#savingsTable').DataTable();
        });
    </script>
</body>
</html>
