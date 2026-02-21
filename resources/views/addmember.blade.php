<x-layout title="Add Member">
<!-- add member -->
        <div class="card col-lg-5 mx-auto">
            <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
                <span>Register New Member in {{ auth()->user()->house_no }}  </span>
                <a type="button" class="btn-close btn-close-white" aria-label="Close" href="{{ route('userhome', auth()->user()->house_no) }}"></a>
            </div>
            <div class="card-body">
                <form action="{{ route('save.user') }}" method="post">
                    @session('success')
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endsession
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted border-end-0"><i class="fas fa-user"></i></span>
                            <input type="text" name="name" class="form-control border-start-0" placeholder="Name Here" required>
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
                        
                        <input type="hidden" name="house_no" value="{{ auth()->user()->house_no }}">
                        <input type="hidden" name="user_type" value="member">
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

<!-- add member ends  -->
</x-layout>
