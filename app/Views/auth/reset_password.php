<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Reset Password - Cooperative System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h3 class="text-center mb-4">Reset Password</h3>
                <?php if(isset($success)): ?>
                    <div class="alert alert-success"><?= $success ?></div>
                <?php endif; ?>
                <?php if(isset($validation)): ?>
                    <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
                <?php endif; ?>
                <form action="/auth/resetPassword/<?= esc($token) ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="password" name="password" required autofocus />
                    </div>
                    <div class="mb-3">
                        <label for="password_confirm" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="password_confirm" name="password_confirm" required />
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Reset Password</button>
                </form>
                <div class="mt-3 text-center">
                    <a href="/auth/login">Back to Login</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
