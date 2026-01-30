<x-layout>
        <div class="card col-lg-4 mx-auto">
            <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
                <span>Change Owner for {{ $home_no }}</span>
                <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="showSection('dashboard-overview')"></button>
            </div>
            <div class="card-body">
                <form action="{{ route('update.owner') }} " method="post">
                    @csrf
                    @method('PUT')
                    @if( $errors->any())
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
            <input type="hidden" name="home_no" value="{{ $home_no }}">
                        <label class="form-label">Select Owner</label>
                        <select name="owner_id" class="form-select" required>
                            @foreach($members as $holder)
                            @if($holder->user_type =="owner")
                                <option value="{{ $holder->id }}" selected disabled>{{ $holder->name }} - {{ $holder->email }} (Owner)</option>
                            @else
                                <option value="{{ $holder->id }}" >{{ $holder->name }} - {{ $holder->email }}</option>
                            @endif
                            @endforeach
                        </select>
                    <div class="d-flex mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-refresh me-2"></i>Update
                        </button>
                        <a type="submit" class="btn btn-primary ms-4" href="{{ route('admin.dash') }}">
                            <i class="fas fa-arrow-left me-2"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>     
</x-layout>