<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Services\PageService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    protected PageService $pageService;

    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    public function index()
    {
        $locale = request()->get('locale', app()->getLocale());
        $pageContent = Cache::remember('home_content', 60, function () {
            return Page::firstWhere('slug', 'home');
        });
        $services = Service::all();
        // dd($pageContent->sections);
        return view('welcome', compact('pageContent', 'services', 'locale'));
    }

    public function services()
    {
        $services = Service::all();
        return view('services', compact('services'));
    }

    public function products()
    {
        $products = Product::all();
        return view('products', compact('products'));
    }

    public function product($id)
    {
        $product = Product::find($id);
        return view('product', compact('product'));
    }

    public function termsConditions()
    {
        $page = Page::where('slug', 'terms-of-service')->firstOrFail();
        return view('terms-conditions', compact('page'));
    }

    public function privacy()
    {
        $page = Page::where('slug', 'privacy-policy')->firstOrFail();
        return view('privacy', compact('page'));
    }
}
