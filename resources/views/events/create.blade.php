@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New Event') }}</div>

                <div class="card-body">
                <form method="POST" action="/event" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">Event Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="location[]" class="col-md-4 col-form-label text-md-right">Event Location</label>

                            <div class="col-md-6">
                                <input id="location[]" type="text" class="form-control @error('location[]') is-invalid @enderror"
                                name="location[]" value="{{ old('location[0]') }}" autocomplete="location[]" autofocus required placeholder="House, Street, Area">

                                @error('location[]')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input id="location[]" type="text" class="form-control @error('location[]') is-invalid @enderror"
                                name="location[]" value="{{ old('location[1]') }}" autocomplete="location[]" autofocus required placeholder="City, Region">

                                @error('location[]')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input id="location[]" type="text" class="form-control @error('location[]') is-invalid @enderror"
                                name="location[]" value="{{ old('location[2]') }}" autocomplete="location[]" autofocus required placeholder="Country">

                                @error('location[]')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input id="location[]" type="text" class="form-control @error('location[]') is-invalid @enderror"
                                name="location[]" value="{{ old('location[3]') }}" autocomplete="location[]" autofocus required placeholder="Zip Code">

                                @error('location[]')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="performer" class="col-md-4 col-form-label text-md-right">Performer</label>

                            <div class="col-md-6">
                                <input id="performer" type="text" class="form-control @error('performer') is-invalid @enderror"
                                name="performer" value="{{ old('performer') }}" required autocomplete="performer" autofocus>

                                @error('performer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">Event Type</label>

                            <div class="col-md-6">
                                <select id="type" class="form-control @error('type') is-invalid @enderror"
                                name="type" value="{{ old('type') }}" required autocomplete="type" autofocus>
                                    <option value="" hidden>Select Event Type</option>
                                    <option value="Entertainment">Entertainment</option>
                                    <option value="Education">Education</option>
                                    <option value="Science">Science</option>
                                    <option value="Technology">Technology</option>
                                    <option value="Healthcare">Healthcare</option>
                                    <option value="Marketing">Marketing</option>
                                    <option value="Business">Business</option>
                                    <option value="Entrepreneurship">Entrepreneurship</option>
                                    <option value="Social">Social</option>
                                    <option value="Religious">Religious</option>
                                    <option value="Others">Others</option>
                                </select>

                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="organizer" class="col-md-4 col-form-label text-md-right">Event Organizer</label>

                            <div class="col-md-6">
                                <input id="organizer" type="text" class="form-control @error('organizer') is-invalid @enderror"
                                name="organizer" value="{{ old('organizer') }}" autocomplete="organizer" required autofocus>

                                @error('organizer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="capacity" class="col-md-4 col-form-label text-md-right">Event Capacity</label>

                            <div class="col-md-6">
                                <input id="capacity" type="number" class="form-control @error('capacity') is-invalid @enderror"
                                name="capacity" value="{{ old('capacity') }}" autocomplete="capacity" required autofocus>

                                @error('capacity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ticket_price" class="col-md-4 col-form-label text-md-right">Unit Price</label>

                            <div class="col-md-6">
                                <input id="ticket_price" type="number" class="form-control @error('ticket_price') is-invalid @enderror"
                                name="ticket_price" value="{{ old('ticket_price') }}" autocomplete="ticket_price" autofocus>

                                @error('ticket_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="start_date" class="col-md-4 col-form-label text-md-right">Start Date</label>

                            <div class="col-md-6">
                                <input id="start_date" type="dateTime-local" class="form-control @error('start_date') is-invalid @enderror"
                                name="start_date" value="{{ old('start_date') }}"
                                autocomplete="start_date" required autofocus>

                                @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="end_date" class="col-md-4 col-form-label text-md-right">End Date</label>

                            <div class="col-md-6">
                                <input id="end_date" type="dateTime-local" class="form-control @error('end_date') is-invalid @enderror"
                                name="end_date" value="{{ old('end_date') }}"
                                autocomplete="end_date" required autofocus>

                                @error('end_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Event Description</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror"
                                name="description" autocomplete="description" autofocus>{{ old('description') }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Phone" class="col-md-4 col-form-label text-md-right">Phone</label>

                            <div class="col-md-6">
                                <input id="text" type="Phone" class="form-control @error('Phone') is-invalid @enderror"
                                name="Phone" value="{{ old('Phone') }}" autocomplete="Phone">

                                @error('Phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="website" class="col-md-4 col-form-label text-md-right">Website</label>

                            <div class="col-md-6">
                                <input id="website" type="text" class="form-control @error('website') is-invalid @enderror"
                                name="website" value="{{ old('website') }}" autocomplete="website">

                                @error('website')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cover_image" class="col-md-4 col-form-label text-md-right">Image</label>

                            <div class="col-md-6">
                                <input id="cover_image" type="file" class="form-control @error('cover_image') is-invalid @enderror"
                                name="cover_image" value="{{ old('cover_image') }}" autocomplete="cover_image">

                                @error('cover_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-secondary">
                                    Add
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
