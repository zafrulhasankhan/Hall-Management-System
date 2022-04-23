@extends('layouts.app')

@section('content')
<div class="container"><br><br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align: center;font-size:20px;font-family: cursive">{{ __('Add Institution') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register_verify') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Institution Name') }}</label>
                            <div class="col-md-6">
                                <select name="institute_name" id="parent_id" class="form-control dynamic" data-dependent="details" required>
                                    <option value="" selected disabled> Select Name</option>
                                    @foreach ( $institute_details as $row )
                                    <option class="{{ $row->category }}" value="{{ $row->name }}">{{ $row->name }} - {{ $row->category }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="some" id="some_Hall" style="display:none;">
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Department Name') }}</label>

                                <div class="col-md-6">
                                    <input id="dept_name" type="text" class="form-control @error('dept_name') is-invalid @enderror" name="dept_name" value="{{ old('email') }}"  autocomplete="email">

                                    @error('dept_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Student ID') }}</label>

                                <div class="col-md-6">
                                    <input id="ID" type="text" class="form-control @error('ID') is-invalid @enderror" name="student_ID" value="{{ old('email') }}"  autocomplete="email">

                                    @error('ID')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Room No.') }}</label>

                                <div class="col-md-6">
                                    <input id="roomno" type="text" class="form-control @error('roomno') is-invalid @enderror" name="roomno" value="{{ old('email') }}"  autocomplete="email">

                                    @error('roomno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="some" id="some_Department" style="display:none;">
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Student ID') }}</label>

                                <div class="col-md-6">
                                    <input id="ID" type="text" class="form-control @error('ID') is-invalid @enderror" name="ID" value="{{ old('email') }}"  autocomplete="email">

                                    @error('ID')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Session') }}</label>

                                <div class="col-md-6">
                                    <input id="session" type="text" class="form-control @error('session') is-invalid @enderror" name="session" value="{{ old('email') }}"  autocomplete="email">

                                    @error('session')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="some" id="some_Others" style="display:none;">
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Your Institutional ID') }}</label>

                                <div class="col-md-6">
                                    <input id="institute_id" type="text" class="form-control @error('institute_id') is-invalid @enderror" name="institute_id" value="{{ old('email') }}"  autocomplete="email">

                                    @error('institute_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function(e) {
        $('#parent_id').on('change', function() {
            $(".some").hide();
            var some = $(this).find('option:selected').attr("class");
            console.log(some);
            $("#some_" + some).show();
        });
    })
</script>