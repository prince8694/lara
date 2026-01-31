@if(!Auth::check())
    return redirect()->route('user.logout');
@endif
@if(Auth::user()->committee != 1)
    return redirect()->route('home');
    @endif
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
        <button class="nav-link active" onclick="showSection('dashboard-overview')">
            <i class="fas fa-th-large"></i> Dashboard
        </button>
        <button onclick="showSection('houseform')" class="nav-link"><i class="fas fa-home"></i> Add House</button>
        <button onclick="showSection('holderform')" class="nav-link"><i class="fas fa-user-plus"></i> Add Holder</button>
        <button onclick="showSection('staffform')" class="nav-link"><i class="fas fa-user-gear"></i> Add Staff</button>
        <button onclick="showSection('billform')" class="nav-link"><i class="fas fa-file-invoice-dollar"></i> Add Bill</button>

        <hr class="mx-3 opacity-25">
        <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-home"></i> Home</a>
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

    <div id="dashboard-overview" class="content-section active">
        <div class="row g-4 mb-5">
            <div class="col-md-4 col-lg-2">
                <div class="action-card" onclick="showSection('adminslist')">
                    <div class="action-icon"><i class="fas fa-users-cog"></i></div>
                    <h3>Committee</h3>
                    <p class="small text-muted">Manage Admins</p>
                </div>
            </div>
            <div class="col-md-4 col-lg-2">
                <div class="action-card" onclick="showSection('houses')">
                    <div class="action-icon"><i class="fas fa-home"></i></div>
                    <h3>Houses</h3>
                    <p class="small text-muted">View Property</p>
                </div>
            </div>
            <div class="col-md-4 col-lg-2">
                <div class="action-card" onclick="showSection('holders')">
                    <div class="action-icon"><i class="fas fa-id-card"></i></div>
                    <h3>Holders</h3>
                    <p class="small text-muted">Owner Directory</p>
                </div>
            </div>
            <div class="col-md-4 col-lg-2">
                <div class="action-card" onclick="showSection('complaintslist')">
                    <div class="action-icon"><i class="fas fa-exclamation-circle"></i></div>
                    <h3>Complaints</h3>
                    <p class="small text-muted">Support Tickets</p>
                </div>
            </div>
            <div class="col-md-4 col-lg-2">
                <div class="action-card" onclick="showSection('stafflist')">
                    <div class="action-icon"><i class="fas fa-tools"></i></div>
                    <h3>Staff</h3>
                    <p class="small text-muted">Maintenance</p>
                </div>
            </div>
            <div class="col-md-4 col-lg-2">
                <div class="action-card" onclick="showSection('billslist')">
                    <div class="action-icon"><i class="fas fa-file-invoice"></i></div>
                    <h3>Bills</h3>
                    <p class="small text-muted">Payments</p>
                </div>
            </div>
        </div>
        
    </div>
@if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif

@if(session('error'))
    <script>
        alert("{{ session('error') }}");
    </script>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- add holder -->
    <div id="holderform" class="content-section">
        <div class="card col-lg-5 mx-auto">
            <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
                <span>Register New Holder</span>
                <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="showSection('dashboard-overview')"></button>
            </div>
            <div class="card-body">
                <form action="{{ route('save.user') }}" method="post">
                    @csrf
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
                            <select name="house_no" class="form-select" required>
                                <option selected disabled>--House Number--</option>
                                @foreach($homes as $vhome)
                                <option value="{{ $vhome->house_no }}">{{ $vhome->house_no }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Holder Type</label>
                            <select name="user_type" class="form-select" required>
                                <option selected disabled>--Owner or Member--</option>
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
                <form action="{{ route('add.home') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="houseNo" class="form-label">House Number / Unit ID</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted border-end-0"><i class="fas fa-door-open"></i></span>
                            <input type="hidden" name="status" value= 0>
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
                <form action="{{ route('add.bill') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="house_no" class="form-label">House Number</label>
                        <select class="form-select" id="house_no" name="house_no" required>
                            <option value="" selected disabled>Choose house number...</option>
                            @foreach($occupiedHomes as $home)
                            <option value="{{ $home->id}}">{{ $home->house_no }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <div class="mb-3">
                        <label for="bill" class="form-label">Bill Description</label>
                        <select class="form-select" id="bill" name="bill" required>
                            <option value="Electricity Bill">Electricity Bill</option>
                            <option value="Water Bill">Water Bill</option>
                            <option value="internet Fee">Internet Fee</option>
                            <option value="cleaning Bill">Cleaning Bill</option>
                            <option value="Maintenance Fee">Maintenance Fee</option>
                        </select>
                    </div>
                    <div class="mb-3"><label class="form-label">Amount ($)</label>
                        <input type="number" class="form-control" name="amount" placeholder="0.00" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Billing Month</label>
                        <select class="form-select" name="bill_month" required>
                            @php
                            $months=array("January","February","March","April","May","June","July","August","September","October","November","December");
                            @endphp
                            <option value="" selected disabled>Select month</option>
                            @foreach($months as $month)
                                <option value="{{ $month }}">{{ $month }}</option>
                            @endforeach
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
                <form action="{{ route('save.user') }}" method="post">
                    @csrf
                    <div class="mb-3"><label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter full name" required>
                </div>
                <input type="hidden" name="user_type" value="Staff">
                    <div class="mb-3">
                        <label class="form-label">Staff role</label>
                        <select name="role" class="form-select" required>
                            <option value="Electrician">Electrician</option>
                            <option value="Plumber">Plumber</option>
                            <option value="Cleaner">Cleaner</option> 
                            <option value="Security">Security</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="d-grid"><button type="submit" class="btn btn-primary">Add Staff</button></div>
                </form>
            </div>
        </div>
    </div>
<!-- add staff ends  -->
 <!-- admin list  -->
    <div id="adminslist" class="content-section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-users-cog me-2"></i>Committee & Admin List</span>
                <button class="btn btn-sm btn-light" onclick="showSection('dashboard-overview')">Back</button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light"><tr><th>#</th><th>Full Name</th><th>Email Address</th><th>Role</th></tr></thead>
                    <tbody>
                        @if(isset($committee))
                            @foreach($committee as $member)
                            <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-bold">{{ $member->name }}</td>
                            <td>{{ $member->email }}</td>
                            <td><span class="badge bg-soft-primary text-primary border">{{ $member->role }}</span></td>
                            </tr>
                            @endforeach
                        @else
            <tr>
                <td colspan="4" class="text-center">No committee members found.</td>
            </tr>
        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!-- house list  -->
    <div id="houses" class="content-section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-home me-2"></i>Houses Directory</span>
                <button class="btn btn-sm btn-light" onclick="showSection('dashboard-overview')">Back</button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>House No</th>
                            <th>Owner Name</th>
                            <th>Owner Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($homes))
                            @foreach($homes as $home)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-bold">{{ $home->house_no }}</td>
                            @if($home->owner)
                            <td>{{ $home->owner->name }}</td>
                            <td>{{ $home->owner->email }}</td>
                            @else
                            <td></td>
                            <td></td>
                            @endif
                            <td>
                                <span class="status-badge text-dark {{ $home->house_status == 0 ? 'bg-success' : 'bg-warning' }}">
                                    {{ $home->house_status == 0 ? 'Vacant' : 'Occupied' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                @if($home->owner_id)
                                <a href="{{ route('change.owner', $home->id) }}" class="btn btn-outline-primary btn-sm" title="Change Owner" onclick="return confirm('Demote this owner to a member?')">
                                    <i class="fas fa-exchange-alt"></i>
                                </a>

                                <form action="" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" title="Remove Owner" class="btn btn-outline-warning btn-sm" onclick="return confirm('Demote this owner to a member?')">
                                        <i class="fas fa-user-minus"></i>
                                    </button>
                                </form>
                                @else
                                    <button type="submit" title="Add owner" class="btn btn-outline-success btn-sm" onclick="showSection('holderform')">
                                        <i class="fas fa-user-plus"></i>
                                    </button>

                                @endif
                                <a href="{{ route('delete.home', $home->id) }}" title="Delete house" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure? This deletes the entire house record!')">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                            </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">No homes found.</td>
                            </tr>
                        @endisset
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!-- holders list  -->
    <div id="holders" class="content-section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-id-card me-2"></i>Owners Directory</span>
                <div class="d-flex gap-2 align-items-center">
                    <input type="search" id="ownerSearch" class="form-control form-control-sm" placeholder="Search owners...">
                    <button class="btn btn-sm btn-light" onclick="showSection('dashboard-overview')">Back</button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Email Address</th>
                            <th>House No</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($holders as $holder)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-bold">{{ $holder->name }}</td>
                            <td>{{ $holder->email }}</td>
                            <td>{{ $holder->house_no }}</td>
                            <td><span class="status-badge bg-success text-white">{{ $holder->user_type }}</span></td>
                            <td class="text-left">
                                <a href="{{ route('edit.holder', $holder->id)}}" class="text-primary me-3" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('dlt.holder', $holder->id)}}" class="text-danger" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!-- complaint list  -->
    <div id="complaintslist" class="content-section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-exclamation-circle me-2"></i>Complaints List</span>
                <button class="btn btn-sm btn-light" onclick="showSection('dashboard-overview')">Back</button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Owner Name</th>
                            <th>House No</th>
                            <th>Complaint</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>1</td><td class="fw-bold">Charlie Brown</td><td>101-A</td><td>Leaking pipe in kitchen</td><td><span class="status-badge bg-danger text-white">open</span></td></tr>
                        <tr><td>2</td><td class="fw-bold">David Wilson</td><td>102-B</td><td>Security light broken</td><td><span class="status-badge bg-success text-white">closed</span></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!-- staff list  -->
    <div id="stafflist" class="content-section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-tools me-2"></i>Staff Directory</span>
                <button class="btn btn-sm btn-light" onclick="showSection('dashboard-overview')">Back</button>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Email Address</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
            @foreach($staffs as $staff)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-bold">{{ $staff->name }}</td>
                            <td>{{ $staff->email }}</td>
                            <td><span class="badge bg-soft-primary text-primary border">{{ $staff->role }}</span></td>
                            <td class="text-left">
                                <a href="{{ route('edit.holder', $staff->id)}}" class="text-primary me-3" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('dlt.holder', $staff->id)}}" class="text-danger" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                         @endforeach
                    </tbody>
                </table>
            </div>
           
        </div>
    </div>
<!-- bill list  -->
    <div id="billslist" class="content-section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Financial Overview</span>
                <select class="form-select form-select-sm" id="fetchval" style="width: auto;">
                    <option value="All">All Bills</option>
                    <option value="pending">Pending</option>
                    <option value="paid">Paid</option>
                </select>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Unit</th>
                            <th>Bill Type</th>
                            <th>Amount</th>
                            <th>Month</th>
                            <th>Generated By</th>
                            <th>Status</th>
                            @if(auth()->user()->role=='admin')
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody id="billdata">
                        @foreach($bills as $bill)
                        <tr>
                            <td>{{ $bill->home->house_no }}</td>
                            <td>{{ $bill->bill_type }}</td>
                            <td class="fw-bold text-dark">{{ $bill->amount}}</td>
                            <td>{{ $bill->month }}</td>
                            <td>{{ $bill->generator->name }} ({{ $bill->generator->role }})</td>
                            <td><span class="status-badge bg-success text-white">{{ $bill->status }}</span></td>
                            @if(auth()->user()->role=='admin')
                            <td><a href="{{ route('revoke.bill', $bill->id)}}" class="btn btn-danger" title="Revoke Bill">
                                    <i class="fas fa-trash-alt"></i> Revoke
                                </a>
                            </td> 
                            @endif   
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

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