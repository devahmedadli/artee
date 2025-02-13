<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ComponentController extends Controller
{
    public function update(Request $request, $id)
    {
        $component = Component::findOrFail($id);
        
        // Check if attributes is a string before decoding
        $attributes = is_string($component->attributes) ? json_decode($component->attributes, true) : $component->attributes;
        $attributes = array_merge($attributes, $request->input('attributes', []));

        $component->update([
            'value' => $request->input('value'),
            'attributes' => json_encode($attributes), 
            'is_active' => $request->boolean('is_active'),
        ]);

        // Update translations
        $component->setTranslation('value', 'ar', $request->input('value_ar'));
        if ($request->has('attributes_ar')) {
            $component->setTranslation('attributes', 'ar', json_encode($request->input('attributes_ar')));
        }

        // Clear cache
        Cache::forget("page_content_{$component->section->page->slug}");

        return response()->json(['message' => 'Component updated successfully']);
    }
}