@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if ($item == 'profile')
                <div class="card-header">{{ __('Update Information') }}</div>
                <div class="card-body">
                    <form method="POST" action="/user/{{$user->id}}/{{$item}}">
                    @csrf
                    @method('PATCH')

                    <div class="form-group row">
                        <label for="fname" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                        <div class="col-md-6">
                            <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror"
                            name="fname" value="{{ $user->fname }}" required autocomplete="fname" autofocus>

                            @error('fname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="lname" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                        <div class="col-md-6">
                            <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror"
                            name="lname" value="{{ $user->lname }}" required autocomplete="lname" autofocus>

                            @error('lname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ $user->email }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address[]" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                        <div class="col-md-6">
                            <input id="address[]" type="text" class="form-control @error('address[]') is-invalid @enderror"
                            name="address[]" value="{{ (json_decode($user->address))[0] }}" rautocomplete="address[]" autofocus placeholder="House, Street, Area">

                            @error('address[]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <input id="address[]" type="text" class="form-control @error('address[]') is-invalid @enderror"
                            name="address[]" value="{{ (json_decode($user->address))[1] }}" rautocomplete="address[]" autofocus required placeholder="City, Region">

                            @error('address[]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <input id="address[]" type="text" class="form-control @error('address[]') is-invalid @enderror"
                            name="address[]" value="{{ (json_decode($user->address))[2] }}" rautocomplete="address[]" autofocus required placeholder="Country">

                            @error('address[]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <input id="address[]" type="text" class="form-control @error('address[]') is-invalid @enderror"
                            name="address[]" value="{{ (json_decode($user->address))[3] }}" rautocomplete="address[]" autofocus required placeholder="Zip Code">

                            @error('address[]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-secondary btn-block">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
                @endif

                @if ($item == 'photo')
                <div class="card-header">{{ __('Update Photo') }}</div>
                <div class="card-body">
                    <form method="POST" action="/user/{{$user->id}}/{{$item}}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="form-group row">
                        <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                        <div class="col-md-6">
                            <input id="image" type="file" class="form-control @error('image') is-invalid @enderror"
                            name="image" autocomplete="image">

                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-secondary btn-block">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </div>
                    </form>
                </div>

                @endif

                @if ($item == 'password')
                <div class="card-header">{{ __('Update Photo') }}</div>
                <div class="card-body">
                <form method="POST" action="/user/{{$user->id}}/{{$item}}">
                    @csrf
                    @method('PATCH')

                    <div class="form-group row">
                        <label for="cpassword" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

                        <div class="col-md-6">
                            <input id="cpassword" type="password" class="form-control @error('cpassword') is-invalid @enderror"
                            name="cpassword" required autocomplete="new-password">

                            @error('cpassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm New Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control"
                            name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-secondary btn-block">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </div>
                </form>
                </div>
                @endif

                @if ($item == 'interest')
                <div class="card-header">{{ __('Update Interest') }}</div>
                <div class="card-body">
                <form method="POST" action="/user/{{$user->id}}/{{$item}}">
                    @csrf
                    @method('PATCH')


                    <div class="form-group row">
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-3"><input id="interest" type="checkbox" class="form-control @error('interest') is-invalid @enderror"
                                    name="interest[]" value="Entertainment" @foreach(json_decode($user->interest) as $in){{($in=='Entertainment')?'checked':''}}@endforeach autocomplete="interest"></div>
                                <div class="col-md-9"><div class="card-menu">Entertainment</div></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3"><input id="interest" type="checkbox" class="form-control @error('interest') is-invalid @enderror"
                                    name="interest[]" value="Education" @foreach(json_decode($user->interest) as $in){{($in=='Education')?'checked':''}}@endforeach autocomplete="interest"></div>
                                <div class="col-md-9"><div class="card-menu">Education</div></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3"><input id="interest" type="checkbox" class="form-control @error('interest') is-invalid @enderror"
                                    name="interest[]" value="Science" @foreach(json_decode($user->interest) as $in){{($in=='Science')?'checked':''}}@endforeach autocomplete="interest"></div>
                                <div class="col-md-9"><div class="card-menu">Science</div></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3"><input id="interest" type="checkbox" class="form-control @error('interest') is-invalid @enderror"
                                    name="interest[]" value="Technology" @foreach(json_decode($user->interest) as $in){{($in=='Technology')?'checked':''}}@endforeach autocomplete="interest"></div>
                                <div class="col-md-9"><div class="card-menu">Technology</div></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3"><input id="interest" type="checkbox" class="form-control @error('interest') is-invalid @enderror"
                                    name="interest[]" value="Healthcare" @foreach(json_decode($user->interest) as $in){{($in=='Healthcare')?'checked':''}}@endforeach autocomplete="interest"></div>
                                <div class="col-md-9"><div class="card-menu">Healthcare</div></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3"><input id="interest" type="checkbox" class="form-control @error('interest') is-invalid @enderror"
                                    name="interest[]" value="Marketing" @foreach(json_decode($user->interest) as $in){{($in=='Marketing')?'checked':''}}@endforeach autocomplete="interest"></div>
                                <div class="col-md-9"><div class="card-menu">Marketing</div></div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-3"><input id="interest" type="checkbox" class="form-control @error('interest') is-invalid @enderror"
                                    name="interest[]" value="Business" @foreach(json_decode($user->interest) as $in){{($in=='Business')?'checked':''}}@endforeach autocomplete="interest"></div>
                                <div class="col-md-9"><div class="card-menu">Business</div></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3"><input id="interest" type="checkbox" class="form-control @error('interest') is-invalid @enderror"
                                    name="interest[]" value="Entrepreneurship" @foreach(json_decode($user->interest) as $in){{($in=='Entrepreneurship')?'checked':''}}@endforeach autocomplete="interest"></div>
                                <div class="col-md-9"><div class="card-menu">Entrepreneurship</div></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3"><input id="interest" type="checkbox" class="form-control @error('interest') is-invalid @enderror"
                                    name="interest[]" value="Social" @foreach(json_decode($user->interest) as $in){{($in=='Social')?'checked':''}}@endforeach autocomplete="interest"></div>
                                <div class="col-md-9"><div class="card-menu">Social</div></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3"><input id="interest" type="checkbox" class="form-control @error('interest') is-invalid @enderror"
                                    name="interest[]" value="Religious" @foreach(json_decode($user->interest) as $in){{($in=='Religious')?'checked':''}}@endforeach autocomplete="interest"></div>
                                <div class="col-md-9"><div class="card-menu">Religious</div></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3"><input id="interest" type="checkbox" class="form-control @error('interest') is-invalid @enderror"
                                    name="interest[]" value="Others" @foreach(json_decode($user->interest) as $in){{($in=='Others')?'checked':''}}@endforeach autocomplete="interest"></div>
                                <div class="col-md-9"><div class="card-menu">Others</div></div>
                            </div>

                            <div class="">
                            @error('interest[]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                            <button type="submit" class="btn btn-secondary">
                                {{ __('Update') }}
                            </button>
                    </div>
                </form>
                </div>
                @endif

            </div>
            </div>
        </div>
    </div>
</div>
@endsection
