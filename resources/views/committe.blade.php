<x-layout>
 

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-users-cog me-2"></i>Committee & Admin List</span>
                <a href="{{ route('admin.dash')}}" class="btn btn-sm btn-light">Back</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light"><tr><th>#</th><th>Full Name</th><th>Email Address</th><th>Role</th></tr></thead>
                    <tbody>
                        @isset($committee)
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

</x-layout>