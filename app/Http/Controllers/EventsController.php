<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EventsController extends Controller
{
    public function index(){
        return view('events.index');
    }

    public function create(){
        if(auth()->check()){
            if(auth()->user()['usertype']=='Admin'){
                return view('events.create');
            }
        }
        return abort(404, 'Not Found');
    }

    public function store(){
        if(auth()->check()){
            if(auth()->user()['usertype'] == "Admin"){
                $data = request()->validate([
                    'title' => ['required', 'string', 'max:255'],
                    'location' => 'required',
                    'type' => ['required', 'string', 'max:255'],
                    'organizer' => ['required', 'string', 'max:255'],
                    'performer' => ['required', 'string', 'max:255'],
                    'capacity' => ['required', 'numeric'],
                    'ticket_price' => '',
                    'start_date' => ['required', 'string', 'max:255'],
                    'end_date' => ['required', 'string', 'max:255'],
                    'description' => '',
                    'email' => '',
                    'phone' => '',
                    'website' => '',
                    'cover_image' => ['','image'],
                    'another' => '',
                ]);

                if(!empty(request('cover_image'))){
                    $imagePath = request('cover_image')->store('uploads', 'public');
                    $data['cover_image'] = $imagePath;
                }

                $data['location'] = json_encode(request('location'));

                auth()->user()->creates()->create($data);
                return redirect('/event');
            }
        }

        return abort(404, 'Not Found');
    }

    public function filter($type){
        if($type == 'all'){
            $events = Event::orderBy('start_date')->get();
        } else if($type == 'search'){
            if(request('search') != ""){
                $key = request('search');
                $events = Event::where('title','like',"%{$key}%")
                                ->orWhere('location','like',"%{$key}%")
                                ->orWhere('type','like',"%{$key}%")
                                    ->orderBy('start_date')
                                        ->get();
            } else {
                return abort(404, 'Not Found');
            }
        } else {
            $events = Event::where('type',$type)->orderBy('start_date')->get();
        }
        //$events = DB::table('events')->where('type',$type)->get();
        //dd($events);
        return view('events.filter',['events'=>$events,'type'=>$type]);
    }

    public function destroy(Event $event){
        if(auth()->check()){
            if(auth()->user()['usertype'] == "Admin"){
                DB::table('events')->where('id',$event->id)->delete();
                //Event::destroy($event);
                return redirect('/event/type/all');
            }
        }
        return abort(404, 'Not Found');
    }

    public function edit(Event $event){
        if(auth()->check()){
            if(auth()->user()['usertype'] == "Admin"){

                $place = json_decode($event->location);

                return view('events.edit',compact('event','place'));
            }
        }
        return abort(404, 'Not Found');
    }

    public function update(Event $event){
        if(auth()->check()){
            if(auth()->user()['usertype'] == "Admin"){
                $data = request()->validate([
                    'title' => ['required', 'string', 'max:255'],
                    'location' => 'required',
                    'type' => ['required', 'string', 'max:255'],
                    'organizer' => ['required', 'string', 'max:255'],
                    'start_date' => ['required', 'string', 'max:255'],
                    'end_date' => ['required', 'string', 'max:255'],
                    'description' => '',
                    'email' => '',
                    'phone' => '',
                    'website' => '',
                    'another' => '',
                ]);

                $data['location'] = json_encode(request('location'));

                $event->update($data);
                return redirect('/event/'.$event->id);
            }
        }
        return abort(404, 'Not Found');
    }

    public function show(Event $event){
        if(auth()->check()){
            $logged = true;
            if(auth()->user()->booking->contains($event)){
                $booking = DB::table('event_user')->where('user_id',auth()->user()->id)->where('event_id',$event->id)->sum('total_booking');
                if($booking >= 5){
                    $bookLimit = true;
                }else{
                    $bookLimit = false;
                }
            } else {
                $bookLimit = false;
            }
        } else {
            $bookLimit = false;
            $logged =false;
        }
        $location =  json_decode($event->location);
        return view('events.show',compact('event','bookLimit','logged','location'));
    }
}
