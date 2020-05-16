<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        ###recommendation based on user's address (Events near you) and user's interest (Events you may like)
        $userAddr = json_decode(auth()->user()->address);
        $userInterest = json_decode(auth()->user()->interest);
        $events = auth()->user()->booking;

        $bookedEvents = [];
        foreach($events as $event){
            $bookedEvents[] = $event->id;
        }

        $bookings = DB::table('event_user')
                        ->whereIn('event_id',$bookedEvents)
                            ->where('user_id',auth()->user()->id)
                                ->orderBy('updated_at','DESC')
                                    ->get();

        foreach($bookings as $booking){
            $events[$booking->id] = Event::findOrFail($booking->event_id);
        }

        $eventsInCountry = Event::query()->where('location','like',"%{$userAddr[2]}%")->whereNotIn('id',$bookedEvents);
        $eventsInCity = Event::query()->where('location','like',"%{$userAddr[1]}%")->whereNotIn('id',$bookedEvents);

        $eventsNear = $eventsInCity
                        ->union($eventsInCountry)
                            ->inRandomOrder()
                                ->limit(9)
                                    ->get();

        $eventsNearBy = [];
        foreach($eventsNear as $eNear){
            $eventsNearBy[] = $eNear->id;
        }

        $eventsLike = Event::whereIn('type',$userInterest)
                        ->whereNotIn('id',$bookedEvents)
                        ->whereNotIn('id',$eventsNearBy)
                            ->inRandomOrder()
                                ->limit(9)
                                    ->get();



        ###Recommendation engine: user behavior based collaborative filtering

        //filtering all the users except the current user
        $users = User::where('id','!=',auth()->user()->id)->get();

        //finding similarity with other users
        //similarity = (numMatchedInterest / totalInterest)
        //if similarity more than or equal to 30% the user is denoted as friend user
        //also if there any common booking, the user is denoted as friend user
        $userFriends = [];
        foreach($users as $user){
            $matchedInterest = array_intersect($userInterest, json_decode($user->interest));
            $percentMatched = sizeof($matchedInterest) / sizeof($userInterest);
            $commonBooking = DB::table('event_user')->where('user_id',$user->id)->whereIn('event_id',$bookedEvents)->get();
            if($percentMatched >= 0.3 || sizeof($commonBooking) > 0){
                $userFriends[] = ['user_id' => $user->id ,'similarity'=> $percentMatched];
            }
        }

        //sorting friend users in terms of similarity in descending order so that more similar users get more priority
        for($i= 0; $i< sizeof($userFriends); ++$i){
            for($j= $i+1; $j< sizeof($userFriends); ++$j){
                if($userFriends[$i]['similarity'] < $userFriends[$j]['similarity']){
                    $temp = $userFriends[$i];
                    $userFriends[$i] = array_replace($userFriends[$j]);
                    $userFriends[$j] = array_replace($temp);
                }
            }
        }


        $recommended = [];
        $resultingArray = [];
        $filteredId = [];
        foreach($userFriends as $userFriend){
            //finding all the events booked by each friend user and not booked by current user
            $results = DB::table('event_user')->where('user_id',$userFriend['user_id'])->whereNotIn('event_id',$bookedEvents)->get();
            foreach($results as $result){
                $filteredEvent = Event::where('id',$result->event_id)->first();
                //removing the duplicate events if any
                if(!in_array($filteredEvent->id, $filteredId)){
                    $filteredId [] = $filteredEvent->id;
                    $totBooking = DB::table('event_user')
                                        ->where('event_id',$filteredEvent->id)
                                            ->sum('total_booking');
                    //determining the popularity of each event considering their total booking
                    $resultingArray[] = ['event'=>$filteredEvent, 'popularity'=>$totBooking];
                }
            }
        }

        //sorting the event array in terms of popularity in descending order so that popular events get more priority
        for($i= 0; $i< sizeof($resultingArray); ++$i){
            for($j= $i+1; $j< sizeof($resultingArray); ++$j){
                if($resultingArray[$i]['popularity'] < $resultingArray[$j]['popularity']){
                    $temp = $resultingArray[$i];
                    $resultingArray[$i] = array_replace($resultingArray[$j]);
                    $resultingArray[$j] = array_replace($temp);
                }
            }
            //storing the sorted event in recommended events
            $recommended [] = $resultingArray[$i]['event'];
        }

        return view('home',compact('bookings','events','eventsNear','eventsLike','recommended'));
    }
}
