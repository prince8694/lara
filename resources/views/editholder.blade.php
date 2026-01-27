<x-layout>
 <!-- add holder -->
 
        <div class="card col-lg-5 mx-auto">
            <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
                <span>Register New Holder</span>
                <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="showSection('dashboard-overview')"></button>
            </div>
            <div class="card-body">
                <form action="{{ route('update.holder') }} " method="post">
                    @csrf
                    @method('PUT')
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
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted border-end-0"><i class="fas fa-user"></i></span>
                            <input type="text" name="name" class="form-control border-start-0" value="{{ $holder->name }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted border-end-0"><i class="fas fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control border-start-0" value="{{ $holder->email }}" placeholder="name@example.com" required>
                        </div>
                        <input type="hidden" name="id" value="{{ $holder->id }}">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">House Number</label>
                            <select name="house_no" class="form-select" required>
                                
                                <option value="{{ $holder->house_no }}">{{ $holder->house_no }}</option>
                                
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Holder Type</label>
                            <select name="user_type" class="form-select" required>
                                @if($holder->user_type =="owner")
                                <option value="owner">Owner</option>
                                @elseif( $holder->user_type =="member" )
                                <option value="member">Member</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-refresh me-2"></i>Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- add holder ends  -->

</x-layout>