<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo'
        ]);
        // $query = Listing::orderByDesc('created_at');

        // if ($filters['priceFrom'] ?? false) {
        //     $query->where('price', '>=', $filters['priceFrom']);
        // }

        // if ($filters['priceTo'] ?? false) {
        //     $query->where('price', '<=', $filters['priceTo']);
        // }

        // if ($filters['beds'] ?? false) {
        //     $query->where('beds', $filters['beds']);
        // }

        // if ($filters['baths'] ?? false) {
        //     $query->where('baths', $filters['baths']);
        // }

        // if ($filters['areaFrom'] ?? false) {
        //     $query->where('area', '>=', $filters['areaFrom']);
        // }

        // if ($filters['areaTo'] ?? false) {
        //     $query->where('area', '<=', $filters['areaTo']);
        // }

        return inertia('Listing/Index', [



            'filters' => $filters,
            // 'listings' => $query->paginate(10)
            //     ->withQueryString()


            // 'listings' => Listing::orderByDesc('created_at')
            'listings' => Listing::mostRecent()
                ->filter($filters)
                ->withoutSold()
                ->paginate(10)->
                withQueryString()
        ]);
        //
    }



    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        // if (Auth::user()->cannot('view', $listing)) {
        //     abort(403);
        // } or under
        // $this->authorize('view', $listing);
        $listing->load(['images']);
        $offer = !Auth::user() ?
            null : $listing->offers()->byMe()->first();
        return inertia('Listing/Show', [
            'listing' => $listing,
            'offerMade' => $offer
        ]);
        //
    }


    /**
     * Remove the specified resource from storage.
     */

    // public function destroy(Listing $listing)
    // {
    //     $listing->delete();
    //     return redirect()->back()
    //         ->with('success', 'Listing was deleted!');
    // }
}
