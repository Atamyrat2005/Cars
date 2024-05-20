@extends('layouts.app')
@section('title')
    @lang('app.car') - @lang('app.appName')
@endsection
@section('content')
    <div class="container-xl py-4">
        @include('car.show.car')
        <div class="border-top">
            <div class="py-4">
                <div class="h5 mb-3">@lang('app.similar')</div>
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4">
                    @foreach($similar as $car)
                        <div class="col">
                            @include('app.car')
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection