<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FreelancerPayment;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreFreelancerPaymentRequest;
use App\Http\Requests\UpdateFreelancerPaymentRequest;

class FreelancerPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments       = FreelancerPayment::with('freelancer')->get();
        $freelancers    = User::where('role', 'freelancer')->get();
        // dd($payments);
        return view('admin.payments.index', compact('payments', 'freelancers'));
    }

    public function freelancerIndex()
    {
        $payments       = FreelancerPayment::with('freelancer')->where('freelancer_id', Auth::user()->id)->get();
        return view('freelancer.payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFreelancerPaymentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FreelancerPayment $freelancerPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FreelancerPayment $freelancerPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFreelancerPaymentRequest $request, FreelancerPayment $freelancerPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FreelancerPayment $freelancerPayment)
    {
        //
    }
}
