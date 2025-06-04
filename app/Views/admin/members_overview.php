<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Members Overview - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h3 class="mb-4">Members Overview</h3>
        <table id="membersTable" class="table table-striped">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Membership Tier</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($members as $member): ?>
                <tr>
                    <td><?= esc($member['full_name']) ?></td>
                    <td><?= esc($member['email']) ?></td>
                    <td><?= esc($member['phone']) ?></td>
                    <td><?= esc($member['membership_tier']) ?></td>
                    <td><?= esc($member['status']) ?></td>
                    <td>
                        <?php if($member['status'] === 'pending'): ?>
                        <a href="/members/approve/<?= $member['id'] ?>" class="btn btn-sm btn-success">Approve</a>
                        <?php endif; ?>
                    </td>
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
            $('#membersTable').DataTable();
        });
    </script>
</body>
</html>
