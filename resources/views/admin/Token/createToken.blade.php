@extends('layouts.AppTemplate')

<style>
    .form-control1 {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background-clip: padding-box;
        background-color: #f8fafc;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        color: #212529;
        display: block;
        font-size: .9rem;
        font-weight: 400;
        line-height: 1.6;
        padding: .375rem .75rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        width: 100%;
    }
</style>


@section('nav-bread')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Token Configuration</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Create-Instuition {{Auth::user()->name}}</h6>
</nav>
@endsection

@section('section')

<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div style="text-align: center;font-size:20px;font-family: cursive" class="card-header">{{ __('Token Configuration') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.Tokencreate') }}">
                        @csrf


                        <div class="row mb-3 ml-5">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input notify_details" id="breakfast" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Breakfast
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input notify_details" type="checkbox" value="" id="lunch">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Lunch
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input notify_details" type="checkbox" value="" id="dinner">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Dinner
                                    </label>
                                </div>
                            </div>

                        </div>

                        <div class="row mb-3 " id="details_breakfast" style="display: none;">
                            <div class="mb-3 ml-6 col-md-5">
                                <input id="varsity_name" type="number" class="form-control1 @error('varsity_name') is-invalid @enderror" name="breakfast_price" value="{{ old('varsity_name') }}"  autocomplete="name">
                                <div id="emailHelp" class="form-text">Destine the token prices of the breakfast.</div>
                            </div>
                        </div>
                        <div class="row mb-3" id="details_lunch" style="display: none;">
                            <!-- <label for="varsity_name" class="col-md-4 col-form-label text-md-end">{{ __('University Name') }}</label> -->
                            <div class="col-md-5">
                                <input id="varsity_name" type="number" class="form-control1 @error('varsity_name') is-invalid @enderror" name="lunch_price" value="{{ old('varsity_name') }}"  autocomplete="name">
                                <div id="emailHelp" class="form-text">Destine the token prices of the lunch.</div>
                            </div>
                        </div>
                        <div class="row mb-4" id="details_dinner" style="display: none;">
                            <!-- <label for="varsity_name" class="col-md-4 col-form-label text-md-end">{{ __('University Name') }}</label> -->
                            <div class="col-md-5">
                                <input id="varsity_name" type="number" class="form-control1 @error('varsity_name') is-invalid @enderror" name="dinner_price" value="{{ old('varsity_name') }}"  autocomplete="name">
                                <div id="emailHelp" class="form-text">Destine the token prices of the Dinner.</div>
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
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
        $('.notify_details').click(function() {
            var some = $(this).attr("id");
            console.log(some);
            $("#details_" + some).toggle();
        });
    })
</script>