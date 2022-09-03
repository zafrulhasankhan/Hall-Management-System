@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header">{{ __('Registration Message') }}</div>

                <div class="card-body">
                    <div style="text-align: center;font-size:20px;font-family: cursive" class="card-header">

                        Your registration Successfully submitted. Wait until admin approves your registration.

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection