@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @isset($message)
            <div class="alert alert-success" style="text-align: center">
                <h3>{{$message}}</h3>
            </div>
            @endisset
            @if(Auth::user()->booking->count() > 0)
            <div class="pb-3">
                <div class="card">
                    <div class="card-header h4">Your Booked Events <sup><span class="badge badge-success"> {{Auth::user()->booking->count()}}</span></sup></div>

                    <div class="card-body">
                        <div class="row">
                        @foreach ($bookings as $booking)
                            <div class="col-md-12 pt-1 pb-2 d-flex align-items-stretch">
                                <div class="card" style="width:100%">
                                    <div class="card-header d-flex justify-content-between">
                                        <a class="h5" href='/event/{{$events[$booking->id]->id}}'>{{ucfirst($events[$booking->id]->title)}}</a>
                                        <p>{{date("D, d M Y, h:m A",strtotime($booking->updated_at))}}</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="container">
                                            <div class="row align-items-baseline">
                                                <div class="col-md-8 d-flex justify-content-between">
                                                    <p class="card-menu">Total Bookings: <span class="sub-card-menu"> {{$booking->total_booking}}</span></p>
                                                    <p class="card-menu">Total Amount: <span class="sub-card-menu"> {{$booking->amount}}</span></p>
                                                    <p class="card-menu">Payment Status: <span class="sub-card-menu"> {{$booking->payment_status}}</span></p>
                                                </div>
                                                <div class="col-md-4">
                                                    @if($booking->payment_status == 'No' && $booking->transaction_id == "")
                                                    <form action="/booking/{{$booking->id}}" method="post" class="d-flex">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="text" name="tid" id="tid" class="form-control" placeholder="Enter Transaction ID" required>
                                                        <button type="submit" class="btn btn-warning btn-sm">Submit</button>
                                                    </form>
                                                    @elseif($booking->transaction_id != "")
                                                        <button class="btn btn-success btn-block" onclick="location.href='/booking/{{$booking->id}}/ticket'"
                                                        {{($booking->payment_status == 'No')?'Disabled':''}}>Download Ticket</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if(sizeof($recommended)>0)
            <div class="pb-3">
                <div class="card">
                    <div class="card-header h4">Recommended For You</div>

                    <div class="card-body">
                        <div class="row">
                            @foreach ($recommended as $event)
                                <div class="col-md-4 pt-1 pb-2 d-flex align-items-stretch">
                                    <div class="card" style="width:350px; height:300px;">
                                        <div class="card-header">
                                            <a class="h5" href='/event/{{$event->id}}'>{{ucfirst($event->title)}}</a>
                                        </div>
                                        <div class="card-body"
                                        style="background:url('{{(empty($event->cover_image))? '/image/events.jpg':'/storage/'.$event->cover_image}}');
                                        background-size:cover;">
                                            <div class="container">
                                                <p class="card-menu">{{$event->performer}}</p>
                                                <p class="card-menu pt-2">{{date('d-M-Y',  strtotime($event->start_date))}}</p>
                                                <p class="card-menu">@if($l = json_decode($event->location)){{$l[1]." ".$l[2]}}@endif</p>
                                                <p class="card-menu">#{{$event->type}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if(sizeof($eventsLike)>0)
            <div class="pb-3">
                <div class="card">
                    <div class="card-header h4">Events You May Like</div>

                    <div class="card-body">
                        <div class="row">
                            @foreach ($eventsLike as $event)
                                <div class="col-md-4 pt-1 pb-2 d-flex align-items-stretch">
                                    <div class="card" style="width:350px; height:300px;">
                                        <div class="card-header">
                                            <a class="h5" href='/event/{{$event->id}}'>{{ucfirst($event->title)}}</a>
                                        </div>
                                        <div class="card-body"
                                        style="background:url('{{(empty($event->cover_image))? '/image/events.jpg':'/storage/'.$event->cover_image}}');
                                        background-size:cover;">
                                            <div class="container">
                                                <p class="card-menu">{{$event->performer}}</p>
                                                <p class="card-menu pt-2">{{date('d-M-Y',  strtotime($event->start_date))}}</p>
                                                <p class="card-menu">@if($l = json_decode($event->location)){{$l[1]." ".$l[2]}}@endif</p>
                                                <p class="card-menu">#{{$event->type}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @auth
            @if(sizeof($eventsNear)>0)
            <div class="pb-3">
                <div class="card">
                    <div class="card-header h4">Events Near You</div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($eventsNear as $event)
                                <div class="col-md-4 pt-1 pb-2 d-flex align-items-stretch">
                                    <div class="card" style="width:350px; height:300px;">
                                        <div class="card-header">
                                            <a class="h5" href='/event/{{$event->id}}'>{{ucfirst($event->title)}}</a>
                                        </div>
                                        <div class="card-body"
                                        style="background:url('{{(empty($event->cover_image))? '/image/events.jpg':'/storage/'.$event->cover_image}}');
                                        background-size:cover;">
                                            <div class="container">
                                                <p class="card-menu">{{$event->performer}}</p>
                                                <p class="card-menu pt-2">{{date('d-M-Y',  strtotime($event->start_date))}}</p>
                                                <p class="card-menu">@if($l = json_decode($event->location)){{$l[1]." ".$l[2]}}@endif</p>
                                                <p class="card-menu">#{{$event->type}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @endauth
        </div>
    </div>
</div>
@endsection
