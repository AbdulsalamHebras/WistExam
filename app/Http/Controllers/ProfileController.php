<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Step 1: Validate the incoming request, including the photo if applicable.
$validatedData = $request->validated();

// Step 2: Handle the photo upload if a new one is provided.
if ($request->hasFile('photo')) {
    $photo = $request->file('photo');

    // Generate a unique name for the photo.
    $photoName = time() . '_' . $photo->getClientOriginalName();

    // Move the new photo to the public folder.
    $photo->move(public_path('photos'), $photoName);

    // Store the photo path in the validated data array.
    $validatedData['photo'] = 'photos/' . $photoName;

    // Delete the old photo if it exists.
    $oldPhoto = $request->user()->photo;
    if ($oldPhoto && file_exists(public_path($oldPhoto))) {
        unlink(public_path($oldPhoto));
    }
}

// Step 3: Fill the user's data with the validated data.
$request->user()->fill($validatedData);

// Step 4: Invalidate the email verification if the email has changed.
if ($request->user()->isDirty('email')) {
    $request->user()->email_verified_at = null;
}

// Step 5: Save the updated user data.
$request->user()->save();


        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}