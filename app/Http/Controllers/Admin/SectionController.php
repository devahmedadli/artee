<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SectionController extends Controller
{
    public function update(Request $request, $id)
    {
        $section = Section::findOrFail($id);
        
        $section->update([
            'is_active' => $request->boolean('is_active'),
        ]);
        // Clear cache
        Cache::forget("page_content_{$section->page->slug}");

        return response()->json(['message' => __('Section updated successfully')]);
    }
}