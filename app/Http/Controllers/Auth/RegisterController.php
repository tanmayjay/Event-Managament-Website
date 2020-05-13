<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

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
    protected $redirectTo = '/home';

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
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'interest' => ['required'],
            'address' => ['required'],
            'gender' => ['required', 'string', 'max:10'],
            'dob' => ['required','date'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'image' => ['','image'],
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
        if(request('image')){
            $imagePath = request('image')->store('users', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(250,250);
            $image->save();
        }else{
            $imagePath = '';
        }

        return User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'username' => $data['username'],
            'interest' => json_encode(request('interest')),
            'address' => json_encode(request('address')),
            'gender' => $data['gender'],
            'dob' => $data['dob'],
            'email' => $data['email'],
            'image' => $imagePath,
            'password' => Hash::make($data['password']),
        ]);
    }
}
