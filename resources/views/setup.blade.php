@extends('layouts.app')

@section('content')
@if($errors->any())
    <div class="AlertContainer" id="errorAlert">
        <div class="card errorAlert">
            <div class="card-header text-end">
               <button type="button" class="btn-close" onclick="closeModel('errorAlert')"></button>
            </div>
            <div class="card-body text-danger text-center">
                <i class=" fs-1 fa-solid fa-circle-exclamation"></i>
                <p class="fs-4 text-danger"> Failed To Complete Action. </p>
            </div>
        </div>
    </div>
@endif
@if(session()->has('success'))
    <div class="AlertContainer" id="successAlert">
        <div class="card errorAlert">
            <div class="card-header text-end">
               <button type="button" class="btn-close" onclick="closeModel('successAlert')"></button>
            </div>
            <div class="card-body text-success text-center">
                <i class=" fs-1 fa-solid fa-circle-check"></i>
                <p class="fs-4 text-success">{{ session()->get('success') }}</p>
            </div>
        </div>
    </div>
@endif
<div class="container py-6">
    <div class="row justify-content-center">
        <div class="col-md-4">
        <h3 class="fw-bold mb-4 d-flex justify-content-center">{{ __('Set Up') }}</h3>
            <div class="card">

                <div class="card-body">
                    <form method="POST" action="{{ route('Register super admin') }}">
                        @csrf
                        <div class="row mb-3 d-flex flex-column align-items-start">
                            <label for="firstname" class="col-md-4 col-form-label">{{ __('First Name') }}</label>

                            <div class="col-md-12">
                                <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="name" autofocus>
                                @error('firstname')
                                    <p class="text-danger">{{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 d-flex flex-column align-items-start">
                            <label for="lastname" class="col-md-4 col-form-label">{{ __('Last Name') }}</label>

                            <div class="col-md-12">
                                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="name" autofocus>
                                @error('lastname')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 d-flex flex-column align-items-start">
                            <label for="name" class="col-md-4 col-form-label">{{ __('Username') }}</label>

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="name" autofocus>

                                @error('username')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 d-flex flex-column align-items-start">
                            <label for="email" class="col-md-4 col-form-label">{{ __('Email Address') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 d-flex flex-column align-items-start">
                            <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 d-flex flex-column align-items-start">
                            <label for="password-confirm" class="col-md-6 col-form-label">{{ __('Confirm Password') }}</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12 d-flex flex-column align-items-start">
                                <button type="submit" class="btn btn-primary  align-self-stretch">
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
<script>
    function closeModel(nodeId){
        console.log(nodeId);
        document.getElementById(nodeId).style.display = "none";
    }
</script>
