@extends('layouts.app')

@section('content')

<div class="container">
<div class="card">
        <div class="card-header">
            <a href="/event">Events<a>
                >
            <a href="/event/type/all">All<a>
                >
            <a href="/event/type/{{$event->type}}">{{ucfirst($event->type)}}<a>
        </div>
        @isset($message)
        <div class="alert alert-danger justify-content-center">
            <h3>{{$message}}</h3>
        </div>
        @endisset
    </div>
                <div class="card">
                    <div class="card-header">
                        <h3><a class="" href='/event/{{$event->id}}'>{{ucfirst($event->title)}}</a></h3>
                    </div>
                    <div class="card-body" >
                        <div class="d-flex">
                            <img src="{{(empty($event->cover_image))? '/image/events.jpg':'/storage/'.$event->cover_image}}" style="width:50%;">

                            <div class="pl-3 h3">
                                {{$event->description}}
                            </div>
                        </div>
                        <div class="container-fluid pt-5">
                            <div class="row">
                                <div class="col-md-3">
                                    <p class="card-menu">Type: <span class="sub-card-menu">{{$event->type}}</span></p>
                                    <p class="card-menu">Performer: <span class="sub-card-menu">{{$event->performer}}</span></p>
                                    <p class="card-menu">Organizer: <span class="sub-card-menu">{{$event->organizer}}</span></p>
                                    <p class="card-menu">Ticket Price: <span class="sub-card-menu">BDT {{$event->ticket_price}}</span></p>
                                    <p class="card-menu">Phone: <span class="sub-card-menu">{{$event->phone}}</span></p>

                                </div>
                                <div class="col-md-6">
                                    <p class="card-menu">Location: <span class="sub-card-menu">{{$location[0].', '.$location[1].'- '.$location[3].', '.$location[2]}} </span></p>
                                    <p class="card-menu">Start Date: <span class="sub-card-menu">
                                        {{date('d-M-Y T+6 h:m A',  strtotime($event->start_date))}}</span></p>
                                    <p class="card-menu">End Date: <span class="sub-card-menu">
                                        {{date('d-M-Y T+6 h:m A',  strtotime($event->end_date))}}</span></p>
                                    <p class="card-menu">Email: <span class="sub-card-menu">{{$event->email}}</span></p>
                                    <p class="card-menu">Website:
                                        <a href="http://{{$event->website}}" target="_blank" rel="noopener noreferrer"><i>{{$event->website}}</i></a></p>
                                </div>
                                <div class="col-md-3">
                                @if(! $bookLimit)
                                    <a class="btn btn-success" href="{{($logged) ? '/booking/'.$event->id.'/create' : '/login'}}" target="_blank" rel="noopener noreferrer">Book Your Ticket Now</a>
                                @endif
                                </div>

                            </div>
                        </div>
                    </div>
                    @auth
                    @if(auth()->user()->usertype == 'Admin')
                    <div class="d-flex justify-content-between p-4">
                        <form action="/event/{{$event->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger">Delete</button>
                        </form>
                        <button class="btn btn-outline-secondary" onClick="location.href='/event/{{$event->id}}/edit'">Edit</button>
                    </div>
                    @endif
                    @endauth
            </div>
</div>
@endsection
