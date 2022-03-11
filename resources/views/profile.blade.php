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
<div class="mainContent">
    <div class="container-fluid">
        <div class="container-fluid px-4 py-4 d-flex justify-content-end">
        <!-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-regular fa-plus"></i> Create User</button> -->
        </div>
         <div class="container-fluid fixed-card">
            <div class="card  py-4 px-4" style="width:40%;height:40%;">
                <form class="card-body" method="POST" action="{{ route('update profile') }}">
                @csrf
                    <h5 class="modal-title">Profile</h5><hr>
                    <div class="row">
                        <div class="col-md-6 mb-3 d-flex flex-column">
                            <label>First Name</label>
                            <input type="text" name="firstname" class="form-control @error('firstname') is-invalid @enderror"  value="{{ Auth::user()->firstname }}" required autofocus>
                            @error('firstname')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3 d-flex flex-column">
                            <label>Last Name</label>
                            <input type="text" name="lastname" class="form-control @error('lastname') is-invalid @enderror"  value="{{ Auth::user()->lastname }}" required>
                            @error('lastname')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3 d-flex flex-column">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"  value="{{ Auth::user()->username }}" required>
                            @error('username')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3 d-flex flex-column">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"  value="{{ Auth::user()->email }}" required>
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3 d-flex flex-column">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
