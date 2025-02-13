<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Freelancer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreFreelancerRequest;
use App\Http\Requests\UpdateFreelancerRequest;

class FreelancerController extends Controller
{
    public function index()
    {
        $freelancers = User::where('role', 'freelancer')->get();
        return view('admin.freelancers.index', compact('freelancers'));
    }

    public function create()
    {
        return view('admin.freelancers.create');
    }

    public function store(StoreFreelancerRequest $request)
    {
        $freelancerData = $request->validated();
        $freelancerData['password'] = Hash::make($freelancerData['password']);
        $freelancerData['role'] = 'freelancer';
        // create username from name
        $freelancerData['username'] = Str::slug($freelancerData['name']);
        // dd($freelancerData);
        $freelancer = User::create($freelancerData);
        // dd($freelancer);
        Freelancer::create([
            'user_id'       => $freelancer->id,
            'bio'           => $request->bio,
            'country'       => $request->country,
            'website'       => $request->website,
            'specification' => $request->specification,
            'skills'        => $request->skills,
        ]);

        flash()->success(__('Freelancer created successfully.'));
        return to_route('freelancers.index');
    }

    public function show(User $freelancer)
    {
        // dd($freelancer);
        $freelancer->load('freelancer');
        return view('admin.freelancers.show', compact('freelancer'));
    }

    public function edit(User $freelancer)
    {
        return view('admin.freelancers.edit', compact('freelancer'));
    }

    public function update(UpdateFreelancerRequest $request, User $freelancer)
    {
        $freelancerData = $request->validated();

        if (isset($freelancerData['password']) && $freelancerData['password'] !== null) {
            $freelancerData['password'] = bcrypt($freelancerData['password']);
        } else {
            unset($freelancerData['password']);
        }

        $freelancer->update($freelancerData);

        $freelancer->freelancer->update([
            'bio'           => $request->bio,
            'country'       => $request->country,
            'website'       => $request->website,
            'specification' => $request->specification,
            'skills'        => $request->skills,
        ]);

        flash()->success(__('Freelancer updated successfully.'));
        return to_route('freelancers.index');
    }

    public function destroy(User $freelancer)
    {
        $freelancer->freelancer()->delete();
        $freelancer->delete();
        flash()->success(__('Freelancer deleted successfully.'));
        return to_route('freelancers.index');
    }
}
