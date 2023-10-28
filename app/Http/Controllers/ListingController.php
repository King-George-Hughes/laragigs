<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
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
        // $listings = Listing::latest()->filter(request(['tag', 'search']))->get();
        $listings = Listing::latest()->filter(request(['tag', 'search']))->paginate(4);
        return view('listings.index', [
            'listings' => $listings
        ]);
    }

    public function manage(){
        $getCurrentLoggedInUserListings = auth()->user()->listings()->get();

        return view('listings.manage', [
            'listings' => $getCurrentLoggedInUserListings
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
        // dd($request->file('logo'));
        // dd($request->all());
        $formData = $request->validate([
            'title' => 'required | min:3',
            'description' => 'required | min:50',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => ['required'],
            'email' => 'required | email',
            'tags' => 'required',
            'website' => ['required'],
        ]);

        if($request->hasFile('logo')){
            $formData['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formData['user_id'] = auth()->id();

        Listing::create($formData);

        return redirect('/')->with('message', 'Listing Created Successfully!');
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
    public function edit(Listing $listing)
    {
        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Access');
        }
        
        return view('listings.edit', [
            'listing' => $listing
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Access');
        }

        $formData = $request->validate([
            'title' => 'required | min:3',
            'description' => 'required | min:50',
            'company' => 'required',
            'location' => 'required',
            'email' => 'required | email',
            'tags' => 'required',
            'website' => ['required'],
        ]);

        if($request->hasFile('logo')){
            $formData['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formData);

        return back()->with('message', 'Listing Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Access');
        }
        
        $listing->delete();

        return redirect('/')->with('message', 'Listing Deleted Successfully!');
    }
}