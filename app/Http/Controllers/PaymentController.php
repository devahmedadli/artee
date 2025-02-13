<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use App\Models\Freelancer;
use Illuminate\Http\Request;
use App\Models\FreelancerPayment;
use App\Http\Requests\StoreFreelancerPaymentRequest;

class PaymentController extends Controller
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
        $payment = FreelancerPayment::create($request->validated());
        flash()->success(__('Payment created successfully'));
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $payment = FreelancerPayment::findOrFail($id);
        $payment->update($request->all());
        flash()->success(__('Payment updated successfully'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment = FreelancerPayment::findOrFail($id);
        $payment->delete();
        flash()->success(__('Payment deleted successfully'));
        return back();
    }
}
