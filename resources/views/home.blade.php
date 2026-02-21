
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABCRA | Home</title>
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
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#announcements">Announcements</a></li>
                    <li class="nav-item"><a class="nav-link" href="complaint-log.php">complaint logs</a></li>
                    <li class="nav-item"><a class="nav-link" href="#events">Events</a></li>
                    
<!-- -- visitors -- -->

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Visitors
                            
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    visitorCount
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                        </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navDropdown">
                                    <li class="dropdown-header d-flex px-3 justify-content-between align-items-center">
                                        vname
                                        phone
                                <a class=" dropdown-item text-success" href="profile.php"> &#x2714;</a>
                                <a class="dropdown-item" href="settings.php">&#10060;</a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li class="px-3"><a class="btn btn-sm btn-primary w-100 text-center text-white" href="">Visitor Log</a></li>
                        </ul>
                    </li>
<!-- -- visitor ends -- -->
<!-- admin provision -->
                    @if(auth()->user()['committee'] == '1')
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.dash') }}">Admin Dashboard</a></li>
                    @endif
<!-- admin provision ends -->

 <!-- add member -->
  @if(auth()->user()['house_no'] != null)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Members
                            
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ count($members)}}
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            
                        </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navDropdown">
                                    @foreach($members as $member)
                                    <div>
                                    <li class="dropdown-header d-flex px-3 justify-content-between">
                                       
                                        <p class="text-black fw-bold">{{ $member->name }}
                                            @if($member->user_type == 'owner')
                                            -{{ $member->user_type }} 
                                            @endif</p>
                                
                            @if(auth()->user()['user_type'] == 'owner') 
                                @if($member->user_type != 'owner')       
                                <!-- <a class=" dropdown-item text-success" href="profile.php"> &#x2714;</a> -->
                                 <form action="" method="post" class= "d-inline" onsubmit = "return confirm('are you sure to delete??');">
                                    @csrf
                                    <input type="hidden" value="delete" name="action">
                                    <input type="hidden" value="{{ $member->id }}" name="memId">
                                <a href="{{ route('dlt.holder',$member->id )  }}" class="dropdown-item ms-4" type="submit">&#10060;</a>
                            </form>
                                @endif
                                @endif
                            </li>
                            </div>
                           @endforeach
                            <li><hr class="dropdown-divider"></li>
                            <li class="px-3">
                                <a class="btn btn-sm btn-primary w-100 text-center text-white" href="{{ route('add.member') }}">Add Member</a>
                            </li>
                        </ul>
                    </li>
@endif

 <!-- add member ends -->
                    <form method="POST" action="{{ route('user.logout') }}" style="display:inline;">
                        @csrf
                    <li class="nav-item"><button class="btn btn-primary ms-lg-3">Logout</button></li>
                        </form>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section text-center">
        <div class="container">
            <h1 class="display-5 fw-bold">Hello {{auth()->user()->name}} ,</h1>
            <h1 class="display-3 fw-bold">Welcome to ABC Residence Association</h1>
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

    <section id="services" class="py-5 bg-white">
        <div class="container">
            <h2 class="text-center mb-5">🛠 Resident Services</h2>
            <div class="row g-4 text-center">
                <div class="col-md-6">
                    <div class="card h-100 p-4 shadow-sm">
                        <div class="mb-3">💳</div>
                        <h5>Bills</h5>
                        <p class="small text-muted">Secure online portal for monthly fees.</p>
                        <a href="{{ route('show.my.bill', auth()->user()->home()->first()->id) }}" class="btn btn-sm btn-outline-primary mt-auto">Show bills</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 p-4 shadow-sm">
                        <div class="mb-3">🔧</div>
                        <h5>Maintenance</h5>
                        <p class="small text-muted">Report issues or request repairs.</p>
                        <a href="{{ route('complaint.form') }}" class="btn btn-sm btn-outline-primary mt-auto">Raise Ticket</a>


</div> 


                    </div>
                
                
            </div>
        </div>
    </section>

    <section id="events" class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="mb-4">Upcoming Events</h2>
                    <ul class="list-group list-group-flush shadow-sm"> 
                        @foreach($events as $event)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            
                            <div>
                                <button class="btn btn-link bg-white rounded-pill link-success link-underline-opacity-0 link-underline-opacity-100-hover" type="button" data-bs-toggle="collapse" data-bs-target="#eventDesc{{ $event->id }}" aria-expanded="false" aria-controls="eventDesc{{ $event->id }}">
                                    View Details of {{ $event->title }}
                                </button>
                                <div class="collapse" id="eventDesc{{ $event->id }}">
                                    <div class="card card-body mt-2">
                                      {{  $event->description }} function will be held at {{ $event->location }} on {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }} at {{ \Carbon\Carbon::parse($event->event_time)->format('h:i A') }}.
                                    </div>
                                </div>
                            </div>
                            <span class="badge bg-primary rounded-pill">Hosted by {{ $event->host->name }}</span>
                            <span class="badge bg-primary rounded-pill">{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</span>
                            
                        </li>
                       @endforeach
                        <li class="list-group-item  justify-content-between align-items-center">
                            <button onclick="EventForm()" class="btn btn-white link-success link-underline-opacity-0 link-underline-opacity-100-hover">Host an Event</button>

<!-- ##################################################### event form ################################################## -->


<div class="container" id="eventform">
    <div class="card shadow event-card">
        <div class="card-header bg-dark text-white text-center py-3">
            <h5 class="mb-0">Host a New Event</h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('events.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label fw-semibold">Event Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter a catchy title" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="What is this event about?" required></textarea>
                </div>
                <input type="hidden" name="host_id" value="{{ auth()->user()->id }}">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="date" class="form-label fw-semibold">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="time" class="form-label fw-semibold">Time</label>
                        <input type="time" class="form-control" id="time" name="time" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label fw-semibold">Location</label>
                    <input type="text" class="form-control" id="location" name="location" placeholder="Enter location" required>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">Create Event</button> 
                </div>

            </form>
        </div>
    </div>
</div>

<!-- ################################################event form ends ############################################### -->

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
    <script>
        document.getElementById('eventform').style.display = 'none';
        function EventForm() {
            var form = document.getElementById('eventform');
            if (form.style.display === 'none') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
