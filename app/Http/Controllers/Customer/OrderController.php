<?php

namespace App\Http\Controllers\Customer;

use App\Models\Order;
use App\Models\Service;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreOrderRequest;
use App\Notifications\OrderCreatedNotification;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $serviceOrders = Order::where('customer_id', Auth::user()->id)->get();
        $productsOrders = ProductOrder::where('customer_id', Auth::user()->id)->get();
        $serviceOrders->each(function ($order) {
            $order->type = 'service';
        });
        $productsOrders->each(function ($order) {
            $order->type = 'product';
        });
        $orders = $serviceOrders->merge($productsOrders);
        return view('customer.orders.index', compact('orders'));
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
     * 
     * @param \App\Http\Requests\StoreOrderRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreOrderRequest $request)
    {
        $data               = $request->validated();
        $data['customer_id'] = Auth::user()->id;
        $order = Order::create($data);
        // storing attachments and adding to order attachments table
        if ($request->hasFile('attachments')) {
        foreach ($request->attachments as $attachment) {
            // 
            $path = $attachment->store('attachments/' . $order->id, 'public');
            $order->attachments()->create([
                'path' => $path,
                'name' => $attachment->getClientOriginalName(),
                ]);
            }
        }
        // send email to customer and admin via observer

        flash()->success(__('Order created successfully.'));
        return to_route('customer.orders.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id, $type)
    {
        if ($type == 'product') {
            $order = ProductOrder::find($id);
            $order = $order->load('product');
        }
        if ($type == 'service') {
            $order = Order::find($id);
            $order = $order->load('service');
        }
        return view('customer.orders.show', compact('order'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
