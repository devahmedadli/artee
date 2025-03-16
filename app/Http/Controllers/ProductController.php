<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\OptionValue;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::select('id', 'ar_name', 'en_name', 'base_price')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $services = Service::all();
        return view('admin.products.create', compact('services'));
    }

    /**
     * Store a newly created product in the database.
     *
     * @param StoreProductRequest $request The request containing product data.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreProductRequest $request)
    {
        try {
            DB::beginTransaction();

            // Handle image upload
            $imagePath = $request->file('image')->store('products', 'public');

            // Create the product
            $product = Product::create([
                'ar_name'       => $request->ar_name,
                'en_name'       => $request->en_name,
                'base_price'    => $request->base_price,
                'image'         => $imagePath,
                'ar_description' => $request->ar_description,
                'en_description' => $request->en_description,
                'active'        => $request->active,
            ]);

            // Handle options if they exist
            if ($request->has('options')) {
                foreach ($request->options as $optionData) {
                    $option = $product->options()->create([
                        'ar_name' => $optionData['ar_name'],
                        'en_name' => $optionData['en_name'],
                    ]);

                    // Create option values
                    foreach ($optionData['values'] as $valueData) {
                        $optionValue = OptionValue::create([
                            'option_id' => $option->id,
                            'ar_value' => $valueData['ar_value'],
                            'en_value' => $valueData['en_value'],
                            'price'    => $valueData['price'],
                        ]);
                        
                        // Handle requirements if they exist for this value
                        if (isset($valueData['requirements'])) {
                            foreach ($valueData['requirements'] as $requirementData) {
                                $optionValue->requirements()->create([
                                    'ar_name' => $requirementData['ar_name'],
                                    'en_name' => $requirementData['en_name'],
                                    'type' => $requirementData['type'],
                                    'required' => isset($requirementData['required']) ? true : false,
                                ]);
                            }
                        }
                    }
                }
            }

            DB::commit();

            flash()->success(__('Product created successfully'));
            return to_route('products.index');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e->getMessage());
            // Delete uploaded image if exists
            if (isset($imagePath) && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            flash()->error(__('Error creating product. Please try again.'));
            return redirect()
                ->back()
                ->withInput();
        }
    }

    public function productDetails(Product $product)
    {
        $product->load('options.values');
        return view('product', compact('product'));
    }

    public function show(Product $product)
    {
        $product->load('options.values');
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $product->load('options.values');
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified product in the database.
     *
     * @param UpdateProductRequest $request The request containing product data.
     * @param \App\Models\Product $product The product to be updated.
     * @return \Illuminate\Http\RedirectResponse    
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            DB::beginTransaction();
            
            $data = $request->validated();

            if ($request->hasFile('image')) {
                // Delete old image
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }
                
                // Store new image
                $data['image'] = $request->file('image')->store('products', 'public');
            } else {
                // Remove image from data if no new image was uploaded
                unset($data['image']);
            }

            // Update product
            $product->update($data);

            // Update or create options
            if (isset($data['options'])) {
                // Delete existing options and their values
                $product->options()->each(function ($option) {
                    $option->values()->each(function ($value) {
                        // Delete requirements for each value
                        $value->requirements()->delete();
                    });
                    $option->values()->delete();
                });
                $product->options()->delete();

                // Create new options and values
                foreach ($data['options'] as $optionData) {
                    $option = $product->options()->create([
                        'ar_name' => $optionData['ar_name'],
                        'en_name' => $optionData['en_name'],
                    ]);

                    foreach ($optionData['values'] as $valueData) {
                        $optionValue = $option->values()->create([
                            'ar_value' => $valueData['ar_value'],
                            'en_value' => $valueData['en_value'],
                            'price' => $valueData['price'],
                        ]);
                        
                        // Handle requirements if they exist for this value
                        if (isset($valueData['requirements'])) {
                            foreach ($valueData['requirements'] as $requirementData) {
                                $optionValue->requirements()->create([
                                    'ar_name' => $requirementData['ar_name'],
                                    'en_name' => $requirementData['en_name'],
                                    'type' => $requirementData['type'],
                                    'required' => isset($requirementData['required']) ? true : false,
                                ]);
                            }
                        }
                    }
                }
            }

            DB::commit();
            
            flash()->success(__('Product updated successfully'));
            return to_route('products.index');
            
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e->getMessage());
            
            flash()->error(__('Error updating product. Please try again.'));
            return redirect()
                ->back()
                ->withInput();
        }
    }

    /**
     * Remove the specified product from the database.
     *
     * @param \App\Models\Product $product The product to be deleted.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::delete($product->image);
        }
        $product->delete();
        flash()->success(__('Product deleted successfully'));
        return to_route('products.index');
    }
}
