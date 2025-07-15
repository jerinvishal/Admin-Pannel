<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Student; // ✅ Import Student
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index()
    {
        $logs = ActivityLog::with('user')->latest()->paginate(10);
        return view('activity_logs.index', compact('logs'));
    }


    public function search(Request $request)
    {
        $query = $request->input('q');

        $logs = ActivityLog::with('user')
            ->where(function ($q) use ($query) {
                $q->whereHas('user', function ($userQuery) use ($query) {
                    $userQuery->where('name', 'like', '%' . $query . '%');
                })
                    ->orWhere('login_time', 'like', '%' . $query . '%')
                    ->orWhere('logout_time', 'like', '%' . $query . '%')
                    ->orWhere('ip_address', 'like', '%' . $query . '%')
                    ->orWhere('user_agent', 'like', '%' . $query . '%')
                    ->orWhere('status', 'like', '%' . $query . '%');
            })
            ->get();

        return view('activity_logs.index', compact('logs'));
    }
}
