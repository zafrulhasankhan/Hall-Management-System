@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align: center;font-size:20px;font-family: cursive">{{ __('Notifications List') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @foreach($userNotify as $notification)
                    @if($notification->data['msg'])
                    <div class="card">
                        <div class="card-header"><span style="text-align: center;font-size:18px;font-family: cursive">Notifications</span> <span style="float:right">{{ $notification->created_at->diffForHumans() }}</span> </div>

                        <div class="card-body">
                            <div>
                                <span style="text-align: center; font-weight:bold;font-size:15px;font-family: cursive"></span> {{ $notification->data['msg'] }}
                            </div>
                           


                        </div>
                    </div><br>
                    @endif
                  @endforeach




                </div>
            </div>
        </div>
    </div>
</div>
@endsection