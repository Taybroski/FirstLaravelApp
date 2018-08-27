<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        $title = "Welcome to Laravel";
        return view('pages.index', compact('title')); 
    }
    public function about() {
        $title = "About Everything!";
        return view('pages.about')->with('title', $title);
    }
    public function services() {
        $services = array
        (
            'title' => 'Services Provided!',
            'services' => ['Web Design', 'Procurement & Supply']
        );     
        return view('pages.services')->with($services);
    }
}
