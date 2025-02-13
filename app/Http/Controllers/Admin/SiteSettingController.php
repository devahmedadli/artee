<?php

namespace App\Http\Controllers\Admin;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateSiteSettingRequest;

class SiteSettingController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     * @return \Illuminate\View\View    
     */
    public function index()
    {
        $settings = Cache::remember('site-settings', 60, function () {
            return SiteSetting::first();
        });
        return view('admin.site.settings.edit', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateSiteSettingRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateSiteSettingRequest $request)
    {
        $validatedData = $request->validated();
        $settings = SiteSetting::first() ?? new SiteSetting();

        // Handle Logo Upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($settings->logo) {
                Storage::disk('public')->delete($settings->logo);
            }
            $logoPath = $request->file('logo')->store('site/logo', 'public');
            $validatedData['logo'] = $logoPath;
        }

        // Handle Favicon Upload
        if ($request->hasFile('favicon')) {
            // Delete old favicon if exists
            if ($settings->favicon) {
                Storage::disk('public')->delete($settings->favicon);
            }
            $faviconPath = $request->file('favicon')->store('site/favicon', 'public');
            $validatedData['favicon'] = $faviconPath;
        }

        // Handle Social Media
        $validatedData['social_media'] = [
            'facebook'      => $request->input('social_media.facebook') ?? null,
            'instagram'     => $request->input('social_media.instagram') ?? null,
            'twitter'       => $request->input('social_media.twitter') ?? null,
            'linkedin'      => $request->input('social_media.linkedin') ?? null,
            'youtube'       => $request->input('social_media.youtube') ?? null,
        ];

        // Handle Contact Information
        $validatedData['contact'] = [
            'phone'         => $request->input('contact.phone') ?? null,
            'email'         => $request->input('contact.email') ?? null,
            'address'       => $request->input('contact.address') ?? null,
        ];

        // Handle Colors
        $validatedData['colors'] = [
            'primary'           => $request->input('colors.primary') ?? null,
            'primary-dark'      => $request->input('colors.primary-dark') ?? null,
            'secondary'         => $request->input('colors.secondary') ?? null,
            'secondary-dark'    => $request->input('colors.secondary-dark') ?? null,
            'tertiary'          => $request->input('colors.tertiary') ?? null,
            'tertiary-dark'     => $request->input('colors.tertiary-dark') ?? null,
        ];

        try {
            $settings->fill($validatedData);
            $settings->save();
            Cache::forget('site-settings');
            flash()->success(__('Settings updated successfully.'));
        } catch (\Exception $e) {
            flash()->error(__('Failed to update settings.'));
            return redirect()->route('site-settings.index');
        }

        return redirect()->route('site-settings.index');
    }
}
