<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Savings Summary - Cooperative System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h3 class="mb-4">Savings Summary</h3>
        <canvas id="savingsChart" width="400" height="200"></canvas>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Account Type</th>
                    <th>Number of Accounts</th>
                    <th>Total Balance</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($summary as $row): ?>
                <tr>
                    <td><?= esc($row['type']) ?></td>
                    <td><?= esc($row['account_count']) ?></td>
                    <td><?= number_format($row['total_balance'], 2) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="/reports" class="btn btn-secondary mt-3">Back to Reports</a>
    </div>

    <script>
        const ctx = document.getElementById('savingsChart').getContext('2d');
        const data = {
            labels: <?= json_encode(array_column($summary, 'type')) ?>,
            datasets: [{
                label: 'Total Balance',
                data: <?= json_encode(array_map('floatval', array_column($summary, 'total_balance'))) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };
        const savingsChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
</body>
</html>
