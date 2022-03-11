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
                <p class="fs-4 text-danger">  Failed To Complete Action. </p>
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
        <button class="btn btn-primary" onclick="displayCreateCompany()" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-regular fa-plus"></i> Create company</button>
        </div>
         <div class="container-fluid fixed-card">
            <div class="card  py-4 px-4">
                <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Tel</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($companies as $company)<tr>
                                <th  onclick="populateEditForm({{ $company->id }},'<?php echo str_replace('\'', ' ',$company->name); ?>','{{ $company->email }}','{{ $company->tel }}')" scope="row clickable-row">{{ $company->id }}</th>
                                <td onclick="populateEditForm({{ $company->id }},'<?php echo str_replace('\'', ' ',$company->name); ?>','{{ $company->email }}','{{ $company->tel }}')">{{ $company->name }}</td>
                                <td onclick="populateEditForm({{ $company->id }},'<?php echo str_replace('\'', ' ',$company->name); ?>','{{ $company->email }}','{{ $company->tel }}')">{{ $company->email }}</td>
                                <td onclick="populateEditForm({{ $company->id }},'<?php echo str_replace('\'', ' ',$company->name); ?>','{{ $company->email }}','{{ $company->tel }}')">{{ $company->tel }}</td>
                                <td onclick="deleteCompany({{ $company->id }})" class="text-danger"><i class="fa-solid fa-trash"></i></td>
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
    <form class="modal-content" action="{{ route('post company') }}" method="POST">
    @csrf
      <div class="modal-header">
        <h5 class="modal-title">Create Company</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body row">
          <div class="col-md-6 mb-3 d-flex flex-column">
              <label>Name</label>
              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"  value="{{ old('name') }}" required autofocus>
              @error('name')
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
          <div class="col-md-6 mb-3 d-flex flex-column">
              <label>Tel</label>
              <input type="tel" name="tel" class="form-control @error('tel') is-invalid @enderror" value="{{ old('tel') }}" >
              @error('tel')
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
        <form class="modal-content" action="{{ route('update company') }}" method="POST">
            @csrf
            <div class="modal-header">
            <h5 class="modal-title">Edit Company</h5>
            <button type="button" class="btn-close" onclick="closeModel('editModal')"></button>
        </div>
        <div class="modal-body row">
        <input name="id" id="id" hidden readonly>
            <div class="col-md-6 mb-3 d-flex flex-column">
                <label>Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"  value="{{ old('name') }}" required autofocus>
                @error('name')
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
            <div class="col-md-6 mb-3 d-flex flex-column">
                <label>Tel</label>
                <input type="tel" name="tel" id="tel" class="form-control @error('tel') is-invalid @enderror" value="{{ old('tel') }}" >
                @error('tel')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  onclick="closeModel('editModal')">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
    </div>
</div>
<div class="AlertContainer" id="deleteAlert">
        <div class="card errorAlert">
            <div class="card-header text-end">
               <button type="button" class="btn-close" onclick="closeModel('deleteAlert')"></button>
            </div>
            <form action="{{ route('delete company') }}" method="POST" class="card-body text-danger text-center">
                <i class=" fs-1 fa-solid fa-circle-exclamation"></i>
                <p class="fs-4 text-danger">Are you sure?</p>
                <div class="modal-footer">
                    @csrf
                    <input id="del_compnay_id" name="del_compnay_id" readonly hidden>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  onclick="closeModel('deleteAlert')">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
@endsection

<script>

    function populateEditForm(id,name,email,tel){
        document.getElementById('editModal').style.display = "block";
        document.getElementById('editModal').classList.add("show");
        document.getElementById('id').value = id;
        document.getElementById('name').value = name;
        document.getElementById('email').value = email;
        document.getElementById('tel').value = tel;

        console.log("here", name);
    }
    function closeModel(nodeId){
        console.log(nodeId);
        document.getElementById(nodeId).style.display = "none";
    }
    function deleteCompany(company_id){
        console.log(company_id);
        document.getElementById('del_compnay_id').value = company_id;
        document.getElementById('deleteAlert').style.display = "flex";
    }
</script>
