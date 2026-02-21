<x-layout title="Register Complaint">
<div class="container">
    <div class="form-container">
        <h2 class="text-center mb-4">Register a Complaint</h2>

        <form action="{{ route('complaint.store') }}" method="POST">
            @csrf
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
            <div class="mb-3">
                <label for="category" class="form-label">Complaint Category</label>
                <select class="form-select" id="category" name="category" required>
                    <option value="" selected disabled>Select a category</option>
                    <option value="Electrician">Electrical</option>
                    <option value="Plumber">Plumbing</option>
                    <option value="Cleaner">Cleaning</option>
                    <option value="Billing & Payments">Billing & Payments</option>
                </select>
                <div class="form-text">Choose the category that best describes your issue.</div>
            </div>
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Please provide details about your complaint..." required></textarea>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Submit Complaint</button>
            </div>
        </form>
    </div>
</div>
</x-layout>