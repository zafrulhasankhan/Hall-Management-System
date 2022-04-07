@extends('layouts.app')

@section('content')
<div class="container"><br><br><br>
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align: center;font-size:20px;font-family: cursive"><b>{{ __('Login') }}</b></div><br/>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-10 offset-md-2 p-3">
                                <a href="{{route('login.google')}}" class="btn btn-danger btn-block p-2">Login with Google</a>&ensp;
                                <a href="{{route('login.facebook')}}" class="btn btn-primary btn-block p-2">Login with Facebook</a>&ensp;
                                <a href="{{route('login.github')}}" class="btn btn-dark btn-block p-2">Login with Github</a>
                            </div>
                        </div><br/>
                     
                     

                      
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection