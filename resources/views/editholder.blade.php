<x-layout>
 <!-- add holder -->
 
        <div class="card col-lg-5 mx-auto">
            <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
                <span>Register New Holder</span>
                <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="showSection('dashboard-overview')"></button>
            </div>
            <div class="card-body">
                <form action="" method="post">
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
                                
                                <option value="">home</option>
                                
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

</x-layout>