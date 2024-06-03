<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function step1()
    {
        return view('auth.register');
    }

    public function postStep1(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $request->session()->put('step1_data', $request->only('email', 'password'));

        return redirect()->route('second-register');
    }

    public function step2(Request $request)
    {
        $oldData = $request->session()->get('step1_data', []);

        return view('auth.second-register', ['oldData' => $oldData]);
    }

    public function postStep2(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        $step1Data = $request->session()->get('step1_data');
        $userData = array_merge($step1Data, $request->only('name', 'surname'));

        $request->session()->put('step2_data', $userData);

        return redirect()->route('third-register');
    }

    public function step3()
    {
        return view('auth.third-register');
    }

    public function postStep3(Request $request)
    {
        $request->validate([
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'biography' => 'nullable|string',
        ]);

        $step1Data = $request->session()->get('step1_data', []);
        $step2Data = $request->session()->get('step2_data', []);

        $userData = array_merge($step1Data, $step2Data, $request->only('address', 'phone', 'biography'));

        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public');
            $userData['profile_photo_path'] = $profilePhotoPath;
        }

        $user = User::create([
            'name' => $userData['name'],
            'surname' => $userData['surname'],
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
            'address' => $userData['address'],
            'phone' => $userData['phone'],
            'biography' => $userData['biography'],
            'profile_photo_path' => $userData['profile_photo_path'] ?? null,
        ]);

        $request->session()->forget(['step1_data', 'step2_data']);

        return redirect()->route('login')->with('status', 'Registration successful! You can now login');
    }

}
