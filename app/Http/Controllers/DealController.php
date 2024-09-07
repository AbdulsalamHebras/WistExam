<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Deal;

use Redirect;


class DealController extends Controller
{
    public function create()
    {
        return view('deals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:deals,name',
            'photo' => 'required|mimes:png,jpg,jpeg|max:2048', // Ensure it's a valid image with size limit
            'price' => 'required|numeric', // Ensure 'price' is numeric
        ]);

        // Create a new instance of the Package model
        $data = new Deal();
        $data->name = $request->name;
        $data->price = $request->price;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extention = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $extention;
            $file->move('photos/deals', $file_name);
            $data->photo = $file_name;
        }

        // Save the new package to the database
        $data->save();

        return Redirect::route('dashboard')->with('success', 'Package created successfully!');


    }
    public function edit($id)
    {
        $deal = Deal::where('id', $id)->first();
        return view('deals.edit', compact('deal'));
    }
    public function update(Request $request, $id)
    {

        $deal = Deal::findOrFail($id);

        // Update name and price
        $deal->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        // Check if a new photo has been uploaded
        if ($request->hasFile('photo')) {
            // Delete the old photo if it exists
            if ($deal->photo && file_exists(public_path('photos/deals/' . $deal->photo))) {
                unlink(public_path('photos/deals/' . $deal->photo));
            }

            // Store the new photo
            $newPhotoName = time() . '_' . $request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(public_path('photos/deals'), $newPhotoName);

            // Update the package with the new photo path
            $deal->update(['photo' => $newPhotoName]);
        }

        return Redirect::route('dashboard')->with('success', 'Package updated successfully!');




    }
    public function delete($id)
    {
        $deal = Deal::findOrFail($id);
        if ($deal->photo && file_exists(public_path('photos/deals/' . $deal->photo))) {
            unlink(public_path('photos/deals/' . $deal->photo));
        }
        $deal->delete();

        return Redirect::route('dashboard')->with('success', 'Package deleted successfully!');


    }
}