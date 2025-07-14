@extends('layout.dashboard')

@section('content')
<div class="container">
    <h2>Permissions</h2>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('permissions.create') }}" class="btn btn-primary">Create New Permission</a>
    </div>

   <table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Created At</th>
            <th>Actions</th> <!-- Add this -->
        </tr>
    </thead>
    <tbody>
        @foreach($permissions as $permission)
        <tr>
            <td>{{ $permission->id }}</td>
            <td>{{ $permission->name }}</td>
            <td>{{ $permission->created_at }}</td>
            <td>
                <!-- Edit Button -->
                 @can('permission.update')
                <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-sm btn-warning">Edit</a>
                @endcan
                <!-- Delete Form -->
                 @can('permission.delete')
                <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST"
                    style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"
                        onclick="return confirm('Are you sure?')">Delete</button>
                </form>
                @endcan
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>
@endsection