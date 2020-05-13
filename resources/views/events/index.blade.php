@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-baseline">
                <div><a href="/event">Events</a></div>
                @if($logged = auth()->user())
                    @if($logged['usertype'] == 'Admin')
                        <div><button onClick="location.href='/event/create'" class="btn btn-danger">Create Event</a></div>
                    @endif
                @endif
            </div>
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col-md-3 pb-1">
                    <button onClick="location.href='/event/type/entertainment'" class="button-abs"
                    style="background: url('../image/entertainment.jpg') no-repeat scroll 0 0 transparent; background-size: cover;">Entertainment</button>
                </div>
                <div class="col-md-3 pb-1">
                    <button onClick="location.href='/event/type/education'" class="button-abs"
                    style="background: url('../image/education.jpg') no-repeat scroll 0 0 transparent; background-size: cover;">Education</button>
                </div>
                <div class="col-md-3 pb-1">
                    <button onClick="location.href='/event/type/science'" class="button-abs"
                    style="background: url('../image/science.jpg') no-repeat scroll 0 0 transparent; background-size: cover;">Science</button>
                </div>
                <div class="col-md-3 pb-1">
                    <button onClick="location.href='/event/type/technology'" class="button-abs"
                    style="background: url('../image/Technology.jpg') no-repeat scroll 0 0 transparent; background-size: cover;">Technology</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 pb-1">
                    <button onClick="location.href='/event/type/healthcare'" class="button-abs"
                    style="background: url('../image/healthcare.jpg') no-repeat scroll 0 0 transparent; background-size: cover;">Healthcare</button>
                </div>
                <div class="col-md-3 pb-1">
                    <button onClick="location.href='/event/type/marketing'" class="button-abs"
                    style="background: url('../image/marketing.jpg') no-repeat scroll 0 0 transparent; background-size: cover;">Marketing</button>
                </div>
                <div class="col-md-3 pb-1">
                    <button onClick="location.href='/event/type/business'" class="button-abs"
                    style="background: url('../image/business.jpg') no-repeat scroll 0 0 transparent; background-size: cover;">Business</button>
                </div>
                <div class="col-md-3 pb-1">
                    <button onClick="location.href='/event/type/entrepreneurship'" class="button-abs"
                    style="background: url('../image/entrepreneurship.jpg') no-repeat scroll 0 0 transparent; background-size: cover;">Entrepreneurship</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 pb-1">
                    <button onClick="location.href='/event/type/social'" class="button-abs"
                    style="background: url('../image/social.jpg') no-repeat scroll 0 0 transparent; background-size: cover;">Social</button>
                </div>
                <div class="col-md-3 pb-1">
                    <button onClick="location.href='/event/type/religious'" class="button-abs"
                    style="background: url('../image/religious.jpg') no-repeat scroll 0 0 transparent; background-size: cover;">Religious</button>
                </div>
                <div class="col-md-3 pb-1">
                    <button onClick="location.href='/event/type/others'" class="button-abs"
                    style="background: url('../image/others.jpg') no-repeat scroll 0 0 transparent; background-size: cover;">Others</button>
                </div>
                <div class="col-md-3 pb-1">
                    <button onClick="location.href='/event/type/all'" class="button-abs"
                    style="background: url('../image/all.jpg') no-repeat scroll 0 0 transparent; background-size: cover;">All</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
