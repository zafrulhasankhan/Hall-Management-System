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
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Create-Instuition</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Create-Instuition {{Auth::user()->name}}</h6>
</nav>
@endsection

@section('section')

<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div style="text-align: center;font-size:20px;font-family: cursive" class="card-header">{{ __('Notice') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.Noticehandle') }}">
                        @csrf

            
                        <div class="row mb-3">
                            <label for="notice_details" class="col-md-4 col-form-label text-md-end">{{ __('Notice details') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control1 @error('description') is-invalid @enderror" name="notice_details" required autocomplete="new-notice_details">
                                </textarea>
                                @error('notice_details')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save and sent') }}
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