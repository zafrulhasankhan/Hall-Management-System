@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Complain') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('select_hall') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('  Hall Name') }}</label>
                            <div class="col-md-6">
                                <select name="hall_name" id="parent_id1" class="form-control dynamic" data-dependent="details" required>
                                    <option value="" selected disabled> Select Hall Name</option>
                                    @foreach ( $halls as $row )
                                    <option class="{{ $row->category }}" value="{{ $row->hall_name }}">{{ $row->hall_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Next') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
