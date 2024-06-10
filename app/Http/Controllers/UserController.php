<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.user.index', [
            'data' => User::all(),
            'title' => 'User Management'
        ]);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'nip' => 'required|string|unique:users|max:255',
                'password' => 'required|string|max:255|confirmed',
                'role' => 'required|in:admin,sales',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            try {
                User::create($validator->validated());

                return redirect()->route('user.index')->with('success', 'Success! New User has been created.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Oops! Failed to create new User.');
            }
        }

        return view('pages.dashboard.user.create', [
            'title' => 'Create User'
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('user.index')->with('error', 'Oops! The User you are trying to update does not exist.');
        }

        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'nip' => 'required|string|unique:users,nip,'.$user->id,
                'password' => 'string|max:255|confirmed',
                'role' => 'required|in:admin,sales',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            try {
                $user->update($validator->validated());

                return redirect()->route('user.index')->with('success', 'Success! User has been updated.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Oops! Failed to update User.');
            }
        }

        return view('pages.dashboard.user.update', [
            'title' => 'Update User',
            'user' => $user,
        ]);
    }

    public function delete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('user.index')->with('error', 'Oops! The User you are trying to delete does not exist.');
        }

        if (!$user->delete()) {
            return redirect()->route('user.index')->with('error', 'Oops! Failed to delete User.');
        }

        return redirect()->route('user.index')->with('success', 'Success! User has been deleted.');
    }
}
