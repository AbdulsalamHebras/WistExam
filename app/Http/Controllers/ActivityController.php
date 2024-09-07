<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commant;
use App\Models\Activity;
use App\Models\Deal;
use App\Models\Package;
use Redirect;

class ActivityController extends Controller
{
    public function create()
    {
        return view('activities\create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:activities,name',
            'photo' => 'required|mimes:png,jpg,jpeg|max:2048', // Ensure it's a valid image with size limit
            'description' => 'required',
        ]);
        $data = new Activity();
        $data->name = $request->name;
        $data->description = $request->description;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extention = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $extention;
            $file->move('photos/activities', $file_name);
            $data->photo = $file_name;
        }


        $data->save();
        return Redirect::route('dashboard')->with('success', 'Package created successfully!');


    }
    public function edit($id)
    {
        $activity = Activity::where('id', $id)->first();
        return view('activities.edit', compact('activity'));
    }
    public function update(Request $request, $id)
    {

        $activity = Activity::findOrFail($id);


        $activity->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Check if a new photo has been uploaded
        if ($request->hasFile('photo')) {
            // Delete the old photo if it exists
            if ($activity->photo && file_exists(public_path('photos/activities/' . $activity->photo))) {
                unlink(public_path('photos/activities/' . $activity->photo));
            }

            // Store the new photo
            $newPhotoName = time() . '_' . $request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(public_path('photos/activities'), $newPhotoName);

            // Update the package with the new photo path
            $activity->update(['photo' => $newPhotoName]);
        }

        return Redirect::route('dashboard')->with('success', 'Package updated successfully!');




    }
    public function delete($id)
    {
        $activity = Activity::findOrFail($id);

        if ($activity->photo && file_exists(public_path('photos/activities/' . $activity->photo))) {
            unlink(public_path('photos/activities/' . $activity->photo));
        }
        $activity->delete();

        return Redirect::route('dashboard')->with('success', 'Package deleted successfully!');

    }

}