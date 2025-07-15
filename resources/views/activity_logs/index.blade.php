@extends('layout.dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Activity Logs</h1>
    <div class="card mb-4">
        <div class="card-body">
            <!-- <form action="{{ route('activity-logs.search') }}" method="GET" class="d-flex mb-3">
                <input type="text" name="q" class="form-control me-2" placeholder="Search logs...">
                <button type="submit" class="btn btn-primary">Search</button>
            </form> -->

            <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Login Time</th>
                            <th>Logout Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)
                        <tr>
                            <td>{{ $log->user->name }}</td>
                            <td>{{ $log->login_time }}</td>
                            <td>{{ $log->logout_time ?? 'N/A' }}</td>
                            <td>
                                <span class="badge bg-{{ $log->status === 'active' ? 'success' : 'danger' }}">
                                    {{ ucfirst($log->status) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

