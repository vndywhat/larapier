<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(int $userId)
    {
        $profile = User::where('id', $userId)->withCount(['posts', 'topics'])->first();

        return view('users.profile', compact('profile'));
    }
}
