<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProgress;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreOrderProgressRequest;
use App\Http\Requests\UpdateOrderProgressRequest;

class OrderProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreOrderProgressRequest $request)
    {
        // create progress related to order
        $orderProgress = OrderProgress::create($request->validated());
        flash()->success(__('Progress created successfully.'));
        if (Auth::user()->role == 'admin') {
            $orderProgress->update(['admin_accepted' => true]);
            return to_route('orders.show', $orderProgress->order_id);
        }
        return to_route('freelancer.orders.show', $orderProgress->order_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderProgress $orderProgress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderProgress $orderProgress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderProgressRequest $request, OrderProgress $orderProgress)
    {
        $orderProgress->update($request->validated());
        flash()->success(__('Progress updated successfully.'));
        return back();
    }

    /**
     * Accept the specified resource.
     */
    public function accept(OrderProgress $orderProgress)
    {
        $orderProgress->update(['admin_accepted' => true]);
        flash()->success(__('Progress accepted successfully.'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderProgress $orderProgress)
    {
        $orderProgress->delete();
        flash()->success(__('Progress deleted successfully.'));
        return back();
    }
}
