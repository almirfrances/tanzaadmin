<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Page\Models\Page;

class PageController extends Controller
{
        /**
     * Display the homepage.
     */
    // public function home()
    // {
    //     $page = Page::where('is_closed', true)->first();

    //     if (!$page) {
    //         abort(404, 'Homepage not found');
    //     }

    //     return view('frontend.home', compact('page'));
    // }

        public function home()
    {
        $page = Page::where('is_closed', true)
            ->with(['sections' => function($query) {
                $query->orderBy('position');
            }])
            ->first();

        if (!$page) {
            abort(404, 'Homepage not found');
        }

        return view('frontend.home', compact('page'));
    }

    /**
     * Display a page by slug.
     */
    public function show($slug)
    {
        $page = Page::where('slug', $slug)->first();

        if (!$page) {
            abort(404, 'Page not found');
        }

        return view('frontend.show', compact('page'));
    }


    
}
