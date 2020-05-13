@extends('layouts.app')

@section('content')
<button onclick="window.print();return ftrue;" style="float: right;">Print</button>
<div class="container">
    <div class="card">
        <div class="card-body row" >
            <div class="d-flex justify-content-center col-md-5">
                <img src="/logo/icon-blue.png" alt="" style="width:120px; height:120px; margin-right:3px;">
                <div class="p-2">
                    <h1 style="color: rgb(45, 124, 129)">stallions</h4>
                    One Place, All Events<br/>
                    <div style="color: royalblue"><i>www.stallions.net</i></div>
                </div>
            </div>
            <div class="col-md-7">
                <p class="card-menu">Ticket ID: <span class="sub-card-menu">{{$bookingInfo->id.$event->id.$user->id.'-'.$bookingInfo->total_booking.'-'.$bookingInfo->transaction_id}}</span></p>
                <p class="card-menu">Purchase Date: <span class="sub-card-menu">{{date('d-M-Y h:m A',strtotime($bookingInfo->updated_at))}}</span></p>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Event Info
        </div>
        <div class="card-body" >
            <h1 style="color: slateblue">{{ucfirst($event->title)}}</h1>
            <div class="row">
                <div class="col-md-4">
                    <p class="card-menu">Type: <span class="sub-card-menu">{{$event->type}}</span></p>
                    <p class="card-menu">Performer: <span class="sub-card-menu">{{$event->performer}}</span></p>
                    <p class="card-menu">Organizer: <span class="sub-card-menu">{{$event->organizer}}</span></p>
                </div>
                <div class="col-md-8">
                    <p class="card-menu">Location: <span class="sub-card-menu">@if($loc=json_decode($event->location)){{$loc[0].', '.$loc[1].'- '.$loc[3].', '.$loc[2]}}@endif</span></p>
                    <p class="card-menu">Start Date: <span class="sub-card-menu">
                                    {{date('d-M-Y T+6 h:m A',  strtotime($event->start_date))}}</span></p>
                    <p class="card-menu">End Date: <span class="sub-card-menu">
                                        {{date('d-M-Y T+6 h:m A',  strtotime($event->end_date))}}</span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            User Info
        </div>
        <div class="card-body" >
            <div class="row">
                <div class="col-md-4">
                    <img src="/storage/{{$user->image}}" alt="">
                </div>
                <div class="col-md-8">
                    <h1 style="color: slateblue">{{ucfirst($user->fname)}} {{ucfirst($user->lname)}}</h1>

                    <p class="card-menu">Gender: <span class="sub-card-menu">{{$user->gender}}</span></p>
                    <p class="card-menu">Date of Birth: <span class="sub-card-menu">{{date('d M Y',strtotime($user->dob))}}</span></p>
                    <p class="card-menu">Email: <span class="sub-card-menu">{{$user->email}}</span></p>
                    @if($address = json_decode($user->address))
                        <p class="card-menu">Address: <span class="sub-card-menu">{{$address[0]. ', '.$address[1].'- '.$address[3].', '.$address[2]}}</span></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Booking Info
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <p class="card-menu">Total Bookings: <span class="sub-card-menu">{{$bookingInfo->total_booking}}</span></p>
                </div>
                <div class="col-md-4">
                    <p class="card-menu">Total Amount: <span class="sub-card-menu">BDT {{$bookingInfo->amount}}</span></p>
                </div>
                <div class="col-md-4">
                    <p class="card-menu">Payment Status: <span class="sub-card-menu">{{$bookingInfo->payment_status}}</span></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
