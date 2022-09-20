@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align: center;font-size:20px;font-family: cursive">{{ __('Complain') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('complain_create') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Hall Name') }}</label>
                            <div class="col-md-6">
                                <select name="hall_name" id="parent_id1" class="form-control dynamic" data-dependent="details" required>
                                    <option value="" selected disabled> Select Hall Name</option>
                                    @foreach ( $approve_institutes as $row )
                                    <option class="{{ $row->category }}" value="{{ $row->hall_name }}">{{ $row->hall_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Your Complain') }}</label>

                            <div class="col-md-6">
                                <textarea id="complain_box" type="text" rows="4" class="form-control @error('complain_box') is-invalid @enderror" name="complain_box" value="{{ old('complain_box') }}" required autocomplete="complain_box">
                                </textarea>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><br>
            @foreach($userNotify as $notification)
            @if($notification->data['complain'])
            <div class="card">
                <div class="card-header"><span style="text-align: center;font-size:18px;font-family: cursive">Complains and Replays</span> <span style="float:right">{{ $notification->created_at->diffForHumans() }}</span> </div>

                <div class="card-body">
                    <div>
                        <span style="text-align: center; font-weight:bold;font-size:15px;font-family: cursive">Comlain:</span> {{ $notification->data['complain'] }}
                    </div>
                    <div>
                        <span style="text-align: center; font-weight:bold;font-size:15px;font-family: cursive">Replay:</span> {{ $notification->data['complain_reply'] }}
                    </div>


                </div>
            </div><br>
            @endif
            @endforeach

        </div>
    </div>
</div>
@endsection