<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function allData()
    {
        return view('profile', ['id' => Auth::user()->id, 'name' => Auth::user()->name, 'email' => Auth::user()->email]);
    }

    public function getEdit()
    {
        return view('edit');
    }

    public function postEdit(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => ['string'],
            'password' => [''],
            'avatar' => ['image', 'max:2048']
        ]);

        if ($request->hasFile('avatar')) {
            $avatar = $user->avatar;
            $avatar_path = substr($avatar, 1);
            try {
                unlink($avatar_path);
            } catch (\Exception) {
            }
            $image_name = 'id-' . $user->id . '_' . time() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('users'), $image_name);
            $path = "/users/" . $image_name;
        } else {
            $path = $user->avatar;
        }

        Auth::user()->update([
            'name' => $request->input('name'),
            'password' => $request->input('password')
        ]);

        $user->avatar = $path;
        $user->save();

        return redirect()->route('profile');
    }
}
