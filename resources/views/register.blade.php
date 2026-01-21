<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Register</title>
        <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- admin form section -->
    <div id="adminform" class="content-section">
        <div class="card col-lg-5 mx-auto">
            <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
                <span>Register New admin</span>
                <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="showSection('dashboard-overview')"></button>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Full Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Jane Doe" required>
                    </div>  
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="admin @example.com" required>
                    </div>  
                    <div class="mb-3">
                        <label class="form-label fw-bold">Role</label>
                        <select name="role" class="form-select" required>
                            <option value="admin">Admin</option>
                            <option value="President">President</option>
                            <option value="secretary">Secretary</option>
                            <option value="treasurer">Treasurer</option>
                            <option value="Member">Committee Member</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">System Password</label>
                        <input type="password" name="password" class="form-control" value="123" required>
                        <div class="form-text">Default password is set to 123</div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark py-2">Register Admin</button>
                    </div>

                    <div class="card-footer text-center">
                    <small>Already a user? <a href="{{ route('login') }}">Login here</a></small>
                </div>
                </form>
            </div>
        </div>
    </div>
<!-- admin form section end -->
</body>
</html>