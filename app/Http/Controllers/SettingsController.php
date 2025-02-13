<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{

    // Admin
    public function adminUpdate(Request $request)
    {
        return $this->update($request);
    }

    // Freelancer
    public function freelancerUpdate(Request $request)
    {
        return $this->update($request);
    }
    
    private function update(Request $request)
    {
        $user = Auth::user();

        // Validate the incoming request data

        // Update user details
        $user->name     = $request->input('name');
        $user->email    = $request->input('email');

        // Check if password is provided and if so, hash it
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        // Redirect back with success message
        flash()->success(__('Settings updated successfully.'));
        return back();
    }
}
