@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{route('client.create')}}">Add Client</a>
                    <a href="{{route('client.index')}}">Client Show</a>
                    <a href="{{route('operative.create')}}">Add Operative</a>
                    <a href="{{route('operative.index')}}">Operative Show</a>

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
