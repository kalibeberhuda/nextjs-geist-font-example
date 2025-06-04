<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Financial Summary - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h3 class="mb-4">Financial Summary</h3>
        <h5>Savings Summary</h5>
        <canvas id="savingsChart" width="400" height="200"></canvas>
        <h5 class="mt-4">Loan Portfolio</h5>
        <canvas id="loanChart" width="400" height="200"></canvas>
        <a href="/admin" class="btn btn-secondary mt-3">Back to Dashboard</a>
    </div>

    <script>
        const savingsCtx = document.getElementById('savingsChart').getContext('2d');
        const savingsData = {
            labels: <?= json_encode(array_column($savingsSummary, 'type')) ?>,
            datasets: [{
                label: 'Total Balance',
                data: <?= json_encode(array_map('floatval', array_column($savingsSummary, 'total_balance'))) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };
        const savingsChart = new Chart(savingsCtx, {
            type: 'bar',
            data: savingsData,
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        const loanCtx = document.getElementById('loanChart').getContext('2d');
        const loanData = {
            labels: <?= json_encode(array_column($loanPortfolio, 'status')) ?>,
            datasets: [{
                label: 'Total Amount',
                data: <?= json_encode(array_map('floatval', array_column($loanPortfolio, 'total_amount'))) ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        };
        const loanChart = new Chart(loanCtx, {
            type: 'pie',
            data: loanData,
            options: {
                responsive: true,
            }
        });
    </script>
</body>
</html>
