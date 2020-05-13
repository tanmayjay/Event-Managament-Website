@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4><a href="/user">Users</a></h4>
        </div>
        <div class="card-body">
            <div class="row">
            @foreach($users as $user)
            <div class="col-md-3 pb-2 d-flex">
                <div class="container-fluid d-flex" style="border: 1px solid rgba(243, 238, 238, 0.849); background: rgba(197, 197, 197, 0.651)">
                    <img src="{{(empty($user->image)) ? '/image/dp.jpeg' : '/storage/'.$user->image}}" style="background-size: cover; height:65px; width:65px; padding:1px">
                    <div class="">
                        <a href="/user/{{$user->username}}" target="_blank" rel="noopener noreferrer" class="h5 pl-2" style="font-weight: bold;">{{$user->fname}} {{$user->lname}}</a>
                        <p class="card-menu pl-2" style="font-size: medium; background:none;">{{$user->usertype}}{{(auth()->user()->id == $user->id)?' (You)':''}}</p>
                    </div>
                </div>
            </div>
            @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
