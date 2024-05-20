@extends('layouts.app')
@section('title')
    @lang('app.messages') - @lang('app.appName')
@endsection
@section('content')
    <div class="container-xl py-4">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>@lang('app.name')</th>
                    <th>@lang('app.email')</th>
                    <th>@lang('app.phone')</th>
                    <th>@lang('app.message')</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $contact)
                    <tr>
                        <td>{{ $contact->id }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td>{{ $contact->message }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection