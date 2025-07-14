@extends('layout.dashboard')

@section('content')
<div class="container">
    <h2>Create New Permission</h2>
    
    <form method="POST" action="{{ route('permissions.store') }}">
        @csrf
        
        <div class="form-group">
            <label for="name">Permission Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                   id="name" name="name" required>
            
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary mt-2">Create Permission</button>
        <a href="{{ route('permissions.index') }}" class="btn btn-secondary mt-2">Cancel</a>
    </form>
</div>
@endsection