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
                    @foreach($users as $user)
                        @foreach($user->notifications as $notification)
                            @if(Auth::user()->id === $notification->data['id'])
                            <h1>{{$notification->data['msg']}}</h1><br>
                            @endif
                        @endforeach
                    @endforeach



                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection