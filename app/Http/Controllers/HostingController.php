<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HostingController extends Controller
{
    /**
     * Display the hosting landing page.
     */
    public function index()
    {
        $testimonials = Testimonial::where('status', 'active')->orderBy('sort_order')->orderByDesc('created_at')->get();
        $faqs = Faq::where('active', true)->orderBy('sort_order')->get();
        
        // Fetch hosting packages from database
        $packages = \App\Models\HostingPackage::where('status', 'active')->orderBy('sort_order')->get();
        
        // Use hosting settings group
        $settings = Setting::where('group', 'hosting')->pluck('value', 'key');

        return view('hosting', compact('testimonials', 'faqs', 'settings', 'packages'));
    }
}
