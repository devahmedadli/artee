<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderFile;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreOrderFileRequest;
use App\Http\Requests\UpdateOrderFileRequest;

class OrderFileController extends Controller
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
    public function store(StoreOrderFileRequest $request, Order $order)
    {
        // store uploaded files and store paths and names in database
        foreach ($request->file('files') as $file) {
            $path = $file->store('orders/' . $order->id, 'public');
            $order->files()->create([
                'name' => $file->getClientOriginalName(),
                'path' => $path,
            ]);
        }
        flash()->success(__('Files uploaded successfully.'));
        if (auth()->user()->role == 'admin') {
            return to_route('orders.show', $order->id);
        }
        return to_route('freelancer.orders.show', $order->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderFile $orderFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderFile $orderFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderFileRequest $request, OrderFile $orderFile)
    {
        //
    }

    /**
     * Accept the specified resource.
     */
    public function accept(OrderFile $orderFile)
    {
        $orderFile->update(['admin_accepted' => true]);
        flash()->success(__('File accepted successfully.'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderFile $orderFile)
    {
        if ($orderFile->path) {
            Storage::delete($orderFile->path);
        }
        $orderFile->delete();
        flash()->success(__('File deleted successfully.'));
        return back();
    }
}
