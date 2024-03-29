<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function register(Request $request){
        $validate = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'password' => 'required|required_with:confirm_password',
            'email' => 'required|email|unique:users',]);
         
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'last_name' => $request->lastname,
            'first_name' => $request->firstname,
        ]);
return redirect()->route('login')->with('success', 'Register Successfully');
    }


    public function login(Request $request){

        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->put('username', $request->email);
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login')->with('error', 'Invaild Email and Password');
        }
    }
    
        public function logout(){
            Session::flush();
            Auth::logout();
    
            return redirect()->route('login');
        }

    public function loginWithGoogle()
    {
         $gUser = Socialite::driver('google')->stateless()->user();
        $user = User::where('email', $gUser->getEmail())->first();
        if ($user) {
            Auth::loginUsingId($user->id, True);
            return redirect()->route('dashboard');
        }
        else {
            return "Authorized access";
        }
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();

    }
    
    public function user(Request $request) {
        return response()->json($request->user());
    }
    
}

