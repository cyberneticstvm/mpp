<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles = Profile::where('user_id', Auth::id())->latest()->get();
        return view('backend.doctor.profile.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.doctor.profile.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        Profile::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'consultation_fee' => $request->consultation_fee,
        ]);
        return redirect()->route('user.profile')->with("success", "Profile created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $profile = Profile::findOrFail(decrypt($id));
        return view('backend.doctor.profile.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        Profile::findOrFail($id)->update([
            'name' => $request->name,
            'designation' => $request->designation,
            'consultation_fee' => $request->consultation_fee,
        ]);
        return redirect()->route('user.profile')->with("success", "Profile updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Profile::findOrFail(decrypt($id))->delete();
        return redirect()->route('user.profile')->with("success", "Profile deleted successfully");
    }
}
