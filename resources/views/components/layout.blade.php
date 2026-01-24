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


        <hr class="mx-3 opacity-25">
        <a href="#" class="nav-link"><i class="fas fa-home"></i> Home</a>
        <form method="POST" action="{{ route('user.logout') }}" style="display:inline;">
            @csrf
            <button type="submit" class="nav-link text-danger" style="background:none;border:none;cursor:pointer;"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </form>
    </div>
</nav>
<div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Welcome back, {{ Auth::user()->name }}</h2>
            <p class="text-muted">Role: <span class="badge bg-primary"> {{ Auth::user()->role }} </span></p>
        </div>

</div>
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