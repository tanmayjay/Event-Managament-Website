
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Book your ticket for <i><a class="" href='/event/{{$event->id}}'>{{ucfirst($event->title)}}</a></i></h3>
        </div>
        <div class="card-body" >
            <div class="container pt-2">
                <div class="row">

                    <div class="col-md-5 pl-5">
                        <p class="card-menu">Total Capacity: <span class="sub-card-menu">{{$event->capacity}}</span></p>
                        <p class="card-menu">Free Capacity: <span class="sub-card-menu">{{$freeCapacity}}</span></p>
                        <p class="card-menu">Unit Price: <span class="sub-card-menu">BDT {{$event->ticket_price}}</span></p>
                    </div>
                    <div class="col-md-7">
                        <form action="/booking/{{$event->id}}" method="get">
                        @csrf
                            <label class="card-menu" for="ticket">Number of Tickets ({{$freeBooking}} left): </label>
                            <select name="ticket" id="ticket" type="number" onchange = this.form.submit()>
                                <option value="" hidden>Select</option>
                                @for($i= 1; $i<= $freeBooking; ++$i)
                                <option value={{$i}} {{($numTicket == $i) ? 'selected':''}}>{{$i}}</option>
                                @endfor
                            </select>
                        </form>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="card-menu">Total Tickets: <span class="sub-card-menu">{{$numTicket ?? '0'}}</span></p>
                                <p class="card-menu">VAT (15%): <span class="sub-card-menu">BDT {{$vat ?? '0'}}</span></p>
                            </div>
                            <div class="col-md-6">
                                <p class="card-menu">Net Amount: <span class="sub-card-menu">BDT {{$price ?? '0'}}</span></p>
                                <p class="card-menu">Total Amount: <span class="sub-card-menu">BDT {{$totPrice ?? '0'}}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                @if(isset($showBtn))
                    <form action="/booking/{{$event->id}}" method="post">
                        @csrf
                        <input type="number" name="total_booking" id="total_booking" value={{$numTicket}} hidden>
                        <input type="number" name="amount" id="amount" value={{$totPrice}} hidden>
                        <button type="submit" class="btn btn-success booking-btn">Confirm Booking</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
