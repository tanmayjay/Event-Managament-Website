<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Event;
use App\User;

class BookingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function freeCapacity($event){
        $totalBooking = DB::table('event_user')
                            ->where('event_id',$event->id)
                                ->sum('total_booking');

        return $event->capacity - $totalBooking;
    }

    private function freeBooking($event, $limit){
        $booking = auth()->user()->booking()
                    ->where('event_id',$event->id)
                        ->sum('total_booking');
        return $limit - $booking;
    }

    public function create(Event $event){
        $freeCapacity = $this->freeCapacity($event);
        $freeBooking = $this->freeBooking($event, 5);
        $numTicket = 0;

        if($freeCapacity < $freeBooking){
            $freeBooking = $freeCapacity;
        }

        if($freeBooking>=1){
            return view ('bookings.create',compact('event','freeCapacity','freeBooking','numTicket'));
        }else{
            return redirect('/event/'.$event->id);
        }
    }

    public function calculate(Event $event){
        $unitPrice = $event->ticket_price;
        $numTicket = request('ticket');
        $price = $unitPrice*$numTicket;
        $vat = ($price*15)/100;
        $totPrice = $price+$vat;
        $showBtn = true;
        $freeCapacity = $this->freeCapacity($event);
        $freeBooking = $this->freeBooking($event, 5);

        if($freeCapacity < $freeBooking){
            $freeBooking = $freeCapacity;
        }

        if(($freeBooking>=1) && ($freeBooking>=$numTicket)){
            return view ('bookings.create',compact('event','price','vat','totPrice','numTicket','showBtn','freeCapacity','freeBooking'));
        }else{
            return redirect('/event/'.$event->id);
        }
    }

    public function store(Event $event){
        $message = 'Booking Unsuccessful';
        $data = array (
            'total_booking'=>request('total_booking'),
            'amount'=>request('amount'),
        );

        $freeCapacity = $this->freeCapacity($event);
        $freeBooking = $this->freeBooking($event, 5);

        if($freeCapacity < $freeBooking){
            $freeBooking = $freeCapacity;
        }

        if(($freeBooking >= 1) && ($freeBooking >= $data['total_booking'])){
            if(auth()->user()->booking->contains($event)){
                $notPaid = auth()->user()->booking()
                                ->where('event_id',$event->id)
                                ->where('payment_status','No')
                                    ->get();

                if(sizeof($notPaid)>0){
                    $totBooking = auth()->user()->booking()
                                    ->where('event_id',$event->id)
                                        ->first()->pivot->total_booking;

                    $amount = auth()->user()->booking()
                                ->where('event_id',$event->id)
                                    ->first()->pivot->amount;

                    $data['total_booking'] += $totBooking;
                    $data['amount'] += $amount;

                    DB::table('event_user')
                                ->where('user_id',auth()->user()->id)
                                ->where('event_id',$event->id)
                                ->where('payment_status','No')
                                    ->update($data);
                    //auth()->user()->booking()->updateExistingPivot($event->id, $data);
                    $message = 'Booking Successful';
                } else {
                    auth()->user()->booking()->attach($event->id,$data);
                    $message = 'Booking Successful';
                }
            }else{
                auth()->user()->booking()->attach($event->id,$data);
                $message = 'Booking Successful';
            }
            //return redirect('/event/'.$event->id)->with('message','Booking Successful');
            return redirect ('/home')->with('message','Booking Successful');

        }
        return redirect()->back()->with('message','Booking Unsuccessful');
    }

    public function index(){
        if(auth()->user()->usertype == 'Admin'){
            $bookings =DB::table('event_user')->orderBy('payment_status')->orderBy('updated_at','DESC')->get();
            $users = [];
            $events = [];
            foreach($bookings as $booking){
                $users[$booking->id] = User::findOrFail($booking->user_id);
                $events[$booking->id] = Event::findOrFail($booking->event_id);
            }

            return view('bookings.index',compact('bookings','users','events'));
        }
    }

    public function update($booking){
        if(auth()->user()->usertype == 'Admin' && request('pay')){
            DB::table('event_user')
                ->where('id',$booking)
                    ->update(['payment_status'=>'Yes']);
        }

        if(request('tid')){
            $b = DB::table('event_user')->where('id',$booking)->first();
            if($b->amount == 0){
                DB::table('event_user')
                    ->where('id',$booking)
                        ->update(['transaction_id'=>request('tid'),'payment_status'=>'Yes']);
            }else{
                DB::table('event_user')
                    ->where('id',$booking)
                        ->update(['transaction_id'=>request('tid')]);
            }
        }
        return redirect()->back();
    }

    public function payslip($booking){
        $bookingInfo = DB::table('event_user')->where('id',$booking)->first();
        if($bookingInfo->user_id == auth()->user()->id && $bookingInfo->payment_status == 'Yes'){
            $event = Event::findOrFail($bookingInfo->event_id);
            $user = auth()->user();
            return view('bookings.payslip',compact('bookingInfo','event','user'));
        }else {
            return abort(404, 'Not Found');
        }
    }
}
