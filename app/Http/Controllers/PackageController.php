<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Package;
use Redirect;


class PackageController extends Controller
{
    public function create()
    {
        return view('packages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:packages,name',
            'photo' => 'required|mimes:png,jpg,jpeg|max:2048', // Ensure it's a valid image with size limit
            'price' => 'required|numeric', // Ensure 'price' is numeric
        ]);

        // Create a new instance of the Package model
        $data = new Package();
        $data->name = $request->name;
        $data->price = $request->price;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extention = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $extention;
            $file->move('photos/packages', $file_name);
            $data->photo = $file_name;
        }

        $data->save();
        return Redirect::route('dashboard')->with('success', 'Package created successfully!');


    }
    public function edit($id)
    {
        $package = Package::where('id', $id)->first();
        return view('packages.edit', compact('package'));
    }
    public function update(Request $request, $id)
    {

        $package = Package::findOrFail($id);

        // Update name and price
        $package->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        // Check if a new photo has been uploaded
        if ($request->hasFile('photo')) {
            // Delete the old photo if it exists
            if ($package->photo && file_exists(public_path('photos/packages/' . $package->photo))) {
                unlink(public_path('photos/packages/' . $package->photo));
            }

            // Store the new photo
            $newPhotoName = time() . '_' . $request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(public_path('photos/packages'), $newPhotoName);

            // Update the package with the new photo path
            $package->update(['photo' => $newPhotoName]);
        }
        // $allPackages = Package::all();
        // $alldeals = deal::all();
        // $allActivities = Activity::all();
        // $allCommant = Commant::orderBy('created_at', 'desc')->take(3)->get();

        return Redirect::route('dashboard')->with('success', 'Package updated successfully!');



    }
    public function delete($id)
    {
        $package = Package::findOrFail($id);
        // Check if the package has a photo and delete the file from the storage
        if ($package->photo && file_exists(public_path('photos/packages/' . $package->photo))) {
            unlink(public_path('photos/packages/' . $package->photo));
        }
        // Delete the package record from the database
        $package->delete();

        return Redirect::route('dashboard')->with('success', 'Package deleted successfully!');

    }
}