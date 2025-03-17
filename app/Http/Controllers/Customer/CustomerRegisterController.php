<?php

namespace App\Http\Controllers\Customer;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterCustomerRequest;

class CustomerRegisterController extends Controller
{
    /**
     * Show the register page
     * 
     * @return \Illuminate\View\View
     */
    public function registerPage()
    {
        if (auth()->check()) {
            return to_route('index');
        }
        return view('auth.customer.register');
    }

    /**
     * Register a new customer
     * 
     * @param RegisterCustomerRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(RegisterCustomerRequest $request)
    {
        $data           = $request->validated();
        $data['role']   = 'customer';
        $user           = User::create($data);
        $user->customer()->create(
            [
                'user_id'       => $user->id,
                'bio'           => '',
                'country'       => '',
                'website'       => '',
                'specification' => '',
                'skills'        => '',
            ]
        );

        Chat::create([
            'chatable_id'   => $user->id,
            'chatable_type' => 'App\Models\User',
            'admin_id'      => 1,
        ]);
        auth()->login($user);
        try {
            app(\App\Services\NotificationService::class)->notifyAdmin(new \App\Notifications\NewCustomerRegistered($user));
        } catch (\Exception $e) {
            \Log::error('Error notifying admin: ' . $e->getMessage());
        }
        flash()->success(__('Registration successful, Welcome!'));
        return to_route('index');
    }
}
