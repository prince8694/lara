<x-layout>
    <div>
        <select name="" id="">
            <option value="">Select Owner for {{ $home_no }}</option>
            @foreach($members as $holder)
                <option value="{{ $holder->id }}">{{ $holder->name }} - {{ $holder->email }}</option>
            @endforeach
        </select>

        <div class="mb-3">
                        <label class="form-label">Select Owner for {{ $home_no }}</label>
                        <select name="user_type" class="form-select" required>
                            @foreach($members as $holder)
                <option value="{{ $holder->id }}">{{ $holder->name }} - {{ $holder->email }}</option>
            @endforeach
                        </select>
                    </div>
</x-layout>