<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Apply for Loan - Cooperative System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h3 class="mb-4">Loan Application</h3>
        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if(isset($validation)): ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>
        <form action="/loans/apply" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="amount" class="form-label">Loan Amount</label>
                <input type="number" step="0.01" class="form-control" id="amount" name="amount" required autofocus />
            </div>
            <div class="mb-3">
                <label for="interest_rate" class="form-label">Interest Rate (%)</label>
                <input type="number" step="0.01" class="form-control" id="interest_rate" name="interest_rate" required />
            </div>
            <div class="mb-3">
                <label for="term" class="form-label">Term (months)</label>
                <input type="number" class="form-control" id="term" name="term" required />
            </div>
            <button type="submit" class="btn btn-primary">Submit Application</button>
            <a href="/loans" class="btn btn-secondary ms-2">Cancel</a>
        </form>
    </div>
</body>
</html>
