<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::active()->latest()->paginate(9);

        return view('pages.testimonials.index', compact('testimonials'));
    }
}
