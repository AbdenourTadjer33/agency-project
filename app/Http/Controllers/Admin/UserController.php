<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withCount('bookings')->paginate(5);
        return view('admin.user.index', [
            'users' => $users,
        ]);
    }

    public function show(Request $request)
    {
        $users = User::withCount('bookings')->where('uuid', $request->uuid)->paginate(5);
        return view('admin.user.index', [
            'users' => $users,
        ]);
    }
}
