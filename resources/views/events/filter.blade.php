@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <a href="/event">Events<a>
            @if($type != 'search')
                >
            <a href="/event/{{$type}}">{{ucfirst($type)}}<a>
            @endif
        </div>
    </div>
    <div class="row">
             @foreach($events as $event)
            <div class="col-md-4 pt-3 d-flex align-items-stretch">
                <div class="card">
                    <div class="card-header">
                        <a class="h3" href='/event/{{$event->id}}'>{{ucfirst($event->title)}}</a>
                    </div>
                    <div class="card-body"
                    style="background:url('{{(empty($event->cover_image))? '/image/events.jpg':'/storage/'.$event->cover_image}}'); background-size:cover; width:345px; height:200px;">
                        <div class="container">
                            <p class="card-menu">{{$event->performer}}</p>
                            <p class="card-menu pt-2">{{date('d-M-Y',  strtotime($event->start_date))}}</p>
                            <p class="card-menu">@if($l = json_decode($event->location)){{$l[1]." ".$l[2]}}@endif</p>
                            <p class="card-menu">#{{$event->type}}</p>
                        </div>
                    </div>

                    @auth
                    @if(auth()->user()->usertype == 'Admin')
                    <div class="d-flex justify-content-between p-3">
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
             @endforeach
    </div>
</div>
@endsection
