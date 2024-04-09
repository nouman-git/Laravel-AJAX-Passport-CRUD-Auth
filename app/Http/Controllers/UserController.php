<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Laravel\Passport\Passport;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token;



class UserController extends Controller
{
    //

    public function loginPage()
    {
        return view('login.login');
    }

    // public function login(Request $request)
    // {
    //     // Get the email and password from the request
    //     $email = $request->input('email');
    //     $password = $request->input('pswd');

    //     // Find the user by email
    //     $user = User::where('email', $email)->first();

    //     // Check if the user exists and if the password matches
    //     if ($user && Hash::check($password, $user->password)) {
    //         // Issue a new access token for the user
    //         $token = $user->createToken('my_auth')->accessToken;
    //         // dd($token);

    //         // dd($user);

    //         return response()->json(['message' => 'Login successful', 'user' => $user, 'access_token' => $token], 200);
    //     } else {
    //         // Authentication failed
    //         return response()->json(['message' => 'Invalid credentials'], 401);
    //     }
    // }



public function login(Request $request)
{


    // Attempt to authenticate the user using the 'web' guard
    if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->pswd])) {
        // Authentication succeeded

        // Get the authenticated user
        $user = Auth::guard('web')->user();

        // Issue a new access token for the user
        // $token = $user->createToken('my_auth')->accessToken;

        return response()->json(['message' => 'Login successful', 'user' => $user], 200);
    } else {
        // Authentication failed
        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}






public function register(Request $request)
{
    // Validate the request data
    $this->validate($request, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users|max:255',
        'password' => 'required|string',
    ]);

    // Create a new user
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Authenticate the user using the 'web' guard
    Auth::guard('web')->login($user);

    return response()->json(['message' => 'Registration successful', 'user' => $user], 200);
}


public function logout()
{
        // dd(auth()->user());

    // Check if the user is authenticated
    if (Auth::guard('web')->check()) {
        // dd(Auth::guard('web')->check());
        // Perform the user logout using the 'web' guard
        auth()->guard('web')->logout();
    }
    return redirect('/loginpage');
}



}


