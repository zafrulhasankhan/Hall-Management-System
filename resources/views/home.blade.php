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


                    @foreach($userNotify as $notification)
                    <!-- @if(Auth::user()->id === $notification->data['id']) -->
                    <h4>{{$notification->data['msg']}} </h4><br>

                    <!-- @endif -->

                    @if($notification->data['complain'])
                    <ul>
                        <li>
                            Comlain: {{ $notification->data['complain'] }} <br>
                            reply : {{ $notification->data['complain_reply'] }}
                        </li>
                    </ul>
                    @endif
                    @endforeach



                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection