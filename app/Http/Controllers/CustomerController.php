<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Events\UserCreated;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateUserRequest;

class CustomerController extends Controller
{
    public function account()
    {

        return view('customer.account');
    }

    public function index()
    {
        $customers = User::where('role', 'customer')->get();
        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(StoreUserRequest $request)
    {
        $customerData = $request->validated();
        $customerData['password'] = Hash::make($customerData['password']);
        $customerData['role']     = 'customer';

        $customer = User::create($customerData);

        UserCreated::dispatch($customer, $request);

        flash()->success('تم تسجيل الزبون بنجاح');
        return to_route('customers.index');
    }

    public function show(User $customer)
    {
        $orders     = $customer->customerOrders;
        $customer->load('customer');
        return view('admin.customers.show', compact('customer', 'orders'));
    }

    public function edit(User $customer)
    {
        $customer->load('customer');

        return view('admin.customers.edit', compact('customer'));
    }

    public function update(UpdateUserRequest $request, User $customer)
    {
        $customerData = $request->validated();
        // Check if the password exists and is not empty
        if (!empty($customerData['password'])) {
            $customerData['password'] = Hash::make($customerData['password']);
        } else {
            // Remove the password field from the data if not provided
            unset($customerData['password']);
        }

        // Update the user with the validated data
        $customer->update($customerData);
        $customer->customer->update($customerData);
        flash()->success('تم تحديث بيانات الزبون بنجاح');
        return to_route('customers.index');
    }

    // Update Password
    public function updatePassword(Request $request)
    {
        $request->validate(
            [
                'current_password'  => 'required|current_password',
                'new_password'      => 'required|confirmed|min:8',
            ],
            [
                'current_password.required' => __('Please enter your current password'),
                'new_password.required'     => __('Please enter your new password'),
                'new_password.confirmed'    => __('Please confirm your new password'),
                'new_password.min'          => __('Password must be at least 8 characters long'),
            ]
        );

        $user = auth()->user();
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        flash()->success('تم تحديث كلمة المرور بنجاح');
        return to_route('customer.account');
    }

    /**
     * Update Customer Info
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateInfo(Request $request)
    {
        $request->validate(
            [
                'name'      => 'required',
                'email'     => 'required|email',
                'phone'     => 'nullable',
            ],
            [
                'name.required'     => __('Name is required'),
                'email.required'    => __('Email is required'),
                'email.email'       => __('Invalid email format'),
            ]
        );

        $user = auth()->user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        flash()->success('تم تحديث بيانات الحساب بنجاح');
        return to_route('customer.account');
    }

    /**
     * Update Customer Image
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/profile_images', $imageName);

            // delete old image
            Storage::delete('public/profile_images/' . auth()->user()->avatar);
            // Update user's image in the database
            auth()->user()->update(['avatar' => 'profile_images/' . $imageName]);

            flash()->success(__('Profile image updated successfully.'));
            return to_route('customer.account');
        }

        flash()->error(__('Failed to update profile image.'));
        return to_route('customer.account');
    }

    /**
     * Destroy Customer
     * @param User $customer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $customer)
    {
        $customer->delete();
        notyf()->success(__('Customer deleted successfully.'));
        return to_route('customers.index');
    }
}
