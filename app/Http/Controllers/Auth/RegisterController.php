<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'bail|required|string|max:255',
            'email' => 'bail|required|string|email|max:255|unique:users',
            'password' => 'bail|required|string|min:6|confirmed',
            'mobile' => 'required',
            'address' => 'required',
            'city' => 'required',
            'pin' => 'bail|required|numeric',
            'state' => 'required',
            'shop' => 'required',
            'franchise' => 'required',
            'business' => 'required',

            'pan_number' => 'required',
            'adhar_number' => 'required',

            'adhar_card' => 'bail|required|file|mimes:pdf',
            'pan_card' => 'bail|required|file|mimes:pdf',
            'photograph' => 'bail|required|file|image|max:4096',
            'signature' => 'bail|required|file|image|max:4096',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'vendor_id' => $this->makeVendorId(),
            'password' => bcrypt($data['password']),

            'pin' => $data["pin"],
            'mobile' => $data["mobile"],

            'address' => $data["address"],
            'city' => $data["city"],
            'state' => $data["state"],

            'shop' => $data["business"],
            'landline' => $data["landline"],
            'franchise' => $data["franchise"],
            'business' => $data["business"],

            'pan_number' => $data["pan_number"],
            'adhar_number' => $data["adhar_number"],
            // uploads
            'adhar_card' => Storage::putFile('images', $data["adhar_card"]),
            'pan_card' => Storage::putFile('images', $data["pan_card"]),
            'photograph' => Storage::putFile('images', $data["photograph"]),
            'signature' => Storage::putFile('images', $data["signature"]),

            'status' => 2,
        ]);
    }

    /**
     * @return string
     */
    protected function makeVendorId()
    {
        $id = DB::table('users')->max('id') + 1;
        return env("VENDOR_ID_PREFIX") . $id;
    }

    protected function registered(Request $request, $user)
    {
        auth()->guard()->logout();
        return view('auth.register', ["registration" => "success"]);
    }
}
