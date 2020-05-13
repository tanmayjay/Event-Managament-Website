@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <a href="/booking">Bookings<a>
        </div>
    </div>
    @foreach($bookings as $booking)
            <div class="pt-3">
                <div class="card">
                <div class="card-header">{{date("D, d M Y - h:m A",strtotime($booking->updated_at))}}</div>
                    <div class="card-body">
                        <h3>
                        <a href="/user/{{$users[$booking->id]->username}}" target="_blank" rel="noopener noreferrer">
                            {{$users[$booking->id]->fname}} {{$users[$booking->id]->lname}}</a> booked for
                        <a href="/event/{{$booking->event_id}}" target="_blank" rel="noopener noreferrer">
                            {{$events[$booking->id]->title}}</a>
                        </h3>
                        <div class="d-flex justify-content-between">
                            <div class="">
                                <p class="card-menu">Tickets: <span class="sub-card-menu">{{$booking->total_booking}}</span> | Amount: <span class="sub-card-menu">{{$booking->amount}}</span> | Payment Status: <span class="sub-card-menu">{{$booking->payment_status}}</span></p>
                            </div>
                            @if($booking->payment_status == 'No' && $booking->transaction_id != "")
                            <div class="d-flex">
                                <form action="/booking/{{$booking->id}}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <input type="checkbox" name="pay" id="pay" value="{{$booking->id}}" style="height: 18px; width:18px;" onchange="this.form.submit()">
                                <span class="sub-card-menu" style="color: rgb(219, 83, 83);"> Mark Paid</span>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
             @endforeach
</div>
@endsection
