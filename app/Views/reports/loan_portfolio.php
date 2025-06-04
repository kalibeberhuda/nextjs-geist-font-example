<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Loan Portfolio - Cooperative System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h3 class="mb-4">Loan Portfolio</h3>
        <canvas id="loanChart" width="400" height="200"></canvas>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Number of Loans</th>
                    <th>Total Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($portfolio as $row): ?>
                <tr>
                    <td><?= esc($row['status']) ?></td>
                    <td><?= esc($row['loan_count']) ?></td>
                    <td><?= number_format($row['total_amount'], 2) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="/reports" class="btn btn-secondary mt-3">Back to Reports</a>
    </div>

    <script>
        const ctx = document.getElementById('loanChart').getContext('2d');
        const data = {
            labels: <?= json_encode(array_column($portfolio, 'status')) ?>,
            datasets: [{
                label: 'Total Amount',
                data: <?= json_encode(array_map('floatval', array_column($portfolio, 'total_amount'))) ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        };
        const loanChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: {
                responsive: true,
            }
        });
    </script>
</body>
</html>
