@extends('layout.dashboard')
@section('content')
<div class="table-responsive">
    <table class="table table-hover">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach($user->getRoleNames() as $role)
                        <span class="badge bg-primary me-1">{{ $role }}</span>
                    @endforeach
                    @if($user->getRoleNames()->isEmpty())
                        <span class="badge bg-secondary">No roles assigned</span>
                    @endif
                </td>
                <td class="text-end">
                    <div class="btn-group" role="group" aria-label="User actions">
                        @can('user.view')
                        <a href="{{ route('profile.show', $user->id) }}" class="btn btn-sm btn-info" title="View">
                            <i class="bi bi-eye"></i>
                        </a>
                        @endcan
                        @can('user.edit')
                        <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-sm btn-warning" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        @endcan
                        @can('user.delete')
                        <form method="POST" action="{{ route('profile.destroy', $user->id) }}" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this user?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                        @endcan
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No users found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>


@endsection