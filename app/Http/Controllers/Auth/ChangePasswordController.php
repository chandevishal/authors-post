<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class ChangePasswordController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display change password view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.passwords.change');
    }

    /**
     * Change users password
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|password',
            'new-password' => 'required|same:new-password|min:8',
            'new-password-confirmation' => 'required|same:new-password',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        // Retrieve the validated input...
        $validated = $validator->validated();

        $userId = Auth::User()->id;
        $user = User::find($userId);
        $user->password = Hash::make($validated['new-password']);;
        $user->save();
        return redirect('posts')->with('status', 'Your password has been updated successfully.');
    }
}
