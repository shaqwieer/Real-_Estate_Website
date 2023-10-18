<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class IndexController extends Controller
{
    //
    public function index()
    {
        return redirect('listing');
        // dd(Listing::all());
        // dd(Auth::user());
        // dd(Auth::check());
        // return Listing::paginate(2);
        //  return inertia('Index/Index',[
        //     'message'=>'hello from Laravel!'
        //  ]);
    }
    public function show()
    {
        return inertia('Index/Show');
    }
}
