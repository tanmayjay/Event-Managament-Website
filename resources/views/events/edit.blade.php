@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Event') }}</div>

                <div class="card-body">
                    <form method="POST" action="/event/{{$event->id}}">
                        @csrf
                        @method('PATCH')

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Event Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                name="title" value="{{$event->title }}" required autocomplete="title" autofocus>

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
                                name="location[]" value="{{$place[0]}}" autocomplete="location[]" autofocus required placeholder="House, Street, Area">

                                @error('location[]')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input id="location[]" type="text" class="form-control @error('location[]') is-invalid @enderror"
                                name="location[]" value="{{ $place[1] }}" autocomplete="location[]" autofocus required placeholder="City, Region">

                                @error('location[]')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <input id="location[]" type="text" class="form-control @error('location[]') is-invalid @enderror"
                                name="location[]" value="{{ $place[2] }}" autocomplete="location[]" autofocus required placeholder="Country">

                                @error('location[]')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Event Type') }}</label>

                            <div class="col-md-6">
                                <select id="type" class="form-control @error('type') is-invalid @enderror"
                                name="type" required autocomplete="type" autofocus>
                                    <option value="" hidden>Select Event Type</option>
                                    <option value="Entertainment"
                                    {{ ($event->type == 'Entertainment') ? 'selected':''}}>Entertainment</option>
                                    <option value="Education"
                                    {{($event->type == 'Education') ? 'selected':''}}>Education</option>
                                    <option value="Science"
                                    {{($event->type == 'Science') ? 'selected':''}}>Science</option>
                                    <option value="Technology"
                                    {{($event->type == 'Technology') ? 'selected':''}}>Technology</option>
                                    <option value="Healthcare"
                                    {{($event->type == 'Healthcare') ? 'selected':''}}>Healthcare</option>
                                    <option value="Marketing"
                                    {{($event->type == 'Marketing') ? 'selected':''}}>Marketing</option>
                                    <option value="Business"
                                    {{($event->type == 'Business') ? 'selected':''}}>Business</option>
                                    <option value="Entrepreneurship"
                                    {{($event->type == 'Entrepreneurship') ? 'selected':''}}>Entrepreneurship</option>
                                    <option value="Social"
                                    {{($event->type == 'Social') ? 'selected':''}}>Social</option>
                                    <option value="Religious"
                                    {{($event->type == 'Religious') ? 'selected':''}}>Religious</option>
                                    <option value="Others"
                                    {{($event->type == 'Others') ? 'selected':''}}>Others</option>
                                </select>

                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="organizer" class="col-md-4 col-form-label text-md-right">{{ __('Event Organizer') }}</label>

                            <div class="col-md-6">
                                <input id="organizer" type="text" class="form-control @error('organizer') is-invalid @enderror"
                                name="organizer" value="{{ $event->organizer }}" autocomplete="organizer" required autofocus>

                                @error('organizer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="start_date" class="col-md-4 col-form-label text-md-right">{{ __('Start Date') }}</label>

                            <div class="col-md-6">
                                <input id="start_date" type="dateTime-local" class="form-control @error('start_date') is-invalid @enderror"
                                name="start_date" value="{{ date('Y-m-d\Th:m:s',  strtotime($event->start_date)) }}" autocomplete="start_date" required autofocus>

                                @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="end_date" class="col-md-4 col-form-label text-md-right">{{ __('End Date') }}</label>

                            <div class="col-md-6">
                                <input id="end_date" type="dateTime-local" class="form-control @error('end_date') is-invalid @enderror"
                                name="end_date" value="{{ date('Y-m-d\Th:m:s',  strtotime($event->end_date)) }}" autocomplete="end_date" required autofocus>

                                @error('end_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Event Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror"
                                name="description" autocomplete="description" autofocus>{{ $event->description }}</textarea>

                                @error('description')
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
                                name="email" value="{{ $event->email }}" autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone No') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                name="phone" value="{{ $event->phone }}" autocomplete="phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="website" class="col-md-4 col-form-label text-md-right">{{ __('Website') }}</label>

                            <div class="col-md-6">
                                <input id="website" type="text" class="form-control @error('website') is-invalid @enderror"
                                name="website" value="{{ $event->website }}" autocomplete="website">

                                @error('website')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-secondary">
                                    {{ __('Update') }}
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
