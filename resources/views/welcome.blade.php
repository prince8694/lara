@if(Auth::check())
    {{ redirect()->route('admin.dash') }}
@endif
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABC Residence Association | Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .hero-section { background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center; color: white; padding: 100px 0; }
        .feature-icon { font-size: 2rem; color: #0d6efd; }
        .card { border: none; transition: transform 0.3s; }
        .card:hover { transform: translateY(-5px); }
        footer { background-color: #212529; color: white; padding: 40px 0; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#" style="letter-spacing: 1px;">
                <span class='fs-4' style="color: #FF5733;">A</span><span class='fs-2' style="color: #33FF57;">B</span><span class='fs-1' style="color: #3357FF;">C</span> 
                <span class="text-white">RESIDENCE</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="btn btn-primary ms-lg-3" href="{{ route('loginform') }}">Login</a></li>
                    <li class="nav-item"><a class="btn btn-primary ms-lg-3" href="{{ route('register') }}">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section text-center">
        <div class="container">
            <h1 class="display-3 fw-bold">Welcome to ABC Residence</h1>
            <p class="lead">Building a Stronger, Safer, and Friendlier Neighborhood Together.</p>

        </div>
    </header>

    <section id="announcements" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">📢 Latest Announcements</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="alert alert-info border-0 shadow-sm">
                        <h5 class="fw-bold">Annual General Meeting</h5>
                        <p>Jan 15th at the Community Hall. Attendance is highly encouraged.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="alert alert-success border-0 shadow-sm">
                        <h5 class="fw-bold">Weekend Cleanup</h5>
                        <p>Join us this Saturday at 9:00 AM to beautify our local park.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="alert alert-warning border-0 shadow-sm">
                        <h5 class="fw-bold">Security Update</h5>
                        <p>New visitor entry guidelines are now in effect for all gates.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- <section id="services" class="py-5 bg-white">
        <div class="container">
            <h2 class="text-center mb-5">🛠 Resident Services</h2>
            <div class="row g-4 text-center">
                <div class="col-md-6">
                    <div class="card h-100 p-4 shadow-sm">
                        <div class="mb-3">📅</div>
                        <h5>Book Facilities</h5>
                        <p class="small text-muted">Reserve the clubhouse or BBQ pit.</p>
                        <a href="#" class="btn btn-sm btn-outline-primary mt-auto">Book Now</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 p-4 shadow-sm">
                        <div class="mb-3">📄</div>
                        <h5>Documents</h5>
                        <p class="small text-muted">Download bylaws and meeting minutes.</p>
                        <a href="#" class="btn btn-sm btn-outline-primary mt-auto">View Vault</a>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <section id="events" class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="mb-4">Upcoming Events</h2>
                    <ul class="list-group list-group-flush shadow-sm">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            New Year Eve
                            
                            <div>
                                
                                <div class="collapse" id="eventDesc">
                                    <div class="card card-body mt-2">
                                        
                                    </div>
                                </div>
                            </div>
                            <span class="badge bg-primary rounded-pill">Hosted by</span>
                            <span class="badge bg-primary rounded-pill">
                                Dec-31,2025
                            </span>
                        </li>
                       
                    </ul>

                </div>
                <div class="col-lg-5 offset-lg-1 mt-4 mt-lg-0">
                    <blockquote class="blockquote border-start ps-4 border-4 border-primary">
                        <p class="fst-italic">"Community is not just where you live, but how you live together."</p>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    <footer id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <h5>ABC Residence Association</h5>
                    <p class="small">Dedicated to enhancing quality of life for all residents through transparency and community engagement.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h5>Contact Us</h5>
                    <p class="small mb-0">Email: admin@abcresidence.com</p>
                    <p class="small mb-0">Emergency: (555) 123-4567</p>
                    <p class="small">123 Community Drive, Block A Office</p>
                </div>
            </div>
            <hr class="mt-4">
            <div class="text-center small opacity-75">
                © 2025 ABC Residence Association. All Rights Reserved.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
