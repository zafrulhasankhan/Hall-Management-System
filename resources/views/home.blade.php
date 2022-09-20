@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align: center;font-size:20px;font-family: cursive">{{ __('Notices') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <!-- Notice  -->
                    @foreach($userNotice as $notification)
                    <div class="card">
                        <div class="card-header">{{ $notification->created_at->diffForHumans() }}</div>

                        <div class="card-body">
                            <h5><span> </span>{{ $notification->data['msg'] }}</h5>
                        </div>
                    </div><br>
                
                @endforeach


                <!-- @foreach($userNotify as $notification) -->
                <!-- @if(Auth::user()->id === $notification->data['id']) -->
                <!-- <h4>{{$notification->data['msg']}} </h4><br> -->

                <!-- @endif -->

                <!-- @if($notification->data['complain'])
                <ul>
                    <li>
                        Comlain: {{ $notification->data['complain'] }} <br>
                        reply : {{ $notification->data['complain_reply'] }}
                    </li>
                </ul>
                @endif
                @endforeach  -->



               
            </div>
        </div>
    </div>
</div>
</div>
@endsection