<?php

namespace App\Http\Controllers;

use App\User;
use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(auth()->user()->usertype == 'Admin'){
            $users = User::orderBy('usertype')->get();
            return view('users.index',compact('users'));
        } else {
            return abort(404, 'Not Found');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        $user = User::where('username',$username)->firstOrFail();
        if(auth()->user()->id == $user->id || auth()->user()->usertype == 'Admin'){
            $booking = $user->booking()->sum('total_booking');
            $bookedEvents = $user->booking()->orderBy('id','DESC')->get();
            //dd(empty($bookedEvents));
            return view('users.show',compact('user','bookedEvents','booking'));
        }
        return abort(404, 'Not Found');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($username, $item)
    {
        $user = User::where('username',$username)->firstOrFail();
        if($user == auth()->user()){
            return view('users.edit',compact('user','item'));
        }
        return abort(404, 'Not Found');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, $item)
    {
        $pass = false;
        $data = [];

        if($item == 'profile'){
            $data = request()->validate([
                'fname' => ['required','string','max:255'],
                'lname' => ['required','string','max:255'],
                'email' => ['required','email','max:255'],
                'address' => ['required'],
            ]);
            $address = json_encode(request('address'));
            $data['address'] = $address;
        } elseif($item == 'photo') {
            $imagePath = request('image')->store('users', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(250,250);
            $image->save();
            $data['image'] = $imagePath;
        } elseif($item == 'password'){
            if($this->verify($user, request('cpassword'))){
                $data = request()->validate(['password' => ['required', 'string', 'min:8', 'confirmed']]);
                $data['password'] =  Hash::make($data['password']);
                $pass = true;
            }
        } elseif($item == 'type') {
            if(auth()->user()->usertype == 'Admin'){
                $user->update(['usertype'=>request('usertype')]);
                return redirect()->back();
            }else {
                return abort(404, 'Not Found');
            }
        } elseif($item == 'interest'){
            if(!empty(request('interest'))){
                $data = array('interest'=>json_encode(request('interest')));
            }else{
                return redirect()->back()->withErrors(['interest[]'=>'Interest is required'])->withInput();
            }
        }

        if(auth()->user() == $user){
            if(!empty($data)){
                $user->update($data);
                if(!$pass){
                    return redirect('/user/'.$user->username);
                } else {
                    return redirect('/logout');
                }
            } else {
                return redirect()->back()->withErrors(['cpassword'=>'Password incorrect'])->withInput();
            }
        }else {
            return abort(404, 'Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(auth()->user() == $user){
            if(request('password')){
                $password = request('password');
                if($this->verify($user, $password)){
                    User::destroy($user);
                    return redirect('/');
                } else {
                    return redirect()->back()->withErrors(['password'=>'Password Incorrect'])->withInput();
                }
            }
        }else {
            return abort(404, 'Not Found');
        }
    }

    private function verify(User $user, $password){
        $hasher = app('hash');
        if ($hasher->check($password, $user->password)) {
            return true;
        }
    }
}
