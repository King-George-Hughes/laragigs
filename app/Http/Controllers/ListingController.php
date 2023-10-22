<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request)
    public function index()
    {
        // dd($request->tag);
        // dd(request['tag']);
        $listings = Listing::latest()->filter(request(['tag', 'search']))->get();
        return view('listings.index', [
            'listings' => $listings
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('listings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $formData = $request->validate([
            'title' => 'required | min:3',
            'description' => 'required | min:50',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => ['required'],
            'email' => 'required | unique | email',
            'tags' => 'required',
            'website' => ['required'],
        ]);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
