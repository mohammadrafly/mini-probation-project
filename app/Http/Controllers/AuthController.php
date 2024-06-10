<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'nip' => 'required|integer',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->route('login')
                    ->withErrors($validator)
                    ->withInput();
            }

            $credentials = $validator->validated();

            $user = User::where('nip', $credentials['nip'])->first();

            if (!$user) {
                return redirect()->route('login')->withErrors(['nip' => 'NIP does not exist.'])->withInput();
            }

            if (!Hash::check($credentials['password'], $user->password)) {
                return redirect()->route('login')->withErrors(['password' => 'Incorrect password.'])->withInput();
            }

            if (!Auth::attempt($credentials)) {
                return redirect()->route('login')->withErrors($validator)->withInput()->with('error', 'Gagal login.');
            }

            return redirect()->route('dashboard')->with('success', 'Berhasil login.');
        }

        return view('pages.auth.index', [
            'title' => 'Login Page'
        ]);
    }
}
