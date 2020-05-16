@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between aligh-items-baseline">
        <a class="h3" href="/user/{{$user->username}}">{{$user->fname}} {{$user->lname}}</a>
            @if ((auth()->user()->id == $user->id))
            <div><button onclick="location.href='/user/{{$user->username}}/edit/{{'profile'}}'" class="btn btn-outline-primary btn-sm">Edit Profile</button></div>
            @elseif (auth()->user()->usertype == 'Admin')
            <form action="/user/{{$user->id}}/type" method="post">
                @csrf
                @method("PATCH")
                @if($type = ($user->usertype == 'Client') ? 'Admin' : 'Client')
                <input type="text" name="usertype" id="usertype" value="{{$type}}" style="display: none;">
                <div><button class="btn btn-success" type="submit">Make {{$type}}</button></div>
                @endif
            </form>
            @endif
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <div class="container" style="background:url({{(empty($user->image)) ? '/image/dp.jpeg' : '/storage/'.$user->image}}); background-size: cover; height:250px; weight:250px;"></div>

                    @if ((auth()->user()->id == $user->id))
                    <div class="pt-1 pb-4">
                        <button class="btn btn-outline-secondary btn-sm btn-block" onclick="location.href='/user/{{$user->username}}/edit/{{'photo'}}'">Change Photo</button>
                    </div>
                    <div class="container p-2">
                        <div class="pb-3"><button onClick="location.href='/user/{{$user->username}}/edit/password'" class="btn btn-dark btn-sm">Change Password</button></div>
                        <div class="pb-3">
                            <button id="delete" class="btn btn-danger btn-sm" onclick="confirmDelete()">Delete Account</button>

                            <form action="/user/{{$user->id}}" method="post">
                                @csrf
                                @method('DELETE')
                                <input id="pass" type="password" name="password" hidden required placeholder="Enter your password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <button id="confirm" type="submit" class="btn btn-danger btn-sm" hidden>Confirm</button>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-md-4">
                    @if ((auth()->user()->id == $user->id) || (auth()->user()->usertype == 'Admin'))
                        <p class="card-menu">Username: <span class="sub-card-menu">{{$user->username}}</span></p>
                        <p class="card-menu">Type: <span class="sub-card-menu">{{$user->usertype}}</span></p>
                        <p class="card-menu">Email: <span class="sub-card-menu">{{$user->email}}</span></p>
                        <p class="card-menu">Gender: <span class="sub-card-menu">{{$user->gender}}</span></p>
                        <p class="card-menu">Date of Birth: <span class="sub-card-menu">{{date('d M Y',strtotime($user->dob))}}</span></p>
                        @if($address = json_decode($user->address))
                        <p class="card-menu">Address: <span class="sub-card-menu">{{$address[0]}}</span></p>
                        <p class="card-menu">City: <span class="sub-card-menu">{{$address[1]}}</span></p>
                        <p class="card-menu">Zip Code: <span class="sub-card-menu">{{$address[3]}}</span></p>
                        <p class="card-menu">Country: <span class="sub-card-menu">{{$address[2]}}</span></p>
                        @endif
                    @endif
                    <p class="card-menu">Interests:
                        <span class="sub-card-menu">
                            @foreach(json_decode($user->interest) as $interest)
                            <a class="card-link" href="/event/type/{{$interest}}" target="_blank" rel="noopener noreferrer">{{$interest." "}}</a>
                            @endforeach
                            @if (auth()->user()->id == $user->id)
                            <button onclick="location.href='/user/{{$user->username}}/edit/interest'" class="card-link btn btn-outline-danger btn-sm">+ / -</button>
                            @endif
                        </span>
                    </p>
                </div>
                <div class="col-md-5">
                    <p class="card-menu">Total Events: <span class="sub-card-menu">{{$user->booking->count()}}</span></p>
                    <p class="card-menu">Total Bookings: <span class="sub-card-menu">{{$booking}}</span></p>
                    @if(sizeof($bookedEvents)>0)
                    <p class="card-menu">Recently Booked:
                    @foreach ($bookedEvents as $bEvent)
                    <span class="sub-card-menu"><br/>#<a class="card-link" style="padding-left:30px;" href="/event/{{$bEvent->id}}" target="_blank" rel="noopener noreferrer">
                        <i>{{$bEvent->title}}<i>
                        </a></span>
                    @endforeach
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    function confirmDelete(){
        if(confirm('Are you sure you want to delete your account?')){
            const deleteButton = document.getElementById("delete")
            const confirmButton = document.getElementById("confirm")
            const passInput = document.getElementById("pass")

            deleteButton.hidden = true
            passInput.hidden = false
            confirmButton.hidden = false
        }
    }
</script>
@endsection

