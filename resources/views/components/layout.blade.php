<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProAdmin | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 260px;
            --primary-color: #2563eb;
            --dark-navy: #0f172a;
            --light-bg: #f8fafc;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            overflow-x: hidden;
        }

        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: var(--dark-navy);
            color: white;
            transition: all 0.3s;
            z-index: 1000;
            padding-top: 20px;
        }

        #sidebar .nav-link {
            color: #94a3b8;
            padding: 12px 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: 0.2s;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
        }

        #sidebar .nav-link:hover, #sidebar .nav-link.active {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            border-left: 4px solid var(--primary-color);
        }

        #main-content {
            margin-left: var(--sidebar-width);
            padding: 30px;
            transition: all 0.3s;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            margin-bottom: 24px;
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 15px 20px;
            font-weight: 600;
        }

        .action-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            transition: transform 0.2s, box-shadow 0.2s;
            border: 1px solid #e2e8f0;
            height: 100%;
            cursor: pointer;
        }

        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border-color: var(--primary-color);
        }

        .action-icon {
            font-size: 2rem;
            color: var(--primary-color);
            background: #eff6ff;
            width: 60px;
            height: 60px;
            line-height: 60px;
            border-radius: 12px;
            margin: 0 auto 15px;
        }

        .action-card h3 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--dark-navy);
        }

        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .content-section { display: none; }
        .content-section.active { display: block; }

        @media (max-width: 768px) {
            #sidebar { margin-left: calc(-1 * var(--sidebar-width)); }
            #main-content { margin-left: 0; }
            #sidebar.active { margin-left: 0; }
        }
    </style>
</head>
<body>

<nav id="sidebar">
    <div class="px-4 mb-4">
        <h4 class="fw-bold text-white"><i class="fas fa-shield-alt me-2"></i>ProAdmin</h4>
    </div>
    <div class="nav flex-column">
        <a href="{{ route('admin.dash') }}" class="nav-link active" onclick="showSection('dashboard-overview')">
            <i class="fas fa-th-large"></i> Dashboard
</a>
        <button onclick="showSection('houseform')" class="nav-link"><i class="fas fa-home"></i> Add House</button>
        <button onclick="showSection('holderform')" class="nav-link"><i class="fas fa-user-plus"></i> Add Holder</button>
        <button onclick="showSection('staffform')" class="nav-link"><i class="fas fa-user-gear"></i> Add Staff</button>
        <button onclick="showSection('billform')" class="nav-link"><i class="fas fa-file-invoice-dollar"></i> Add Bill</button>

        <hr class="mx-3 opacity-25">
        <a href="#" class="nav-link"><i class="fas fa-home"></i> Home</a>
        <form method="POST" action="{{ route('user.logout') }}" style="display:inline;">
            @csrf
            <button type="submit" class="nav-link text-danger" style="background:none;border:none;cursor:pointer;"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </form>
    </div>
</nav>

<div id="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Welcome back, {{ Auth::user()->name }}</h2>
            <p class="text-muted">Role: <span class="badge bg-primary"> {{ Auth::user()->role }} </span></p>
        </div>
        <div class="d-flex gap-2">
            <button onclick="showSection('eventform')" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                <i class="fas fa-calendar-plus me-1"></i> New Event
            </button>
            <button onclick="showSection('adminform')" class="btn btn-outline-dark btn-sm rounded-pill px-3">
                <i class="fas fa-user-shield me-1"></i> Add Admin
            </button>
        </div>
    </div>

      
<!-- add holder -->
    <div id="holderform" class="content-section">
        <div class="card col-lg-5 mx-auto">
            <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
                <span>Register New Holder</span>
                <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="showSection('dashboard-overview')"></button>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted border-end-0"><i class="fas fa-user"></i></span>
                            <input type="text" name="name" class="form-control border-start-0" placeholder="John Doe" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted border-end-0"><i class="fas fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control border-start-0" placeholder="name@example.com" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">House Number</label>
                            <input type="text" name="house_no" class="form-control" placeholder="Unit 101" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">User Type</label>
                            <select name="member_type" class="form-select" required>
                                <option value="owner">Owner</option>
                                <option value="member">Member</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">System Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted border-end-0"><i class="fas fa-lock"></i></span>
                            <input type="password" name="password" class="form-control border-start-0" value="123" required>
                        </div>
                        <div class="form-text">Default password is set to 123</div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Complete Registration
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- add holder ends  -->
 <!-- add house -->
    <div id="houseform" class="content-section">
        <div class="card col-lg-5 mx-auto">
            <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
                <span>Register New House</span>
                <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="showSection('dashboard-overview')"></button>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-4">
                        <label for="houseNo" class="form-label">House Number / Unit ID</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted border-end-0"><i class="fas fa-door-open"></i></span>
                            <input type="text" class="form-control border-start-0" id="houseNo" name="houseNo" placeholder="e.g. 123-A" required>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle me-2"></i>Register Property</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- add house ends  -->
 <!-- add event -->
    <div id="eventform" class="content-section">
        <div class="card col-lg-5 mx-auto">
            <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
                <span>Host a New Event</span>
                <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="showSection('dashboard-overview')"></button>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Event Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Description</label>
                        <textarea class="form-control" name="description" rows="3" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3"><label class="form-label">Date</label><input type="date" class="form-control" name="date"></div>
                        <div class="col-md-6 mb-3"><label class="form-label">Time</label><input type="time" class="form-control" name="time"></div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2">Publish Event</button>
                </form>
            </div>
        </div>
    </div>
<!-- add event ends  -->
 <!-- add admin -->
    <div id="adminform" class="content-section">
        <div class="card col-lg-5 mx-auto">
            <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
                <span>Register New Admin</span>
                <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="showSection('dashboard-overview')"></button>
            </div>
            <div class="card-body">
                <form action="{{ route('save.user') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Full Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Jane Doe" required>
                    </div>  
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="admin@example.com" required>
                    </div>  
                    <input type="hidden" name="user_type" value="committee">
                    <input type="hidden" name="committee" value=1>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Role</label>
                        <select name="role" class="form-select" required>
                            <option value="admin">Admin</option>
                            <option value="President">President</option>
                            <option value="secretary">Secretary</option>
                            <option value="Member">Committee Member</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">System Password</label>
                        <input type="password" name="password" class="form-control" value="123" required>
                    </div>
                    <div class="d-grid"><button type="submit" class="btn btn-dark py-2">Register Admin</button></div>
                </form>
            </div>
        </div>
    </div>
<!-- add admin ends  -->
<!-- add bill -->
<div id="billform" class="content-section">
        <div class="card col-lg-5 mx-auto">
            <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
                <span>Generate Bill</span>
                <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="showSection('dashboard-overview')"></button>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label for="house_no" class="form-label">House Number</label>
                        <select class="form-select" id="house_no" name="house_no" required>
                            <option value="" selected disabled>Choose house number...</option>
                            <option value="101">101</option>
                            <option value="102">102</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="bill" class="form-label">Bill Description</label>
                        <select class="form-select" id="bill" name="bill" required>
                            <option value="Electricity Bill">Electricity Bill</option>
                            <option value="Water Bill">Water Bill</option>
                            <option value="Maintenance Fee">Maintenance Fee</option>
                        </select>
                    </div>
                    <div class="mb-3"><label class="form-label">Amount ($)</label><input type="number" class="form-control" name="amount" placeholder="0.00" required></div>
                    <div class="mb-3">
                        <label class="form-label">Billing Month</label>
                        <select class="form-select" name="bill_month" required>
                            <option value="January">January</option>
                            <option value="February">February</option>
                        </select>
                    </div>
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">Generate Bill</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- add bill ends  -->
 <!-- add staff  -->
    <div id="staffform" class="content-section">
        <div class="card col-lg-5 mx-auto">
            <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
                <span>Add Staff</span>
                <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="showSection('dashboard-overview')"></button>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="mb-3"><label class="form-label">Full Name</label><input type="text" name="sname" class="form-control" placeholder="Enter full name" required></div>
                    <div class="mb-3">
                        <label class="form-label">Staff role</label>
                        <select name="srole" class="form-select" required>
                            <option value="Electrician">Electrician</option>
                            <option value="Plumber">Plumber</option>
                            <option value="Security">Security</option>
                        </select>
                    </div>
                    <div class="mb-3"><label class="form-label">Email Address</label><input type="email" name="semail" class="form-control" placeholder="Enter email" required></div>
                    <div class="mb-3"><label class="form-label">Password</label><input type="password" name="spassword" class="form-control" required></div>
                    <div class="d-grid"><button type="submit" class="btn btn-primary">Register</button></div>
                </form>
            </div>
        </div>
    </div>
<!-- add staff ends  -->

{{ $slot }}

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function showSection(sectionId) {
        const sections = document.querySelectorAll('.content-section');
        sections.forEach(section => section.classList.remove('active'));
        
        const target = document.getElementById(sectionId);
        if(target) { target.classList.add('active'); }

        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => link.classList.remove('active'));
    }

    window.onload = () => showSection('dashboard-overview');

    $(document).ready(function(){
        $('#ownerSearch').on('input', function(){
            var q = $(this).val().toLowerCase().trim();
            $('#holders table tbody tr').each(function(){
                var name = $(this).find('td:nth-child(2)').text().toLowerCase();
                var email = $(this).find('td:nth-child(3)').text().toLowerCase();
                var house = $(this).find('td:nth-child(4)').text().toLowerCase();
                if (q === '' || name.indexOf(q) !== -1 || email.indexOf(q) !== -1 || house.indexOf(q) !== -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        $('#fetchval').on('change', function(){
            alert("Filtering for: " + $(this).val());
        });
    });
</script>
</body>
</html>