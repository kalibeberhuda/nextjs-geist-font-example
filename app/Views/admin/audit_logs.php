<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Audit Logs - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h3 class="mb-4">Audit Logs</h3>
        <table id="auditLogsTable" class="table table-striped">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Action</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($logs as $log): ?>
                <tr>
                    <td><?= esc($log['user_id']) ?></td>
                    <td><?= esc($log['action']) ?></td>
                    <td><?= esc($log['timestamp']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="/admin" class="btn btn-secondary mt-3">Back to Dashboard</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#auditLogsTable').DataTable();
        });
    </script>
</body>
</html>
