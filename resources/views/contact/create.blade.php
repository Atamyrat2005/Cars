@extends('layouts.app')
@section('title')
    @lang('app.contact') - @lang('app.appName')
@endsection
@section('content')
    <div class="container-xl py-4">
        <div class="h5 text-center mb-3">
            @lang('app.contact')
        </div>
        <div class="row justify-content-center">
            <div class="col-8 col-md-6 col-xl-4">
                <form action="{{ route('contacts.store') }}" method="POST">
                    @csrf
                    @honeypot

                    <div class="mb-3">
                        <label for="name" class="form-label">@lang('app.name') <span class="text-danger">*</span></label>
                        <input type="text" maxlength="50" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                               value="{{ auth()->check() ? auth()->user()->name : old('name') }}" required autofocus>
                        @error('name')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">@lang('app.email')</label>
                        <input type="email" max="50" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                        @error('email')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">@lang('app.phone')</label>
                        <input type="number" min="60000000" max="65999999" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                        @error('phone')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">@lang('app.message') <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('message') is-invalid @enderror" id="message" rows="3" name="message" maxlength="255" required>{{ old('message') }}</textarea>
                        @error('message')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm w-100">
                        @lang('app.contact')
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection