@extends('layouts.app')
@section('title')
    @lang('app.appName')
@endsection
@section('content')
    @foreach($brandCars as $brandCar)
        <div class="border-top">
            <div class="container-xl py-4">
                <div class="h5 mb-3">
                    <a href="{{ route('cars.index', ['brand' => $brandCar['brand']->id]) }}" class="link-dark text-decoration-none">
                        {{ $brandCar['brand']->name }}
                    </a>
                    <span class="text-secondary">({{ $brandCar['brand']->cars_count }} @lang('app.cars'))</span>
                </div>
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4">
                    @foreach($brandCar['cars'] as $car)
                        <div class="col">
                            @include('app.car')
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
@endsection