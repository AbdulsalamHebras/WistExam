<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commant;
use Redirect;
class CommantController extends Controller
{
    public function create(Request $request)
    {
        return view('commant.create', ['user' => $request->user()]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'commant' => 'required',
        ]);

        $data = new Commant();
        $data->user_id = $request->user_id;
        $data->username = $request->username;
        $data->commant = $request->commant;
        $data->save();
        return Redirect::route('dashboard')->with('success', 'Package created successfully!');



    }
}