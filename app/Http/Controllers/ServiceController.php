<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(StoreServiceRequest $request)
    {
        $service = Service::create($request->validated());
        if ($request->hasFile('image')) {
            // store image and save the path in the database
            $path = $request->file('image')->store('services', 'public');
            $service->update(['image' => $path]);
        }

        flash()->success(__('Service created successfully.'));
        return to_route('services.index');
    }

    public function show(Service $service)
    {
        return view('admin.services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        // dd(Storage::exists('public/'.$service->image));
        $service->update($request->validated());
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $path = $request->file('image')->store('services', 'public');
            $service->update(['image' => $path]);
        }

        flash()->success(__('Service updated successfully.'));
        return to_route('services.index');
    }

    public function destroy(Service $service)
    {
        // Delete old image if it exists
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }
        
        // set related orders and products to null
        $service->orders()->update(['service_id' => null]);
        $service->products()->update(['service_id' => null]);
        // delete the service
        $service->delete();
        flash()->success(__('Service deleted successfully.'));
        return to_route('services.index');
    }
}
