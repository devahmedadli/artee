<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function langSwape($locale)
    {
        if (in_array($locale, ['en', 'ar'])) { // Add all your supported languages here
            App::setLocale($locale);
            Session::put('locale', $locale);
        }
        if (auth()->check()) {
            $user = User::find(auth()->user()->id);
            $user->lang = $locale;
            $user->save();
        }

        // Cache::forget('page_content_home_ar');
        // Cache::forget('page_content_home_en');
        return back();
    }
}
