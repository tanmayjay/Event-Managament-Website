@extends('layouts.app')
<link href="{{ asset('css/form.css') }}" rel="stylesheet">
<script src="{{ asset('js/form.js') }}" defer></script>


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" id="reg-form" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- One "tab" for each step in the form: -->
                        <div class="tab">
                            <div class="pb-4"><h4>Login Info</h4></div>
                            <div class="form-group">
                                <p>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email"
                                    oninput="this.className = ''"  placeholder="Email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </p>
                            </div>

                            <div class="form-group">
                                <p>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password" oninput="this.className = ''" placeholder="Password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </p>
                            </div>

                            <div class="form-group">
                                <p>
                                    <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password" oninput="this.className = ''" placeholder="Confirm Password">
                                </p>
                            </div>
                        </div>

                        <div class="tab">
                            <div class="pb-4"><h4>Name</h4></div>
                            <div class="form-group">
                                <p>
                                    <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror"
                                    name="fname" value="{{ old('fname') }}" required autocomplete="fname" autofocus placeholder="First Name">

                                    @error('fname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </p>
                            </div>

                            <div class="form-group">
                                <p>
                                    <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror"
                                    name="lname" value="{{ old('lname') }}" required autocomplete="lname" autofocus placeholder="Last Name">

                                    @error('lname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </p>
                            </div>

                            <div class="form-group">
                                <p>
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                                    name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Choose a Username">

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </p>
                            </div>
                        </div>

                        <div class="tab">
                            <div class="pb-4"><h4>Personal Info</h4></div>
                            <div class="form-group">
                                <p>
                                    <select id="gender" class="form-control @error('gender') is-invalid @enderror"
                                    name="gender" value="{{ old('gender') }}" required autocomplete="gender" autofocus>
                                        <option value="" hidden>Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Others</option>
                                    </select>

                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </p>
                            </div>

                            <div class="form-group">
                                <p>
                                    <input id="address[]" type="text" class="form-control @error('address[]') is-invalid @enderror"
                                    name="address[]" value="{{ old('address[0]') }}" rautocomplete="address[]" autofocus placeholder="House, Street, Area">

                                    @error('address[]')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <input id="address[]" type="text" class="form-control @error('address[]') is-invalid @enderror"
                                    name="address[]" value="{{ old('address[1]') }}" rautocomplete="address[]" autofocus required placeholder="City, Region">

                                    @error('address[]')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <input id="address[]" type="text" class="form-control @error('address[]') is-invalid @enderror"
                                    name="address[]" value="{{ old('address[2]') }}" rautocomplete="address[]" autofocus required placeholder="Country">

                                    @error('address[]')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <input id="address[]" type="text" class="form-control @error('address[]') is-invalid @enderror"
                                    name="address[]" value="{{ old('address[2]') }}" rautocomplete="address[]" autofocus required placeholder="Zip Code">

                                    @error('address[]')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </p>
                            </div>

                            <div class="form-group">
                                <p>
                                <div class="row d-flex">
                                    <div class="col-md-3 card-menu" style="background: none;">Date of Birth </div>
                                    <div class="col-md-9"><input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror"
                                    name="dob" value="{{ old('dob') }}" required autocomplete="dob" autofocus></div>
                                </div>

                                    @error('dob')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </p>
                            </div>
                        </div>
                        <div class="tab">
                            <div class="pb-4"><h4>Choose Your Interested Area</h4></div>
                            <div class="form-group row">
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-3"><input id="interest" type="checkbox" class="form-control @error('interest') is-invalid @enderror"
                                            name="interest[]" value="Entertainment" {{(old('interest') == 'Entertainment') ? 'checked':''}} autocomplete="interest"></div>
                                        <div class="col-md-9"><div class="card-menu">Entertainment</div></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input id="interest" type="checkbox" class="form-control @error('interest') is-invalid @enderror"
                                            name="interest[]" value="Education" {{(old('interest') == 'Education') ? 'checked':''}} autocomplete="interest"></div>
                                        <div class="col-md-9"><div class="card-menu">Education</div></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input id="interest" type="checkbox" class="form-control @error('interest') is-invalid @enderror"
                                            name="interest[]" value="Science" {{(old('interest') == 'Science') ? 'checked':''}} autocomplete="interest"></div>
                                        <div class="col-md-9"><div class="card-menu">Science</div></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input id="interest" type="checkbox" class="form-control @error('interest') is-invalid @enderror"
                                            name="interest[]" value="Technology" {{(old('interest') == 'Technology') ? 'checked':''}} autocomplete="interest"></div>
                                        <div class="col-md-9"><div class="card-menu">Technology</div></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input id="interest" type="checkbox" class="form-control @error('interest') is-invalid @enderror"
                                            name="interest[]" value="Healthcare" {{(old('interest') == 'Healthcare') ? 'checked':''}} autocomplete="interest"></div>
                                        <div class="col-md-9"><div class="card-menu">Healthcare</div></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input id="interest" type="checkbox" class="form-control @error('interest') is-invalid @enderror"
                                            name="interest[]" value="Marketing" {{(old('interest') == 'Marketing') ? 'checked':''}} autocomplete="interest"></div>
                                        <div class="col-md-9"><div class="card-menu">Marketing</div></div>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-3"><input id="interest" type="checkbox" class="form-control @error('interest') is-invalid @enderror"
                                            name="interest[]" value="Business" {{(old('interest') == 'Business') ? 'checked':''}} autocomplete="interest"></div>
                                        <div class="col-md-9"><div class="card-menu">Business</div></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input id="interest" type="checkbox" class="form-control @error('interest') is-invalid @enderror"
                                            name="interest[]" value="Entrepreneurship" {{(old('interest') == 'Entrepreneurship') ? 'checked':''}} autocomplete="interest"></div>
                                        <div class="col-md-9"><div class="card-menu">Entrepreneurship</div></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input id="interest" type="checkbox" class="form-control @error('interest') is-invalid @enderror"
                                            name="interest[]" value="Social" {{(old('interest') == 'Social') ? 'checked':''}} autocomplete="interest"></div>
                                        <div class="col-md-9"><div class="card-menu">Social</div></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input id="interest" type="checkbox" class="form-control @error('interest') is-invalid @enderror"
                                            name="interest[]" value="Religious" {{(old('interest') == 'Religious') ? 'checked':''}} autocomplete="interest"></div>
                                        <div class="col-md-9"><div class="card-menu">Religious</div></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><input id="interest" type="checkbox" class="form-control @error('interest') is-invalid @enderror"
                                            name="interest[]" value="Others" {{(old('interest') == 'Others') ? 'checked':''}} autocomplete="interest"></div>
                                        <div class="col-md-9"><div class="card-menu">Others</div></div>
                                    </div>

                                    <div class="">
                                    @error('interest')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                        </div>
                        </div>

                        <div class="tab">
                            <div class="pb-4"><h4>Upload Your Photo</h4></div>
                            <div class="form-group">
                                <p>
                                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror"
                                    name="image" autocomplete="image">

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </p>
                            </div>
                        </div>

                        <div style="overflow:auto;">
                          <div style="float:right;">
                            <button class="form-button" type="button" id="back-button" onclick="nextPrev(-1)">Back</button>
                            <button class="form-button" type="button" id="next-button" onclick="nextPrev(1)">Next</button>
                          </div>
                        </div>
                        <!-- Circles which indicates the steps of the form: -->
                        <div style="text-align:center;margin-top:40px;">
                          <span class="step"></span>
                          <span class="step"></span>
                          <span class="step"></span>
                          <span class="step"></span>
                          <span class="step"></span>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
