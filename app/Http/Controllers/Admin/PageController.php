<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdatePageRequest;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        $locale = request()->get('locale', app()->getLocale());
        // dd($pages);
        return view('admin.site.pages.index', compact('pages', 'locale'));
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        $view = $page->slug == 'home' ? 'edit-home' : 'edit-page';
        // dd($page->sections['content']);
        // dd(json_decode($page->sections()->first()->components()->first()->attributes, true));
        return view('admin.site.pages.' . $view, compact('page'));
    }

    public function update(UpdatePageRequest $request, Page $page)
    {
        $validated = $request->validated();

        $page->name = [
            'en' => $validated['name']['en'],
            'ar' => $validated['name']['ar']
        ];

        $page->description = [
            'en' => $validated['description']['en'],
            'ar' => $validated['description']['ar']
        ];

        // Handle sections based on page type
        $sections = $page->sections;

        if (isset($validated['sections'])) {
            foreach ($validated['sections'] as $sectionKey => $sectionData) {
                $sections[$sectionKey] = $sectionData;
            }
        }

        $page->sections = $sections;
        $page->save();

        // Clear cache if you're using caching
        Cache::forget('page_' . $page->slug);

        flash()->success(__('Page updated successfully.'));
        return redirect()
            ->route('pages.edit', $page->id);
    }
}
