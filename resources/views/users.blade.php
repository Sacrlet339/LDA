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
                <p class="fs-4 text-danger"> Failed To Create User. </p>
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
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-regular fa-plus"></i> Create User</button>
        </div>
         <div class="container-fluid fixed-card">
            <div class="card  py-4 px-4">
                <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Company</th>
                            <th scope="col">Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)<tr onclick="populateEditForm({{ $user->id }},'<?php echo str_replace('\'', ' ',$user->firstname); ?>','<?php echo str_replace('\'', ' ',$user->lastname); ?>','<?php echo str_replace('\'', ' ',$user->username); ?>','{{ $user->email }}')">
                                <th scope="row clickable-row">{{ $user->id }}</th>
                                <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->created_at }}</td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" action="{{ route('post user') }}" method="POST">
    @csrf
      <div class="modal-header">
        <h5 class="modal-title">Create User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body row">
          @if(Auth::user()->type == 'Super')
         <div class="col-md-6 mb-3 d-flex flex-column">
              <label>Company</label>
              <select id="company_id" name="company_id" class="form-control @error('company_id') is-invalid @enderror"  value="{{ old('company_id') }}" required autofocus>
                  <option hidden selected>Select Compnay</option>
                  @foreach($companies as $company)
                  <option value="{{ $company->id }}">{{ $company->name }}</option>
                  @endforeach
              </select>
              @error('company_id')
                  <p class="text-danger">{{ $message }}</p>
              @enderror
          </div>
          @else
            <input hidden readonly name="company_id" value="{{Auth::user()->company_id}}">
          @endif
         <div class="col-md-6 mb-3 d-flex flex-column">
              <label>First Name</label>
              <input type="text" name="firstname" class="form-control @error('firstname') is-invalid @enderror"  value="{{ old('firstname') }}" required autofocus>
              @error('firstname')
                  <p class="text-danger">{{ $message }}</p>
              @enderror
          </div>
          <div class="col-md-6 mb-3 d-flex flex-column">
              <label>Last Name</label>
              <input type="text" name="lastname" class="form-control @error('lastname') is-invalid @enderror"  value="{{ old('lastname') }}" required autofocus>
              @error('lastname')
                  <p class="text-danger">{{ $message }}</p>
              @enderror
          </div>
          <div class="col-md-6 mb-3 d-flex flex-column">
              <label>Username</label>
              <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"  value="{{ old('username') }}" required autofocus>
              @error('username')
                  <p class="text-danger">{{ $message }}</p>
              @enderror
          </div>
          <div class="col-md-6 mb-3 d-flex flex-column">
              <label>Email</label>
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" >
              @error('email')
                  <p class="text-danger">{{ $message }}</p>
              @enderror
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</div>
<div id="editModal">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('update user') }}" method="POST">
            @csrf
            <div class="modal-header">
            <h5 class="modal-title">Edit User</h5>
            <button type="button" class="btn-close" onclick="closeModel('editModal')"></button>
        </div>
        <div class="modal-body row">
        <input name="id" id="id" hidden readonly>
          @if(Auth::user()->type == 'Super')
         <div class="col-md-6 mb-3 d-flex flex-column">
              <label>Company</label>
              <select id="company_id" name="company_id" class="form-control @error('company_id') is-invalid @enderror"  value="{{ old('company_id') }}" required autofocus>
                  <option hidden selected>Select Compnay</option>
                  @foreach($companies as $company)
                  <option value="{{ $company->id }}">{{ $company->name }}</option>
                  @endforeach
              </select>
              @error('company_id')
                  <p class="text-danger">{{ $message }}</p>
              @enderror
          </div>
          @else
            <input hidden readonly name="company_id" value="{{Auth::user()->company_id}}">
          @endif
         <div class="col-md-6 mb-3 d-flex flex-column">
              <label>First Name</label>
              <input type="text" name="firstname" id="firstname" class="form-control @error('firstname') is-invalid @enderror"  value="{{ old('firstname') }}" required autofocus>
              @error('firstname')
                  <p class="text-danger">{{ $message }}</p>
              @enderror
          </div>
          <div class="col-md-6 mb-3 d-flex flex-column">
              <label>Last Name</label>
              <input type="text" name="lastname" id="lastname" class="form-control @error('lastname') is-invalid @enderror"  value="{{ old('lastname') }}" required autofocus>
              @error('lastname')
                  <p class="text-danger">{{ $message }}</p>
              @enderror
          </div>
          <div class="col-md-6 mb-3 d-flex flex-column">
              <label>Username</label>
              <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror"  value="{{ old('username') }}" required autofocus>
              @error('username')
                  <p class="text-danger">{{ $message }}</p>
              @enderror
          </div>
          <div class="col-md-6 mb-3 d-flex flex-column">
              <label>Email</label>
              <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" >
              @error('email')
                  <p class="text-danger">{{ $message }}</p>
              @enderror
          </div>
      </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"  onclick="closeModel('editModal')">Delete</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  onclick="closeModel('editModal')">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
    </div>
</div>

@endsection

<script>

    function populateEditForm(id,firstname,lastname,username,email){
        document.getElementById('editModal').style.display = "block";
        document.getElementById('editModal').classList.add("show");
        document.getElementById('id').value = id;
        document.getElementById('firstname').value = firstname;
        document.getElementById('lastname').value = lastname;
        document.getElementById('username').value = username;
        document.getElementById('email').value = email;

    }
    function closeModel(nodeId){
        console.log(nodeId);
        document.getElementById(nodeId).style.display = "none";
    }
</script>
