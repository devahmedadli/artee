<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('service')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $services = Service::all();
        return view('admin.products.create', compact('services'));
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->update(['image' => $path]);
        }
        flash()->success('Product created successfully.');
        return to_route('products.index');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $services = Service::all();
        return view('admin.products.edit', compact('product', 'services'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->update(['image' => $path]);
        }
        flash()->success('Product updated successfully.');
        return to_route('products.index');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::delete($product->image);
        }
        $product->delete();
        flash()->success('Product deleted successfully.');
        return to_route('products.index');
    }
}
